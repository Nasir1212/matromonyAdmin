<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BlogModel;
use App\Models\PopUpMessage;

class BlogController extends Controller
{
    public function create_blogs_page(Request $req){
        return view("pages.blogs.create_blogs_page");
    }

    public function edit_blog_page(Request $req,$id){
        $blog =  BlogModel::where('id',$id)->first();
    
        return view("pages.blogs.edit_blog_page",['blog'=>$blog]);
    }

    public function create_blogs(Request $req){       
        BlogModel::insert([
            'title'=>$req->title,
            'blog'=>$req->blog,
            'img_path'=> $this->upload_image($req->file("img_path")),
        ]);
        return back()->with(['condition'=>true, 'message'=>'data submitted successfully']);
    }

    public function all_blog(Request $req){
        $blogs = BlogModel::all();
        return view("pages.blogs.all_blog",['blogs'=>$blogs]);
    }

    public function update_blog(Request $req){
        
        if(is_file($req->file("img_path"))){
          
            BlogModel::where(['id'=>$req->id])->update([
                'title'=>$req->title,
                'blog'=>$req->blog,
                'img_path'=> $this->update_img($req->file("img_path"),$req->old_img_path),
            ]);
         

        }else{
            BlogModel::where(['id'=>$req->id])->update([
                'title'=>$req->title,
                'blog'=>$req->blog,
            ]);
        }
        return back()->with(['condition'=>true, 'message'=>'data Updated successfully']);

       
    }

    public function delete_blog(Request $req){

        $this->delete_img(BlogModel::where(['id'=>$req->id])->first(['img_path'])->img_path);
        BlogModel::where(['id'=>$req->id])->delete();
        return back()->with(['condition'=>true, 'message'=>'data Deleted successfully']);

    }

    public function update_popup(Request $req){
       
        PopUpMessage::where(['id'=>$req->id])->update([
            'title'=>$req->title,
            'message'=>$req->message,
            'date'=>$today = date("Y-m-d H:i:s")
        ]);

        return back()->with(['condition'=>true, 'message'=>'data submited successfully']);

    }
}
