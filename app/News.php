<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class News extends Model
{
    use Sortable;

    protected $fillable = [
        'title',
        'content',
        'is_published'
    ];
    public $sortable = [
        'title',
        'content',
        'is_published'
    ];

}
