import './bootstrap';
import { createApp } from "vue";

// import App from "./App.vue";

const app = createApp({})
Object.entries(import.meta.glob("./**/*.vue", { eager: true })).forEach(
    ([path, definition]) => {
        app.component(
            path
                .split("/")
                .pop()
                .replace(/\.\w+$/, ""),
            definition.default
        );
    }
);
   
app.mount("#app");