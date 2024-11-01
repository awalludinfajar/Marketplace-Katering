<?php

namespace App\Http\Controllers;

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

    public function update(Request $request): RedirectResponse {
        return Redirect::route('merchant.edit');
    }
}
