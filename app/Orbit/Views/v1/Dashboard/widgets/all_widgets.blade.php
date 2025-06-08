@php use App\Orbit\ui\dashboard\widget\EndWidget;use App\Orbit\ui\dashboard\widget\StartWidget;use App\Orbit\ui\dashboard\widget\TopWidget;use App\Orbit\ui\dashboard\widget\Widget; @endphp
<div class="widgets">
    @php($widgets = Widget::customizedSortForMe($user_id))
    <div class="container-fluid">
        <div class="row">
            <div id="top-widget" class="col">
                @foreach(TopWidget::getAll() as $wdgt)
                    @include("orbit::v1.Dashboard.widgets.sorted_widgets")
                @endforeach
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div id="start-widget" class="col">
                @foreach(StartWidget::getAll() as $wdgt)
                    @include("orbit::v1.Dashboard.widgets.sorted_widgets")
                @endforeach
            </div>
            <div id="end-widget" class="col">
                @foreach(EndWidget::getAll() as $wdgt)
                    @include("orbit::v1.Dashboard.widgets.sorted_widgets")
                @endforeach
            </div>
        </div>
    </div>
</div>
