<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $guarded = [''];

    const STATUS_DONE = 1;
    const STATUS_DEFAULT = 0;

    public function user() // Lấy tên người mua
    {
        return $this->belongsTo(User::class, 'tr_user_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id', 'p_transaction_id');
    }

    public function userSale() // Lấy tên người bán
    {
        return $this->belongsTo(User::class, 'tr_user_sale');
    }

}
