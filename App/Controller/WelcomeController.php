<?php

namespace App\Controller;

use System\Controller;

class WelcomeController extends Controller
{
    public function __construct()
    {
        // Constructor
    }

    public function index()
    {
        return $this->view('Welcome');
    }
}
