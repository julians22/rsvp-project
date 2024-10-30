/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'navy': '#182e55',
            }
        },
    },
    plugins: [

        require('@tailwindcss/forms'),

    ],
}

