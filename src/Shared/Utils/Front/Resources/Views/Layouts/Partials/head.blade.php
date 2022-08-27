<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

<title>
    @yield('title') | {{ config('app.name') }}
</title>

@section('canonical')
    <link href="{{ url()->full() }}" rel="canonical">
@show

<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stack('css')
