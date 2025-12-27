<header style="background:#111827; color:#fff; padding:15px 20px;">
    <h2 style="margin:0;">Dashboard</h2>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <a href="route('logout')" class="btn"
            onclick="event.preventDefault();
                                                this.closest('form').submit();">
            {{ __('Log Out') }}
        </a>
    </form>
</header>
