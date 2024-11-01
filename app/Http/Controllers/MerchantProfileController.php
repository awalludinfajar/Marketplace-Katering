<?php

namespace App\Http\Controllers;

use App\Http\Requests\MerchantUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MerchantProfileController extends Controller
{
    public function edit(Request $request): Response {
        return Inertia::render('Merchant/Edit', [
            'merchant' => $request->user()->merchantProfile
        ]);
    }

    public function update(MerchantUpdateRequest $merchant, User $user): RedirectResponse {
        $merchants = $merchant->validated();
        // dd($merchants);
        $user->merchantProfile()->update($merchants);
        // $merchantProfile->update($merchants);
        return Redirect::route('merchant.edit');
    }
}
