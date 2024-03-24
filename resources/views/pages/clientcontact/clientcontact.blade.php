@extends("master.layout")
@section("content")
<div class="container-fluid">
   <div class="row">
    <div class="col">
       <div class="card" style="height: 40rem">
        <div class="card-header">
            <div class="card-text">
                <h4>List Register</h4>
            </div>
        </div>
        @if (session('message'))
        <div class="alert @if(session('condition')== true)  alert-success @else   alert-error  @endif">
            {{ session('message') }}
        </div>
        @endif
        <div class="card-body">
            <table class="table table-striped table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Subject</td>
                        <td>Message</td>
                        @if (session('staff') !=true)
                        <td>Action</td>
                        @endif
                    </tr>
                </thead>

                <tbody id="all_register_id">
                
                   <?php $i=0; ?>
                   @foreach ($client_contact as $data )
                   <tr>
                    <td>{{++$i}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->subject}}</td>
                    <td>{{$data->message}}</td>
                    <td>
                        @if (session('staff') !=true)
                        <a href="client_message_delete/{{$data->id}}"  class="btn btn-danger btn-sm "> <i class="fa fa-trash" aria-hidden="true"></i> Delete  </a>
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
     
async function handle_check(e){
    console.log(e.checked);
    let status = e.checked == true ?1:0;
    console.log(status)
    
    const response = await fetch(`/?status=${status}&id=${e.id}`);
        const result = await response.json();
        console.log(result)
}

    


</script>
@endsection