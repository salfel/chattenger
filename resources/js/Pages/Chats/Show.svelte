<script context="module">
    export { default as layout } from '@/Layouts/HomeLayout.svelte'
</script>

<script lang="ts">
    import type { Chat, Message as MessageType } from '@/Types';
    import Message from '@/Components/Message.svelte';
    import SendMessage from '@/Components/SendMessage.svelte';
    import { ChatBubbleOvalLeftEllipsis, Icon, UserCircle } from 'svelte-hero-icons'
    import { Link } from '@inertiajs/svelte'
    import route from 'ziggy-js';
    import { afterUpdate } from 'svelte';

    export let chat: Chat;
    // export let user: User;

    let container: HTMLElement;

    afterUpdate(() => {
        setTimeout(() => container.scrollTo({ top: container.scrollHeight }), 0)
    })

    Echo.private(`chats.${chat.id}`)
        .listen('MessageSent', function(e: { message: MessageType }) {
            console.log(e.message)
        })
</script>

<svelte:head>
    <title>Chat | {chat.user.name}</title>
</svelte:head>

<div class="h-screen flex flex-col">
    <div class="flex justify-between bg-gray-800 px-12 py-4">
        <div class="flex items-center gap-3">
            {#if chat.user.profile_picture}
                <img src={chat.user.profile_picture} class="h-8 w-8" alt={chat.user.name} />
            {:else}
                <Icon src={UserCircle} solid class="text-gray-400 h-10 w-10" />
            {/if}

            <h1 class="text-gray-100 font-bold text-xl">{chat.user.name}</h1>
        </div>

        <div class="flex items-center gap-8">
            <!-- Link will be provided when route created -->
            <Link class="font-semibold text-lg hover:underline">
                Profile
            </Link>

            <Link href={route('chats.index')}>
                <Icon src={ChatBubbleOvalLeftEllipsis} alt="Chattenger" class="w-8 h-8" />
            </Link>
        </div>
    </div>

    <div class="pt-6 flex-1 overflow-y-auto" bind:this={container} scroll-region>
        {#each chat.messages as message}
            <Message {message} />
        {/each}
    </div>

    <SendMessage {chat} />
</div>
