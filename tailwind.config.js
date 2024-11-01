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
                'red-bni': '#bd2232'
            }
        },
    },
    plugins: [

        require('@tailwindcss/forms'),

    ],
}

