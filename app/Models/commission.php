<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commission extends Model
{
    use HasFactory;

    protected $fillable = [
        'commissionName',
        'president',
        'objectives',
        'overview',
        'meetingDay',
        'fromm',
        'too',
        'picture'
    ];
}
