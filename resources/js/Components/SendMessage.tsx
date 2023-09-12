import type { Chat, Message, User } from "@/Types";
import { router, usePage } from '@inertiajs/react'
import { PaperAirplaneIcon } from '@heroicons/react/24/solid'
import { useState, type FormEvent, useRef } from 'react'
import route from "ziggy-js";

type Props = {
    chat: Chat,
    onMessageSend: (message: Message) => void
}

export default function SendMessage({ chat, onMessageSend }: Props) {
    const [message, setMessage] = useState('');
    const page = usePage();

    function handleSubmit(e: FormEvent<HTMLFormElement>) {
        e.preventDefault();
        router.post(route('messages.store'), {
            body: message,
            messagable_id: chat.id,
            messagable_type: 'App\\Models\\Chat'
        }, {
            preserveScroll: true,
            onBefore() {
                onMessageSend({
                    id: '',
                    body: message,
                    updated_at: new Date().toString(),
                    created_at: new Date().toString(),
                    author: page.props.user as User
                })
            },
            onFinish() {
                setMessage('');
            }
        })
    }

    return (
        <form onSubmit={handleSubmit} className="flex items-center gap-3 bg-gray-800 px-5 py-3">
            <input
                type="text"
                className="w-full px-5 py-1.5 outline outline-1 outline-gray-600 text-gray-300 rounded-full bg-transparent"
                placeholder="Type..."
                value={message}
                onChange={e => setMessage(e.target.value)}
            />
            <button type="submit" className="p-3 bg-blue-500 outline outline-1 outline-gray-600 rounded-full">
                <PaperAirplaneIcon className="h-5 w-5" />
            </button>
        </form>
    )
}
