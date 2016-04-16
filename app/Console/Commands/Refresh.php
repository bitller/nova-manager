<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Delete all old data and run everything again.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class Refresh extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old data and run again everything';

    /**
     * Create a new command instance.
     *
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {

        $this->info('Refreshing application...');

        $this->call('migrate:refresh');
        $this->info('Migrations refreshed.');

        $this->call('db:seed');
        $this->info('Database seeded.');
    }
}
