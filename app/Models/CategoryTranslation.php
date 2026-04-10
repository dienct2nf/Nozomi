<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    /**
     * @var timestamps | datetime
     * @var fillable | array
     * */
    public $timestamps = false;
    protected $fillable = ['title', 'content', 'description', 'title_seo', 'description_seo'];

}
