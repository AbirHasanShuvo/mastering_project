{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    @forelse ($posts as $post)
        <h1>{{ $post->title }}</h1>
    @empty
    @endforelse
</body>

</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Posts</title>
</head>

<body style="background:#f3f4f6; font-family:Arial, sans-serif; margin:0; padding:30px;">

    <div style="max-width:900px; margin:auto;">

        <h2 style="margin-bottom:20px; color:#111827;">
            🛠 Pending Posts for Approval
        </h2>

        @forelse ($posts as $post)
            <div
                style="
                background:#ffffff;
                padding:20px;
                margin-bottom:20px;
                border-radius:12px;
                box-shadow:0 8px 20px rgba(0,0,0,0.06);
            ">

                {{-- Title --}}
                <h3 style="margin:0 0 6px; color:#1f2937;">
                    {{ $post->title }}
                </h3>

                {{-- Meta --}}
                <small style="color:#6b7280;">
                    Submitted on {{ $post->created_at->format('d M Y, h:i A') }}
                </small>

                {{-- Image --}}
                @if ($post->image)
                    <div style="margin:15px 0;">
                        <img src="{{ asset('storage/' . $post->image) }}"
                            style="
                                width:100%;
                                max-width:420px;
                                max-height:260px;
                                object-fit:contain;
                                background:#f9fafb;
                                border-radius:10px;
                             ">
                    </div>
                @endif

                {{-- Content --}}
                <p style="color:#374151; line-height:1.6; margin-top:10px;">
                    {{ $post->content }}
                </p>

                {{-- Actions --}}
                <div
                    style="
                    display:flex;
                    gap:12px;
                    margin-top:20px;
                ">
                    {{-- Approve --}}
                    <form action="" method="POST">
                        @csrf
                        <button type="submit"
                            style="
                                padding:10px 18px;
                                background:#16a34a;
                                color:white;
                                border:none;
                                border-radius:8px;
                                cursor:pointer;
                                font-weight:600;
                            ">
                            ✅ Approve
                        </button>
                    </form>

                    {{-- Reject --}}
                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to reject this post?')"
                            style="
                                padding:10px 18px;
                                background:#dc2626;
                                color:white;
                                border:none;
                                border-radius:8px;
                                cursor:pointer;
                                font-weight:600;
                            ">
                            ❌ Reject
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <div
                style="
                background:#fff;
                padding:30px;
                border-radius:12px;
                text-align:center;
                color:#6b7280;
            ">
                🎉 No pending posts
            </div>
        @endforelse

    </div>

</body>

</html>
