@extends("master.layout")
@section("content")
<div class="container-fluid">
   <div class="row">
    <div class="col">
       <div class="card">
        <div class="card-header">
            <div class="card-text">
                <h4>All Blogs</h4>
            </div>
        </div>
        <div class="card-body">
            @if (session('message'))
            <div class="alert   alert-success ">
                {{ session('message') }}
            </div>
            @endif
    
          
            <table class="table table-striped table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <td>#</td>
                        <td>title</td>
                        <td>image</td>
                        <td>Content </td>
                        <td>Action</td>
                    </tr>
                </thead>

                <tbody id="all_register_id">
                
                   <?php $i=0; ?>
                   @foreach ($blogs as $data )
                   <tr>
                    <td>{{++$i}}</td>
                    <td>{{$data->title}}</td>
                    <td><img style="width: 100px;height:100px" src="@if($data->img_path != null)https://img.ordhangini.com/uploads/{{$data->img_path}}@else https://ordhangini.com/frontend/img/220_F_137578103_ulK9MbD9IfKACx9RZe6Rx7PAyBA9aN2K.jpg @endif" alt=""></td>
                    <td> {!! substr($data->blog,0,100) !!}</td>
                    <td>
                        <a href="/{{$data->id}}"  class="btn btn-success btn-sm " title="Details"> <i class="fa fa-eye" aria-hidden="true"></i>   </a>
                       {{-- delete_register --}}
                       <a href="{{URL::to("/edit_blog_page/$data->id")}}"  title="Edit"  class="btn btn-danger btn-sm "> <i class="fa fa-edit    "></i>   </a>
                       @if (session('staff') !=true)
                       <a id="/{{$data->id}}" onclick="confirm_delete('{{$data->id}}')" title="Delete"  class="btn btn-danger btn-sm "> <i class="fa fa-trash" aria-hidden="true"></i>   </a>
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
        window.location.href = `delete_blog?id=${id}`
    }
}

</script>
@endsection