<button class="btn btn-info toggle-pdf" data-pdf="{{ asset('storage/' . $data->file) }}">
    PDF
</button>
<a class="btn btn-warning" href="{{ route('administrator.edaran.edit', $data) }}">
    Edit
</a>
<button class="btn btn-danger"
    onclick="deleteEdaranRow('{{ route('administrator.edaran.destroy', $data) }}', '{{ $data->nama }}')">
    Delete
</button>
