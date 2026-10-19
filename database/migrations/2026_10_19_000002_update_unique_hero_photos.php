<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $photos = [
        'home' => 'images/chf-hero-home-community.jpeg',
        'about' => 'images/abaut.png',
        'team' => 'images/chf-hero-our-team.jpeg',
        'programs' => 'images/chf-program-overview-garden.jpg',
        'cancer' => 'images/chf-hero-childhood-cancer-awareness.jpeg',
        'contact' => 'images/chf-contact-phone.jpg',
        'news-updates' => 'images/chf-hero-news-family-support.jpeg',
        'events' => 'images/chf-hero-events-outdoor-play.jpeg',
        'vacancies' => 'images/chf-hero-vacancies-team.jpeg',
        'program-accommodation' => 'images/chf-accommodation-bunks.jpg',
        'program-transport' => 'images/chf-transport-vehicle.jpg',
        'program-emotional-support' => 'images/chf-hero-program-emotional-support.jpeg',
        'program-practical-support' => 'images/chf-hero-program-practical-support.jpeg',
        'program-awareness-education' => 'images/chf-hero-program-awareness-education.jpeg',
        'program-advocacy-collaboration' => 'images/chf-hero-program-advocacy-collaboration.jpeg',
        'program-additional-programmes' => 'images/chf-hero-program-additional-programmes.jpeg',
        'program-education-support' => 'images/chf-hero-program-education-support.jpeg',
        'cancer-what-is-cancer' => 'images/chf-hero-cancer-information.jpeg',
        'cancer-blood-disorders' => 'images/chf-hero-cancer-blood-disorders.jpeg',
        'cancer-types-of-cancer' => 'images/chf-hero-cancer-types.jpeg',
        'cancer-early-warning-signs' => 'images/chf-hero-cancer-early-signs.jpeg',
        'cancer-refer-a-patient' => 'images/chf-hero-cancer-referral.jpeg',
        'cancer-referral-pathways' => 'images/chf-hero-cancer-referral-pathways.jpeg',
        'cancer-myths-and-stigmas' => 'images/chf-hero-cancer-myths.jpeg',
        'cancer-kiddies-corner' => 'images/chf-hero-cancer-childrens-corner.jpeg',
        'cancer-teenage-corner' => 'images/chf-hero-cancer-teenagers.jpeg',
        'cancer-survivors-corner' => 'images/chf-hero-cancer-survivors.jpeg',
        'service-accommodation-and-meals' => 'images/chf-accommodation-bunks.jpg',
        'service-transport-to-treatment' => 'images/chf-transport-vehicle.jpg',
        'service-psychosocial-support' => 'images/chf-hero-service-psychosocial-support.jpeg',
        'service-play-and-recreation-therapy' => 'images/chf-hero-service-play-recreation.jpeg',
        'involvement-donate' => 'images/chf-hero-involvement-donate.jpeg',
        'involvement-volunteer' => 'images/chf-hero-involvement-volunteer.jpeg',
        'involvement-partner-with-us' => 'images/chf-hero-involvement-partnership.jpeg',
    ];

    public function up(): void
    {
        if (! Schema::hasTable('page_heroes')) {
            return;
        }

        $legacyImages = [
            'images/abaut.png', 'images/callphone.jpg', 'images/hero1 replace.jpg', 'images/hero3.jpg',
            'images/hero4.jpg', 'images/leftcard.jpg', 'images/lefttop.jpg', 'images/lefttp.jpg',
            'images/second section.jpg', 'images/chf-caregiver-art-session.jpeg', 'images/chf-child-painting.jpeg',
            'images/chf-children-art-activities.jpeg', 'images/chf-community-group.jpeg', 'images/chf-creative-play.jpeg',
            'images/chf-family-activities.jpeg', 'images/chf-play-resources.jpeg', 'images/chf-support-home.jpeg',
        ];

        foreach ($this->photos as $key => $path) {
            DB::table('page_heroes')
                ->where('key', $key)
                ->whereIn('image_path', $legacyImages)
                ->update(['image_path' => $path, 'updated_at' => now()]);
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('page_heroes')) {
            return;
        }

        $previous = [
            'home' => 'images/abaut.png',
            'about' => 'images/abaut.png',
            'team' => 'images/abaut.png',
            'programs' => 'images/chf-program-overview-garden.jpg',
            'cancer' => 'images/chf-caregiver-art-session.jpeg',
            'contact' => 'images/chf-contact-phone.jpg',
            'news-updates' => 'images/chf-caregiver-art-session.jpeg',
            'events' => 'images/chf-children-art-activities.jpeg',
            'vacancies' => 'images/chf-child-painting.jpeg',
            'program-accommodation' => 'images/chf-support-home.jpeg',
            'program-transport' => 'images/chf-caregiver-art-session.jpeg',
            'program-emotional-support' => 'images/chf-creative-play.jpeg',
            'program-practical-support' => 'images/chf-children-art-activities.jpeg',
            'program-awareness-education' => 'images/chf-caregiver-art-session.jpeg',
            'program-advocacy-collaboration' => 'images/chf-creative-play.jpeg',
            'program-additional-programmes' => 'images/chf-child-painting.jpeg',
            'program-education-support' => 'images/chf-child-painting.jpeg',
            'cancer-what-is-cancer' => 'images/chf-caregiver-art-session.jpeg',
            'cancer-blood-disorders' => 'images/chf-children-art-activities.jpeg',
            'cancer-types-of-cancer' => 'images/chf-creative-play.jpeg',
            'cancer-early-warning-signs' => 'images/chf-caregiver-art-session.jpeg',
            'cancer-refer-a-patient' => 'images/chf-children-art-activities.jpeg',
            'cancer-referral-pathways' => 'images/chf-caregiver-art-session.jpeg',
            'cancer-myths-and-stigmas' => 'images/chf-creative-play.jpeg',
            'cancer-kiddies-corner' => 'images/chf-child-painting.jpeg',
            'cancer-teenage-corner' => 'images/chf-children-art-activities.jpeg',
            'cancer-survivors-corner' => 'images/chf-family-activities.jpeg',
            'service-accommodation-and-meals' => 'images/chf-support-home.jpeg',
            'service-transport-to-treatment' => 'images/chf-family-activities.jpeg',
            'service-psychosocial-support' => 'images/chf-creative-play.jpeg',
            'service-play-and-recreation-therapy' => 'images/chf-children-art-activities.jpeg',
            'involvement-donate' => 'images/chf-family-activities.jpeg',
            'involvement-volunteer' => 'images/chf-caregiver-art-session.jpeg',
            'involvement-partner-with-us' => 'images/chf-children-art-activities.jpeg',
        ];

        foreach ($previous as $key => $path) {
            DB::table('page_heroes')
                ->where('key', $key)
                ->where('image_path', $this->photos[$key])
                ->update(['image_path' => $path, 'updated_at' => now()]);
        }
    }
};
