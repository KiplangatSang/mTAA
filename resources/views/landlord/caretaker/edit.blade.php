@extends('layouts.app')
@section('content')
@php
$caretaker = $caretakersdata['caretaker']
@endphp
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> {{ auth()->user()->name }} Caretakers Registered</h1>
        <p>List of registered Caretakers</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Caretakers</li>
        <li class="breadcrumb-item active"><a href="#">Caretaker Edit</a></li>
    </ul>
</div>
<form action="{{ route('landlord.caretakers.update',['caretaker' =>$caretaker->id]) }}" method="POST">
    @method('patch')
    @csrf
    <div class="row">
        <!--Caretaker data-->
        <div class="col-md-6 col-xl m-1 item ">

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
                    <div class="row m-2">
                        <div class="col">
                            <p>Role</p>
                        </div>
                        <div class="col">
                            <select class="form-select form-control @error('role') is-invalid @enderror" name="role" id="select" >
                                <option value="">Select caretaker role</option>
                                @foreach ($caretakersdata['caretakerroles'] as $role)
                                @if ($caretakersdata['caretaker']->role == $role->id)
                                <option class="form-control" value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                @else
                                <option class="form-control" value="{{ $role->id }}">{{ $role->name }}</option>
                                @endif
                                @endforeach
                            </select>
                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
                        <button type="submit" class="btn btn-outline-success rounded-pill p-2 m-2">Submit</button>
                        <a onclick="event.preventDefault; document.getElementById('caretaker-delete-form').submit()" class="btn btn-outline-danger rounded-pill p-2 m-2">Delete</a>
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
    </div>
</form>
<form class="d-none" id="caretaker-delete-form" action="{{ route('landlord.caretakers.destroy',['caretaker'=>$caretaker->id]) }}" method="POST">
    @csrf
    @method('delete')
</form>
@endsection
