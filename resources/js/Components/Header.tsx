import { User } from "@/Types"
import { Link } from "@inertiajs/react"
import { ChatBubbleOvalLeftEllipsisIcon } from '@heroicons/react/24/outline'
import { UserCircleIcon } from '@heroicons/react/24/solid'
import route from 'ziggy-js'

type Props = {
    user: User
}

export default function Header({ user }: Props) {
    return (
        <div className="flex justify-between bg-gray-800 px-12 py-4">
            <div className="flex items-center gap-3">
                {user.profile_picture
                    ? <img src={user.profile_picture} className="h-8 w-8" alt={user.name} />
                    : <UserCircleIcon className="text-gray-400 h-10 w-10" />
                }

                <h1 className="text-gray-100 font-bold text-xl">{user.name}</h1>
            </div>

            <div className="flex items-center gap-8">
                <Link className="font-semibold text-lg hover:underline" href="">
                    Profile
                </Link>

                <Link href={route('chats.index')}>
                    <ChatBubbleOvalLeftEllipsisIcon className="w-8 h-8" />
                </Link>
            </div>
        </div>
   )
}
