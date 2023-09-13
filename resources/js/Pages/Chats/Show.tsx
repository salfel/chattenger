import type { Chat, Message as MessageType, User } from '@/Types/index'
import Message from '@/Components/Message'
import SendMessage from '@/Components/SendMessage'
import { Head } from '@inertiajs/react'
import { useEffect, useRef, useState } from 'react'
import Header from '@/Components/Header'

type Props = {
    chat: Chat,
    user: User
}

function listenToEcho() {
    let listened = false;

    return () => {
        if (!listened) {
            listened = true;

        }
    }
}

function Show({ chat, user }: Props) {
    const container = useRef<HTMLDivElement>(null);
    const [messages, setMessages] = useState(chat.messages);

    useEffect(() => {
        container.current?.scrollTo({ top: container.current?.scrollHeight });
    }, [messages])

    useEffect(() => {
        Echo.private(`chats.${chat.id}`)
            .listen('MessageSent', function(e: { message: MessageType }) {
                if (e.message.author.id !== user.id) {
                    setMessages(messages => [
                        ...messages,
                        e.message
                    ])
                }
            })

        return () => Echo.leaveChannel(`chats.${chat.id}`)
    }, [])


    return (
        <>
            <Head title={`Chat | ${chat.user.name}`} />

            <div className="h-screen flex flex-col">
                <Header user={chat.user} />
                <div className="py-6 flex-1 overflow-y-auto" ref={container}>
                    <div className="min-h-full flex flex-col justify-end gap-5" scroll-region="true" ref={container}>
                        {messages.map(message =>
                            <Message message={message} key={message.id} />
                        )}
                    </div>
                </div>

                <SendMessage chat={chat} onMessageSend={message => setMessages(messages => [...messages, message])} />
            </div>
        </>
    )
}

export default Show;
