<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pageDefinitions = [
            'shnikh' => [
                [
                    'slug' => 'home',
                    'title' => 'Plant Tissue Culture At Scale',
                    'hero_title' => 'Science-Guided Propagation for Resilient Crops',
                    'hero_subtitle' => 'Shnikh Agrobiotech delivers elite planting materials through precision tissue culture, clean greenhouse acclimatization, and agronomy advisory.',
                    'sections' => [
                        'highlights' => [
                            ['title' => 'Commercial TC Labs', 'description' => 'ISO-certified laboratories with 5M annual plantlets capacity'],
                            ['title' => 'Clean Mother Blocks', 'description' => 'Disease-indexed source material for genetic fidelity'],
                            ['title' => 'Contract Research', 'description' => 'Bespoke development programs for agri-enterprises'],
                        ],
                        'cta' => [
                            'label' => 'Book a discovery call',
                            'url' => '/shnikh/contact',
                        ],
                    ],
                ],
                [
                    'slug' => 'about',
                    'title' => 'About Shnikh Agrobiotech',
                    'hero_title' => 'Building Sustainable Agri-Biotech Infrastructure',
                    'content' => '<p>Our multidisciplinary team spans plant science, biotechnology, agronomy, and supply chain operations. We partner with growers, exporters, and institutions to deliver scalable, dependable planting material solutions.</p>',
                ],
                [
                    'slug' => 'services',
                    'title' => 'Services',
                    'hero_title' => 'End-to-End Tissue Culture & Agronomy Services',
                    'sections' => [
                        'services' => [
                            ['title' => 'Commercial Propagation', 'description' => 'Banana, pomegranate, dragon fruit, floriculture species, and elite horticulture crops'],
                            ['title' => 'Nursery Operations', 'description' => 'Hardening & acclimatization under climate-controlled facilities'],
                            ['title' => 'Field Performance Trials', 'description' => 'GxE studies and agronomy optimization for large cohorts'],
                        ],
                    ],
                ],
                [
                    'slug' => 'products',
                    'title' => 'Planting Portfolio',
                    'hero_title' => 'Certified Plant Tissue Culture Lines',
                ],
                [
                    'slug' => 'r-and-d',
                    'title' => 'R&D',
                    'hero_title' => 'Collaborative Agri-Biotech Innovation',
                    'hero_subtitle' => 'Joint development programs with universities, agri-tech startups, and input companies.',
                ],
                [
                    'slug' => 'blog',
                    'title' => 'Insights & Updates',
                ],
                [
                    'slug' => 'contact',
                    'title' => 'Contact Shnikh',
                    'hero_title' => 'Schedule a Discovery Session',
                ],
            ],
            'cordygen' => [
                [
                    'slug' => 'home',
                    'title' => 'Cordyceps-Fueled Wellness',
                    'hero_title' => 'Clinically Crafted Cordyceps Formulations',
                    'hero_subtitle' => 'Cordygen pairs adaptogenic fungi with traceable sourcing and clinical validation.',
                    'sections' => [
                        'highlights' => [
                            ['title' => 'Bioavailable Extracts', 'description' => 'Dual-extraction ensures full spectrum polysaccharides and cordycepin'],
                            ['title' => 'Transparent Origin', 'description' => 'Farm-direct Himalayan strains cultivated under GMP facilities'],
                            ['title' => 'Formulation Science', 'description' => 'Formulated with nutritionists & mycologists for consistent outcomes'],
                        ],
                        'cta' => [
                            'label' => 'Shop Cordygen',
                            'url' => '/cordygen/products',
                        ],
                    ],
                ],
                [
                    'slug' => 'products',
                    'title' => 'Cordygen Collection',
                ],
                [
                    'slug' => 'science',
                    'title' => 'Science of Cordygen',
                    'hero_title' => 'Evidence-Led Myco-Wellness',
                    'content' => '<p>Cordygen invests in validated studies exploring VO2 max, immune modulation, stress response, and metabolic balance. We make dossiers accessible to healthcare practitioners.</p>',
                ],
                [
                    'slug' => 'about',
                    'title' => 'About Cordygen',
                    'content' => '<p>From lab to lifestyle: Cordygen unites controlled cultivation, clean extraction, and formulation R&D to deliver dependable wellness experiences.</p>',
                ],
                [
                    'slug' => 'faq',
                    'title' => 'Frequently Asked Questions',
                ],
                [
                    'slug' => 'blog',
                    'title' => 'Cordygen Journal',
                ],
                [
                    'slug' => 'contact',
                    'title' => 'Talk to Cordygen',
                ],
            ],
        ];

        foreach ($pageDefinitions as $brandSlug => $pages) {
            $brand = \App\Models\Brand::query()->where('slug', $brandSlug)->first();

            if (! $brand) {
                continue;
            }

            foreach ($pages as $page) {
                \App\Models\Page::query()->updateOrCreate(
                    ['brand_id' => $brand->id, 'slug' => $page['slug']],
                    $page + ['brand_id' => $brand->id]
                );
            }
        }
    }
}
