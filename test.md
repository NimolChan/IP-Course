$customer = App\Models\Customer::create([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'address' => '123 Street',
    'phone' => '1234567890'
]);
$products = App\Models\Product::create([
    'name' => 'Laptop',
    'pricing' => 1200,
    'description' => 'High-performance laptop',
    'images' => 'https://i5.walmartimages.com/seo/Lenovo-ideapad-Gaming-3-Laptop-15-6-FHD-1920x1080-AMD-Ryzen-5-5600H-8-GB-RAM-256GB-SSD-NVIDIA-GeForce-GTX-1650-Windows-10_c019d46d-e2f8-4d1f-998e-92c1f346d706.40870377423c43af19b5b38df35ba919.jpeg',
    'category_id' => 1, // Ensure category exists
]);
$order = App\Models\Order::create([
    'customer_id' => 1,
    'total_price' => 150.00,
    'order_date' => '20/03/2025 14:30:00',
]);

$payment = App\Models\Payment::create([
    'payment_method' => 'Credit Card',
    'amount' => 150.00,
    'order_id' => 1,
    'customer_id' => 1,
]);

// ========
$order = App\Models\Order::find(1);
echo $order->payments;
$order->delete();

$order = App\Models\Order::find(1);
$order->delete();

// Retrieve the deleted order with `withTrashed()`
$deletedOrder = App\Models\Order::withTrashed()->find(1);

dd($deletedOrder->deleted_at); // Should now show a timestamp