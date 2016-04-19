<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model of campaigns table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class Campaign extends Model {

    /**
     * Mass assignable attributes.
     *
     * @var array
     */
    protected $fillable = ['year', 'start_date', 'end_date', 'number'];

    /**
     * Return bills of the campaign.
     *
     * @return \Database\Eloquent\Relations\HasMany
     */
    public function bills() {
        return $this->hasMany('App\Bill');
    }

    /**
     * Return current campaign.
     *
     * @param $query
     * @return $query
     */
    public function currentScope($query) {
        $date = date('Y-m-d');
        return $query->where('start_date', '<=', $date)->where('end_date', '>=', $date);
    }

}
