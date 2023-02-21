@extends('layouts.app')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> {{ auth()->user()->name }} Registered Rental Types</h1>
        <p>List of rental types you have</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Plots</li>
        <li class="breadcrumb-item active"><a href="#">Plots List</a></li>
    </ul>
</div>
<div class="container-fluid mt-3">
    <div class="tile item">
        <div class="tile-title d-flex justify-content-center">
            Office
        </div>
        <div class="tile-body">
            <div class="row">
                <div class="col col-md-6 col-xl ">
                    <div class="row">
                        <div class="col col-xl-3">
                            <p>
                                Plot Name
                            </p>
                        </div>
                        <div class="col">
                            <h4>
                                Plot Sang
                            </h4>
                        </div>
                    </div>
                    <hr class="new-3">
                    <div class="row">
                        <div class="col col-xl-3">
                            <p>
                                Number of houses
                            </p>
                        </div>
                        <div class="col">
                            <h4>
                                5
                            </h4>
                        </div>
                    </div>
                    <hr class="new-3">
                    <div class="row">
                        <div class="col col-xl-3">
                            <p>
                                Number of houses occupied
                            </p>
                        </div>
                        <div class="col">
                            <h4>
                                5
                            </h4>
                        </div>
                    </div>
                    <hr class="new-3">
                    <div class="row">
                        <div class="col col-xl-3">
                            <p>
                                Number of tenants
                            </p>
                        </div>
                        <div class="col">
                            <h4>
                                7
                            </h4>
                        </div>
                    </div>
                    <hr class="new-3">
                    <div class="row">
                        <div class="col col-xl-3">
                            <p>
                                Number of houses vaccant
                            </p>
                        </div>
                        <div class="col">
                            <h4>
                                5
                            </h4>
                        </div>
                    </div>
                    <hr class="new-3">
                </div>
                <div class="col col-md-6 col-xl-3 p-3">
                    <div class="mr-auto">
                        <a href="" class="btn btn-success rounded-pill p-2 m-2">View tenants</a>
                    </div>
                    <div class="mr-auto">
                        <a href="" class="btn btn-info rounded-pill p-2 m-2">View bookings</a>
                    </div>
                    <div class="mr-auto">
                        <a href="" class="btn btn-primary rounded-pill p-2 m-2">View payments</a>
                    </div>
                    <div class="mr-auto">
                        <a href="" class="btn btn-secondary rounded-pill p-2 m-2">View  adverts</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
