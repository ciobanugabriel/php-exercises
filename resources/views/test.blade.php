<html>
<body>
@if (auth()->check())
    <h1>User is authenticated</h1>
    <form method="get" action="{{ route('logout') }}">
        @csrf <!-- {{ csrf_field() }} -->
        <button type="submit" >Log out</button>
    </form>
@else
    <h1>User is not authenticated</h1>
@endif


</body>
</html>
