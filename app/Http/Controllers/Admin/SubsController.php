<?php

namespace App\Http\Controllers\Admin;

use App\Callback;
use App\Order;
use App\Subs;
use Ibec\Admin\Http\Controllers;
use Ibec\Content\Root;
use Illuminate\Http\Request;

class SubsController extends Controllers\Controller
{
    public function index(Root $root, Request $request)
    {
        $this->document->breadcrumbs([
            ucfirst($root->slug) => admin_route('content.roots.show', [$root->slug]),
            'Подписчики' => ''
        ]);

        $subs = Subs::all();

        $user_id = null;

        return view('admin.subs.index',
            [
                'subs' => $subs,
                'root' => $root,
//                'title' => $title,
//                'categories' => $categoriesWithNodes,
                'batchAction' => admin_route('content.roots.posts.deleteBatch', [$root->slug])]
        );
    }
}
