<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picture;

use Input;
use File;
use Image;
use Validator;
use DB;
use App\Http\Requests\Picture\PictureRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PicturesController extends Controller
{
    public function store(PictureRequest $request) {
        if (!\Auth::check()) {
            return redirect('/');
        }
        $image = Input::file('image');

        $response = [
            'keep_name'   => null,
            'preview_url' => null,
            'errors'      => [],
        ];

        $path = storage_path(). '/app/images/';
        $name = date('YmdHs') . '_' . $image->getClientOriginalName();
        $response['uploaded_name']   = $name;


        DB::transaction(function () use ($image, $path, $name) {
            $image->move($path, $path.$name);
            $row = new Picture;
            $row->storage_path = $name;
            $row->save();
        });
        return redirect($request->get('cur_url'))->with('flash_message', '画像を追加しました!');
    }

    public function response($name)
    {
        //if (!\Auth::check()) {
        //    return redirect('/');
        //}
        $name = preg_replace('#\.\.\/#', '', $name);

        $path      = storage_path().'/app/images/';
        $file_path = $path.$name;
        
        if (!File::exists($file_path)) {
            abort(404);
        }
        $image = Image::make($file_path);

        return $image->response();
    }
}
