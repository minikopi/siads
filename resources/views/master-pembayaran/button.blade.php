<a href="{{ route("paymentType.edit", ["id" =>$data->id ])}}" class="btn btn-warning">Edit</a>
<button class="btn btn-danger" onclick="deleteRow('{{route('paymentType.delete', $data->id)}}','{{$data->full_year}}')">Delete</button>
{{-- <form action="{{route('paymentType.delete', $data->id)}}"
        onsubmit="return confirm('Are you sure?')" class="d-inline"
        method="POST">
        @csrf
        <input type="hidden" name="_method" value="DELETE">

    <button type="submit" class="btn btn-danger" >Delete</button>
</form> --}}
