<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartofAccounts extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'nb',
        'type',
        'amount',
        'description',
    ];
    
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'code' => 'string',
        ];
    }

}
