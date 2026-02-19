<?php

namespace App\Http\Controllers;
class DashboardController extends SystemController{
    public function index(){
        parent::__construct();
        $dashboardType = 'admin';

        return view('layouts/dashboard/index', [
            'name' => $this->systemName,
            'version' => $this->systemVersion,
            'dashboardType' => $dashboardType ?? '',
        ]);
    }
}
