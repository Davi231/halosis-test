<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryProduct;

class CategoryProductController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
	}

	public function index()
	{
		$list = CategoryProduct::all();

		return response()->json([
			'status' => 'success',
			'msg' => '',
			'data' => $list,
		]);

	}

	public function store(Request $request)
	{

		$data = CategoryProduct::create([
			'category' => $request->category
		]);

		return response()->json([
			'status' => 'success',
			'message' => 'Category Product created successfully',
			'data' => $data,
		]);
	}

	public function show($id)
	{
		$data = CategoryProduct::with('products')->find($id);

		if ($data == null) {
			return response()->json([
				'status' => 'failed',
				'msg' => 'Category Product is Empty',
				'data' => null,
			]);
		}

		return response()->json([
			'status' => 'success',
			'msg' => '',
			'data' => $data,
		]);

	}

	public function update(Request $request, $id)
	{

		$data = CategoryProduct::find($id);
		$data->update([
			'category' => $request->category
		]);
		

		return response()->json([
			'status' => 'success',
			'msg' => 'Category Product updated successfully',
			'data' => $data,
		]);
	}

	public function destroy($id)
	{
		$data = CategoryProduct::find($id);
		$data->delete();

		return response()->json([
			'status' => 'success',
			'msg' => 'Category Product deleted successfully',
			'data' => $data,
		]);
	}
}
