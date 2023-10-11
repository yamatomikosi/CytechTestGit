<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/reset.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/main.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/product_informants.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/product_register.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/product_specific.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/product_edit.css') }}">
 
  <title>cytechTest - @yield('title')</title>
</head>

<body>

  <div class="Common_Wrap">
    <div class="Common_Inner">
      <main class="Container">
        
        @yield ('content')
        @if ($showView)
       
      </main>
      @section ('backRoll')
        <button id="backPage" type="button" >戻る</button>
        @endif
        @show
    </div>
  </div>
</body>
<script src="{{asset('assets/js/main.js')}}"></script>
</html>