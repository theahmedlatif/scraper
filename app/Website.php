<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Article;

class Website extends Model
{
    //
    protected $fillable = ['websiteName', 'url', 'titleDOM', 'excerptDOM', 'urlDOM', 'lastScrap' ];

    public function articles(){
        return $this->hasMany(Article::class,'website_id','id');
    }
}
