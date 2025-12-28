@extends('master')
@section('content')
    <div style="max-width:900px; margin:auto;">

        {{-- @php
            $posts = \App\Models\Post::where('is_published', 1)->latest()->get();
        @endphp --}}

        <div style="max-width:1000px; margin:auto;">

            <table
                style="
        width:100%;
        border-collapse:collapse;
        background:#ffffff;
        border-radius:12px;
        overflow:hidden;
        box-shadow:0 10px 25px rgba(0,0,0,0.06);
    ">
                <thead style="background:#f3f4f6;">
                    <tr>
                        <th style="padding:12px; text-align:left;">#</th>
                        <th style="padding:12px; text-align:left;">Image</th>
                        <th style="padding:12px; text-align:left;">Title</th>
                        <th style="padding:12px; text-align:left;">Content</th>
                        <th style="padding:12px; text-align:left;">Date</th>
                        <th style="padding:12px; text-align:center;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($posts as $post)
                        <tr style="border-top:1px solid #e5e7eb;">
                            <td style="padding:12px;">{{ $loop->iteration }}</td>

                            <td style="padding:12px;">
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}"
                                        style="width:70px; height:50px; object-fit:cover; border-radius:6px;">
                                @else
                                    <span style="color:#9ca3af;">No Image</span>
                                @endif
                            </td>

                            <td style="padding:12px; font-weight:500;">
                                {{ $post->title }}
                            </td>

                            <td style="padding:12px; color:#374151;">
                                {{ Str::limit($post->content, 60) }}
                            </td>

                            <td style="padding:12px; color:#6b7280;">
                                {{ $post->created_at->format('d M Y') }}
                            </td>

                            <td style="padding:12px; text-align:center;">
                                <div style="display:flex; gap:6px; justify-content:center;">

                                    <a href="javascript:void(0)"
                                        onclick="openEditModal(
                                    {{ $post->id }},
                                    '{{ addslashes($post->title) }}',
                                    '{{ addslashes($post->content) }}',
                                    '{{ $post->image ? asset('storage/' . $post->image) : '' }}'
                                )"
                                        style="
                                    padding:6px 10px;
                                    background:#fbbf24;
                                    border-radius:6px;
                                    text-decoration:none;
                                    color:#111827;
                                ">
                                        ✏️
                                    </a>

                                    <form action="" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                            style="
                                        padding:6px 10px;
                                        background:#ef4444;
                                        color:white;
                                        border:none;
                                        border-radius:6px;
                                        cursor:pointer;
                                    ">
                                            🗑
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding:20px; text-align:center; color:#6b7280;">
                                No posts found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

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
