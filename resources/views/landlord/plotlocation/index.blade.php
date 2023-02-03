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
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>

                            <tr>
                                <th>Name</th>
                                <th>No of Houses</th>
                                <th>Types</th>
                                <th>Town</th>
                                <th>Constituency</th>
                                <th>County</th>
                                <th>Country</th>
                                <th>Date Reg</th>
                                <th>View</th>name
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plot_location_data['plot_location'] as $plot)
                            <tr>
                                <td>{{ $plot->name}}</td>
                                <td>{{ $plot->no_of_houses}}</td>
                                <td>{{ $plot->house_types }}</td>
                                <td>{{ $plot['town'] }}</td>
                                <td>{{ $plot['constituency'] }}</td>
                                <td>{{ $plot['county'] }}</td>
                                <td>{{ $plot['country'] }}</td>
                                <td>{{ $plot['created_at'] }}</td>
                                <td><a href="{{route('landlord.plotlocation.show',['id' => $plot->id])}}"><i class="fa fa-eye col">
                                            View</i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
