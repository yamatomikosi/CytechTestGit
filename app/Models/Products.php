<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Companies;
use App\Models\API\Sales;
use Illuminate\Support\Facades\Storage;
use Termwind\Components\Raw;

class Products extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getList()
    {
        $products = $this->with('companies')->get();
        return $products;
    }

    public function getColumu($id)
    {
        $product = $this->where('id', $id)->with('companies')->first();

        return $product;
    }   
    public function searchList($name, $meka, $price, $stock) {
        $query = $this->newQuery();
    
        if ($name) {
            $query->where(function ($query) use ($name) {
                $query->where('product_name', 'like', '%' . $name . '%');
            });
        }
    
        if ($meka) {
            $query->where('companie_id', $meka);
        }
    
        $query->whereBetween('price', [
            $price['min'] ?? 0,
            $price['max'] ?? PHP_INT_MAX,
        ]);
        
        $query->whereBetween('stock', [
            $stock['min'] ?? 0 ,
            $stock['max'] ?? PHP_INT_MAX,
        ]);
        $products_list = $query->with('companies')->get();
    
        return $products_list;
    }


    public function updateOrCreateDate($date, $image)
    {

        if (isset($image)) {
            $filename = $image->getClientOriginalName();
            $fileExists = Storage::exists('public/images/' . $filename);
            if (!$fileExists) {
             $image->storeAs('public/images', $filename);
            }
        } else {
            $filename = null;
        }


        $this->query()->updateOrCreate(
            ['id' => $date['id']],
            [
                'companie_id' => $date['companie_id'],
                'product_name' => $date['product_name'],
                'price' => $date['price'],
                'stock' => $date['stock'],
                'comment' => $date['comment'],
                'img_path' => 'storage/images/' .$filename
            ]
        );
    }
    public function deleteDate($id)
    {
        $product = $this->where('id', $id)->first();

        if ($product) {
            $product->delete();
            session()->flash('success', '商品が削除されました');
        }
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
