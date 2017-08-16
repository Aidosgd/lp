@extends('admin::base')
@section('title-right')
  {!! Html::link(
    admin_route('content.roots.posts.create', [$root->slug]),
    trans('admin::default.actions.create'),
    ['class' => 'btn btn-success'])
  !!}
@endsection
@section('sidebar')
    <div class="wrapper">
        {!! Form::open(['method' => 'GET'])!!}
        <div class="">
            <div class="m-b-sm text-md">{{ trans('admin::default.actions.filter') }}</div>
            <div class="">
                <div class="form-group">
                    <label for="user_id" class="control-label">{{ trans('content::default.posts.user') }}</label>
                    {!! Form::select('user_id', $users, $user, ['required', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="line line-dashed b-b line-lg"></div>
            <div class="">
                <div class="form-group">
                    <label for="category_id">{{ trans('content::default.posts.category') }}</label>
                    {!! Form::select('category_id', $categories, $category_id, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="line line-dashed b-b line-lg"></div>
            <div class="">
                <div class="form-group">
                    <label for="status">{{ trans('content::default.posts.status') }}</label>
                    <div class="form-group">
                        <label class="control-label col-xs-6">{{ trans('social::default.moderation.blocked') }}</label>
                        <label class="i-switch bg-danger m-t-xs m-r">
                            {!! Form::radio('status',0 ,$status==0) !!}
                            <i></i>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-6">{{ trans('social::default.moderation.approved') }}</label>
                        <label class="i-switch bg-success m-t-xs m-r">
                            {!! Form::radio('status',1 ,$status==1) !!}
                            <i></i>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-6">{{ trans('social::default.moderation.pending') }}</label>
                        <label class="i-switch bg-info m-t-xs m-r">
                            {!! Form::radio('status',2 ,$status==2) !!}
                            <i></i>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-6">{{ trans('social::default.moderation.all') }}</label>
                        <label class="i-switch bg-primary m-t-xs m-r">
                            {!! Form::radio('status',3 ,$status==3) !!}
                            <i></i>
                        </label>
                    </div>
                </div>
            </div>
            <div class="line line-dashed b-b line-lg"></div>
            <div class="">
                <div class="form-group">
                    <label for="title">{{ trans('content::default.posts.title') }}</label>
                    <div class="form-group">
                        {!! Form::text('title' , $title, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="line line-dashed b-b line-lg"></div>
            <div class="">
                <div class="m-b-sm text-md">{{ trans('admin::default.actions.label') }}</div>
                {!! Form::submit(trans('admin::default.actions.filter'), ['class' => 'btn btn-block btn-primary'] ) !!}
                {!! Form::reset(trans('admin::default.actions.reset'), ['class' => 'btn btn-block btn-default'] ) !!}
            </div>
        </div>
        {!! Form::close()!!}
    </div>
@endsection
@section('content')
  <div class="wrapper-md" ng-controller="PostsIndexCtrl">
    <div class="panel panel-default">
        <div class="row wrapper">
            <div class="col-sm-4 hidden-xs js__disabledManipulation">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="delete">Delete selected</option>
                </select>
                <button data-action="batchAction" data-url="{{ $batchAction }}" class="btn btn-sm btn-default apply_bulk">Apply</button>
            </div>
        </div>
      <div class="table-responsive" ng-init="moderationUrl = '{{ admin_route('content.roots.posts.index', [$root->slug]) }}'">
        <table class="table table-striped b-t b-light">
          <thead>
          <tr>
              <th><label  class="i-checks m-b-none js-check-checkbox"><input onchange="applyBulkCheck($(this))" type="checkbox"><i></i></label></th>
            <th>{{ trans('content::default.posts.id') }}</th>
            <th>{{ trans('content::default.posts.title') }}</th>
            <th>{{ trans('content::default.posts.category') }}</th>
            <th>{{ trans('content::default.posts.user') }}</th>
            <th>{{ trans('social::default.moderation.approved') }}</th>
            <th>{{ trans('admin::default.actions.label') }}</th>
            <th>{{ trans('admin::default.dates') }}</th>
          </tr>
          </thead>
          <tbody>
          @forelse($posts as $post)
            <tr ng-init="approval.post_{{ $post->id }} = {{ $post->status == 1 ? 'true' : 'false' }}">
                <td class="v-middle" style="width:20px;"><label class="i-checks m-b-none js-check-checkbox active"><input type="checkbox" data-value="{{$post->id}}"><i></i></label></td>
                <td>{{ $post->id }}</td>
                <td>
                    <?php $cropped_image = $post->images->count() ? $post->images()->withPivot('cropped_coords')->first() : 'null' ;?>
                    @if(isset($cropped_image) && isset($cropped_image->pivot->cropped_coords))
                        <img style="width:75px;float:left;margin-right:10px;" src="{{ $post->images()->first()->getPath($post, 'small') }}"/>
                    @elseif($post->images->count())
                        <img style="width:75px;float:left;margin-right:10px;" src="{{ $post->images->first()->getPath($post) }}"/>
                    @endif
                    {{ $post->node->title }}
                </td>
                <td>{{ $post->category->node->title }}</td>
                <td>{{ $post->author->name }}</td>
                <td>
                  <label class="i-switch bg-info m-t-xs m-r">
                    <input type="checkbox" ng-model="approval.post_{{ $post->id }}" ng-change="approve({{ $post->id }})">
                    <i></i>
                  </label>
                </td>
              <td>
                {!!
                  Html::link(
                    admin_route('content.roots.posts.edit', [$root->slug, $post->id]),
                    trans('admin::default.actions.edit'),
                    ['class' => 'btn btn-sm btn-default']
                  )
                !!}
                {!!
                  Html::link(
                    admin_route('content.roots.posts.destroy', [$root->slug, $post->id]),
                    trans('admin::default.actions.destroy'),
                    ['class' => 'btn btn-sm btn-danger destroy-confirm']
                  )
                !!}
                <a class="btn btn-sm btn-info" href="{{ $post->link }}">{!! icon('eye-open') !!}</a>
              </td>
              <td><small>
                <strong>{{ $post->created_at->format('d.m.Y H:i:s') }}</strong><br>
                {{ $post->updated_at->format('d.m.Y H:i:s') }}
                </small>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8">
                <div class="alert alert-danger">
                  {{ trans('content::default.posts.empty') }}
                </div>
              </td>
            </tr>
          @endforelse
          </tbody>
        </table>
      </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-4 hidden-xs js__disabledManipulation">
                    <select class="input-sm form-control w-sm inline v-middle">
                        <option value="delete">Delete selected</option>
                    </select>
                    <button data-action="batchAction" data-url="{{ $batchAction }}" class="btn btn-sm btn-default apply_bulk">Apply</button>
                </div>
                <div class="col-sm-8"></div>
                <div class="col-sm-4 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                       {!! $posts->render() !!}
                    </ul>
                </div>
            </div>
        </footer>
    </div>
  </div>
@endsection