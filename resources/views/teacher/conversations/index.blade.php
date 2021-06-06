@extends('layout')

@section('title', 'Conversations | All')

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
                            @foreach($conversations as $conversation)
                                <li>
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
                    <!-- app chat window start -->
                    <section class="chat-window-wrapper">
                        <div class="chat-start">
                            <span class="bx bx-message chat-sidebar-toggle chat-start-icon font-large-3 p-3 mb-1"></span>
                            <h4 class="d-none d-lg-block py-50 text-bold-500">Select a contact to start a chat!</h4>
                        </div>
                    </section>
                    <!-- app chat window ends -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script type="text/javascript" src="{{ asset('frest/app-assets/js/scripts/pages/app-chat.min.js') }}"></script>
@endsection
