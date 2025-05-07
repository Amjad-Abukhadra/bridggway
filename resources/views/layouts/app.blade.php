<!DOCTYPE html>
<html>
  <head>
    @include('common.css')
    @include('common.js')
  </head>
  <body>
    @include('common.header')

    <!-- Sidebar + Main Content Layout -->
    <div class="d-flex" style="min-height: 100vh;">
      
      <!-- Sidebar -->
      @include('common.sidebar')

      <!-- Main Content Area -->
      <div class="flex-grow-1 p-4 bg-dark text-light">
        @yield('body')
      </div>
      
    </div>

  </body>
</html>
