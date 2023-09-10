<script context="module">
    export { default as layout } from '@/Layouts/HomeLayout.svelte'
</script>

<script lang="ts">
    import ChatPreview from '@/Components/ChatPreview.svelte';
    import type { Chats } from '@/Types';

    export let chats: Chats;

    console.log(chats)
</script>

<div>
    {#each chats as chat}
        <ChatPreview {chat} />
    {/each}
</div>
