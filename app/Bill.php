<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use DB;

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
    protected $fillable = ['campaign_order', 'payment_term', 'other_details', 'paid', 'campaign_id'];

    /**
     * The products of the bill.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() {
        return $this->belongsToMany('App\Product', 'bill_products')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function price() {
        return $this->products()->sum('price');
    }

    public function numberOfProducts() {
        return $this->products()->select('name', 'code', 'price', DB::raw('SUM(price) as total_price'))->get();
        // return $this->hasOne('App\Bill')->selectRaw('client_id, count(*) as count')->groupBy('client_id');
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
