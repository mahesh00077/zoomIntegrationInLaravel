<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MeetingTbl extends Model
{
    protected $table = 'meeting_tbl';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'meeting_id', 'host_id', 'host_email', 'chstatus', 'start_url', 'join_url', 'topic', 'type', 'timezone', 'start_time', 'duration', 'password', 'created_at', 'updated_at'
    ];
}