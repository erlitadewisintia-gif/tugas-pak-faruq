<!-- Deskripsi file: resources/js/Layouts/App.vue -->
<script setup>
// Komponen Link digunakan untuk navigasi Inertia tanpa memuat ulang halaman.
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="app-shell">
        <nav class="app-nav">
            <div class="app-nav-inner">
                <!-- Logo aplikasi mengarahkan pengguna ke Dashboard. -->
                <Link class="app-brand" :href="route('dashboard')">
                    <span class="app-brand-mark" aria-hidden="true">R</span>
                    <span>Ruang Data</span>
                </Link>

                <div class="app-nav-links">
                    <!-- Menu Dashboard untuk kembali ke halaman utama setelah login. -->
                    <Link :href="route('dashboard')" :class="{ 'is-active': route().current('dashboard') }">
                        Dashboard
                    </Link>
                    <!-- Menu Data saya menampilkan seluruh post milik pengguna. -->
                    <Link :href="route('posts.index')" :class="{ 'is-active': route().current('posts.index') }">
                        Data saya
                    </Link>
                    <Link :href="route('posts.create')" class="app-nav-create">
                        <span aria-hidden="true">＋</span> Tambah data
                    </Link>
                </div>

                <div v-if="$page.props.auth?.user" class="app-user">
                    <span class="app-user-avatar" aria-hidden="true">
                        {{ $page.props.auth.user.name?.charAt(0)?.toUpperCase() }}
                    </span>
                    <span class="app-user-name">{{ $page.props.auth.user.name }}</span>
                    <Link :href="route('profile.edit')" class="app-profile-link">Profil</Link>
                    <Link href="/logout" method="post" as="button" class="app-logout">Keluar</Link>
                </div>
            </div>
        </nav>

        <main class="app-main">
            <slot />
        </main>

        <footer class="app-footer">
            <span>Ruang Data</span>
            <span>Ruang sederhana untuk ide dan data Anda.</span>
        </footer>
    </div>
</template>