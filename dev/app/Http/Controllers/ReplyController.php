<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Topic $topic)
    {
        $data = $request->validate([
            'body' => ['required', 'string'],
        ]);

        $topic->replies()->create([
            'user_id' => auth()->id(),
            'body' => $data['body'],
        ]);

        return redirect()->route('topics.show', $topic);
    }
}