<?php

namespace App\Http\Controllers;

use App\Models\MenuKatering;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{
    public function index() : Response {
        return Inertia::render('Order/List', []);
    }

    public function details($id) : Response {
        $menu = MenuKatering::find($id);

        return Inertia::render('Order/DetailsCustomer', [
            'id' => $id,
            'menu' => $menu
        ]);
    }
}
