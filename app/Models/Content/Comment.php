<?php

namespace App\Models\Content;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Content\Article;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['body', 'parent_id', 'user_id','approved', 'status','commentable_id','commentable_type'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
		
	public function commentable()
    {
        return $this->morphTo();
    }
	
    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function answers()
    {
        return $this->hasMany($this, 'parent_id');
    }   

	public function activeAnswers()
    {
        return $this->answers()->orderBy('created_at','desc')->where('status',1)->where('approved',1)->get();
    }



}
