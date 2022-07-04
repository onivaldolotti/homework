<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class SellerController extends Controller
{
    public function index()
    {
        try
        {
            return response()->json(
                [
                    'data' => Seller::all(),
                    'success' => true,
                ],
                Response::HTTP_OK
            );
        }catch(Exception $e){
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'success' => false
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:sellers,email|email',
        ]);

        try{
            $newSeller = $request->only([
                'name',
                'email'
            ]);

            $seller = Seller::create($newSeller);

            $seller['commission'] = number_format($seller['commission'],2,",",".");

            return response()->json(
                [
                    'data' => $seller,
                    'success' => true,
                ],
                Response::HTTP_CREATED
            );

        }catch(Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'success' => false
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}
