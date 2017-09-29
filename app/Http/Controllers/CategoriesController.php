<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Http\Requests\Category\CategoryRequest;

class CategoriesController extends Controller
{
    public function create(CategoryRequest $request) {
        if (!\Auth::check()) {
            return redirect('/');
        }
        $request->session()->forget('flash_success');
        $request->session()->forget('flash_error');
        return view('categories.create');
    }

    public function store(CategoryRequest $request) {
        if (!\Auth::check()) {
            return redirect('/');
        }
        $category = new Category();
        $category->fill($request->all());
        $category->save();
        set_success('カテゴリーを追加しました。');

        $url = $request->url();
        return redirect($request->get('prev_url'));
    }
}
