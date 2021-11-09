<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable;
    protected $fillable = ['title', 'price', 'category_id' ];
    public $sortable = ['id', 'title', 'price', 'category_id' ];
    public function productCategory() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
