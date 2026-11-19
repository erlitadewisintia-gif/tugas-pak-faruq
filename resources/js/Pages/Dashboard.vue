<!-- Deskripsi file: resources/js/Pages/Dashboard.vue -->
<!-- Komponen ini menampilkan halaman dashboard setelah pengguna berhasil login. -->
<script setup>
// Layout aplikasi membungkus Dashboard dengan navigasi dan footer Ruang Data.
import Layout from '@/Layouts/App.vue';
// Head mengatur judul halaman pada tab browser.
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <!-- Menetapkan judul halaman dashboard. -->
    <Head title="Dashboard" />

    <!-- Menampilkan halaman utama pengguna di dalam layout aplikasi. -->
    <Layout>
        <section class="posts-page">
            <div class="posts-heading">
                <div>
                    <span class="posts-eyebrow">RUANG KERJA</span>
                    <h1>Dashboard</h1>
                    <p>Kelola data dan ide Anda dari satu tempat.</p>
                </div>
            </div>

            <div class="posts-panel">
                <div class="posts-toolbar">
                    <div>
                        <h2>Selamat datang kembali</h2>
                        <span>Pilih menu Data saya untuk melihat atau mengubah catatan Anda.</span>
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>
