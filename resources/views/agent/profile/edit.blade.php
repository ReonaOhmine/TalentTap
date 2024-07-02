@extends('agent.layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="mb-4 border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-800">Edit Agent Profile</h1>
    </div>
    @if ($agent)
        <form action="{{ route('agent.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Company Name:</label>
                <input type="text" name="company_name" value="{{ $agent->company_name ?? '-' }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Position:</label>
                <input type="text" name="position" value="{{ $agent->position ?? '-' }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                <input type="text" name="name" value="{{ $agent->name ?? '-' }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" name="email" value="{{ $agent->email }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tel:</label>
                <input type="text" name="tel" value="{{ $agent->tel ?? '-' }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">HP URL:</label>
                <input type="url" name="hp_url" value="{{ $agent->hp_url ?? '-' }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Logo Image:</label>
                <input type="file" name="logo_image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-white">
                @if ($agent->logo_image)
                    <img src="{{ asset('storage/' . $agent->logo_image) }}" alt="Company Logo" class="mt-2 w-32 h-32 object-cover rounded-full">
                @endif
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update Profile</button>
        </form>
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
