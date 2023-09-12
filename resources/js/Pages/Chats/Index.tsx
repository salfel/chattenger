import { Chats, User } from "@/Types"
import ChatPreview from "@/Components/ChatPreview"
import Header from "@/Components/Header"
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
                <Header user={user} />
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
