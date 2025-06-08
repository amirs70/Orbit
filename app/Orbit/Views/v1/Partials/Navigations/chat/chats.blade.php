<li @click="$dispatch('badge-change')" class="nav-item dropdown dropstart">
    <a class="nav-link" data-bs-toggle="dropdown" href="#" data-bs-auto-close="outside">
        <i class="bi bi-chat"></i>
        @livewire("common.navigation.chat.count", ["navHandler" => $navHandler ?? 0])
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
        <a wire:click="hello" href="#" class="dropdown-item">
            <div class="d-flex">
                <div class="flex-shrink-0 img-size-50 rounded-circle text-center">
                    <img width="50px" src="{{ orbit_asset("/img/avatar2.png") }}">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h3 class="dropdown-item-title">Alex</h3>
                    <p class="fs-7">Hey, call me ASAP</p>
                    <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                    </p>
                </div>
            </div>
        </a>
        <div class="dropdown-divider"></div>

        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
    </div>
</li>
