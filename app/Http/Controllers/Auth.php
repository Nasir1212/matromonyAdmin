<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OTP;
use App\Models\AdminAuth;
use App\Models\MultiUserModel;
use App\Mail\SendOTP;
use Mail;


class Auth extends Controller
{
    public function login(Request $req){
       
        if(AdminAuth::where(['mail'=>$req->mail])->where(['password'=>md5($req->password)])->count() >0){
        $req->session()->put('is_login', true);
           return redirect("/");
        }else{
            if(MultiUserModel::where(['email'=>$req->mail])->where(['password'=>md5($req->password)])->count() >0){
                $req->session()->put(['is_login'=> true,'staff'=>true]);
                return redirect("/"); 
            }else{
                return redirect("/login_view")->with(['message'=>'Email or Password not match']);

            }
        }
    }
public function logout(){
    \Session()->flush();
    return redirect("/login_view");

}

public function send_otp(){

   

    $otp  =  rand(100000,999999);
    $mail =  AdminAuth::all()[0]->mail;
    
        $send_otp  =  Mail::to($mail)->send(new SendOTP($otp));
        
        if($send_otp){
          $saving_otp =  OTP::insert([
              'otp'=>$otp,
              'date'=>date("Y-m-d H:i:s")
            
            ]);
            if($saving_otp){
                return view("pages.login.otp_view");
            }
              
        }
   }

   public function checking_otp(Request $req){
    $result = \DB::select("SELECT  `otp` FROM `otp` WHERE  `otp` = '$req->otp' AND NOW() <= DATE_ADD(date, INTERVAL 24 HOUR)");
     if(count($result)>0){
     \Session()->put('change_password_mail', AdminAuth::all()[0]->mail);
     OTP::where(['otp'=>$req->otp])->delete();
     return redirect("/change_password");

     }
   }

   public function handle_change_password(Request $req){

    if($req->password == $req->confirm_password){
        AdminAuth::where(['mail'=>AdminAuth::all()[0]->mail])->update([
            'password'=>md5($req->password),
      ]); 
      \Session()->flush();
      return redirect("/login_view")->with(['condition'=>true,'message'=>'Changed Password ']);
    }else{
        return redirect("/change_password")->with(['message'=>'Password and Confirm Password not match']);
    }
     


   }
    
}
