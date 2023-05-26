<form action="{{route('user.handlelogin')}}" method="POST">
    @csrf
    <input type="text" name="email">
    <input type="password" name="password">
    <button type="submit">Login</button> 
</form>