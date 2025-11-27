<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            'cordygen' => [
                [
                    'question' => 'How should I take Cordygen Elevate?',
                    'answer' => 'Take two capsules daily after meals. For performance training days, you can take both capsules 45 minutes before workout.',
                    'sort_order' => 1,
                ],
                [
                    'question' => 'Do you use real Himalayan cordyceps?',
                    'answer' => 'We cultivate Himalayan militaris strains under controlled bioreactors to ensure potency, traceability, and heavy metal compliance.',
                    'sort_order' => 2,
                ],
                [
                    'question' => 'Is Cordygen safe with existing medication?',
                    'answer' => 'Our formulations are generally well tolerated. If you are on anticoagulants or immunosuppressants, consult your physician before use.',
                    'sort_order' => 3,
                ],
            ],
        ];

        foreach ($faqs as $brandSlug => $entries) {
            $brand = \App\Models\Brand::query()->where('slug', $brandSlug)->first();

            if (! $brand) {
                continue;
            }

            foreach ($entries as $faq) {
                \App\Models\Faq::query()->updateOrCreate(
                    ['brand_id' => $brand->id, 'question' => $faq['question']],
                    array_merge($faq, [
                        'brand_id' => $brand->id,
                        'is_active' => true,
                    ])
                );
            }
        }
    }
}
