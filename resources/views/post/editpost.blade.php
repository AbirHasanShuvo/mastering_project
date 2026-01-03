<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Title -->
    <label style="font-size:14px; font-weight:500; display:block; margin-bottom:6px;">
        Post Title
    </label>
    <input type="text" name="title" placeholder="Enter post title" required value="{{ $post->title }}"
        style="
            width:100%;
            padding:10px 12px;
            margin-bottom:14px;
            border:1px solid #d1d5db;
            border-radius:8px;
            outline:none;
            font-size:14px;
        " />

    <!-- Content -->
    <label style="font-size:14px; font-weight:500; display:block; margin-bottom:6px;">
        Post Content
    </label>
    <textarea name="content" placeholder="Write your content here..." required
        style="
            width:100%;
            padding:10px 12px;
            height:120px;
            margin-bottom:14px;
            border:1px solid #d1d5db;
            border-radius:8px;
            outline:none;
            resize:none;
            font-size:14px;
        ">{{ $post->content }}</textarea>

    <!-- Image -->
    <label style="font-size:14px; font-weight:500; display:block; margin-bottom:6px;">
        Post Image
    </label>
    <input type="file" name="image" accept="image/*"
        style="
            width:100%;
            padding:8px;
            border:1px dashed #d1d5db;
            border-radius:8px;
            margin-bottom:20px;
            font-size:14px;
        " />
    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
        style="max-width:100px; display:block; margin-top:10px;" />

    {{-- <!-- Image -->
    <label style="font-size:14px; font-weight:500; display:block; margin-bottom:6px;">
        Post Image
    </label>
    <input type="file" name="image" accept="image/*"
        style="
            width:100%;
            padding:8px;
            border:1px dashed #d1d5db;
            border-radius:8px;
            margin-bottom:20px;
            font-size:14px;
        " /> --}}



    <div style="display:flex; justify-content:flex-end; gap:10px;">
        <!-- Submit button (left position) -->
        <button type="submit"
            style="
            padding:8px 16px;
            background:#2563eb;
            color:#fff;
            border:none;
            border-radius:6px;
            cursor:pointer;
            font-weight:500;
        ">
            Save
        </button>

        <!-- Cancel button (right position) -->
        <button type="button" onclick="closeEditModal()"
            style="
            padding:8px 14px;
            background:#f3f4f6;
            border:1px solid #d1d5db;
            border-radius:6px;
            cursor:pointer;
        ">
            Cancel
        </button>
    </div>

</form>
