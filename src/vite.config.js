// import { defineConfig } from "vite";
// import laravel from "laravel-vite-plugin";
// import tailwindcss from "@tailwindcss/vite";

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ["resources/sass/app.scss", "resources/js/app.js"],
//             refresh: true,
//         }),
//         tailwindcss(),
//     ],
// });

import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    server: {
        host: "0.0.0.0", // Accept connections from anywhere
        port: 5173, // Same as the one exposed in docker-compose
        strictPort: true,
        hmr: {
            host: "localhost", // or your host IP on the network
            port: 5173,
        },
    },
    plugins: [
        laravel({
            input: ["resources/sass/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
