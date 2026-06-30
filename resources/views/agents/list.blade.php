@extends('layouts.vertical', ['title' => 'Agent List', 'subTitle' => 'Real Estate'])

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="row justify-content-between">
                    <div class="col-lg-6">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <form class="app-search d-none d-md-block me-auto">
                                    <div class="position-relative">
                                        <input type="search" class="form-control" placeholder="Search Agent" autocomplete="off" value="">
                                        <iconify-icon icon="solar:magnifer-broken" class="search-widget-icon"></iconify-icon>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-4">
                                <h5 class="text-dark fw-medium mb-0">311 <span class="text-muted"> Agent</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-md-end mt-3 mt-md-0">
                            <button type="button" class="btn btn-outline-primary me-1"><i class="ri-settings-2-line me-1"></i>More Setting</button>
                            <button type="button" class="btn btn-outline-primary me-1"><i class="ri-filter-line me-1"></i> Filters</button>
                            <button type="button" class="btn btn-success me-1"><i class="ri-add-line"></i> New Agent</button>
                        </div>
                    </div><!-- end col-->
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
                    <h4 class="card-title">All Agent List</h4>
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
                                <th>Agent Photo & Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Experience</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($agents as $agent)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div>
                                            <img src="{{ $agent->photo ? asset($agent->photo) : '/images/users/avatar-2.jpg' }}" alt="" class="avatar-sm rounded-circle">
                                        </div>
                                        <div>
                                            <a href="{{ route('agents.details', ['id' => $agent->id]) }}" class="text-dark fw-medium fs-15">{{ $agent->name }}</a>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $agent->address ?? '-' }}</td>
                                <td>{{ $agent->email }}</td>
                                <td>{{ $agent->phone ?? '-' }}</td>
                                <td>{{ $agent->experience ?? '-' }}</td>
                                <td>{{ $agent->created_at->format('d M Y') }}</td>
                                <td><span class="badge bg-success-subtle text-success py-1 px-2 fs-13">{{ ucfirst($agent->status) }}</span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('agents.details', ['id' => $agent->id]) }}" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                        <form action="{{ route('agents.delete', $agent->id) }}" method="POST" onsubmit="return confirm('Delete this agent?');">
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
                                <td colspan="8" class="text-center py-4">No agents found.</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
            </div>
            <div class="card-footer">
                {{ $agents->links() }}
            </div>
        </div>
    </div>

</div>

@endsection