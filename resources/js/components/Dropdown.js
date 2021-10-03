document.addEventListener("alpine:init", () => {
    Alpine.data("dropdown", () => ({
        open: false,

        toggle() {
            this.open = !this.open;
        },

        hide() {
            this.open = false;
        },
    }));
});
