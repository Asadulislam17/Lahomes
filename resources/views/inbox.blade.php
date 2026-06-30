@extends('layouts.vertical', ['title' => 'Inbox', 'subTitle' => 'Real Estate'])

@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Your Inbox</h4>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse ($messages as $message)
                        <a href="{{ route('messages.index', ['with' => $message->sender_id]) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center gap-3">
                            <img src="/images/users/avatar-2.jpg" class="avatar-sm rounded-circle" alt="">
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-medium">{{ $message->sender->name ?? 'Unknown' }}</p>
                                <p class="mb-0 text-muted text-truncate" style="max-width: 500px;">{{ $message->body }}</p>
                            </div>
                            <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                        </a>
                    @empty
                        <li class="list-group-item text-center py-4">Your inbox is empty.</li>
                    @endforelse
                </ul>
            </div>
            <div class="card-footer">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
