<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    function show(Visitor $visitor) {

        return view('visitor.detail', ['visitor' => $visitor]);
    }
}
