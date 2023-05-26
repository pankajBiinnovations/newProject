@php
$data=\App\Models\Product::all();
@endphp
<a href="{{route('user.logout')}}">Logout</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>IMAGE</th>
            <!-- Add more column headers as needed -->
        </tr>
    </thead>
    
        @foreach($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td><img src="{{ asset('public/images/' . $item->image) }}" alt="Image">
</td>
<td>
<form id="reviewForm">
  
   <div class="form-group">
       <label for="comment">Comment:</label>
       <textarea name="comment" id="comment" rows="4" required></textarea>
   </div>
   <button type="submit">Submit</button>
</form>
</td>
                <!-- Add more table cells based on your data structure -->
            </tr>
        @endforeach
   
</table>


    
<a href="{{url('myreview')}}">My Review</a>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Listen for form submission
    $('#reviewForm').submit(function(event) {
        event.preventDefault();

        // Get form data
        var formData = $(this).serialize();
        // Send AJAX request
        $.ajax({
            url: '{{ route('addReviewPost') }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                // Handle successful response
                alert(response.message);
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.log(xhr.responseText);
            }
        });
    });
</script>

