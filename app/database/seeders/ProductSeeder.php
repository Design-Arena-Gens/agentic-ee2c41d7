<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brandProducts = [
            'shnikh' => [
                [
                    'name' => 'Grand Nain Banana Plantlets',
                    'type' => 'physical',
                    'short_description' => 'Virus-indexed Grand Nain banana planting material hardened for field establishment.',
                    'description' => '<p>Elite Grand Nain cultivar, validated for uniform bunching and reduced virus load. Supplied with crop advisory sheets.</p>',
                    'price' => 25.00,
                    'sale_price' => 22.50,
                    'stock' => 10000,
                    'attributes' => [
                        'cycle' => '4 weeks hardening',
                        'pack_size' => '100 plantlets',
                    ],
                    'shipping_profile' => [
                        'method' => 'cold_chain',
                        'dispatch_window' => '7-10 days',
                    ],
                ],
                [
                    'name' => 'Tissue Culture Dragon Fruit Cuttings',
                    'type' => 'physical',
                    'short_description' => 'High-performing red-flesh dragon fruit cuttings from clean stock.',
                    'description' => '<p>Supplied as rooted, hardened cuttings ready for trellis installation. Field-tested for brix and shelf-life.</p>',
                    'price' => 180.00,
                    'stock' => 2500,
                    'attributes' => [
                        'variety' => 'Hylocereus costaricensis',
                        'brix' => '19-21',
                    ],
                ],
            ],
            'cordygen' => [
                [
                    'name' => 'Cordygen Elevate Capsules',
                    'type' => 'physical',
                    'short_description' => 'Daily adaptogenic support with 750mg Cordyceps militaris extract.',
                    'description' => '<p>Standardised at 30% polysaccharides and 1.5% cordycepin. Supports stamina, VO2 max, and recovery.</p>',
                    'price' => 1299.00,
                    'sale_price' => 1099.00,
                    'stock' => 1200,
                    'attributes' => [
                        'servings' => 60,
                        'dosage' => '2 capsules/day',
                    ],
                ],
                [
                    'name' => 'Cordygen Instant Tonic',
                    'type' => 'physical',
                    'short_description' => 'Functional beverage mix combining cordyceps with Himalayan botanicals.',
                    'description' => '<p>Enhanced with ashwagandha, shilajit, and vitamin B-complex for holistic vitality.</p>',
                    'price' => 899.00,
                    'stock' => 800,
                    'attributes' => [
                        'pack_size' => '14 sachets',
                        'flavour' => 'Saffron Ginger',
                    ],
                ],
            ],
        ];

        foreach ($brandProducts as $brandSlug => $products) {
            $brand = \App\Models\Brand::query()->where('slug', $brandSlug)->first();

            if (! $brand) {
                continue;
            }

            foreach ($products as $product) {
                $slug = Str::slug($product['name']);

                \App\Models\Product::query()->updateOrCreate(
                    ['brand_id' => $brand->id, 'slug' => $slug],
                    array_merge($product, [
                        'brand_id' => $brand->id,
                        'slug' => $slug,
                        'sku' => $product['attributes']['sku'] ?? strtoupper(substr($brandSlug, 0, 3)) . '-' . random_int(10000, 99999),
                        'is_active' => true,
                        'track_stock' => true,
                        'published_at' => now(),
                    ])
                );
            }
        }
    }
}
