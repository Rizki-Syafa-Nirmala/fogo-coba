<?php
use EragLaravelPwa\EragLaravelPwaServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\Filament\MitraPanelProvider::class,
    EragLaravelPwaServiceProvider::class,

];
