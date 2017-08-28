<?php

namespace App\Http\Controllers\Admin;

use App\Callback;
use App\Order;
use Ibec\Admin\Http\Controllers;
use Ibec\Content\Root;
use Illuminate\Http\Request;

class OrdersController extends Controllers\Controller
{
    public function index(Root $root, Request $request)
    {
        $this->document->breadcrumbs([
            ucfirst($root->slug) => admin_route('content.roots.show', [$root->slug]),
            'Заказы' => ''
        ]);

        $orders = Order::all();

        $user_id = null;

        return view('admin.orders.index',
            [
                'orders' => $orders,
                'root' => $root,
//                'title' => $title,
//                'categories' => $categoriesWithNodes,
                'batchAction' => admin_route('content.roots.posts.deleteBatch', [$root->slug])]
        );
    }
}
