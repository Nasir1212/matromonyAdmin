<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;
use App\Models\primary_info;
use App\Models\iom_info;
use App\Models\general_info;
use App\Models\address;
use App\Models\education_info;
use App\Models\family_info;
use App\Models\personal_info;
use App\Models\marriage_info;
use App\Models\other_info;
use App\Models\spouse_expect;
use App\Models\ask_authorities;
use App\Models\communication;
use App\Models\session_Id;
use App\Models\visitor;
use App\Models\favorite;
use App\Models\client_contact;
use App\Models\purchase_package;

class home_controller extends Controller
{
   static public function show_all_register(){
        return Register::get(['id','name','mail','gender','is_publish']);
    }

    public function details($id){
       
        return view("pages.details.details",['biodata_id'=>$id]);
    }

    public function publish(Request $req){
       $result =  Register::where(['id'=>$req->id])->update(['is_publish'=>$req->status]);
        if($result){
           return json_encode(["condition"=>true,"message"=>"Updated"]);
        }else{
           return json_encode(["condition"=>false,"message"=>"Updated Failed"]);
        }

    }

    public function clientcontact(){
        $client_contact = client_contact::all();
        return view("pages.clientcontact.clientcontact",['client_contact'=>$client_contact]);
    }

    public function client_message_delete($id){
        $result = client_contact::where(['id'=>$id])->delete();
        if(  $result){
            return redirect("clientcontact")->with(['condition'=>true,'message'=>"Delete Success"]);
        }else{
            return redirect("clientcontact")->with(['condition'=>false,'message'=>"Delete Failed"]);

        }
    }

    public function  buyerpackage(){
       $buyerpackage =  \DB::select("SELECT primary_info.user_name AS purchased_name,general_info.biodata_type ,user.name AS purchaser_name ,purchase_package.payment_date,purchase_package.money,purchase_package.payment_id FROM purchase_package LEFT JOIN primary_info ON primary_info.user_table_id = purchase_package.purchased LEFT JOIN general_info ON general_info.user_table_id = purchase_package.purchased LEFT JOIN user ON  user.id = purchase_package.purchaser");
        return view('pages.buyerpackage.buyerpackage',['buyerpackage'=>$buyerpackage]);
    }

    public function delete_register($id){

   
    primary_info::where(['user_table_id'=>$id])->delete();
    iom_info::where(['user_table_id'=>$id])->delete();
    general_info::where(['user_table_id'=>$id])->delete();
    address::where(['user_table_id'=>$id])->delete();
    education_info::where(['user_table_id'=>$id])->delete();
    family_info::where(['user_table_id'=>$id])->delete();
    personal_info::where(['user_table_id'=>$id])->delete();
    marriage_info::where(['user_table_id'=>$id])->delete();
    other_info::where(['user_table_id'=>$id])->delete();
    spouse_expect::where(['user_table_id'=>$id])->delete();
    ask_authorities::where(['user_table_id'=>$id])->delete();
    communication::where(['user_table_id'=>$id])->delete();
    visitor::where(['user_table_id'=>$id])->delete();
    if(favorite::where(['favoriter'=>$id])->first () != null  ){
     favorite::where(['favoriter'=>$id])->delete();
    }
    if(favorite::where(['favorited'=>$id])->first() != null){
    favorite::where(['favorited'=>$id])->delete();
    }
      Register::where(['id'=>$id])->delete();
     
    return redirect("/list_register_view")->with(['message'=>'Deleted Successfully']);


    }

    public function list_register_view(Request $req){
        if(isset($req->type) &&  $req->type == "new_r"){
        //    return $req;
           $register = \DB::select("SELECT user.*, communication.parent_number FROM user LEFT JOIN communication ON user.id =communication.user_table_id WHERE user.is_seen =0");
            Register::where(['is_seen'=>0])->update(['is_seen'=>1]);
           return view("pages.listRegister.list_register",['register'=>$register]);
        }else if(isset($req->type) &&  $req->type == "up_bi"){
            $register = \DB::select("SELECT user.*, communication.parent_number FROM user LEFT JOIN communication ON user.id =communication.user_table_id WHERE user.is_update =1");
            Register::where(['is_update'=>1])->update(['is_update'=>0]);
           return view("pages.listRegister.list_register",['register'=>$register]);
        } else{
        // $register=  Register::get(['id','name','mail','gender','is_publish']);
        $register = \DB::select("SELECT user.*, communication.parent_number FROM user LEFT JOIN communication ON user.id =communication.user_table_id ORDER BY user.id DESC");
        return view("pages.listRegister.list_register",['register'=>$register]);
        }
        
    }

