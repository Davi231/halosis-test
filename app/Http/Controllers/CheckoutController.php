<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\DetailCheckout;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
	}

	public function checkout($user_id)
	{
		DB::beginTransaction();
		try {
			$data = Cart::with('product','user')->where('user_id',$user_id)->get();
			$address = Address::where([
				'user_id' => $user_id, 
				'is_active' => 1])->first();

			if (empty($data)) {
				return response()->json([
					'status' => 'failed',
					'msg' => 'Cart is Empty',
					'data' => null,
				]);
			}

			if ($address == null) {
				return response()->json([
					'status' => 'failed',
					'msg' => 'Address is Empty',
					'data' => null,
				]);
			}

			$checkout = Checkout::create([
				'user_id' => $user_id,
				'address_id' => $address->id,
				'price' => 0,
				'status' => 'created'
			]);

			$grandTotal = 0;

			foreach ($data as $key) {
				$total = $key->product->price*$key->qty;
				if ($key->qty > $key->product->stock) {
					return response()->json([
						'status' => 'success',
						'msg' => $key->product->product_name."'s stock not enough",
						'data' => null,
					]);	
				}

				DetailCheckout::create([
					'checkout_id' => $checkout->id,
					'product_id' => $key->product->id,
					'qty' => $key->qty,
					'price' => $key->product->price,
					'total' => $total,
				]);
				$grandTotal += $total;

				$key->product->update([
					'stock' => $key->product->stock - $key->qty
				]);

				$key->delete();

			}

			$checkout->update([
				'price' => $grandTotal
			]);
			DB::commit();
			return response()->json([
				'status' => 'success',
				'msg' => 'Product has been checked out',
				'data' => null,
			]);
		} catch (Exception $e) {
			DB::rollback();
			return response()->json([
				'status' => 'failed',
				'msg' => $e,
				'data' => null,
			]);	
		}

	}

	public function changeStatus($checkout_id,$status)
	{
		$checkout = Checkout::find($checkout_id);


		if ($status == "cancelled") {
			$detailCheckout = DetailCheckout::with('product','user')->where('checkout_id',$checkout_id)->get();
			foreach ($detailCheckout as $key) {
				$key->product->update([
					'stock' => $key->product->stock + $key->qty
				]);
			}
		}
		$checkout->update([
			'status' => $status
		]);

		return response()->json([
			'status' => 'success',
			'msg' => 'Checkout status has been changed to '.$status,
			'data' => null,
		]);
	}

	public function listCheckout($user_id)
	{
		$checkout = Checkout::where('user_id',$user_id)->latest()->get();

		if (empty($checkout)) {
			return response()->json([
				'status' => 'failed',
				'msg' => 'Checkout data is empty',
				'data' => null,
			]);
		}

		return response()->json([
			'status' => 'success',
			'msg' => '',
			'data' => $checkout,
		]);
	}
}



