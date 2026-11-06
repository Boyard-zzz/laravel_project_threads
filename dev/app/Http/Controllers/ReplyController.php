<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Topic;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Topic $topic)
    {
        $data = $request->validate(['body' => ['required', 'string']]);

        $topic->replies()->create([
            'user_id' => auth()->id(),
            'body' => $data['body'],
        ]);

        return redirect()->route('topics.show', $topic);
    }

    public function edit(Reply $reply)
    {
        abort_unless($reply->user_id === auth()->id() || auth()->user()->isAdmin(), 403);

        return view('replies.edit', compact('reply'));
    }

    public function update(Request $request, Reply $reply)
    {
        abort_unless($reply->user_id === auth()->id() || auth()->user()->isAdmin(), 403);

        $data = $request->validate(['body' => ['required', 'string']]);
        $reply->update($data);

        return redirect()->route('topics.show', $reply->topic_id);
    }

    public function destroy(Reply $reply)
    {
        $topicId = $reply->topic_id;
        $reply->delete();

        return redirect()->route('topics.show', $topicId);
    }
}