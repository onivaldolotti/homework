<?php

namespace App\Http\Controllers;

use App\Mail\SaleReport;
use Exception;
use App\Models\Sale;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * @OA\Info {
 *  version: 1.0.0
 *  title: Teste Tray
 * }
 * 
 * @OA\Get {
 *  path="/{id}"
 *  description: Lista as vendas de um vendedor
 * }
 */
class SaleController extends Controller
{
    public function store(Request $request): JsonResponse
    {

        $request->validate([
            'seller_id' => 'required|exists:sellers,id',
            'value' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        $commission = number_format($request->value*0.085, 2,'.');

        $newSale = [
            'seller_id' => $request->seller_id,
            'value' => $request->value,
            'commission' => $commission,
        ];

        try{
            $seller = Seller::whereId($request->seller_id)->first();
        
            DB::beginTransaction();

            $newCommission = $seller->commission + $commission; //todo: somar a comissao da venda a do vendedor

            Seller::whereId($request->seller_id)->update(['commission' => $newCommission]);  

            $sale = Sale::create($newSale); 

            $sale->created_at = $sale->created_at->toDateString();

            DB::commit();

            return response()->json(
                [
                    'data' => $sale,
                    'success' => true
                ],
                Response::HTTP_CREATED
            );

        } catch(Exception $e){
            DB::rollBack();
            return response()->json(
                [
                'errors' => $e->getMessage(),
                'success' => false
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }        
    }

    public function listBySellerId(Request $request): JsonResponse
    {
        $request->merge(['id' => $request->route('id')]);
        $sellerId = $request->validate([
            'id' => 'required|exists:sellers',
        ]);

        try{
            $seller = Seller::where(['id' => $sellerId])->first();

            $sales = Sale::where(['seller_id' => $seller->id])->get();  

            return response()->json(
                [
                    'data' => 
                        [
                            'seller_id' => $seller->id,
                            'name' => $seller->name,
                            'email' => $seller->email,
                            "sales" => $sales
                        ],
                    'success' => true
                ],
                Response::HTTP_OK
            );

        } catch(Exception $e){ 
            return response()->json(
                [
                    'errors' => $e->getMessage(),
                    "success" => false
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}
