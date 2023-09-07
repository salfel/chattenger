<script lang="ts">
    import type { Message } from "@/Types";
    import { page } from '@inertiajs/svelte'

    export let message: Message;
</script>

<div class="w-full my-5 px-6 flex">
    <div class="px-5 py-3 rounded-full {message.author.id === $page.props.user.id ? 'ml-auto bg-blue-500' : 'bg-gray-700'}">
        {message.body}
    </div>
</div>
