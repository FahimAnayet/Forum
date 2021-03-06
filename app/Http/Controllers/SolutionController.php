<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Problem;
use App\Solution;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
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

	public function status(Solution $solution, Problem $problem)
	{
		if ($problem->user_id == Auth::user()->id) {
			$solution->update(['isBest' => !$solution->isBest]);
			return redirect()->back();
		}
		Session::flash('error', 'Access Denied');
		return back();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Problem $problem)
	{
		$problem->addSolution([
			'body' => request('body'),
			'user_id' => Auth::user()->id
		]);
		return back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Solution  $solution
	 * @return \Illuminate\Http\Response
	 */
	public function show(Solution $solution)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Solution  $solution
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Solution $solution)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Solution  $solution
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Solution $solution)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Solution  $solution
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Solution $solution)
	{
		//
	}
}
