@extends("master.layout")
@section("content")
<div class="container-fluid">
   <div class="row">
    <div class="col">
       <div class="card">
        <div class="card-header">
            <div class="card-text">
                <h4>List Register</h4>
                @if (session('message'))
        <div class="alert  alert-success ">
            {{ session('message') }}
        </div>
        @endif
            </div>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                  <h6 class="text-center">প্রথমিক তথ্য</h6>
                  <button class="btn btn-outline-danger btn-sm float-right"  data-toggle="modal" data-target="#primary_info"><i class="fa fa-edit    "></i> Update</button>
                </div>
           
                <div class="card-body">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Info</th>
                      </tr>
                     
                    </thead>
                    <?php  $primary_info =  App\Models\primary_info::where(['user_table_id'=>$biodata_id])->first(); ?>
                
                    @if( $primary_info != null)
                  
                    <tbody>
                        <tr>
                        <th scope="row">আমি খুঁজছি</th>
                        <td>@if($primary_info->search_type == 1) পাত্রের বায়োডাটা @else পাত্রীর বায়োডাটা @endif</td>
                        </tr>

                        <tr>
                            <th scope="row">ব্যবহৃত নাম (Primary)</th>
                            <td>{{$primary_info->user_name}}</td>
                            </tr>
                        <tr>
                            <th scope="row">জন্ম তারিখ</th>
                            <td>{{$primary_info->date_of_birth}}</td>
                        </tr>
                        <tr>
                            <th scope="row">জেলা</th>
                            <td>@foreach( App\Models\districts::get() as $district ) 
                                @if($primary_info->district==$district->id)
                               {{$district->bn_name}}
                                @endif
                                @endforeach</td>
                            </tr>
                        </tr>
                        
                        
                    </tbody>
                    @endif
                  </table>
                </div>
              </div>
             
              <div class="card d-none">
                <div class="card-header">
                  <h6 class="text-center">IOM তথ্য</h6>
                </div>
    
                <div class="card-body">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Info</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php  $iom_info =  App\Models\iom_info::where(['user_table_id'=>$biodata_id])->first(); ?>
                        @if( $iom_info != null)
                    <tr>
                    <th scope="row">আপনি কি আইওএমের স্টুডেন্ট?</th>
                    <td>@if($iom_info->is_iom_student ==1) হ্যাঁ @else না  @endif</td>
                    </tr>
                    @if($iom_info->is_iom_student =="1")
                    <tr>
                    <th scope="row">আপনার কোর্সের নাম ও ব্যাচ নম্বর:</th>
                    <td>{{$iom_info->course_and_batch_no}} </td>
                    </tr>
                    @endif
                    </tbody>
                    @endif
                  </table>
                </div>
              </div>
    
              <div class="card">
                <div class="card-header">
               
                  <h6 class="text-center">সাধারণ তথ্য</h6>
                  <button class="btn btn-outline-danger btn-sm float-right"  data-toggle="modal" data-target="#general_info"><i class="fa fa-edit"></i> Update</button>

                </div>
                <?php  $general_info =  App\Models\general_info::where(['user_table_id'=>$biodata_id])->first(); ?>
                <div class="card-body">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Info</th>
                      </tr>
                    </thead>
                    @if( $general_info != null)
                    <tbody>
                        <tr>
                        <th scope="row">বায়োডাটার ধরন </th>
                        <td>@if($general_info->biodata_type == 1) পাত্রের বায়োডাটা @else পাত্রীর বায়োডাটা @endif</td>
                        </tr>
                        <tr>
                        <th scope="row">বৈবাহিক অবস্থা</th>
                        <td>{{$general_info->marid_type}}</td>
                        </tr>
                        <tr>
                        <th scope="row">বর্তমান ঠিকানা </th>
                        <td>@foreach( App\Models\districts::get() as $district ) 
                            @if($general_info->present_address==$district->id)
                           {{$district->bn_name}}
                            @endif
                            @endforeach</td>
                        </tr>
                        <tr>
                        <th scope="row">বিভাগ </th>
                        <td>@foreach( App\Models\districts::get() as $district ) 
                            @if($general_info->divition==$district->id)
                            {{$district->bn_name}}
                            @endif
                            @endforeach বিভাগ</td>
                        </tr>
                        <tr>
                        <th scope="row">স্থায়ী ঠিকানা </th>
                        <td>@foreach( App\Models\districts::get() as $district ) 
                            @if($general_info->permanent_address==$district->id)
                            <p>{{$district->bn_name}}</p>
                            @endif
                            @endforeach</td>
                        </tr>
                        <tr>
                        <th scope="row">বিভাগ </th>
                        <td>@foreach( App\Models\districts::get() as $district ) 
                            @if($general_info->permanent_divition==$district->id)
                            <p>{{$district->bn_name}}</p>
                            @endif
                            @endforeach বিভাগ</td>
                        </tr>
                        <tr>
                        <th scope="row">জন্মসন (আসল) </th>
                        <td>{{$general_info->birth}}</td>
                        </tr>
                        <tr>
                        <th scope="row">গাত্রবর্ণ</th>
                        <td>
                            {{$general_info->color}}
                        </td>
                        </tr>
                        <tr>
                        <th scope="row">উচ্চতা</th>
                        <td>
                            
                        @if($general_info->height=="1") ৪&#039;১&#039;&#039;  @endif
                        @if($general_info->height=="2") ৪&#039;২&#039;&#039;  @endif
                        @if($general_info->height=="3") ৪&#039;৩&#039;&#039;  @endif
                        @if($general_info->height=="4") ৪&#039;৪&#039;&#039;  @endif
                        @if($general_info->height=="5") ৪&#039;৫&#039;&#039;  @endif
                        @if($general_info->height=="6") ৪&#039;৬&#039;&#039;  @endif
                        @if($general_info->height=="7") ৪&#039;৭&#039;&#039;  @endif
                        @if($general_info->height=="8") ৪&#039;৮&#039;&#039;  @endif
                        @if($general_info->height=="9") ৪&#039;৯&#039;&#039;  @endif
                        @if($general_info->height=="10") ৪&#039;১০&#039;&#039;  @endif
                        @if($general_info->height=="11") ৪&#039;১১&#039;&#039;  @endif
                        @if($general_info->height=="12")   <p>  ৪&#039;১২&#039;&#039;</p> @endif
                        @if($general_info->height=="13") ৫&#039;০&#039;&#039;  @endif
                        @if($general_info->height=="14") ৫&#039;১&#039;&#039;  @endif
                        @if($general_info->height=="15") ৫&#039;২&#039;&#039;  @endif
                        @if($general_info->height=="16") ৫&#039;৩&#039;&#039;  @endif
                        @if($general_info->height=="17") ৫&#039;৪&#039;&#039;  @endif
                        @if($general_info->height=="18") ৫&#039;৫&#039;&#039;  @endif
                        @if($general_info->height=="19") ৫&#039;৬&#039;&#039;  @endif
                        @if($general_info->height=="20") ৫&#039;৭&#039;&#039;  @endif
                        @if($general_info->height=="21") ৫&#039;৮&#039;&#039;  @endif
                        @if($general_info->height=="22") ৫&#039;৯&#039;&#039;  @endif
                        @if($general_info->height=="23") ৫&#039;১০&#039;&#039;  @endif
                        @if($general_info->height=="24") ৫&#039;১১&#039;&#039;  @endif
                        @if($general_info->height=="25") ৫&#039;১২&#039;&#039;  @endif
                        @if($general_info->height=="26") ৬&#039;০&#039;&#039;  @endif
                        @if($general_info->height=="27") ৬&#039;১&#039;&#039;  @endif
                        @if($general_info->height=="28") ৬&#039;২&#039;&#039;  @endif
                        @if($general_info->height=="29") ৬&#039;৩&#039;&#039;  @endif
                        @if($general_info->height=="30") ৬&#039;৪&#039;&#039;  @endif
                        @if($general_info->height=="31") ৬&#039;৫&#039;&#039;  @endif
                        @if($general_info->height=="32") ৬&#039;৬&#039;&#039;  @endif
                        @if($general_info->height=="33") ৬&#039;৭&#039;&#039;  @endif
                        @if($general_info->height=="34") ৬&#039;৮&#039;&#039;  @endif
                        @if($general_info->height=="35") ৬&#039;৯&#039;&#039;  @endif
                        @if($general_info->height=="36") ৬&#039;১০&#039;&#039;  @endif
                        @if($general_info->height=="37") ৬&#039;১১&#039;&#039;  @endif
                        @if($general_info->height=="38") ৬&#039;১২&#039;&#039;  @endif
                        </td>
                        </tr>
                        <tr>
                        <th scope="row">ওজন</th>
                        <td>{{$general_info->weight}} কেজি</td>
                        </tr>
                        <tr>
                        <th scope="row">রক্তের গ্রুপ </th>
                        <td>{{$general_info->blood_group}}</td>
                        </tr>
                        <tr>
                        <th scope="row">পেশা</th>
                        <td>{{$general_info->profession}}</td>
                        </tr>
                        <tr>
                        </tr>
                        </tbody>
                    @endif
                  </table>
                </div>
              </div>
    
              <div class="card">
                <div class="card-header">
                  <h6 class="text-center">ঠিকানা</h6>
                  
                  <button class="btn btn-outline-danger btn-sm float-right"  data-toggle="modal" data-target="#address"><i class="fa fa-edit"></i> Update</button>

                </div>
                <?php  $address =  App\Models\address::where(['user_table_id'=>$biodata_id])->first(); ?>
                <div class="card-body">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Info</th>
                      </tr>
                    </thead>
                    @if( $address != null)
                    <tbody>
                        <tr>
                        <th scope="row">স্থায়ী ঠিকানা </th>
                        <td>{{ $address->present_address}}</td>
                        </tr>
                        <tr>
                        <th scope="row">বর্তমান ঠিকানা </th>
                        <td>{{ $address->permanent_address}}</td>
                        </tr>
                        <tr>
                        <th scope="row">কোথায় বড় হয়েছেন? </th>
                        <td>{{ $address->growing_up}}</td>
                        </tr>
                        </tbody>
                    @endif
                  </table>
                </div>
              </div>
    
              <div class="card">
                <div class="card-header">
                  <h6 class="text-center">শিক্ষাগত যোগ্যতা</h6>
                  <button class="btn btn-outline-danger btn-sm float-right"  data-toggle="modal" data-target="#education_info"><i class="fa fa-edit"></i> Update</button>

                </div>
                <?php  $education_info =  App\Models\education_info::where(['user_table_id'=>$biodata_id])->first() ?>

                <div class="card-body">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Info</th>
                      </tr>
                    </thead>
                    @if( $education_info != null)
                    <tbody>
                        <tr>
                        <th scope="row">কোন মাধ্যমে পড়াশোনা করেছেন? </th>
                        <td>@if( $education_info->education_type ==1)মাদ্রাসা@else জেনারেল@endif</td>
                        </tr>
                        <tr>
                        </tr>
                        <tr>
                        </tr>
                        @if($education_info->education_type ==1)
                        <tr>
                            <th scope="row">আপনি কি হাফেজ?</th>
                            <td>@if($education_info->is_hafez ==1) হ্যাঁ @else না  @endif</td>
                        </tr>
                        
                        <tr>
                            <th scope="row">দাওরায়ে হাদীস পাশ করেছেন?</th>
                            <td>@if($education_info->is_passed_dawrae_hadith ==1) হ্যাঁ @else না  @endif</td>
                        </tr>
                        
                        @else
                        <tr>
                        <th scope="row">মাধ্যমিক (SSC) / সমমান পাশ করেছেন?</th>
                        <td>@if($education_info->is_passed_ssc ==1) হ্যাঁ @else না  @endif</td>
                        </tr>
                        <tr>
                        <th scope="row">মাধ্যমিক (SSC) / সমমান ফলাফল</th>
                        <td>{{$education_info->result_ssc }}</td>
                        </tr>
                        <tr>
                        <th scope="row">মাধ্যমিক (SSC) / সমমান বিভাগ</th>
                        <td>{{$education_info->divition_ssc }}</td>
                        </tr>
                        <tr>
                        <th scope="row">মাধ্যমিক (SSC) / সমমান পাসের সন</th>
                        <td>{{$education_info->ssc_passed_year }}</td>
                        </tr>
                        <tr>
                        <th scope="row">উচ্চ মাধ্যমিক (HSC) / সমমান পাশ করেছেন?</th>
                        <td>@if($education_info->is_passed_hsc ==1) হ্যাঁ @else না  @endif</td>
                        </tr>
                        <tr>
                        <th scope="row">উচ্চ মাধ্যমিক (HSC) / সমমানের বিভাগ</th>
                        <td>{{$education_info->divition_hsc }}</td>
                        </tr>
                        <tr>
                        <th scope="row">উচ্চ মাধ্যমিক (HSC) / সমমান ফলাফল</th>
                        <td>{{$education_info->result_hsc }}</td>
                        </tr>
                        <tr>
                        <th scope="row">উচ্চ মাধ্যমিক (HSC) / সমমান পাসের সন</th>
                        <td>{{$education_info->hsc_passed_year }}</td>
                        </tr>
                        <tr>
                        <th scope="row">স্নাতক / স্নাতক (সম্মান) / সমমান শিক্ষাগত যোগ্যতা</th>
                        <td>{{$education_info->ssc_passed_year }}</td>
                        </tr>
                        <tr>
                        <th scope="row">শিক্ষাপ্রতিষ্ঠানের নাম</th>
                        <td>{{$education_info->honours_passed }}</td>
                        </tr>
                        <tr>
                        <th scope="row">পাসের সন</th>
                        <td>{{$education_info->honours_passed_year }}</td>
                        </tr>
                        @endif
                        <tr>
                        <th scope="row">সর্বোচ্চ শিক্ষাগত যোগ্যতা</th>
                        <td>{{$education_info->highest_education }}</td>
                        </tr>
                        <tr>
                        <th scope="row">অন্যান্য শিক্ষাগত যোগ্যতা</th>
                        <td>{{$education_info->other_education }}এ</td>
                        </tr>
                        </tbody>
                    @endif
                  </table>
                </div>
              </div>
    
              <div class="card">
                <div class="card-header">
                  <h6 class="text-center">পারিবারিক তথ্য</h6>
                  <button class="btn btn-outline-danger btn-sm float-right"  data-toggle="modal" data-target="#family_info"><i class="fa fa-edit"></i> Update</button>

                </div>
                <?php  $family_info =  App\Models\family_info::where(['user_table_id'=>$biodata_id])->first() ?>

                <div class="card-body">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Info</th>
                      </tr>
                    </thead>
                    @if( $family_info != null)
                    <tbody>
                    
                    <tr>
                    <th scope="row">পিতার পেশা </th>
                    <td>{{$family_info->profession_father}}</td>
                    </tr>
                    <tr>
                    <th scope="row">মাতার পেশা </th>
                    <td>{{$family_info->profession_mother}}</td>
                    </tr>
                    <tr>
                    <th scope="row">বোন কয়জন? </th>
                    <td>{{$family_info->sister}}</td>
                    </tr>
                    <tr>
                    <th scope="row">ভাই কয়জন? </th>
                    <td>{{$family_info->borther}}</td>
                    </tr>
                    <tr>
                    <th scope="row">বোনদের সম্পর্কে তথ্য</th>
                    <td>{{$family_info->info_sister}}</td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    <th scope="row">চাচা মামাদের পেশা</th>
                    <td>{{$family_info->uncle }}</td>
                    </tr>
                    <tr>
                    <th scope="row">পরিবারের অর্থনৈতিক ও সামাজিক অবস্থা </th>
                    <td>{{$family_info->economic_social_status}}</td>
                    </tr>
                    <tr>
                    <th scope="row">আপনার পরিবারের দ্বীনি অবস্থা কেমন? (বিস্তারিত বর্ননা করুন )</th>
                    <td>{{$family_info->islamic_status}}</td>
                    </tr>
                    </tbody>
                    @endif
                  </table>
                </div>
              </div>
    
              <div class="card">
                <div class="card-header">
                  <h6 class="text-center">ব্যক্তিগত তথ্য</h6>
                  <button class="btn btn-outline-danger btn-sm float-right"  data-toggle="modal" data-target="#personal_info"><i class="fa fa-edit"></i> Update</button>

                </div>
    
                <div class="card-body">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Info</th>
                      </tr>
                    </thead>
                    <?php  $personal_info =  App\Models\personal_info::where(['user_table_id'=>$biodata_id])->first() ?>

                    @if( $personal_info != null)
                    <tbody>
                    
                    <tr>
                    <th scope="row">প্রতিদিন পাঁচ ওয়াক্ত নামাজ পড়া হয় ? </th>
                    <td>{{$personal_info->prayer}}</td>
                    </tr>
                    <tr>
                    <th scope="row">নিয়মিত নামায কত সময় যাবত পড়ছেন? </th>
                    <td>{{$personal_info->prayer_year}}</td>
                    </tr>
                    <tr>
                    <th scope="row">মাহরাম/গাইরে-মাহরাম মেনে চলেন কি? </th>
                    <td>{{$personal_info->mahram_comply}}</td>
                    </tr>
                    <tr>
                    <th scope="row">শুদ্ধভাবে কুরআন তিলওয়াত করতে পারেন? </th>
                    <td>{{$personal_info->recite_quran}}</td>
                    </tr>
                    <tr>
                    <th scope="row">ঘরের বাহিরে সাধারণত কী ধরণের পোশাক পরেন?</th>
                    <td>{{$personal_info->wearing_type}}</td>
                    </tr>
                    <tr>
                    <th scope="row">কোনো রাজনৈতিক দর্শন থাকলে লিখুন </th>
                    <td>{{$personal_info->political_philosophy}}</td>
                    </tr>
                    <tr>
                    <th scope="row">নাটক/সিনেমা/সিরিয়াল/গান/খেলা এসব দেখেন বা শুনেন? </th>
                    <td>{{$personal_info->entertainment}}</td>
                    </tr>
                    <tr>
                    <th scope="row">মানসিক বা শারীরিক কোনো রোগ আছে কি? </th>
                    <td>{{$personal_info->disease}}</td>
                    </tr>
                    <tr>
                    <th scope="row">দ্বীনের কোন বিশেষ মেহনতে যুক্ত আছেন? </th>
                    <td>{{$personal_info->involved_religion}}</td>
                    </tr>
                    <tr>
                    <th scope="row">আপনি কি কোনো পীরের মুরিদ বা অনুসারী ? </th>
                    <td>{{$personal_info->follower_pir}}</td>
                    </tr>
                    <tr>
                    <th scope="row">মাজার সম্পর্কে আপনার ধারণা বা বিশ্বাস কি? </th>
                    <td>{{$personal_info->shrines}}</td>
                    </tr>
                    <tr>
                    <th scope="row">আপনার পছন্দের অন্তত ৩ টি ইসলামী বই এর নাম লিখুন</th>
                    <td>{{$personal_info->islamic_books}}</td>
                    </tr>
                    <tr>
                    <th scope="row">আপনার পছন্দের অন্তত ৩ জন আলেমের নাম লিখুন </th>
                    <td>{{$personal_info->scholars_name	}}</td>
                    </tr>
                    <tr>
                    <th scope="row">বিশেষ দ্বীনি বা দুনিয়াবি যোগ্যতা (যদি থাকে)</th>
                    <td>{{$personal_info->special_qualifications}}</td>
                    </tr>
                    <tr>
                    <th scope="row">নিজের সম্পর্কে কিছু লিখুন </th>
                    <td>{{$personal_info->write_yourself}}</td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    <th scope="row">কোন মাজহাব অনুসরণ করেন?</th>
                    <td>{{$personal_info->mazhab}}</td>
                    </tr>
                    <tr>
                    <th scope="row">নজরের হেফাজত করেন?</th>
                    <td>{{$personal_info->save_eye}}</td>
                    </tr>
                    <tr>
                    <th scope="row">দ্বীনি ফিউচার প্ল্যন কি আপনার?</th>
                    <td>{{$personal_info->future_plane}}</td>
                    </tr>
                    <tr>
                    <th scope="row">অবসর সময় কিভাবে কাটান?</th>
                    <td>{{$personal_info->spend_free_time}}</td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    <th scope="row">বাড়িতে কি কি দায়িত্ব আপনি পালন করে থাকেন?</th>
                    <td>{{$personal_info->spend_free_time}}</td>
                    </tr>
                    <tr>
                    <th scope="row">নারী-পুরুষ সমঅধীকার বিষয়টাকে আপনি কিভাবে দেখেন?</th>
                    <td>{{$personal_info->congregation_pray}}</td>
                    </tr>
                    <tr>
                    </tr>
                    </tbody>
                    @endif
                  </table>
                </div>
              </div>
    
              <div class="card">
                <div class="card-header">
                  <h6 class="text-center">বিয়ে সংক্রান্ত তথ্য</h6>
                  <button class="btn btn-outline-danger btn-sm float-right"  data-toggle="modal" data-target="#marriage_info"><i class="fa fa-edit"></i> Update</button>

                </div>
    
                <div class="card-body">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Info</th>
                      </tr>
                    </thead>
                    <?php  $marriage_info =  App\Models\marriage_info::where(['user_table_id'=>$biodata_id])->first(); ?>
                    {{-- @dd($marriage_info); --}}
                    @if( $marriage_info != null)
                    <tbody>
                    <tr>
                    <th scope="row">অভিভাবক আপনার বিয়েতে রাজি কি না? </th>
                    <td>{{$marriage_info->is_agree}}</td>
                    </tr>
                    <tr>
                    <th scope="row">বিয়ে কেন করছেন? বিয়ে সম্পর্কে আপনার ধারণা কি? </th>
                    <td>{{$marriage_info->thought_marriage}}</td>
                    </tr>
                    {{-- @dd($marriage_info->selection_mind) --}}
                    <tr>
                    <th scope="row">পাত্র/পাত্রী নির্বাচনে কোন বিষয়গুলো ছাড় দেয়ার মানসিকতা রাখেন?</th>
                    <td>
                    @if($marriage_info->selection_mind=="1") জেলা  @endif
                    @if($marriage_info->selection_mind=="2") ছাড় দিতে রাজি নই  @endif
                    @if($marriage_info->selection_mind=="3") আর্থিক অবস্থা  @endif
                    @if($marriage_info->selection_mind=="4") আর্থিক অবস্থা ও গায়ের রং  @endif
                    @if($marriage_info->selection_mind=="5") আর্থিক অবস্থা ও জেলা  @endif
                    @if($marriage_info->selection_mind=="6") গায়ের রং ও জেলা  @endif
                    @if($marriage_info->selection_mind=="7") সবক্ষেত্রেই ছাড় দিতে রাজি আছি  @endif
                    @if($marriage_info->selection_mind=="8") গায়ের রং  @endif
                    </td>
                    </tr>
                    
                    
                    </tbody>
                    </table>
                    @endif
                    </div>
                    </div>
                    <div class="card profile-card-content mb-4 d-none">
                    <div class="card-header text-center bg-transparent p-0 m-0 ">
                    <h5>যেমন জীবনসঙ্গী আশা করেন</h5>
                    <button class="btn btn-outline-danger btn-sm float-right"  data-toggle="modal" data-target="#spouse_expect"><i class="fa fa-edit"></i> Update</button>

                    </div>
                    <?php  $spouse_expect =  App\Models\spouse_expect::where(['user_table_id'=>$biodata_id])->first(); ?>

                    <div class="card-body m-0 p-0">
                      @if($spouse_expect != null)
                    <table class="table table-striped table-sm m-0">
                    <tbody>
                    
                    <tr>
                    <th scope="row">বয়স </th>
                    <td>{{$spouse_expect->thought_marriage}}</td>
                    </tr>
                    <tr>
                    <th scope="row">গাত্রবর্ণ </th>
                    <td>{{$spouse_expect->color}}</td>
                    </tr>
                    <tr>
                    <th scope="row">নূন্যতম উচ্চতা </th>
                    <td>{{$spouse_expect->min_height}}</td>
                    </tr>
                    <tr>
                    <th scope="row">নূন্যতম শিক্ষাগত যোগ্যতা </th>
                    <td>{{$spouse_expect->min_education}}</td>
                    </tr>
                    <tr>
                    <th scope="row">বৈবাহিক অবস্থা </th>
                    <td>{{$spouse_expect->marid_status}}</td>
                    </tr>
                    <tr>
                    <th scope="row">পেশা </th>
                    <td>{{$spouse_expect->profession}}</td>
                    </tr>
                    <tr>
                    <th scope="row">অর্থনৈতিক অবস্থা </th>
                    <td>{{$spouse_expect->economic_status}}</td>
                    </tr>
                    <tr>
                    <th scope="row">পারিবারিক অবস্থা</th>
                    <td>{{$spouse_expect->family_status}}</td>
                    </tr>
                    <tr>
                    <th scope="row">জীবনসঙ্গীর যে বৈশিষ্ট্য বা গুণাবলী আশা করেন </th>
                    <td>{{$spouse_expect->spouse_expection}}</td>
                    </tr>
                    <tr>
                    <th scope="row">জীবনসংঙ্গীর জেলা যেমনটা চাচ্ছেন?</th>
                    <td>{{$spouse_expect->character_spouse}}</td>
                    </tr>
                    </tbody>
                    </table>
                    @endif
                  </table>
                </div>
              </div>
    
              <div class="card">
                <div class="card-header">
                  <h6 class="text-center">অন্যান্য তথ্য</h6>
                  <button class="btn btn-outline-danger btn-sm float-right"  data-toggle="modal" data-target="#other_info"><i class="fa fa-edit"></i> Update</button>

                </div>
    
                <div class="card-body">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Info</th>
                      </tr>
                    </thead>
                    <?php  $other_info =  App\Models\other_info::where(['user_table_id'=>$biodata_id])->first() ?>

                    @if( $other_info != null)
                    <tbody>
                    
                    <tr>
                    <th scope="row">পেশা সম্পর্কিত তথ্য</th>
                    <td>{{$other_info->profession}}</td>
                    </tr>
                    <tr>
                    <th scope="row">বিশেষ কিছু যদি জানাতে চান</th>
                    <td>{{$other_info->asking}}</td>
                    </tr>
                    </tbody>
                    @endif
                  </table>
                </div>
              </div>
    
              <div class="card">
                <div class="card-header">
                  <h6 class="text-center">যেমন জীবনসঙ্গী আশা করেন</h6>
                  <button class="btn btn-outline-danger btn-sm float-right"  data-toggle="modal" data-target="#spouse_expect"><i class="fa fa-edit"></i> Update</button>

                </div>
    
                <div class="card-body">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Info</th>
                      </tr>
                    </thead>
                    <?php  $spouse_expect =  App\Models\spouse_expect::where(['user_table_id'=>$biodata_id])->first() ?>

                    @if( $spouse_expect != null)
                    <tbody>
                    
                    <tr>
                    <th scope="row">বয়স </th>
                    <td>{{$spouse_expect->thought_marriage}}</td>
                    </tr>
                    <tr>
                    <th scope="row">গাত্রবর্ণ </th>
                    <td>{{$spouse_expect->color}}</td>
                    </tr>
                    <tr>
                    <th scope="row">নূন্যতম উচ্চতা </th>
                    <td>{{$spouse_expect->min_height}}</td>
                    </tr>
                    <tr>
                    <th scope="row">নূন্যতম শিক্ষাগত যোগ্যতা </th>
                    <td>{{$spouse_expect->min_education}}</td>
                    </tr>
                    <tr>
                    <th scope="row">বৈবাহিক অবস্থা </th>
                    <td>{{$spouse_expect->marid_status}}</td>
                    </tr>
                    <tr>
                    <th scope="row">পেশা </th>
                    <td>{{$spouse_expect->profession}}</td>
                    </tr>
                    <tr>
                    <th scope="row">অর্থনৈতিক অবস্থা </th>
                    <td>{{$spouse_expect->economic_status}}</td>
                    </tr>
                    <tr>
                    <th scope="row">পারিবারিক অবস্থা</th>
                    <td>{{$spouse_expect->family_status}}</td>
                    </tr>
                    <tr>
                    <th scope="row">জীবনসঙ্গীর যে বৈশিষ্ট্য বা গুণাবলী আশা করেন </th>
                    <td>{{$spouse_expect->spouse_expection}}</td>
                    </tr>
                    <tr>
                    <th scope="row">জীবনসংঙ্গীর জেলা যেমনটা চাচ্ছেন?</th>
                    <td>{{$spouse_expect->character_spouse}}</td>
                    </tr>
                    </tbody>
                    @endif
                  </table>
                </div>
              </div>
    
              <div class="card">
                <div class="card-header">
                  <h6 class="text-center">যোগাযোগ</h6>
                  <button class="btn btn-outline-danger btn-sm float-right"  data-toggle="modal" data-target="#communication"><i class="fa fa-edit"></i> Update</button>
                </div>
    
                <div class="card-body">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Info</th>
                      </tr>
                    </thead>
                    <?php  $communication =  App\Models\communication::where(['user_table_id'=>$biodata_id])->first() ?>

                    @if( $communication != null)
                    <tbody>
                    
                    <tr>
                    <th scope="row">অভিভাবকের নাম্বার </th>
                    <td>{{$communication->parent_number}}</td>                    
                    </tr>
                    <tr>
                    <th scope="row">যার নাম্বার লিখেছে </th>
                    <td>{{$communication->who_wrote_number}}</td>                    
                    </tr>
                    <tr>
                    <th scope="row">বায়োডাটা গ্রহণের ই-মেইল এড্রেস</th>
                    <td>{{$communication->email_recived_biodata}}</td> 
                    </tr>

                    <tr>
                        <th scope="row">আপনার নাম্বার (শুধুমাত্র আপনি ও কতৃপক্ষ বাদে কেউ দেখতে পাচ্ছে না)</th>
                        <td>{{$communication->number_visible_authority}}</td> 
                        </tr>
                    </tbody>
                    @endif
                  </table>
                </div>
              </div>
    
              <div class="card">
                <div class="card-header">
                  <h6 class="text-center"> কর্তৃপক্ষের জিজ্ঞাসা</h6>
                  <button class="btn btn-outline-danger btn-sm float-right"  data-toggle="modal" data-target="#ask_authorities"><i class="fa fa-edit"></i> Update</button>

                </div>
    
                <div class="card-body">
                  <table class="table table-striped table-hover table-sm">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Info</th>
                      </tr>
                    </thead>
                    <?php  $ask_authorities =  App\Models\ask_authorities::where(['user_table_id'=>$biodata_id])->first() ?>

                    @if( $ask_authorities != null)
                    <tbody>
                    
                    <tr>
                    <th scope="row">বায়োডাটা জমা দিচ্ছেন তা অভিভাবক জানেন? </th>
                    <td>@if($ask_authorities->submitted_biodata_allowed) হ্যা @else না  @endif</td>
                    </tr>
                    <tr>
                    <th scope="row">আল্লাহ&#039;র শপথ করে সাক্ষ্য দিন, যে তথ্যগুলো দিচ্ছেন সব সত্য? </th>
                    <td>@if($ask_authorities->is_true_information) হ্যা @else না  @endif</td>
                    </tr>
                    <tr>
                    <th scope="row">কোনো মিথ্যা তথ্য দিয়ে থাকলে তার দুনিয়াবী ও আখিরাতের দায়ভার ওয়েবসাইট কর্তৃপক্ষ নিবে না। আপনি কি রাজি? </th>
                    <td>@if($ask_authorities->authority_responsibility) হ্যা @else না  @endif</td>
                    </tr>
                    </tbody>
                    @endif
                  </table>
                </div>
              </div>
             
            </div>
        </div>
       </div>
    </div>
   </div>
</div>


{{-- @component("pages.listRegister.modal")@endcomponent --}}
@component("pages.details.modal")@endcomponent

@endsection

@section('file_js')

<script>
     
  function handle_birth_day(e){
  
  if(isValidDate(e.value.trim()) != true){
      e.value='';
      e.nextElementSibling.classList.remove("d-none")
  }else{
      e.value=e.value.trim();
      e.nextElementSibling.classList.add("d-none")
  }
  
  
  console.log(isValidDate(e.value.trim()))
  }
  
  function isValidDate(dateString) {
    var regEx = /^\d{4}-\d{2}-\d{2}$/;
  console.log( dateString.split("-")[1]);
  if(dateString.split("-")[1] > 12) return false;
  if(dateString.split("-")[3] > 31) return false;
    return dateString.match(regEx) != null;
  }
   
  </script>
@endsection