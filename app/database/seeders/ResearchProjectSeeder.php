<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ResearchProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            'shnikh' => [
                [
                    'title' => 'Virus-Indexed Banana Elite Lines',
                    'focus_area' => 'Phytosanitary Tissue Culture',
                    'summary' => 'Developing robust virus-indexed banana lines with improved field survivability.',
                    'content' => '<p>Collaboration with state agri universities to deliver pre-basic planting materials for large-scale bananas.</p>',
                    'status' => 'in-progress',
                ],
                [
                    'title' => 'Dragon Fruit High Density Protocols',
                    'focus_area' => 'High Density Cultivation',
                    'summary' => 'Optimising trellising and fertigation strategies for tissue culture derived dragon fruit.',
                    'content' => '<p>This program quantifies yield impact, sugar profile, and disease tolerance across multiple geos.</p>',
                    'status' => 'published',
                ],
            ],
        ];

        foreach ($projects as $brandSlug => $entries) {
            $brand = \App\Models\Brand::query()->where('slug', $brandSlug)->first();

            if (! $brand) {
                continue;
            }

            foreach ($entries as $project) {
                $slug = Str::slug($project['title']);

                \App\Models\ResearchProject::query()->updateOrCreate(
                    ['brand_id' => $brand->id, 'slug' => $slug],
                    array_merge($project, [
                        'brand_id' => $brand->id,
                        'slug' => $slug,
                        'partners' => [
                            'institutions' => ['Maulana Azad National Institute of Technology', 'ICAR Research Complex'],
                        ],
                    ])
                );
            }
        }
    }
}
