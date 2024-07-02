@extends('employer.layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="mb-4 border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-800">Employer Profile</h1>
    </div>
    @if ($employer)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-gray-600"><strong>Company Name:</strong> {{ $employer->company_name ?? '-' }}</p>
                <p class="text-gray-600"><strong>Position:</strong> {{ $employer->position ?? '-' }}</p>
                <p class="text-gray-600"><strong>Name:</strong> {{ $employer->name ?? '-' }}</p>
                <p class="text-gray-600"><strong>Email:</strong> {{ $employer->email }}</p>
                <p class="text-gray-600"><strong>Tel:</strong> {{ $employer->tel ?? '-' }}</p>
                <p class="text-gray-600"><strong>HP URL:</strong> <a href="{{ $employer->hp_url ?? '#' }}" class="text-blue-600">{{ $employer->hp_url ?? '-' }}</a></p>
            </div>
            <div class="flex items-center justify-center">
                @if ($employer->logo_image)
                    <img src="{{ asset('storage/' . $employer->logo_image) }}" alt="Company Logo" class="w-32 h-32 object-cover rounded-full">
                @else
                    <div class="w-32 h-32 bg-gray-200 flex items-center justify-center rounded-full">
                        <span class="text-gray-500">No Logo</span>
                    </div>
                @endif
            </div>
        </div>
        <div class="mt-6 flex justify-center">
            <a href="{{ route('employer.profile.edit') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Edit Profile</a>
        </div>
    @else
        <p class="text-gray-600">No employer data available. Please log in.</p>
    @endif
</div>
@endsection

<style>
    body {
        background-color: white;
    }
</style>
