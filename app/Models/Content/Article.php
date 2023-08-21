<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Content\ArticleCategory;


class Article extends Model
{
    use HasFactory, SoftDeletes;

 
    protected $fillable = ['title', 'body','image','status', 'user_id', 'category_id', 'commentable'];
	
	public function comments()
    {
        return $this->morphMany('App\Models\Content\Comment', 'commentable');
    }
		
    public function articleCategory()
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id');
    }   

	public function user()
    {
        return $this->belongsTo(User::class);
    }

	public function activeComments()
    {
        return $this->comments()->orderBy('created_at','desc')->where('status',1)->where('approved',1)->whereNull('parent_id')->get();
    }
	

	
	
}
