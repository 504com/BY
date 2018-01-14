<?php

namespace App\Http\Controllers\Manager;

use App\Models\FrontContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ManageFrontController extends Controller
{
    public function index()
    {
    	$frontContents = FrontContent::first();

		return view('pages.manager.managefront', [
			'frontContents' => $frontContents
		]);
    }

	public function edit(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'logo' => 'image|mimes:png',
			'picture' => 'image|mimes:jpg,jpeg',
			'blurb' => 'string',
			'subBlurb' => 'string',
			'catchPhrase1' => 'string',
			'catchPhrase2' => 'string',
			'catchPhrase3' => 'string',
			'descTitle' => 'string',
			'descText' => 'string',
			'title_1' => 'string',
			'text_1' => 'string',
			'title_2' => 'string',
			'text_2' => 'string',
			'title_3' => 'string',
			'text_3' => 'string',
			'radius' => 'numeric'
		]);

		if ($validator->fails())
		{
			return redirect( route('manager.managefront.edit'))->withErrors($validator->errors());
		}

		if (!empty($request->logo))
		{
			$request->logo->move(public_path('img'), 'logo_noir_fond_transparent.png');
		}

		if (!empty($request->picture))
		{
			$request->picture->move(public_path('img'), 'background.jpg');
		}

		$frontContent = FrontContent::first();

		$frontContent->blurb = $request->blurb;
		$frontContent->subBlurb = $request->subBlurb;
		$frontContent->catchPhrase1 = $request->catchPhrase1;
		$frontContent->catchPhrase2 = $request->catchPhrase2;
		$frontContent->catchPhrase3 = $request->catchPhrase3;
		$frontContent->descTitle = $request->descTitle;
		$frontContent->descText = $request->descText;
		$frontContent->title_1 = $request->title_1;
		$frontContent->text_1 = $request->text_1;
		$frontContent->title_2 = $request->title_2;
		$frontContent->text_2 = $request->text_2;
		$frontContent->title_3 = $request->title_3;
		$frontContent->text_3 = $request->text_3;
		$frontContent->radius = $request->radius;
		$frontContent->save();

		return redirect()->route('manager.managefront.index')->with('message', 'Modification effectuée');
	}

	public function update(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'first' => 'numeric|present',
			'second' => 'numeric|present',
			'third' => 'numeric|present',
			'newFirst' => 'numeric|present',
			'newSecond' => 'numeric|present',
			'newThird' => 'numeric|present'
		]);

		if ($validator->fails())
		{
			return redirect()->route('manager.restaurants.index')->with('message', 'Erreur');
		}

		$frontContent = FrontContent::first();
		$frontContent->rank_1 = $request->first;
		$frontContent->rank_2 = $request->second;
		$frontContent->rank_3 = $request->third;
		$frontContent->new_1 = $request->newFirst;
		$frontContent->new_2 = $request->newSecond;
		$frontContent->new_3 = $request->newThird;
		$frontContent->save();

		return redirect()->route('manager.restaurants.index')->with('message', 'Modification effectuée');
	}
}
