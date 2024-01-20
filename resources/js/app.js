import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

if (!window.Livewire) {
    window.Livewire.start();
}

Alpine.start();
