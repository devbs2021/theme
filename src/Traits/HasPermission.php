<?php

namespace DevbShrestha\Theme\Traits;

use DevbShrestha\Theme\Models\UserPermission;

trait HasPermission
{

    public function permission()
    {
        return $this->hasOne(UserPermission::class);
    }
}
