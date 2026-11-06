<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>REPLAY Admin Panel</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
            font-family: Arial, sans-serif;
            color: #263445;
        }

        body {
            background: #f1f2f4;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .admin-sidebar {
            display: flex;
            flex-direction: column;
            width: 300px;
            min-width: 300px;
            background: #1e293b;
            color: #d1d5db;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            min-height: 118px;
            padding: 25px;
            border-bottom: 1px solid #475569;
            font-size: 22px;
            font-weight: 600;
            color: #f8fafc;
        }

        .admin-menu {
            display: flex;
            flex-direction: column;
            gap: 0;
            padding: 20px 12px;
        }

        .admin-menu a,
        .admin-menu button {
            display: block;
            width: 100%;
            padding: 14px 13px;
            border: none;
            border-radius: 5px;
            background: transparent;
            color: #d1d5db;
            font-family: inherit;
            font-size: 16px;
            text-align: left;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }

        .admin-menu a:hover,
        .admin-menu button:hover {
            background: #334155;
            color: #fff;
        }

        .admin-menu a.active {
            background: #334155;
            color: #fff;
            font-weight: 600;
        }

        .admin-menu .logout {
            color: #fca5a5;
        }

        .admin-menu .logout:hover {
            background: #7f1d1d;
            color: #fff;
        }

        .admin-menu form {
            margin: 0;
        }

        /* BAGIAN KONTEN */
        .admin-content {
            display: flex;
            flex: 1;
            flex-direction: column;
            min-width: 0;
        }

       .admin-navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 72px;
            padding: 18px 30px;
            background: #2f5bea;
            border-bottom: 1px solid #2549c7;
        }

        .admin-navbar-title {
            font-size: 21px;
            font-weight: 600;
            color: #ffffff;
        }

        .admin-navbar-subtitle {
            font-size: 15px;
            color: #e0e7ff;
        }
        /* KONTEN UTAMA */
        .admin-main {
            flex: 1;
            width: 100%;
            padding: 30px;
        }

        /* FOOTER */
        .admin-footer {
            padding: 22px 15px;
            background: #fff;
            border-top: 1px solid #e5e7eb;
            color: #64748b;
            font-size: 15px;
            text-align: center;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .admin-sidebar {
                width: 220px;
                min-width: 220px;
            }

            .admin-main {
                padding: 22px;
            }

            .admin-navbar {
                padding: 18px 22px;
            }
        }

        @media (max-width: 650px) {
            .admin-wrapper {
                flex-direction: column;
            }

            .admin-sidebar {
                width: 100%;
                min-width: 0;
            }

            .admin-brand {
                min-height: 75px;
                padding: 20px;
                border-bottom: 1px solid #475569;
            }

            .admin-menu {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 5px;
                padding: 10px;
            }

            .admin-menu a,
            .admin-menu button {
                width: auto;
                padding: 10px;
                font-size: 14px;
            }

            .admin-navbar {
                min-height: 60px;
                padding: 15px;
            }

            .admin-navbar-title {
                font-size: 18px;
            }

            .admin-navbar-subtitle {
                font-size: 12px;
            }

            .admin-main {
                padding: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="admin-wrapper">

        {{-- SIDEBAR --}}
        <aside class="admin-sidebar">

            <div class="admin-brand">
                REPLAY
            </div>

            <nav class="admin-menu">

                <a href="{{ route('digicam.index') }}"
                   class="{{ request()->routeIs('digicam.*', 'kategori-digicam.*') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.about') }}"
                   class="{{ request()->routeIs('admin.about') ? 'active' : '' }}">
                    About
                </a>

                <a href="{{ url('/') }}">
                    Lihat Toko
                </a>

                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="logout">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="logout">
                        Login
                    </a>
                @endauth

            </nav>
        </aside>

        {{-- KONTEN KANAN --}}
        <div class="admin-content">

            {{-- NAVBAR --}}
            <header class="admin-navbar">
                <div class="admin-navbar-title">
                    Admin Panel
                </div>

            </header>

            {{-- KONTEN HALAMAN --}}
            <main class="admin-main">
                {{ $slot }}
            </main>

            {{-- FOOTER --}}
            <footer class="admin-footer">
                &copy; {{ date('Y') }} REPLAY Digicam Store
            </footer>

        </div>
    </div>
</body>
</html>