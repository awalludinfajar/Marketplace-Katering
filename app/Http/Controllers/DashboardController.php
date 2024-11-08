<?php

namespace App\Http\Controllers;

use App\Models\MenuKatering;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(Request $request) : Response {
        $getId = $request->input('selectedId', 0);

        $query = MenuKatering::query();
        if ($getId) {
            $query->where('category_menu_id', $getId);
        }

        $menu = $query->paginate(20);
        return Inertia::render('Dashboard', [
            'menu' => [
                'data' => $menu
            ],
            'selectedId' => $getId
        ]);
    }
}
