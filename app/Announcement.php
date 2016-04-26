<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for announcements table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class Announcement extends Model {

    /**
     * Users that belongs to the announcement.
     *
     * @return \Database\Eloquent\Relations\BelongsToMany
     */
    public function users() {
        return $this->belongsToMany('App\User');
    }

}
