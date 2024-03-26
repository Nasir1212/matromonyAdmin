@extends("master.layout")
@section("content")
<style>
    .bg-danger{
        background-color:  #4d35dc !important;
    }
    .bg_color{
        background-color:  #4d35dc !important;
        border-color: #4d35dc !important;
    }
</style>
<div class="container-fluid">
   <div class="row">
    <div class="col">
        <h4>Dashboard</h4>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div>
                    <div class="col-12">
                        @if (session('message'))
                        <div class="alert @if(session('condition')== true)  alert-success @else   alert-error  @endif">
                            {{ session('message') }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                   <a href="{{URL::to("/list_register_view?type=new_r")}}" class="btn btn-danger btn-sm bg_color">New Registation <span class="badge badge-light">{{ App\Models\Register::where(['is_seen'=>'0'])->count()}}</span></a>
                   <a href="{{URL::to("/list_register_view?type=up_bi")}}" class="btn btn-danger btn-sm bg_color">Update Biodata <span class="badge badge-light">{{ App\Models\Register::where(['is_update'=>'1'])->count()}}</span></a>
                   <hr>
                </div>
                <hr>
                <div class="col-lg-4 col-md-6 col-sm-12 ">
                    <div class="card bg-danger">
                        <div class="card-header">
                            <h5>Total Registration</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h1><i class="fas fa-person-booth    "></i></h1>
                                </div>
                                <div class="col-6">
                                   <h1>{{  App\Models\Register::count();}}</h1>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 ">
                    <div class="card bg-danger">
                        <div class="card-header">
                            <h5>Male  Registration</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h1><i class="fa fa-male" aria-hidden="true"></i></h1>
                                </div>
                                <div class="col-6">
                                   <h1>{{  App\Models\Register::where(['gender'=>'male'])->count();}}</h1>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>


                <div class="col-lg-4 col-md-6 col-sm-12 ">
                    <div class="card bg-danger">
                        <div class="card-header">
                            <h5>Female  Registration</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h1><i class="fa fa-female" aria-hidden="true"></i></h1>
                                </div>
                                <div class="col-6">
                                   <h1>{{  App\Models\Register::where(['gender'=>'female'])->count();}}</h1>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 ">
                    <div class="card bg-danger">
                        <div class="card-header">
                            <h5>Total Appreove Biodata</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h1><i class="fa fa-check-circle" aria-hidden="true"></i></h1>
                                </div>
                                <div class="col-6">
                                   <h1>{{  App\Models\Register::where(['is_publish'=>1])->count();}}</h1>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 ">
                    <div class="card bg-danger">
                        <div class="card-header">
                            <h5>Total Un Appreove Biodata</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h1><i class="fa fa-chain-broken" aria-hidden="true"></i></h1>
                                </div>
                                <div class="col-6">
                                   <h1>{{  App\Models\Register::where(['is_publish'=>0])->count();}}</h1>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 ">
                    <div class="card bg-danger">
                        <div class="card-header">
                            <h5>Total Male  Appreove </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h1><i class="fa fa-check-square-o" aria-hidden="true"></i></h1>
                                </div>
                                <div class="col-6">
                                   <h1>{{  App\Models\Register::where(['is_publish'=>1])->where(['gender'=>'male'])->count();}}</h1>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 ">
                    <div class="card bg-danger">
                        <div class="card-header">
                            <h5>Total Female  Appreove</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h1><i class="fas fa-check-double    "></i></h1>
                                </div>
                                <div class="col-6">
                                   <h1>{{  App\Models\Register::where(['is_publish'=>1])->where(['gender'=>'female'])->count();}}</h1>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 ">
                    <div class="card bg-danger">
                        <div class="card-header">
                            <h5>Today transaction </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h1><i class="fa fa-money" aria-hidden="true"></i></h1>
                                </div>
                                <div class="col-6">
                                    <?php $date = date("Y-m-d")?>
                                   <h1>{{\DB::select("SELECT SUM(money) AS total_money FROM  purchase_package WHERE payment_date LIKE '%$date%'")[0]->total_money}}</h1>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 ">
                    <div class="card bg-danger">
                        <div class="card-header">
                            <h5>Total transaction </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h1><i class="fa fa-money" aria-hidden="true"></i></h1>
                                </div>
                                <div class="col-6">
                                   <h1> {{\DB::select("SELECT SUM(money) AS total_money FROM  purchase_package ")[0]->total_money}}</h1>
                                </div>
                            </div>

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