<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'status',
        'plan_id',
        'plan_data',
        'payment_method',
        'organization_id'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
