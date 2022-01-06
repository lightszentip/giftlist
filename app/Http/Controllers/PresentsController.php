<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormCreatePresentRequest;
use App\Models\PresentLinks;
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
        return view('presents-create',['present' => new Presents()]);
    }


    public function storePresent(FormCreatePresentRequest $request) {
        $links = $request->input('links');

        $present = Presents::withoutEvents(function () use ($request,$links) {
            $present = new Presents($request->all());
            $present->save();
            if(!empty($links)) {
                $newLinks = array();
                foreach ($links as $link) {
                    if(!is_null($link)) {
                        $saveLink = new PresentLinks(['link'=>$link,'presents_id'=>$present->id]);
                        $saveLink->save();
                    }
                }

            }
            $present->save();
            return $present;
        });
        return redirect()->route('presents.show')
            ->with('success',__('presents.create_success',['title'=>$present->title, 'id'=> $present->id]));
    }
}
