<?php

namespace App;

use Ibec\Content\Post;
use Ibec\Content\PostNode;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'name', 'phone', 'post_id'
    ];

    public function product()
    {
        return $this->HasOne(PostNode::class, 'post_id');
    }
}
