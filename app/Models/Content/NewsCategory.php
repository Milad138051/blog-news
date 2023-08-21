<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Content\News;


class NewsCategory extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable=['name','description','status'];

    public function news()
    {
        return $this->hasMany(News::class,'category_id');
    }
}
