@extends('layouts.vertical', ['title' => 'Listing List', 'subTitle' => 'Real Estate'])

@section('content')

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="card-title mb-2 ">Total Incomes</h4>
                        <p class="text-muted fw-medium fs-22 mb-0">$12,7812.09</p>
                    </div>
                    <div>
                        <div class="avatar-md bg-primary bg-opacity-10 rounded">
                            <iconify-icon icon="solar:wallet-money-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-3">
                    <p class="mb-0"><span class="text-success fw-medium mb-0"><i class="ri-arrow-up-line"></i>34.4%</span> vs last month</p>
                    <div>
                        <a href="#!" class="link-primary fw-medium">See Details <i class='ri-arrow-right-line align-middle'></i></a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="card-title mb-2 ">Total Properties</h4>
                        <p class="text-muted fw-medium fs-22 mb-0">15,780 Unit</p>
                    </div>
                    <div>
                        <div class="avatar-md bg-primary bg-opacity-10 rounded">
                            <iconify-icon icon="solar:home-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-3">
                    <p class="mb-0"><span class="text-danger fw-medium mb-0"><i class="ri-arrow-down-line"></i>8.5%</span> vs last month</p>

                    <div>
                        <a href="#!" class="link-primary fw-medium">See Details <i class='ri-arrow-right-line align-middle'></i></a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="card-title mb-2 ">Unit Sold</h4>
                        <p class="text-muted fw-medium fs-22 mb-0">893 Unit</p>
                    </div>
                    <div>
                        <div class="avatar-md bg-primary bg-opacity-10 rounded">
                            <iconify-icon icon="solar:dollar-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-3">
                    <p class="mb-0"><span class="text-success fw-medium mb-0"><i class="ri-arrow-up-line"></i>17%</span> vs last month</p>
                    <div>
                        <a href="#!" class="link-primary fw-medium">See Details <i class='ri-arrow-right-line align-middle'></i></a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="card-title mb-2 ">Unit Rent</h4>
                        <p class="text-muted fw-medium fs-22 mb-0">459 Unit</p>
                    </div>
                    <div>
                        <div class="avatar-md bg-primary bg-opacity-10 rounded">
                            <iconify-icon icon="solar:key-minimalistic-square-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-3">
                    <p class="mb-0"><span class="text-danger fw-medium mb-0"><i class="ri-arrow-down-line"></i>12%</span> vs last month</p>
                    <div>
                        <a href="#!" class="link-primary fw-medium">See Details <i class='ri-arrow-right-line align-middle'></i></a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                <div>
                    <h4 class="card-title mb-0">All Properties List</h4>
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
                            <th>Properties Photo & Name</th>
                            <th>Size</th>
                            <th>Property Type</th>
                            <th>Rent/Sale</th>
                            <th>Bedrooms</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @forelse($properties as $property)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="customCheck{{ $property->id }}">
                                    <label class="form-check-label" for="customCheck{{ $property->id }}">&nbsp;</label>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div>
                                        <img src="{{ $property->image ? asset($property->image) : asset('/images/properties/default.jpg') }}" alt="" class="avatar-md rounded border border-light border-3">
                                    </div>
                                    <div>
                                        <a href="#!" class="text-dark fw-medium fs-15">{{ $property->name }}</a>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $property->sqft ?? '0' }} sqft</td>
                            <td>{{ $property->category }}</td>
                            <td> 
                                @if(strtolower($property->property_for) == 'rent')
                                    <span class="badge bg-success-subtle text-success py-1 px-2 fs-13">Rent</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger py-1 px-2 fs-13">Sale</span>
                                @endif
                            </td>
                            <td>
                                <p class="mb-0"><iconify-icon icon="solar:bed-broken" class="align-middle fs-16"></iconify-icon> {{ $property->bedroom ?? '0' }}</p>
                            </td>
                            <td>{{ $property->country }}</td>
                            <td>${{ number_format($property->price, 2) }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- ১. ভিউ বাটন (ডিটেইলস পেজে নিয়ে যাবে) -->
                                    <a href="{{ route('customer.properties.details', $property->id) }}" class="btn btn-light btn-sm" title="View">
                                        <iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon>
                                    </a>
                                    
                                    <!-- ২. এডিট বাটন (এডিট পেজে নিয়ে যাবে) -->
                                    <a href="{{ route('property.edit', $property->id) }}" class="btn btn-soft-primary btn-sm" title="Edit">
                                        <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                                    </a>
                                    
                                    <!-- ৩. ডিলিট বাটন (নিরাপদ ফর্ম সাবমিশন) -->
                                    <form action="{{ route('property.delete', $property->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this property?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-soft-danger btn-sm" title="Delete">
                                            <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon>
                                        </button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">No properties found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- end table-responsive -->
            
            {{-- পেজিনেশন লিংক --}}
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    {{ $properties->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection