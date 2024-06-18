<?php
// app/Http/Controllers/MessagesController.php
namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|exists:agents,id',
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $request->to_user_id,
            'message' => $request->message,
        ]);

        return response()->json($message, 201);
    }

    public function getMessages(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|exists:agents,id',
        ]);

        $messages = Message::where(function ($query) use ($request) {
            $query->where('from_user_id', Auth::id())
                ->where('to_user_id', $request->to_user_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('from_user_id', $request->to_user_id)
                ->where('to_user_id', Auth::id());
        })->get();

        return response()->json($messages);
    }
}
