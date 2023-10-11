<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sales extends Model
{
    public function getList() {
        $Sales = DB::table('sales')->get();

        return $Sales;
    }
    public function products()
    {
        return $this->belongsTo(Products::class);
    }
}
