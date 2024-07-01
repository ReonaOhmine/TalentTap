@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Agent Profile</h1>
    <form action="{{ route('agent.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div>
            <label>Company Name:</label>
            <input type="text" name="company_name" value="{{ $agent->company_name }}" required>
        </div>
        <div>
            <label>Position:</label>
            <input type="text" name="position" value="{{ $agent->position }}" required>
        </div>
        <div>
            <label>Name:</label>
            <input type="text" name="name" value="{{ $agent->name }}" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ $agent->email }}" required>
        </div>
        <div>
            <label>Tel:</label>
            <input type="text" name="tel" value="{{ $agent->tel }}" required>
        </div>
        <div>
            <label>HP URL:</label>
            <input type="url" name="hp_url" value="{{ $agent->hp_url }}">
        </div>
        <div>
            <label>Logo Image:</label>
            <input type="file" name="logo_image">
            @if ($agent->logo_image)
                <img src="{{ asset('storage/' . $agent->logo_image) }}" alt="Company Logo" width="100">
            @endif
        </div>
        <button type="submit">Update Profile</button>
    </form>
</div>
@endsection
