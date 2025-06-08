<li class="nav-item dropdown dropstart">
    <a class="nav-link" data-bs-toggle="dropdown" href="#" data-bs-auto-close="outside">
        <i class="bi bi-window-dock"></i>
    </a>
    <div id="widget-checkbox-container" class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
        <p href="#" class="dropdown-header">All Widgets</p>
        @foreach($widgetsState as $handler => $state)
            <div class="dropdown-divider"></div>
            <label href="#" class="dropdown-item">
                <div class="d-flex">
                    <div class="flex-shrink-0 rounded-circle text-center">
                        <div class="form-check form-switch">
                            <input
                                    @checked($state["enabled"])
                                    class="form-check-input widget-switch"
                                    type="checkbox"
                                    id="switch-{{ $handler }}">
                            <label class="form-check-label float-end" for="switch-{{ $handler }}">{{ $state["title"] }}</label>
                        </div>
                    </div>
                </div>
            </label>
        @endforeach
    </div>

    <script>
        window.addEventListener("load", () => {
            const changeHidden2 = (widget, hidden) => {
                axios
                    .post("{{ route("orbit.ajax") }}", {
                        method: "dashboard.widget_hide_or_show",
                        widget: widget,
                        hidden: hidden
                    })
                    .then(() => {
                        Livewire.dispatch("dashboard.widget_changed_from_top");
                    });
            };
            $(document).on("click", ".widget-switch", function () {
                changeHidden2($(this).attr("id").replace("switch-", ""), !$(this).is(":checked"));
            });
        });
    </script>
</li>
