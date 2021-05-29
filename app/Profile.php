<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Profile;

class Profile extends Model
{
    //protected $table = 'profiles';
    protected $fillable = [
        'firstname', 'middlename', 'lastname', 'profile_type'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
