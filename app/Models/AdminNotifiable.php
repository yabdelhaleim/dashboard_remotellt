<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

/**
 * AdminNotifiable — lightweight stand-in that satisfies Laravel's
 * database channel contract without depending on the User table.
 *
 * Why a custom class:
 *   - The database channel calls $notifiable->morphMany(...) which needs a
 *     real Eloquent model with a table. We don't want to depend on User
 *     rows existing (the site might run before any admin signs up).
 *   - We use `notifications` table directly with notifiable_type='admin'
 *     and notifiable_id=1 so all admin notifications land in one bucket.
 *
 * Persistence strategy:
 *   - Extend Notifiable trait (provides notifications() morphMany).
 *   - Use a real `users` table mirror by setting $table to 'users'.
 *     This is required for `morphMany` to resolve — the relationship
 *     helper requires the model to belong to a real table.
 *   - We never INSERT into users — we only ever read the table.
 */
class AdminNotifiable extends Model
{
    use Notifiable;

    /**
     * Reuse the users table ONLY to satisfy Eloquent's morphMany lookup.
     * We never insert into it from this class.
     */
    protected $table = 'users';

    public    $timestamps = false;
    protected $guarded = [];

    /**
     * Force id = 1 + a fake (but stable) class name so notifications
     * land in `notifiable_type='admin'` / `notifiable_id=1`.
     */
    public function __construct(array $attributes = [])
    {
        $this->id = 1;
        parent::__construct($attributes);
    }

    public function getKey()    { return 1; }
    public function getKeyName() { return 'id'; }

    /**
     * Override the morph class — Laravel would otherwise use `App\Models\AdminNotifiable`.
     * We want the storage row to say `notifiable_type = 'admin'`.
     */
    public function getMorphClass()
    {
        return 'admin';
    }
}