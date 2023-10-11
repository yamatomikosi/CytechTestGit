<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Companies extends Model
{
    public function getList()
    {
        $Companies = DB::table('companies')->get();

        return $Companies;
    }

    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
