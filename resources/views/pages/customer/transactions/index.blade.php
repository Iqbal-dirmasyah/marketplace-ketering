@extends('layouts.customer')
@section('content')
    <div class="container mt-3">
        <h1 class="fw-bold fs-3 text-primary mb-3">Transaksi</h1>
        <div class="row gap-3">
            @if (!count($transactions))
                <h2 class="text-muted fw-semibold fs-4">Tidak ada transaksi</h2>
            @else
                @foreach ($transactions as $transaction)
                    <div class="col-3 card shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                @if ($transaction->status)
                                    <span class="badge bg-primary">Pesanan sudah dikirimkan</span>
                                @else
                                    <span class="badge bg-warning">Pesanan belum dikirimkan</span>
                                @endif
                            </div>
                            <p class="text-muted fs-6 m-0">{{ $transaction->created_at->format('d F Y') }}</p>
                            <h2 class="mb-4">Rp {{ number_format($transaction->total) }}</h2>
                            <button type="button" class="btn btn-primary block btn-sm fs-6" data-bs-toggle="modal"
                                data-bs-target="#invoiceModal{{ $transaction->id }}">
                                Lihat Invoice
                            </button>
                            <div class="modal fade" id="invoiceModal{{ $transaction->id }}" tabindex="-1"
                                aria-labelledby="invoiceModal{{ $transaction->id }}Title" aria-hidden="true"
                                style="display: none;">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="invoiceModal{{ $transaction->id }}Title">Detail
                                                Invoice
                                            </h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-x">
                                                    <line x1="18" y1="6" x2="6" y2="18">
                                                    </line>
                                                    <line x1="6" y1="6" x2="18" y2="18">
                                                    </line>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($transactionItems as $transactionItem)
                                                @if ($transactionItem->transaction_id == $transaction->id)
                                                    <div class="pb-2 mb-2 border-bottom">
                                                        <div class="mb-2">
                                                            <img src="{{ asset('storage/' . $transactionItem->product->image) }}"
                                                                alt="{{ $transactionItem->product->name }}"
                                                                class="img-fluid" width="60px">
                                                        </div>
                                                        <div class="mb-2">
                                                            <span class="fw-bold text-primary">Nama:</span>
                                                            <span
                                                                class="fs-6">{{ $transactionItem->product->name }}</span>
                                                        </div>
                                                        <div class="mb-2">
                                                            <span class="fw-bold text-primary">Jumlah:</span>
                                                            <span class="fs-6">{{ $transactionItem->quantity }}</span>
                                                        </div>
                                                        <div class="mb-2">
                                                            <span class="fw-bold text-primary">Harga:</span>
                                                            <span class="fs-6">Rp
                                                                {{ number_format($transactionItem->product->price) }}</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                            <div class="d-flex gap-2 mb-2">
                                                <p class="fs-6 mb-0 fw-bold">Status:</p>
                                                @if ($transaction->status)
                                                    <span class="badge bg-primary">Pesanan sudah dikirimkan</span>
                                                @else
                                                    <span class="badge bg-warning">Pesanan belum dikirimkan</span>
                                                @endif
                                            </div>
                                            <p class="fs-6 pb-3 border-bottom fw-bold">Tanggal pengiriman:
                                                {{ date('d F Y', strtotime($transaction->date)) }}</p>
                                            <p class="fs-3 m-0 fw-bold">Total: Rp {{ number_format($transaction->total) }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
