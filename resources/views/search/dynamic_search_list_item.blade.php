@foreach($found_items as $item)
		<li class="dynamic_search_list_item">
			<a href="{{route('view_car',[$item['id']])}}">{{$item["title"]}}</a>
		</li>
@endforeach