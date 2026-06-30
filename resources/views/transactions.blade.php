@extends('layouts.vertical', ['title' => 'Transaction', 'subTitle' => 'Real Estate'])

@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                <div>
                    <h4 class="card-title">All Transactions List</h4>
                </div>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light rounded" data-bs-toggle="dropdown" aria-expanded="false">
                        This Month
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="#!" class="dropdown-item">Download</a>
                        <a href="#!" class="dropdown-item">Export</a>
                        <a href="#!" class="dropdown-item">Import</a>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle text-nowrap table-hover table-centered mb-0">
                        <thead class="bg-light-subtle">
                            <tr>
                                <th style="width: 20px;">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="customCheck1">
                                        <label class="form-check-label" for="customCheck1"></label>
                                    </div>
                                </th>
                                <th>Transactions ID</th>
                                <th>Customer Photo & Name</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Invested Property</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($transactions as $transaction)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                    </div>
                                </td>
                                <td><a href="#!" class="link-primary fw-semibold">TXN-{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</a></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ $transaction->order->customer->avatar ?? '/images/users/avatar-2.jpg' }}" alt="" class="avatar-sm rounded-circle flex-shrink-0">
                                        <div>
                                            <a href="#!" class="text-dark fw-medium fs-15">{{ $transaction->order->customer->name ?? 'N/A' }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                                <td>${{ number_format($transaction->amount) }}</td>
                                <td>{{ $transaction->payment_method }}</td>
                                <td>{{ $transaction->order->property->name ?? 'N/A' }}</td>
                                <td>
                                    @if($transaction->status == 'success')
                                        <span class="badge bg-success-subtle text-success py-1 px-2 fs-12">Completed</span>
                                    @elseif($transaction->status == 'failed')
                                        <span class="badge bg-danger-subtle text-danger py-1 px-2 fs-12">Failed</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning py-1 px-2 fs-12">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <!-- 🔹 ডাইনামিক মডাল টার্গেট করার জন্য আইডি লিংক সংযুক্ত করা হলো -->
                                        <a href="#" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#TransactionsViewModal{{ $transaction->id }}">
                                            <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <!-- 🔹 ডাইনামিক মডাল কোড (লুপের ভেতরে থাকার কারণে প্রতি লাইনের জন্য আলাদা ডাটা কাজ করবে) -->
                            <div class="modal fade" id="TransactionsViewModal{{ $transaction->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="card border-0 mb-0 shadow-none">
                                                <div class="card-body p-0 pb-3">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="position-relative">
                                                            <img src="{{ $transaction->order->customer->avatar ?? '/images/users/avatar-2.jpg' }}" alt="" class="avatar-md rounded-circle flex-shrink-0 img-thumbnail">
                                                            <span class="position-absolute bottom-0 end-0">
                                                                <i class="ri-verified-badge-fill fs-18 align-bottom text-primary bg-light rounded-circle"></i>
                                                            </span>
                                                        </div>
                                                        <div class="text-start">
                                                            <h5 class="text-dark fw-semibold fs-18 mb-0">{{ $transaction->order->customer->name ?? 'N/A' }}</h5>
                                                            <p class="mb-0 text-muted small">{{ $transaction->order->customer->email ?? 'N/A' }}</p>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <span class="badge bg-primary-subtle text-primary py-1 px-2 fs-12">Premium</span>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- ক্রেডিট কার্ড উইজেট -->
                                                    <div class="p-3 bg-primary bg-gradient rounded-4 mt-4 border border-light border-2 shadow-sm text-start">
                                                        <div class="d-flex align-items-center">
                                                            <img src="/images/chip.png" alt="" class="avatar" style="width: 35px;">
                                                            <div class="ms-auto">
                                                                <img src="/images/card/mastercard.svg" alt="" class="avatar" style="width: 40px;">
                                                            </div>
                                                        </div>
                                                        <div class="mt-5">
                                                            <h4 class="text-white d-flex gap-2"><span class="text-white-50">XXXX</span> <span class="text-white-50">XXXX</span> <span class="text-white-50">XXXX</span> 3467</h4>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-between mt-4">
                                                            <div>
                                                                <p class="text-white-50 small mb-1">Holder Name</p>
                                                                <h5 class="mb-0 text-white">{{ $transaction->order->customer->name ?? 'N/A' }}</h5>
                                                            </div>
                                                            <div>
                                                                <p class="text-white-50 small mb-1">Valid</p>
                                                                <h5 class="mb-0 text-white">05/29</h5>
                                                            </div>
                                                            <img src="/images/contactless-payment.png" alt="" class="img-fluid" style="height: 30px;">
                                                        </div>
                                                    </div>

                                                    <!-- ট্রানজেকশন হিস্ট্রি বিবরণী -->
                                                    <div class="mt-4 text-start">
                                                        <h5 class="text-dark fw-medium mb-3">Transaction Summary</h5>
                                                        <div class="border p-3 rounded-3 bg-light bg-opacity-50">
                                                            <div class="d-flex justify-content-between mb-2">
                                                                <span class="text-muted">Invested Property:</span>
                                                                <span class="text-dark fw-medium">{{ $transaction->order->property->name ?? 'N/A' }}</span>
                                                            </div>
                                                            <div class="d-flex justify-content-between mb-2">
                                                                <span class="text-muted">Payment Method:</span>
                                                                <span class="text-dark fw-medium">{{ $transaction->payment_method }}</span>
                                                            </div>
                                                            <div class="d-flex justify-content-between">
                                                                <span class="text-muted">Txn Date:</span>
                                                                <span class="text-dark">{{ $transaction->created_at->format('d F, Y (h:i A)') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer border-top px-1 pt-3 bg-white">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <p class="mb-0 fs-15 text-muted">Total Amount</p>
                                                        <h4 class="mb-0 text-primary fw-bold">${{ number_format($transaction->amount) }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">No transactions found.</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
