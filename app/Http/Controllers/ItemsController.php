<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::latest()->get();
        return response()->json($items);
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
        $validation = Validator::make($request->all(), [
            'text'  => 'required',
            'body'  =>  'required'
        ]);

        if($validation->fails()) {
            $response = [
                'response'  => $validation->messages(),
                'success'   => false,
            ];
            return $response;
        } else {
            $item = new Item;
            $item->text     = $request->input('text');
            $item->body     = $request->input('body');

            $item->save();

            return response()->json($item);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $validation = Validator::make($request->all(), [
            'text'  => 'required',
            'body'  =>  'required'
        ]);

        if($validation->fails()) {
            $response = [
                'response'  => $validation->messages(),
                'success'   => false,
            ];
            return $response;
        } else {
            $item = Item::find($id);
            $item->text     = $request->input('text');
            $item->body     = $request->input('body');

            $item->save();

            return response()->json($item);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();

        $response = [
            'response'  => 'Item Deleted!',
            'success'   => true,
        ];
        return $response;
    }
}
