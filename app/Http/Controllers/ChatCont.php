<?php

namespace App\Http\Controllers;
use App\Customer;
use App\Message;
use Hash;
use DB;
use Session;
session_start();

use Illuminate\Http\Request;

class ChatCont extends Controller
{
	public function index()
	{
		return view('home');
	}

	public function login(Request $req)
	{
		$email=$req->email;
		$pass=$req->pass;
		$cus=Customer::where('email',$email)->first();

		if($cus && Hash::check($pass,$cus->pass))
		{
			$frnds=Customer::where('id','<>',$cus->id)->get();
			Session::put('cus',$cus);
			Session::put('frnds',$frnds);
			return response()->json(array('cus'=>$cus,'msg'=>null,'frnds'=>$frnds));
		}
		else
		{
			return response()->json(array('msg'=>"Not found", 'cus'=>null,'frnds'=>null));
		}
	}

	public function logout()
	{
		Session::put('cus',null);
		Session::put('frnds',null);
		Session::put('cid',null);
		Session::put('fid',null);
		return;
	}

	public function load()
	{
		$cus=Session::get('cus');
		$frnds=Session::get('frnds');
		if($cus)
		{
			$frnds=Customer::where('id','<>',$cus->id)->get();
		}
		return response()->json(array('cus'=>$cus,'frnds'=>$frnds));
	}

	public function ldmsg(Request $req)
	{
		$cid=$req->cid;
		$fid=$req->fid;
		Session::put('cid',$cid);
		Session::put('fid',$fid);
		$recmsg=Message::where(['cid'=>$fid,'fid'=>$cid])->get();
		$sntmsg=Message::where(['cid'=>$cid,'fid'=>$fid])->get();
		return response()->json(array('recmsg'=>$recmsg, 'sntmsg'=>$sntmsg, 'cid'=>$cid, 'fid'=>$fid));
	}

	public function sndmsg(Request $req)
	{
		$mssg=$req->mssg;
		$file=$req->file('file');
		$cid=Session::get('cid');
		$fid=Session::get('fid');
		$msgMod= new Message();
		$msgMod->cid=$cid;
		$msgMod->fid=$fid;
		$msgMod->mssg=$mssg;
		if($file)
		{
			// dd($file->getClientOriginalName());
			$fileName=substr($file->getClientOriginalName(),0,15);
			$pattern = '/[^a-zA-Z0-9\s]/';
			$fileName = preg_replace($pattern, '_', $fileName);
			$fileName = $fileName.'_'.strtolower(str_random(3));
			$fileName=str_replace(' ','_',$fileName);

			$ext=strtolower($file->getClientOriginalExtension());
			$fileFullName=$fileName.'.'.$ext;

			$uploadPath=public_path().'/files/';
			$fileurl='/files/'.$fileFullName;
			$done=$file->move($uploadPath,$fileFullName);
			if($done)
			{
				$msgMod->fileurl=$fileurl;
				$msgMod->ext=$ext;			
			}	
		}
		$success=$msgMod->saveOrFail();
		if($success)
			return response()->json(array('cid'=>$cid, 'fid'=>$fid, 'msg'=>null));

		else
			return response()->json(array('msg'=>"Sent Failed.", 'cid'=>$cid, 'fid'=>$fid));
	}
}
