@php use App\Orbit\ui\livewire\dashboard\AllWidget; @endphp
@extends("orbit::v1.template.sidebar_fixed")

@section("content")

    @livewire(AllWidget::class)

    <script>
        window.addEventListener("load", () => {
            $("#top-widget, #start-widget, #end-widget").each((i, e) => {
                if ($(e).children().length < 1) {
                    $(e).text("");
                }
            });
            const sendWidgets = (to_hidden) => {
                const widgets = {top: {}, start: {}, end: {}};

                $("#top-widget > .card").each((i, e) => {
                    widgets.top[i] = $(e).data("widget");
                });

                $("#start-widget > .card").each((i, e) => {
                    widgets.start[i] = $(e).data("widget");
                });

                $("#end-widget > .card").each((i, e) => {
                    widgets.end[i] = $(e).data("widget");
                });

                if (to_hidden && !Array.isArray(to_hidden)) {
                    to_hidden = [to_hidden];
                } else {
                    to_hidden = undefined
                }

                axios
                    .post("{{ route("orbit.ajax") }}", {
                        method: "dashboard.widget_change",
                        widgets: widgets,
                    })
                    .then(() => {
                        Livewire.dispatch("dashboard.widget_changed");
                    });
            };
            const changeHidden = (widget, hidden) => {
                axios
                    .post("{{ route("orbit.ajax") }}", {
                        method: "dashboard.widget_hide_or_show",
                        widget: widget,
                        hidden: hidden
                    })
                    .then(() => {
                        Livewire.dispatch("dashboard.widget_changed");
                    });
            };
            Livewire.on("dashboard.widget_checkboxes_loaded", function () {
                $("#widget-checkbox-container input[type='checkbox']").each(function () {
                    const th = $(this);
                    if (th.attr("checked") === undefined)
                        th.prop("checked", false);
                    else
                        th.prop("checked", true);
                });
            });
            const sorting = $("#top-widget, #start-widget, #end-widget");
            sorting.sortable({
                placeholder: "sortable-placeholder",
                revert: true,
                handle: ".sort-handler",
                connectWith: "#start-widget, #end-widget, #top-widget",
                start: () => {
                    sorting.css({
                        "min-height": 200,
                        /*"border": "2px solid #444"*/
                    });
                    $(".app-main").css("overflow-x", "hidden");
                    sorting.sortable("refresh");
                },
                stop: () => {
                    $(".app-main").css("overflow-x", "");
                    sorting.removeAttr("style");

                    sendWidgets();
                }
            });

            /*$(document).on("click", "#top-widget .remove, #start-widget .remove, #end-widget .remove", function () {
                $(this).parents(".card[data-widget]").fadeOut(function () {
                    changeHidden($(this).attr("data-widget"), true);
                    $(this).remove();
                });
            });*/
        });
    </script>
@endsection
