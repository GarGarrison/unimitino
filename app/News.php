<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    public $timestamps = false;

    // protected $guarded = ['id',];
    protected $fillable = [
        "title",
        "annotation",
        "text",
        "important",
        "news_date",
        "public_date",
        "unpublic_date",
    ];
}
