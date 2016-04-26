<?php

use Illuminate\Database\Seeder;
use App\Announcement;

/**
 * Seeds announcements table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class AnnouncementsTableSeeder extends Seeder {

    /**
     * Number of success announcements to generate.
     *
     * @var integer
     */
    protected $successAnnouncements = 10;

    /**
     * Number of warning announcements to generate.
     *
     * @var integer
     */
    protected $warningAnnouncements = 10;

    /**
     * Seeds table.
     */
    public function run() {

        // Generate success announcements
        for ($i = 1; $i <= $this->successAnnouncements; $i++) {
            factory(App\Announcement::class, 'info')->create();
        }

        // Generate warning announcements
        for ($i = 1; $i <= $this->warningAnnouncements; $i++) {
            factory(App\Announcement::class, 'warning')->create();
        }
    }

}
