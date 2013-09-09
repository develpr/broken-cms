<?php

use Broken\Content;
use Broken\Page;

class ContentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(!Input::has('page_id'))
			return Response::json(Content::all(), 200);

		$contents = Content::where('page_id', '=', Input::get('page_id'))->orderBy('position', 'asc')->orderBy('positioned_at', 'desc')->get();

		return Response::json($contents, 200);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$content = new Content;

		$content->position = Input::get('position');
		$content->page_id = Input::get('page');

		$content->save();

		return Response::json($content, 201);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Content::find($id);
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
		$content = Content::find($id);

		if(Input::has('content') && Input::get('content') != $content->content)
			$content->content = Input::get('content');

		if(Input::has('position') && Input::get('position') != $content->position)
		{
			$content->position = Input::get('position');
			$content->positioned_at = date("Y-m-d H:i:s", time()-(60*60*7));
		}

		$content->save();

		return Response::json($content, 200);

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}