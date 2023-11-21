

<?php 
$exp = explode('/',url()->current()) ;
$user_id = $exp[count($exp)-1];
?>
<div class="modal fade" id="primary_info" tabindex="-1" role="dialog" aria-labelledby="primary_infoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="primary_infoLabel">প্রথমিক তথ্য</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <?php  $primary_info =  App\Models\primary_info::where(['user_table_id'=>$user_id])->first() ?>

            <form name="primary_info"  action="{{URL::to("/update_registation")}}" method="POST" >

                <input type="hidden" name="user_table_id" value="{{$user_id}}">
                <div class="card mb-3 " >
                <div class="card-body">
                <div class="form-group">
                <label for="ব্যবহৃত নাম (Primary)" class="font-weight-bold">ব্যবহৃত নাম (Primary)  </label>
                <input type="text" class="form-control" name="user_name" value="@if($primary_info != null) {{$primary_info->user_name}} @endif" placeholder="ব্যবহৃত নাম (Primary)">
                <input type="hidden" name="t_name" value="primary_info">
                </div>
                </div>
                </div>
                <div class="card mb-3 class" data-condtion id="id">
                <div class="card-body">
                <div class="form-group">
                <label for="আমি খুঁজছি" class="font-weight-bold">আমি খুঁজছি </label>
                <select class="form-control" name="search_type" id="field_10" data-id="10" data-group="8" placeholder="আমি খুঁজছি">
                <option value=''>Select</option>
                <option value="1" <?php if($primary_info != null){ if($primary_info->search_type == '1') echo "Selected"; }?> >পাত্রীর বায়োডাটা</option>
                <option value="2" <?php if($primary_info != null){ if($primary_info->search_type == '2') echo "Selected";  } ?>>পাত্রের বায়োডাটা</option>
                </select>
                </div>
                </div>
                </div>
                <div class="card mb-3 " >
                <div class="card-body">
                <div class="form-group">
                <label for="date_of_birth" class="font-weight-bold">জন্ম তারিখ </label>
                <input type="text" class="form-control" onclick=" handle_birth_day(this)"  name="date_of_birth" id="date_of_birth" value="@if($primary_info != null) {{$primary_info->date_of_birth}} @endif" placeholder = "yyyy-mm-dd">
                <p class="text-danger d-none">Enter valid birth day </p>
                </div>
                </div>
                </div>
                <div class="card mb-3 class" data-condtion id="id">
                <div class="card-body">
                <div class="form-group">
                <label for="জেলা" class="font-weight-bold">জেলা </label>
                <select class="form-control" name="district"  id="field_15" data-id="15" data-group="8" placeholder="জেলা">
                <option value>Select</option>
                @foreach( App\Models\districts::get() as $district ) 
                <option value="{{$district->id}}" @if($primary_info != null) @if($primary_info->district==$district->id) {{"Selected"}} @endif @endif>{{$district->bn_name}}</option>
                @endforeach
                </select>
                
                </div>
                </div>
                </div>
                <div class="card mb-3 class" data-condtion id="id">
                <div class="card-body">
                <div class="form-group">
                <label for="জাতীয়তা" class="font-weight-bold">জাতীয়তা </label>
                <select class="form-control" name="nationality"  id="field_16" data-id="16" data-group="8" placeholder="জাতীয়তা">
                <option value>Select</option>
                <option value="1" selected>বাংলাদেশী</option>
                </select>
                
                </div>
                </div>
                </div>

                @csrf
                <div class="form-group">
                <button class="btn btn-success btn-block btn-sm">Edit</button>
                </div>
                    
                
                </form>
                </div>
        </div>
      </div>
    </div>


    

