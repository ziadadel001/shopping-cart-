<?php

class ShoppingCart {
    private $items;

    public function __construct() {
        // Initialize the shopping cart with an empty array of items
        $this->items = [];
    }

    public function addItem($productId, $productName, $price, $quantity = 1) {
        // Check if the product is already in the cart
        if (isset($this->items[$productId])) {
            // If so, update the quantity
            $this->items[$productId]['quantity'] += $quantity;
        } else {
            // Otherwise, add the product to the cart
            $this->items[$productId] = array(
                'name' => $productName,
                'price' => $price,
                'quantity' => $quantity
            );
        }
    }

    public function updateItemQuantity($productId, $quantity) {
        // Check if the product is in the cart
        if (isset($this->items[$productId])) {
            // Update the quantity
            $this->items[$productId]['quantity'] = $quantity;
        }
    }

    public function removeItem($productId) {
        // Check if the product is in the cart
        if (isset($this->items[$productId])) {
            // Remove the product from the cart
            unset($this->items[$productId]);
        }
    }

    public function getItems() {
        return $this->items;
    }

    public function getTotalPrice() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function displayCartAsJSON() {
        $cartData = array(
            'items' => $this->items,
            'total_price' => $this->getTotalPrice()
        );
        return json_encode($cartData);
    }
}

// Example usage
$cart = new ShoppingCart();

// Add items to the cart
$cart->addItem(1, "Product 1", 10.99, 2);
$cart->addItem(2, "Product 2", 19.99, 1);

// Display the cart as JSON
echo $cart->displayCartAsJSON();

?>
