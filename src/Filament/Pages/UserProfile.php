<?php

namespace LaraZeus\Erebus\Filament\Pages;

use Filament\Pages\Page;

class UserProfile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'zeus-erebus::filament.user.pages.user-profile';
}
