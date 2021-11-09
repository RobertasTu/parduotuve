<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{   use Sortable;
    protected $fillable = ['title', 'shop_id' ];
    public $sortable = ['id', 'title', 'shop_id' ];
    public function categoryShop() {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');

    }
    public function categoryProducts() {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
