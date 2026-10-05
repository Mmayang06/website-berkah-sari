<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Portal Pengurus - Berkah Sari</title>
    <meta name="robots" content="noindex, nofollow">
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #348E38;
            --secondary: #525368;
            --light: #E8F5E9;
            --dark: #0F4229;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Open Sans', sans-serif;
            background: var(--light);
        }

        .topbar-strip {
            background: var(--dark);
            height: 12px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            padding: 0 48px;
            height: 64px;
            box-shadow: 0 0 30px rgba(0, 0, 0, .06);
        }

        .topbar .brand {
            font-family: 'Jost', sans-serif;
            font-weight: 700;
            font-size: 32px;
            color: var(--primary);
            text-decoration: none;
            margin: 0;
        }

        .topbar .portal-label {
            font-family: 'Jost', sans-serif;
            font-weight: 600;
            font-size: 16px;
            color: var(--dark);
        }

        .login-wrap {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: #fff;
            border-radius: 16px;
            padding: 40px 40px 36px;
            box-shadow: 0 10px 40px rgba(15, 66, 41, .12);
        }

        .login-card h1 {
            font-family: 'Jost', sans-serif;
            font-weight: 700;
            font-size: 30px;
            text-align: center;
            margin: 0 0 8px;
            color: var(--dark);
        }

        .login-card .subtitle {
            text-align: center;
            color: var(--secondary);
            font-size: 14px;
            margin: 0 0 28px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--dark);
        }

        .field { margin-bottom: 20px; position: relative; }

        .field input {
            width: 100%;
            padding: 12px 14px;
            font-size: 15px;
            font-family: inherit;
            border: 1px solid #cfe3d1;
            border-radius: 8px;
            background: var(--light);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .field input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(52, 142, 56, .2);
            background: #fff;
        }

        .field.has-toggle input { padding-right: 46px; }

        .toggle-pass {
            position: absolute;
            right: 12px;
            top: 38px;
            background: none;
            border: 0;
            color: #6c757d;
            font-size: 18px;
            cursor: pointer;
            padding: 0;
        }

        .toggle-pass:hover { color: var(--primary); }

        .btn-login {
            width: 100%;
            padding: 13px;
            border: 0;
            border-radius: 8px;
            background: var(--primary);
            color: #fff;
            font-family: 'Jost', sans-serif;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s;
        }

        .btn-login:hover { background: var(--dark); }

        .alert {
            background: #fdecea;
            color: #b02a37;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .alert.info { background: var(--light); color: var(--dark); }
    </style>
</head>

<body>
    <div class="topbar-strip"></div>
    <header class="topbar">
        <span class="brand">Berkah Sari</span>
        <span class="portal-label">Portal Login</span>
    </header>

    <div class="login-wrap">
    <main class="login-card">
        <h1>Selamat Datang</h1>
        <p class="subtitle">Silakan login ke Portal Pengurus Berkah Sari.</p>

        @if (session('info'))
            <div class="alert info">{{ session('info') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('portal.login.submit') }}">
            @csrf
            <div class="field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}"
                    placeholder="Masukkan username Anda" autocomplete="username" required autofocus>
            </div>

            <div class="field has-toggle">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                    placeholder="Masukkan password Anda" autocomplete="current-password" required>
                <button type="button" class="toggle-pass" id="togglePassword" aria-label="Tampilkan password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>

            <button type="submit" class="btn-login" id="btnLogin">Masuk</button>
        </form>
    </main>
    </div>

    <script>
        const pass = document.getElementById('password');
        const btn = document.getElementById('togglePassword');
        btn.addEventListener('click', () => {
            const show = pass.type === 'password';
            pass.type = show ? 'text' : 'password';
            btn.innerHTML = '<i class="bi bi-eye' + (show ? '-slash' : '') + '"></i>';
        });
    </script>
</body>

</html>
