<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model of products table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class Product extends Model {

    /**
     * Mass assignable fields.
     *
     * @var array
     */
    protected $fillable = ['name', 'code', 'user_id'];

    /**
     * Return user that owns the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * The bill that has the product.
     */
    public function bills() {
        return $this->belongsToMany('App\Bill');
    }

}
