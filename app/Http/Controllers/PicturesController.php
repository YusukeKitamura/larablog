<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picture;

use Input;
use File;
use Image;
use Validator;
use DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PicturesController extends Controller
{
    public function store(Request $request) {
        $image = Input::file('image');

        $validator = Validator::make(compact('image'), [
            'image' => 'required|mimes:jpeg,bmp,png|image|max:1024',
        ]);

        $response = [
            'keep_name'   => null,
            'preview_url' => null,
            'errors'      => [],
        ];

        if ($validator->fails()) {
            $response['errors'] = $validator->errors();
        } else {
            $path = storage_path(). '/app/images/';
            $name = date('YmdHs') . '_' . $image->getClientOriginalName();
            $response['uploaded_name']   = $name;


            DB::transaction(function () use ($image, $path, $name) {
                $image->move($path, $path.$name);
                $row = new Picture;
                $row->storage_path = $name;
                $row->save();
            });
        }
        return redirect($request->get('cur_url'));
    }

    public function response($name)
    {
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
