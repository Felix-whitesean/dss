<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;

class TermsController extends Controller
{
    //
    public function showTerms(){
        $phpWord = IOFactory::load(storage_path('app/terms.docx'));
        $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');

        // Save the HTML on the fly
        $htmlPath = storage_path('app/terms.html');
        $htmlWriter->save($htmlPath);

        $content = file_get_contents($htmlPath);

        return view('terms', compact('content'));
    }
}
