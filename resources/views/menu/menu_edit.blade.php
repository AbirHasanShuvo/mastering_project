@extends('master')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <form method="POST" action="{{ route('editedMenu', $currentMenu->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Laravel treats this as PUT -->
        <input type="hidden" name="id" value="{{ $currentMenu->id }}">

        <div class="space-y-4">

            {{-- Title --}}
            <div>
                <label class="block font-medium mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title', $currentMenu->title) }}"
                    class="w-full border px-4 py-2 rounded focus:outline-none focus:ring focus:border-blue-400">
                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- URL --}}
            <div>
                <label class="block font-medium mb-1">URL</label>
                <input type="text" name="url" value="{{ old('url', $currentMenu->url) }}"
                    class="w-full border px-4 py-2 rounded focus:outline-none focus:ring focus:border-blue-400">
                @error('url')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submenu --}}
            <div>
                <label class="block font-medium mb-1">Create as Submenu</label>
                <select name="parent_id"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                    <option value="">— Select Parent Menu —</option>
                    @foreach ($menus as $res)
                        <option value="{{ $res->id }}" {{ old('parent_id', $currentMenu->parent_id) == $res->id ? 'selected' : '' }}>
                            {{ $res->title }}
                        </option>
                    @endforeach
                </select>
                @error('parent_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Order --}}
            <div>
                <label class="block font-medium mb-1">Order</label>
                <input type="text" name="order" value="{{ old('order', $currentMenu->order) }}"
                    class="w-full border px-4 py-2 rounded focus:outline-none focus:ring focus:border-blue-400">
                @error('order')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div>
                <label class="block font-medium mb-2">Status</label>
                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $currentMenu->is_active) ? 'checked' : '' }}
                        class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <span class="text-sm text-gray-700">Active</span>
                </div>
                @error('is_active')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
                    Update
                </button>
            </div>

        </div>
    </form>
</div>
@endsection
