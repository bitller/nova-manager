<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model of campaigns table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class Campaign extends Model {

    /**
     * Mass assignable attributes.
     *
     * @var array
     */
    protected $fillable = ['year', 'start_date', 'end_date', 'number'];
    
}
