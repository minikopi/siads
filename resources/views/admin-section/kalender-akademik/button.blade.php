<a class="btn btn-sm btn-warning" href="{{ route('administrator.akademik.edit', $data) }}">
    Edit
</a>
<button class="btn btn-sm btn-danger" onclick="deleteKalenderRow('{{ route('administrator.akademik.destroy', $data) }}', '{{ $data->nama }}')">
    Delete
</button>
