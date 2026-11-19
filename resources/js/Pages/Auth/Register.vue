<!-- Deskripsi file: resources/js/Pages/Auth/Register.vue -->
<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Daftar" />

        <div class="auth-heading">
            <span class="auth-heading-icon" aria-hidden="true">+</span>
            <h2>Buat akun baru</h2>
            <p>Mulai kelola data Anda dengan lebih mudah.</p>
        </div>

        <form @submit.prevent="submit" class="auth-form">
            <div class="auth-field">
                <InputLabel for="name" value="Nama lengkap" />
                <TextInput
                    id="name"
                    type="text"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Nama Anda"
                />
                <InputError class="auth-error" :message="form.errors.name" />
            </div>

            <div class="auth-field">
                <InputLabel for="email" value="Alamat email" />
                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autocomplete="username"
                    placeholder="nama@email.com"
                />
                <InputError class="auth-error" :message="form.errors.email" />
            </div>

            <div class="auth-field">
                <InputLabel for="password" value="Kata sandi" />
                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                    placeholder="Minimal 8 karakter"
                />
                <InputError class="auth-error" :message="form.errors.password" />
            </div>

            <div class="auth-field">
                <InputLabel for="password_confirmation" value="Ulangi kata sandi" />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Masukkan ulang kata sandi"
                />
                <InputError class="auth-error" :message="form.errors.password_confirmation" />
            </div>

            <PrimaryButton class="auth-submit" :class="{ 'is-loading': form.processing }" :disabled="form.processing">
                {{ form.processing ? 'Memproses...' : 'Buat akun' }}
            </PrimaryButton>
        </form>

        <p class="auth-footer">
            Sudah punya akun?
            <Link :href="route('login')" class="auth-text-link">Masuk di sini</Link>
        </p>
    </GuestLayout>
</template>
