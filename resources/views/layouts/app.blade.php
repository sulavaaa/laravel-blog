<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--This gives us access to assets-->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <!--<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">-->
        <title>{{config('app.name','LSAPP')}}</title>
    </head>
    <body>
        @include('inc.navbar')
        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>

        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'article-ckeditor' );
        </script>
        <!--<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.js"></script>-->
        <!--<script>
                @if(Session::has('message'))
                  var type = "{{ Session::get('alert-type', 'info') }}";
                  switch(type){
                      case 'info':
                          toastr.info("{{ Session::get('message') }}");
                          break;
                      
                      case 'warning':
                          toastr.warning("{{ Session::get('message') }}");
                          break;
              
                      case 'success':
                          toastr.success("{{ Session::get('message') }}");
                          break;
              
                      case 'error':
                          toastr.error("{{ Session::get('message') }}");
                          break;
                  }
                @endif
              </script>-->
    </body>
</html>
