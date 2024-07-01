@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agent Profile</h1>
    <p>Company Name: {{ $agent->company_name }}</p>
    <p>Position: {{ $agent->position }}</p>
    <p>Name: {{ $agent->name }}</p>
    <p>Email: {{ $agent->email }}</p>
    <p>Tel: {{ $agent->tel }}</p>
    <p>HP URL: {{ $agent->hp_url }}</p>
    @if ($agent->logo_image)
        <img src="{{ asset('storage/' . $agent->logo_image) }}" alt="Company Logo" width="100">
    @endif
    <a href="{{ route('agent.profile.edit') }}">Edit Profile</a>
</div>
@endsection
