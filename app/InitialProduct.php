<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for initial_products table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class InitialProduct extends Model {

    /**
     * Mass assignable fields.
     *
     * @var array
     */
    protected $fillable = ['name', 'code'];

    /**
     * Disable timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

}
