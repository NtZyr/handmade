<?php

use Core\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = App\Product::all();

        echo 'shop';
        // view('product/index');
        // return lol;
    }
}
