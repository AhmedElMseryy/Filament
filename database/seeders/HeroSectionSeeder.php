<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $heroSections = [
            [
                'is_active' => true,
                'added_by_id' => 1,
                'name' => [
                    'en' => 'Welcome to Our Website',
                    'ar' => 'مرحبًا بكم في موقعنا'
                ],
                'sub_description' => [
                    'en' => 'Discover amazing content and join our community today.',
                    'ar' => 'اكتشف محتوى رائعًا وانضم إلى مجتمعنا اليوم.'
                ],
                'description' => [
                    'en' => 'Discover amazing content and join our community today.',
                    'ar' => 'اكتشف محتوى رائعًا وانضم إلى مجتمعنا اليوم.'
                ],
            ],
        ];

        foreach ($heroSections as $heroSectionData) {
            HeroSection::updateOrCreate(
                ['added_by_id' => $heroSectionData['added_by_id']],
                $heroSectionData
            );
        }
    }
}
