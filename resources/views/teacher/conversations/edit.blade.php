@extends('layout')

@section('title', 'Conversations | Edit')

@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('frest/app-assets/css/pages/app-chat.min.css') }}">
@endsection

@section('content')
    <div class="content-area-wrapper">
        <div class="sidebar-left">
            <div class="sidebar">
                <!-- app chat sidebar start -->
                <div class="chat-sidebar card">
                    <div class="chat-sidebar-search">
                        <h5 class="px-2 pt-2 pb-25 mb-0">CONVERSATIONS</h5>
                    </div>
                    <div class="chat-sidebar-list-wrapper pt-2 ps ps--active-y">
                        <ul class="chat-sidebar-list">
                            @foreach($conversations as $conversationLoop)
                                <li class="@if($conversation->id == $conversationLoop->id) active @endif">
                                    <a href="{{ route('teacher.conversations.edit', $conversation) }}">
                                        <div class="d-flex align-items-center">
                                            <div class="chat-sidebar-name">
                                                <h6 class="mb-0">
                                                    {{ $conversation->student->full_name }}
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- app chat sidebar ends -->
            </div>
        </div>
        <div class="content-right">
            <div class="content-overlay"></div>
            <div class="content-wrapper">
                <div class="content-header row"></div>
                <div class="content-body">
                    <section class="chat-window-wrapper">
                        <div class="chat-area">
                            <div class="chat-header">
                                <header class="d-flex justify-content-between align-items-center border-bottom px-1 py-2">
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0">
                                            {{ $conversation->student->full_name }}
                                        </h6>
                                    </div>
                                </header>
                            </div>
                            <!-- chat card start -->
                            <div class="card chat-wrapper shadow-none">
                                <div class="card-body chat-container ps ps--active-y">
                                    <div class="chat-content">
                                        @foreach($conversation->messages as $message)
                                            <div class="chat @if($message->from_id !== auth()->user()->id) chat-left @endif">
                                                <div class="chat-body">
                                                    <div class="chat-message">
                                                        <p>{{ $message->text }}</p>
                                                        <span class="chat-time">{{ $message->created_at }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer chat-footer border-top px-2 pt-1 pb-0 mb-1">
                                    <form class="d-flex align-items-center" method="POST" action="{{ route('teacher.conversations.update', $conversation) }}">
                                        @method('PUT')
                                        @csrf
                                        <input class="form-control chat-message-send mx-1"
                                               type="text"
                                               name="text"
                                               placeholder="Type your message here...">
                                        <button type="submit" class="btn btn-primary glow send d-lg-flex">
                                            <i class="bx bx-paper-plane"></i>
                                            <span class="d-none d-lg-block ml-1">Send</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!-- chat card ends -->
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script type="text/javascript" src="{{ asset('frest/app-assets/js/scripts/pages/app-chat.min.js') }}"></script>
@endsection
