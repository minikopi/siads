<a href="{{ route('bendahara.payment-history.show', $data->id) }}" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $data->id }}">Detail</a>

<div class="modal fade" id="exampleModal-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ $data->invoice_code }} - {{ $data->mahasantri->nama_lengkap }} - {{ $data->created_at->format('d F Y - H:i') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Pembayaran</th>
                            <th>Nominal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->details as $detail)
                        <tr>
                            <td scope="row">{{ $detail->payment_type->name }}</td>
                            <td>{{ App\Helpers\Formater::RupiahCurrency($detail->nominal) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
