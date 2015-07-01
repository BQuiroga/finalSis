<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Image;
use App\Http\Requests\ImageRequest;
use Auth;
use Request;

class ImagesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$images = Image::all();
		

		return view('images.index', compact('images'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('images.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ImageRequest $request)
	{
		if ($request->file('image')->isValid()){
			 $extension = $request->file('image')->getClientOriginalExtension();
			 $fileName = rand(11111,99999).'.'.$extension;
			 $request->file('image')->move("uploads/", $fileName);
		}
		$input = $request->all();
		$input["image"] = "/uploads/".$fileName;
		$image = Image::create($input);
		$user= User::find($input["user_id"]);
		$user->image=$image->image;
		$user->save();
		/*
		$image = new Image($input);
		Auth::user()->image()->save($image);
		*/
		return redirect('users');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Image::destroy($id);
		return redirect('posts');
	}

}
