<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderRecipes;
use App\Models\OrderTables;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dates = [
            '2024-01-01 10:10:10',
            '2024-01-01 10:10:10',
            '2024-01-01 10:10:10',
            '2024-02-01 10:10:10',
            '2024-02-01 10:10:10',
            '2024-03-01 10:10:10',
            '2024-04-01 10:10:10',
            '2024-04-01 10:10:10',
            '2024-04-01 10:10:10',
            '2024-05-01 10:10:10',
            '2024-05-01 10:10:10',
            '2024-06-01 10:10:10',
            '2024-06-01 10:10:10',
            '2024-06-01 10:10:10',
            '2024-07-01 10:10:10',
            '2024-07-01 10:10:10',
        ];

        foreach ($dates as $key => $date) {
            $table = OrderTables::find(rand(1, 100));

            $order = Order::create([
                'invoice_no' => generateInvoiceNo(),
                'order_table_id' => $table->id,
                'service_charges' => $table->room->service_fee,
                'user_id' => 1,
                'created_at' => $date
            ]);

            $recipes = [rand(1, 19), rand(1, 19), rand(1, 19)];
            $totalAmount = 0;
            $totalDiscount = 0;

            foreach ($recipes as $recipeId) {
                $recipe = Recipe::find($recipeId);
                $qty = rand(1, 3);
                $totalAmount += $recipe->amount *  $qty;
                $totalDiscount += $recipe->discount *  $qty;

                OrderRecipes::create([
                    'order_id' => $order->id,
                    'recipe_id' => $recipeId,
                    'quantity' => $qty,
                    'discount' => $recipe->discount *  $qty,
                    'amount' => $recipe->amount *  $qty,
                ]);
            }

            $netAmount = ($totalAmount +  $table->room->service_fee) - $totalDiscount;

            $order->update([
                'net_amount' => $netAmount,
                'paid' => $netAmount,
                'change' => 0,
                'status' => true,
            ]);
        }
    }
}
