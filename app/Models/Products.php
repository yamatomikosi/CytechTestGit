<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Companies;
use Illuminate\Support\Facades\Storage;

class Products extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getList()
    {
        $Products = $this->with('companies')->get();
        return $Products;
    }

    public function getColumu($id)
    {
        $Product = $this->where('id', $id)->with('companies')->first();

        return $Product;
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
