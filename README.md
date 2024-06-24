# Acme Widget Co Sales System

## Description

This project is an implementation of a shopping cart for Acme Widget Co. The cart supports adding products, calculating the total cost considering delivery rules and special offers.

## Installation

1. Clone the repository:
    ```sh
    git clone <repository URL>
    ```
2. Navigate to the project directory:
    ```sh
    cd <directory name>
    ```

## Usage

1. Initialize the cart with the product catalog, delivery rules, and special offers:
    ```php
    $catalogue = [
        'R01' => 32.95,
        'G01' => 24.95,
        'B01' => 7.95
    ];

    $deliveryRules = [
        'under_50' => 4.95,
        'under_90' => 2.95,
        'over_90' => 0
    ];

    $offers = [
        'R01' => 'buy_one_get_second_half_price'
    ];

    $basket = new Basket($catalogue, $deliveryRules, $offers);
    ```

2. Add products to the cart:
    ```php
    $basket->add('B01');
    $basket->add('G01');
    ```

3. Get the total cost of the cart:
    ```php
    echo $basket->total(); // Output: 37.85
    ```

## Assumptions

- The special offer "buy one red widget, get the second half price" only applies to red widgets (code R01).
- Delivery rules are applied based on the total cost of the cart before applying delivery costs.

## Examples

- Cart with B01 and G01: $37.85
- Cart with two R01: $54.37
- Cart with R01 and G01: $60.85
- Cart with B01, B01, R01, R01, R01: $98.27
