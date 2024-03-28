<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightMachine extends Model
{
    use HasFactory;
    protected $fillable = [
        'trip_id', 'ledger_id', 'item_id', 'ticket_no', 'weightype', 'vehicle_no', 'party_code', 'item_code', 'charges', 'dc_no', 'grosswt', 'tarewt', 'netwt', 'gross_date', 'taredate', 'netdate', 'paymentmode', 'party_name', 'product_name'
    ];
}
