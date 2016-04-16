<?php

/**
 * Seeds roles table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class RolesTableSeeder extends \Illuminate\Database\Seeder {

    /**
     * Seeds table.
     */
    public function run() {
        $this->createAdminRole();
        $this->createUserRole();
    }

    /**
     * Create admin role.
     */
    protected function createAdminRole() {
        $admin = new \App\Role();
        $admin->name = 'admin';
        $admin->display_name = 'Application admin';
        $admin->description = 'User is the admin of the application';
        $admin->save();
    }

    /**
     * Create user role.
     */
    protected function createUserRole() {
        $user = new \App\Role();
        $user->name = 'user';
        $user->display_name = 'User';
        $user->description = 'Normal application user';
        $user->save();
    }
}