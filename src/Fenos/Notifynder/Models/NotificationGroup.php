<?php namespace Fenos\Notifynder\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NotificationGroup
 *
 * @package Fenos\Notifynder\Models
 */
class NotificationGroup extends Model {

    /**
     * @var array
     */
    protected $fillable = ["name"];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(
            'Fenos\Notifynder\Models\NotificationCategory',
            'notifications_categories_in_groups',
            'group_id','category_id'
        );
    }
} 