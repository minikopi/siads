@extends('template')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Tagihan Pembayaran - {{ $siswa->nama_lengkap }}</h1>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row mt-5">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xl-4">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h6 class="">Belum dibayar</h6>
                                                    <h3 class="mb-2 number-font">
                                                        Rp {{ number_format($total->unpaid, 0, ',', '.') }}
                                                    </h3>
                                                    @php
                                                        $belum_dibayar = number_format(
                                                            ($total->unpaid / $total->invoice) * 100,
                                                            0,
                                                            ',',
                                                            '.',
                                                        );

                                                        if ($belum_dibayar > 70) {
                                                            $belum_dibayar_text = 'danger';
                                                        } elseif ($belum_dibayar > 20) {
                                                            $belum_dibayar_text = 'warning';
                                                        } else {
                                                            $belum_dibayar_text = 'success';
                                                        }
                                                    @endphp
                                                    <p class="text-muted mb-0">
                                                        <span class="text-{{ $belum_dibayar_text }}">
                                                            {{ $belum_dibayar }}%</span> tagihan belum dibayar.
                                                    </p>
                                                </div>
                                                <div class="col col-auto">
                                                    <div
                                                        class="counter-icon bg-{{ $belum_dibayar_text }}-gradient box-shadow-{{ $belum_dibayar_text }} brround ms-auto">
                                                        <i class="fe fe-alert-triangle text-white mb-5 "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xl-4">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h6 class="">Sudah dibayar</h6>
                                                    <h3 class="mb-2 number-font">
                                                        Rp {{ number_format($total->paid, 0, ',', '.') }}
                                                    </h3>
                                                    @php
                                                        $sudah_dibayar = number_format(
                                                            ($total->paid / $total->invoice) * 100,
                                                            0,
                                                            ',',
                                                            '.',
                                                        );

                                                        if ($sudah_dibayar > 80) {
                                                            $sudah_dibayar_text = 'success';
                                                        } elseif ($sudah_dibayar > 40) {
                                                            $sudah_dibayar_text = 'warning';
                                                        } else {
                                                            $sudah_dibayar_text = 'danger';
                                                        }
                                                    @endphp
                                                    <p class="text-muted mb-0">
                                                        <span class="text-{{ $sudah_dibayar_text }}">
                                                            {{ $sudah_dibayar }}%</span> tagihan sudah dibayar.
                                                    </p>
                                                </div>
                                                <div class="col col-auto">
                                                    <div
                                                        class="counter-icon bg-{{ $sudah_dibayar_text }}-gradient box-shadow-{{ $sudah_dibayar_text }} brround  ms-auto">
                                                        <i class="fe fe-check text-white mb-5 "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 col-xl-4">
                                    <div class="card overflow-hidden">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h6 class="">Total Tagihan</h6>
                                                    <h3 class="mb-2 number-font">
                                                        {{ number_format($total->invoice, 0, ',', '.') }}
                                                    </h3>
                                                    {{-- <p class="text-muted mb-0">
                                                        <span class="text-success"><i
                                                                class="fa fa-chevron-circle-down text-success me-1"></i>
                                                            5%</span> dari nilai sebelumnya
                                                    </p> --}}
                                                </div>
                                                <div class="col col-auto">
                                                    <div
                                                        class="counter-icon bg-secondary-gradient box-shadow-secondary brround ms-auto">
                                                        <i class="fe fe-dollar-sign text-white mb-5 "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Tagihan</h3>
                                <p class="ms-auto">
                                    <a class="btn @if ($token['invoice'] != null) btn-danger @else btn-success @endif text-white rounded-0"
                                        id="pay-button"
                                        @if ($token['invoice'] != null) href="{{ $token['invoice']->payment_url }}" @else disabled @endif>
                                        {{ $token['invoice'] != null ? 'Bayar Sekarang' : 'Tidak Ada Tagihan' }}
                                    </a>
                                    @if ($token['invoice'] != null)
                                        <a class="btn btn-warning text-white rounded-0"
                                            href="{{ route('mahasantri.pembayaran.cancel', $token['invoice']) }}"
                                            onclick="return confirm('Apakah yakin ingin membatalkan transaksi ini?')">
                                            Batalkan
                                        </a>
                                    @endif
                                </p>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{ route('pembayaran.store') }}" id="pembayaran" method="POST">
                                            @csrf
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="checkAll" />
                                                                </div>
                                                            </th>
                                                            <th scope="col">Jenis Tagihan</th>
                                                            <th scope="col">Nominal</th>
                                                            <th scope="col">Terbayar</th>
                                                            <th scope="col">Jatuh Tempo</th>
                                                            <th scope="col">Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($payments as $payment)
                                                            <tr class="clickable-row"
                                                                data-installment="{{ $payment->installment == 1 ? 'cicil' : 'lunas' }}"
                                                                data-nominal="{{ $payment->outstanding }}">
                                                                <td scope="row">
                                                                    @if ($payment->outstanding > 0)
                                                                        <div class="form-check">
                                                                            <input class="form-check-input rowCheckbox"
                                                                                type="checkbox" value="{{ $payment->id }}"
                                                                                id="payment-{{ $payment->id }}"
                                                                                name="payment_id[]" />
                                                                        </div>
                                                                    @else
                                                                        <span class="text-success"><i
                                                                                class="fa fa-check text-success"
                                                                                aria-hidden="true"></i></span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    {{ $payment->payment_type->name }}
                                                                    @if ($payment->semester > 0)
                                                                        (Semester {{ $payment->semester }})
                                                                    @endif
                                                                </td>
                                                                <td>{{ number_format($payment->total, 0, ',', '.') }}</td>
                                                                <td>{{ number_format($payment->paid, 0, ',', '.') }}</td>
                                                                <td>{{ $payment->due_date->format('d F Y') }}</td>
                                                                <td style="width: 20%">
                                                                    @if ($payment->outstanding == 0)
                                                                        <a class="btn btn-success btn-sm text-white"
                                                                            style="width: 100%">Lunas</a>
                                                                    @else
                                                                        <a class="btn btn-danger btn-sm text-white"
                                                                            style="width: 100%">Belum Lunas</a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <table id="summaryTable" class="table summary-table">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th colspan="2" class="text-white">Ringkasan Pembayaran</th>
                                                </tr>
                                            </thead>
                                            <tbody id="summaryBody"></tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="text-success"><strong>Total</strong></td>
                                                    <td class="text-success" id="totalValue"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <button type="submit" class="btn btn-success btn-block"
                                            form="pembayaran">Bayar</button>
                                    </div>
                                    @if ($token['invoice'] != null)
                                        <div class="col-md-4">
                                            <table class="table summary-table">
                                                <thead>
                                                    <tr class="bg-warning">
                                                        <th colspan="2" class="text-white">
                                                            Tagihan Aktif - {{ $token['invoice']->invoice_code }}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $nominal_total = 0;
                                                    @endphp
                                                    @foreach ($token['invoice']->details as $inv)
                                                        <tr>
                                                            <td>{{ $inv->name_payment }}</td>
                                                            <td>{{ number_format($inv->nominal, 0, ',', '.') }}</td>
                                                        </tr>
                                                        @php
                                                            $nominal_total += $inv->nominal;
                                                        @endphp
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="fw-bolder"><strong>Total Harga</strong></td>
                                                        <td class="fw-bolder">
                                                            {{ number_format($nominal_total, 0, ',', '.') }}</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <a href="{{ $token['invoice']->payment_url }}"
                                                class="btn btn-warning btn-block fw-bold" form="pembayaran">Bayar
                                                Sekarang</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
        </div>
    </div>
    <!-- CONTAINER CLOSED -->
    </div>
    @push('custom')
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
        <!-- SweetAlert2 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
        <script>
            // Ambil elemen checkbox 'checkAll' dan semua checkbox baris
            const checkAll = document.getElementById('checkAll');
            const checkboxes = document.querySelectorAll('.rowCheckbox');
            const tableBody = document.getElementById('tableBody');
            const summaryTable = document.getElementById('summaryTable');
            const summaryBody = document.getElementById('summaryBody');
            const totalValue = document.getElementById('totalValue');
            let total = 0;

            // Fungsi untuk mengatur semua checkbox sesuai dengan checkbox 'checkAll'
            checkAll.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = checkAll.checked;
                    toggleAdditionalRow(checkbox);
                });
            });

            // Tambahkan event listener ke setiap baris untuk klik checkbox
            document.querySelectorAll('.clickable-row').forEach(row => {
                row.addEventListener('click', function(e) {
                    // Cegah checkbox berulang kali diklik
                    if (e.target.type !== 'checkbox') {
                        const checkbox = this.querySelector('.rowCheckbox');
                        checkbox.checked = !checkbox.checked;
                        toggleAdditionalRow(checkbox);
                    }
                });
            });

            // Fungsi untuk meng-update checkbox 'checkAll' jika ada perubahan di checkbox baris
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    toggleAdditionalRow(this);

                    if (!this.checked) {
                        checkAll.checked = false; // Uncheck 'checkAll' jika ada salah satu yang tidak dicentang
                    } else if (Array.from(checkboxes).every(chk => chk.checked)) {
                        checkAll.checked = true; // Centang 'checkAll' jika semua checkbox dicentang
                    }
                });
            });

            // Fungsi untuk menambah atau menghapus baris tambahan
            function toggleAdditionalRow(checkbox) {
                const currentRow = checkbox.closest('tr');
                const installment = currentRow.getAttribute('data-installment');
                const outstanding = currentRow.getAttribute('data-nominal');
                const inputField = currentRow.querySelector('input');

                // Jika checkbox dicentang, tambahkan baris baru
                if (checkbox.checked) {
                    const newRow = document.createElement('tr');
                    newRow.classList.add('new-row');
                    if (installment == 'cicil') {
                        newRow.innerHTML = `
                <td colspan="2">&nbsp;</td>
                <td colspan="3">
                    <input type="number" class="form-control is-valid extra-input" name="nominal[]" placeholder="Masukkan nominal pembayaran untuk ${currentRow.children[1].innerText}" data-name="${currentRow.children[1].innerText}" oninput="updateSummary(this)" form="pembayaran">
                </td>
            `;
                    } else {
                        newRow.innerHTML = `
                <td colspan="2">&nbsp;</td>
                <td colspan="3">
                    <input type="number" class="form-control is-valid extra-input" name="nominal[]" placeholder="Masukkan nominal pembayaran untuk ${currentRow.children[1].innerText}" data-name="${currentRow.children[1].innerText}" oninput="updateSummary(this)" onclick="updateSummary(this)" value="${outstanding}" readonly form="pembayaran">
                </td>
            `;
                        var mi = document.createElement("input");
                        mi.setAttribute('value', outstanding);
                        mi.setAttribute('data-name', currentRow.children[1].innerText);
                        updateSummary(mi)
                    }

                    currentRow.after(newRow);
                } else {
                    // Jika checkbox tidak dicentang, hapus baris tambahan di bawahnya
                    if (currentRow.nextElementSibling && currentRow.nextElementSibling.classList.contains('new-row')) {
                        currentRow.nextElementSibling.remove();
                        removeSummaryEntry(currentRow.children[1].innerText); // Hapus dari summary
                    }
                }
            }

            // Fungsi untuk memperbarui tabel summary ketika ada input
            function updateSummary(input) {
                const name = input.getAttribute('data-name');
                const value = parseFloat(input.value) || 0;
                let summaryRow = document.querySelector(`#summaryBody tr[data-name="${name}"]`);

                if (summaryRow) {
                    summaryRow.children[1].innerText = value.toLocaleString();
                } else {
                    summaryRow = document.createElement('tr');
                    summaryRow.setAttribute('data-name', name);
                    summaryRow.innerHTML = `
                <td>${name}</td>
                <td>${value.toLocaleString()}</td>
            `;
                    summaryBody.appendChild(summaryRow);
                }
                calculateTotal();
            }

            // Fungsi untuk menghitung total nilai tambahan
            function calculateTotal() {
                total = Array.from(document.querySelectorAll('#summaryBody tr td:nth-child(2)')).reduce((sum, td) => sum +
                    parseFloat(td.innerText.replace(/,/g, '') || 0), 0);
                totalValue.innerText = total.toLocaleString();
            }

            // Fungsi untuk menghapus baris summary saat checkbox dinonaktifkan
            function removeSummaryEntry(name) {
                const summaryRow = document.querySelector(`#summaryBody tr[data-name="${name}"]`);
                if (summaryRow) {
                    summaryRow.remove();
                    calculateTotal();
                }
            }
        </script>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                });
            </script>
        @endif
    @endpush
@endsection
