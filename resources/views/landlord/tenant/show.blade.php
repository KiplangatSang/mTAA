@extends('layouts.app')
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> {{ auth()->user()->name }} Tenants Registered</h1>
        <p>List of registered Tenants</p>
    </div>
    <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item">Tenants</li>
        <li class="breadcrumb-item active"><a href="#">Tenant data</a></li>
    </ul>
</div>
<div class="row">
    <!--Tenant data-->
    <div class="col-md-6 col-xl m-1 item text-dark">
        <div class="row justify-content-center">
            <h2> Tenant</h2>
        </div>
        <br>
        @if ($tenantdata['tenant'])
        <div class="row">
            <div class="col-md-6 col-xl-6">
                <div class="row m-2">
                    <div class="col">
                        <p> Name</p>
                    </div>
                    <div class="col">
                        <p>{{ $tenantdata['tenant']->tenantable->username }}</p>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col">
                        <p> Email</p>
                    </div>
                    <div class="col">
                        <p>{{ $tenantdata['tenant']->tenantable->email }}</p>
                    </div>
                </div>
                <div class="row m-2">
                    <div class="col">
                        <p> Phone Number</p>
                    </div>
                    <div class="col">
                        <p>{{ $tenantdata['tenant']->tenantable->phoneno }}</p>
                    </div>
                </div>
                <br>
                <div class="row m-2">
                    <div class="col">Date Registered</div>
                    <div class="col">
                        <p>{{ $tenantdata['tenant']->tenantable['created_at'] }}</p>
                    </div>
                </div>
                <hr class="new-2 bg-success">
                <div class="col">
                    @php
                    ($tenant = $tenantdata['tenant'])
                    @endphp
                    <a href="{{ route('landlord.tenants.edit',['tenant' => $tenant->id]) }}" class="btn btn-lg btn-outline-warning mr-3"> Send notification </a>
                    <a href="{{ route('landlord.tenants.edit',['tenant' => $tenant->id]) }}" class="btn btn-lg btn-outline-info ml-3 mr-4"> Invoice Customer </a>
                    <a href="{{ route('landlord.tenants.edit',['tenant' => $tenant->id]) }}" class="btn btn-lg btn-outline-danger mr-2">Delete</a>
                </div>
            </div>
        </div>
        @else
        <div class="row m-2">
            <div class="col">
                <p> No tenant registered</p>
            </div>
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-md-12 mt-3">
        <div class="tile">
            <div class="tile-title">
                <div class="d-flex justify-content-center">
                    <h4>Plots Associated</h4>
                </div>
            </div>
            <div class="tile-body">
                <div class="row mx-auto">
                    <!--plot data-->
                    @foreach ( $tenantdata['tenant']->plotlocation as $plotlocation)
                    <div class="col-md-6 col-xl-4 m-1 item text-dark">
                        <h1> {{ $plotlocation->name}}</h1>
                        <br>
                        <div class="row">
                            <a class="btn btn-outline-info m-2" href="{{route('landlord.plotlocation.edit',['id' => $tenantdata['tenant']->id])}}"><i class="fa fa-eye col">
                                    Edit</i></a></td>
                            <a class="btn  btn-outline-danger m-2" href="{{route('landlord.plotlocation.edit',['id' => $tenantdata['tenant']->id])}}"><i class="fa fa-eye col">
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
