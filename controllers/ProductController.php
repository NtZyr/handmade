<?php

use Core\Controller;

class ProductController extends Controller
{
    public function show($id)
    {
        // $products = App\Product::all();

        var_dump($id);

        // return view('product/index');
    }
}
