<nav class="navbar">
    <div class="nav-container">
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    🏠 Acasă
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                    ℹ️ Despre Noi
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}">
                    🔧 Servicii
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('contact.page') }}" class="nav-link {{ request()->routeIs('contact.page') ? 'active' : '' }}">
                    📧 Contact
                </a>
            </li>
            @auth
                <li class="nav-item dropdown">
                    <span class="nav-link dropdown-toggle">👤 {{ Auth::user()->name ?? 'Utilizator' }}</span>
                    <div class="dropdown-menu">
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('admin') }}" class="dropdown-item">Admin Panel</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="dropdown-item-form">
                            @csrf
                            <button type="submit" class="dropdown-item btn-logout">🚪 Logout</button>
                        </form>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">🔐 Login</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">📝 Register</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>
