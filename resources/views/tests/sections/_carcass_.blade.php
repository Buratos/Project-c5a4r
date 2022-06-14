<!doctype html>
<html lang="en">
{{--▪▪▪  tag HEAD  ▪▪▪--}}
@include('main_page.tag_head')
@yield("title")
<body>
<span>content = {{$content}} <br>*******</span>
{{--@include('tests.sections.header')--}}
{{--
@yield("header")
@yield("menu")
--}}

@yield("content")
switch
<br>
{{--
@switch($content)
	@case("home")
	@yield("home")
	плоский текст  HOME
	@break

	@case("goods")
	@yield("goods")
	@break

	@case("services")
	@yield("services")
	@break

	@case("delivery")
	@yield("delivery")
	плоский текст
	@break

	@case("contact")
	@yield("contact")
	@break
@endswitch
--}}

@yield("footer")
</body>
</html>