<div class="modal fade" id="general_info" tabindex="-1" role="dialog" aria-labelledby="general_infoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="general_infoLabel">সাধারণ তথ্য</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form  name="general_info"  action="{{URL::to("/update_registation")}}"  method="POST" >
                <?php  $general_info =  App\Models\general_info::where(['user_table_id'=>$user_id])->first() ?>
                <input type="hidden" name="user_table_id" value="{{$user_id}}">

            <div class="card mb-3 class" >
            <div class="card-body">
            <div class="form-group">
            <label for="বায়োডাটার ধরন *" class="font-weight-bold">বায়োডাটার ধরন * </label>
            <select class="form-control" name="biodata_type" placeholder="বায়োডাটার ধরন *">
            <option value>Select</option>
            <option value="1" @if($general_info != null) @if($general_info->biodata_type=="1") {{"Selected"}} @endif @endif>পাত্রের বায়োডাটা</option>
            <option value="2" @if($general_info != null) @if($general_info->biodata_type=="2") {{"Selected"}} @endif @endif>পাত্রীর বায়োডাটা</option>
            </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="বৈবাহিক অবস্থা" class="font-weight-bold">বৈবাহিক অবস্থা <span class="text-mute">(Required)</span></label>
            <select class="form-control" name="marid_type"  placeholder="বৈবাহিক অবস্থা" required>
            <option value>Select</option>
            <option value="অবিবাহিত" @if($general_info != null) @if($general_info->marid_type=="অবিবাহিত") {{"Selected"}} @endif @endif>অবিবাহিত</option>
            <option value="বিবাহিত" @if($general_info != null) @if($general_info->marid_type=="বিবাহিত") {{"Selected"}} @endif @endif>বিবাহিত</option>
            <option value="ডিভোর্সড" @if($general_info != null) @if($general_info->marid_type=="ডিভোর্সড") {{"Selected"}} @endif @endif>ডিভোর্সড</option>
            <option value="বিধবা" @if($general_info != null) @if($general_info->marid_type=="বিধবা") {{"Selected"}} @endif @endif>বিধবা</option>
            <option value="বিপত্নীক" @if($general_info != null) @if($general_info->marid_type=="বিপত্নীক") {{"Selected"}} @endif @endif>বিপত্নীক</option>
            </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="বর্তমান ঠিকানা *" class="font-weight-bold">বর্তমান ঠিকানা * </label>
            <select class="form-control" name="present_address"  id="field_22" data-id="22" data-group="10" placeholder="বর্তমান ঠিকানা *">
            <option value>Select</option>
            @foreach( App\Models\districts::get() as $district ) 
            <option value="{{$district->id}}" @if($general_info != null) @if($general_info->present_address==$district->id) {{"Selected"}} @endif @endif>{{$district->bn_name}}</option>
            @endforeach
            </select>
            </div>
            </div>
            </div>
            <div class="card mb-3 class" >
            <div class="card-body">
            <div class="form-group">
            <label for="বিভাগ *" class="font-weight-bold">বিভাগ * </label>
            <select class="form-control" name="divition"  id="field_23" data-id="23" data-group="10" placeholder="বিভাগ *">
            <option value>Select</option>
            
            @foreach( App\Models\divisions::get() as $divisions ) 
            <option value="{{$divisions->id}}" @if($general_info != null) @if($general_info->divition==$divisions->id) {{"Selected"}} @endif @endif>{{$divisions->bn_name}}</option>
            @endforeach
            </select>
            </div>
            </div>
            </div>
            <div class="card mb-3 class">
            <div class="card-body">
            <div class="form-group">
            <label for="স্থায়ী ঠিকানা *" class="font-weight-bold">স্থায়ী ঠিকানা * <span class="text-mute">(Required)</span></label>
            <select class="form-control" name="permanent_address" id="field_24" data-id="24" data-group="10" placeholder="স্থায়ী ঠিকানা *" required>
            <option value>Select</option>
            @foreach( App\Models\districts::get() as $district ) 
            <option value="{{$district->id}}" @if($general_info != null) @if($general_info->permanent_address==$district->id) {{"Selected"}} @endif @endif>{{$district->bn_name}}</option>
            @endforeach
            </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="বিভাগ *" class="font-weight-bold">বিভাগ * </label>
            <select class="form-control" name="permanent_divition"  id="field_25" data-id="25" data-group="10" placeholder="বিভাগ *">
            
                @foreach( App\Models\divisions::get() as $divisions ) 
                <option value="{{$divisions->id}}" @if($general_info != null) @if($general_info->permanent_divition==$divisions->id) {{"Selected"}} @endif @endif>{{$divisions->bn_name}}</option>
                @endforeach
            </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="জন্মসন (আসল) *" class="font-weight-bold">জন্মসন (আসল) * </label>
            <select class="form-control" name="birth"  id="field_26" data-id="26" data-group="10" placeholder="জন্মসন (আসল) *">
            <option value>Select</option>
            <option value="১৯৭০" @if($general_info != null) @if($general_info->birth=="১৯৭০") {{"Selected"}} @endif @endif>১৯৭০</option>
            <option value="১৯৭১" @if($general_info != null) @if($general_info->birth=="১৯৭১") {{"Selected"}} @endif @endif>১৯৭১</option>
            <option value="১৯৭২" @if($general_info != null) @if($general_info->birth=="১৯৭২") {{"Selected"}} @endif @endif>১৯৭২</option>
            <option value="১৯৭৩" @if($general_info != null) @if($general_info->birth=="১৯৭৩") {{"Selected"}} @endif @endif>১৯৭৩</option>
            <option value="১৯৭৪" @if($general_info != null) @if($general_info->birth=="১৯৭৪") {{"Selected"}} @endif @endif>১৯৭৪</option>
            <option value="১৯৭৫" @if($general_info != null) @if($general_info->birth=="১৯৭৫") {{"Selected"}} @endif @endif>১৯৭৫</option>
            <option value="১৯৭৬" @if($general_info != null) @if($general_info->birth=="১৯৭৬") {{"Selected"}} @endif @endif>১৯৭৬</option>
            <option value="১৯৭৭" @if($general_info != null) @if($general_info->birth=="১৯৭৭") {{"Selected"}} @endif @endif>১৯৭৭</option>
            <option value="১৯৭৮" @if($general_info != null) @if($general_info->birth=="১৯৭৮") {{"Selected"}} @endif @endif>১৯৭৮</option>
            <option value="১৯৭৯" @if($general_info != null) @if($general_info->birth=="১৯৭৯") {{"Selected"}} @endif @endif>১৯৭৯</option>
            <option value="১৯৮০" @if($general_info != null) @if($general_info->birth=="১৯৮০") {{"Selected"}} @endif @endif>১৯৮০</option>
            <option value="১৯৮১" @if($general_info != null) @if($general_info->birth=="১৯৮১") {{"Selected"}} @endif @endif>১৯৮১</option>
            <option value="১৯৮২" @if($general_info != null) @if($general_info->birth=="১৯৮২") {{"Selected"}} @endif @endif>১৯৮২</option>
            <option value="১৯৮৩" @if($general_info != null) @if($general_info->birth=="১৯৮৩") {{"Selected"}} @endif @endif>১৯৮৩</option>
            <option value="১৯৮৪" @if($general_info != null) @if($general_info->birth=="১৯৮৪") {{"Selected"}} @endif @endif>১৯৮৪</option>
            <option value="১৯৮৫" @if($general_info != null) @if($general_info->birth=="১৯৮৫") {{"Selected"}} @endif @endif>১৯৮৫</option>
            <option value="১৯৮৬" @if($general_info != null) @if($general_info->birth=="১৯৮৬") {{"Selected"}} @endif @endif>১৯৮৬</option>
            <option value="১৯৮৭" @if($general_info != null) @if($general_info->birth=="১৯৮৭") {{"Selected"}} @endif @endif>১৯৮৭</option>
            <option value="১৯৮৮" @if($general_info != null) @if($general_info->birth=="১৯৮৮") {{"Selected"}} @endif @endif>১৯৮৮</option>
            <option value="১৯৮৯" @if($general_info != null) @if($general_info->birth=="১৯৮৯") {{"Selected"}} @endif @endif>১৯৮৯</option>
            <option value="১৯৯০" @if($general_info != null) @if($general_info->birth=="১৯৯০") {{"Selected"}} @endif @endif>১৯৯০</option>
            <option value="১৯৯১" @if($general_info != null) @if($general_info->birth=="১৯৯১") {{"Selected"}} @endif @endif>১৯৯১</option>
            <option value="১৯৯২" @if($general_info != null) @if($general_info->birth=="১৯৯২") {{"Selected"}} @endif @endif>১৯৯২</option>
            <option value="১৯৯৩" @if($general_info != null) @if($general_info->birth=="১৯৯৩") {{"Selected"}} @endif @endif>১৯৯৩</option>
            <option value="১৯৯৪" @if($general_info != null) @if($general_info->birth=="১৯৯৪") {{"Selected"}} @endif @endif>১৯৯৪</option>
            <option value="১৯৯৫" @if($general_info != null) @if($general_info->birth=="১৯৯৫") {{"Selected"}} @endif @endif>১৯৯৫</option>
            <option value="১৯৯৬" @if($general_info != null) @if($general_info->birth=="১৯৯৬") {{"Selected"}} @endif @endif>১৯৯৬</option>
            <option value="১৯৯৭" @if($general_info != null) @if($general_info->birth=="১৯৯৭") {{"Selected"}} @endif @endif>১৯৯৭</option>
            <option value="১৯৯৮" @if($general_info != null) @if($general_info->birth=="১৯৯৮") {{"Selected"}} @endif @endif>১৯৯৮</option>
            <option value="১৯৯৯" @if($general_info != null) @if($general_info->birth=="১৯৯৯") {{"Selected"}} @endif @endif>১৯৯৯</option>
            <option value="২০০০" @if($general_info != null) @if($general_info->birth=="২০০০") {{"Selected"}} @endif @endif>২০০০</option>
            <option value="২০০১" @if($general_info != null) @if($general_info->birth=="২০০১") {{"Selected"}} @endif @endif>২০০১</option>
            <option value="২০০২" @if($general_info != null) @if($general_info->birth=="২০০২") {{"Selected"}} @endif @endif>২০০২</option>
            <option value="২০০৩" @if($general_info != null) @if($general_info->birth=="২০০৩") {{"Selected"}} @endif @endif>২০০৩</option>
            <option value="২০০৪" @if($general_info != null) @if($general_info->birth=="২০০৪") {{"Selected"}} @endif @endif>২০০৪</option>
            <option value="২০০৫" @if($general_info != null) @if($general_info->birth=="২০০৫") {{"Selected"}} @endif @endif>২০০৫</option>
            <option value="২০০৬" @if($general_info != null) @if($general_info->birth=="২০০৬") {{"Selected"}} @endif @endif>২০০৬</option>
            <option value="২০০৭" @if($general_info != null) @if($general_info->birth=="২০০৭") {{"Selected"}} @endif @endif>২০০৭</option>
            <option value="২০০৮" @if($general_info != null) @if($general_info->birth=="২০০৮") {{"Selected"}} @endif @endif>২০০৮</option>
            <option value="২০০৯" @if($general_info != null) @if($general_info->birth=="২০০৯") {{"Selected"}} @endif @endif>২০০৯</option>
            <option value="২০১০" @if($general_info != null) @if($general_info->birth=="২০১০") {{"Selected"}} @endif @endif>২০১০</option>
            </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="গাত্রবর্ণ" class="font-weight-bold">গাত্রবর্ণ <span class="text-mute">(Required)</span></label>
            <select class="form-control" name="color"  id="field_27" data-id="27" data-group="10" placeholder="গাত্রবর্ণ" required>
            <option value>Select</option>
            <option value="কালো" @if($general_info != null) @if($general_info->color=="কালো") {{"Selected"}} @endif @endif>কালো</option>
            <option value="শ্যামলা" @if($general_info != null) @if($general_info->color=="শ্যামলা") {{"Selected"}} @endif @endif>শ্যামলা</option>
            <option value="উজ্জ্বল শ্যামলা" @if($general_info != null) @if($general_info->color=="উজ্জ্বল শ্যামলা") {{"Selected"}} @endif @endif>উজ্জ্বল শ্যামলা</option>
            <option value="ফর্সা" @if($general_info != null) @if($general_info->color=="ফর্সা") {{"Selected"}} @endif @endif>ফর্সা</option>
            <option value="উজ্জ্বল ফর্সা" @if($general_info != null) @if($general_info->color=="উজ্জ্বল ফর্সা") {{"Selected"}} @endif @endif>উজ্জ্বল ফর্সা</option>
            </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="উচ্চতা" class="font-weight-bold">উচ্চতা <span class="text-mute">(Required)</span></label>
            <select class="form-control" name="height"  id="field_54" data-id="54" data-group="10" placeholder="উচ্চতা" required>
            <option value>Select</option>
            <option value="1" @if($general_info != null)  @if($general_info->height=="1") {{"Selected"}} @endif @endif>৪&#039;১&#039;&#039;</option>
            <option value="2" @if($general_info != null)  @if($general_info->height=="2") {{"Selected"}} @endif @endif>৪&#039;২&#039;&#039;</option>
            <option value="3" @if($general_info != null)  @if($general_info->height=="3") {{"Selected"}} @endif @endif>৪&#039;৩&#039;&#039;</option>
            <option value="4" @if($general_info != null)  @if($general_info->height=="4") {{"Selected"}} @endif @endif>৪&#039;৪&#039;&#039;</option>
            <option value="5" @if($general_info != null)  @if($general_info->height=="5") {{"Selected"}} @endif @endif>৪&#039;৫&#039;&#039;</option>
            <option value="6" @if($general_info != null)  @if($general_info->height=="6") {{"Selected"}} @endif @endif>৪&#039;৬&#039;&#039;</option>
            <option value="7" @if($general_info != null)  @if($general_info->height=="7") {{"Selected"}} @endif @endif>৪&#039;৭&#039;&#039;</option>
            <option value="8" @if($general_info != null)  @if($general_info->height=="8") {{"Selected"}} @endif @endif>৪&#039;৮&#039;&#039;</option>
            <option value="9" @if($general_info != null)  @if($general_info->height=="9") {{"Selected"}} @endif @endif>৪&#039;৯&#039;&#039;</option>
            <option value="10" @if($general_info != null)  @if($general_info->height=="10") {{"Selected"}} @endif @endif>৪&#039;১০&#039;&#039;</option>
            <option value="11" @if($general_info != null)  @if($general_info->height=="11") {{"Selected"}} @endif @endif>৪&#039;১১&#039;&#039;</option>
            <option value="12" @if($general_info != null)  @if($general_info->height=="12") {{"Selected"}} @endif @endif>৪&#039;১২&#039;&#039;</option>
            <option value="13" @if($general_info != null)  @if($general_info->height=="13") {{"Selected"}} @endif @endif>৫&#039;০&#039;&#039;</option>
            <option value="14" @if($general_info != null)  @if($general_info->height=="14") {{"Selected"}} @endif @endif>৫&#039;১&#039;&#039;</option>
            <option value="15" @if($general_info != null)  @if($general_info->height=="15") {{"Selected"}} @endif @endif>৫&#039;২&#039;&#039;</option>
            <option value="16" @if($general_info != null)  @if($general_info->height=="16") {{"Selected"}} @endif @endif>৫&#039;৩&#039;&#039;</option>
            <option value="17" @if($general_info != null)  @if($general_info->height=="17") {{"Selected"}} @endif @endif>৫&#039;৪&#039;&#039;</option>
            <option value="18" @if($general_info != null)  @if($general_info->height=="18") {{"Selected"}} @endif @endif>৫&#039;৫&#039;&#039;</option>
            <option value="19" @if($general_info != null)  @if($general_info->height=="19") {{"Selected"}} @endif @endif>৫&#039;৬&#039;&#039;</option>
            <option value="20" @if($general_info != null)  @if($general_info->height=="20") {{"Selected"}} @endif @endif>৫&#039;৭&#039;&#039;</option>
            <option value="21" @if($general_info != null)  @if($general_info->height=="21") {{"Selected"}} @endif @endif>৫&#039;৮&#039;&#039;</option>
            <option value="22" @if($general_info != null)  @if($general_info->height=="22") {{"Selected"}} @endif @endif>৫&#039;৯&#039;&#039;</option>
            <option value="23" @if($general_info != null)  @if($general_info->height=="23") {{"Selected"}} @endif @endif>৫&#039;১০&#039;&#039;</option>
            <option value="24" @if($general_info != null)  @if($general_info->height=="24") {{"Selected"}} @endif @endif>৫&#039;১১&#039;&#039;</option>
            <option value="25" @if($general_info != null)  @if($general_info->height=="25") {{"Selected"}} @endif @endif>৫&#039;১২&#039;&#039;</option>
            <option value="26" @if($general_info != null)  @if($general_info->height=="26") {{"Selected"}} @endif @endif>৬&#039;০&#039;&#039;</option>
            <option value="27" @if($general_info != null)  @if($general_info->height=="27") {{"Selected"}} @endif @endif>৬&#039;১&#039;&#039;</option>
            <option value="28" @if($general_info != null)  @if($general_info->height=="28") {{"Selected"}} @endif @endif>৬&#039;২&#039;&#039;</option>
            <option value="29" @if($general_info != null)  @if($general_info->height=="29") {{"Selected"}} @endif @endif>৬&#039;৩&#039;&#039;</option>
            <option value="30" @if($general_info != null)  @if($general_info->height=="30") {{"Selected"}} @endif @endif>৬&#039;৪&#039;&#039;</option>
            <option value="31" @if($general_info != null)  @if($general_info->height=="31") {{"Selected"}} @endif @endif>৬&#039;৫&#039;&#039;</option>
            <option value="32" @if($general_info != null)  @if($general_info->height=="32") {{"Selected"}} @endif @endif>৬&#039;৬&#039;&#039;</option>
            <option value="33" @if($general_info != null)  @if($general_info->height=="33") {{"Selected"}} @endif @endif>৬&#039;৭&#039;&#039;</option>
            <option value="34" @if($general_info != null)  @if($general_info->height=="34") {{"Selected"}} @endif @endif>৬&#039;৮&#039;&#039;</option>
            <option value="35" @if($general_info != null)  @if($general_info->height=="35") {{"Selected"}} @endif @endif>৬&#039;৯&#039;&#039;</option>
            <option value="36" @if($general_info != null)  @if($general_info->height=="36") {{"Selected"}} @endif @endif>৬&#039;১০&#039;&#039;</option>
            <option value="37" @if($general_info != null)  @if($general_info->height=="37") {{"Selected"}} @endif @endif>৬&#039;১১&#039;&#039;</option>
            <option value="38" @if($general_info != null)  @if($general_info->height=="38") {{"Selected"}} @endif @endif>৬&#039;১২&#039;&#039;</option>
            </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="ওজন" class="font-weight-bold">ওজন <span class="text-mute">(Required)</span></label>
            <input type="text" class="form-control" name="weight"  value="@if($general_info != null){{$general_info->weight}} @endif" placeholder="ওজন">
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="রক্তের গ্রুপ *" class="font-weight-bold">রক্তের গ্রুপ * <span class="text-mute">(Required)</span></label>
            <select class="form-control" name="blood_group" id="field_56" data-id="56" data-group="10" placeholder="রক্তের গ্রুপ *" required>
            <option value>Select</option>
            <option value="A+"  @if($general_info != null) @if($general_info->blood_group=="A+") {{"Selected"}} @endif @endif>A+</option>
            <option value="A-"  @if($general_info != null) @if($general_info->blood_group=="A-") {{"Selected"}} @endif @endif>A-</option>
            <option value="AB+"  @if($general_info != null) @if($general_info->blood_group=="AB+") {{"Selected"}} @endif @endif>AB+</option>
            <option value="AB-"  @if($general_info != null) @if($general_info->blood_group=="AB-") {{"Selected"}} @endif @endif>AB-</option>
            <option value="B+"  @if($general_info != null) @if($general_info->blood_group=="B+") {{"Selected"}} @endif @endif>B+</option>
            <option value="B-"  @if($general_info != null) @if($general_info->blood_group=="B-") {{"Selected"}} @endif @endif>B-</option>
            <option value="O+"  @if($general_info != null) @if($general_info->blood_group=="O+") {{"Selected"}} @endif @endif>O+</option>
            <option value="O-"  @if($general_info != null) @if($general_info->blood_group=="O-") {{"Selected"}} @endif @endif>O-</option>
            </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="পেশা" class="font-weight-bold">পেশা <span class="text-mute">(Required)</span></label>
            {{-- <input type="text" class="form-control" name="profession"  value="{{$general_info->profession}}" placeholder="পেশা"> --}}
            <select class="form-control mt-2" name="profession" data-placeholder="নিবার্চন করুন">
                <option value>নিবার্চন করুন</option>
                <option value="গৃহিণী"  @if($general_info != null) @if($general_info->profession=="গৃহিণী") {{"Selected"}} @endif @endif>গৃহিণী</option>
                <option value="ছাত্র/ছাত্রী"  @if($general_info != null) @if($general_info->profession=="ছাত্র/ছাত্রী") {{"Selected"}} @endif @endif>ছাত্র/ছাত্রী</option>
                <option value="ব্যবসা"  @if($general_info != null) @if($general_info->profession=="ব্যবসা") {{"Selected"}} @endif @endif>ব্যবসা</option>
                <option value="প্রাইভেট জব"  @if($general_info != null) @if($general_info->profession=="প্রাইভেট জব") {{"Selected"}} @endif @endif>প্রাইভেট জব</option>
                <option value="সরকারি চাকুরীজীবি"  @if($general_info != null) @if($general_info->profession=="সরকারি চাকুরীজীবি") {{"Selected"}} @endif @endif>সরকারি চাকুরীজীবি</option>
                <option value="মাদ্রাসার শিক্ষক"  @if($general_info != null) @if($general_info->profession=="মাদ্রাসার শিক্ষক") {{"Selected"}} @endif @endif>মাদ্রাসার শিক্ষক</option>
                <option value="স্কুলের শিক্ষক"  @if($general_info != null) @if($general_info->profession=="স্কুলের শিক্ষক") {{"Selected"}} @endif @endif>স্কুলের শিক্ষক</option>
                <option value="ফ্রিল্যান্সার"  @if($general_info != null) @if($general_info->profession=="ফ্রিল্যান্সার") {{"Selected"}} @endif @endif>ফ্রিল্যান্সার</option>
                <option value="ডাক্তার"  @if($general_info != null) @if($general_info->profession=="ডাক্তার") {{"Selected"}} @endif @endif>ডাক্তার</option>
                <option value="বিএসসি ইঞ্জিনিয়ার"  @if($general_info != null) @if($general_info->profession=="বিএসসি ইঞ্জিনিয়ার") {{"Selected"}} @endif @endif>বিএসসি ইঞ্জিনিয়ার</option>
                <option value="ডিপ্লোমা ইঞ্জিনিয়ার"  @if($general_info != null) @if($general_info->profession=="ডিপ্লোমা ইঞ্জিনিয়ার") {{"Selected"}} @endif @endif>ডিপ্লোমা ইঞ্জিনিয়ার</option>
                <option value="ড্রাইভিং"  @if($general_info != null) @if($general_info->profession=="ড্রাইভিং") {{"Selected"}} @endif @endif>ড্রাইভিং</option>
                <option value="বাড়ি ভাড়া ব্যবসা"  @if($general_info != null) @if($general_info->profession=="বাড়ি ভাড়া ব্যবসা") {{"Selected"}} @endif @endif>বাড়ি ভাড়া ব্যবসা</option>
                <option value="সাংবাদিক"  @if($general_info != null) @if($general_info->profession=="সাংবাদিক") {{"Selected"}} @endif @endif>সাংবাদিক</option>
                <option value="নার্স"  @if($general_info != null) @if($general_info->profession=="নার্স") {{"Selected"}} @endif @endif>নার্স</option>
                <option value="উকিল"  @if($general_info != null) @if($general_info->profession=="উকিল") {{"Selected"}} @endif @endif>উকিল</option>
                <option value="সেনাবাহিনী/নৌবাহিনী/বিমানবাহিনী"  @if($general_info != null) @if($general_info->profession=="সেনাবাহিনী/নৌবাহিনী/বিমানবাহিনী") {{"Selected"}} @endif @endif>সেনাবাহিনী/নৌবাহিনী/বিমানবাহিনী</option>
                <option value="পুলিশ/বিজিবি/কোস্টগার্ড ও অন্যান্য নিরাপত্তা বাহিনীর সদস্য"  @if($general_info != null) @if($general_info->profession=="পুলিশ/বিজিবি/কোস্টগার্ড ও অন্যান্য নিরাপত্তা বাহিনীর সদস্য") {{"Selected"}}  @endif @endif>পুলিশ/বিজিবি/কোস্টগার্ড ও অন্যান্য নিরাপত্তা বাহিনীর সদস্য</option>
                <option value="কৃষি"  @if($general_info != null) @if($general_info->profession=="কৃষি") {{"Selected"}} @endif @endif>কৃষি</option>
                <option value="বেকার"  @if($general_info != null) @if($general_info->profession=="বেকার") {{"Selected"}}  @endif @endif>বেকার</option>
                <option value="সাধারণ"  @if($general_info != null) @if($general_info->profession=="সাধারণ") {{"Selected"}}  @endif @endif>সাধারণ</option>
                </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="মাসিক আয়" class="font-weight-bold">মাসিক আয় </label>
            <input type="text" class="form-control"name="monthly_income" value="@if($general_info != null) {{$general_info->monthly_income}} @endif" placeholder="মাসিক আয়">
            <input type="hidden" class="form-control"name="t_name" value="general_info">
            
            </div>
            </div>
            </div>
            @csrf
            <div class="form-group">
            <button class="btn btn-success btn-block btn-sm">Edit</button>
            </div>
            
            </form>
        </div>
        </div>
      </div>
    </div>

