<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Account;

class Account_Keyword extends Model
{
    protected $table = 'account_keywords';

    public function accounts()
    {
        return $this->belongsTo(Account::class);
    }
}
