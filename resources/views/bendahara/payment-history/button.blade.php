<a href="{{ route('bendahara.payment-history.show', $data->id) }}" class="btn btn-primary btn-sm" data-bs-toggle="modal"
    data-bs-target="#exampleModal-{{ $data->id }}">Detail</a>

<div class="modal fade" id="exampleModal-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ $data->invoice_code }} - {{ $data->mahasantri->nama_lengkap }} -
                    {{ $data->created_at->translatedFormat('d F Y - H:i') }}
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
                        <tr>
                            <td class="fw-bold">Total</td>
                            <td>{{ App\Helpers\Formater::RupiahCurrency($data->total) }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Biaya</td>
                            <td>{{ App\Helpers\Formater::RupiahCurrency($data->merchant_amount) }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Nett</td>
                            <td>{{ App\Helpers\Formater::RupiahCurrency($data->nett_amount) }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary text-white fw-bold">Catatan</div>
                            <div class="card-body">
                                <p class="card-text">{{ $data->notes ?? '-' }}</p>
                                <hr>
                                <table class="table">
                                    <tr>
                                        <td width="30%">Status</td>
                                        <td>{{ $data->status }}</td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Link</td>
                                        <td>
                                            @isset($data->payment_url)
                                                <a href="{{ $data->payment_url }}" target="_blank">Midtrans</a>
                                            @else
                                                -
                                            @endisset
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Metode Pembayaran</td>
                                        <td>{{ $data->payment_type }}</td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Penerima Pembayaran</td>
                                        <td>{{ $data->merchant_name }}</td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Nomor Rekening</td>
                                        <td>{{ $data->merchant_number }}</td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Status Midtrans</td>
                                        <td>{{ $data->transaction_status }} # {{ $data->fraud_status }}</td>
                                    </tr>
                                </table>
                                <hr>
                                Terakhir update: <em>{{ $data->updated_at->translatedFormat('d F Y, H:i') }}</em>
                            </div>
                            @if ($data->status !== 'Void' || $data->transaction_status !== 'cancel')
                                <div class="card-footer text-muted">
                                    <strong>Pembatalan</strong>
                                    <form action="{{ route('bendahara.pembayaran.cancel', $data->getKey()) }}"
                                        method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="alasan_pembatalan"></label>
                                            <textarea class="form-control" name="alasan_pembatalan" id="alasan_pembatalan" rows="3"
                                                placeholder="Alasan pembatalan dan keterangan lainnya"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary">Konfirmasi Pembatalan</button>
                                    </form>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
