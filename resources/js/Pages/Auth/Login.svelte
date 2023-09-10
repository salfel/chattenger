<script context="module">
    export { default as layout } from '@/Layouts/AuthLayout.svelte'
</script>

<script lang="ts">
    import { useForm } from '@inertiajs/svelte'
    import route from 'ziggy-js';
    import FormInput from '@/Components/FormInput.svelte';

    const form = useForm({
        email: '',
        password: ''
    })

    $: console.log($form)

    function handleSubmit() {
        $form.post(route('auth.authenticate'))
    }
</script>

<form on:submit|preventDefault={handleSubmit} class="flex flex-col gap-5">
    <div class="mb-3">
        <h1 class="text-4xl font-semibold mb-1">Login</h1>
        <p class="text-gray-400">to access your chats and messages</p>
    </div>

    <FormInput name="Email" bind:value={$form.email} error={$form.errors.email} placeholder="example@email.com"/>
    <FormInput name="Password" type="password" bind:value={$form.password} error={$form.errors.password} placeholder="●●●●●"/>

    <button class="px-5 py-2 bg-blue-500 rounded-xl" type="submit">
        Login
    </button>
</form>
