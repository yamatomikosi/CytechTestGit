<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Companies;

class Products extends Model
{
    public function getList()
    {
        $Products = DB::table('products')->get();
        return $Products;
    }

    public function getColumu($id)
    {
        $Product = $this->where('id', $id)->with('companies')->first();

        return $Product;
    }

    public function createtDate($Ci, $Pn, $P, $S, $C = '', $Ip)
    {
        DB::table('products')->insert([
            "companie_id" => $Ci,
            "product_name" => $Pn,
            "price" => $P,
            "stock" => $S,
            "comment" => $C,
            "img_path" => $Ip
        ]);
    }
    public function updateDate($id, $Ci, $Pn, $P, $S, $C = '', $Ip)
    {
        DB::table('products')->where('id', $id)->update([
            "companie_id" => $Ci,
            "product_name" => $Pn,
            "price" => $P,
            "stock" => $S,
            "comment" => $C,
            "img_path" => $Ip
        ]);
    }
    public function deleteDate()
    {
    }
    public function companies()
    {
        return $this->belongsTo(Companies::class, 'companie_id', 'id');
    }
    public function sales()
    {
        return $this->hasMany(Sales::class);
    }
}
