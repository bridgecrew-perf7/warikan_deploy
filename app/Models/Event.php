<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * イベント
 * Class Event
 * @package App\Models
 */
class Event extends Model
{
    protected $table = 'events';

    protected $guarded = ['id', 'created_at', 'updated_at'];
}
