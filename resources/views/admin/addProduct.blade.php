<form method="post" action="{{url('productpost')}}" enctype="multipart/form-data">
    @csrf
    Name<input type="text" name="name"></br>
    Image<input type="file" name="image"></br>
    <button type="submit">submit</button>
</form>
