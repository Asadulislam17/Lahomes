@extends('layouts.vertical', ['title' => 'Orders', 'subTitle' => 'Real Estate'])

@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                <div>
                    <h4 class="card-title">All Order List</h4>
                </div>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light rounded" data-bs-toggle="dropdown" aria-expanded="false">
                        This Month
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <a href="#!" class="dropdown-item">Download</a>
                        <!-- item-->
                        <a href="#!" class="dropdown-item">Export</a>
                        <!-- item-->
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
                                <th>Customer Photo & Name</th>
                                <th>Purchase Date</th>
                                <th>Contact</th>
                                <th>Property Type</th>
                                <th>Amount</th>
                                <th>Purchase Properties</th>
                                <th>Amount Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                            @forelse ($orders as $order)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div>
                                            <img src="/images/users/avatar-2.jpg" alt="" class="avatar-sm rounded-circle">
                                        </div>
                                        <div>
                                            <a href="#!" class="text-dark fw-medium fs-15">{{ $order->customer->name ?? 'N/A' }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                <td>{{ $order->contact ?? '-' }}</td>
                                <td>{{ $order->property->category ?? 'N/A' }}</td>
                                <td>${{ number_format($order->amount) }}</td>
                                <td>{{ $order->property->name ?? 'N/A' }}</td>
                                <td>
                                    @if($order->status == 'paid')
                                        <span class="badge bg-success text-white fs-11">Paid</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger text-white fs-11">Cancelled</span>
                                    @else
                                        <span class="badge bg-warning text-white fs-11">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <form action="{{ route('orders.delete', $order->id) }}" method="POST" onsubmit="return confirm('Delete this order?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-soft-danger btn-sm">
                                                <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">No orders found.</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div> <!-- end table-responsive -->
            </div>

            <div class="card-footer border-top">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

</div>

@endsection