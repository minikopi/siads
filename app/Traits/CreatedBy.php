<?php

namespace App\Traits;

trait CreatedBy
{
    protected $created_by = 'created_by';

    protected $updated_by = 'updated_by';

    public function validated($key = null, $default = null)
    {
        return array_merge(parent::validated(), [
            $this->created_by => auth()->user()->name ?? null,
            $this->updated_by => auth()->user()->name ?? null,
        ]);
    }
}
