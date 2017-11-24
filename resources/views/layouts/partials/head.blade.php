<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Job Save: @yield('title')</title>
<meta name="description" content="Track job search activities with ease" />
<meta name="Author" content="Simon Bashir [www.itproserve.com]" />

<!-- Styles -->
<link rel="stylesheet" href="{{asset('css/bulma.css')}}" />

<!-- JQUERY -->
<link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}" />
<link rel="stylesheet" href="{{asset('css/jquery-ui.theme.min.css')}}" />

<!-- FONTS -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<!-- CUSTOME STYLES -->
<link rel="stylesheet" href="{{asset('css/custom.css')}}" />

<link href="https://fonts.googleapis.com/css?family=Anton|Audiowide|Orbitron|Patua+One|Permanent+Marker|Righteous|Russo+One" rel="stylesheet">

@yield('css_file')

<!-- Scripts -->
<script>
    window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};
</script>
