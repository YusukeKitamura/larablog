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
        'category1_id',
        'category2_id',
        'body'
    ];

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function category1() {
        return $this->belongsTo('App\Category', 'category1_id');
    }

    public function category2() {
        return $this->belongsTo('App\Category', 'category2_id');
    }
}
