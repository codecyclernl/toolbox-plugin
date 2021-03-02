<?php namespace Codecycler\Toolbox\Concerns;

trait HasCode
{
    /**
     * @param Builder $query
     * @param string $code
     * @return Builder
     */
    public function scopeCode($query, $code)
    {
        return $query->where('code', $code);
    }
}