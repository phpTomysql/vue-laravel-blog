<?php

namespace App\Http\Controllers\api\v1;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index() {

        $category = Category::all();
        return response()->json($category, 200);

    }
}
