<?php

namespace LaraZeus\Erebus\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LaraZeus\Chaos\Concerns\ChaosModel;
use LaraZeus\Tartarus\Models\Concerns\ForCompany;

class Notification extends Model
{
    use ChaosModel;
    use ForCompany;
    use HasUuids;

    protected $casts = [
        'data' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'notifiable_id', 'id');
    }
}
