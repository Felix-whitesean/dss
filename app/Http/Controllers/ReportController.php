<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function report(Request $request){
        if (!$request->cookie('accepted_terms')) {
            // 2. Redirect if it's missing
            return redirect()->route('terms.show');
        }
        return view('layouts.report.index');
    }

}
