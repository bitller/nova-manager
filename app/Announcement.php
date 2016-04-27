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
     * @var [type]
     */
    protected $fillable = ['title', 'content', 'action_button_url', 'action_button_text'];

    /**
     * Users that belongs to the announcement.
     *
     * @return \Database\Eloquent\Relations\BelongsToMany
     */
    public function users() {
        return $this->belongsToMany('App\User');
    }

}
