<button class="btn btn-warning" onclick="deleteRow({{ $data->id }})">
    Edit
</button>
<button class="btn btn-danger" onclick="deleteRow('{{ route('bendahara.master-payment.payment.destroy', [$mahasantri->id, $data->id]) }}','{{ $data->name }}')">
    Delete
</button>
