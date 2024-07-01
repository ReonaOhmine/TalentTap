@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Employer Profile</h1>
    <form action="{{ route('employer.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div>
            <label>Company Name:</label>
            <input type="text" name="company_name" value="{{ $employer->company_name }}" required>
        </div>
        <div>
            <label>Position:</label>
            <input type="text" name="position" value="{{ $employer->position }}" required>
        </div>
        <div>
            <label>Name:</label>
            <input type="text" name="name" value="{{ $employer->name }}" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ $employer->email }}" required>
        </div>
        <div>
            <label>Tel:</label>
            <input type="text" name="tel" value="{{ $employer->tel }}" required>
        </div>
        <div>
            <label>HP URL:</label>
            <input type="url" name="hp_url" value="{{ $employer->hp_url }}">
        </div>
        <div>
            <label>Logo Image:</label>
            <input type="file" name="logo_image">
            @if ($employer->logo_image)
                <img src="{{ asset('storage/' . $employer->logo_image) }}" alt="Company Logo" width="100">
            @endif
        </div>
        <button type="submit">Update Profile</button>
    </form>
</div>
@endsection
