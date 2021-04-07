<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Postscomments;
use App\Replaycomments;

class ReplaycommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comments = Replaycomments::with('Postscomments')->with('Client')->where('approve', 0)->when($request->search, function ($q) use ($request) {

            return $q->where('replaytext', 'like', '%' . $request->search . '%');
        })->latest()->paginate(8);
        //dd( $comments);
     
        return view('dashboard.replaycomments.index', compact('comments'));
    }


    public function edit($id)
    {
        $data['approve'] = 1;
        Replaycomments::where('id', $id)->update($data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.replaycomments.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Replaycomments::where('id', $id)->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.replaycomments.index');
    }
}
