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
        
        $form = request() -> all();
        if (isset($form['is_search']) && $form['is_search'] == true) {
           
            $price = ['min' => $form['price_min'], 'max' => $form['price_max']];
            $stock = ['min' => $form['stock_min'], 'max' => $form['stock_max']];
    
             $products_list = $products->searchList($form['product_name'], $form['company_id'], $price, $stock);
             return response()->json($products_list); 
        } 
        
        if ($request->has('remove_id')) {
            DB::beginTransaction();
            try {
                $productId = $request->input("remove_id");
              $product = $products->find($productId);
            if ($product) {
                $product->delete();
            }
                DB::commit();
                
            } catch (\Exception $e) {
                DB::rollback();
                return back();
            }
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
