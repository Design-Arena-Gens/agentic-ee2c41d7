<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            'shnikh' => [
                [
                    'title' => 'Scalable Tissue Culture for Commercial Banana Supply Chains',
                    'excerpt' => 'How Shnikh Agrobiotech maintains genetic fidelity and pathogen-free banana propagation across millions of plantlets.',
                    'body' => '<p>Our controlled culture protocols leverage molecular indexing, stage-specific QA, and acclimatization SOPs aligned with APEDA export standards.</p>',
                ],
                [
                    'title' => 'Collaborative R&D for Climate-Resilient Horticulture',
                    'excerpt' => 'Partnerships with universities and agritech startups are accelerating cultivar development and high-density planting systems.',
                    'body' => '<p>Learn how we co-create solutions for drought-tolerant pomegranate, dragon fruit vigor, and precision fertigation.</p>',
                ],
            ],
            'cordygen' => [
                [
                    'title' => 'Cordyceps Militaris vs. Sinensis: What Matters for Efficacy',
                    'excerpt' => 'Understand the biochemical differences, cultivation methods, and clinical relevance for performance and immunity.',
                    'body' => '<p>Cordyceps militaris offers consistent cordycepin yields through controlled cultivation, making it viable for high-potency formulations.</p>',
                ],
                [
                    'title' => 'Athlete Endurance Study: Cordygen Elevate in Focus',
                    'excerpt' => 'A 12-week study tracks changes in VO2 max, recovery markers, and perceived exertion among endurance athletes supplementing with Cordygen Elevate.',
                    'body' => '<p>Participants recorded marked improvements in power output, with no adverse events and notable feedback on sleep and recovery.</p>',
                ],
            ],
        ];

        $author = \App\Models\User::query()->first();

        foreach ($posts as $brandSlug => $brandPosts) {
            $brand = \App\Models\Brand::query()->where('slug', $brandSlug)->first();

            if (! $brand) {
                continue;
            }

            foreach ($brandPosts as $post) {
                $slug = Str::slug($post['title']);

                \App\Models\Post::query()->updateOrCreate(
                    ['brand_id' => $brand->id, 'slug' => $slug],
                    array_merge($post, [
                        'brand_id' => $brand->id,
                        'slug' => $slug,
                        'author_id' => $author?->id,
                        'status' => 'published',
                        'published_at' => now()->subDays(rand(1, 30)),
                    ])
                );
            }
        }
    }
}