<div class="modal fade" id="address" tabindex="-1" role="dialog" aria-labelledby="addressLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addressLabel">ঠিকানা</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form name="address"  action="{{URL::to("/update_registation")}}"  method="POST" >
                <?php  $address =  App\Models\address::where(['user_table_id'=>$user_id])->first() ?>
                <input type="hidden" name="user_table_id" value="{{$user_id}}">

            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="স্থায়ী ঠিকানা *" class="font-weight-bold">স্থায়ী ঠিকানা * <span class="text-mute">(Required)</span></label>
            <input type="text" class="form-control" name="permanent_address" value="@if($address != null)  {{$address->permanent_address}} @endif" placeholder="স্থায়ী ঠিকানা *" required>
            <input type="hidden" class="form-control" name="t_name" value="address" placeholder="স্থায়ী ঠিকানা *" required>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class"  id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="বর্তমান ঠিকানা *" class="font-weight-bold">বর্তমান ঠিকানা * <span class="text-mute">(Required)</span></label>
            <input type="text" class="form-control" name="present_address" value="@if($address != null)  {{$address->present_address}} @endif"   placeholder="বর্তমান ঠিকানা *" required>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="কোথায় বড় হয়েছেন? *" class="font-weight-bold">কোথায় বড় হয়েছেন? * </label>
            <input type="text" class="form-control"  name="growing_up" value="@if($address != null) {{$address->growing_up}} @endif"  placeholder="কোথায় বড় হয়েছেন? *">
            
            </div>
            </div>
            </div>
            </div>
            @csrf
            <div class="form-group">
            <button class="btn btn-success btn-block btn-sm">Edit</button>
            </div>
            </form>
        </div>
        </div>
