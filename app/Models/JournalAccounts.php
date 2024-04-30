<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalAccounts extends Model
{
    use HasFactory;
    
    protected $table = 'journal_accounts';

    protected $fillable = [
        'journal_code',
        'ref',
        'note',
        'amount',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->journal_code = 'JUR#' . $model->journal_code;
        });
    }
}
