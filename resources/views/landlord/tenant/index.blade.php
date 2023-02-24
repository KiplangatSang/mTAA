@extends('layouts.app')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> {{ auth()->user()->name }} Registered tenants</h1>
        <p>List of registered tenants</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">tenants</li>
        <li class="breadcrumb-item active"><a href="#">tenants List</a></li>
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
                                <th>Plot</th>
                                <th>Houses</th>
                                <th>Date Reg</th>
                                <th>View</th>name
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tenantdata['tenants'] as $tenant)
                            <tr>
                                <td>{{ $tenant->tenantable->username}}</td>
                                <td>{{ $tenant->tenantable->email}}</td>
                                <td>{{ $tenant->tenantable->phoneno }}</td>
                                <td>
                                    @foreach ($tenant->plotlocation as $plot)
                                    {{ $plot->name}},
                                    @endforeach
                                </td>
                                <td>{{ count($tenant->houses) }}</td>
                                <td>{{ $tenant['created_at'] }}</td>
                                <td><a href="{{route('landlord.tenants.show',['tenant' => $tenant->id])}}"><i class="fa fa-eye col">
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
