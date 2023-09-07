<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request)
    {
        Gate::authorize('create', Message::class);

        $message = Message::create([
            ...$request->validated(),
            'author_id' => Auth::id(),
        ]);

        // dd($message);

        MessageSent::dispatch($message);

        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        Gate::authorize('update', $message);

        $attributes = $request->validate([
            'body' => ['required', 'string']
        ]);

        $message->update($attributes);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        Gate::authorize('delete', $message);

        $message->delete();
        return back();
    }
}
