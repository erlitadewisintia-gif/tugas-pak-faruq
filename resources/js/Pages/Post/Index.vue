<!-- Deskripsi file: resources/js/Pages/Post/Index.vue -->
<!-- Komponen ini menampilkan, mencari, mengedit, dan menghapus daftar post. -->
<script setup>
// computed digunakan untuk pencarian dan ref menyimpan kata kunci pencarian.
import { computed, ref } from 'vue'
// Layout dan komponen Inertia membentuk halaman serta navigasi.
import Layout from '../../Layouts/App.vue'
import { Head, Link, router } from '@inertiajs/vue3'

// Menerima daftar post dari controller Laravel sebagai properti komponen.
const props = defineProps({
    posts: {
        type: Array,
        default: () => [],
    },
})

// Menyimpan kata kunci pencarian pengguna.
const search = ref('')

// Menghasilkan daftar post yang cocok dengan kata kunci pencarian.
const filteredPosts = computed(() => {
    const query = search.value.trim().toLowerCase()

    if (!query) {
        return props.posts
    }

    return props.posts.filter((post) =>
        `${post.title} ${post.content}`.toLowerCase().includes(query),
    )
})

// Meminta konfirmasi lalu menghapus post melalui route Inertia.
function deletePost(id) {
    if (window.confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        router.delete(`/posts/${id}`)
    }
}
</script>

<template>
    <Layout>
        <Head title="Data saya" />
        <section class="posts-page">
            <div class="posts-heading">
                <div>
                    <span class="posts-eyebrow">RUANG KERJA</span>
                    <h1>Data saya</h1>
                    <p>Atur tulisan dan ide Anda dalam satu tempat.</p>
                </div>
                <Link :href="route('posts.create')" class="post-button post-button-primary">
                    <span aria-hidden="true">＋</span> Tambah data
                </Link>
            </div>

            <div v-if="$page.props.flash?.message" class="post-alert" role="status">
                <span class="post-alert-icon" aria-hidden="true">✓</span>
                {{ $page.props.flash.message }}
            </div>

            <div class="posts-panel">
                <div class="posts-toolbar">
                    <div>
                        <h2>Semua data</h2>
                        <span>{{ posts.length }} item tersimpan</span>
                    </div>
                    <label class="posts-search">
                        <span aria-hidden="true">⌕</span>
                        <input v-model="search" type="search" placeholder="Cari judul atau isi..." aria-label="Cari data">
                    </label>
                </div>

                <div v-if="filteredPosts.length" class="posts-table-wrap">
                    <table class="posts-table">
                        <thead>
                            <tr>
                                <th>JUDUL</th>
                                <th>ISI</th>
                                <th class="posts-actions-heading">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="post in filteredPosts" :key="post.id">
                                <td class="post-title-cell">{{ post.title }}</td>
                                <td class="post-content-cell">{{ post.content }}</td>
                                <td class="posts-actions-cell">
                                    <Link :href="route('posts.edit', post.id)" class="post-action-link">Edit</Link>
                                    <button type="button" class="post-action-delete" @click="deletePost(post.id)">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div v-else class="posts-empty">
                    <span class="posts-empty-icon" aria-hidden="true">{{ search ? '⌕' : '＋' }}</span>
                    <h3>{{ search ? 'Data tidak ditemukan' : 'Belum ada data' }}</h3>
                    <p>{{ search ? 'Coba kata kunci lain untuk menemukan data.' : 'Mulai dengan menambahkan tulisan atau ide pertama Anda.' }}</p>
                    <Link v-if="!search" :href="route('posts.create')" class="post-button post-button-primary">
                        Tambah data pertama
                    </Link>
                </div>
            </div>
        </section>
    </Layout>
</template>