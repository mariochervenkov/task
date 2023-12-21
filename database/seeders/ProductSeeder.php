<?php

namespace Database\Seeders;

use App\Constants\Status;
use App\Repositories\ProductRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    private const PRODUCTS_COUNT = 10;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productRepository = new ProductRepository();

        for ($i = 0; $i < self::PRODUCTS_COUNT; $i++) {
            $response = $productRepository->create([
                'name' => fake()->name,
                'rating' => rand(1, 5),
                'price' => rand(1, 99),
            ]);

            $this->command->info("Status: $response->status");
            $this->command->info("Message: $response->message");
        }
    }
}
