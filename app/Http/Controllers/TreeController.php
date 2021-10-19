<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tree;
use App\Utility\NotificationUtility;
use Auth;

class TreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->user_type == 'admin'){
            $trees = Tree::latest()->paginate(15);
            return view('club_points.trees.index', compact('trees'));
        } else {
            $trees = Tree::where('user_id', Auth::user()->id)->latest()->paginate(15);
            return view('club_points.frontend.trees.index', compact('trees'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function show(Tree $tree)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tree = Tree::where('id', decrypt($id))->first();
        return view('club_points.trees.edit', compact('tree'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tree $tree)
    {
        $tree               = $tree;
        $tree->name         = $request->name;
        $tree->latitude     = $request->latitude;
        $tree->longitude    = $request->longitude;
        $tree->caretaker    = $request->caretaker;
        $tree->location     = $request->location;
        $tree->planted_at   = date('Y-m-d H:i:s');
        
        $tree->save();

        NotificationUtility::sendTreeNotification($tree);

        flash(translate('Tree info has been updated successfully'))->success();
        return redirect()->route('trees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tree  $tree
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tree $tree)
    {
        //
    }

    public function tree_location($id)
    {
        $data['tree_data'] = Tree::findOrFail($id);
        
        $returnHTML = view('club_points.frontend.trees.tree_location_modal', $data)->render();
        return response()->json(array('data' => $data, 'html'=>$returnHTML));
    }
}
