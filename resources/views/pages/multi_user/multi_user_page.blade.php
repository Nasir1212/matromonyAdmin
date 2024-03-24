@extends("master.layout")
@section("content")
<div class="container-fluid">
   <div class="row">
    <div class="col">
       <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="card-text">
                <h4>Multi User </h4>
            </div>
        
              
                <button class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#exampleModal"style="transform: translateX(332%);">Add a User </button>
        </div>
        <div class="card-body">
            @if (session('message'))
            <div class="alert   alert-success ">
                {{ session('message') }}
            </div>
            @endif
            <div>
               
          
            <table class="table table-striped table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Action</td>
                    </tr>
                </thead>

                <tbody >
                
                   <?php $i=0; ?>
                   @foreach ($users as $user )
                   <tr>
                    <td>{{++$i}}</td>
                    <td id="f_{{$user->id}}">{{$user->full_name}}</td>
                    <td id="e_{{$user->id}}">{{$user->email}}</td>
                    <td>
                    <a onclick="update_model('update_Modal','{{$user->id}}')"  class="btn btn-success btn-sm " title="Edit"> <i class="fa fa-edit    "></i>   </a>
                    <a id="/{{$user->id}}" onclick="confirm_delete('{{$user->id}}')"  class="btn btn-danger btn-sm " title="Delete"> <i class="fa fa-trash" aria-hidden="true"></i>   </a>
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
</div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add a User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <form action="{{URL::to("/add_user")}}">
            <div class="form-group">
              <label for=""><small>Full name</small></label>
              <input type="text" class="form-control" name="full_name" value="{{old('full_name')}}"  placeholder="Enter full name">
            </div>

            <div class="form-group">
                <label for=""><small>Mail</small></label>
                <input type="text" class="form-control" name="email" value="{{old('email')}}"  placeholder="Enter mail">
            </div>
            <div class="form-group">
            <label for=""> <small>Password</small> </label>
            <input type="text" class="form-control" name="password"  placeholder="Enter password">
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-sm btn-success">Add User </button>
            </div>


         </form>
        </div>
      
      </div>
    </div>
  </div>


   <!-- Modal -->
   <div class="modal fade" id="update_Modal" tabindex="-1" aria-labelledby="update_ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="update_ModalLabel">Update User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <form name="update_Modal" action="{{URL::to("/update_user")}}">
            <div class="form-group">
              <label for=""><small>Full name</small></label>
              <input type="text" class="form-control" name="full_name" value="{{old('full_name')}}"  placeholder="Enter full name">
            </div>

            <div class="form-group">
                <label for=""><small>Mail</small></label>
                <input type="text" class="form-control" name="email" value="{{old('email')}}"  placeholder="Enter mail">
                <input type="hidden" class="form-control" name="id" value="{{old('email')}}"  placeholder="Enter mail">
            </div>
            <div class="form-group">
            <label for=""> <small>Password</small> </label>
            <input type="text" class="form-control" placeholder="********" name="password"  placeholder="Enter password">
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-sm btn-success">Update User </button>
            </div>


         </form>
        </div>
      
      </div>
    </div>
  </div>

@endsection

@section('file_js')
<script>

function confirm_delete(id){
    if(confirm('Do you want to delete ?')==true){
        window.location.href = `user_delete/?id=${id}`
    }
}

function update_model(md_id,id){
$(`#${md_id}`).modal('show');
let updateForm = document.forms[md_id]
 updateForm.full_name.value = document.getElementById(`f_${id}`).innerText;
 updateForm.email.value = document.getElementById(`e_${id}`).innerText;
 updateForm.id.value =id;

}

</script>
@endsection