<!DOCTYPE html>
<html lang="en">
    @include('partials.head')
    <body>
        @include('partials.menu')      
        <div class="container">
            @include('partials.notifications')
            @yield('content')
        </div>
        <footer class="footer">
	      <div class="container">
	      </div>
	    </footer>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>