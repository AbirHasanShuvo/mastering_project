@extends('master')
@section('content')
    <div style="max-width:900px; margin:auto;">

        @php
            $posts = \App\Models\Post::where('is_published', 1)->latest()->get();
        @endphp

        @forelse ($posts as $post)
            <div
                style="
            background:#ffffff;
            border-radius:12px;
            padding:20px;
            margin-bottom:20px;
            box-shadow:0 10px 25px rgba(0,0,0,0.06);
            display:flex;
            gap:20px;
        ">

                {{-- Content --}}
                <div style="flex:1;">
                    <h3 style="margin:0 0 8px; font-size:20px; color:#111827;">
                        {{ $post->title }}
                    </h3>

                    <small style="color:#6b7280;">
                        {{ $post->created_at->format('d M Y') }}
                    </small>

                    @if ($post->image)
                        <div style="margin:12px 0;">
                            <img src="{{ asset('storage/' . $post->image) }}"
                                style="
                                width:100%;
                                max-width:250px;
                                height:200px;
                                object-fit:cover;
                                border-radius:10px;
                            ">
                        </div>
                    @endif

                    <p style="color:#374151; line-height:1.6; margin-top:10px;">
                        {{ Str::limit($post->content, 180) }}
                    </p>
                </div>

                {{-- Actions --}}
                <div
                    style="
                display:flex;
                flex-direction:column;
                gap:10px;
                justify-content:flex-start;
            ">
                    {{-- <a href=""
                        style="
                        padding:8px 14px;
                        background:#fbbf24;
                        color:#111827;
                        text-decoration:none;
                        border-radius:8px;
                        font-weight:500;
                        text-align:center;
                    ">
                        ✏️ Edit
                    </a> --}}

                    <a href="javascript:void(0)"
                        onclick="openEditModal(
        {{ $post->id }},
        '{{ addslashes($post->title) }}',
        '{{ addslashes($post->content) }}',
        '{{ $post->image ? asset('storage/' . $post->image) : '' }}'
   )"
                        style="
        padding:8px 14px;
        background:#fbbf24;
        color:#111827;
        text-decoration:none;
        border-radius:8px;
        font-weight:500;
        text-align:center;
   ">
                        ✏️ Edit
                    </a>


                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            style="
                            padding:8px 14px;
                            background:#ef4444;
                            color:white;
                            border:none;
                            border-radius:8px;
                            cursor:pointer;
                            font-weight:500;
                        "
                            onclick="return confirm('Are you sure?')">
                            🗑 Delete
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <p style="text-align:center; color:#6b7280;">No posts found.</p>
        @endforelse
    </div>





    <div id="editModal"
        style="
        display:none;
        position:fixed;
        inset:0;
        background:rgba(0,0,0,0.4);
        justify-content:center;
        align-items:center;
        z-index:999;
     ">

        <div style="
        background:#fff;
        width:500px;
        border-radius:12px;
        padding:20px;
    ">
            <h3 style="margin-bottom:15px;">Edit Post</h3>

            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <input type="text" name="title" id="editTitle" style="width:100%; padding:10px; margin-bottom:10px;"
                    placeholder="Title">

                {{-- Content --}}
                <textarea name="content" id="editContent" style="width:100%; padding:10px; height:120px; margin-bottom:10px;"
                    placeholder="Content"></textarea>

                {{-- Current Image Preview --}}
                <div id="imagePreviewBox" style="margin-bottom:10px; display:none;">
                    <img id="editImagePreview" style="width:100%; max-height:180px; object-fit:cover; border-radius:8px;">
                </div>

                {{-- Update Image --}}
                <input type="file" name="image" accept="image/*" style="margin-bottom:15px;">

                <div style="display:flex; gap:10px; justify-content:flex-end;">
                    <button type="button" onclick="closeEditModal()" style="padding:8px 14px;">
                        Cancel
                    </button>

                    <button type="submit" style="padding:8px 14px; background:#2563eb; color:white; border:none;">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, title, content, imageUrl) {
            document.getElementById('editModal').style.display = 'flex';

            document.getElementById('editTitle').value = title;
            document.getElementById('editContent').value = content;

            const previewBox = document.getElementById('imagePreviewBox');
            const previewImg = document.getElementById('editImagePreview');

            if (imageUrl) {
                previewBox.style.display = 'block';
                previewImg.src = imageUrl;
            } else {
                previewBox.style.display = 'none';
                previewImg.src = '';
            }

            document.getElementById('editForm').action = `/posts/${id}`;
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
@endsection
