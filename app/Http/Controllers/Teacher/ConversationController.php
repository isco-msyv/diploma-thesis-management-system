<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageStore;
use App\Mail\MessageReceived;
use App\Models\Conversation;
use Illuminate\Support\Facades\Mail;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::with(['student'])
            ->where('teacher_id', '=', auth()->user()->id)
            ->latest()
            ->get();

        return view('teacher.conversations.index', [
            'conversations' => $conversations
        ]);
    }

    public function edit(Conversation $conversation)
    {
        $conversation->load(['student', 'messages']);

        $conversations = Conversation::with(['student'])
            ->where('teacher_id', '=', auth()->user()->id)
            ->latest()
            ->get();

        return view('teacher.conversations.edit', [
            'conversations' => $conversations,
            'conversation' => $conversation
        ]);
    }

    public function update(MessageStore $request, Conversation $conversation)
    {
        $validated = $request->validated();

        $validated['from_id'] = auth()->user()->id;
        $validated['to_id'] = $conversation->student_id;

        $conversation->load(['student']);

        $conversation->messages()->create($validated);

        Mail::to($conversation->student->email)->send(new MessageReceived());

        return redirect()->back()->with(['toast-type' => 'success', 'message' => 'Message added!']);
    }
}
