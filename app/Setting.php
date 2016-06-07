<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for settings table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class Setting extends Model {

    /**
     * Mass assignable fields.
     * @var array
     */
    protected $fillable = ['number_of_bills', 'number_of_clients', 'order_products_by', 'order_products_type'];

    /**
     * Get user of that setting.
     */
    public function user() {
        return $this->hasOne('App\User');
    }

}
