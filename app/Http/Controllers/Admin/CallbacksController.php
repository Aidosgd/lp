<?php

namespace App\Http\Controllers\Admin;

use App\Callback;
use Ibec\Admin\Http\Controllers;
use Ibec\Content\Root;
use Illuminate\Http\Request;

class CallbacksController extends Controllers\Controller
{
    public function index(Root $root, Request $request)
    {
        $this->document->breadcrumbs([
            ucfirst($root->slug) => admin_route('content.roots.show', [$root->slug]),
            'Заказать звонок' => ''
        ]);

        $calls = Callback::all();

        $user_id = null;

        return view('admin.callbacks.index',
            [
                'calls' => $calls,
                'root' => $root,
//                'title' => $title,
//                'categories' => $categoriesWithNodes,
                'batchAction' => admin_route('content.roots.posts.deleteBatch', [$root->slug])]
        );
    }
}
