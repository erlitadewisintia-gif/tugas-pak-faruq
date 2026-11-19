{{-- Deskripsi file: resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f6f7f5">
    <title>{{ config('app.name', 'Ruang Data') }} - Kelola ide dengan lebih rapi</title>
    <style>
        :root {
            color-scheme: light;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #172c27;
            background: #f6f7f5;
            font-synthesis: none;
            text-rendering: optimizeLegibility;
        }
        * { box-sizing: border-box; }
        body { margin: 0; min-width: 320px; }
        a { color: inherit; text-decoration: none; }
        .landing { overflow: hidden; }
        .container { width: min(1120px, calc(100% - 48px)); margin: 0 auto; }
        .topbar { height: 82px; display: flex; align-items: center; }
        .nav { display: flex; align-items: center; justify-content: space-between; gap: 24px; }
        .brand { display: inline-flex; align-items: center; gap: 11px; font-size: 17px; font-weight: 750; letter-spacing: -.04em; }
        .brand-mark { display: grid; width: 36px; height: 36px; place-items: center; border-radius: 12px; color: white; background: #246b54; font-size: 17px; }
        .nav-actions { display: flex; align-items: center; gap: 26px; font-size: 14px; font-weight: 650; }
        .nav-login { color: #5b6b65; transition: color .2s; }
        .nav-login:hover { color: #1d5d47; }
        .button { min-height: 46px; display: inline-flex; align-items: center; justify-content: center; gap: 9px; padding: 0 20px; border: 1px solid transparent; border-radius: 12px; font-size: 14px; font-weight: 700; transition: transform .2s, background .2s, box-shadow .2s; }
        .button:hover { transform: translateY(-2px); }
        .button-primary { color: #fff; background: #246b54; box-shadow: 0 8px 18px rgb(36 107 84 / 15%); }
        .button-primary:hover { background: #1d5d47; box-shadow: 0 10px 22px rgb(36 107 84 / 22%); }
        .button-light { color: #245944; background: white; border-color: #e3e9e4; }
        .hero { position: relative; display: grid; min-height: calc(100vh - 82px); min-height: calc(100svh - 82px); grid-template-columns: 1fr 1fr; align-items: center; gap: 58px; padding: 32px 0; }
        .hero::before { position: absolute; z-index: -1; top: 8px; left: -130px; width: 430px; height: 430px; border-radius: 50%; background: #e8f0e9; content: ""; filter: blur(1px); }
        .eyebrow { display: inline-flex; align-items: center; gap: 9px; margin-bottom: 22px; color: #28684f; font-size: 11px; font-weight: 800; letter-spacing: .16em; }
        .eyebrow::before { width: 24px; height: 2px; background: #73ad87; content: ""; }
        h1 { max-width: 570px; margin: 0; font-size: clamp(42px, 5.4vw, 66px); font-weight: 760; letter-spacing: -.065em; line-height: 1.06; }
        h1 em { color: #398263; font-style: normal; }
        .hero-copy { max-width: 470px; margin: 22px 0 30px; color: #6d7974; font-size: 16px; line-height: 1.8; }
        .hero-actions { display: flex; flex-wrap: wrap; gap: 12px; }
        .hero-footnote { display: flex; align-items: center; gap: 9px; margin-top: 25px; color: #78847e; font-size: 12px; }
        .check { display: grid; width: 18px; height: 18px; place-items: center; border-radius: 50%; color: #25684f; background: #e2eee5; font-size: 11px; font-weight: 800; }
        .preview-wrap { position: relative; padding: 15px 0 20px 15px; }
        .preview-glow { position: absolute; inset: 7% -5% 3% 10%; z-index: -1; border-radius: 35%; background: #d7e7da; filter: blur(42px); }
        .preview { overflow: hidden; padding: 24px; border: 1px solid #e8ece7; border-radius: 23px; background: rgb(255 255 255 / 91%); box-shadow: 0 30px 75px rgb(39 68 53 / 13%); transform: rotate(1deg); }
        .preview-head { display: flex; align-items: center; justify-content: space-between; padding-bottom: 20px; border-bottom: 1px solid #edf0ec; }
        .preview-title { font-size: 14px; font-weight: 750; }
        .preview-caption { margin-top: 5px; color: #99a49e; font-size: 10px; }
        .preview-avatar { display: grid; width: 34px; height: 34px; place-items: center; border-radius: 50%; color: #28684f; background: #e7f0e8; font-size: 11px; font-weight: 800; }
        .preview-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; padding: 19px 0; }
        .stat-card { padding: 14px; border: 1px solid #edf0ec; border-radius: 13px; }
        .stat-label { color: #98a29d; font-size: 10px; }
        .stat-value { margin-top: 8px; font-size: 22px; font-weight: 750; letter-spacing: -.04em; }
        .stat-note { margin-top: 4px; color: #4c8a69; font-size: 10px; }
        .preview-list-title { margin: 2px 0 11px; font-size: 11px; font-weight: 750; }
        .preview-row { display: flex; align-items: center; gap: 11px; padding: 11px 0; border-top: 1px solid #f0f2ef; }
        .preview-dot { width: 8px; height: 8px; flex: 0 0 auto; border-radius: 50%; background: #67a77d; }
        .preview-row:nth-of-type(2) .preview-dot { background: #d4a36c; }
        .preview-row:nth-of-type(3) .preview-dot { background: #8d9dcc; }
        .preview-row-text { min-width: 0; flex: 1; }
        .preview-row-title { overflow: hidden; color: #34443d; font-size: 10px; font-weight: 650; text-overflow: ellipsis; white-space: nowrap; }
        .preview-row-meta { margin-top: 4px; color: #a0aaa5; font-size: 9px; }
        .preview-badge { padding: 5px 8px; border-radius: 999px; color: #367654; background: #eaf3eb; font-size: 9px; font-weight: 700; }
        .floating-note { position: absolute; right: -18px; bottom: 1px; display: flex; align-items: center; gap: 10px; padding: 12px 15px; border: 1px solid #e9eee8; border-radius: 14px; background: white; box-shadow: 0 12px 32px rgb(39 68 53 / 11%); }
        .floating-icon { display: grid; width: 31px; height: 31px; place-items: center; border-radius: 10px; color: #fff; background: #76a984; font-size: 14px; }
        .floating-note strong { display: block; font-size: 10px; }
        .floating-note span { display: block; margin-top: 3px; color: #9aa49e; font-size: 9px; }
        .features { padding: 77px 0 88px; border-top: 1px solid #e8ebe7; background: #fff; }
        .section-heading { max-width: 540px; margin: 0 auto 42px; text-align: center; }
        .section-heading .eyebrow { justify-content: center; margin-bottom: 14px; }
        h2 { margin: 0; font-size: clamp(28px, 3.3vw, 38px); letter-spacing: -.055em; line-height: 1.2; }
        .section-heading p { margin-top: 13px; color: #77837d; font-size: 14px; line-height: 1.7; }
        .feature-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
        .feature-card { padding: 24px; border: 1px solid #edf0ec; border-radius: 17px; background: #fff; transition: transform .2s, box-shadow .2s; }
        .feature-card:hover { transform: translateY(-4px); box-shadow: 0 16px 34px rgb(39 68 53 / 8%); }
        .feature-icon { display: grid; width: 42px; height: 42px; place-items: center; border-radius: 13px; color: #28684f; background: #edf5ee; font-size: 17px; font-weight: 700; }
        .feature-card h3 { margin: 18px 0 8px; font-size: 15px; letter-spacing: -.02em; }
        .feature-card p { margin: 0; color: #7b8781; font-size: 12px; line-height: 1.75; }
        .cta { display: flex; align-items: center; justify-content: space-between; gap: 25px; margin: 62px 0 76px; padding: 35px 40px; border-radius: 21px; color: white; background: #1f5c47; }
        .cta h2 { font-size: 25px; }
        .cta p { margin-top: 8px; color: #c5d9cf; font-size: 13px; }
        .cta .button { flex: 0 0 auto; color: #245944; background: #fff; }
        footer { padding: 21px 0; border-top: 1px solid #e8ebe7; color: #8b9690; font-size: 11px; }
        .footer-inner { display: flex; align-items: center; justify-content: space-between; gap: 16px; }
        @media (min-width: 801px) and (max-height: 760px) {
            .topbar { height: 72px; }
            .hero { min-height: calc(100vh - 72px); min-height: calc(100svh - 72px); gap: 40px; padding: 18px 0; }
            h1 { font-size: clamp(42px, 4.6vw, 58px); }
            .hero-copy { margin: 16px 0 20px; line-height: 1.65; }
            .hero-footnote { margin-top: 18px; }
            .preview-wrap { padding: 10px 0 14px 12px; }
            .preview { padding: 18px; }
            .preview-head { padding-bottom: 14px; }
            .preview-stats { gap: 10px; padding: 13px 0; }
            .stat-card { padding: 11px; }
            .stat-value { margin-top: 5px; font-size: 20px; }
            .preview-row { padding: 8px 0; }
        }
        @media (max-width: 800px) {
            .hero { min-height: auto; grid-template-columns: 1fr; gap: 28px; padding: 62px 0 70px; }
            .hero-copy { max-width: 560px; }
            .preview-wrap { width: min(100%, 520px); margin: 0 auto; }
            .feature-grid { grid-template-columns: 1fr; }
            .features { padding: 60px 0; }
            .cta { align-items: flex-start; flex-direction: column; margin: 44px 0 54px; padding: 29px; }
        }
        @media (max-width: 520px) {
            .container { width: min(100% - 32px, 1120px); }
            .topbar { height: 70px; }
            .nav-actions { gap: 15px; font-size: 12px; }
            .nav-actions .button { min-height: 39px; padding: 0 13px; font-size: 12px; }
            .hero { padding-top: 49px; }
            h1 { font-size: 44px; }
            .hero-copy { font-size: 14px; }
            .preview { padding: 17px; }
            .floating-note { right: -5px; }
            .footer-inner { align-items: flex-start; flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="landing">
        <header class="topbar">
            <nav class="container nav" aria-label="Navigasi utama">
                <a class="brand" href="{{ route('home') }}">
                    <span class="brand-mark" aria-hidden="true">R</span>
                    <span>Ruang Data</span>
                </a>
                <div class="nav-actions">
                    <a class="nav-login" href="{{ route('login') }}">Masuk</a>
                    <a class="button button-primary" href="{{ route('register') }}">Daftar <span aria-hidden="true">→</span></a>
                </div>
            </nav>
        </header>

        <main>
            <section class="container hero">
                <div>
                    <span class="eyebrow">LEBIH RAPI, LEBIH PRODUKTIF</span>
                    <h1>Ide bagus layak dikelola <em>dengan baik.</em></h1>
                    <p class="hero-copy">Simpan, atur, dan kembangkan tulisan Anda dalam satu ruang kerja yang sederhana. Fokus pada isi, biar pengelolaan datanya terasa lebih ringan.</p>
                    <div class="hero-actions">
                        <a class="button button-primary" href="{{ route('register') }}">Buat akun gratis <span aria-hidden="true">→</span></a>
                        <a class="button button-light" href="{{ route('login') }}">Saya sudah punya akun</a>
                    </div>
                    <div class="hero-footnote"><span class="check" aria-hidden="true">✓</span> Mulai dengan mudah, kelola kapan saja</div>
                </div>

                <div class="preview-wrap" aria-label="Pratinjau tampilan pengelolaan data">
                    <div class="preview-glow"></div>
                    <div class="preview">
                        <div class="preview-head">
                            <div>
                                <div class="preview-title">Ringkasan ruang kerja</div>
                                <div class="preview-caption">Semua catatan Anda, lebih teratur</div>
                            </div>
                            <div class="preview-avatar">RD</div>
                        </div>
                        <div class="preview-stats">
                            <div class="stat-card">
                                <div class="stat-label">Data tersimpan</div>
                                <div class="stat-value">Terorganisir</div>
                                <div class="stat-note">Semua di satu tempat</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-label">Ruang untuk ide</div>
                                <div class="stat-value">Selalu ada</div>
                                <div class="stat-note">Tambah kapan saja</div>
                            </div>
                        </div>
                        <div class="preview-list-title">Aktivitas terbaru</div>
                        <div class="preview-row">
                            <span class="preview-dot"></span>
                            <div class="preview-row-text"><div class="preview-row-title">Rencana dan ide baru</div><div class="preview-row-meta">Catatan pribadi</div></div>
                            <span class="preview-badge">Tersimpan</span>
                        </div>
                        <div class="preview-row">
                            <span class="preview-dot"></span>
                            <div class="preview-row-text"><div class="preview-row-title">Inspirasi untuk minggu ini</div><div class="preview-row-meta">Kumpulan tulisan</div></div>
                            <span class="preview-badge">Tersimpan</span>
                        </div>
                        <div class="preview-row">
                            <span class="preview-dot"></span>
                            <div class="preview-row-text"><div class="preview-row-title">Hal yang ingin dikembangkan</div><div class="preview-row-meta">Draft ide</div></div>
                            <span class="preview-badge">Tersimpan</span>
                        </div>
                    </div>
                    <div class="floating-note">
                        <span class="floating-icon" aria-hidden="true">✓</span>
                        <div><strong>Data tersimpan rapi</strong><span>Siap dilanjutkan kapan saja</span></div>
                    </div>
                </div>
            </section>

            <section class="features">
                <div class="container">
                    <div class="section-heading">
                        <span class="eyebrow">DIRANCANG UNTUK KESIBUKAN ANDA</span>
                        <h2>Kelola data tanpa hal yang berbelit.</h2>
                        <p>Alur sederhana untuk membantu Anda mencatat, menemukan, dan memperbarui informasi dengan nyaman.</p>
                    </div>
                    <div class="feature-grid">
                        <article class="feature-card">
                            <div class="feature-icon" aria-hidden="true">＋</div>
                            <h3>Tambah dengan cepat</h3>
                            <p>Buat tulisan atau data baru lewat formulir yang jelas dan mudah digunakan.</p>
                        </article>
                        <article class="feature-card">
                            <div class="feature-icon" aria-hidden="true">⌕</div>
                            <h3>Temukan lebih mudah</h3>
                            <p>Daftar data tersusun rapi agar Anda bisa kembali ke informasi yang dibutuhkan.</p>
                        </article>
                        <article class="feature-card">
                            <div class="feature-icon" aria-hidden="true">↻</div>
                            <h3>Atur kapan saja</h3>
                            <p>Perbarui atau hapus data Anda melalui alur pengelolaan yang praktis.</p>
                        </article>
                    </div>
                </div>
            </section>

            <section class="container">
                <div class="cta">
                    <div>
                        <h2>Mulai rapikan ruang ide Anda.</h2>
                        <p>Buat akun dan kelola data dengan alur yang lebih nyaman.</p>
                    </div>
                    <a class="button" href="{{ route('register') }}">Buat akun sekarang <span aria-hidden="true">→</span></a>
                </div>
            </section>
        </main>

        <footer>
            <div class="container footer-inner">
                <a class="brand" href="{{ route('home') }}"><span class="brand-mark" aria-hidden="true">R</span><span>Ruang Data</span></a>
                <span>Ruang sederhana untuk ide dan data Anda.</span>
            </div>
        </footer>
    </div>
</body>
</html>
