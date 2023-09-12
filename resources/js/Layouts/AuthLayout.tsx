import type { ReactNode } from 'react'

type Props = {
    children: ReactNode
}

export default function AuthLayout({ children }: Props) {
    return (
        <main className="h-screen grid place-items-center bg-gray-900 text-gray-200">
            <div className="px-12 py-8 border border-gray-400/70 rounded-xl shadow-2xl shadow-gray-800/95">
                {children}
            </div>
        </main>
    )
}
