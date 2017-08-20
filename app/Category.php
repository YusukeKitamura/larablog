<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collective\Html\Eloquent\FormAccessible;

class Category extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'category_name',
    ];

    public function posts1() {
        return $this->hasMany('App\Post', 'category1_id');
    }

    public function posts2() {
        return $this->hasMany('App\Post', 'category2_id');
    }
}
