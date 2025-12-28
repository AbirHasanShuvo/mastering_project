@extends('master')
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

                <span onclick="closeModal()"
                    style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:18px;">
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
