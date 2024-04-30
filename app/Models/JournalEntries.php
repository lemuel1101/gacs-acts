<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntries extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'jur_code',
        'description',
        'debit',
        'credit',
    ];

   
}
