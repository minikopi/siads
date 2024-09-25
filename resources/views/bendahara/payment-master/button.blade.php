<a href="{{ route('bendahara.master-payment.payment.edit', [$mahasantri->id, $data->id]) }}"
    class="btn btn-primary btn-sm">Ubah</a>
@if ($data->paid == 0)
    <button class="btn btn-danger btn-sm"
        onclick="deleteRow('{{ route('bendahara.master-payment.payment.destroy', [$mahasantri->id, $data->id]) }}','{{ $data->name }}')">Hapus</button>
@endif
