<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Refresh legacy stock defaults even where a hero was saved in the portal.
        // Custom uploads and other staff-written copy remain in place.
        $images = [
            'images/hero4.jpg' => 'images/chf-children-art-activities.jpeg',
            'images/hero3.jpg' => 'images/chf-caregiver-art-session.jpeg',
            'images/leftcard.jpg' => 'images/chf-creative-play.jpeg',
            'images/lefttp.jpg' => 'images/chf-family-activities.jpeg',
            'images/second section.jpg' => 'images/chf-child-painting.jpeg',
            'images/hero1 replace.jpg' => 'images/chf-children-art-activities.jpeg',
            'images/lefttop.jpg' => 'images/chf-family-activities.jpeg',
            'images/abaut.png' => 'images/chf-community-group.jpeg',
            'images/callphone.jpg' => 'images/chf-community-group.jpeg',
        ];

        DB::table('page_heroes')->orderBy('id')->each(function (object $hero) use ($images): void {
            $changes = [];

            if (isset($images[$hero->image_path])) {
                $changes['image_path'] = $hero->key === 'service-accommodation-and-meals'
                    || $hero->key === 'program-accommodation'
                    ? 'images/chf-support-home.jpeg'
                    : $images[$hero->image_path];
            }

            foreach (['eyebrow', 'title', 'highlight', 'intro'] as $field) {
                $copy = $hero->{$field};
                if ($copy === null) {
                    continue;
                }

                $updated = str_replace(
                    ['KCMC Zonal Referral Hospital', 'KCMC Hospital', 'KCMC appointments', 'KCMC'],
                    ['the nearby hospital', 'the nearby hospital', 'hospital appointments', 'the nearby hospital'],
                    $copy,
                );
                $updated = str_replace(
                    ['near the nearby hospital', 'Near the nearby hospital', 'the the nearby hospital', 'close to the nearby hospital'],
                    ['near the hospital', 'Near the hospital', 'the nearby hospital', 'close to the hospital'],
                    $updated,
                );
                if ($hero->key === 'home' && $field === 'intro'
                    && $copy === 'We support children with cancer and their caregivers with a safe place to stay, nourishing meals, transport and care for the whole family.') {
                    $updated = 'Supporting children with cancer and their caregivers in Tanzania through accommodation, nutrition, transport, psychosocial care, play and education support.';
                }

                if ($updated !== $copy) {
                    $changes[$field] = $updated;
                }
            }

            if ($changes !== []) {
                DB::table('page_heroes')->where('id', $hero->id)->update($changes);
            }
        });
    }

    public function down(): void
    {
        // Content changes are retained so rollback does not overwrite later staff edits.
    }
};
