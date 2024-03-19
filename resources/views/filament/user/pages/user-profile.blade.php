<x-filament::page>
    <div x-data="{ activeTab: 'main-info' }">
        <x-filament::tabs label="Content tabs">
            <x-filament::tabs.item
                    alpine-active="activeTab === 'main-info'"
                    x-on:click="activeTab = 'main-info'"
            >
                {{ __('main info') }}
            </x-filament::tabs.item>

            <x-filament::tabs.item
                    alpine-active="activeTab === 'preference'"
                    x-on:click="activeTab = 'preference'">
                {{ __('preference') }}
            </x-filament::tabs.item>

            <x-filament::tabs.item
                    alpine-active="activeTab === 'login'"
                    x-on:click="activeTab = 'login'">
                {{ __('login info') }}
            </x-filament::tabs.item>
        </x-filament::tabs>

        <div x-show="activeTab === 'main-info'">
            <div class="space-y-6 divide-y divide-gray-900/10 dark:divide-white/10">
                @livewire('Jeffgreco13\FilamentBreezy\Livewire\PersonalInfo')
            </div>
        </div>
        <div x-show="activeTab === 'preference'">
            preference
        </div>
        <div x-show="activeTab === 'login'">
            @livewire('Jeffgreco13\FilamentBreezy\Livewire\UpdatePassword')
            @livewire('Jeffgreco13\FilamentBreezy\Livewire\TwoFactorAuthentication')
        </div>
    </div>
</x-filament::page>
