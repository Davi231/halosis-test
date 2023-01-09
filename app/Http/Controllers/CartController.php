<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
	}
   
   public function store(Request $request)
	{
		$product = Product::find($request->product_id);
		if ($product->stock < $request->qty) {
			return response()->json([
			'status' => 'failed',
			'message' => $product->product_name."'s stock not enough",
			'data' => null,
		]);
		}
		$data = Cart::create([
			'user_id' => $request->user_id,
			'product_id' => $request->product_id,
			'qty' => $request->qty,
		]);

		return response()->json([
			'status' => 'success',
			'message' => 'Product has been added to cart',
			'data' => $data,
		]);
	}

	public function show($id)
	{
		$data = Cart::with('product','user')->where('user_id',$id)->get();

		if (empty($data)) {
			return response()->json([
				'status' => 'failed',
				'msg' => 'Cart is Empty',
				'data' => null,
			]);
		}

		return response()->json([
			'status' => 'success',
			'msg' => '',
			'data' => $data,
		]);

	}
}
