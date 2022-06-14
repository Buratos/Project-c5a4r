@extends("tests.sections._carcass_")
@section("menu")
	<div class="content container pt-3 pb-1" style="background-color: #f8eddb; color:#000000;">
		<div class="row ">
			<div class="col">
				<ul class="nav">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="{{ route("tests_sections_home") }}">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route("tests_sections_goods") }}">Goods</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route("tests_sections_services") }}">Services</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route("tests_sections_delivery") }}">Delivery</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route("tests_sections_contact") }}">Contact</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
@endsection