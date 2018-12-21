<?php

use Core\Controller;

class PageController extends Controller
{
    public function show($slug = null)
    {
        if ($slug == '') {
            return view('home');
        } else {
            return view('page');
        }
    }
}