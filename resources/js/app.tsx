import './bootstrap';
import { createInertiaApp } from '@inertiajs/react'
import { createRoot } from 'react-dom/client'
import AuthLayout from '@/Layouts/AuthLayout';
import AppLayout from '@/Layouts/AppLayout'
import '../css/app.css'

createInertiaApp({
    progress: false,
	resolve: name => {
		const pages = import.meta.glob('./Pages/**/*.tsx', {eager: true})
        let page = pages[`./Pages/${name}.tsx`];
        // @ts-ignore
        page.default.layout = (page: string) => name.startsWith('Auth') ? <AuthLayout children={page} /> : <AppLayout children={page} />
		return page;
	},
	setup({el, App, props}) {
		createRoot(el).render(<App {...props} />)
	},
})
