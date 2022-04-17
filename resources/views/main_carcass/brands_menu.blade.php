<nav class="brands_menu_container">
	<div class="container-md nav_scroller mb-2 overflow-hidden overflow_sm_visible">
		<ul class="row row-cols-12 flex-nowrap flex-sm-wrap justify-content-sm-center mb-0 pb-0 menu_brand_logos  ">
			@foreach ($brands as $brand)
				<li class="col">
					<a href="/catalog/{{mb_strtolower($brand)}}">
						<div class="i_{{mb_strtolower($brand)}}"></div>
						<div @if ($brand == "Volkswagen") style="font-size: 0.925rem;" @endif >{{$brand}}</div>
					</a>
				</li>
			@endforeach
		</ul>
	</div>
</nav>