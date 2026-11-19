<!-- Deskripsi file: resources/js/Pages/Auth/Login.vue -->
<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Masuk" />

        <div class="auth-heading">
            <span class="auth-heading-icon" aria-hidden="true">↗</span>
            <h2>Masuk ke akun Anda</h2>
            <p>Lanjutkan mengelola data dan ide Anda.</p>
        </div>

        <div v-if="status" class="auth-status">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="auth-form">
            <div class="auth-field">
                <InputLabel for="email" value="Alamat email" />

                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
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
                    autocomplete="current-password"
                    placeholder="Masukkan kata sandi"
                />

                <InputError class="auth-error" :message="form.errors.password" />
            </div>

            <div class="auth-options">
                <label class="auth-remember">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span>Ingat saya</span>
                </label>

                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="auth-text-link"
                >
                    Lupa kata sandi?
                </Link>
            </div>

            <PrimaryButton class="auth-submit" :class="{ 'is-loading': form.processing }" :disabled="form.processing">
                {{ form.processing ? 'Memproses...' : 'Masuk ke akun' }}
            </PrimaryButton>
        </form>

        <p class="auth-footer">
            Belum punya akun?
            <Link :href="route('register')" class="auth-text-link">Daftar sekarang</Link>
        </p>
    </GuestLayout>
</template>