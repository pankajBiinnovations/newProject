<a href="{{route('admin.logout')}}">Logout</a>
<a href="{{route('admin.addProduct')}}">Add Product</a>
<a href="#">Product List</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>COMMENT</th>
            <th>STATUS</th>
            <th>APPROVE/REJECT</th>
          
            <!-- Add more column headers as needed -->
        </tr>
    </thead>
    
        @foreach($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->comment }}</td>
                <td>{{$item->status}}</td>
                <td><td>
                @if($item->status=='active')
    <form action="{{url('userReject',$item->id)}}" method="POST">
        @csrf
        <button type="submit">reject</button>
    </form>
@else
    <a href="{{url('userApprove',$item->id)}}">approve</a>
@endif

                <!-- Add more table cells based on your data structure -->
            </tr>
        @endforeach
   
</table>
