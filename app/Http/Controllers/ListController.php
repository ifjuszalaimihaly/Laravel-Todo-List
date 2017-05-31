<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ListController extends Controller
{
    public function index(){
    	$items = Item::all();
    	//return $items;
    	return view('list',compact('items'));
    }

    public function create(request $request){
    	$item = new Item;
    	$item->item = $request->text;
    	$item->save();
    	return "Done";
    	//return $request->all();

    }

    public function delete(request $request){
    	Item::where('id', $request->id)->delete();
    	return $request->all();
    }

    public function update(request $request){
    	$item = Item::find($request->id);
    	$item->item = $request->value;
    	$item->save();
    	return $request->all();
    } 

    public function search(request $request){
    	/*$item = Item::find($request->id);
    	$item->item = $request->value;
    	$item->save();
    	return $request->all();*/
    	$search = $request->term;
    	$items = Item::where('item','LIKE','%'.$search.'%')->get();
    	//return $item;
    	if(count($items)==0){
    		$serarcResult[]="No item found";
    	} else {
    		foreach ($items as $key => $value) {
    			$serarcResult[]= $value->item;
    		}
    	}
    	return $serarcResult;
    }
}
