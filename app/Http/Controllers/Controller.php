<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // public  static $img_url = "http://localhost:9000";
    public  static $img_url = "https://img.ordhangini.com";

    public function upload_image($file){
        // API endpoint URL
        if($file != null){
        $apiEndpoint = Controller::$img_url.'/image.php';
        $ch = curl_init($apiEndpoint);
        $postData = array(
            'image' =>  new  \CURLFile($file),
            'extension'=>$file->getClientOriginalExtension(),
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Execute cURL session
        return $response = curl_exec($ch);
    }else {
        return null ;
    }
        }

        public function update_img($file,$old_path){
            if($file != null){
            // API endpoint URL
            $apiEndpoint = Controller::$img_url.'/update.php';
           
            $ch = curl_init($apiEndpoint);
            $postData = array(
                'image' =>  new  \CURLFile($file),
                'extension'=>$file->getClientOriginalExtension(),
                'old_path'=>$old_path,
            );
            
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            // Execute cURL session
            return $response = curl_exec($ch);
        }else{
            return null ;
        }
            }

            public function delete_img($old_path){
                
                // API endpoint URL
                $apiEndpoint = Controller::$img_url.'/delete.php';
                            
                $ch = curl_init($apiEndpoint);
                $postData = array(
                    'old_path'=>$old_path,
                );
                
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                
                // Execute cURL session
                return $response = curl_exec($ch);
            
                }


    
}
