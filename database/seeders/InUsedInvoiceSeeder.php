<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderRecipes;
use App\Models\OrderTables;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class InUsedInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables = [1, 2, 3, 4, 5, 6, 7, 10, 9, 8, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 61, 62, 63, 64, 65, 181, 182, 183, 184, 185, 167, 189];

        foreach ($tables as $key => $tableId) {
            $table = OrderTables::find($tableId);

            $order = Order::create([
                'invoice_no' => generateInvoiceNo(),
                'order_table_id' => $table->id,
                'service_charges' => $table->room->service_fee,
                'user_id' => 1,
                'created_at' => date('Y-m-d H:i:s')
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

            // $netAmount = ($totalAmount +  $table->room->service_fee) - $totalDiscount;

            // $order->update([
            //     'net_amount' => $netAmount,
            //     'paid' => $netAmount,
            //     'change' => 0,
            //     'status' => true,
            // ]);
        }
    }
}
