
<a href="{{route('admin.logout')}}">Logout</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>COMMENT</th>
            <th>STATUS</th>
            <th>APPROVE/REJECT</th>
            <th>REMOVE REVIEW</th>
          
            <!-- Add more column headers as needed -->
        </tr>
    </thead>
    
        @foreach($datas as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->comment }}</td>
                <td>{{$item->status}}</td>
                <td>
                @if($item->status=='active')
    <form action="{{url('userReject',$item->id)}}" method="POST">
        @csrf
        <button type="submit">reject</button>
    </form>
@else
    <a href="{{url('userApprove',$item->id)}}">approve</a>
@endif
<td>
<button class="btn-delete" data-item-id="{{ $item->id }}">Delete</button>
</td>

                <!-- Add more table cells based on your data structure -->
            </tr>
        @endforeach
   
</table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            
            var itemId = $(this).data('item-id');
          
            
            $.ajax({
                url: '/items/' + itemId,
                type: 'GET',
                dataType: 'json',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Handle success response
                   alert("deleted successfully");
                  
                 
                },
                error: function(xhr) {
                    // Handle error response
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
