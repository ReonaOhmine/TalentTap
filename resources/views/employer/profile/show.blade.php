@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employer Profile</h1>
    <p>Company Name: {{ $employer->company_name }}</p>
    <p>Position: {{ $employer->position }}</p>
    <p>Name: {{ $employer->name }}</p>
    <p>Email: {{ $employer->email }}</p>
    <p>Tel: {{ $employer->tel }}</p>
    <p>HP URL: {{ $employer->hp_url }}</p>
    @if ($employer->logo_image)
        <img src="{{ asset('storage/' . $employer->logo_image) }}" alt="Company Logo" width="100">
    @endif
    <a href="{{ route('employer.profile.edit') }}">Edit Profile</a>
</div>
@endsection
