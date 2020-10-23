<head>
	<title>{{ config('app.name', 'LeMeet') }}</title>
</head>
<body>
@include('layouts/header')
@include('layouts/navbar')
     <div class="container">
             
            @yield('content')
     </div>
 

@include('layouts/footer')

</body>