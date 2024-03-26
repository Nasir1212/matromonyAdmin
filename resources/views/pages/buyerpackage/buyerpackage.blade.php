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
        <div class="card-body" style="overflow: scroll">
            <table class="table table-striped table-hover table-sm" >
                <thead class="thead-dark">
                    <tr>
                        <td>#</td>
                        <td>Buyer</td>
                        <td>package</td>
                        <td>Date</td>
                        <td>Money</td>
                        <td>Payment id</td>
                    </tr>
                </thead>

                <tbody id="all_register_id">
               
                    
                   <?php $i=0; ?>
                   @foreach ($buyerpackage as $data )
                   <tr>
                    <td>{{++$i}}</td>
                    <td>{{$data->purchaser_name}}</td>
                    <td>{{$data->purchased_name}} @if($data->biodata_type == 1) পুরুষ @else নারী @endif</td>
                    <td>{{$data->payment_date}}</td>
                    <td>{{$data->money}} tk</td>
                    <td>{{$data->payment_id}}</td>
                    
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
@component("pages.listRegister.modal")@endcomponent
@endsection

