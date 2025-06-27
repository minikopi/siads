<a href="{{ route("paymentType.publish", ["id" =>$data->id ])}}" class="btn btn-sm btn-primary">Publish</a>
<a href="{{ route("paymentType.edit", ["id" =>$data->id ])}}" class="btn btn-sm btn-warning">Edit</a>
<button class="btn btn-sm btn-danger" onclick="deleteRow('{{route('paymentType.delete', $data->id)}}','{{$data->full_year}}')">Delete</button>
{{-- <form action="{{route('paymentType.delete', $data->id)}}"
        onsubmit="return confirm('Are you sure?')" class="d-inline"
        method="POST">
        @csrf
        <input type="hidden" name="_method" value="DELETE">

    <button type="submit" class="btn btn-sm btn-danger" >Delete</button>
</form> --}}
