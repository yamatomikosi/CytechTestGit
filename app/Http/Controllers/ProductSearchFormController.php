<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        if ($name) {
            $products_list = $products_list->filter(function ($product) use ($name) {
                return stripos($product->product_name, $name) !== false;;
            });
        }
        if ($meka) {
            $products_list = $products_list->where('companie_id', $meka);
        }

        DB::beginTransaction();
        try {
            if ($request->has('product_id')) {
                $productId = $request->input('product_id');
                $products->deleteDate($productId);
                DB::commit();
                return redirect()->route('prodInts');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back();
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
            DB::beginTransaction();
            try {
                $products = $products->updateOrCreateDate($date, $image);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return back();
            }
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
    
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                $image = $request->file('img_path');
                $date = $request->all();
                $products = $products->updateOrCreateDate($date, $image);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return back();
            }
        }
        return view('contents/product_informant_edit', ['date' => $date, 'companies' => $companies]);
    }
}
