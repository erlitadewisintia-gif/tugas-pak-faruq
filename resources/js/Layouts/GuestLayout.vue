<!-- Deskripsi file: resources/js/Layouts/GuestLayout.vue -->
<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="auth-page">
        <div class="auth-shell">
            <aside class="auth-intro">
                <Link :href="route('home')" class="auth-brand">
                    <span class="auth-brand-mark">R</span>
                    <span>Ruang Data</span>
                </Link>

                <div class="auth-intro-copy">
                    <span class="auth-eyebrow">RUANG KERJA DIGITAL ANDA</span>
                    <h1>Semua ide baik dimulai dari tempat yang tepat.</h1>
                    <p>Kelola tulisan dan data dengan lebih rapi, fokus, dan mudah.</p>
                </div>

                <div class="auth-intro-note">
                    <span class="auth-note-icon" aria-hidden="true">✓</span>
                    <span>Praktis untuk mengelola data setiap hari</span>
                </div>
            </aside>

            <main class="auth-card">
                <nav class="auth-nav" aria-label="Navigasi akun">
                    <span>{{ $page.url === '/register' ? 'Buat akun' : 'Selamat datang kembali' }}</span>
                    <Link
                        :href="route('login')"
                        :class="{ 'is-current': $page.url === '/login' }"
                        :aria-current="$page.url === '/login' ? 'page' : undefined"
                    >
                        Masuk
                    </Link>
                    <Link
                        :href="route('register')"
                        :class="{ 'is-current': $page.url === '/register' }"
                        :aria-current="$page.url === '/register' ? 'page' : undefined"
                    >
                        Daftar
                    </Link>
                </nav>

                <div class="auth-content">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
