import type { Chat } from '@/Types'
import { Link } from '@inertiajs/react'
import route from 'ziggy-js'
import { UserCircleIcon } from '@heroicons/react/24/solid'

type Props = {
    chat: Chat
}

export default function ChatPreview({ chat }: Props) {
    return (
        <div className="flex items-center gap-5 px-5 py-3 border border-gray-700">
            {chat.user.profile_picture
                ? <img src={chat.user.profile_picture} className="h-10 w-10" alt={chat.user.name}/>
                : <UserCircleIcon className="text-gray-400 h-10 w-10" />
            }
            <div>
                <Link href={route('chats.show', [chat.id])} className="block text-lg font-medium">{chat.user.name}</Link>
                <span className="block text-gray-300 max-w-[50ch] truncate">{chat.messages[0].body}</span>
            </div>
        </div>
   )
}
