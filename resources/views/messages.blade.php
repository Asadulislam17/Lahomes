@extends('layouts.vertical', ['title' => 'Messages', 'subTitle' => 'Real Estate'])

@section('content')

<div class="row">
    <!-- বাম পাশে কন্টাক্ট লিস্ট -->
    <div class="col-xl-3">
        <div class="card" style="height: 75vh;">
            <div class="card-header">
                <h4 class="card-title">Contacts</h4>
            </div>
            <div class="card-body p-0" style="overflow-y: auto;">
                <ul class="list-group list-group-flush">
                    @forelse ($contacts as $contact)
                        <a href="{{ route('messages.index', ['with' => $contact->id]) }}"
                           class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ $activeContact && $activeContact->id == $contact->id ? 'active' : '' }}">
                            <img src="/images/users/avatar-2.jpg" class="avatar-sm rounded-circle" alt="">
                            <div>
                                <p class="mb-0 fw-medium">{{ $contact->name }}</p>
                                <small class="text-muted">{{ ucfirst($contact->role) }}</small>
                            </div>
                        </a>
                    @empty
                        <li class="list-group-item">No contacts found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- ডান পাশে কথোপকথন -->
    <div class="col-xl-9">
        <div class="card" style="height: 75vh;">
            @if ($activeContact)
                <div class="card-header">
                    <h4 class="card-title">{{ $activeContact->name }}</h4>
                </div>

                <div class="card-body" style="overflow-y: auto;">
                    @forelse ($conversation as $msg)
                        <div class="d-flex mb-3 {{ $msg->sender_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                            <div class="p-2 px-3 rounded {{ $msg->sender_id == auth()->id() ? 'bg-primary text-white' : 'bg-light' }}" style="max-width: 60%;">
                                <p class="mb-1">{{ $msg->body }}</p>
                                <small class="{{ $msg->sender_id == auth()->id() ? 'text-white-50' : 'text-muted' }}">
                                    {{ $msg->created_at->format('d M, h:i A') }}
                                </small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center">No messages yet. Say hello!</p>
                    @endforelse
                </div>

                <div class="card-footer">
                    <form action="{{ route('messages.store') }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $activeContact->id }}">
                        <input type="text" name="body" class="form-control" placeholder="Type a message..." required>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            @else
                <div class="card-body d-flex align-items-center justify-content-center">
                    <p class="text-muted">Select a contact from the left to start chatting.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
