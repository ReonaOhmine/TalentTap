@extends('agent.layouts.app')

@section('content')
<div class="flex h-screen">
    <!-- 左側の送信先一覧 -->
    <div class="w-1/3 border-r border-gray-300 p-4 overflow-y-auto">
        <h2 class="text-lg font-semibold mb-4">送信先一覧</h2>
        <ul>
            @foreach($users as $user)
                <li class="mb-2">
                    <a href="{{ route('agent.messages.index', ['receiver_id' => $user->id]) }}" class="block p-2 bg-gray-100 rounded hover:bg-gray-200">
                        {{ $user->company_name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- 右側のチャット画面 -->
    <div class="w-2/3 p-4 flex flex-col justify-between">
        <div class="overflow-y-auto flex flex-col space-y-4">
            <h2 class="text-lg font-semibold mb-4">メッセージ</h2>
            @foreach($messages as $message)
                <div class="flex {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="{{ $message->sender_id == auth()->id() ? 'bg-blue-200' : 'bg-gray-200' }} p-2 rounded-lg max-w-xs">
                        <p>{{ $message->message }}</p>
                        <small>{{ $message->created_at->format('Y-m-d H:i') }}</small>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <form action="{{ route('agent.messages.send') }}" method="POST">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ request('receiver_id') }}">
                <div class="flex">
                    <textarea name="message" class="w-full p-2 border border-gray-300 rounded-lg" rows="2" placeholder="メッセージを入力"></textarea>
                    <button type="submit" class="ml-2 p-2 bg-blue-500 text-white rounded-lg">送信</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
