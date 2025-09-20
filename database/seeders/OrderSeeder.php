<?php

namespace Database\Seeders;

use App\Models\DummyProduct;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::where('role', 'consumer')->get();
        $products = DummyProduct::all();

        foreach ($users as $user) {
            // Buat 1-3 order per user
            for ($i = 0; $i < rand(1, 3); $i++) {
                $order = Order::create([
                    'user_id' => $user->id,
                    'invoice_number' => 'INV-' . date('Ymd') . rand(1000, 9999),
                    'total' => 0,
                    'status' => ['pending', 'diproses', 'dikirim', 'selesai'][array_rand(['pending', 'diproses', 'dikirim', 'selesai'])]
                ]);

                // Tambah 1-5 item per order
                $total = 0;
                for ($j = 0; $j < rand(1, 5); $j++) {
                    $product = $products->random();
                    $quantity = rand(1, 5);
                    $price = $product->harga;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'dummy_product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $price
                    ]);

                    $total += $quantity * $price;
                }

                $order->update(['total' => $total]);
            }
        }
    }
}