</div>



<div class="modal fade" id="education_info" tabindex="-1" role="dialog" aria-labelledby="education_infoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="education_infoLabel">শিক্ষাগত যোগ্যতা</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form name="education_info"  action="{{URL::to("/update_registation")}}"  method="POST" >
                <?php  $education_info =  App\Models\education_info::where(['user_table_id'=>$user_id])->first() ?>
                <input type="hidden" name="user_table_id" value="{{$user_id}}">

            <input type="hidden" name="t_name" value="education_info">
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="কোন মাধ্যমে পড়াশোনা করেছেন? *" class="font-weight-bold">কোন মাধ্যমে পড়াশোনা করেছেন? * </label>
            <select class="form-control" name="education_type"   placeholder="কোন মাধ্যমে পড়াশোনা করেছেন? *">
            <option value>Select</option>
            <option value="1" @if($education_info != null) @if($education_info->education_type=="1") {{"Selected"}} @endif @endif>মাদ্রাসা</option>
            <option value="2" @if($education_info != null) @if($education_info->education_type=="2") {{"Selected"}} @endif @endif>জেনারেল</option>
            </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class31" data-condtion="31" id="id109">
            <div class="card-body">
            <div class="form-group">
            <label for="আপনি কি হাফেজ?" class="font-weight-bold">আপনি কি হাফেজ? </label>
            <select class="form-control" name="is_hafez"  placeholder="আপনি কি হাফেজ?">
            <option value>Select</option>
            <option value="1" @if($education_info != null) @if($education_info->is_hafez=="1") {{"Selected"}} @endif @endif>হ্যাঁ</option>
            <option value="0" @if($education_info != null) @if($education_info->is_hafez=="0") {{"Selected"}} @endif @endif>না</option>
            </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class31" >
            <div class="card-body">
            <div class="form-group">
            <label for="দাওরায়ে হাদীস পাশ করেছেন?" class="font-weight-bold">দাওরায়ে হাদীস পাশ করেছেন? </label>
            <select class="form-control" name="is_passed_dawrae_hadith"   placeholder="দাওরায়ে হাদীস পাশ করেছেন?">
            <option value>Select</option>
            <option value="1" @if($education_info != null) @if($education_info->is_passed_dawrae_hadith=="1") {{"Selected"}} @endif @endif>হ্যাঁ</option>
            <option value="0" @if($education_info != null) @if($education_info->is_passed_dawrae_hadith=="0") {{"Selected"}} @endif @endif>না</option>
            </select>
            
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class31">
            <div class="card-body">
            <div class="form-group">
            <label for="মাধ্যমিক (SSC) / সমমান পাশ করেছেন?" class="font-weight-bold">মাধ্যমিক (SSC) / সমমান পাশ করেছেন? </label>
            <select class="form-control" name="is_passed_ssc"  id="field_35" data-id="35" data-group="12" placeholder="মাধ্যমিক (SSC) / সমমান পাশ করেছেন?">
            <option value>Select</option>
            <option value="1" @if($education_info != null) @if($education_info->is_passed_ssc=="1") {{"Selected"}} @endif @endif>হ্যাঁ</option>
            <option value="0" @if($education_info != null) @if($education_info->is_passed_ssc=="0") {{"Selected"}} @endif @endif>না</option>
            </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class31" data-condtion="31" id="id110">
            <div class="card-body">
            <div class="form-group">
            <label for="মাধ্যমিক (SSC) / সমমান ফলাফল" class="font-weight-bold">মাধ্যমিক (SSC) / সমমান ফলাফল </label>
            <input type="text" class="form-control"  name="result_ssc" value="@if($education_info != null){{$education_info->result_ssc}} @endif"   placeholder="মাধ্যমিক (SSC) / সমমান ফলাফল">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class31" data-condtion="31" id="id110">
            <div class="card-body">
            <div class="form-group">
            <label for="মাধ্যমিক (SSC) / সমমান বিভাগ" class="font-weight-bold">মাধ্যমিক (SSC) / সমমান বিভাগ </label>
            <select class="form-control" name="divition_ssc"   placeholder="মাধ্যমিক (SSC) / সমমান বিভাগ">
            <option value>Select</option>
            <option value="1" @if($education_info != null) @if($education_info->divition_ssc=="1") {{"Selected"}} @endif @endif>বিজ্ঞান বিভাগ</option>
            <option value="2" @if($education_info != null) @if($education_info->divition_ssc=="2") {{"Selected"}} @endif @endif>মানবিক বিভাগ</option>
            <option value="3" @if($education_info != null) @if($education_info->divition_ssc=="3") {{"Selected"}} @endif @endif>ব্যবসা বিভাগ</option>
            <option value="4" @if($education_info != null) @if($education_info->divition_ssc=="4") {{"Selected"}} @endif @endif>কারিগরি / ভোকেশনাল</option>
            </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class31" data-condtion="31" id="id110">
            <div class="card-body">
            <div class="form-group">
            <label for="মাধ্যমিক (SSC) / সমমান পাসের সন" class="font-weight-bold">মাধ্যমিক (SSC) / সমমান পাসের সন </label>
            
            
            <input type="text" class="form-control" value="@if($education_info != null) {{$education_info->ssc_passed_year}} @endif" name="ssc_passed_year" placeholder="মাধ্যমিক (SSC) / সমমান পাসের সন">
            </div>
            </div>
            </div>
            <div class="card mb-3 class31" data-condtion="31" id="id110">
            <div class="card-body">
            <div class="form-group">
            <label for="উচ্চ মাধ্যমিক (HSC) / সমমান পাশ করেছেন?" class="font-weight-bold">উচ্চ মাধ্যমিক (HSC) / সমমান পাশ করেছেন? </label>
            <select class="form-control" name="is_passed_hsc"  placeholder="উচ্চ মাধ্যমিক (HSC) / সমমান পাশ করেছেন?">
            <option value>Select</option>
            <option value="1" @if($education_info != null) @if($education_info->is_passed_hsc=="1") {{"Selected"}} @endif @endif>হ্যাঁ</option>
            <option value="0" @if($education_info != null) @if($education_info->is_passed_hsc=="0") {{"Selected"}} @endif @endif>না</option>
            </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class31" data-condtion="31" id="id110">
            <div class="card-body">
            <div class="form-group">
            <label for="উচ্চ মাধ্যমিক (HSC) / সমমানের বিভাগ" class="font-weight-bold">উচ্চ মাধ্যমিক (HSC) / সমমানের বিভাগ </label>
            <select class="form-control" name="divition_hsc"  placeholder="উচ্চ মাধ্যমিক (HSC) / সমমানের বিভাগ">
            <option value>Select</option>
            <option value="1" @if($education_info != null) @if($education_info->divition_hsc=="1") {{"Selected"}} @endif @endif>বিজ্ঞান বিভাগ</option>
            <option value="2" @if($education_info != null) @if($education_info->divition_hsc=="2") {{"Selected"}} @endif @endif>মানবিক বিভাগ</option>
            <option value="3" @if($education_info != null) @if($education_info->divition_hsc=="3") {{"Selected"}} @endif @endif>ব্যবসা বিভাগ</option>
            <option value="4" @if($education_info != null) @if($education_info->divition_hsc=="4") {{"Selected"}} @endif @endif>কারিগরি / ভোকেশনাল</option>
            </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class31" data-condtion="31" id="id110">
            <div class="card-body">
            <div class="form-group">
            <label for="উচ্চ মাধ্যমিক (HSC) / সমমান ফলাফল" class="font-weight-bold">উচ্চ মাধ্যমিক (HSC) / সমমান ফলাফল </label>
            <input type="text" class="form-control" name="result_hsc" value="@if($education_info != null){{$education_info->result_hsc}} @endif" placeholder="উচ্চ মাধ্যমিক (HSC) / সমমান ফলাফল">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class31" data-condtion="31" id="id110">
            <div class="card-body">
            <div class="form-group">
            <label for="উচ্চ মাধ্যমিক (HSC) / সমমান পাসের সন" class="font-weight-bold">উচ্চ মাধ্যমিক (HSC) / সমমান পাসের সন </label>
            <input type="text" class="form-control" name="hsc_passed_year" value="@if($education_info != null) {{$education_info->hsc_passed_year}} @endif"   placeholder="উচ্চ মাধ্যমিক (HSC) / সমমান পাসের সন">
            
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class31" data-condtion="31" id="id110">
            <div class="card-body">
            <div class="form-group">
            <label for="স্নাতক / স্নাতক (সম্মান) / সমমান শিক্ষাগত যোগ্যতা" class="font-weight-bold">স্নাতক / স্নাতক (সম্মান) / সমমান শিক্ষাগত যোগ্যতা </label>
            <input type="text" class="form-control"name="honours_passed" value="@if($education_info != null) {{$education_info->honours_passed}} @endif"  placeholder="স্নাতক / স্নাতক (সম্মান) / সমমান শিক্ষাগত যোগ্যতা">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class31" data-condtion="31" id="id110">
            <div class="card-body">
            <div class="form-group">
               
            <label for="শিক্ষাপ্রতিষ্ঠানের নাম" class="font-weight-bold">শিক্ষাপ্রতিষ্ঠানের নাম </label>
            <input type="text" class="form-control" value="@if($education_info != null) {{$education_info->institute_name}} @endif" name="institute_name" placeholder="শিক্ষাপ্রতিষ্ঠানের নাম">
            </div>
            </div>
            </div>
            <div class="card mb-3 class31" data-condtion="31" id="id110">
            <div class="card-body">
            <div class="form-group">
            <label for="পাসের সন" class="font-weight-bold">পাসের সন </label>
            <input type="text" class="form-control" value="@if($education_info != null) {{$education_info->honours_passed_year}} @endif"  name="honours_passed_year"  placeholder="পাসের সন">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="সর্বোচ্চ শিক্ষাগত যোগ্যতা" class="font-weight-bold">সর্বোচ্চ শিক্ষাগত যোগ্যতা </label>
            <input type="text" class="form-control" name="highest_education" value="@if($education_info != null) {{$education_info->highest_education}} @endif"  placeholder="সর্বোচ্চ শিক্ষাগত যোগ্যতা">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="অন্যান্য শিক্ষাগত যোগ্যতা" class="font-weight-bold">অন্যান্য শিক্ষাগত যোগ্যতা </label>
            <input type="text" class="form-control"  name="other_education" value="@if($education_info != null) {{$education_info->other_education}} @endif"  placeholder="অন্যান্য শিক্ষাগত যোগ্যতা">
            
            </div>
            </div>
            </div>
            </div>
            @csrf
            <div class="form-group">
            <button class="btn btn-success btn-block btn-sm">Edit</button>
            </div>
            </form>        
        </div>
        </div>
