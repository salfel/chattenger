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

function Show({ chat, user }: Props) {
    const container = useRef<HTMLDivElement>(null);
    const [messages, setMessages] = useState(chat.messages);
    const [users, setUsers] = useState<User[]>([]);

    useEffect(() => {
        container.current?.scrollTo({ top: container.current?.scrollHeight });
    }, [messages])

    useEffect(() => {
        Echo.join(`chats.${chat.id}`)
            .here((users: User[]) => {
                setUsers(users);
            })
            .joining((user: User) => {
                setUsers(users => [...users, user])
            })
            .leaving((user: User) => {
                setUsers(users => users.filter(_user => user.id !== _user.id))
            })
            .listen('MessageSent', function(e: { message: MessageType }) {
                setMessages(messages => [
                    ...messages,
                    e.message
                ])
            })

        return () => Echo.leaveAllChannels()
    }, [])

    return (
        <>
            <Head title={`Chat | ${chat.user.name}`} />

            <div className="h-screen flex flex-col">
                <Header active={!!users.find((user) => chat.user.id === user.id)} user={chat.user} />
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
