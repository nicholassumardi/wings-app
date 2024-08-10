<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected $dataView;

    public function __construct()
    {
        $this->dataView = [
            'title' => 'Dashboard Admin'
        ];
    }

    public function index()
    {
        $this->dataView['content'] = 'admin.dashboard';


        return view('admin.layouts.index', ['data' => $this->dataView]);
    }
}
