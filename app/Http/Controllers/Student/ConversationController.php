<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageStore;
use App\Mail\MessageReceived;
use App\Models\Conversation;
use Illuminate\Support\Facades\Mail;

class ConversationController extends Controller
{
    public function edit()
    {
        $conversation = Conversation::with(['teacher', 'messages'])->where('student_id', '=', auth()->user()->id)->firstOrFail();

        return view('student.conversation.edit', [
            'conversation' => $conversation
        ]);
    }

    public function update(MessageStore $request)
    {
        $conversation = Conversation::where('student_id', '=', auth()->user()->id)->firstOrFail();

        $validated = $request->validated();

        $validated['from_id'] = auth()->user()->id;
        $validated['to_id'] = $conversation->teacher_id;

        $conversation->load(['teacher']);

        $conversation->messages()->create($validated);

        Mail::to($conversation->teacher->email)->send(new MessageReceived());

        return redirect()->back()->with(['toast-type' => 'success', 'message' => 'Message added!']);
    }
}
