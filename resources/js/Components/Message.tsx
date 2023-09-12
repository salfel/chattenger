import type { Message, User } from "@/Types"
import { usePage } from '@inertiajs/react'

type Props = {
    message: Message
}

export default function Message({ message }: Props) {
    const page = usePage();

    return (
        <div className="w-full px-6 flex">
            <div className={`px-5 py-3 rounded-full ${message.author.id === (page.props.user as User).id ? 'ml-auto bg-blue-500' : 'bg-gray-700'}`} >
                {message.body}
            </div>
        </div>
   )
}
