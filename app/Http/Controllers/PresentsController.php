<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormCreatePresentRequest;
use App\Models\Presents;
use Illuminate\Http\Request;

class PresentsController extends Controller
{
    public function show(Request $request)
    {
        $view = $request->input('view','grid');

        $presents = Presents::all();

        return view('presents', compact('presents','view'));
    }

    public function createPresent(Request $request) {
        $user = auth()->user();
        if(empty($user) || !$user->hasPermissionTo('createPresent')) {
            abort(403,'no permission');
        }
        return view('presents-create');
    }


    public function storePresent(FormCreatePresentRequest $request) {
        $present = new Presents($request->all());
        $present->save();
        return redirect()->route('presents.show')
            ->with('success','Present was created successfully.');
    }
}
