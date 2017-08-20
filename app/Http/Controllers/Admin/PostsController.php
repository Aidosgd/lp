<?php namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Ibec\Admin\Fields\Field;
use Ibec\Content\Category;
use Ibec\Content\Root;
use Ibec\Content\Post;
use Ibec\Content\Http\Requests;
use Ibec\Content\PostNode;
use Ibec\Media\File;
use Ibec\Media\Image;
use Ibec\Taxonomy\Term;
use Ibec\Admin\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Ibec\Acl\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;

class PostsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param Root $root
	 * @param Request $request
	 * @return Response
	 */
	public function index(Root $root, Request $request)
	{
		$user = $this->auth->user();

		$this->document->breadcrumbs([
			ucfirst($root->slug) => admin_route('content.roots.show', [$root->slug]),
			'Posts' => ''
		]);

		$available = $root->category->descendantsAndSelf()->pluck('id');

		$users = User::all()->pluck('name','id');
		$categories = $root->category->descendantsAndSelf()->get();

		$categoriesWithNodes = [];

		$categoriesWithNodes[] = 'All';

		foreach ($categories as $category)
		{
			$categoriesWithNodes[$category->id] = $category->node->title;
		}

		$appends = [];
		if(($status = $request->input('status')) !== null)
		{
			switch($status)
			{
				case 0: $posts = Post::awaiting(); break;
				case 1: $posts = Post::approved(); break;
				case 2: $posts = Post::discarded(); break;
				case 3: $posts = Post::query(); break;
			}

			$appends['status'] = $status;
		}
		else
		{
			$posts = Post::query();
		}

		$posts->with('moderations', 'author');

		if ($category = $request->input('category_id'))
		{
			$posts->where('category_id', '=', $category);

			$appends['category_id'] = $category;
		}
		else
		{
			$posts->whereIn('category_id', $available);
		}

		$user_id = null;

//		if ( ! $user->can('others.content-posts'))
//		{
//			$posts->where('user_id', '=', $user->id);
//		}
//		elseif ($user_id = $request->input('user_id'))
//		{
//			$posts->where('user_id', '=', $user_id);
//			$appends['user_id'] = $user_id;
//		}


		if ($title = $request->input('title'))
		{
			$posts->whereHas('nodes', function($q) use ($title)
			{
				$q->where('title', 'like', '%'.$title.'%');

			});

			$appends['title'] = $title;
		}



		if ($request->wantsJson())
		{
			$fields = $request->input('fields', null);
			$data = $posts->take(10)->get();
			if ($fields)
			{
				$data = $data->map(function($item) use ($fields){
					return array_only($item->toArray(), $fields);
				});
			}

			return $data;
		}

		$posts = $posts->orderBy('display_date', 'desc')->latest()->paginate(config('admin.pagination'))->appends($appends);
		if($root->id != 6){
			$manufacturer = [
				1 => 'manufacturer_1',
				2 => 'manufacturer_2',
				3 => 'manufacturer_3',
			];
			$fields = Field::where('slug', $manufacturer[$root->id])->first();
		}else{
			$fields = [];
		}

		return view('admin.posts.index', [
			'posts' => $posts,
			'root' => $root,
			'users' => $users,
			'category_id' => $category,
			'status' => $status,
			'user' => $user_id,
			'title' => $title,
			'categories' => $categoriesWithNodes,
			'fields' => $fields,
			'batchAction' => admin_route('content.roots.posts.deleteBatch', [$root->slug])]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param Root $root
	 * @return Response
	 */
	public function create(Root $root)
	{
		$user = $this->auth->user();


		$this->document->breadcrumbs([
			ucfirst($root->slug) => admin_route('content.roots.show', [$root->slug]),
			'Posts' => admin_route('content.roots.posts.index', [$root->slug]),
			'Post create' => ''
		]);

		$terms = Term::where('root_id', '=', $root->id)
			->orWhere('root_id', '=', null)
			->with('tags')->get();

		$userClass = config('auth.providers.admins.model');

        $users = (new $userClass)->newQuery()->pluck('name', 'id');

		return view('admin.posts.form',
			[
				'post' => null,
				'users' => $users,
				'categories' => Category::getIdentedList('/', $root->id),
				'terms' => $terms,
				'target' => 'store',
				'root' => $root
			]
		);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Root $root
	 * @param Requests\PostFormRequest $request
	 * @return Response
	 */
	public function store(Requests\PostFormRequest $request, Root $root)
	{
		$user = $this->auth->user();


		$post = new Post;

		$post->getConnection()->beginTransaction();

		try
		{

			$post->fill([
				'category_id' => $request->input('category_id'),
				'root_id'     => $request->input('root_id'),
				'user_id'     => $request->input('user_id', $this->auth->id()),
				'display_date' => $request->input('display_date', null),
				'newsletter_enabled' => $request->input('newsletter_enabled', null)
			]);

			$post->save();

			if($request->input('newsletter_enabled'))
			{
				DB::table('subscription_queue')->insert(
					[
						'post_id' => $post->id,
						'created_at' => Carbon::now(),
						'sended' => 0,
						'queued' => 1,
					]
				);
			}

            $images_ids = array_filter($request->input('images.ids'), 'strlen');

            if($images_ids)
            {
                $post->images()->detach();
                foreach($images_ids as $key => $image_id)
                {
                    $post->images()->attach(
                        [
                            $image_id => [
                                'sort_order' => $key
                            ]
                        ]);
                }

            }


			if($files = $request->input('fields.files'))
			{
				foreach ($files as $field_slug => $file_id) {
					if($file_id)
						$post->files()->attach(
							[
								$file_id => [
									'field_slug' => $field_slug,
								]
							]
						);
				}
			}




			if ($moderation = $request->input('moderation') !== null)
			{
				$post->moderate($moderation);
			}

			$nodes = [];

			$post_tags = $request->input('tags') ? array_flatten($request->input('tags')) : [];

			$post->tags()->sync($post_tags);

			foreach (config('app.locales') as $locale)
			{
				$localeFields = $request->input($locale, []);
				$additional = array_get($localeFields, 'fields', []);
				array_forget($localeFields, 'fields');
				$data = array_filter($localeFields, 'strlen');
				if ($data)
				{
					$node = new PostNode();
					$node->fill($data);
					$node->fields = $additional;
					$node->language_id = $locale;
					$nodes[$locale] = $node;
				}
			}

			$post->nodes()->saveMany($nodes);

			if ($request->has('status'))
			{
				$post->moderate($request->input('status', 1));
			}

		}
		catch (\Exception $e)
		{
			$post->getConnection()->rollBack();
			return redirect(admin_route('content.roots.posts.create', [$root->slug]))->withInput()->withErrors(
				new MessageBag(['exception' => $e->getMessage()])
			);
		}

		$post->getConnection()->commit();

		return redirect(admin_route('content.roots.posts.index', [$root->slug]));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Root $root
	 * @param  Post $post
	 * @return Response
	 */
	public function show(Root $root, Post $post)
	{
		return 'posts_show';
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Root $root
	 * @param  Post $post
	 * @return Response
	 */
	public function edit(Root $root, Post $post)
	{
		$user = $this->auth->user();


		$this->document->breadcrumbs([
			ucfirst($root->slug) => admin_route('content.roots.show', [$root->slug]),
			'Posts' => admin_route('content.roots.posts.index', [$root->slug]),
			'Post edit' => ''
		]);

		$postSubscriptionQueue = DB::table('subscription_queue')->where(
			'post_id', '=', $post->id
		)->first();

		$terms = Term::where('root_id', '=', $root->id)
			->orWhere('root_id', '=', null)
			->with('tags')->get();

		$tags = $post->tags->keyBy('id')->toArray();

		$userClass = config('auth.providers.admins.model');

		$users = (new $userClass)->newQuery()->pluck('name', 'id');

		$files = $post->files->keyBy('pivot.field_slug');
//		$image = $post->images()->withPivot('title', 'alt', 'cropped_coords')->first();
        $images = $post->images()->orderBy('sort_order')->get();

		return view('admin.posts.form',
			[
				'post' => $post,
                'images' => $images,
				'users' => $users,
				'categories' => Category::getIdentedList('/', $root->id),
				'target' => 'update',
				'terms' => $terms,
				'tags' => $tags,
				'files' => $files,
				'postSubscriptionQueue' => $postSubscriptionQueue,
				'root' => $root
			]
		);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Requests\PostFormRequest $request
	 * @param Root $root
	 * @param  Post $post
	 * @return Response
	 */
	public function update(Requests\PostFormRequest $request, Root $root, Post $post)
	{
		$user = $this->auth->user();

		$post->getConnection()->beginTransaction();

		try
		{

			if (($moderation = $request->input('status')) !== null)
			{
				$post->moderate($moderation);
			}

			if (!$request->query->has('fastModeration'))
			{

				$post->update([
					'category_id'  => $request->input('category_id'),
					'root_id'      => $request->input('root_id'),
					'user_id'      => $request->input('user_id', $this->auth->id()),
					'display_date' => $request->input('display_date'),
					'newsletter_enabled' => $request->input('newsletter_enabled') ? 1 : null
				]);

				if($request->input('newsletter_enabled'))
				{
					if(DB::table('subscription_queue')
						->where('post_id', '=', $post->id)->count())
						DB::table('subscription_queue')->where('post_id', '=', $post->id)->update(
							[
								'updated_at' => Carbon::now(),
								'sended' => 0,
								'queued' => 1,
							]
						);
					else
						DB::table('subscription_queue')->insert(
							[
								'post_id' => $post->id,
								'created_at' => Carbon::now(),
								'sended' => 0,
								'queued' => 1,
							]
						);
				}
				else{
					DB::table('subscription_queue')
						->where('post_id', '=', $post->id)->delete();
				}


                $images_ids = array_filter($request->input('images.ids'), 'strlen');

                if($images_ids)
                {
                    $post->images()->detach();
                    foreach($images_ids as $key => $image_id)
                    {
                        $post->images()->attach(
                            [
                                $image_id => [
                                    'sort_order' => $key
                                ]
                            ]);
                    }

                }
                else
                {
                    $post->images()->detach();
                }

				if($files = $request->input('fields.files'))
				{
					$post->files()->detach();

					foreach ($files as $field_slug => $file_id) {
						if($file_id)
							$post->files()->attach(
								[
									$file_id => [
										'field_slug' => $field_slug,
									]
								]
							);
					}
				}
				else
				{
					$post->files()->detach();
				}

				$post_tags = array_flatten($request->input('tags', []));

				$post->tags()->sync($post_tags);

				$nodes = $post->nodes->all();

				foreach (config('app.locales') as $locale)
				{
					$localeFields = $request->input($locale, []);
					$additional = array_get($localeFields, 'fields', []);
					array_forget($localeFields, 'fields');
					$filtered = array_filter($localeFields, 'strlen');

					$node = array_get($nodes, $locale, null);

					if ($node)
					{
						if (!empty($filtered))
						{
							$node->fill($localeFields);
							$node->language_id = $locale;
							$node->fields = $additional;
							$nodes[$locale] = $node;
						}
						else
						{
							$node->delete();
							unset($nodes[$locale]);
						}
					}
					elseif ($filtered)
					{
						$node = new PostNode();
						$node->fill($filtered);
						$node->language_id = $locale;
						$nodes[$locale] = $node;
					}
				}

				$post->nodes()->saveMany($nodes);

				if ($request->has('status'))
				{
					$post->moderate($request->input('status', 1));
				}
			}
		}
		catch (\Exception $e)
		{
			$post->getConnection()->rollBack();
			return redirect(admin_route('content.roots.posts.edit', [$root->slug, $post->getOriginal('id')]))->withInput()->withErrors(
				new MessageBag(['exception' => $e->getMessage()])
			);
		}

		$post->getConnection()->commit();

		if (!$request->wantsJson())
		{
			return redirect(admin_route('content.roots.posts.index', ['root' => $root]));
		}
		else
		{
			return ['status' => 'success'];
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Root $root
	 * @param  Post $post
	 * @return Response
	 */
	public function destroy(Root $root, Post $post)
	{
		$post->getConnection()->beginTransaction();

		$user = $this->auth->user();

		$post->images()->detach();

		$post->tags()->detach();

		$post->files()->detach();

		$post->moderations()->delete();

		DB::table('subscription_queue')
			->where('post_id', '=', $post->id)->delete();

		Post::query()->whereId($post->id)->delete();

		$post->getConnection()->commit();

		return redirect(admin_route('content.roots.posts.index', [$root->slug]));
	}

	public function deleteBatch(Request $request, $action = null) {

		$ids = $request->input('selected', []);
		if ($ids)
		{
			$posts = Post::whereIn('id', $ids)->get();

			foreach ($posts as $post) {

				DB::table('subscription_queue')
					->where('post_id', '=', $post->id)->delete();

				$post->images()->detach();

				$post->tags()->detach();

				$post->files()->detach();

				$post->moderations()->delete();

				$post->delete();

			}
		}
	}

}
