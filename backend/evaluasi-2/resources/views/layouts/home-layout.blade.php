<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>REPLAY Digicam</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .replay-navbar {
            width: 100%;
            background: #2f5bea;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
        }

        .replay-navbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            max-width: 1400px;
            min-height: 70px;
            margin: 0 auto;
            padding: 12px 24px;
        }

        .replay-brand {
            color: white;
            font-size: 25px;
            font-weight: 800;
            letter-spacing: 2px;
            text-decoration: none;
        }

        .replay-menu {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .replay-menu a,
        .replay-menu button {
            display: inline-block;
            padding: 10px 14px;
            border: none;
            border-radius: 7px;
            background: transparent;
            color: white;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .replay-menu a:hover,
        .replay-menu button:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .replay-menu .admin-link {
            background: transparent;
            color: white;
        }

        .replay-menu .admin-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .replay-footer {
            padding: 22px 18px;
            background: #2f5bea;
            color: #ffffff !important;
            font-size: 13px;
            text-align: center;
        }

        @media (max-width: 700px) {
            .replay-navbar-inner {
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
            }

            .replay-menu {
                justify-content: flex-start;
                gap: 4px;
            }

            .replay-menu a,
            .replay-menu button {
                padding: 8px 10px;
                font-size: 13px;
            }

            .replay-main {
                padding: 14px;
            }
        }
    </style>
</head>
<body>
    <nav class="replay-navbar">
        <div class="replay-navbar-inner">
            <a href="{{ url('/') }}" class="replay-brand">
                REPLAY
            </a>

            <div class="replay-menu">
            <a href="{{ url('/') }}">Dashboard</a>

            <a href="{{ route('cart.index') }}">Keranjang</a>

            <a href="{{ route('checkout.index') }}">Checkout</a>

            <a href="{{ route('digicam.index') }}" class="admin-link">Admin</a>
            </div>
                </div>
            </nav>

            <main class="replay-main">
                {{ $slot }}
            </main>

            <footer class="replay-footer">
                &copy; 2026 REPLAY. All rights reserved.
            </footer>
        </body>
</html>