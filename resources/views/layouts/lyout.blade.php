<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/reset.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/product_informants.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/main.css') }}">
  <title>cytechTest - @yield('title')</title>
  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script
  src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"
  integrity="sha256-xH4q8N0pEzrZMaRmd7gQVcTZiFei+HfRTBPJ1OGXC0k="
  crossorigin="anonymous"></script>
</head>

<body>

  <div class="Common_Wrap">
      <main class="Container">
        
        @yield ('content')
        @if ($showView)
        @section ('backRoll')
        <button id="backPage" type="button" >戻る</button>
        @show
        @endif
      </main>
    </div>
</body>
<script src="{{asset('assets/js/main.js')}}"></script>
</html>