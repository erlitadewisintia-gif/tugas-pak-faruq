<!-- Deskripsi file: resources/js/Pages/Post/Edit.vue -->
<!-- Komponen ini menyediakan formulir untuk memperbarui post yang dipilih. -->
<script setup>
import { useForm } from '@inertiajs/vue3'
import Layout from '../../Layouts/App.vue'
import { Head, Link } from '@inertiajs/vue3'

// Menerima data post yang akan diedit dari controller Laravel.
const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
})

// Mengisi formulir menggunakan nilai post yang sudah ada.
const form = useForm({
    title: props.post.title,
    content: props.post.content,
})

// Mengirim pembaruan post ke route berdasarkan ID post.
function updatePost() {
    form.put(route('posts.update', props.post.id))
}
</script>

<template>
    <Layout>
        <Head title="Edit data" />
        <section class="post-editor-page">
            <Link :href="route('posts.index')" class="post-back-link">
                <span aria-hidden="true">←</span> Kembali ke data
            </Link>

            <div class="post-editor-heading">
                <span class="posts-eyebrow">PERBARUI DATA</span>
                <h1>Edit informasi</h1>
                <p>Perbarui judul atau isi data Anda, lalu simpan perubahan.</p>
            </div>

            <form class="post-editor-card" @submit.prevent="updatePost">
                <div class="post-editor-card-heading">
                    <span class="post-editor-icon" aria-hidden="true">✎</span>
                    <div>
                        <h2>Informasi data</h2>
                        <p>Perubahan akan disimpan ke ruang kerja Anda.</p>
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
                        placeholder="Masukkan judul"
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
                    <Link :href="route('posts.index')" class="post-button post-button-secondary">
                        Batal
                    </Link>
                    <button type="submit" class="post-button post-button-primary" :disabled="form.processing">
                        {{ form.processing ? 'Menyimpan...' : 'Simpan perubahan' }}
                        <span v-if="!form.processing" aria-hidden="true">→</span>
                    </button>
                </div>
            </form>
        </section>
    </Layout>
</template>
