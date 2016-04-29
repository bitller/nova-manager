<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Laravel\Cashier\Billable;

/**
 * Model for users table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class User extends Authenticatable {

    use EntrustUserTrait;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the clients of the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clients() {
        return $this->hasMany('App\Client');
    }

    public function searchClients($searchQuery) {
        return $this->clients()->where('name', 'like', $searchQuery.'%')->orWhere('phone_number', 'like', $searchQuery.'%');
    }

    /**
     * Get all the bills of the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function bills() {
        return $this->hasManyThrough('App\Bill', 'App\Client');
    }

    /**
     * Get user settings.
     *
     * @return \Database\Eloquent\Relations\HasOne
     */
    public function settings() {
        return $this->hasOne('App\Setting');
    }

    /**
     * Announcements that belongs to the user.
     *
     * @return \Database\Eloquent\Relations\BelongsToMany
     */
    public function announcements() {
        return $this->belongsToMany('App\Announcement');
    }

    /**
     * Read announcements that belongs to the user.
     *
     * @return \Database\Eloquent\Relations\BelongsToMany
     */
    public function readAnnouncements() {
        return $this->belongsToMany('App\Announcement')->wherePivot('read', true);
    }

    /**
     * Not read announcements that belongs to the user.
     *
     * @return \Database\Eloquent\Relations\BelongsToMany
     */
    public function notReadAnnouncements() {
        return $this->belongsToMany('App\Announcement')->wherePivot('read', false);
    }
}
