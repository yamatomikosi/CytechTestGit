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
        $products = new Products();
        $products_list = $products->getList();
        $companies = new Companies();
        $companies = $companies->getList();

        $name = $request->input('product_name');
        $meka = $request->input('company_id');
        if($name){
            $products_list = $products_list->where('product_name','like',"%$name%");
            }
            if($meka){
                $products_list = $products_list->where('companie_id', $meka);
            }
            
            if($request->has('product_id')){
                $productId = $request->input('product_id');
                $products->deleteDate($productId);
                return redirect()->route('prodInts');
            }
        return view('contents/product_informants', ['products' => $products_list, 'companies' => $companies]);
    }

    public function productRegisterForm(Request $request)
    {
        $date = $request->all();
        $products = new Products();
        $companies = new Companies();
        $companies = $companies->getList();
        $image = $request->file('img_path');

        if ($request->isMethod('post')) {
            $products = $products->updateOrCreateDate($date, $image);
        }

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
        $id = $request->input('id');
        $products = new Products();
        $date = $products->getColumu($id);
        $companies = new Companies();
        $companies = $companies->getList();
        $image = $request->file('img_path');
        
        if ($request->isMethod('post')) {
            
            $date = $request->all();
            $products = $products->updateOrCreateDate($date, $image);
        }
        return view('contents/product_informant_edit', ['date' => $date, 'companies' => $companies]);
    }
}
