<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_Item extends Model
{
    protected $table = 'transaction_items';

    /* public function transactions(){
        return $this->hasOne(Transaction::class);
    } */
}
