const plugin = require("tailwindcss/plugin");
const rotate = plugin(function ({ addUtilities }) {
    addUtilities({
        ".rotate-x-180": {
            transform: "rotateX(180deg)",
        },
        ".rotate-y-180": {
            transform: "rotateY(180deg)",
        },
    });
});

const zindex = plugin(function ({ addUtilities }) {
    addUtilities({
        ".-z-1": {
            "z-index": -1,
        },
    });
});

module.exports = {
    purge: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            height: {
                160: "640px",
            },
            colors: {
                primary: "#ff5a5d",
            },
        },
    },
    variants: {
        extend: {},
    },
    plugins: [rotate, zindex, require("@tailwindcss/custom-forms")],
};
