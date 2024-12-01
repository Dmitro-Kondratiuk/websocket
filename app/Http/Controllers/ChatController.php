<?php

namespace App\Http\Controllers;

use App\Data\CreateChatData;
use App\Data\SendMessageData;
use App\Events\MessageSent;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Відображення всіх чатів користувача.
     */
    public function index()
    {
        $chats = Auth::user()->chats()->with('users')->get();
        return view('chat.index', compact('chats'));
    }


    public function store(CreateChatData $request)
    {
        $userId = $request->user_id;
        $existingChat = Chat::where('type', 'private')
            ->whereHas('users', function ($query) use ($userId) {
                $query->whereIn('user_id', [Auth::id(), $userId]);
            }, '=', 2)
            ->first();

        if ($existingChat) {
            return redirect()->route('chat.show', $existingChat->id);
        }

        $chat = Chat::create(['type' => 'private']);
        $chat->users()->attach([Auth::id(), $userId]);

        return redirect()->route('chat.show', $chat->id);
    }

    public function show(Chat $chat)
    {
        $this->authorize('view', $chat);

        $messages = $chat->messages()->with('user')->get();
        return view('chat.show', compact('chat', 'messages'));
    }

    public function sendMessage(SendMessageData $request, Chat $chat)
    {
        $message = $chat->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();
        return response()->json($message);
    }
}
