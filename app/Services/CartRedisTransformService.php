<?php

namespace App\Services;

class CartRedisTransformService
{
    function queryCart($query, $data, $index = 0) {

        if ($index >= count($data)) {
            return $query;
        }

        $item = $data[$index];
        $query->orWhere(function ($q) use ($item) {
            $q->where('id', $item['productId'])
            ->whereHas('merchantProfile', function ($q) use ($item) {
                $q->where('id', $item['storeId']);
            });
        });

        return $this->queryCart($query, $data, $index +1);
    }

    public function transformData($data, $cart): array {
        $result = [];
        foreach ($data as $item) {
            $merchantId = $item['merchantProfile']['id'];
            $merchantName = $item['merchantProfile']['nama'];
            $product = [
                'productId' => $item['id'],
                'productName' => $item['nama'],
                'gambar' => $item['gambar'],
                'quantityAll' => $item['qty'],
                'quantity' => $this->getQuantity($cart, $item['id']),
                'price' => $item['price'],
            ];
        
            $found = false;
            foreach ($result as &$merchant) {
                if ($merchant['merchantId'] === $merchantId) {
                    $merchant['products'][] = $product;
                    $found = true;
                    break;
                }
            }
        
            if (!$found) {
                $result[] = [
                    'merchantId' => $merchantId,
                    'merchantName' => $merchantName,
                    'products' => [$product],
                ];
            }
        }
        return $result;
    }

    public function getQuantity($cart, $productId) : int {
        $quantity = 0;

        foreach ($cart as $item) {
            if ($item['productId'] === $productId) {
                $quantity = $item['quantity'];
            }
        }

        return $quantity;
    }
}
