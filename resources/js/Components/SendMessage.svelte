<script lang="ts">
    import type { Chat, Message, User } from "@/Types";
    import { router, page } from '@inertiajs/svelte'
    import { Icon, PaperAirplane } from "svelte-hero-icons";
    import { messages } from "@/utils/stores";
    import route from "ziggy-js";

    export let chat: Chat;

    let message: string = '';

    function handleSubmit() {
        router.post(route('messages.store'), {
            body: message,
            messagable_id: chat.id,
            messagable_type: 'App\\Models\\Chat'
            }, {
                preserveScroll: true,
                onBefore: () => {
                    $messages = [
                        ...$messages,
                        {
                            id: '',
                            body: message,
                            updated_at: new Date().toString(),
                            created_at: new Date().toString(),
                            author: $page.props.user as User
                        }
                    ]
                },
                onFinish: () => {
                    message = '';
                    $messages = $page.props.chat.messages
                }
            })
    }
</script>

<form on:submit|preventDefault={handleSubmit} class="flex items-center gap-3 bg-gray-800 px-5 py-3">
    <input
        type="text"
        class="w-full px-5 py-1.5 outline-1 outline outline-gray-600 text-gray-300 rounded-full bg-transparent"
        placeholder="Type..."
        bind:value={message}
    />
    <button type="submit" class="p-3 bg-blue-500 outline outline-1 outline-gray-600 rounded-full">
        <Icon src={PaperAirplane} class="h-5 w-5" />
    </button>
</form>
