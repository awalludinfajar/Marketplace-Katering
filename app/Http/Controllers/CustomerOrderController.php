<?php

namespace App\Http\Controllers;

use App\Models\MenuKatering;
use App\Services\CartRedisTransformService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;
use Inertia\Response;

class CustomerOrderController extends Controller
{

    public function __construct(private CartRedisTransformService $transformService) {}

    public function index() : Response {
        return Inertia::render('CustomerOrder/List', []);
    }

    public function cart(Request $request) : Response {
        $userId = $request->user()->id;
        $cartKey = "user:{$userId}:cart";

        $cartItems = Redis::hgetall($cartKey);

        $cart = [];
        foreach ($cartItems as $item) {
            $cart[] = json_decode($item, true);
        }

        $query = MenuKatering::query()->with('merchantProfile');
        $res = $this->transformService->queryCart($query, $cart);
        $data = $this->transformService->transformData($res->get(), $cart);

        return Inertia::render('Cart/List', [
            'cardData' => $data
        ]);
    }

    public function addToCart(Request $request) {
        $userId = $request->user()->id;
        $productId = $request->productId;
        $quantity = $request->quantity;

        $cartKey = "user:{$userId}:cart";

        $cart = Redis::hget($cartKey, $productId);
        if ($cart) {
            $cart = json_decode($cart, true);
            $cart['quantity'] += $quantity;
        } else {
            $cart = [
                'productId' => $productId,
                'quantity' => $quantity,
                'storeId' => $request->storeId
            ];
        }
        
        Redis::hset($cartKey, $productId, json_encode($cart));
        return response()->json(['message' => 'Product success added to cart.']);
    }

    public function getCart(Request $request)
    {
        $userId = $request->user()->id;
        $cartKey = "user:{$userId}:cart";

        $cartItems = Redis::hgetall($cartKey);

        $cart = [];
        foreach ($cartItems as $item) {
            $cart[] = json_decode($item, true);
        }

        return response()->json($cart);
    }

    public function removeFromCart(Request $request, $productId)
    {
        $userId = $request->user()->id;
        $cartKey = "user:{$userId}:cart";

        Redis::hdel($cartKey, $productId);

        return response()->json(['message' => 'Product removed from cart']);
    }

}
