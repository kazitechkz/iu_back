<?php

namespace App\Services;
use App\Exceptions\BadRequestException;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CashWithdrawal;

class CashService
{
    public function getHistories()
    {
        $user = auth()->guard('api')->user();
        return CashWithdrawal::where('user_id', $user->id)->with('cash')->latest()->get();
    }

    /**
     * @throws BadRequestException
     */
    public function requestWithdraw(Request $request, User $user): void
    {
        $user->phone = $request['phone'];
        $user->save();
        if (CashWithdrawal::where(['user_id' => $user->id, 'status' => false])->first()) {
            throw new BadRequestException('У вас уже имеется заявка на вывод средств');
        }
        CashWithdrawal::create([
            'user_id' => $user->id,
            'cash_id' => $user->cash->id,
            'status' => false,
            'balance' => $user->cash->balance
        ]);
    }
}
