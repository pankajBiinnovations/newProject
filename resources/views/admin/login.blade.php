@if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif
<form action="{{route('admin.handlelogin')}}" method="POST">
    @csrf
    <input type="text" name="email">
    <input type="password" name="password">
    <button type="submit">Login</button> 
</form>