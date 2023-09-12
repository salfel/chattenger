import { type InputHTMLAttributes } from 'react'

type Props = InputHTMLAttributes<HTMLInputElement> & {
    error?: string,
    name: string,
}

export default function FormInput({ error, name, value, ...props }: Props) {
    return (
        <label>
            <span className="block mb-2 text-sm">{name}</span>
            <input {...props} className="w-80 px-5 py-2 ring-1 ring-gray-400 focus:ring-blue-600 transition-colors duration-300 bg-transparent focus:outline-none rounded-xl" />
            {error && (
                <span className="block text-sm mt-2 text-red-500">{error}</span>
            )}
        </label>
    )
}
