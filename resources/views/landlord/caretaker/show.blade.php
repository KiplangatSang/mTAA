@extends('layouts.app')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> {{ auth()->user()->name }} Caretakers Registered</h1>
        <p>List of registered Caretakers</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Caretakers</li>
        <li class="breadcrumb-item active"><a href="#">Caretaker data</a></li>
    </ul>
</div>
<div class="row">
    <!--Caretaker data-->
    <div class="col-md-6 col-xl m-1 item text-dark">
        <div class="row justify-content-center">
            <h2> Caretaker</h2>
        </div>
        <br>
        @if ($caretakersdata['caretaker'])
        <div class="row">
            <div class="col-md-6 col-xl-6">
                <div class="row m-2">
                    <div class="col">
                        <p> Name</p>
                    </div>
                    <div class="col">
                        <p>{{ $caretakersdata['caretaker']->user->username }}</p>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col">
                        <p> Email</p>
                    </div>
                    <div class="col">
                        <p>{{ $caretakersdata['caretaker']->user->email }}</p>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col">
                        <p> Phone Number</p>
                    </div>
                    <div class="col">
                        <p>{{ $caretakersdata['caretaker']->user->phoneno }}</p>
                    </div>
                </div>
                <br>
                <div class="row m-2">
                    <div class="col">Date Registered</div>
                    <div class="col">
                        <p>{{ $caretakersdata['caretaker']->user['created_at'] }}</p>
                    </div>
                </div>
                <hr class="new-2 bg-success">
                <div class="col">
                    @php($caretaker = $caretakersdata['caretaker'])
                    <a href="{{ route('landlord.caretakers.edit',['caretaker' => $caretaker->id]) }}" class="btn btn-outline-warning">Edit</a>
                </div>
            </div>
        </div>
        @else

        <div class="row m-2">
            <div class="col">
                <p> No caretaker registered</p>
                <a href="{{ route('landlord.caretakers.create') }}" class="btn btn-outline-warning">Register</a>
            </div>
        </div>
        @endif

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
                <p>{{ $caretakersdata['caretaker']->landlord->landlordable->username }}</p>
            </div>
        </div>
        <div class="row m-2">
            <div class="col">
                <p> Email</p>
            </div>
            <div class="col">
                <p>{{ $caretakersdata['caretaker']->landlord->landlordable->email }}</p>
            </div>
        </div>
        <div class="row m-2">
            <div class="col">
                <p> Phone Number</p>
            </div>
            <div class="col">
                <p>{{ $caretakersdata['caretaker']->landlord->landlordable->phoneno }}</p>
            </div>
        </div>
        <br>
        <div class="row m-2">
            <div class="col">Date Registered</div>
            <div class="col">
                <p>{{ $caretakersdata['caretaker']->landlord['created_at'] }}</p>
            </div>
        </div>
        <hr class="new-2 bg-success">
    </div>
</div>
<div class="row">
    <div class="col-md-12 ">
        <div class="tile">
            <div class="tile-body">
                <div class="row mx-auto">
                    <!--plot data-->
                    @foreach ($caretakersdata['caretaker']->plotlocations as $plotlocation)
                    <div class="col-md-6 col-xl-4 m-1 item text-dark">
                        <h1> {{ $plotlocation->name}}</h1>
                        <br>
                        <div class="row">
                            <a class="btn btn-outline-info m-2" href="{{route('landlord.plotlocation.edit',['id' => $caretakersdata['caretaker']->id])}}"><i class="fa fa-eye col">
                                    Edit</i></a></td>
                            <a class="btn  btn-outline-danger m-2" href="{{route('landlord.plotlocation.edit',['id' => $caretakersdata['caretaker']->id])}}"><i class="fa fa-eye col">
                                    Edit</i></a></td>
                        </div>
                        <br>
                        <h4>Types available</h4>
                        @foreach (json_decode($plotlocation->house_types) as $type)
                        <input type="text" value="{{ $type }}" disabled>
                        @endforeach
                        <br>
                        <div class="row m-2">
                            <div class="col">Town</div>
                            <div class="col">{{ $plotlocation['town'] }}</div>
                        </div>
                        <div class="row m-2">
                            <div class="col">Constituency</div>
                            <div class="col">{{ $plotlocation ['constituency'] }}</div>
                        </div>

                        <div class="row m-2">
                            <div class="col">County</div>
                            <div class="col">
                                {{ $plotlocation['county'] }}
                            </div>
                        </div>
                        <div class="row m-2">
                            <div class="col">Country</div>
                            <div class="col">
                                {{ $plotlocation['country'] }}
                            </div>
                        </div>
                        <div class="row m-2">
                            <div class="col">Date Entered</div>
                            <div class="col">
                                {{ $plotlocation['created_at'] }}
                            </div>
                        </div>
                        <hr class="new-2 bg-success">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
