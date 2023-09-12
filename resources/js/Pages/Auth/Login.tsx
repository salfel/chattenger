import FormInput from "@/Components/FormInput";
import { useForm } from "@inertiajs/react";
import type { FormEvent } from "react";
import route from "ziggy-js";

function Login() {
    const form = useForm({
        email: 'felix.salcher@gmail.com',
        password: 'password'
    })

    function handleSubmit(e: FormEvent<HTMLFormElement>) {
        e.preventDefault();
        form.post(route('auth.authenticate'))
    }

    return (
        <form onSubmit={handleSubmit} className="flex flex-col gap-5">
            <div className="mb-3">
                <h1 className="text-3xl font-semibold mb-1">Login</h1>
                <p className="text-gray-400">to access your chats and messages</p>
            </div>

            <FormInput name="Email" value={form.data.email} onChange={e => form.setData('email', e.target.value)} error={form.errors.email} placeholder="email@example.com" />
            <FormInput name="Password" value={form.data.password} onChange={e => form.setData('password', e.target.value)} error={form.errors.password} type="password" />

            <button type="submit" className="px-5 py-2 bg-blue-500 rounded-xl">
                Login
            </button>
        </form>
    )
}

export default Login;
