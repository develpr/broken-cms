<?php

use Broken\Page;

class PageController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(Page::all());
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
		$page = new Page;
		$page->title = "a brand new page!";
		$page->save();

		return Response::json($page, 201);
	}

	public function show($id)
	{
		$slug = Input::get('slug');

		$page = Page::where('id', '=', $id)->where('slug', '=', $slug)->first();

		if(!$page)
			return Response::json(array('error' => "This page was not found"), 404);
		else
			return Response::json($page, 200);

	}

	public function update($id)
	{
		$page = Page::find($id);
		if(Input::has('title') && Input::get('title') != $page->title){
			$page->title = Input::get('title');
			$page->slug = Str::slug($page->title);
		}

		$page->save();

		return Response::json($page, 200);
	}


	public function destroy($id)
	{
		Page::destroy($id);
		return Response::json(array(), 200);
	}

}