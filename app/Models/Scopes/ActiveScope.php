<?php

namespace App\Models\Scopes;

trait ActiveScope
{
    /**
     * Scope a query to only active items
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where(self::IS_ACTIVE_FIELD, true);
    }
}