    public function update_registation(Request $req){
        // return $req;
 $user_id = $req->user_table_id;
   //primary info
   $result=false;
    if($req->t_name=='primary_info'){

        if(primary_info::where(['user_table_id'=>$user_id])->count() ==1){
         $result =    primary_info::where(['user_table_id'=>$user_id])->update([
                'user_name'=>$req->user_name,
                'search_type'=>$req->search_type,
                'date_of_birth'=>$req->date_of_birth,
                'nationality'=>$req->nationality,
                'district'=>$req->district,
                
            ]);
        }else{
            $result =    primary_info::insert([
                'user_name'=>$req->user_name,
                'search_type'=>$req->search_type,
                'date_of_birth'=>$req->date_of_birth,
                'district'=>$req->district,
                'nationality'=>$req->nationality,
                'user_table_id'=> $user_id,
                
            ]);
        }

        //imo info
    }else if($req->t_name=='iom_info'){
        if(iom_info::where(['user_table_id'=>$user_id])->count() ==1){
            $result =    iom_info::where(['user_table_id'=>$user_id])->update([
                'full_name'=>$req->full_name,
                'is_iom_student'=>$req->is_iom_student, 
                'roll_no'=>$req->roll_no,
                'course_and_batch_no'=>$req->course_and_batch_no,
                   
               ]);
              
           }else{
               $result =  iom_info::insert([
                'full_name'=>$req->full_name,
                'is_iom_student'=>$req->is_iom_student,
                'user_table_id'=>$req->user_table_id,
                'roll_no'=>$req->roll_no,
                'course_and_batch_no'=>$req->course_and_batch_no,
                'user_table_id'=>$user_id,
                   
               ]);
           }
   
    }
    else if($req->t_name=='general_info'){
        if(general_info::where(['user_table_id'=>$user_id])->count() ==1){
            $result =    general_info::where(['user_table_id'=>$user_id])->update([
                'biodata_type'=>$req->biodata_type,
                'marid_type'=>$req->marid_type,
                'present_address'=>$req->present_address,
                'divition'=>$req-> divition,
                'permanent_address'=>$req->permanent_address,
                'permanent_divition'=>$req->permanent_divition,
                'birth'=>$req->birth,
                'color'=>$req->color,
                'height'=>$req->height,
                'weight'=>$req->weight,
                'blood_group'=>$req->blood_group,
                'profession'=>$req->profession,
                'monthly_income'=>$req->monthly_income	,
                   
               ]);
              
           }else{
               $result =  general_info::insert([
                'biodata_type'=>$req->biodata_type,
                'marid_type'=>$req->marid_type,
                'present_address'=>$req->present_address,
                'divition'=>$req->divition,
                'permanent_address'=>$req->permanent_address,
                'permanent_divition'=>$req->permanent_divition,
                'birth'=>$req->birth,
                'color'=>$req->color,
                'height'=>$req->height,
                'weight'=>$req->weight,
                'blood_group'=>$req->blood_group,
                'profession'=>$req->profession,
                'monthly_income'=>$req->monthly_income,
                'user_table_id'=>$user_id,
                   
               ]);
               
           }
         
    }

    else if($req->t_name=='address'){
        if(address::where(['user_table_id'=>$user_id])->count() ==1){
            $result = address::where(['user_table_id'=>$user_id])->update([
                'present_address'=>$req->present_address,
                'growing_up'=>$req->growing_up,
                'permanent_address'=>$req->permanent_address,
                   
               ]);
              
           }else{
               $result =  address::insert([
                'present_address'=>$req->present_address,
                'growing_up'=>$req->growing_up,
                'permanent_address'=>$req->permanent_address,
                'user_table_id'=>$user_id,
                   
               ]);
               
           }
         
    }
    else if($req->t_name=='education_info'){
        if(education_info::where(['user_table_id'=>$user_id])->count() ==1){
            $result = education_info::where(['user_table_id'=>$user_id])->update([
                'education_type'=>$req->education_type,
                'is_hafez'=>$req->is_hafez,
                'is_passed_dawrae_hadith'=>$req->is_passed_dawrae_hadith,
                'is_passed_ssc'=>$req->is_passed_ssc,
                'result_ssc'=>$req->result_ssc,
                'divition_ssc'=>$req->divition_ssc,
                'ssc_passed_year'=>$req->ssc_passed_year,
                'is_passed_hsc'=>$req->is_passed_hsc,
                'divition_hsc'=>$req->divition_hsc,
                'result_hsc'=>$req->result_hsc,
                'hsc_passed_year'=>$req->hsc_passed_year,
                'honours_passed'=>$req->honours_passed,
                'honours_passed_year'=>$req->honours_passed_year,
                'highest_education'=>$req->highest_education,
                'other_education'=>$req->other_education,    
                'institute_name'=>$req->institute_name,    
               ]);
              
           }else{
               $result =  education_info::insert([
                'education_type'=>$req->education_type,
                'is_hafez'=>$req->is_hafez,
                'is_passed_dawrae_hadith'=>$req->is_passed_dawrae_hadith,
                'is_passed_ssc'=>$req->is_passed_ssc,
                'result_ssc'=>$req->result_ssc,
                'divition_ssc'=>$req->divition_ssc,
                'ssc_passed_year'=>$req->ssc_passed_year,
                'is_passed_hsc'=>$req->is_passed_hsc,
                'divition_hsc'=>$req->divition_hsc,
                'result_hsc'=>$req->result_hsc,
                'hsc_passed_year'=>$req->hsc_passed_year,
                'honours_passed'=>$req->honours_passed,
                'honours_passed_year'=>$req->honours_passed_year,
                'highest_education'=>$req->highest_education,
                'other_education'=>$req->other_education,
                'institute_name'=>$req->institute_name,
                'user_table_id'=>$user_id,
                   
               ]);
               
           } 
    }

    else if($req->t_name=='family_info'){
      
        if(family_info::where(['user_table_id'=>$user_id])->count() ==1){
            $result = family_info::where(['user_table_id'=>$user_id])->update([
                'father_name'=>$req->father_name,
                'mother_name'=>$req->mother_name,
                'profession_father'=>$req->profession_father,
                'profession_mother'=>$req->profession_mother,
                'sister'=>$req->sister,
                'borther'=>$req->borther,
                'uncle'=>$req->uncle,
                'economic_social_status'=>$req->economic_social_status,
                'islamic_status'=>$req->islamic_status,
                'info_sister'=>$req->info_sister,
                'info_broter'=>$req->info_broter,
               ]);
              
           }else{
               $result =  family_info::insert([
                'father_name'=>$req->father_name,
                'mother_name'=>$req->mother_name,
                'profession_father'=>$req->profession_father,
                'profession_mother'=>$req->profession_mother,
                'sister'=>$req->sister,
                'borther'=>$req->borther,
                'uncle'=>$req->uncle,
                'economic_social_status'=>$req->economic_social_status,
                'islamic_status'=>$req->islamic_status,
                'info_sister'=>$req->info_sister,
                'info_broter'=>$req->info_broter,
                'user_table_id'=>$user_id,
                   
               ]);
               
           } 
    }
    else if($req->t_name=='personal_info'){
        if(personal_info::where(['user_table_id'=>$user_id])->count() ==1){
            $result = personal_info::where(['user_table_id'=>$user_id])->update([
                'beard'=>$req->beard,
                'ankle'=>$req->ankle,
                'prayer'=>$req->prayer,
                'prayer_year'=>$req->prayer_year,
                'mahram_comply'=>$req->mahram_comply,
                'recite_quran'=>$req->recite_quran,
                'wearing_type'=>$req->wearing_type,
                'political_philosophy'=>$req->political_philosophy,
                'entertainment'=>$req->entertainment,
                'disease'=>$req->disease,
                'involved_religion'=>$req->involved_religion,
                'follower_pir'=>$req->follower_pir,
                'shrines'=>$req->shrines,
                'islamic_books'=>$req->islamic_books,
                'scholars_name'=>$req->scholars_name,
                'special_qualifications'=>$req->special_qualifications,
                'write_yourself'=>$req->write_yourself,
                'options_apply'=>$req->options_apply,
                'mazhab'=>$req->mazhab,
                'save_eye'=>$req->save_eye,
                'future_plane'=>$req->future_plane,
                'spend_free_time'=>$req->spend_free_time,
                'congregation_pray'=>$req->congregation_pray,
                'responsibilities_home'=>$req->responsibilities_home,
                'smoking'=>$req->smoking,
               ]);
              
           }else{
               $result =  personal_info::insert([
                'beard'=>$req->beard,
                'ankle'=>$req->ankle,
                'prayer'=>$req->prayer,
                'prayer_year'=>$req->prayer_year,
                'mahram_comply'=>$req->mahram_comply,
                'recite_quran'=>$req->recite_quran,
                'wearing_type'=>$req->wearing_type,
                'political_philosophy'=>$req->political_philosophy,
                'entertainment'=>$req->entertainment,
                'disease'=>$req->disease,
                'involved_religion'=>$req->involved_religion,
                'follower_pir'=>$req->follower_pir,
                'shrines'=>$req->shrines,
                'islamic_books'=>$req->islamic_books,
                'scholars_name'=>$req->scholars_name,
                'special_qualifications'=>$req->special_qualifications,
                'write_yourself'=>$req->write_yourself,
                'options_apply'=>$req->options_apply,
                'mazhab'=>$req->mazhab,
                'save_eye'=>$req->save_eye,
                'future_plane'=>$req->future_plane,
                'spend_free_time'=>$req->spend_free_time,
                'congregation_pray'=>$req->congregation_pray,
                'responsibilities_home'=>$req->responsibilities_home,
                'smoking'=>$req->smoking,
                'user_table_id'=>$user_id,
                   
               ]);
               
           } 
    }
    else if($req->t_name=='marriage_info'){
        if(marriage_info::where(['user_table_id'=>$user_id])->count() ==1){
            $result = marriage_info::where(['user_table_id'=>$user_id])->update([
                'is_agree'=>$req->is_agree,
                'thought_marriage'=>$req->thought_marriage,
                'selection_mind'=>$req->selection_mind,
               ]);
              
           }else{
               $result =  marriage_info::insert([
                'is_agree'=>$req->is_agree,
                'thought_marriage'=>$req->thought_marriage,
                'selection_mind'=>$req->selection_mind,
                'user_table_id'=>$user_id,
                   
               ]);
               
           } 
    }
    else if($req->t_name=='other_info'){
        if(other_info::where(['user_table_id'=>$user_id])->count() ==1){
            $result = other_info::where(['user_table_id'=>$user_id])->update([
                'asking'=>$req->asking,
                'profession'=>$req->profession,
               ]);
              
           }else{
               $result =  other_info::insert([
                'asking'=>$req->asking,
                'profession'=>$req->profession,
                'user_table_id'=>$user_id,
                   
               ]);
               
           } 
    }
    else if($req->t_name=='spouse_expect'){
        if( spouse_expect::where(['user_table_id'=>$user_id])->count() ==1){
            $result =  spouse_expect::where(['user_table_id'=>$user_id])->update([
                'year_old'=>$req->year_old,
                'color'=>$req->color,
                'min_height'=>$req->min_height,
                'min_education'=>$req->min_education,
                'marid_status'=>$req->marid_status,
                'profession'=>$req->profession,
                'economic_status'=>$req->economic_status,
                'family_status'=>$req->family_status,
                'spouse_expection'=>$req->spouse_expection,
                'character_spouse'=>$req->character_spouse,
               ]);
              
           }else{
               $result =   spouse_expect::insert([
                'year_old'=>$req->year_old,
                'color'=>$req->color,
                'min_height'=>$req->min_height,
                'min_education'=>$req->min_education,
                'marid_status'=>$req->marid_status,
                'profession'=>$req->profession,
                'economic_status'=>$req->economic_status,
                'family_status'=>$req->family_status,
                'spouse_expection'=>$req->spouse_expection,
                'character_spouse'=>$req->character_spouse,
                'user_table_id'=>$user_id,
                   
               ]);
               
           } 
    }
    else if($req->t_name=='communication'){
        if( communication::where(['user_table_id'=>$user_id])->count() ==1){
            $result =  communication::where(['user_table_id'=>$user_id])->update([
                'parent_number'=>$req->parent_number,
                'who_wrote_number'=>$req->who_wrote_number,
                'email_recived_biodata'=>$req->email_recived_biodata,
                'number_visible_authority'=>$req->number_visible_authority,
               ]);
              
           }else{
               $result =   communication::insert([
                'parent_number'=>$req->parent_number,
                'who_wrote_number'=>$req->who_wrote_number,
                'email_recived_biodata'=>$req->email_recived_biodata,
                'number_visible_authority'=>$req->number_visible_authority,
                'user_table_id'=>$user_id,
                   
               ]);
               
           } 
    }
    else if($req->t_name=='ask_authorities'){
        if( ask_authorities::where(['user_table_id'=>$user_id])->count() ==1){
            $result =  ask_authorities::where(['user_table_id'=>$user_id])->update([
                'submitted_biodata_allowed'=>$req->submitted_biodata_allowed,
                'is_true_information'=>$req->is_true_information,
                'authority_responsibility'=>$req->authority_responsibility,
               ]);
              
           }else{
               $result =   ask_authorities::insert([
                'submitted_biodata_allowed'=>$req->submitted_biodata_allowed,
                'is_true_information'=>$req->is_true_information,
                'authority_responsibility'=>$req->authority_responsibility,
                'user_table_id'=>$user_id,
                   
               ]);
               
           } 
    }
    return redirect("/details/$user_id")->with(['message'=>'Updated Successfully']);
    }

   



}
