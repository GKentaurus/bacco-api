<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CartController extends ApiController
{
  // SECTION User methods
  /**
   * ANCHOR Display the lastest cart for the user.
   *
   * @return \App\Traits\ApiResponse
   */
  public function showUserCart()
  {
    $user = auth('api')->user()->id;

    $cart = Cart::firstOrCreate([
      'user_id' => $user,
      'active' => 1
    ]);

    $total = 0;

    foreach ($cart->cartContent as $product) {
      $total += $product->quantity * $product->price;
    }

    $cart['total'] = $total;

    return $this->showOne($cart);
  }

  /**
   * ANCHOR Display the lastest cart for the user.
   *
   * @return \App\Traits\ApiResponse
   */
  public function clearUserCart()
  {
    $user = auth('api')->user()->id;

    $cart = Cart::firstOrCreate([
      'user_id' => $user,
      'active' => 1
    ]);

    foreach ($cart->cartContent as $product) {
      CartContent::destroy($product->id);
    }

    $cart['total'] = 0;

    return $this->showOne($cart);
  }
  // !SECTION End User methods

  // SECTION Admin methods
  /**
   * ANCHOR Display all carts.
   *
   * @return \App\Traits\ApiResponse
   */
  public function showAllCartsByAdmin()
  {
    if (Gate::allows('isAdmin')) {
      $cart = Cart::all();

      $carts = $cart->map(function ($item) {
        $total = 0;
        foreach ($item->cartContent as $product) {
          $total += $product->quantity * $product->price;
        }

        $item['subtotal'] = $total;
        return $item;
      });

      return $this->showAll($carts);
    } else {
      return $this->errorResponse('Acceso no autorizado', 403);
    }
  }

  /**
   * ANCHOR Display a specific carts.
   *
   * @param  int $cart_id
   * @return \App\Traits\ApiResponse
   */
  public function showCartByAdmin($cart_id)
  {
    if (Gate::allows('isAdmin')) {
      $cart = Cart::findOrFail($cart_id);
      $total = 0;
      foreach ($cart->cartContent as $product) {
        $total += $product->quantity * $product->price;
      }
      $cart['total'] = $total;
      return $this->showOne($cart);
    } else {
      return $this->errorResponse('Acceso no autorizado', 403);
    }
  }
  // !SECTION End Admin methods
}
