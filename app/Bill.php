<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany('App\Product');
    }
    
    /**
     * Return the client of this bill.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client() {
        return $this->belongsTo('App\Client');
    }

    /**
     * Return the user that owns this bill.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
}
