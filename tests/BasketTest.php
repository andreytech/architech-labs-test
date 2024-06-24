<?php

namespace Acme\WidgetCo\Tests;

use PHPUnit\Framework\TestCase;
use Acme\WidgetCo\Basket;

class BasketTest extends TestCase {
    private $catalogue;
    private $deliveryRules;
    private $offers;

    protected function setUp(): void {
        $this->catalogue = [
            'R01' => 32.95,
            'G01' => 24.95,
            'B01' => 7.95
        ];

        $this->deliveryRules = [
            'under_50' => 4.95,
            'under_90' => 2.95,
            'over_90' => 0
        ];

        $this->offers = [
            'R01' => 'buy_one_get_second_half_price'
        ];
    }

    public function testTotal() {
        $basket = new Basket($this->catalogue, $this->deliveryRules, $this->offers);

        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals(37.85, $basket->total());

        $basket = new Basket($this->catalogue, $this->deliveryRules, $this->offers);
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(54.37, $basket->total());

        $basket = new Basket($this->catalogue, $this->deliveryRules, $this->offers);
        $basket->add('R01');
        $basket->add('G01');
        $this->assertEquals(60.85, $basket->total());

        $basket = new Basket($this->catalogue, $this->deliveryRules, $this->offers);
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals(98.27, $basket->total());
    }
}
