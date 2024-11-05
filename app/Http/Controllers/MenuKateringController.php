<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuKateringRequest;
use App\Models\MenuKatering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class MenuKateringController extends Controller
{
    public function index(Request $request) : Response {
        return Inertia::render('Katering/List', [
            'menu' => MenuKatering::get(),
        ]);
    }

    public function form() : Response {
        return Inertia::render('Katering/Form', []);
    }

    public function store(MenuKateringRequest $request) {
        $menus = $request->validated();

        $pathImage = $request->file('gambar')->store('public/image');
        $url = Storage::url($pathImage);

        MenuKatering::create([
            'merchant_profile_id' => $request->user()->merchantProfile->id,
            'category_menu_id' => $menus['category_id'],
            'nama' => $menus['nama'],
            'deskripsi' => $menus['deskripsi'],
            'price' => $menus['harga'],
            'gambar' => $url,
            'qty' => $menus['qty']
        ]);

        return Redirect::route('menu.list');
    }
}
