import { AxiosInstance } from "axios";
import Pusher from "pusher-js";
import Echo from "laravel-echo";

declare global {
    interface Window {
        axios: AxiosInstance,
    }

    var Echo: Echo,
    var Pusher: Pusher,
}
