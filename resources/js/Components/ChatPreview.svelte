<script lang="ts">
    import type { Chat } from "@/Types";
    import { Link } from '@inertiajs/svelte'
    import route from "ziggy-js";
    import { Icon, UserCircle } from 'svelte-hero-icons'

    export let chat: Chat;
</script>

<div class="flex items-center gap-5 px-5 py-3 border border-gray-800">
    {#if chat.user.profile_picture}
        <img src={chat.user.profile_picture} class="h-10 w-10" alt={chat.user.name} />
    {:else}
        <Icon src={UserCircle} solid class="text-gray-400 h-10 w-10" />
    {/if}
    <div>
        <Link href={route('chats.show', [chat.id])} class="block text-lg font-medium">{chat.user.name}</Link>
        <span class="block text-gray-300 max-w-[50ch] truncate">{chat.messages[0].body}</span>
    </div>
</div>
