<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for application_settings table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class ApplicationSetting extends Model {

    /**
     * Mass assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'allow_new_accounts', 'name', 'trial_days',
    ];

}
