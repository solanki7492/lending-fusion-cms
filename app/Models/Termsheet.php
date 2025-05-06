<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Termsheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'merchant_name',
        'first_name',
        'last_name',
        'sent_to',
        'termsheet',
        'loan_amount',
        'origination_fee',
        'net_loan_amount',
        'monthly_payment',
        'interest_rate',
        'loan_type_and_program_type',
        'loan_type_and_program',
        'additional_financing_available',
        'status',
        'notes',
        'email_sent_at',
    ];

    public function emails()
    {
        return $this->hasMany(TermsheetEmail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
