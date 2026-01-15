@extends('master')

@section('content')
    <!-- Header -->

    <div
        style="
        max-width:1100px;
        margin:20px auto;
        display:flex;
        justify-content:flex-end;
        align-items:center;
    ">

   <a href = {{ asset('demo/demo.csv') }}
    style="
        padding:10px 18px;
        background:#facc15; /* yellow */
        color:#fff;
        border:none;
        border-radius:6px;
        cursor:pointer;
        font-weight:500;
        margin-right:12px;
    ">
    Demo CSV
</a>

        <button onclick="openCreateModal()"
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

    <div
        style="
        max-width:1100px;
        margin: 0 auto 20px;
        display:flex;
        align-items:center;
        justify-content:space-between;
        padding:10px 15px;
        background:#f3f4f6;
        border-radius:8px;
        gap:10px;
        flex-wrap:wrap;
    ">

        <!-- Left filters -->
        <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
        <!-- Publish Dropdown -->
            <select id="filterPublish" style="padding:6px 12px; border-radius:5px; border:1px solid #d1d5db;">
                <option value="">All</option>
                <option value="1">Published</option>
                <option value="0">Pending</option>
            </select>
        <!-- From Date -->
            <input type="date" id="filterFrom" value="{{ date('Y-m-01') }}"
                style="padding:6px 12px; border-radius:5px; border:1px solid #d1d5db;">

            <!-- To Date -->
            <input type="date" id="filterTo" value="{{ date('Y-m-t') }}"
                style="padding:6px 12px; border-radius:5px; border:1px solid #d1d5db;">
        </div>

        <!-- Right Search Button -->
        <button id="filterSearch"
            style="


        padding:8px 14px;
        background:#2563eb;
        color:#fff;
        border:none;
        border-radius:6px;
        cursor:pointer;
        display:flex;
        align-items:center;
        justify-content:center;
    ">
            🔍 Search
        </button>
    </div>



    <div id="createModal"
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

                <!-- Title -->
                <label style="font-size:14px; font-weight:500; display:block; margin-bottom:6px;">
                    Post Title
                </label>
                <input type="text" name="title" placeholder="Enter post title" required
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
        "></textarea>

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
                    <button type="button" onclick="closeCreateModal()"
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


            <span onclick="closeCreateModal()"
                style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:18px;">
                &times;
            </span>
        </div>
    </div>


    {{-- this is for the edit modal --}}

    <div id="editModal"
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
            <h3>Edit Your Post</h3>
            <div class="modal-body" id="modal-body">

            </div>
            <span onclick="closeEditModal()"
                style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:18px;">
                &times;
            </span>
        </div>
    </div>




    <script>
        function openCreateModal() {
            document.getElementById('createModal').style.display = 'flex';
        }

        function closeCreateModal() {

            document.getElementById('createModal').style.display = 'none';
        }

        function openEditModal(element) {
            console.log(element.data('link'));
            document.getElementById('editModal').style.display = 'flex';
            $('#editModal #modal-body').load(element.data('link'));
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>




    <style>
        .table-wrapper {
            max-width: 1100px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .data-table thead th {
            background: #f9fafb;
            color: #374151;
            font-weight: 600;
            font-size: 14px;
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 2;
        }

        .data-table tbody td {
            padding: 14px 16px;
            font-size: 14px;
            color: #374151;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .data-table tbody tr:nth-child(even) {
            background: #fafafa;
        }

        .data-table tbody tr:hover {
            background: #f0f9ff;
            transition: background 0.2s ease;
        }

        .table-img {
            width: 70px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
        }

        .no-image {
            font-size: 12px;
            color: #9ca3af;
        }

        .dataTables_wrapper {
            padding: 15px;
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            padding: 6px 10px;
            outline: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
        }
    </style>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:60px;">ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th style="width:120px;">Image</th>
                    <th>Publish</th>
                    {{-- <th>Approving</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script>
        $(function() {
            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('post.post') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'content',
                        name: 'content',
                        render: function(data) {
                            return data.length > 80 ? data.substr(0, 80) + '...' : data;
                        }
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'is_published',
                        name: 'is_published'
                    },

                    // {
                    //     data: 'is_approved',
                    //     name: 'is_approved'
                    // },




                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });
        });
    </script>

    <script>
        function deletePost(id) {
            if (!confirm('Are you sure you want to delete this post?')) {
                return;
            }

            $.ajax({
                url: "{{ url('admin/delete_post') }}/" + id,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert(response.success);
                    $('.data-table').DataTable().ajax.reload(null, false);
                },
                error: function(xhr) {
                    alert('Something went wrong!');
                }
            });
        }
    </script>


    {{-- here for the javascript --}}

    <script>
        // function togglePublish(el, id) {
        //     const knob = el.nextElementSibling.querySelector('span');

        //     knob.style.transform = el.checked ? 'translateX(22px)' : 'translateX(0)';

        //     fetch(`/admin/posts/toggle-publish/${id}`, {
        //             method: 'POST',
        //             headers: {
        //                 'X-CSRF-TOKEN': '{{ csrf_token() }}',
        //                 'Accept': 'application/json'
        //             }
        //         })
        //         .then(() => {
        //             $('.data-table').DataTable().ajax.reload(null, false);

        //             // alert('Post publish status updated successfully');
        //         })
        //         .catch(() => {
        //             el.checked = !el.checked;
        //             knob.style.transform = el.checked ? 'translateX(22px)' : 'translateX(0)';
        //             alert('Failed to update');
        //         });
        // }

        function togglePublish(el, id) {
            const track = el.nextElementSibling; // the outer span (track)
            const knob = track.querySelector('span');

            // Update knob position
            knob.style.transform = el.checked ? 'translateX(22px)' : 'translateX(0)';

            // Update background color immediately
            track.style.background = el.checked ? 'blue' : '#ccc';

            // Send AJAX request
            fetch(`/admin/posts/toggle-publish/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(() => {
                    // Optionally show a message
                    // alert('Post publish status updated successfully');
                })
                .catch(() => {
                    // rollback if failed
                    el.checked = !el.checked;
                    knob.style.transform = el.checked ? 'translateX(22px)' : 'translateX(0)';
                    track.style.background = el.checked ? 'blue' : '#ccc';
                    alert('Failed to update');
                });
        }
    </script>

    {{-- script for the bar  --}}

    <script>
        // Filter functionality
        $('#filterSearch').on('click', function() {
            var table = $('.data-table').DataTable();
            var publish = $('#filterPublish').val();
            var from = $('#filterFrom').val();
            var to = $('#filterTo').val();

            table.ajax.url("{{ route('getAllPost') }}?status=" + publish + "&fromDate=" + from + "&toDate=" + to)
                .load();
        });
    </script>
@endsection
