<!-- Deskripsi file: resources/js/Pages/Post/Create.vue -->
<!-- Komponen ini menyediakan formulir untuk menambah post baru. -->
<script setup>
// Layout dan helper Inertia digunakan untuk tampilan serta pengiriman formulir.
import Layout from '../../Layouts/App.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

// Menyimpan nilai input judul dan isi post beserta status error.
const form = useForm({
    title: '',
    content: '',
})

// Mengirim data formulir ke route penyimpanan pada controller.
function storePost() {
    form.post(route('posts.store'))
}
</script>

<template>
    <Layout>
        <Head title="Tambah data" />
        <section class="post-editor-page">
            <Link :href="route('posts.index')" class="post-back-link">
                <span aria-hidden="true">←</span> Kembali ke data
            </Link>

            <div class="post-editor-heading">
                <span class="posts-eyebrow">DATA BARU</span>
                <h1>Tambahkan ide Anda</h1>
                <p>Isi informasi di bawah ini untuk menyimpannya di ruang kerja Anda.</p>
            </div>

            <form class="post-editor-card" @submit.prevent="storePost">
                <div class="post-editor-card-heading">
                    <span class="post-editor-icon" aria-hidden="true">＋</span>
                    <div>
                        <h2>Informasi data</h2>
                        <p>Kolom bertanda wajib diisi.</p>
                    </div>
                </div>

                <div class="post-editor-field">
                    <label for="title">Judul <span>*</span></label>
                    <input
                        id="title"
                        v-model="form.title"
                        type="text"
                        required
                        autofocus
                        placeholder="Contoh: Ide untuk proyek baru"
                        :aria-invalid="Boolean(form.errors.title)"
                        :aria-describedby="form.errors.title ? 'title-error' : undefined"
                    >
                    <p v-if="form.errors.title" id="title-error" class="post-field-error">{{ form.errors.title }}</p>
                </div>

                <div class="post-editor-field">
                    <label for="content">Isi data <span>*</span></label>
                    <textarea
                        id="content"
                        v-model="form.content"
                        rows="7"
                        required
                        placeholder="Tuliskan detail atau catatan Anda di sini..."
                        :aria-invalid="Boolean(form.errors.content)"
                        :aria-describedby="form.errors.content ? 'content-error' : undefined"
                    ></textarea>
                    <p v-if="form.errors.content" id="content-error" class="post-field-error">{{ form.errors.content }}</p>
                </div>

                <div class="post-editor-actions">
                    <button type="button" class="post-button post-button-secondary" @click="form.reset()">
                        Kosongkan
                    </button>
                    <button type="submit" class="post-button post-button-primary" :disabled="form.processing">
                        {{ form.processing ? 'Menyimpan...' : 'Simpan data' }}
                        <span v-if="!form.processing" aria-hidden="true">→</span>
                    </button>
                </div>
            </form>
        </section>
    </Layout>
</template>
