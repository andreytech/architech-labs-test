<?php

namespace Acme\WidgetCo;

class Basket {
    private $catalogue;
    private $deliveryRules;
    private $offers;
    private $items = [];

    public function __construct($catalogue, $deliveryRules, $offers) {
        $this->catalogue = $catalogue;
        $this->deliveryRules = $deliveryRules;
        $this->offers = $offers;
    }

    public function add($productCode) {
        if (isset($this->catalogue[$productCode])) {
            $this->items[] = $productCode;
        } else {
            throw new \Exception("Product code $productCode not found in catalogue.");
        }
    }

    public function total() {
        $total = 0;
        $itemCounts = array_count_values($this->items);

        // Calculate total for items
        foreach ($itemCounts as $code => $count) {
            $price = $this->catalogue[$code];
            if (isset($this->offers[$code])) {
                $total += $this->applyOffer($code, $count, $price);
            } else {
                $total += $count * $price;
            }
        }

        // Apply delivery charges
        $total = $this->applyDeliveryCharges($total);

        return number_format($total, 2);
    }

    private function applyOffer($code, $count, $price) {
        $total = 0;
        if ($code == 'R01' && $count > 1) {
            $pairs = intdiv($count, 2);
            $remainder = $count % 2;
            $total += $pairs * $price * 1.5 + $remainder * $price;
        } else {
            $total += $count * $price;
        }
        return floor($total * 100) / 100;
    }

    private function applyDeliveryCharges($total) {
        if ($total < 50) {
            $total += 4.95;
        } elseif ($total < 90) {
            $total += 2.95;
        }
        return $total;
    }
}
