<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Agent;
use App\Models\EmployerUser;
use Pusher\Pusher;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:agent,employer');
    }

    public function agentIndex(Request $request)
    {
        $user = auth()->guard('agent')->user();
        $receiver_id = $request->get('receiver_id');

        $messages = Message::where(function ($query) use ($user, $receiver_id) {
            $query->where('sender_id', $user->id)
                ->where('sender_type', Agent::class)
                ->where('receiver_id', $receiver_id)
                ->where('receiver_type', EmployerUser::class);
        })->orWhere(function ($query) use ($user, $receiver_id) {
            $query->where('receiver_id', $user->id)
                ->where('receiver_type', Agent::class)
                ->where('sender_id', $receiver_id)
                ->where('sender_type', EmployerUser::class);
        })->get();

        $users = EmployerUser::all();
        return view('agent.messages', compact('messages', 'users'));
    }

    public function employerIndex(Request $request)
    {
        $user = auth()->guard('employer')->user();
        $receiver_id = $request->get('receiver_id');

        $messages = Message::where(function ($query) use ($user, $receiver_id) {
            $query->where('sender_id', $user->id)
                ->where('sender_type', EmployerUser::class)
                ->where('receiver_id', $receiver_id)
                ->where('receiver_type', Agent::class);
        })->orWhere(function ($query) use ($user, $receiver_id) {
            $query->where('receiver_id', $user->id)
                ->where('receiver_type', EmployerUser::class)
                ->where('sender_id', $receiver_id)
                ->where('sender_type', Agent::class);
        })->get();

        $users = Agent::all();
        return view('employer.messages', compact('messages', 'users'));
    }

    public function agentSendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required',
            'message' => 'required|string',
        ]);

        $user = auth()->guard('agent')->user();
        $receiver = EmployerUser::findOrFail($request->receiver_id);

        $message = Message::create([
            'sender_id' => $user->id,
            'sender_type' => Agent::class,
            'receiver_id' => $receiver->id,
            'receiver_type' => EmployerUser::class,
            'message' => $request->message,
        ]);

        $this->broadcastMessage($message);

        return redirect()->route('agent.messages.index', ['receiver_id' => $receiver->id]);
    }

    public function employerSendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required',
            'message' => 'required|string',
        ]);

        $user = auth()->guard('employer')->user();
        $receiver = Agent::findOrFail($request->receiver_id);

        $message = Message::create([
            'sender_id' => $user->id,
            'sender_type' => EmployerUser::class,
            'receiver_id' => $receiver->id,
            'receiver_type' => Agent::class,
            'message' => $request->message,
        ]);

        $this->broadcastMessage($message);

        return redirect()->route('employer.messages.index', ['receiver_id' => $receiver->id]);
    }

    protected function broadcastMessage($message)
    {
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            ['cluster' => env('PUSHER_APP_CLUSTER')]
        );

        $pusher->trigger('chat', 'message', $message);
    }
}
