<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\UsersAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class AddressController extends Controller
{
    public function index(Request $request) : Response {
        $data = UsersAddress::where('user_id', $request->user()->id)->get();
        return Inertia::render('Profile/Address/List', [
            'address' => [
                'data' => $data
            ]
        ]);
    }

    public function form(Request $request, $id) : Response {
        return Inertia::render('Profile/Address/Form', [
            'addresses' => $id !== 0 ? UsersAddress::where('user_id', $request->user()->id)->find($id) : ''
        ]);
    }

    public function store(AddressRequest $request) {
        $address = $request->validated();

        UsersAddress::create([
            'user_id' => $request->user()->id,
            'type_address' => $address['typeAddress'],
            'province' => $address['province'],
            'city' => $address['city'],
            'address' => $address['address'],
            'post_code' => $address['postCode'],
            'primary' => $address['mainAddress']
        ]);
        return Redirect::route('address.list');
    }

    public function update(AddressRequest $request, $id) {
        $address = $request->validated();
        $data = UsersAddress::find($id);

        $data->update([
            'user_id' => $request->user()->id,
            'type_address' => $address['typeAddress'],
            'province' => $address['province'],
            'city' => $address['city'],
            'address' => $address['address'],
            'post_code' => $address['postCode'],
            'primary' => $address['mainAddress']
        ]);

        return Redirect::route('address.list');
    }

    public function delete($id) {
        $data = UsersAddress::find($id);

        $data->delete();
        return response()->json(['message' => 'Data Successfully Deleted']);
    }
}
