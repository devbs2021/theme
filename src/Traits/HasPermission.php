<?php

namespace Devbs\Theme\Traits;

use Devbs\Theme\Models\UserPermission;

trait HasPermission
{

    public function permissions()
    {
        return $this->hasOne(UserPermission::class);
    }
}
