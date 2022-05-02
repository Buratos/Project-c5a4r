<!doctype html>
<html lang="en">

{{--▪▪▪  tag HEAD  ▪▪▪--}}
@if (isset($create_new_ad_page))	@include('crud.tag_head__create_new_ad')
@elseif (isset($edit_car_page))	@include('crud.tag_head__create_new_ad')
@else  @include('main_page.tag_head')
@endif

<body>

@include('main_carcass.header')           {{--▪▪▪  HEADER  ШАПКА и МЕНЮ  ▪▪▪--}}

@if (isset($error_message)) @include('errors.default')
@elseif (isset($catalog))
	@include("main_carcass.brands_menu")       {{--▪▪▪ МЕНЮ  ИКОНОК  БРЭНДОВ  ▪▪▪--}}
	@include('main_carcass.filters')           {{--▪▪▪ ФИЛЬТРЫ  FILTERS ▪▪▪--}}
	@include('catalog.content')           {{--▪▪▪ КАТАЛОГ  CATALOG ▪▪▪--}}
@elseif (isset($create_new_ad_page))
	@include('crud.create_new_ad')
@elseif (isset($view_car_page))
	@include('crud.view_car')
@elseif (isset($edit_car_page))
	@include('crud.edit_car')
@elseif (isset($show_search_results))
	@include('search.show_search_results')
@else
	@include("main_carcass.brands_menu")       {{--▪▪▪ МЕНЮ  ИКОНОК  БРЭНДОВ  ▪▪▪--}}
	@include('main_carcass.filters')           {{--▪▪▪ ФИЛЬТРЫ  FILTERS ▪▪▪--}}
	@include('main_page.default_content')
@endif

<!--▪▪▪▪▪▪▪▪▪▪▪▪▪  FOOTER   ПОДВАЛ  ▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪▪-->
@include('main_carcass.footer')           {{--▪▪▪  FOOTER   ПОДВАЛ  ▪▪▪--}}

</body>
<!-- **************  СКЛАД   ИКОНКИ svg  -->
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
	<symbol id="i_close_filters_clear" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
		<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"></path>
	</symbol>
	<symbol id="i_favorite" class="bi bi-heart-pulse-fill" viewBox="0 0 16 16" fill="currentColor">
		<path fill-rule="evenodd" d="M1.475 9C2.702 10.84 4.779 12.871 8 15c3.221-2.129 5.298-4.16 6.525-6H12a.5.5 0 0 1-.464-.314l-1.457-3.642-1.598 5.593a.5.5 0 0 1-.945.049L5.889 6.568l-1.473 2.21A.5.5 0 0 1 4 9H1.475ZM.879 8C-2.426 1.68 4.41-2 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C11.59-2 18.426 1.68 15.12 8h-2.783l-1.874-4.686a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.88Z"/>
	</symbol>
	<symbol id="i_compare" class="bi bi-nintendo-switch" fill="currentColor" viewBox="0 0 16 16">
		<path d="M9.34 8.005c0-4.38.01-7.972.023-7.982C9.373.01 10.036 0 10.831 0c1.153 0 1.51.01 1.743.05 1.73.298 3.045 1.6 3.373 3.326.046.242.053.809.053 4.61 0 4.06.005 4.537-.123 4.976-.022.076-.048.15-.08.242a4.136 4.136 0 0 1-3.426 2.767c-.317.033-2.889.046-2.978.013-.05-.02-.053-.752-.053-7.979Zm4.675.269a1.621 1.621 0 0 0-1.113-1.034 1.609 1.609 0 0 0-1.938 1.073 1.9 1.9 0 0 0-.014.935 1.632 1.632 0 0 0 1.952 1.107c.51-.136.908-.504 1.11-1.028.11-.285.113-.742.003-1.053ZM3.71 3.317c-.208.04-.526.199-.695.348-.348.301-.52.729-.494 1.232.013.262.03.332.136.544.155.321.39.556.712.715.222.11.278.123.567.133.261.01.354 0 .53-.06.719-.242 1.153-.94 1.03-1.656-.142-.852-.95-1.422-1.786-1.256Z"/>
		<path d="M3.425.053a4.136 4.136 0 0 0-3.28 3.015C0 3.628-.01 3.956.005 8.3c.01 3.99.014 4.082.08 4.39.368 1.66 1.548 2.844 3.224 3.235.22.05.497.06 2.29.07 1.856.012 2.048.009 2.097-.04.05-.05.053-.69.053-7.94 0-5.374-.01-7.906-.033-7.952-.033-.06-.09-.063-2.03-.06-1.578.004-2.052.014-2.26.05Zm3 14.665-1.35-.016c-1.242-.013-1.375-.02-1.623-.083a2.81 2.81 0 0 1-2.08-2.167c-.074-.335-.074-8.579-.004-8.907a2.845 2.845 0 0 1 1.716-2.05c.438-.176.64-.196 2.058-.2l1.282-.003v13.426Z"/>
	</symbol>
	<symbol id="i_logget_user" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
		<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
		<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
	</symbol>
	<symbol id="i_search" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
		<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
	</symbol>
</svg>
<div class="sklad d-none"></div>
</html>