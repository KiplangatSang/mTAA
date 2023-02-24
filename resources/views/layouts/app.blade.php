<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

<head>
				<title>{{ config('app.name') }}</title>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
				<!-- Main CSS-->
				<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
				<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
								integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
				</script>
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
								integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
				</script>
				<!-- Font-icon css-->
				<link rel="stylesheet" type="text/css"
								href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
				<script type="text/javascript" src="{{ asset('assets/js/plugins/dropzone.js') }}"></script>


				{{-- images zooming  --}}
				<!-- Google Web Fonts -->

				<!-- Icon Font Stylesheet -->
				<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

				<!-- Libraries Stylesheet -->
				<link href="{{ asset('assets/images_view/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
				<link href="{{ asset('assets/images_view/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
				<link href="{{ asset('assets/images_view/lib/animate/animate.min.css') }}" rel="stylesheet">

				<!-- Template Stylesheet -->
				<link href="{{ asset('assets/images_view/css/style.css') }}" rel="stylesheet">

				<!--//from app <div class="blade"></div> -->
				<!-- Font-icon css-->
				<link rel="stylesheet" type="text/css"
								href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                                <!-- jscroll-->
                                <script src="//unpkg.com/jscroll@#.#.#/dist/jquery.jscroll.min.js"></script>

</head>

