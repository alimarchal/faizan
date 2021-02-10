<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Department extends Model
{
    use Notifiable, LogsActivity;
    protected static $logAttributes = ['*'];

    protected $table = 'departments';
    protected $fillable = ['dep_name', 'short_name', 'logo', 'description', 'website_url'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    //relation with transfers
    public function transfer()
    {
        return $this->hasMany(Transfer::class);
    }
}
