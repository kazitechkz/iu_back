<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\BadRequestException;
use App\Http\Controllers\Controller;
use App\Services\PromoService;
use App\Services\ResponseService;
use App\Traits\ResponseJSON;
use Illuminate\Http\Request;
use Mockery\Exception;

class PromoCodeController extends Controller
{
    private PromoService $promoService;

    public function __construct(PromoService $promoService)
    {
        $this->promoService = $promoService;
    }

    public function checkPromo(Request $request)
    {
        try {
            $this->validate($request, ['code' => 'required']);
            return response()->json(new ResponseJSON(status: true, data: $this->promoService->check($request['code'])));
        } catch (Exception $exception) {
            return ResponseService::DefineException($exception);
        }
    }
}
