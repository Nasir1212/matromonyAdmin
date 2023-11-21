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
                <div class="float-right d-flex">
                    <select onchange="handle_change(this)" style="width: 10rem" class="form-control">
                        <option value="mail_cls">Search by mail</option>
                        <option value="phone_cls">Search by phone</option>
                    </select>
                    <input type="search" class="form-control" name="" onkeyup="handle_search(this)" placeholder="Search" id="mail_cls">
                </div>
                <br>
            </div>
            <hr>
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

                       <a href="delete_register/{{$data->id}}"  class="btn btn-danger btn-sm "> <i class="fa fa-trash" aria-hidden="true"></i> Delete  </a>

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

</script>
@endsection