</div>




<div class="modal fade" id="family_info" tabindex="-1" role="dialog" aria-labelledby="family_infoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="family_infoLabel">পারিবারিক তথ্য</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form name="family_info"  action="{{URL::to("/update_registation")}}"  method="POST"  >
                <?php  $family_info =  App\Models\family_info::where(['user_table_id'=>$user_id])->first() ?>
                <input type="hidden" name="user_table_id" value="{{$user_id}}">

            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="পিতার নাম (শুধুমাত্র আপনি ও কতৃপক্ষ বাদে কেউ দেখতে পাচ্ছে না) *" class="font-weight-bold">পিতার নাম (শুধুমাত্র আপনি ও কতৃপক্ষ বাদে কেউ দেখতে পাচ্ছে না) * <span class="text-mute">(Required)</span></label>
            <input type="text" class="form-control"  name="father_name" value="@if($family_info != null) {{$family_info->father_name}} @endif"   placeholder="পিতার নাম (শুধুমাত্র আপনি ও কতৃপক্ষ বাদে কেউ দেখতে পাচ্ছে না) *" required>
            
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="মাতার নাম (শুধুমাত্র আপনি ও কতৃপক্ষ বাদে কেউ দেখতে পাচ্ছে না)" class="font-weight-bold">মাতার নাম (শুধুমাত্র আপনি ও কতৃপক্ষ বাদে কেউ দেখতে পাচ্ছে না) <span class="text-mute">(Required)</span></label>
            <input type="text" class="form-control"  name="mother_name" value="@if($family_info != null) {{$family_info->mother_name}} @endif"  placeholder="মাতার নাম (শুধুমাত্র আপনি ও কতৃপক্ষ বাদে কেউ দেখতে পাচ্ছে না)" required>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="পিতার পেশা *" class="font-weight-bold">পিতার পেশা * <span class="text-mute">(Required)</span></label>
            <input type="text" class="form-control"  name="profession_father" value="@if($family_info != null) {{$family_info->profession_father}} @endif"  placeholder="পিতার পেশা *" required>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="মাতার পেশা *" class="font-weight-bold">মাতার পেশা * </label>
            <input type="text" class="form-control"  name="profession_mother" value="@if($family_info != null) {{$family_info->profession_mother}} @endif"  placeholder="মাতার পেশা *">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="বোন কয়জন? *" class="font-weight-bold">বোন কয়জন? * </label>
            <input type="text" class="form-control" name="sister"  placeholder="বোন কয়জন? *" value="@if($family_info != null) {{$family_info->sister}} @endif">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="ভাই কয়জন? *" class="font-weight-bold">ভাই কয়জন? * </label>
            <input type="text" value="@if($family_info != null) {{$family_info->borther}} @endif" class="form-control" name="borther"   placeholder="ভাই কয়জন? *">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class75" data-condtion="75" id="id676">
            <div class="card-body">
            <div class="form-group">
            <label for="বোনদের সম্পর্কে তথ্য" class="font-weight-bold">বোনদের সম্পর্কে তথ্য </label>
            <textarea colspan="3" rows="2" class="form-control" name="info_sister"  placeholder="বোনদের সম্পর্কে তথ্য">@if($family_info != null) {{$family_info->info_sister}} @endif</textarea>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class76" data-condtion="76" id="id687">
            <div class="card-body">
            <div class="form-group">
            <label for="ভাইদের সম্পর্কে তথ্য" class="font-weight-bold">ভাইদের সম্পর্কে তথ্য </label>
            <textarea colspan="3" rows="2" class="form-control"  name="info_broter"  placeholder="ভাইদের সম্পর্কে তথ্য">@if($family_info != null) {{$family_info->info_broter}} @endif</textarea>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="চাচা মামাদের পেশা" class="font-weight-bold">চাচা মামাদের পেশা </label>
            <textarea colspan="3" rows="2" class="form-control"  name="uncle"  placeholder="চাচা মামাদের পেশা">@if($family_info != null) {{$family_info->uncle}} @endif</textarea>
            <input type="hidden" name="t_name" value="family_info">
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="পরিবারের অর্থনৈতিক ও সামাজিক অবস্থা *" class="font-weight-bold">পরিবারের অর্থনৈতিক ও সামাজিক অবস্থা * <span class="text-mute">(Required)</span></label>
            <input type="text" class="form-control" name="economic_social_status" value="@if($family_info != null) {{$family_info->economic_social_status}} @endif"  placeholder="পরিবারের অর্থনৈতিক ও সামাজিক অবস্থা *" required>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="আপনার পরিবারের দ্বীনি অবস্থা কেমন? (বিস্তারিত বর্ননা করুন )" class="font-weight-bold">আপনার পরিবারের দ্বীনি অবস্থা কেমন? (বিস্তারিত বর্ননা করুন ) </label>
            <input type="text" class="form-control" name="islamic_status"  value="@if($family_info != null) {{$family_info->islamic_status}} @endif"  placeholder="আপনার পরিবারের দ্বীনি অবস্থা কেমন? (বিস্তারিত বর্ননা করুন )">
            
            </div>
            </div>
            </div>
            </div>
            @csrf
            <div class="form-group">
            <button class="btn btn-success btn-block btn-sm">Edit</button>
            </div>
            </form>
        </div>
        </div>
