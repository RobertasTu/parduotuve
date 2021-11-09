<?php

namespace App;
use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use Sortable;
    protected $fillable = ['title', 'country' ];
    public $sortable = ['id', 'title', 'country' ];
}
