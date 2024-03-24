@extends("master.layout")
@section("content")
<div class="container-fluid">
   <div class="row">
    <div class="col">
       <div class="card">
        <div class="card-header">
            <div class="card-text">
                <h4>List Register</h4>
            </div>
        </div>
        <div class="card-body">
            @if (session('message'))
            <div class="alert   alert-success ">
                {{ session('message') }}
            </div>
            @endif
            <div>
                <div class="row">
                    <div class="col-lg-9 col-md-6 col-sm-12">
                        <div class="">
                            <div class="card-body">
                       <form action="" class="row">
                        <div class="col-lg-3">
                        <div class="form-check">
                            <input class="form-check-input" name="gender" type="radio" value="male">
                            <label class="form-check-label" >male</label>
                          </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-check">
                                <input class="form-check-input" name="gender" type="radio" value="female" >
                                <label class="form-check-label" >female</label>
                              </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_publish" value="1" >
                                <label class="form-check-label" >approve</label>
                              </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_publish" value="0">
                                <label class="form-check-label" >un approve</label>
                              </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_publish" value="NULL">
                                <label class="form-check-label" >mis approve</label>
                              </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_update" value="1" >
                                <label class="form-check-label" >edited </label>
                              </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio"  name="is_update"  value="0" >
                                <label class="form-check-label" >un edited </label>
                              </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="w-50">
                                <button name="filtering" value="ok" class="btn btn-success btn-sm btn-block">filter </button>

                            </div>
                            </div>
    

                       </form>
                    </div>
                    </div>
                    </div>

               <div class="col-lg-3 col-md-6 col-sm-12">
             <div class="float-right d-flex">
    
                    <select onchange="handle_change(this)" style="width: 5rem" class="form-control">
                        <option value="mail_cls">mail</option>
                        <option value="phone_cls">phone</option>
                    </select>
                    <input type="search" style="width: 9rem" class="form-control"  onkeyup="handle_search(this)" placeholder="Search" id="mail_cls">
                </div>
            </div>
                <br>
            </div>
          
            <table class="table table-striped table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Phone</td>
                        <td>Gender</td>
                        <td>Permition </td>
                        <td>Action</td>
                    </tr>
                </thead>

                <tbody id="all_register_id">
                
                   <?php $i=0; ?>
                   @foreach ($register as $data )
                   <tr>
                    <td>{{++$i}}</td>
                    <td>{{$data->name}}</td>
                    <td class="mail_cls">{{$data->mail}}</td>
                    <td  class="phone_cls">{{$data->parent_number}}</td>
                    <td>{{$data->gender}}</td>
                    <td>@if($data->is_permition)
                        Enable
                        @endif
                        {{-- {{$data->is_permition}} --}}
                    </td>
                    <td>
                        <a href="details/{{$data->id}}"  class="btn btn-success btn-sm "> <i class="fa fa-eye" aria-hidden="true"></i> Details  </a>
                       <div class="btn btn-sm btn-success">
                        <input type="checkbox"  id="{{$data->id}}" onchange="handle_check(this)" @if($data->is_publish == 1 ) checked @endif name="" id=""> Approve

                       </div>
                       {{-- delete_register --}}
                       @if (session('staff') !=true)
                       <a id="/{{$data->id}}" onclick="confirm_delete('{{$data->id}}')"  class="btn btn-danger btn-sm "> <i class="fa fa-trash" aria-hidden="true"></i> Delete  </a>
                       @endif
                    </td>
                </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
       </div>
    </div>
   </div>
</div>
@component("pages.listRegister.modal")@endcomponent
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
        window.location.href = `delete_register/${id}`
    }
}

</script>
@endsection