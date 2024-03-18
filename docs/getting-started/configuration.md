---
title: Configuration
weight: 3
---

## Configuration

to configure the plugin Erebus, you can pass the configuration to the plugin in `adminPanelProvider`

these all the available configuration, and their defaults values

```php
ErebusPlugin::make()
    ->navigationGroupLabel('Erebus')
```

## Frontend Configuration

use the file `zeus-erebus.php`, to customize the frontend, like the prefix,domain, and middleware for each content type.

to publish the configuration:

```bash
php artisan vendor:publish --tag=zeus-erebus-config
```