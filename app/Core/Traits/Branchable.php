<?php

namespace App\Core\Traits;

trait Branchable
{
    public function scopeForBranch($query, $branchId)
    {
        return $query->where('branch_id', $branchId);
    }
}
