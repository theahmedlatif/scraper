<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Website;

class Article extends Model
{
    //
    protected $fillable = ['articleTitle', 'articleExcerpt', 'articleURL', 'website_id', ];

    public function website(){
        return $this->belongsTo(Website::class,'website_id','id');
    }
}
