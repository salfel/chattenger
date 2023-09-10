<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $chats = $user->chats()
            ->with(['messages.author', 'user' => function(HasOneThrough $query) use($user) {
                $query->whereNot('users.id', $user->id);
            }])
            ->get();

        return Inertia::render('Chats/Index', [
            'chats' => $chats
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        $user = Auth::user();
        $chat = $user->chats()
            ->where('chats.id', $chat->id)
            ->with(['messages.author', 'user' => function(HasOneThrough $query) use($user) {
                $query->whereNot('users.id', $user->id);
            }])
            ->first();

        // dd($chat->toArray());

        return Inertia::render('Chats/Show', [
            'chat' => $chat
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
