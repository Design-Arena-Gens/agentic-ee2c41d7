<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Shnikh Agrobiotech Pvt. Ltd.',
                'slug' => 'shnikh',
                'tagline' => 'Advancing Plant Tissue Culture & Agri-Biotech',
                'primary_color' => '#0f766e',
                'secondary_color' => '#d97706',
                'contact_email' => 'info@shnikhagro.com',
                'contact_phone' => '+91-98765-43210',
                'contact_whatsapp' => '+91-98765-43210',
                'short_description' => 'Innovative plant tissue culture solutions scaling sustainable agriculture.',
                'about_content' => 'Shnikh Agrobiotech Pvt. Ltd. is a leading agri-biotech enterprise focused on high-quality plant tissue culture, clean planting materials, and contract research for agribusinesses and institutions across the globe.',
                'social_links' => [
                    'linkedin' => 'https://www.linkedin.com/company/shnikh-agrobiotech',
                    'facebook' => 'https://www.facebook.com/shnikh.agrobiotech',
                ],
                'metadata' => [
                    'headquarters' => 'Pune, Maharashtra',
                    'established' => 2010,
                ],
            ],
            [
                'name' => 'Cordygen',
                'slug' => 'cordygen',
                'tagline' => 'Cordyceps Powered Wellness',
                'primary_color' => '#7c3aed',
                'secondary_color' => '#f97316',
                'contact_email' => 'support@cordygen.in',
                'contact_phone' => '+91-99887-66554',
                'contact_whatsapp' => '+91-99887-66554',
                'short_description' => 'Premium cordyceps supplements inspired by ancient remedies and backed by modern science.',
                'about_content' => 'Cordygen translates the therapeutic power of cordyceps into reliable formulations for immunity, endurance, and holistic wellbeing. Our formulations leverage traceable cultivation, clean extraction, and rigorous testing.',
                'social_links' => [
                    'instagram' => 'https://www.instagram.com/cordygen_wellness',
                    'youtube' => 'https://www.youtube.com/@cordygen',
                ],
                'metadata' => [
                    'headquarters' => 'Bengaluru, Karnataka',
                    'established' => 2018,
                ],
            ],
        ];

        foreach ($brands as $data) {
            \App\Models\Brand::query()->updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
