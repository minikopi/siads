<a class="btn btn-warning" href="{{ route('administrator.akademik.edit', $data) }}">
    Edit
</a>
<button class="btn btn-danger" onclick="deleteKalenderRow('{{ route('administrator.akademik.destroy', $data) }}', '{{ $data->nama }}')">
    Delete
</button>
