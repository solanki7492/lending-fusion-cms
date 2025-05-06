<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermsheetEmail extends Model
{
    protected $fillable = [
        'termsheet_id',
        'email',
    ];
}
