@extends('layouts.app')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> {{ auth()->user()->name }} Registered caretakers</h1>
        <p>List of registered caretakers</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">caretakers</li>
        <li class="breadcrumb-item active"><a href="#">caretakers List</a></li>
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
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Plots in charge</th>
                                <th>Landlord</th>
                                <th>Houses</th>
                                <th>Date Reg</th>
                                <th>View</th>name
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($caretakersdata['caretakers'] as $caretaker)
                            <tr>
                                <td>{{ $caretaker->user->username}}</td>
                                <td>{{ $caretaker->user->email}}</td>
                                <td>{{ $caretaker->user->phoneno }}</td>
                                <td>
                                    @foreach ($caretaker->plotlocations as $plot)
                                    {{ $plot->name}},
                                    @endforeach
                                </td>
                                <td>{{ $caretaker->landlord->landlordable->username }}</td>
                                <td>{{ count($caretaker->houses) }}</td>
                                <td>{{ $caretaker['created_at'] }}</td>
                                <td><a href="{{route('landlord.caretakers.show',['caretaker' => $caretaker->id])}}"><i class="fa fa-eye col">
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
