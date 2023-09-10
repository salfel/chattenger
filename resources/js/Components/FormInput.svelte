<script lang="ts">
    import { onMount } from "svelte";

    export let error: string;
    export let name: string;
    export let value: string;
    export let placeholder: string = '';
    export let type: string = 'text';

    let input: HTMLInputElement;

    onMount(() => {
        input.type = type;
    })
</script>

<label>
    <span class="block mb-1 text-sm">{name}</span>
    <input bind:this={input} bind:value={value} class="w-80 px-5 py-2 ring-1 ring-gray-400 bg-transparent focus:outline-none rounded-xl" {placeholder}/>
    {#if error}
        <span class="block text-sm mt-2 text-red-500">{error}</span>
    {/if}
</label>
