import { Chats, User } from "@/Types"
import ChatPreview from "@/Components/ChatPreview"
import { Head } from "@inertiajs/react"

type Props = {
    chats: Chats,
    user: User
}

function Index({ chats, user }: Props) {
    return (
        <>
            <Head title="Chats"/>

            <div>
                <div>
                    {chats.map(chat => (
                        <ChatPreview chat={chat} key={chat.id} />
                    ))}
                </div>
            </div>
        </>
    )
}

export default Index;
