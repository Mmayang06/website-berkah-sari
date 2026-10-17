<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Jenis Input - Petugas Berkah Sari</title>
    <meta name="robots" content="noindex, nofollow">
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary: #348E38;
            --secondary: #525368;
            --light: #E8F5E9;
            --dark: #0F4229;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Open Sans', sans-serif;
            background: #ffffff;
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
            box-shadow: 0 2px 15px rgba(0, 0, 0, .08);
            border-bottom: 1px solid #eef2ee;
            position: relative;
            z-index: 100;
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

        .btn-logout {
            background: transparent;
            border: 1px solid #dc3545;
            color: #dc3545;
            padding: 5px 14px;
            border-radius: 6px;
            font-family: 'Jost', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            transition: all .2s;
            text-decoration: none;
        }

        .btn-logout:hover {
            background: #dc3545;
            color: #fff;
        }

        .select-wrap {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px 40px;
        }

        .choice-card-col {
            max-width: 440px;
        }

        .service-item {
            position: relative;
            text-align: center;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(15, 66, 41, .15);
            cursor: default;
        }

        .service-item:hover {
            transform: none !important;
            box-shadow: 0 10px 40px rgba(15, 66, 41, .15) !important;
        }

        .service-item .service-img {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 1;
        }

        .service-item .service-img img {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            object-fit: cover;
            transform: none !important;
            transition: none !important;
        }

        .service-item:hover .service-img img {
            transform: none !important;
        }

        .service-item .service-text {
            position: relative;
            z-index: 2;
            width: 100%;
            background: rgba(15, 66, 41, .72) !important;
        }

        .service-item:hover .service-text {
            background: rgba(15, 66, 41, .72) !important;
        }

        .service-item .service-text h4 {
            color: #ffffff !important;
            font-family: 'Jost', sans-serif;
            font-weight: 700;
        }

        .service-item .service-text p {
            color: rgba(232, 245, 233, 0.9) !important;
            font-size: 14px;
            line-height: 1.5;
        }

        .service-item .service-text .btn-square {
            width: 90px;
            height: 90px;
            background: var(--light) !important;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .swipe-wrap {
            margin-top: 20px;
            width: 100%;
        }

        .swipe-box {
            position: relative;
            width: 100%;
            height: 48px;
            background: rgba(255, 255, 255, 0.22);
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            user-select: none;
            -webkit-user-select: none;
            backdrop-filter: blur(4px);
        }

        .swipe-progress {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0%;
            background: rgba(52, 142, 56, 0.7);
            border-radius: 50px;
            pointer-events: none;
        }

        .swipe-label {
            position: relative;
            z-index: 2;
            font-family: 'Jost', sans-serif;
            font-size: 13.5px;
            font-weight: 600;
            color: #ffffff;
            letter-spacing: 0.2px;
            pointer-events: none;
            padding-left: 28px;
            white-space: nowrap;
            transition: opacity .2s;
        }

        .swipe-handle {
            position: absolute;
            left: 4px;
            top: 4px;
            width: 40px;
            height: 40px;
            background: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark);
            font-size: 14px;
            cursor: grab;
            z-index: 3;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
            touch-action: none;
        }

        .swipe-handle:active {
            cursor: grabbing;
        }

        @media (max-width: 768px) {
            .topbar {
                padding: 0 20px;
                height: 56px;
            }

            .topbar .brand {
                font-size: 24px;
            }

            .topbar .portal-label {
                display: none;
            }

            .select-wrap {
                padding: 20px 12px;
            }
        }
    </style>
</head>

