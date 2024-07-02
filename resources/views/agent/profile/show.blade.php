@extends('agent.layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="mb-4 border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-800">Agent Profile</h1>
    </div>
    @if ($agent)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-gray-600"><strong>Company Name:</strong> {{ $agent->company_name ?? '-' }}</p>
                <p class="text-gray-600"><strong>Position:</strong> {{ $agent->position ?? '-' }}</p>
                <p class="text-gray-600"><strong>Name:</strong> {{ $agent->name ?? '-' }}</p>
                <p class="text-gray-600"><strong>Email:</strong> {{ $agent->email }}</p>
                <p class="text-gray-600"><strong>Tel:</strong> {{ $agent->tel ?? '-' }}</p>
                <p class="text-gray-600"><strong>HP URL:</strong> <a href="{{ $agent->hp_url ?? '#' }}" class="text-blue-600">{{ $agent->hp_url ?? '-' }}</a></p>
            </div>
            <div class="flex items-center justify-center">
                @if ($agent->logo_image)
                    <img src="{{ asset('storage/' . $agent->logo_image) }}" alt="Company Logo" class="w-32 h-32 object-cover rounded-full">
                @else
                    <div class="w-32 h-32 bg-gray-200 flex items-center justify-center rounded-full">
                        <span class="text-gray-500">No Logo</span>
                    </div>
                @endif
            </div>
        </div>
        <div class="mt-6 flex justify-center">
            <a href="{{ route('agent.profile.edit') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Edit Profile</a>
        </div>
    @else
        <p class="text-gray-600">No agent data available. Please log in.</p>
    @endif
</div>
@endsection

<style>
    body {
        background-color: white;
    }
</style>
