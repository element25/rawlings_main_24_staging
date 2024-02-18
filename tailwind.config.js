/** @type {import("tailwindcss").Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./app/Models/**/*.php"
    ],
    theme: {
        extend: {
            colors: {
                "rawl-purple": {
                    DEFAULT: "#7a7ade",
                    pale: "#b3b3ec",
                    dark: "#292833"
                },
                "rawl-blue": {
                    DEFAULT: "#45b5cf"
                },
                "rawl-yellow": {
                    DEFAULT: "#baee62"
                },
                "rawl-green": {
                    DEFAULT: "#42d1b5"
                },
                "rawl-white": {
                    DEFAULT: "#fff"
                },
                "rawl-gray": {
                    DEFAULT: "#788194",
                    pale: "#949EB3"
                }
            },
            fontFamily: {
                "gilroy": ["Gilroy", "sans-serif"],
                "open": ["Open Sans", "sans-serif"],
                "roboto": ["Roboto Slab", "serif"]
            },
            fontSize: {
                "xxs": "0.7rem",
                "md": "1.1rem"
            },
            lineHeight: {
                "2": "0.5rem"
            },
            borderWidth: {
                "3": "3px"
            }
        }
    },
    plugins: [
        require("@tailwindcss/typography"),
        require("@tailwindcss/forms")
    ],
    safelist: [
        "text-teal-700",
        "text-yellow-400",
        "text-amber-700",
        "text-rose-700",
        "text-indigo-700"
    ]
};
