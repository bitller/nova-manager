<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model of clients table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class Client extends Model {

    /**
     * Mass assignable fields.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'phone_number'];

    /**
     * Return this bills of this client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bills() {
        return $this->hasMany('App\Bill');
    }

    public function numberOfBills() {
        return $this->hasOne('App\Bill')->selectRaw('client_id, count(*) as count')->groupBy('client_id');
    }

    public function numberOfBillsAttribute() {
        return $this->numberOfBills->number_of_bills;
    }

    /**
     * Get the user that have this client.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * Order clients by their name asc.
     *
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByNameAsc($query) {
        return $query->orderBy('name', 'asc');
    }

    /**
     * Order clients by their name desc.
     *
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByNameDesc($query) {
        return $query->orderBy('name', 'desc');
    }

    public function scopeOrderByCreatedAtAsc($query) {
        return $query->orderBy('created_at', 'asc');
    }

    public function scopeOrderByCreatedAtDesc($query) {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeOrderByEmailAsc($query) {
        return $query->orderBy('email', 'asc');
    }

    public function scopeOrderByEmailDesc($query) {
        return $query->orderBy('email', 'desc');
    }

}
