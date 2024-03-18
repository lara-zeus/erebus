---
title: Setup
weight: 2
---

## Setup Erebus

to install Erebus, use the command:

`php artisan erebus:install`

The install command will publish the migrations.

## Register Erebus with Filament:

To set up the plugin with filament, you need to add it to your panel provider; The default one is `adminPanelProvider`

```php
->plugins([
    ErebusPlugin::make(),
])
```
