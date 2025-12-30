{{-- @extends('master')
@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">

        <button onclick="openModal()"
            style="
                padding:10px 18px;
                background:#2563eb;
                color:#fff;
                border:none;
                border-radius:6px;
                cursor:pointer;
                font-weight:500;
            ">
            Add New Post
        </button>


        <div id="postModal"
            style="
            display:none;
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.6);
            justify-content:center;
            align-items:center;
            z-index:1000;
        ">
            <div
                style="
                background:#fff;
                padding:30px;
                width:600px;
                max-width:90%;
                border-radius:10px;
                position:relative;
            ">
                <h3>Add New Post</h3>

                <form action="{{ route('createpost') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="text" name="title" placeholder="Post title" required
                        style="width:100%; padding:8px; margin-bottom:10px;">

                    <textarea name="content" placeholder="Post content" required
                        style="width:100%; padding:8px; height:100px; margin-bottom:10px;"></textarea>

                    <input type="file" name="image" accept="image/*" style="width:100%; margin-bottom:10px;">

                    <div style="text-align:right; margin-top:15px;">
                        <button type="button" onclick="closeModal()">Cancel</button>
                        <button type="submit"
                            style="background:#2563eb; color:#fff; border:none; padding:8px 14px; border-radius:5px;">
                            Save
                        </button>
                    </div>
                </form>

                <span onclick="closeModal()"
                    style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:18px;">
                    &times;
                </span>
            </div>
        </div>


        <script>
            function openModal() {
                document.getElementById('postModal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('postModal').style.display = 'none';
            }
        </script>
    @endsection --}}


{{-- without the modal sheet --}}


@extends('master')

@section('content')
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">

        <h2 class="text-xl font-semibold mb-6">Add New Post</h2>

        <form method="POST" action="{{ route('createpost') }}" enctype="multipart/form-data">
            @csrf

            <div class="space-y-4">

                {{-- Title --}}
                <div>
                    <label class="block font-medium mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="w-full border px-4 py-2 rounded
                        focus:outline-none focus:ring focus:border-blue-400">

                    @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Content --}}
                <div>
                    <label class="block font-medium mb-1">Content</label>
                    <textarea name="content" rows="4"
                        class="w-full border px-4 py-2 rounded
                        focus:outline-none focus:ring focus:border-blue-400">{{ old('content') }}</textarea>

                    @error('content')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Image --}}
                <div>
                    <label class="block font-medium mb-1">Image</label>
                    <input type="file" name="image"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 bg-white">

                    @error('image')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label class="block font-medium mb-2">Status</label>

                    <div class="flex items-center gap-3">
                        <input type="checkbox" name="is_published" value="1"
                            class="h-5 w-5 text-blue-600 border-gray-300 rounded"
                            {{ old('is_published', 1) ? 'checked' : '' }}>
                        <span class="text-sm text-gray-700">Published</span>
                    </div>

                    @error('is_published')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
                        Submit
                    </button>
                </div>

            </div>
        </form>

    </div>
@endsection
