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
        $getId = $request->input('refSelectedId', 0);

        $query = MenuKatering::query();
        if ($getId) {
            $query->where('category_menu_id', $getId);
        }

        $menu = $query->where('merchant_profile_id', $request->user()->merchantProfile()->get()[0]->id)->paginate(5);
        return Inertia::render('Katering/List', [
            'menu' => [
                'data' => $menu
            ],
            'refSelectedId' => $getId
        ]);
    }

    public function form($id) : Response {
        return Inertia::render('Katering/Form', [
            'menu' => $id !== 0 ? MenuKatering::find($id) : ''
        ]);
    }

    public function update(MenuKateringRequest $request, $id) {
        if ($request->file('gambar') instanceof \Illuminate\Http\UploadedFile) {
            $request->validate([
                'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);
        }
        $menus = $request->validated();

        $oldData = MenuKatering::find($id);
        $newUrl = $oldData->gambar;
        if ($menus['gambar'] != "" && $menus['gambar'] !== $oldData->gambar) {
            // if not match it was true
            $sUrl = explode('/', $oldData->gambar);
            $oldUrl = $sUrl[count($sUrl)-2].'/'.$sUrl[count($sUrl)-1];

            if (Storage::disk('public')->exists($oldUrl)) {
                Storage::disk('public')->delete($oldUrl);
            }

            $pathImage = $menus['gambar']->store('images', 'public');
            $newUrl = Storage::url($pathImage);
        }

        $oldData->update([
            'category_menu_id' => $menus['category_id'],
            'nama' => $menus['nama'],
            'deskripsi' => $menus['deskripsi'],
            'price' => $menus['harga'],
            'gambar' => $newUrl,
            'qty' => $menus['qty']
        ]);

        return Redirect::route(('menu.list'));
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
