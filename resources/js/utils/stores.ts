import type { Message } from "@/Types";
import { writable } from "svelte/store";

export const messages = writable<Message[]>([])
