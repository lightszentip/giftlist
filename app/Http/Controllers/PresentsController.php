<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormCreatePresentRequest;
use App\Models\PresentLinks;
use App\Models\Presents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresentsController extends Controller
{
    public function show(Request $request)
    {
        $view = $request->input('view', 'grid');

        $presents = Presents::where('status', 1)->orWhere('status', 2)->get();

        return view('presents', compact('presents', 'view'));
    }

    public function createPresent(Request $request)
    {
        $user = auth()->user();
        if (empty($user) || !$user->hasPermissionTo('createPresent')) {
            abort(403, 'no permission');
        }
        return view('presents-create', ['present' => new Presents()]);
    }

    public function editPresent(Request $request,Presents $present)
    {
        $user = auth()->user();
        if (empty($user) || !$user->hasPermissionTo('createPresent')) {
            abort(403, 'no permission');
        }
        return view('presents-edit', ['present' => $present]);
    }

    public function selectPresent(Request $request,Presents $present)
    {
        if($present->status == 2) {
            return redirect()->route('presents.show')
                ->with('error', __('presents.share_error', ['title' => $present->title, 'id' => $present->id]));
        }
        if(config('app.presentlist_code') == 'CODE') {
            $present->usePresent();
        } else {
            $codeText = $request->input('codeText');
            $present->usePresent($codeText,false);
        }
        $present->save();
        return redirect()->route('presents.show')
            ->with('success', __('presents.share_success', ['title' => $present->title, 'id' => $present->id,'code' => $present->code]));
    }

    public function detailsPresent(Presents $present)
    {
        return view('presents-details', ['present' => $present]);
    }

    public function savePresent(FormCreatePresentRequest $request, Presents $present)
    {
        $links = $request->input('links');

        $present = Presents::withoutEvents(function () use ($request,$present, $links) {
            $present->imagepath = $request->input('imagepath');
            $present->title = $request->input('title');
            $present->description = $request->input('description');
            $present->save();
            $present->links()->delete();
            if (!empty($links)) {
                $newLinks = array();
                foreach ($links as $link) {
                    if (!is_null($link)) {
                        $saveLink = new PresentLinks(['link' => $link, 'presents_id' => $present->id]);
                        $saveLink->save();
                    }
                }

            }
            $present->save();
            return $present;
        });
        return redirect()->route('presents.management')
            ->with('success', __('presents.create_success', ['title' => $present->title, 'id' => $present->id]));
    }

    public function storePresent(FormCreatePresentRequest $request)
    {
        $links = $request->input('links');

        $present = Presents::withoutEvents(function () use ($request, $links) {
            $present = new Presents($request->all());
            $present->save();
            if (!empty($links)) {
                $newLinks = array();
                foreach ($links as $link) {
                    if (!is_null($link)) {
                        $saveLink = new PresentLinks(['link' => $link, 'presents_id' => $present->id]);
                        $saveLink->save();
                    }
                }

            }
            $present->save();
            return $present;
        });
        return redirect()->route('presents.management')
            ->with('success', __('presents.create_success', ['title' => $present->title, 'id' => $present->id]));
    }

    public function deletePresent(Presents $present) {
        $user = auth()->user();
        if (empty($user) || !$user->hasPermissionTo('deletePresent')) {
            abort(403, 'no permission');
        }
        $title = $present->title;
        $id = $present->id;
        $present->delete();
        return redirect()->route('presents.management')
            ->with('success', __('presents.delete_success', ['title' => $title, 'id' => $id]));
    }

    public function presentManagement(Request $request)
    {
        if (Auth::user() == null || !Auth::user()->hasPermissionTo('releasePresent')) {
            abort(403,'NO PERMISSION');
        }
        $presents = Presents::all();

        return view('presents-management', compact('presents'));
    }

    public function releasePresent(Presents $present)
    {
        if (Auth::user() == null || !Auth::user()->hasPermissionTo('releasePresent')) {
            abort(403,'NO PERMISSION');
        }
        $present->releasePresent();
        $present->save();

        return redirect()->route('presents.management')
            ->with('success', __('presents.release_success', ['title' => $present->title, 'id' => $present->id]));
    }

    public function draftPresent(Presents $present)
    {
        if (Auth::user() == null || !Auth::user()->hasPermissionTo('releasePresent')) {
            abort(403,'NO PERMISSION');
        }
        $present->draftPresent();
        $present->save();

        return redirect()->route('presents.management')
            ->with('success', __('presents.draft_success', ['title' => $present->title, 'id' => $present->id]));
    }
}
