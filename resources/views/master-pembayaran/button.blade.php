<a href="{{ route("paymentType.edit", ["id" =>$data->id ])}}" class="btn btn-warning">Edit</a>
<form action="{{route('paymentType.delete', $data->id)}}"
        onsubmit="return confirm('Are you sure?')" class="d-inline"
        method="POST">
        @csrf
        <input type="hidden" name="_method" value="DELETE">

    <button type="submit" class="btn btn-danger" >Delete</button>
</form>
