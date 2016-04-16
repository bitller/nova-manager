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
    
    /**
     * Get the user that have this client.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

}
