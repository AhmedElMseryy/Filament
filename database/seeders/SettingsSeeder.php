<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use Faker\Factory;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Setting::truncate();
        Schema::enableForeignKeyConstraints();

        $faker = Factory::create();

        $setting = Setting::create([
            "email" => $faker->email,
            "phone" => $faker->phoneNumber,
            "phone2" => $faker->phoneNumber,
            "support_phone" => $faker->phoneNumber,
            "location" => $faker->address,
            "facebook" => $faker->url,
            "whatsapp" => $faker->url,
            "instagram" => $faker->url,
            "youtube" => $faker->url,
            "tiktok" => $faker->url,
            "x" => $faker->url,
        ]);

        $setting->setTranslations('name', [
            'en' => 'settingName',
            'ar' => 'اسم الاعدادات',
        ]);

        $setting->setTranslations('description', [
            'en' => 'settingDescription',
            'ar' => 'وصف الاعدادات',
        ]);

        $setting->setTranslations('notes_and_suggestions', [
            'en' => 'settingNotesAndSuggestions',
            'ar' => 'الملاحظات و الاقتراحات',
        ]);

        $setting->save();
    }
}
