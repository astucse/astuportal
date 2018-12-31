<?php

namespace Modules\OfficeAutomation\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class EmployeeController extends Controller
{
    
    public function new_letter(){
        return view('officeautomation::employee.new_letter');
    }


}
