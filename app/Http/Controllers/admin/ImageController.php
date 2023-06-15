<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function imagesLoad(){
         $images=Image::join('users', 'users.id', '=', 'images.user_id')
         ->select('users.name', 'images.file_name','images.user_id','images.id')
         ->orderBy('images.id','desc')
         ->paginate(2);
         //print_r($images);
        return view('admin.images',['images'=>$images]);
    }
    public function addImages(){
       $users=User::where('remember_token','=','Y')
        ->orderBy('id','desc')
        ->get();
        return view('admin.add_image',['users'=>$users]);
    }
    public function imageUpload(Request $request){
        $img=$request->validate([
           'file'=>'required|image|max:4000'
        ]);
        //get file extension and save to db and folder

        $image = $request->file('file');

        $filename = uniqid() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images'), $filename);

        $imageModel = new Image();
        //$imageModel->name = $image->getClientOriginalName();
        $imageModel->file_name = $filename;
        $imageModel->user_id=$request->user_id;
        $imageModel->save();
        return redirect()->route('admin.images')->with('msg','Image Uploaded Successfully..');
    }
    public function deleteImage(Request $request){
          //delete file from folder
           
          //delete row from db

          $img=Image::where('id','=',$request->id)->first();
          $img_name=public_path('images').'/'.$img->file_name;
          $img->delete();
          if (File::exists($img_name)) {
            File::delete($img_name);
          }
          return redirect()->route('admin.images')->with('delete',$img_name);
    }
}
