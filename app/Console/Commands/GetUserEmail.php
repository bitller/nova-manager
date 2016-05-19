<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

/**
 * Return email of given user.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class GetUserEmail extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user-email {userId=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Return user email.';

    /**
     * Create a new command instance.
     *
     * @return void
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
        $user = User::where('id', $this->argument('userId'))->first();
        $this->info($user->email);
    }
}