<body class="app sidebar-mini">
				<!-- Navbar-->
				<header class="app-header">
								<a class="app-header__logo" href="/home">{{session('plotSession')->name ?? config('app.name') }} </a>
								<!-- Sidebar toggle button-->
								<a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>

								<div class="toggle lg ml-2 mt-1 ">
												<label class="p-1">
																<input type="checkbox"><span class="button-indecator bg-light p-1" id="switch"> Dark Mode</span>
												</label>
								</div>
								<!-- Navbar Right Menu-->
								<ul class="app-nav ">
												<li class="app-search">
																<input class="app-search__input" type="search" placeholder="Search">
																<button class="app-search__button"><i class="fa fa-search"></i></button>
												</li>
												<!--Notification Menu-->
												<li class="dropdown">
																<a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i
																								class="fa fa-bell-o fa-lg"></i>
																				@if (count(auth()->user()->unreadNotifications) > 0)
																								<span class=" badge badge-danger">{{ count(auth()->user()->unreadNotifications) }}</span>
																				@endif
																</a>
																<ul class="app-notification dropdown-menu dropdown-menu-right">
																				<li class="app-notification__title">You have {{ count(auth()->user()->unreadNotifications) }} new
																								notifications.</li>
																				<div class="app-notification__content">
																								@foreach (auth()->user()->unreadNotifications as $notification)
																												<li><a class="app-notification__item"
																																				href="/notification/show/{{ $notification->id }}"><span
																																								class="app-notification__icon"><span class="fa-stack fa-lg"><i
																																																class="fa fa-circle fa-stack-2x text-primary"></i><i
																																																class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
																																				<div>
																																								<p class="app-notification__message">{{ $notification->data['message'] }}</p>
																																								<p class="app-notification__meta"> at
																																												{{ $notification->created_at->format('H:i D d-M-Y') }}</p>
																																				</div>

																																</a></li>
																								@endforeach
																				</div>
																				<li class="app-notification__footer"><a href="/notification/index">See all notifications.</a></li>
																</ul>
												</li>
												<!-- User Menu-->
												<li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown"
																				aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
																<ul class="dropdown-menu settings-menu dropdown-menu-right">
																				<li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a>
																				</li>
																				<li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a>
																				</li>
																				<li><a class="dropdown-item" href="{{ route('logout') }}"
																												onclick="event.preventDefault();
																														document.getElementById('logout-form').submit();"><i
																																class="fa fa-sign-out fa-lg"></i>{{ __('Logout') }}</a>
																								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
																												@csrf
																								</form>
																				</li>

																</ul>
												</li>
								</ul>
				</header>
				<!-- Sidebar menu-->
				<div class="app-sidebar__overlay " data-toggle="sidebar"></div>
				<aside class="app-sidebar">
								<div class="app-sidebar__user bg-dark ">
												<div class="col">
																<div class="col-md-4 col-xl-6">
																				<a href="/client/retails/profile/edit">
																								<img class="app-sidebar__user-avatar d-flex w-100"
																												src="{{ auth()->user()->profile()->first()->profile_image }}" alt="User Image">
																				</a>
																</div>
																<div>
																				<a href="/client/retails/profile" class="text-light">
																								<p class="app-sidebar__user-name">
																												{{ Auth::user()->username ?? 'Guest' }}</p>
																				</a>
																				<br>

																				@if (Auth::user()->role == 2)
																								<a href="/client/retails/profile" class="text-light">
																												<p class="app-sidebar__user-designation">Landlord Account</p>
																								</a>
																				@else
																								@if (Auth::user())
																												<a href="/client/retails/profile" class="text-light">
																																<p class="app-sidebar__user-designation">Caretaker Account</p>
																												</a>
																								@else
																												<p class="app-sidebar__user-designation">Guest</p>
																								@endif

																				@endif
																				<br>
																				<p class="app-sidebar__user-designation">{{ auth()->user()->profile->complete ?? 0 }}% Complete
																				</p>

																</div>
												</div>
								</div>
								<ul class="app-menu" id="app">
												<li>
																<a class="app-menu__item active " href="/home"><i class="app-menu__icon fa fa-dashboard"></i><span
																								class="app-menu__label">Dashboard</span></a>
												</li>
												<li class="treeview">
																<a class="app-menu__item " href="#" data-toggle="treeview"><i
																								class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Plots</span><i
																								class="treeview-indicator fa fa-angle-right"></i></a>
																<ul class="treeview-menu">
																				<li><a class="treeview-item " href="{{ route('landlord.plotlocation') }}"><i
																																class="icon fa fa-circle-o"></i>Plot List
																								</a></li>
																				<li><a class="treeview-item " href="{{ route('landlord.plotlocation.create') }}"><i
																																class="icon fa fa-circle-o"></i>Add a Plot
																								</a></li>
																</ul>
												</li>
												<li class="treeview">
																<a class="app-menu__item " href="#" data-toggle="treeview"><i
																								class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Houses</span><i
																								class="treeview-indicator fa fa-angle-right"></i></a>
																<ul class="treeview-menu">
																				<li><a class="treeview-item " href="{{ route('landlord.houses') }}"><i
																																class="icon fa fa-circle-o"></i>All Houses
																								</a></li>
																				<li><a class="treeview-item " href="{{ route('landlord.houses.types') }}"><i
																																class="icon fa fa-circle-o"></i>
																												House Types</a></li>
																				<li><a class="treeview-item " href="{{ route('landlord.houses.create') }}"><i
																																class="icon fa fa-circle-o"></i>Add
																												a house</a></li>
																</ul>
												</li>
												<li class="treeview">
																<a class="app-menu__item " href="#" data-toggle="treeview"><i
																								class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Caretakers</span><i
																								class="treeview-indicator fa fa-angle-right"></i></a>
																<ul class="treeview-menu">
																				<li><a class="treeview-item " href="{{ route('landlord.caretakers.index') }}"><i
																																class="icon fa fa-circle-o"></i>Caretakers List
																												Owner</a></li>
																				<li><a class="treeview-item " href="{{ route('landlord.caretakers.create') }}"><i
																																class="icon fa fa-circle-o"></i>Add caretaker Account</a></li>
																</ul>
												</li>
												<li class="treeview"><a class="app-menu__item " href="#" data-toggle="treeview"><i
																								class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Tenants</span><i
																								class="treeview-indicator fa fa-angle-right"></i></a>

																<ul class="treeview-menu">
																				<li><a class="treeview-item " href="{{ route('landlord.tenants') }}"><i
																																class="icon fa fa-circle-o"></i>Tenants List</a></li>
																				<li><a class="treeview-item " href="{{ route('landlord.tenants.create') }}"><i
																																class="icon fa fa-circle-o"></i>Add Tenant</a></li>

																</ul>
												</li>
												<li class="treeview"><a class="app-menu__item " href="#" data-toggle="treeview"><i
																								class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Payments</span><i
																								class="treeview-indicator fa fa-angle-right"></i></a>
																<ul class="treeview-menu">
																				<li><a class="treeview-item " href="{{ route('landlord.payments.index') }}"><i
																																class="icon fa fa-circle-o"></i>History</a></li>
																				<li><a class="treeview-item " href="/client/retails/show"><i
																																class="icon fa fa-circle-o"></i>Refund
																								</a></li>
																				<li><a class="treeview-item " href="/client/retails/create"><i
																																class="icon fa fa-circle-o"></i>Make Payment</a></li>
																</ul>
												</li>
												<li><a class="app-menu__item" href="/settigs/index"><i class="app-menu__icon fa fa-cogs"></i><span
																								class="app-menu__label">Settings</span></a>
												</li>
												<li><a class="app-menu__item" href="/client/dukaverse/index"><i
																								class="app-menu__icon fa fa-server"></i><span class="app-menu__label">MtAA
																								Account</span></a></li>
												<li><a class="app-menu__item" href="/client/dukaverse/index"><i
																								class="app-menu__icon fa fa-server"></i><span class="app-menu__label">DukaVerse
																								Account</span></a></li>
								</ul>
				</aside>
				<main class="app-content">
								@include('inc.messages')
								@yield('content')
				</main>
				<!-- Essential javascripts for application to work-->
				<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
				<script src="{{ asset('assets/js/popper.min.js') }}"></script>
				<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
				<script src="{{ asset('assets/js/main.js') }}"></script>
				<!-- The javascript plugin to display page loading on top-->
				<script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
				<!-- Page specific javascripts-->
				<script type="text/javascript" src="{{ asset('assets/js/plugins/bootstrap-datepicker.min.js') }}"></script>
				<script type="text/javascript" src="{{ asset('assets/js/plugins/dropzone.js') }}"></script>
				<script type="text/javascript" src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
				<script type="text/javascript" src="{{ asset('assets/js/plugins/bootstrap-datepicker.min.js') }}"></script>


				<script type="text/javascript">
								$('#sl').on('click', function() {
												$('#tl').loadingBtn();
												$('#tb').loadingBtn({
																text: "Signing In"
												});
								});

								$('#el').on('click', function() {
												$('#tl').loadingBtnComplete();
												$('#tb').loadingBtnComplete({
																html: "Sign In"
												});
								});


								$('#multipleSelectForm').select2();
				</script>

				{{-- date picker --}}
				<script type="text/javascript" src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
				<script type="text/javascript" src="{{ asset('assets/js/plugins/dataTables.bootstrap.min.js') }}"></script>
				<script type="text/javascript" src="{{ asset('assets/js/plugins/bootstrap-datepicker.min.js') }}"></script>
				<script type="text/javascript" src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
				<script type="text/javascript" src="{{ asset('assets/js/plugins/bootstrap-datepicker.min.js') }}"></script>
				<script type="text/javascript" src="{{ asset('assets/js/plugins/dropzone.js') }}"></script>
				<script type="text/javascript">
								$('#startDate').datepicker({
												format: "yyyy-mm-dd",
												autoclose: true,
												todayHighlight: true
								});
								$('#endDate').datepicker({
												format: "yyyy-mm-dd",
												autoclose: true,
												todayHighlight: true
								});

								$('#demoSelect').select2();
				</script>
				<script type="text/javascript">
								$('#sampleTable').DataTable();
				</script>


				<script>
								$(function() {
												$("#switch").click(function() {
																$(".table").toggleClass("table-dark");
																$(".tile").toggleClass("bg-dark");
																// $(".row").toggleClass("bg-dark");
																// $(".app-title").toggleClass("bg-dark");
																// $(".btn").toggleClass("btn-dark");


												});
								});
				</script>

				<!-- image zoom scripts-->
				<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
				<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
				<script src="{{ url('/assets/images_view/lib/wow/wow.min.js') }}"></script>
				<script src="{{ url('/assets/images_view/lib/typed/typed.min.js') }}"></script>
				<script src="{{ url('/assets/images_view/lib/easing/easing.min.js') }}"></script>
				<script src="{{ url('/assets/images_view/lib/waypoints/waypoints.min.js') }}"></script>
				<script src="{{ url('/assets/images_view/lib/counterup/counterup.min.js') }}"></script>
				<script src="{{ url('/assets/images_view/lib/owlcarousel/owl.carousel.min.js') }}"></script>
				<script src="{{ url('/assets/images_view/lib/isotope/isotope.pkgd.min.js') }}"></script>
				<script src="{{ url('/assets/images_view/lib/lightbox/js/lightbox.min.js') }}"></script>

				<!-- Template Javascript -->
				<script src="{{ asset('assets/images_view/js/main.js') }}"></script>


</body>

</html>
