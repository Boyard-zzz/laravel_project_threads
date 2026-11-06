<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function show(Topic $topic)
    {
        $topic->load(['user', 'thread', 'replies.user']);

        return view('topics.show', compact('topic'));
    }

    public function create(Thread $thread)
    {
        return view('topics.create', compact('thread'));
    }


    public function edit(Topic $topic)
{
    abort_unless($topic->user_id === auth()->id() || auth()->user()->isAdmin(), 403);

    return view('topics.edit', compact('topic'));
}

public function update(Request $request, Topic $topic)
{
    abort_unless($topic->user_id === auth()->id() || auth()->user()->isAdmin(), 403);

    $data = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'body' => ['required', 'string'],
    ]);

    $topic->update($data);

    return redirect()->route('topics.show', $topic);
}


    public function store(Request $request, Thread $thread)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
        ]);

        $topic = $thread->topics()->create([
            'user_id' => auth()->id(),
            'title' => $data['title'],
            'body' => $data['body'],
        ]);

        return redirect()->route('topics.show', $topic);
    }

        public function destroy(Topic $topic)
    {
        $threadId = $topic->thread_id;
        $topic->delete();

        return redirect()->route('threads.show', $threadId);
    }



}