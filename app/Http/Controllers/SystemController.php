<?php
namespace App\Http\Controllers;

class SystemController extends Controller{
    protected $systemName;
    protected $systemVersion;

    public function __construct() {
        $this->systemName = 'Digital safe space';
        $this->systemVersion = '2.0.0';
    }
}
