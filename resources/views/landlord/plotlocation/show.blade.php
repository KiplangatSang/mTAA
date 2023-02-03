@extends('layouts.app')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> {{ auth()->user()->name }} Registered Plots</h1>
        <p>List of registered plots</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Plots</li>
        <li class="breadcrumb-item active"><a href="#">Plots List</a></li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="row justify-content-center">
                    <a href="" class="btn btn-info m-2">Houses</a>
                    <a href="" class="btn btn-dark m-2">Tenants</a>
                    <a href="" class="btn btn-success m-2">House Requests</a>
                    <a href="" class="btn btn-warning m-2">Payment History</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="row">
                    <!--plot data-->
                    <div class="col-md-6 col-xl m-1 item text-dark">
                        <h1> {{ $plot_location_data['plot'] ->name}}</h1>
                        <br>
                        <div class="row">
                            <a class="btn btn-outline-info m-2" href="{{route('landlord.plotlocation.edit',['id' => $plot_location_data['plot']->id])}}"><i class="fa fa-eye col">
                                    Edit</i></a></td>
                            <a class="btn  btn-outline-danger m-2" href="{{route('landlord.plotlocation.edit',['id' => $plot_location_data['plot']->id])}}"><i class="fa fa-eye col">
                                    Edit</i></a></td>
                        </div>
                        <br>
                        <h4>Types available</h4>
                        @foreach (json_decode($plot_location_data['plot'] ->house_types) as $type)
                        <input type="text" value="{{ $type }}" disabled>
                        @endforeach
                        <br>
                        <div class="row m-2">
                            <div class="col">Town</div>
                            <div class="col">{{ $plot_location_data['plot']['town'] }}</div>
                        </div>
                        <div class="row m-2">
                            <div class="col">Constituency</div>
                            <div class="col">{{ $plot_location_data['plot'] ['constituency'] }}</div>
                        </div>

                        <div class="row m-2">
                            <div class="col">County</div>
                            <div class="col">
                                {{ $plot_location_data['plot'] ['county'] }}
                            </div>
                        </div>
                        <div class="row m-2">
                            <div class="col">Country</div>
                            <div class="col">
                                {{ $plot_location_data['plot'] ['country'] }}
                            </div>
                        </div>
                        <div class="row m-2">
                            <div class="col">Date Entered</div>
                            <div class="col">
                                {{ $plot_location_data['plot'] ['created_at'] }}
                            </div>
                        </div>
                        <hr class="new-2 bg-success">
                    </div>
                    <!--Landlord data-->
                    <div class="col-md-6 col-xl m-1 item text-dark">
                        <div class="row justify-content-center">
                            <h2> Landlord</h2>
                        </div>
                        <br>
                        <div class="row m-2">
                            <div class="col">
                                <p> Name</p>
                            </div>
                            <div class="col">
                                <p>{{ $plot_location_data['plot']->plot_locationable->landlordable->username }}</p>
                            </div>
                        </div>
                        <div class="row m-2">
                            <div class="col">
                                <p> Email</p>
                            </div>
                            <div class="col">
                                <p>{{ $plot_location_data['plot']->plot_locationable->landlordable->email }}</p>
                            </div>
                        </div>
                        <div class="row m-2">
                            <div class="col">
                                <p> Phone Number</p>
                            </div>
                            <div class="col">
                                <p>{{ $plot_location_data['plot']->plot_locationable->landlordable->phoneno }}</p>
                            </div>
                        </div>
                        <br>
                        <div class="row m-2">
                            <div class="col">Date Registered</div>
                            <div class="col">
                                <p>{{ $plot_location_data['plot']->plot_locationable['created_at'] }}</p>
                            </div>
                        </div>
                        <hr class="new-2 bg-success">
                    </div>
                    <!--Caretaker data-->
                    <div class="col-md-6 col-xl m-1 item text-dark">
                        <div class="row justify-content-center">
                            <h2> Caretaker</h2>
                        </div>
                        <br>
                        @if ($plot_location_data['plot']->caretaker)
                        <div class="row m-2">
                            <div class="col">
                                <p> Name</p>
                            </div>
                            <div class="col">
                                <p>{{ $plot_location_data['plot']->caretaker->caretakerable->username }}</p>
                            </div>
                        </div>
                        <div class="row m-2">
                            <div class="col">
                                <p> Email</p>
                            </div>
                            <div class="col">
                                <p>{{ $plot_location_data['plot']->caretaker->caretakerable->email }}</p>
                            </div>
                        </div>
                        <div class="row m-2">
                            <div class="col">
                                <p> Phone Number</p>
                            </div>
                            <div class="col">
                                <p>{{ $plot_location_data['plot']->caretaker->caretakerable->phoneno }}</p>
                            </div>
                        </div>
                        <br>
                        <div class="row m-2">
                            <div class="col">Date Registered</div>
                            <div class="col">
                                <p>{{ $plot_location_data['plot']->caretaker->caretakerable['created_at'] }}</p>
                            </div>
                        </div>
                        @else

                        <div class="row m-2">
                            <div class="col">
                                <p> No caretaker registered</p>
                                <a href="" class="btn btn-outline-warning">Register</a>
                            </div>

                        </div>
                        @endif

                        <hr class="new-2 bg-success">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
