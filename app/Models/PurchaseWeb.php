<?php

namespace App\Models;

use App\Models\Website;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseWeb extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function website()
    {
        return $this->belongsTo(Website::class, 'web_id');
    }
}
