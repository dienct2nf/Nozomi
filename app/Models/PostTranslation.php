<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class PostTranslation extends Model
{
    /**
     * default
     * @var bool $timestamps
     * @var array $fillable
     * */

    public $timestamps = false;
    protected $fillable = ['title', 'content', 'description', 'title_seo', 'description_seo'];

    protected $searchable = [
        'title',
        'content'
    ];

    protected function fullTextWildcards($term)
    {
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach ($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */
            if (strlen($word) >= 2) {
                $words[$key] = '+' . $word . '*';
            }
        }

        $searchTerm = implode(' ', $words);

        return $searchTerm;
    }

    /**
     * Scope a query that matches a full text search of term.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        $columns = implode(',', $this->searchable);

        $query->select(DB::Raw('posts.*, post_translations.*'))->join('posts', 'posts.id', '=', 'post_translations.post_id')->where('locale', 'vi')->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $this->fullTextWildcards($term));

        return $query;
    }

    /**
     * Scope a query that matches a full text search of term.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchCategory($query, $term, $id)
    {
        $columns = implode(',', $this->searchable);

        $query->select(DB::Raw('posts.*, post_translations.*'))
        ->join('posts', 'posts.id', '=', 'post_translations.post_id')
        ->join('category_post', 'category_post.post_id', '=', 'posts.id')
        ->where('locale', 'vi')
        ->where('category_post.category_id', $id)
        ->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $this->fullTextWildcards($term));
        return $query;
    }
}

