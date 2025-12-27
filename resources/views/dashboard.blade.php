{{-- @extends('master')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1>this is the dashboard page</h1>

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
    </div>


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

            <form>
                <input type="text" placeholder="Post title" style="width:100%; padding:8px; margin-bottom:10px;">

                <textarea placeholder="Post content" style="width:100%; padding:8px; height:100px;"></textarea>



                <div style="text-align:right; margin-top:15px;">
                    <button type="button" onclick="closeModal()">Cancel</button>
                    <button type="submit"
                        style="background:#2563eb; color:#fff; border:none; padding:8px 14px; border-radius:5px;">
                        Save
                    </button>
                </div>
            </form>

            <span onclick="closeModal()"
                style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:18px;">&times;</span>
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



@extends('master')

@section('content')
    {{-- Header --}}
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h1>Dashboard</h1>

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
    </div>

    {{-- Posts List --}}
    <div>
        @php
            $posts = \App\Models\Post::latest()->get();
        @endphp
        @forelse ($posts as $post)
            <div
                style="
                    border:1px solid #ddd;
                    border-radius:8px;
                    padding:15px;
                    margin-bottom:15px;
                    background:#fff;
                    display:flex;
                    justify-content:space-between;
                    align-items:flex-start;
                ">
                <div style="flex:1;">
                    <h3>{{ $post->title }}</h3>

                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}"
                            style="width:150 px; max-height:250px; object-fit:cover; border-radius:6px; margin:10px 0;">
                    @endif

                    <p>{{ $post->content }}</p>

                    <small style="color:#666;">
                        Posted on {{ $post->created_at->format('d M Y') }}
                    </small>
                </div>


                <div style="margin-left:15px; display:flex; flex-direction:column; gap:5px;">
                    <a href=""
                        style="padding:6px 12px; background:#facc15; color:#000; text-decoration:none; border-radius:5px; text-align:center;">
                        Edit
                    </a>

                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            style="padding:6px 12px; background:#ef4444; color:#fff; border:none; border-radius:5px; cursor:pointer;">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p>No posts found.</p>
        @endforelse
    </div>

    {{-- Modal --}}
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

            <span onclick="closeModal()" style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:18px;">
                &times;
            </span>
        </div>
    </div>

    {{-- Scripts --}}
    <script>
        function openModal() {
            document.getElementById('postModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('postModal').style.display = 'none';
        }
    </script>
@endsection
