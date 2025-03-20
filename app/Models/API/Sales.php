<?php
namespace App\Models\API;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Products;

class Sales extends Model
{
    protected $fillable = ['product_id'];
    
    public function getList() {
        $Sales = DB::table('sales')->get();

        return $Sales;
    }

    public function CreateDate($product_id)
    {
        $this->query()->updateOrCreate(
            ['product_id' => $product_id],
        );
    }
   


    public function products()
    {
        return $this->belongsTo(Products::class);
    }
}
