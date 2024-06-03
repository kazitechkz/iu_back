<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Bavix\Wallet\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (auth()->user()->can("wallet index")) {
                return view("admin.wallet.index");
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    public function requestWithdrawals()
    {
        try {
            if (auth()->user()->can("wallet index")) {
                return view("admin.wallet.withdraw");
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            if (auth()->user()->can("wallet create")) {
                return view("admin.wallet.create");
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            if (auth()->user()->can("wallet create")) {

            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            if (auth()->user()->can("wallet show")) {

            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            if (auth()->user()->can("iucoins edit")) {
                $wallet = Wallet::findOrFail($id);
                $user = User::find($wallet->holder_id);
                return view("admin.wallet.edit", compact("user"));
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            if (auth()->user()->can("wallet edit")) {

            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if (auth()->user()->can("wallet edit")) {
                return null;
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    public function getIuCoins()
    {
        try {
            if (auth()->user()->can("iucoins index")) {
                return view('admin.wallet.iu');
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }

    public function postIuCoins(Request $request)
    {
        try {
            if (auth()->user()->can("iucoins edit")) {
                $user = User::find($request['user']);
                if (intval($request['balance']) < 0) {
                    $user->withdraw(abs(intval($request['balance'])));
                } else {
                    $user->deposit(abs(intval($request['balance'])));
                }
                return redirect(route('get-iu-coins'));
            } else {
                toastr()->warning(__("message.not_allowed"));
                return redirect()->route("home");
            }
        } catch (\Exception $exception) {
            toastr()->error($exception->getMessage(), "Error");
            return redirect()->route("home");
        }
    }
}
