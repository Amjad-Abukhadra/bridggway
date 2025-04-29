<!DOCTYPE html>
<html>
  <head>
    @include('common.css')
    @include('common.js')
 </head>
  <body>
    @include('common.header')
    @include('common.sidebar')
      <div class="page-content">
          <div class="container-fluid">
            @yield('body')
      </div>
    </div>
  </body>
</html>