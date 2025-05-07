<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table = 'enquiries';
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'service',
        'reference',
        'city',
        'type',
        'date',
        'status',
        'user_id',
        'reason',
        'converted_by',
        'assigned_to',
        'assigned_by'
    ];
    use HasFactory;
}
