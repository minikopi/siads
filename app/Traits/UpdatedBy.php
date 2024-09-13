<?php

namespace App\Traits;

trait UpdatedBy
{
    protected $updated_by = 'updated_by';

    public function validated($key = null, $default = null)
    {
        return array_merge(parent::validated(), [
            $this->updated_by => auth()->user()->name ?? null,
        ]);
    }
}
