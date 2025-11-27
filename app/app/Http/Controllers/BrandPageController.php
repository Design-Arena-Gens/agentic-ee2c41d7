<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Page;
use Illuminate\Contracts\View\View;

class BrandPageController extends Controller
{
    public function home(Brand $brand): View
    {
        $page = $this->resolvePage($brand, 'home');

        return view('brands.home', compact('brand', 'page'));
    }

    public function about(Brand $brand): View
    {
        $page = $this->resolvePage($brand, 'about');

        return view('brands.page', compact('brand', 'page'));
    }

    public function services(Brand $brand): View
    {
        $page = $this->resolvePage($brand, 'services');

        return view('brands.page', compact('brand', 'page'));
    }

    public function productsLanding(Brand $brand): View
    {
        $page = $this->resolvePage($brand, 'products');

        return view('brands.products.landing', compact('brand', 'page'));
    }

    public function science(Brand $brand): View
    {
        $page = $this->resolvePage($brand, 'science');

        return view('brands.page', compact('brand', 'page'));
    }

    public function research(Brand $brand): View
    {
        $page = $this->resolvePage($brand, 'r-and-d');

        return view('brands.research.index', compact('brand', 'page'));
    }

    public function faq(Brand $brand): View
    {
        $page = $this->resolvePage($brand, 'faq');
        $faqs = $brand->faqs()->where('is_active', true)->orderBy('sort_order')->get();

        return view('brands.faq.index', compact('brand', 'page', 'faqs'));
    }

    public function contact(Brand $brand): View
    {
        $page = $this->resolvePage($brand, 'contact');

        return view('brands.contact', compact('brand', 'page'));
    }

    protected function resolvePage(Brand $brand, string $slug): Page
    {
        return $brand->pages()
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
