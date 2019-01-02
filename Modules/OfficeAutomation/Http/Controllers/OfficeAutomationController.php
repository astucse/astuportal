<?php

namespace Modules\OfficeAutomation\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Org\Entities\Department;
use Modules\Org\Entities\Office;
use App\Models\Employee;
use App\Models\Option;
use App\Helpers\LetterHelper;
use Illuminate\Support\Facades\Input;
use Modules\OfficeAutomation\Entities\Letter;
use Auth;
use App\Helpers\CypherHelper;

class OfficeAutomationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function letter($id){
        $d = Letter::findOrFail($id);
        return view('officeautomation::letter',[
            'body' => $d->body,
            'to' => $d->recipietents[0]->name,
            'sender' => $d->owner->name,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('officeautomation::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('officeautomation::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('officeautomation::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
