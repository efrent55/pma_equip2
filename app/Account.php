<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account_Keyword;

class Account extends Model
{
    /* protected $table = 'roles'; */

    public function account_keywords(){
        return $this->hasOne(Account_Keyword::class);
    }
}
