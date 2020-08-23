<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collective\Html\Eloquent\FormAccessible;

class Post extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title',
        'category_id',
        'body'
    ];

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function category() {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function summary() {
        $tag_removed = preg_replace('/<("[^"]*"|\'[^\']*\'|[^\'">])*>/','',$this->body);
        return mb_substr($tag_removed, 0, 100);
    }
}
