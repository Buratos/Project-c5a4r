<ul>
	@foreach($found_items as $item)
		<li class="dynamic_search_list_item">
			<a href="{{route('car.view',[$item['id']])}}">{{$item["title"]}}</a>
		</li>
	@endforeach
</ul>