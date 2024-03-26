@extends("master.layout")
@section("content")
<div class="container-fluid">
   <div class="row">
    <div class="col">
       <div class="card">
        <div class="card-header">
            <div class="card-text">
                <h4> Popup</h4>
            </div>
        </div>
        @if (session('message'))
        <div class="alert   alert-success ">
            {{ session('message') }}
        </div>
        @endif
        <div class="card-body">
          
    
          
           <div>
            <div class="row">
            <div class="col-lg-3 "></div>

            <div class="col-lg-6 col-md-6 col-sm-12 " style="background: #E4CCFF;padding: 2rem;border-radius: 4px;">
              
                  
                    <form action="{{URL::to("/update_popup")}}">
                   

                        <div class="row">
                            
                            <div class="form-group col-12">
                              {{-- <label for=""><small> Popup title</small> </label>
                              <input class="form-control"  placeholder=" Write your popup title" value="{{ App\Models\PopUpMessage::where(['id'=>1])->first()->title }}"   name="title" ></input>   --}}
                              <input type="hidden" value="{{ App\Models\PopUpMessage::where(['id'=>1])->first()->id }}"  name="id" ></input>  
                            </div>
                            <div class="form-group col-12">
                                <label for=""> <small>Popup Message</small> </label>
                                <textarea style="height: 10rem" class="form-control" cols="10"  placeholder=" Write your popup Message"   name="message">{{ App\Models\PopUpMessage::where(['id'=>1])->first()->message }}</textarea>  
                            </div>
                            <div class="form-group col-12">
                                <button class="btn  btn-sm font-weight-bold float-right" style="background: #9747FF;
                                color: white">Submit</button>
                            </div>
                           

                          
                            {{-- @dd( App\Models\PopUpMessage::where(['id'=>1])->first()->disable_enable) --}}
                              <div class="form-group col-12">
                                <div class="checkbox-wrapper-8">
                                    <input class="tgl tgl-skewed" id="cb3-8" type="checkbox"  onclick="handle_check_disable_anble(this)"
                                    @php
                                      $is_disable =    App\Models\PopUpMessage::where(['id'=>1])->first()->disable_enable
                                    @endphp
                                    @if($is_disable  == "anable")  checked="checked" @endif 
                                    />
                                    <label class="tgl-btn" data-tg-off="Disable" data-tg-on="Enable" for="cb3-8"></label>
                                  </div>
                                  
                                  <style>
                                    .checkbox-wrapper-8 .tgl {
                                      display: none;
                                    }
                                    .checkbox-wrapper-8 .tgl,
                                    .checkbox-wrapper-8 .tgl:after,
                                    .checkbox-wrapper-8 .tgl:before,
                                    .checkbox-wrapper-8 .tgl *,
                                    .checkbox-wrapper-8 .tgl *:after,
                                    .checkbox-wrapper-8 .tgl *:before,
                                    .checkbox-wrapper-8 .tgl + .tgl-btn {
                                      box-sizing: border-box;
                                    }
                                    .checkbox-wrapper-8 .tgl::-moz-selection,
                                    .checkbox-wrapper-8 .tgl:after::-moz-selection,
                                    .checkbox-wrapper-8 .tgl:before::-moz-selection,
                                    .checkbox-wrapper-8 .tgl *::-moz-selection,
                                    .checkbox-wrapper-8 .tgl *:after::-moz-selection,
                                    .checkbox-wrapper-8 .tgl *:before::-moz-selection,
                                    .checkbox-wrapper-8 .tgl + .tgl-btn::-moz-selection,
                                    .checkbox-wrapper-8 .tgl::selection,
                                    .checkbox-wrapper-8 .tgl:after::selection,
                                    .checkbox-wrapper-8 .tgl:before::selection,
                                    .checkbox-wrapper-8 .tgl *::selection,
                                    .checkbox-wrapper-8 .tgl *:after::selection,
                                    .checkbox-wrapper-8 .tgl *:before::selection,
                                    .checkbox-wrapper-8 .tgl + .tgl-btn::selection {
                                      background: none;
                                    }
                                    .checkbox-wrapper-8 .tgl + .tgl-btn {
                                      outline: 0;
                                      display: block;
                                      width: 4em;
                                      height: 2em;
                                      position: relative;
                                      cursor: pointer;
                                      -webkit-user-select: none;
                                         -moz-user-select: none;
                                          -ms-user-select: none;
                                              user-select: none;
                                    }
                                    .checkbox-wrapper-8 .tgl + .tgl-btn:after,
                                    .checkbox-wrapper-8 .tgl + .tgl-btn:before {
                                      position: relative;
                                      display: block;
                                      content: "";
                                      width: 50%;
                                      height: 100%;
                                    }
                                    .checkbox-wrapper-8 .tgl + .tgl-btn:after {
                                      left: 0;
                                    }
                                    .checkbox-wrapper-8 .tgl + .tgl-btn:before {
                                      display: none;
                                    }
                                    .checkbox-wrapper-8 .tgl:checked + .tgl-btn:after {
                                      left: 50%;
                                    }
                                  
                                    .checkbox-wrapper-8 .tgl-skewed + .tgl-btn {
                                      overflow: hidden;
                                      transform: skew(-10deg);
                                      -webkit-backface-visibility: hidden;
                                              backface-visibility: hidden;
                                      transition: all 0.2s ease;
                                      font-family: sans-serif;
                                      background: #888;
                                    }
                                    .checkbox-wrapper-8 .tgl-skewed + .tgl-btn:after,
                                    .checkbox-wrapper-8 .tgl-skewed + .tgl-btn:before {
                                      transform: skew(10deg);
                                      display: inline-block;
                                      transition: all 0.2s ease;
                                      width: 100%;
                                      text-align: center;
                                      position: absolute;
                                      line-height: 2em;
                                      font-weight: bold;
                                      color: #fff;
                                      text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
                                    }
                                    .checkbox-wrapper-8 .tgl-skewed + .tgl-btn:after {
                                      left: 100%;
                                      content: attr(data-tg-on);
                                    }
                                    .checkbox-wrapper-8 .tgl-skewed + .tgl-btn:before {
                                      left: 0;
                                      content: attr(data-tg-off);
                                    }
                                    .checkbox-wrapper-8 .tgl-skewed + .tgl-btn:active {
                                      background: #888;
                                    }
                                    .checkbox-wrapper-8 .tgl-skewed + .tgl-btn:active:before {
                                      left: -10%;
                                    }
                                    .checkbox-wrapper-8 .tgl-skewed:checked + .tgl-btn {
                                      background: #86d993;
                                    }
                                    .checkbox-wrapper-8 .tgl-skewed:checked + .tgl-btn:before {
                                      left: -100%;
                                    }
                                    .checkbox-wrapper-8 .tgl-skewed:checked + .tgl-btn:after {
                                      left: 0;
                                    }
                                    .checkbox-wrapper-8 .tgl-skewed:checked + .tgl-btn:active:after {
                                      left: 10%;
                                    }
                                  </style>
                                  
                            </div>
                           
                              
                        
                           
                        </div>

                    </div>
                </form>
             
            </div>
            </div>
           </div>
        </div>
       </div>
    </div>
    </div>
   </div>
