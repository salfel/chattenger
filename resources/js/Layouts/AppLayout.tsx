import type { ReactNode } from 'react'

type Props = {
    children: ReactNode
}

export default function HomeLayout({ children }: Props) {
    return (
        <main className="min-h-screen bg-gray-900 text-gray-200">
            {children}
        </main>
   )
}
