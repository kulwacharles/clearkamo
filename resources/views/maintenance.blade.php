<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance – ClearKamo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #1a3c6e;
            --accent:  #e63946;
            --light:   #f0f4ff;
            --gear-color: rgba(26,60,110,.08);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated background gears */
        .bg-gear {
            position: fixed;
            border-radius: 50%;
            border: 20px solid var(--gear-color);
            animation: spin linear infinite;
            pointer-events: none;
        }
        .bg-gear::before {
            content: '';
            position: absolute;
            inset: -40px;
            border-radius: 50%;
            border: 20px solid var(--gear-color);
        }
        .gear-1 { width: 500px; height: 500px; top: -180px; left: -180px; animation-duration: 40s; }
        .gear-2 { width: 350px; height: 350px; bottom: -120px; right: -120px; animation-duration: 30s; animation-direction: reverse; }
        .gear-3 { width: 200px; height: 200px; top: 40%; right: 5%; animation-duration: 20s; }

        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

        /* Floating particles */
        .particles { position: fixed; inset: 0; pointer-events: none; overflow: hidden; }
        .particle {
            position: absolute;
            width: 6px; height: 6px;
            background: var(--primary);
            border-radius: 50%;
            opacity: 0.12;
            animation: float linear infinite;
        }
        @keyframes float {
            0%   { transform: translateY(100vh) scale(0); opacity: 0; }
            10%  { opacity: .12; }
            90%  { opacity: .12; }
            100% { transform: translateY(-10px) scale(1); opacity: 0; }
        }

        /* Card */
        .card {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(26,60,110,.12);
            padding: 56px 64px;
            max-width: 600px;
            width: 90%;
            text-align: center;
            position: relative;
            z-index: 10;
            animation: slideUp .6s cubic-bezier(.22,1,.36,1) both;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Official logo */
        .logo-wrap {
            margin: 0 auto 28px;
            display: flex; align-items: center; justify-content: center;
        }
        .logo-wrap img {
            max-width: 200px;
            max-height: 90px;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        /* Fallback wrench icon (shown only when no logo is available) */
        .icon-wrap {
            width: 96px; height: 96px;
            background: linear-gradient(135deg, var(--primary), #2b6cb0);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 28px;
            box-shadow: 0 8px 24px rgba(26,60,110,.25);
        }
        .icon-wrap i { font-size: 42px; color: #fff; }

        h1 {
            font-size: 2.4rem;
            font-weight: 800;
            color: var(--primary);
            line-height: 1.2;
            margin-bottom: 16px;
        }
        h1 span { color: var(--accent); }

        .message {
            font-size: 1rem;
            color: #5a6a85;
            line-height: 1.7;
            margin-bottom: 32px;
        }

        /* Progress bar */
        .progress-wrap { margin-bottom: 36px; }
        .progress-label {
            display: flex; justify-content: space-between;
            font-size: 12px; color: #8a9ab5; margin-bottom: 6px;
        }
        .progress-track {
            background: #e8edf6;
            border-radius: 8px; height: 8px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: 8px;
            background: linear-gradient(90deg, var(--primary), #4299e1);
            animation: progress 3s ease-in-out infinite alternate;
            width: 65%;
        }
        @keyframes progress { from { width: 45%; } to { width: 85%; } }

        /* Status dots */
        .status-row {
            display: flex; gap: 12px; flex-wrap: wrap; justify-content: center;
            margin-bottom: 32px;
        }
        .status-dot {
            display: flex; align-items: center; gap: 7px;
            background: #f7f9ff; border: 1px solid #e2e8f0;
            border-radius: 20px; padding: 6px 14px;
            font-size: 12px; font-weight: 500; color: #4a5568;
        }
        .dot {
            width: 8px; height: 8px; border-radius: 50%;
            animation: pulse 1.5s ease-in-out infinite;
        }
        .dot.green  { background: #38a169; }
        .dot.yellow { background: #d69e2e; animation-delay: .3s; }
        .dot.red    { background: #e53e3e; animation-delay: .6s; }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50%       { transform: scale(1.4); opacity: .7; }
        }

        /* Back link (admin) */
        .back-link {
            font-size: 13px; color: #8a9ab5;
        }
        .back-link a {
            color: var(--primary); font-weight: 600; text-decoration: none;
        }
        .back-link a:hover { text-decoration: underline; }

        @media (max-width: 600px) {
            .card { padding: 40px 28px; }
            h1 { font-size: 1.8rem; }
        }
    </style>
</head>
<body>

    <!-- Background decorations -->
    <div class="bg-gear gear-1"></div>
    <div class="bg-gear gear-2"></div>
    <div class="bg-gear gear-3"></div>

    <!-- Floating particles -->
    <div class="particles" id="particles"></div>

    <!-- Main card -->
    @php $about = \App\Models\About::first(); @endphp
    <div class="card">

        @if (!empty($about?->logo))
            <div class="logo-wrap">
                <img src="{{ url('/storage/' . $about->logo) }}" alt="ClearKamo Logo">
            </div>
        @else
            <div class="icon-wrap">
                <i class="fas fa-tools"></i>
            </div>
        @endif

        <h1>We'll be back <span>shortly!</span></h1>

        <p class="message">
            {{ $message ?? 'We are currently performing scheduled maintenance to improve your experience. Thank you for your patience — we\'ll be back online soon!' }}
        </p>

        <div class="progress-wrap">
            <div class="progress-label">
                <span>Maintenance in progress</span>
                <span>Almost there…</span>
            </div>
            <div class="progress-track">
                <div class="progress-fill"></div>
            </div>
        </div>

        <div class="status-row">
            <div class="status-dot"><span class="dot green"></span> Admin Panel — Online</div>
            <div class="status-dot"><span class="dot yellow"></span> Website — Maintenance</div>
            <div class="status-dot"><span class="dot green"></span> Database — Online</div>
        </div>

        <p class="back-link">
            @auth
                You are logged in as admin. &nbsp;
                <a href="{{ route('admin.dashboard') }}">Back to Admin Panel</a>
            @else
                Are you an admin?
                <a href="{{ route('login') }}">Sign in here</a>
            @endauth
        </p>
    </div>

    <script>
        // Generate floating particles
        const container = document.getElementById('particles');
        for (let i = 0; i < 18; i++) {
            const p = document.createElement('div');
            p.className = 'particle';
            p.style.left = Math.random() * 100 + 'vw';
            p.style.animationDuration = (8 + Math.random() * 12) + 's';
            p.style.animationDelay = (Math.random() * 10) + 's';
            p.style.width = p.style.height = (4 + Math.random() * 8) + 'px';
            container.appendChild(p);
        }
    </script>
</body>
</html>
