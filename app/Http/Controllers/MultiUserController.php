<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MultiUserModel;


class MultiUserController extends Controller
{
    public function multi_user_page(Request $req){
       $users =  MultiUserModel::all();
        return view("pages.multi_user.multi_user_page",['users'=>$users]);
    }

    public function add_user(Request $req){
        $req->validate([
            'full_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        MultiUserModel::insert([
            'full_name'=>$req->full_name,
            'email'=>$req->email,
            'password'=>md5($req->password),
        ]);
        return back()->with(['condition'=>true, 'message'=>'User added successfully']);

    }

    public function update_user(Request $req){
        $req->validate([
            'full_name' => 'required',
            'email' => 'required',
            
        ]);
        if($req->password==null){
           
            MultiUserModel::where(['id'=>$req->id])->update([
                'full_name'=>$req->full_name,
                'email'=>$req->email,
            ]);
        }else{
            
            MultiUserModel::where(['id'=>$req->id])->update([
                'full_name'=>$req->full_name,
                'email'=>$req->email,
                'password'=>md5($req->password),
            ]);
    }
        return back()->with(['condition'=>true, 'message'=>'User Updated successfully']);

    }

    public function user_delete(Request $req){
       
        MultiUserModel::where(['id'=>$req->id])->delete();
        return back()->with(['condition'=>true, 'message'=>'User Deleted successfully']);

    }

   
}
