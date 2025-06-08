<li class="nav-item">
    <a wire:click.prevent="toggle" href="#" class="nav-link">
        <i class="bi bi-{{ $is_dark ? "sun" : "moon-stars" }}"></i>
    </a>
</li>

<script>
    document.addEventListener("livewire:init", () => {
        let html = document.getElementsByTagName("html")[0];
        Livewire.on("themeSelector.toggle", (is_dark) => {
            console.log(html);
            const theme = parseInt(is_dark) === 1 ? "dark" : "light";
            html.setAttribute("data-bs-theme", theme);
        });
    });
</script>
