<?php

namespace DevbShrestha\Theme\Traits;

use DevbShrestha\Theme\Models\UserPermission;

trait HasPermission
{

    public function permissions()
    {
        return $this->hasOne(UserPermission::class);
    }
}
