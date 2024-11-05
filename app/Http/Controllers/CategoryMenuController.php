<?php

namespace App\Http\Controllers;

use App\Models\CategoryMenu;
use Illuminate\Http\Request;

class CategoryMenuController extends Controller
{
    public function optionData() {
        $list = CategoryMenu::get();
        return response()->json($list);
    }
}
