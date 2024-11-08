<?php

namespace App\Http\Controllers;

use App\Http\Requests\MerchantUpdateRequest;
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

    public function update(MerchantUpdateRequest $merchant): RedirectResponse {
        $merchants = $merchant->validated();
        
        $merchant->user()->merchantProfile()->update($merchants);

        return Redirect::route('merchant.edit');
    }
}
