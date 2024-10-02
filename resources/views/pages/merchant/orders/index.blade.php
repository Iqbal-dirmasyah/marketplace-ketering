@extends('layouts.merchant')

@section('content')
    <div class="mt-3">
        <h1 class="fw-bold fs-3 text-primary mb-3">Order</h1>
        <div class="row gap-3">
            @if (!count($orders))
                <h2 class="text-muted fw-semibold fs-4">Tidak ada order</h2>
            @else
                @foreach ($orders as $order)
                    <div class="col-3 card shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                @if ($order->status)
                                    <span class="badge bg-primary">Pesanan sudah dikonfirmasi</span>
                                @else
                                    <span class="badge bg-warning">Pesanan belum dikonfirmasi</span>
                                @endif
                            </div>
                            <p class="text-muted fs-6 m-0">{{ $order->created_at->format('d F Y') }}</p>

                            <h2 class="mb-4">Rp {{ number_format($order->total) }}</h2>
                            <button type="button" class="btn btn-primary block btn-sm fs-6" data-bs-toggle="modal"
                                data-bs-target="#invoiceModal{{ $order->id }}">
                                Lihat Invoice
                            </button>
                            <div class="modal fade" id="invoiceModal{{ $order->id }}" tabindex="-1"
                                aria-labelledby="invoiceModal{{ $order->id }}Title" aria-hidden="true"
                                style="display: none;">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                    role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="invoiceModal{{ $order->id }}Title">Detail
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
                                            @foreach ($order->transactionItems as $transactionItem)
                                                @if ($transactionItem->transaction_id == $order->id)
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
                                                @if ($order->status)
                                                    <span class="badge bg-primary">Pesanan sudah dikonfirmasi</span>
                                                @else
                                                    <span class="badge bg-warning">Pesanan belum dikonfirmasi</span>
                                                @endif
                                            </div>
                                            <p class="fs-6 mb-2 fw-bold">Nama pemesan: {{ $order->user->name }}</p>
                                            <p class="fs-6 pb-3 fw-bold border-bottom">Tanggal pengiriman:
                                                {{ date('d F Y', strtotime($order->date)) }}</p>
                                            <p class="fs-3 mb-0 fw-bold">Total: Rp {{ number_format($order->total) }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </button>
                                            @if (!$order->status)
                                                <form action="{{ route('pages.merchant.orders.verify', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Verifikasi</span>
                                                    </button>
                                                </form>
                                            @endif
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
