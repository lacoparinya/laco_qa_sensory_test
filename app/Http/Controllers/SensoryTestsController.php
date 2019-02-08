<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SensoryTestM;
use App\SensoryMaster;
use Illuminate\Http\Request;

class SensoryTestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $sensorytests = SensoryTestM::latest()->paginate($perPage);
        } else {
            $sensorytests = SensoryTestM::latest()->paginate($perPage);
        }

        return view('sensory-tests.index', compact('sensorytests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('sensory-tests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();

        SensoryTestM::create($requestData);

        return redirect('sensory-tests')->with('flash_message', ' added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $sensorytest = SensoryTestM::findOrFail($id);

        return view('sensory-tests.show', compact('sensorytest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $sensorytest = SensoryTestM::findOrFail($id);

        return view('sensory-tests.edit', compact('sensorytest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();

        $sensorytest = SensoryTestM::findOrFail($id);
        $sensorytest->update($requestData);

        return redirect('sensory-tests')->with('flash_message', ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        SensoryTestM::destroy($id);

        return redirect('sensory-tests')->with('flash_message', ' deleted!');
    }

    public function runtest($id){
        $sensorymaster = SensoryMaster::findOrFail($id);

        return view('sensory-tests.runtest', compact('sensorymaster'));
    }
}
