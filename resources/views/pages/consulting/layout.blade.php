<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>KARADA КОНСАЛТИНГ - много клиентов малыми затратами</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	@include('pages.consulting.css')
</head>
<body>
	@include('pages.consulting.header',['fields' => $fields])
	<main class="consulting">
		@yield('content')
	</main>
	@include('pages.consulting.footer',$fields)
</body>
@include('pages.consulting.script')
</html>