</div>
</div>




  
  <!-- Modal -->
  <div class="modal fade" id="personal_info" tabindex="-1" role="dialog" aria-labelledby="personal_infoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="personal_infoLabel">ব্যক্তিগত তথ্য</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form name="personal_info"  action="{{URL::to("/update_registation")}}"   method="POST" >
                <?php  $personal_info =  App\Models\personal_info::where(['user_table_id'=>$user_id])->first() ?>
                <input type="hidden" name="user_table_id" value="{{$user_id}}">

            <input type="hidden" name="t_name" value="personal_info">
            <div class="card mb-3 class19" data-condtion="19" id="id53">
            <div class="card-body">
            <div class="form-group">
            <label for="সুন্নতি দাঁড়ি রয়েছে কি?" class="font-weight-bold">সুন্নতি দাঁড়ি রয়েছে কি? </label>
            <input type="text" class="form-control"  name="beard" value=" @if($personal_info != null) {{$personal_info->beard}} @endif" placeholder="সুন্নতি দাঁড়ি রয়েছে কি?">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class19" data-condtion="19" id="id53">
            <div class="card-body">
            <div class="form-group">
            <label for="পায়ের টাখনুর উপরে কাপড় পরেন?" class="font-weight-bold">পায়ের টাখনুর উপরে কাপড় পরেন? </label>
            <input type="text" class="form-control"name="ankle"  value="@if($personal_info != null) {{$personal_info->ankle}} @endif" placeholder="পায়ের টাখনুর উপরে কাপড় পরেন?">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="প্রতিদিন পাঁচ ওয়াক্ত নামাজ পড়া হয় ? *" class="font-weight-bold">প্রতিদিন পাঁচ ওয়াক্ত নামাজ পড়া হয় ? * <span class="text-mute">(Required)</span></label>
            <input type="text" class="form-control" name="prayer" value="@if($personal_info != null) {{$personal_info->prayer}} @endif" placeholder="প্রতিদিন পাঁচ ওয়াক্ত নামাজ পড়া হয় ? *" required>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="নিয়মিত নামায কত সময় যাবত পড়ছেন? *" class="font-weight-bold">নিয়মিত নামায কত সময় যাবত পড়ছেন? * </label>
            <input type="text" class="form-control" name="prayer_year" value="@if($personal_info != null) {{$personal_info->prayer_year}} @endif"  placeholder="নিয়মিত নামায কত সময় যাবত পড়ছেন? *">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="মাহরাম/গাইরে-মাহরাম মেনে চলেন কি? *" class="font-weight-bold">মাহরাম/গাইরে-মাহরাম মেনে চলেন কি? * <span class="text-mute">(Required)</span></label>
            <input type="text" class="form-control" name="mahram_comply" value="@if($personal_info != null) {{$personal_info->mahram_comply}} @endif" placeholder="মাহরাম/গাইরে-মাহরাম মেনে চলেন কি? *" required>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="শুদ্ধভাবে কুরআন তিলওয়াত করতে পারেন? *" class="font-weight-bold">শুদ্ধভাবে কুরআন তিলওয়াত করতে পারেন? * <span class="text-mute">(Required)</span></label>
            <input type="text" class="form-control" name="recite_quran" value="@if($personal_info != null) {{$personal_info->recite_quran}} @endif"  placeholder="শুদ্ধভাবে কুরআন তিলওয়াত করতে পারেন? *" required>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="ঘরের বাহিরে সাধারণত কী ধরণের পোশাক পরেন?" class="font-weight-bold">ঘরের বাহিরে সাধারণত কী ধরণের পোশাক পরেন? <span class="text-mute">(Required)</span></label>
            <input type="text" class="form-control"  name="wearing_type" value="@if($personal_info != null) {{$personal_info->wearing_type}} @endif"  placeholder="ঘরের বাহিরে সাধারণত কী ধরণের পোশাক পরেন?" required>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="কোনো রাজনৈতিক দর্শন থাকলে লিখুন *" class="font-weight-bold">কোনো রাজনৈতিক দর্শন থাকলে লিখুন * </label>
            <input type="text" class="form-control"  name="political_philosophy"  value="@if($personal_info != null) {{$personal_info->political_philosophy}} @endif"  placeholder="কোনো রাজনৈতিক দর্শন থাকলে লিখুন *">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="নাটক/সিনেমা/সিরিয়াল/গান/খেলা এসব দেখেন বা শুনেন? *" class="font-weight-bold">নাটক/সিনেমা/সিরিয়াল/গান/খেলা এসব দেখেন বা শুনেন? * <span class="text-mute">(Required)</span></label>
            <input type="text" class="form-control"  name="entertainment" value="@if($personal_info != null) {{$personal_info->entertainment}} @endif" placeholder="নাটক/সিনেমা/সিরিয়াল/গান/খেলা এসব দেখেন বা শুনেন? *" required>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="মানসিক বা শারীরিক কোনো রোগ আছে কি? *" class="font-weight-bold">মানসিক বা শারীরিক কোনো রোগ আছে কি? * </label>
            <input type="text" class="form-control"  name="disease" value="@if($personal_info != null) {{$personal_info->disease}} @endif" placeholder="মানসিক বা শারীরিক কোনো রোগ আছে কি? *">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="দ্বীনের কোন বিশেষ মেহনতে যুক্ত আছেন? *" class="font-weight-bold">দ্বীনের কোন বিশেষ মেহনতে যুক্ত আছেন? * </label>
            <input type="text" class="form-control"  name="involved_religion" value="@if($personal_info != null) {{$personal_info->involved_religion}} @endif"  placeholder="দ্বীনের কোন বিশেষ মেহনতে যুক্ত আছেন? *">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="আপনি কি কোনো পীরের মুরিদ বা অনুসারী ? *" class="font-weight-bold">আপনি কি কোনো পীরের মুরিদ বা অনুসারী ? * </label>
            <input type="text" class="form-control"  name="follower_pir" value="@if($personal_info != null) {{$personal_info->follower_pir}} @endif" placeholder="আপনি কি কোনো পীরের মুরিদ বা অনুসারী ? *">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="মাজার সম্পর্কে আপনার ধারণা বা বিশ্বাস কি? *" class="font-weight-bold">মাজার সম্পর্কে আপনার ধারণা বা বিশ্বাস কি? * </label>
            <input type="text" class="form-control"  name="shrines" value="@if($personal_info != null) {{$personal_info->shrines}} @endif" placeholder="মাজার সম্পর্কে আপনার ধারণা বা বিশ্বাস কি? *">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="আপনার পছন্দের অন্তত ৩ টি ইসলামী বই এর নাম লিখুন" class="font-weight-bold">আপনার পছন্দের অন্তত ৩ টি ইসলামী বই এর নাম লিখুন </label>
            <input type="text" class="form-control"  name="islamic_books" value="@if($personal_info != null) {{$personal_info->islamic_books}} @endif" placeholder="আপনার পছন্দের অন্তত ৩ টি ইসলামী বই এর নাম লিখুন">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="আপনার পছন্দের অন্তত ৩ জন আলেমের নাম লিখুন *" class="font-weight-bold">আপনার পছন্দের অন্তত ৩ জন আলেমের নাম লিখুন * </label>
            <input type="text" class="form-control" name="scholars_name" value="@if($personal_info != null) {{$personal_info->scholars_name}} @endif" placeholder="আপনার পছন্দের অন্তত ৩ জন আলেমের নাম লিখুন *">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="বিশেষ দ্বীনি বা দুনিয়াবি যোগ্যতা (যদি থাকে)" class="font-weight-bold">বিশেষ দ্বীনি বা দুনিয়াবি যোগ্যতা (যদি থাকে) </label>
            <input type="text" class="form-control"  name="special_qualifications" value="@if($personal_info != null) {{$personal_info->special_qualifications}} @endif" placeholder="বিশেষ দ্বীনি বা দুনিয়াবি যোগ্যতা (যদি থাকে)">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="নিজের সম্পর্কে কিছু লিখুন *" class="font-weight-bold">নিজের সম্পর্কে কিছু লিখুন * <span class="text-mute">(Required)</span></label>
            <textarea colspan="3" rows="2" class="form-control" name="write_yourself" placeholder="নিজের সম্পর্কে কিছু লিখুন *" required>@if($personal_info != null) {{$personal_info->write_yourself}} @endif</textarea>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="আপনার ক্ষেত্রে প্রযোজ্য হয় এমন অপশন গুলো সিলেক্ট করুন" class="font-weight-bold">আপনার ক্ষেত্রে প্রযোজ্য হয় এমন অপশন গুলো সিলেক্ট করুন </label>
            <select class="form-control" name="options_apply"  id="field_122" data-id="122" data-group="14" placeholder="আপনার ক্ষেত্রে প্রযোজ্য হয় এমন অপশন গুলো সিলেক্ট করুন">
            <option value>Select</option>
            <option value="1"@if($personal_info != null)  @if($personal_info->options_apply=="1") {{"Selected"}} @endif @endif>নওমুসলিম</option>
            <option value="2"@if($personal_info != null)  @if($personal_info->options_apply=="2") {{"Selected"}} @endif @endif>মাসনায় আগ্রহী</option>
            <option value="3"@if($personal_info != null)  @if($personal_info->options_apply=="3") {{"Selected"}} @endif @endif>প্রবাসী/ প্রবাসী বিয়ে করতে আগ্রহী</option>
            <option value="4"@if($personal_info != null)  @if($personal_info->options_apply=="4") {{"Selected"}} @endif @endif>ঘর জামাই থাকতে চাই</option>
            <option value="5"@if($personal_info != null)  @if($personal_info->options_apply=="5") {{"Selected"}} @endif @endif>প্রযোজ্য নয়</option>
            </select>
            
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="কোন মাজহাব অনুসরণ করেন?" class="font-weight-bold">কোন মাজহাব অনুসরণ করেন? <span class="text-mute">(Required)</span></label>
            <select class="form-control" name="mazhab" id="field_124" data-id="124" data-group="14" placeholder="কোন মাজহাব অনুসরণ করেন?" required>
            <option value>Select</option>
            <option value="1"@if($personal_info != null)  @if($personal_info->mazhab=="1") {{"Selected"}} @endif @endif>হানাফি</option>
            <option value="2"@if($personal_info != null)  @if($personal_info->mazhab=="2") {{"Selected"}} @endif @endif>শাফেয়ী</option>
            <option value="3"@if($personal_info != null)  @if($personal_info->mazhab=="3") {{"Selected"}} @endif @endif>মালেকি</option>
            <option value="4"@if($personal_info != null)  @if($personal_info->mazhab=="4") {{"Selected"}} @endif @endif>হাম্বলি</option>
            <option value="5"@if($personal_info != null)  @if($personal_info->mazhab=="5") {{"Selected"}} @endif @endif>সালাফি[আহলে হাদিস]</option>
            <option value="6"@if($personal_info != null)  @if($personal_info->mazhab=="6") {{"Selected"}} @endif @endif>জানিনা</option>
            </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="নজরের হেফাজত করেন?" class="font-weight-bold">নজরের হেফাজত করেন? </label>
            <select class="form-control" name="save_eye" id="field_125" data-id="125" data-group="14" placeholder="নজরের হেফাজত করেন?">
            <option value>Select</option>
            <option value="0"@if($personal_info != null)  @if($personal_info->save_eye=="0") {{"Selected"}} @endif @endif>না</option>
            <option value="2"@if($personal_info != null)  @if($personal_info->save_eye=="1") {{"Selected"}} @endif @endif>হ্যা</option>
            <option value="3"@if($personal_info != null)  @if($personal_info->save_eye=="2") {{"Selected"}} @endif @endif>চেষ্টা করি</option>
            </select>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="দ্বীনি ফিউচার প্ল্যন কি আপনার?" class="font-weight-bold">দ্বীনি ফিউচার প্ল্যন কি আপনার? </label>
            <input type="text" class="form-control" name="future_plane" value="@if($personal_info != null) {{$personal_info->future_plane}} @endif" placeholder="দ্বীনি ফিউচার প্ল্যন কি আপনার?">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="অবসর সময় কিভাবে কাটান?" class="font-weight-bold">অবসর সময় কিভাবে কাটান? </label>
            <input type="text" class="form-control" name="spend_free_time" value="@if($personal_info != null) {{$personal_info->spend_free_time}} @endif" placeholder="অবসর সময় কিভাবে কাটান?">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class19" data-condtion="19" id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="কত ওয়াক্ত নামায জামাতের সাথে আদায় করেন?" class="font-weight-bold">কত ওয়াক্ত নামায জামাতের সাথে আদায় করেন? </label>
            <input type="text" class="form-control" name="congregation_pray" value="@if($personal_info != null) {{$personal_info->congregation_pray}} @endif" placeholder="কত ওয়াক্ত নামায জামাতের সাথে আদায় করেন?">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="বাড়িতে কি কি দায়িত্ব আপনি পালন করে থাকেন?" class="font-weight-bold">বাড়িতে কি কি দায়িত্ব আপনি পালন করে থাকেন? </label>
            <input type="text" class="form-control"  name="responsibilities_home" value="@if($personal_info != null) {{$personal_info->responsibilities_home}} @endif" placeholder="বাড়িতে কি কি দায়িত্ব আপনি পালন করে থাকেন?">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class19" data-condtion="19" id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="আপনি কি ধুমপান করেন?" class="font-weight-bold">আপনি কি ধুমপান করেন? </label>
            <input type="text" class="form-control" name="smoking" value="@if($personal_info != null) {{$personal_info->smoking}} @endif" placeholder="আপনি কি ধুমপান করেন?">
            
            
            </div>
            </div>
            </div>
            </div>
            @csrf
            <div class="form-group">
            <button class="btn btn-success btn-block btn-sm">Edit</button>
            </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>



  <!-- Modal -->
  <div class="modal fade" id="marriage_info" tabindex="-1" role="dialog" aria-labelledby="marriage_infoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="marriage_infoLabel">বিয়ে সংক্রান্ত তথ্য</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form name="marriage_info"  action="{{URL::to("/update_registation")}}"  method="POST" >

                <?php  $marriage_info =  App\Models\marriage_info::where(['user_table_id'=>$user_id])->first() ?>
                <input type="hidden" name="user_table_id" value="{{$user_id}}">

               
               <div class="card mb-3 class" data-condtion id="id">
               <div class="card-body">
               <div class="form-group">
               <label for="অভিভাবক আপনার বিয়েতে রাজি কি না? *" class="font-weight-bold">অভিভাবক আপনার বিয়েতে রাজি কি না? * <span class="text-mute">(Required)</span></label>
               <input type="text" class="form-control"  name="is_agree" value="@if($marriage_info != null) {{$marriage_info->is_agree}} @endif"  placeholder="অভিভাবক আপনার বিয়েতে রাজি কি না? *" required>
               <input type="hidden"  name="t_name" value="marriage_info" >
               
               </div>
               </div>
               </div>
               <div class="card mb-3 class" data-condtion id="id">
               <div class="card-body">
               <div class="form-group">
               <label for="বিয়ে কেন করছেন? বিয়ে সম্পর্কে আপনার ধারণা কি? *" class="font-weight-bold">বিয়ে কেন করছেন? বিয়ে সম্পর্কে আপনার ধারণা কি? * <span class="text-mute">(Required)</span></label>
               <textarea colspan="3" rows="2" class="form-control" name="thought_marriage" placeholder="বিয়ে কেন করছেন? বিয়ে সম্পর্কে আপনার ধারণা কি? *" required> @if($marriage_info != null){{$marriage_info->thought_marriage}}  @endif</textarea>
               
               </div>
                </div>
               </div>
               <div class="card mb-3 class" data-condtion id="id">
               <div class="card-body">
               <div class="form-group">
               <label for="পাত্র/পাত্রী নির্বাচনে কোন বিষয়গুলো ছাড় দেয়ার মানসিকতা রাখেন?" class="font-weight-bold">পাত্র/পাত্রী নির্বাচনে কোন বিষয়গুলো ছাড় দেয়ার মানসিকতা রাখেন? </label>
               <select class="form-control" name="selection_mind" placeholder="পাত্র/পাত্রী নির্বাচনে কোন বিষয়গুলো ছাড় দেয়ার মানসিকতা রাখেন?">
               <option value>Select</option>
               <option value="1" @if($marriage_info != null) @if($marriage_info->selection_mind=="1") {{"Selected"}}  @endif @endif >জেলা</option>
               <option value="2" @if($marriage_info != null) @if($marriage_info->selection_mind=="2") {{"Selected"}}  @endif @endif >ছাড় দিতে রাজি নই</option>
               <option value="3" @if($marriage_info != null) @if($marriage_info->selection_mind=="3") {{"Selected"}}  @endif @endif >আর্থিক অবস্থা</option>
               <option value="4" @if($marriage_info != null) @if($marriage_info->selection_mind=="4") {{"Selected"}}  @endif @endif >আর্থিক অবস্থা ও গায়ের রং</option>
               <option value="5" @if($marriage_info != null) @if($marriage_info->selection_mind=="5") {{"Selected"}}  @endif @endif >আর্থিক অবস্থা ও জেলা</option>
               <option value="6" @if($marriage_info != null) @if($marriage_info->selection_mind=="6") {{"Selected"}}  @endif @endif >গায়ের রং ও জেলা</option>
               <option value="7" @if($marriage_info != null) @if($marriage_info->selection_mind=="7") {{"Selected"}}  @endif @endif >সবক্ষেত্রেই ছাড় দিতে রাজি আছি</option>
               <option value="8" @if($marriage_info != null) @if($marriage_info->selection_mind=="8") {{"Selected"}}  @endif @endif >গায়ের রং</option>
               </select>
               
               </div>
               </div>
               </div>
               @csrf
               <div class="form-group">
               <button class="btn btn-success btn-block btn-sm">Edit</button>
               </div>
               </form>
        </div>
        
      </div>
    </div>
  </div>


  
  <!-- Modal -->
  <div class="modal fade" id="other_info" tabindex="-1" role="dialog" aria-labelledby="other_infoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="other_infoLabel">অন্যান্য তথ্য</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form name="other_info"  action="{{URL::to("/update_registation")}}"  method="POST" >
                <?php  $other_info =  App\Models\other_info::where(['user_table_id'=>$user_id])->first() ?>
            
                <input type="hidden" name="user_table_id" value="{{$user_id}}">

            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="পেশা সম্পর্কিত তথ্য" class="font-weight-bold">পেশা সম্পর্কিত তথ্য </label>
            <textarea colspan="3" rows="2" class="form-control"  name="profession" placeholder="পেশা সম্পর্কিত তথ্য">@if($other_info != null) {{$other_info->profession}} @endif</textarea>
            <input type="hidden" name="t_name" value="other_info">
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="বিশেষ কিছু যদি জানাতে চান" class="font-weight-bold">বিশেষ কিছু যদি জানাতে চান </label>
            <textarea colspan="3" rows="2" class="form-control"  name="asking"placeholder="বিশেষ কিছু যদি জানাতে চান">@if($other_info != null) {{$other_info->asking}} @endif</textarea>
            
            </div>
            </div>
            </div>
            @csrf
            <div class="form-group">
            <button class="btn btn-success btn-block btn-sm">Edit</button>
            </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>


  
  <!-- Modal -->
  <div class="modal fade" id="spouse_expect" tabindex="-1" role="dialog" aria-labelledby="spouse_expectLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="spouse_expectLabel">যেমন জীবনসঙ্গী আশা করেন</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form   action="{{URL::to("/update_registation")}}"  method="POST" >
                <?php  $spouse_expect =  App\Models\spouse_expect::where(['user_table_id'=>$user_id])->first() ?>
                <input type="hidden" name="user_table_id" value="{{$user_id}}">

            
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="বয়স *" class="font-weight-bold">বয়স * </label>
            <input type="text" class="form-control" name="year_old"  value="@if($spouse_expect != null) {{$spouse_expect->year_old}} @endif" value placeholder="বয়স *">
            <input type="hidden"  name="t_name" value="spouse_expect" placeholder="বয়স *">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="গাত্রবর্ণ *" class="font-weight-bold">গাত্রবর্ণ * <span class="text-mute">(Required)</span></label>
            
            <select class="form-control" name="color"  id="field_27" data-id="27" data-group="10" placeholder="গাত্রবর্ণ" required>
                <option value>Select</option>
                <option value="কালো" @if($spouse_expect != null) @if($spouse_expect->color=="কালো") {{"Selected"}} @endif  @endif>কালো</option>
                <option value="শ্যামলা" @if($spouse_expect != null) @if($spouse_expect->color=="শ্যামলা") {{"Selected"}} @endif  @endif>শ্যামলা</option>
                <option value="উজ্জ্বল শ্যামলা" @if($spouse_expect != null) @if($spouse_expect->color=="উজ্জ্বল শ্যামলা") {{"Selected"}} @endif  @endif>উজ্জ্বল শ্যামলা</option>
                <option value="ফর্সা" @if($spouse_expect != null) @if($spouse_expect->color=="ফর্সা") {{"Selected"}}  @endif @endif>ফর্সা</option>
                <option value="উজ্জ্বল ফর্সা" @if($spouse_expect != null) @if($spouse_expect->color=="উজ্জ্বল ফর্সা") {{"Selected"}} @endif  @endif>উজ্জ্বল ফর্সা</option>
                </select>
            {{-- <input type="text" class="form-control"  name="color" value="{{$spouse_expect->color}}"  placeholder="গাত্রবর্ণ *" required> --}}
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="নূন্যতম উচ্চতা *" class="font-weight-bold">নূন্যতম উচ্চতা * <span class="text-mute">(Required)</span></label>
            <input type="text" class="form-control"  name="min_height" value=" @if($spouse_expect != null) {{$spouse_expect->min_height}} @endif" placeholder="নূন্যতম উচ্চতা *" required>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="নূন্যতম শিক্ষাগত যোগ্যতা *" class="font-weight-bold">নূন্যতম শিক্ষাগত যোগ্যতা * <span class="text-mute">(Required)</span></label>
            <input type="text" class="form-control"  name="min_education" value=" @if($spouse_expect != null) {{$spouse_expect->min_education}} @endif"  placeholder="নূন্যতম শিক্ষাগত যোগ্যতা *" required>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="বৈবাহিক অবস্থা *" class="font-weight-bold">বৈবাহিক অবস্থা * <span class="text-mute">(Required)</span></label>
            <input type="text" class="form-control"  name="marid_status" value=" @if($spouse_expect != null) {{$spouse_expect->marid_status}} @endif"  placeholder="বৈবাহিক অবস্থা *" required>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class19" data-condtion="19" id="id53">
            <div class="card-body">
            <div class="form-group">
            <label for="জীবনসঙ্গীর পর্দা সম্পর্কে যেমনটা চান-" class="font-weight-bold">জীবনসঙ্গীর পর্দা সম্পর্কে যেমনটা চান- </label>
            <input type="text" class="form-control" name="profession" value=" @if($spouse_expect != null) {{$spouse_expect->profession}} @endif"  placeholder="জীবনসঙ্গীর পর্দা সম্পর্কে যেমনটা চান-">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="পেশা *" class="font-weight-bold">পেশা * </label>
            <input type="text" class="form-control" name="economic_status"  value=" @if($spouse_expect != null) {{$spouse_expect->economic_status}} @endif"   placeholder="পেশা *">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="অর্থনৈতিক অবস্থা *" class="font-weight-bold">অর্থনৈতিক অবস্থা * <span class="text-mute">(Required)</span></label>
            <input type="text" class="form-control"  name="economic_status"  value=" @if($spouse_expect != null) {{$spouse_expect->economic_status}} @endif"  placeholder="অর্থনৈতিক অবস্থা *" required>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="পারিবারিক অবস্থা" class="font-weight-bold">পারিবারিক অবস্থা </label>
            <input type="text" class="form-control"name="family_status"  value=" @if($spouse_expect != null) {{$spouse_expect->family_status}} @endif"  placeholder="পারিবারিক অবস্থা">
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="জীবনসঙ্গীর যে বৈশিষ্ট্য বা গুণাবলী আশা করেন *" class="font-weight-bold">জীবনসঙ্গীর যে বৈশিষ্ট্য বা গুণাবলী আশা করেন * <span class="text-mute">(Required)</span></label>
            <textarea colspan="3" rows="2" class="form-control"  name="character_spouse"  placeholder="জীবনসঙ্গীর যে বৈশিষ্ট্য বা গুণাবলী আশা করেন *" required> @if($spouse_expect != null) {{$spouse_expect->character_spouse}} @endif</textarea>
            
            </div>
            </div>
            </div>
            <div class="card mb-3 class" data-condtion id="id">
            <div class="card-body">
            <div class="form-group">
            <label for="জীবনসংঙ্গীর জেলা যেমনটা চাচ্ছেন?" class="font-weight-bold">জীবনসংঙ্গীর জেলা যেমনটা চাচ্ছেন? </label>
            <input type="text" class="form-control"  name="spouse_expection" value=" @if($spouse_expect != null) {{$spouse_expect->spouse_expection}} @endif" placeholder="জীবনসংঙ্গীর জেলা যেমনটা চাচ্ছেন?">
            
            </div>
            </div>
            </div>
            </div>
            @csrf
            <div class="form-group">
            <button class="btn btn-success btn-block btn-sm">Edit</button>
            </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>

  
  <!-- Modal -->
  <div class="modal fade" id="ask_authorities" tabindex="-1" role="dialog" aria-labelledby="ask_authoritiesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ask_authoritiesLabel">কর্তৃপক্ষের জিজ্ঞাসা</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form  action="{{URL::to("/update_registation")}}"  method="POST" >
                <?php  $ask_authorities =  App\Models\ask_authorities::where(['user_table_id'=>0])->first()?>
                <input type="hidden" name="t_name" value="ask_authorities">
                <input type="hidden" name="user_table_id" value="{{$user_id}}">

                <div class="card mb-3 class" data-condtion id="id">
                <div class="card-body">
                <div class="form-group">
                <label for="বায়োডাটা জমা দিচ্ছেন তা অভিভাবক জানেন? *" class="font-weight-bold">বায়োডাটা জমা দিচ্ছেন তা অভিভাবক জানেন? * <span class="text-mute">(Required)</span></label>
                <select class="form-control" name="submitted_biodata_allowed"  placeholder="বায়োডাটা জমা দিচ্ছেন তা অভিভাবক জানেন? *" required>
                <option value>Select</option>
                <option value="1" @if($ask_authorities != null) @if($ask_authorities->submitted_biodata_allowed=="1") {{"Selected"}} @endif @endif >হ্যা</option>
                <option value="0" @if($ask_authorities != null) @if($ask_authorities->submitted_biodata_allowed=="0") {{"Selected"}} @endif @endif >না</option>
                </select>
                
                </div>
                </div>
                </div>
                <div class="card mb-3 class" data-condtion id="id">
                <div class="card-body">
                <div class="form-group">
                <label for="আল্লাহ&#039;র শপথ করে সাক্ষ্য দিন, যে তথ্যগুলো দিচ্ছেন সব সত্য? *" class="font-weight-bold">আল্লাহ&#039;র শপথ করে সাক্ষ্য দিন, যে তথ্যগুলো দিচ্ছেন সব সত্য? * <span class="text-mute">(Required)</span></label>
                <select class="form-control" name="is_true_information"   placeholder="আল্লাহ&#039;র শপথ করে সাক্ষ্য দিন, যে তথ্যগুলো দিচ্ছেন সব সত্য? *" required>
                <option value>Select</option>
                <option value="1"  @if($ask_authorities != null)  @if($ask_authorities->is_true_information=="1") {{"Selected"}} @endif  @endif>হ্যা</option>
                <option value="0"  @if($ask_authorities != null)  @if($ask_authorities->is_true_information=="0") {{"Selected"}} @endif  @endif>না</option>
                </select>
                
                </div>
                </div>
                </div>
                <div class="card mb-3 class" data-condtion id="id">
                <div class="card-body">
                <div class="form-group">
                <label for="কোনো মিথ্যা তথ্য দিয়ে থাকলে তার দুনিয়াবী ও আখিরাতের দায়ভার ওয়েবসাইট কর্তৃপক্ষ নিবে না। আপনি কি রাজি? *" class="font-weight-bold">কোনো মিথ্যা তথ্য দিয়ে থাকলে তার দুনিয়াবী ও আখিরাতের দায়ভার ওয়েবসাইট কর্তৃপক্ষ নিবে না। আপনি কি রাজি? * <span class="text-mute">(Required)</span></label>
                <select class="form-control" name="authority_responsibility"   placeholder="কোনো মিথ্যা তথ্য দিয়ে থাকলে তার দুনিয়াবী ও আখিরাতের দায়ভার ওয়েবসাইট কর্তৃপক্ষ নিবে না। আপনি কি রাজি? *" required>
                <option value>Select</option>
                <option value="1"  @if($ask_authorities != null)  @if($ask_authorities->authority_responsibility=="1") {{"Selected"}} @endif  @endif>হ্যা</option>
                <option value="0"  @if($ask_authorities != null)  @if($ask_authorities->authority_responsibility=="0") {{"Selected"}} @endif  @endif>না</option>
                </select>
                
                </div>
                </div>
                </div>
                </div>
                @csrf
                <div class="form-group">
                <button class="btn btn-success btn-block btn-sm">Edit</button>
                </div>
                </form>
        </div>
        
      </div>
    </div>
  </div>

  
