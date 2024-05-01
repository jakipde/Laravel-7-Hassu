<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    protected $fillable = [
        'part_id',
        'customer_id',
        'rak_id',
        'shift',
        'in',
        'out',
        'sisa',
        'pic',
        'pic_name',
        'keterangan',
    ];

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }
    
}
