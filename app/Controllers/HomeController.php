<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class HomeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return RedirectResponse
     */
    public function index(): RedirectResponse
    {
        return redirect()->to('employees');
    }
}
