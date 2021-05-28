<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit_notes extends Model
{
    use HasFactory;
    protected $fillable = [
        "deposit_id",
        "node",
        "qty"
    ];
}
