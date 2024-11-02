<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MenuKateringController extends Controller
{
    public function index(Request $request) : Response {
        return Inertia::render('Katering/List', [
            'text' => 'Pilihan Menu',
        ]);
    }

    public function create() : Response {
        return Inertia::render('Katering/Form', [
            'text' => 'Buat Menu Makanan',
        ]);
    }
}
