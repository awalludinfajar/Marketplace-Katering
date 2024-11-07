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
    public function index() : Response {
        $menu = MenuKatering::paginate(5);
        return Inertia::render('Katering/List', [
            'menu' => $menu,
        ]);
    }

    public function form($id) : Response {
        return Inertia::render('Katering/Form', [
            'menu' => $id !== 0 ? MenuKatering::find($id) : ''
        ]);
    }

    public function update(MenuKateringRequest $request, $id) {

        // if ($request->file('gambar') instanceof \Illuminate\Http\UploadedFile) {
        //     $request->validate([
        //         'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
        //     ]);

        // }

        $menus = $request;
        dd($menus);
        // $oldData = MenuKatering::find($id);
        // dd($oldData);

        return null;
    }

    public function store(MenuKateringRequest $request) {
        $request->validate([
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $menus = $request->validated();

        $pathImage = $menus['gambar']->store('images', 'public');
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

    public function delete($id) {
        $data = MenuKatering::find($id);
        
        if (!$data) {
            return response()->json(['message' => 'Data not Found'], 404);
        }

        $sUrl = explode('/', $data->gambar);
        $url = $sUrl[count($sUrl)-2].'/'.$sUrl[count($sUrl)-1];

        if (Storage::disk('public')->exists($url)) {
            Storage::disk('public')->delete($url);
        }

        $data->delete();
        return response()->json(['message' => 'Data Successfully Deleted']);
    }
}