</div>


@endsection

@section('file_js')
<script>
       window.onload = ()=>{
        // const response = await fetch(`/show_all_register`);
        // all_register()
    }
async function handle_check(e){
    console.log(e.checked);
    let status = e.checked == true ?1:0;
    console.log(status)
    
    const response = await fetch(`/publish?status=${status}&id=${e.id}`);
        const result = await response.json();
        console.log(result)
}

   

function show_details_modal(id){
    
    $('#list_register_modal').modal('show')
}

function handle_search(e){
// console.log(e.value.toUpperCase())
let list =  document.getElementsByClassName(e.id)
for (const tr of list) {
    if(tr.innerText.toUpperCase().indexOf(e.value.toUpperCase()) > -1){
        tr.parentElement.style.display = "";
    }else{
        tr.parentElement.style.display ='none';

    }
}

}

function handle_change(e){
// console.log(e.value)
e.nextElementSibling.id = e.value
// console.log(e.nextElementSibling)
}

function confirm_delete(id){
    if(confirm('Do you want to delete ?')==true){
        window.location.href = `delete_blog?id=${id}`
    }
}

async function handle_check_disable_anble(e){
    console.log(e.checked)
    let check_a_d = e.checked ==true? 'anable': "disable";
    console.log(check_a_d)
 const response = await fetch(`/popup_enable_disable?disable_enable=${check_a_d}`);

}



</script>
@endsection