@extends('employer.layouts.app')

@section('content')
<div class="container">
    <h1>メッセージ</h1>
    <div class="mb-3">
        <form action="{{ route('employer.messages.send') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="receiver_id">宛先</label>
                <select name="receiver_id" id="receiver_id" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->company_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="message">メッセージ</label>
                <textarea name="message" id="message" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">送信</button>
        </form>
    </div>

    <div class="messages">
        @foreach($messages as $message)
            <div class="message">
                <strong>{{ $message->sender->company_name ?? $message->sender->name }}から{{ $message->receiver->company_name ?? $message->receiver->name }}へ:</strong>
                <p>{{ $message->message }}</p>
                <small>{{ $message->created_at->format('Y-m-d H:i') }}</small>
            </div>
        @endforeach
    </div>
</div>
@endsection