<!-- Modal -->
<div class="modal fade" id="communication" tabindex="-1" role="dialog" aria-labelledby="communicationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="communicationLabel">যোগাযোগ</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{URL::to("/update_registation")}}"  method="POST"  >
            
            <?php  $communication =  App\Models\communication::where(['user_table_id'=>$user_id])->first() ?>
            <input type="hidden" name="user_table_id" value="{{$user_id}}">

        <div class="card mb-3 class" data-condtion id="id">
        <div class="card-body">
        <div class="form-group">
        <label for="অভিভাবকের নাম্বার *" class="font-weight-bold">অভিভাবকের নাম্বার * </label>
        <input type="text" class="form-control" value=" @if($communication != null) {{$communication->parent_number}} @endif"  name="parent_number"  placeholder="অভিভাবকের নাম্বার *">
        
        </div>
        </div>
        </div>
        <div class="card mb-3 class" data-condtion id="id">
        <div class="card-body">
        <div class="form-group">
        <label for="যার নাম্বার লিখেছেন *" class="font-weight-bold">যার নাম্বার লিখেছেন * <span class="text-mute">(Required)</span></label>
        <input type="text" class="form-control" name="who_wrote_number" value=" @if($communication != null ) {{$communication->who_wrote_number}} @endif"   placeholder="যার নাম্বার লিখেছেন *" required>
        
        </div>
        </div>
        </div>
        <div class="card mb-3 class" data-condtion id="id">
        <div class="card-body">
        <div class="form-group">
        <label for="বায়োডাটা গ্রহণের ই-মেইল এড্রেস *" class="font-weight-bold">বায়োডাটা গ্রহণের ই-মেইল এড্রেস * <span class="text-mute">(Required)</span></label>
        <input type="text" class="form-control"  name="email_recived_biodata"  value=" @if($communication != null ) {{$communication->email_recived_biodata}} @endif"  placeholder="বায়োডাটা গ্রহণের ই-মেইল এড্রেস *" required>
        
        </div>
        </div>
        </div>
        <div class="card mb-3 class" data-condtion id="id">
        <div class="card-body">
        <div class="form-group">
        <label for="আপনার নাম্বার (শুধুমাত্র আপনি ও কতৃপক্ষ বাদে কেউ দেখতে পাচ্ছে না) *" class="font-weight-bold">আপনার নাম্বার (শুধুমাত্র আপনি ও কতৃপক্ষ বাদে কেউ দেখতে পাচ্ছে না) * <span class="text-mute">(Required)</span></label>
        <input type="text" class="form-control"  number_visible_authority="number_visible_authority"  value=" @if($communication != null ) {{$communication->number_visible_authority}} @endif"   placeholder="আপনার নাম্বার (শুধুমাত্র আপনি ও কতৃপক্ষ বাদে কেউ দেখতে পাচ্ছে না) *" required />
        <input type="hidden" name="t_name" value="communication">
        </div>
        </div>
        </div>
        </div>
        @csrf
        <div class="form-group">
        <button class="btn btn-success btn-block btn-sm">Edit</button>
        </div>
        </form>
        </div>
       
      </div>
    </div>
 