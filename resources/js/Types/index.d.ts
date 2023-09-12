export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};

type Model = {
    id: string;
    created_at: string;
    updated_at: string;
}

export type User = Model & {
    name: string;
    email: string;
    profile_picture: string;
}

export type Message = Model & {
    body: string;
    author: User;
}

export type Chat = Model & {
    user: User,
    messages: Message[]
}

export type Chats = Chat[]
