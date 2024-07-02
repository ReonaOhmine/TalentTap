@extends('employer.layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="mb-4 border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-800">Edit Employer Profile</h1>
    </div>
    @if ($employer)
        <form action="{{ route('employer.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-gray-700 font-bold mb-2">Company Name:</label>
                <input type="text" name="company_name" value="{{ $employer->company_name ?? '-' }}" required class="w-full p-2 border border-gray-300 rounded-lg bg-white">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Position:</label>
                <input type="text" name="position" value="{{ $employer->position ?? '-' }}" required class="w-full p-2 border border-gray-300 rounded-lg bg-white">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Name:</label>
                <input type="text" name="name" value="{{ $employer->name ?? '-' }}" required class="w-full p-2 border border-gray-300 rounded-lg bg-white">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Email:</label>
                <input type="email" name="email" value="{{ $employer->email }}" required class="w-full p-2 border border-gray-300 rounded-lg bg-white">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Tel:</label>
                <input type="text" name="tel" value="{{ $employer->tel ?? '-' }}" required class="w-full p-2 border border-gray-300 rounded-lg bg-white">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">HP URL:</label>
                <input type="url" name="hp_url" value="{{ $employer->hp_url ?? '-' }}" class="w-full p-2 border border-gray-300 rounded-lg bg-white">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Logo Image:</label>
                <input type="file" name="logo_image" class="block w-full text-gray-700 p-2 border border-gray-300 rounded-lg bg-white">
                @if ($employer->logo_image)
                    <img src="{{ asset('storage/' . $employer->logo_image) }}" alt="Company Logo" class="mt-2 w-32 h-32 object-cover rounded-full">
                @endif
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update Profile</button>
        </form>
    @else
        <p class="text-gray-600">No employer data available. Please log in.</p>
    @endif
</div>
@endsection
