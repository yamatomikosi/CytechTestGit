<?php

namespace App\Http\Controllers\API;

use App\Models\Products;
use App\Models\api\Sales;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ApiController extends Controller
{
    public function buy(Request $request)
    {
        DB::beginTransaction();
       try {

        $product_id = $request->get('product_id');

        $product = Products::find($product_id);

        if($product){

            if($product->stock > 0){

                $product->decrement('stock');

                $sales = new Sales();
                     $sales->CreateDate($product_id);
                 DB::commit();
                 return response()->json(['message' => '成功'], 200);
            } else {
            return response()->json(['error' => '在庫切れです'], 400);
                 }

        }else{
            return response()->json(['error' => '該当品がありません'], 404);
        }

        } catch(\Exception $e){

            $result = [
                'result' => false,
                'error' => [
                    'messages' => [$e->getMessage()]
                ],
            ];
            return $this->resConversionJson($result, $e->getCode());
        }
        return $this->resConversionJson($result);
    }

    private function resConversionJson($result, $statusCode=200)
    {
        if(empty($statusCode) || $statusCode < 100 || $statusCode >= 600){
            $statusCode = 500;
        }
        return response()->json($result, $statusCode, ['Content-Type' => 'application/json'], JSON_UNESCAPED_SLASHES);
    }
}
