<?php

namespace App\Repositories;

use App\Constants\Status;
use App\Models\Product;
use App\Responses\RepositoryResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class ProductRepository
{
    /**
     * @param array $data
     * @return RepositoryResponse
     */
    public function create(array $data): RepositoryResponse
    {
        try {

            $product = new Product();
            $product->name = data_get($data, 'name');
            $product->rating = data_get($data, 'rating');
            $product->price = data_get($data, 'price');
            $product->save();

            return new RepositoryResponse([
                'status' => Status::SUCCESS,
                'message' => 'Product is created successfully'
            ]);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return new RepositoryResponse([
                'status' => Status::ERROR,
                'message' => 'Internal Server Error'
            ]);
        }
    }

    /**
     * @return Collection|array
     */
    public function getAll(): Collection|array
    {
        return Product::all();
    }
}
