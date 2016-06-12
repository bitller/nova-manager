<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Model of bills table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class Bill extends Model {

    /**
     * Mass assignable fields.
     *
     * @var array
     */
    protected $fillable = ['campaign_order', 'payment_term', 'other_details', 'paid'];

    /**
     * Return products of the bill.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() {
        return $this->hasManyThrough('App\Product', 'App\BillProduct');
    }

    /**
     * Return campaign of the bill.
     *
     * @return \Database\Eloquent\Relations\HasOne
     */
    public function campaign() {
        return $this->hasOne('App\Campaign');
    }

    /**
     * Return the client of this bill.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client() {
        return $this->belongsTo('App\Client');
    }

    // public function numberOfProducts() {
        // return $this->hasManyTrough('App\B', 'App\User')
    // }
}
