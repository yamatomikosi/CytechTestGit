<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductSearchFormController extends Controller
{


    public function productInformantsPage(Request $request)
    {
        $companies = new Companies();
        $companies = $companies->getList();

        $name = $request->input('product_name');
        $meka = $request->input('company_id');

        $products = Products::select('products.id', 'products.product_name', 'products.price', 'products.stock', 'products.comment', 'products.img_path', 'companies.id as company_id', 'companies.company_name')
            ->join('companies', 'products.companie_id', '=', 'companies.id')->get();
        if (!empty($name) && !empty($meka)) {
            $products = $products->where('product_name', $name)->whereHas('companies', function ($query) use ($meka) {
                $query->where('company_name', $meka);
            });
        }
        return view('contents/product_informants', ['products' => $products, 'companies' => $companies]);
    }

    public function productRegisterForm(Request $request)
    {
        $date = $request->all();
        $products = new Products();
        $companies = new Companies();
        if (!empty($date)) {
            $image = $request->file('img_path')->store('public/images');
            $filename = basename($image);
            $products->createtDate($date['companie_id'], $date['product_name'], $date['price'], $date['stock'], $date['comment'], "storage/images/" . $filename);
        }

        $companies = $companies->getList();
        return view('contents/product_register', ['companies' => $companies]);
    }
    public function productSpecificPage(Request $request)
    {
        $id = $request->input('product_id');
        $product = new Products();
        $product = $product->getColumu($id);
        return view('contents/product_specific', ['product' => $product]);
    }
    public function productInformantEditForm(Request $request)
    {
        $date = $request->all();
        $products = new Products();
        $companies = new Companies();
        $companies = $companies->getList();

        if ($request->isMethod('post')) {
            $image = $request->file('img_path');
            $filename = basename($image);
            $fileExists = Storage::exists('public/images/' . $image->getClientOriginalName());

            if ($fileExists) {
                $image->store('public/images');
            }
            $products = $products->updateDate($date['id'], $date['companie_id'], $date['product_name'], $date['price'], $date['stock'], $date['comment'], "storage/images/" . $filename);
        }
        return view('contents/product_informant_edit', ['date' => $date, 'companies' => $companies]);
    }
}
