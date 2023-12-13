<?php

namespace App\Http\Controllers\Application\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateSchoolController extends Controller
{
    public function __invoke()
    {
        return view('create-school');
    }
}