<body>
    <div class="topbar-strip"></div>
    <header class="topbar">
        <a href="{{ route('petugas.pilih') }}" class="brand">Berkah Sari</a>
        <div class="d-flex align-items-center gap-3">
            <form method="POST" action="{{ route('portal.logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn-logout" title="Keluar">
                    <i class="bi bi-box-arrow-right me-1"></i> Keluar
                </button>
            </form>
        </div>
    </header>

    <div class="select-wrap">
        <div class="container">
            <div class="text-center mx-auto mb-4" style="max-width: 600px;">
                <p class="fs-6 fw-bold text-primary text-uppercase mb-2" style="font-family: 'Jost', sans-serif; letter-spacing: 1.5px;">Portal Petugas Input</p>
                <h1 class="display-6 mb-2" style="font-family: 'Jost', sans-serif; color: var(--dark); font-weight: 700;">Mau Input Apa Hari Ini?</h1>
                <p class="text-secondary mb-0" style="font-size: 15px;">Silakan pilih jenis data yang ingin Anda inputkan hari ini untuk memulai pencatatan.</p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-lg-5 col-md-6 choice-card-col">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="{{ asset('img/service-1.jpg') }}" alt="Bank Sampah">
                        </div>
                        <div class="service-text rounded p-5 w-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="btn-square rounded-circle mx-auto mb-3">
                                    <i class="fas fa-recycle text-primary" style="font-size: 2.2rem;"></i>
                                </div>
                                <h4 class="mb-3">Bank Sampah</h4>
                                <p class="mb-4">Input dan kelola data setoran sampah terpilah (kardus, botol, plastik, dll) dari donatur dan umat.</p>
                            </div>
                            <div class="swipe-wrap">
                                <div class="swipe-box" data-target="{{ route('petugas.dashboard', ['jenis' => 'bank-sampah']) }}">
                                    <div class="swipe-progress"></div>
                                    <span class="swipe-label">Mulai sesi input hari ini <i class="fas fa-chevron-right ms-1"></i></span>
                                    <div class="swipe-handle">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-6 choice-card-col">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-img rounded">
                            <img class="img-fluid" src="{{ asset('img/service-2.jpg') }}" alt="Minyak Jelantah">
                        </div>
                        <div class="service-text rounded p-5 w-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="btn-square rounded-circle mx-auto mb-3">
                                    <i class="fas fa-oil-can text-primary" style="font-size: 2.2rem;"></i>
                                </div>
                                <h4 class="mb-3">Minyak Jelantah</h4>
                                <p class="mb-4">Input dan kelola data setoran minyak jelantah bekas dari donatur dan umat untuk daur ulang.</p>
                            </div>
                            <div class="swipe-wrap">
                                <div class="swipe-box" data-target="{{ route('petugas.dashboard', ['jenis' => 'minyak-jelantah']) }}">
                                    <div class="swipe-progress"></div>
                                    <span class="swipe-label">Mulai sesi input hari ini <i class="fas fa-chevron-right ms-1"></i></span>
                                    <div class="swipe-handle">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.swipe-box').forEach(box => {
            const handle = box.querySelector('.swipe-handle');
            const progress = box.querySelector('.swipe-progress');
            const label = box.querySelector('.swipe-label');
            const targetUrl = box.getAttribute('data-target');

            let isDragging = false;
            let startX = 0;
            let currentX = 0;
            let maxDist = 0;

            function calcMax() {
                return box.clientWidth - handle.clientWidth - 8;
            }

            function onStart(e) {
                isDragging = true;
                startX = e.type.includes('touch') ? e.touches[0].clientX : e.clientX;
                maxDist = calcMax();
                handle.style.transition = 'none';
                progress.style.transition = 'none';
            }

            function onMove(e) {
                if (!isDragging) return;
                const clientX = e.type.includes('touch') ? e.touches[0].clientX : e.clientX;
                let move = clientX - startX;
                if (move < 0) move = 0;
                if (move > maxDist) move = maxDist;

                currentX = move;
                handle.style.transform = `translateX(${move}px)`;
                progress.style.width = `${move + handle.clientWidth}px`;

                const ratio = move / maxDist;
                label.style.opacity = `${Math.max(0.2, 1 - ratio * 0.9)}`;
            }

            function onEnd() {
                if (!isDragging) return;
                isDragging = false;
                maxDist = calcMax();

                if (currentX >= maxDist * 0.75) {
                    handle.style.transition = 'transform 0.18s ease';
                    progress.style.transition = 'width 0.18s ease';
                    handle.style.transform = `translateX(${maxDist}px)`;
                    progress.style.width = '100%';
                    handle.innerHTML = '<i class="fas fa-check" style="color:var(--primary);"></i>';
                    label.textContent = 'Membuka sesi...';
                    setTimeout(() => {
                        window.location.href = targetUrl;
                    }, 220);
                } else {
                    handle.style.transition = 'transform 0.22s ease';
                    progress.style.transition = 'width 0.22s ease';
                    handle.style.transform = 'translateX(0px)';
                    progress.style.width = '0%';
                    label.style.opacity = '1';
                    currentX = 0;
                }
            }

            handle.addEventListener('mousedown', onStart);
            window.addEventListener('mousemove', onMove);
            window.addEventListener('mouseup', onEnd);

            handle.addEventListener('touchstart', onStart, { passive: true });
            window.addEventListener('touchmove', onMove, { passive: true });
            window.addEventListener('touchend', onEnd);
        });
    </script>
</body>
</html>
