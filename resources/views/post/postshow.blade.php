@extends('master')

@section('content')
    <style>
        /* ===== TABLE WRAPPER ===== */
        .table-wrapper {
            max-width: 1100px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        /* ===== TABLE ===== */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        /* ===== HEADER ===== */
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

        /* ===== BODY ===== */
        .data-table tbody td {
            padding: 14px 16px;
            font-size: 14px;
            color: #374151;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        /* ===== ZEBRA ===== */
        .data-table tbody tr:nth-child(even) {
            background: #fafafa;
        }

        /* ===== HOVER ===== */
        .data-table tbody tr:hover {
            background: #f0f9ff;
            transition: background 0.2s ease;
        }

        /* ===== IMAGE ===== */
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

        /* ===== DATATABLE CONTROLS ===== */
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
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    {{-- ===== DATATABLE SCRIPT ===== --}}
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
                    }
                ]
            });
        });
    </script>
@endsection
