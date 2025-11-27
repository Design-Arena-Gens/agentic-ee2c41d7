<?php

namespace App\Http\Middleware;

use App\Models\Brand;
use App\Services\BrandManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCurrentBrand
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var BrandManager $brandManager */
        $brandManager = app(BrandManager::class);

        $brand = $request->route('brand');

        if (is_string($brand)) {
            $brand = Brand::query()->where('slug', $brand)->firstOrFail();
        }

        if ($brand instanceof Brand) {
            $brandManager->setCurrent($brand);
            view()->share('currentBrand', $brand);
        }

        return $next($request);
    }
}
