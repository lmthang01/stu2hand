<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Slide;



class HomeController extends Controller
{
    public function index(){

        $productNews = Product::with('user:id,name,avatar', 'province:id,name')->where('status', Product::STATUS_SUCCESS);

        $categories = Category::all();
        $slides = Slide::all();

        $productNews = $productNews
        ->orderByDesc('id')
        ->paginate(10);

        $viewData = [
            'productNews' => $productNews,
            'categories' => $categories,
            'slides' => $slides,
        ];

        return view('frontend.home.index', $viewData);
    }
}
