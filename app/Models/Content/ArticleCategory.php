<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Content\Article;


class ArticleCategory extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable=['name','description','status'];
	
	    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }

}
