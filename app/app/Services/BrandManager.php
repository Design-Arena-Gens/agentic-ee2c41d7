<?php

namespace App\Services;

use App\Models\Brand;
use Illuminate\Support\Collection;

class BrandManager
{
    protected ?Brand $brand = null;

    public function setCurrent(?Brand $brand): void
    {
        $this->brand = $brand;
    }

    public function current(): ?Brand
    {
        return $this->brand;
    }

    /**
     * Retrieve all available brands.
     *
     * @return Collection<int, Brand>
     */
    public function all(): Collection
    {
        return Brand::query()->orderBy('name')->get();
    }
}
