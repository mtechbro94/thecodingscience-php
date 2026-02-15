<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['group' => 'general', 'key' => 'site_name', 'value' => 'The Coding Science', 'type' => 'text', 'label' => 'Site Name'],
            ['group' => 'general', 'key' => 'site_description', 'value' => 'School of Technology & AI Innovations. Learn Full Stack Development, Data Science, AI, Ethical Hacking and more.', 'type' => 'textarea', 'label' => 'Meta Description'],
            ['group' => 'general', 'key' => 'logo', 'value' => null, 'type' => 'image', 'label' => 'Site Logo'],

            // Home - Hero
            ['group' => 'home', 'key' => 'hero_title', 'value' => 'Master the Future of Tech', 'type' => 'text', 'label' => 'Hero Title'],
            ['group' => 'home', 'key' => 'hero_subtitle', 'value' => 'Industry-ready courses in Full Stack Development, AI, Data Science, Cybersecurity & more. Learn from experts, build real projects.', 'type' => 'textarea', 'label' => 'Hero Subtitle'],
            ['group' => 'home', 'key' => 'hero_cta_text', 'value' => 'Explore Courses', 'type' => 'text', 'label' => 'Hero CTA Text'],
            ['group' => 'home', 'key' => 'hero_cta_link', 'value' => '/courses', 'type' => 'text', 'label' => 'Hero CTA Link'],

            // Contact
            ['group' => 'contact', 'key' => 'contact_email', 'value' => 'hello@thecodingscience.com', 'type' => 'text', 'label' => 'Contact Email'],
            ['group' => 'contact', 'key' => 'contact_phone', 'value' => '+91 98765 43210', 'type' => 'text', 'label' => 'Contact Phone'],
            ['group' => 'contact', 'key' => 'contact_address', 'value' => 'Bangalore, India', 'type' => 'textarea', 'label' => 'Address'],

            // Social
            ['group' => 'social', 'key' => 'social_linkedin', 'value' => '#', 'type' => 'text', 'label' => 'LinkedIn URL'],
            ['group' => 'social', 'key' => 'social_twitter', 'value' => '#', 'type' => 'text', 'label' => 'Twitter URL'],
            ['group' => 'social', 'key' => 'social_instagram', 'value' => '#', 'type' => 'text', 'label' => 'Instagram URL'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
