<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Hash;

class CrudCont extends Controller
{
    public function inOrUp(Request $req)
    {
    	$cus=new Customer();
    	If($req->id)
    	{
    		$cus=$cus->find($req->id);
    	}
        else
            $cus->pass=Hash::make($req->pass);
        
    	$cus->name=$req->name;
    	$cus->email=$req->email;
    	$cus->gender=$req->gender;
    	$cus->country=$req->country;
    	$result=$cus->saveOrFail();
    	return;
    }

    public function read()
    {
    	$data= Customer::all();
    	return response()->json(array("data"=>$data));
    }

    public function del(Request $req)
    {
    	$cus=Customer::find($req->id);
    	$cus->delete();
    	return;
    }
}
