<?php

use Core\Controller;

class CategoryController extends Controller
{
    public function show($slug = null)
    {
        var_dump($slug);

        // return view('product/index');
    }
}
