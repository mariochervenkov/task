<?php

namespace App\Repositories;

use App\Constants\Status;
use App\Models\Hotpoint;
use App\Responses\RepositoryResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class HotpointRepository
{
    /**
     * @param array $data
     * @param Model|null $model
     * @return RepositoryResponse
     */
    public function createUpdate(array $data, Model|null $model = null): RepositoryResponse
    {
        try {

            $hotpoint = $model ?? new Hotpoint();
            $hotpoint->name = data_get($data, 'name');
            $hotpoint->product_id = data_get($data, 'product_id');
            $hotpoint->position_x = data_get($data, 'position_x');
            $hotpoint->position_y = data_get($data, 'position_y');
            $hotpoint->activity = data_get($data, 'activity');
            $hotpoint->save();

            return new RepositoryResponse([
                'status' => Status::SUCCESS,
                'message' => $model ?
                    'Hotpoint was updated successfully' :
                    'Hotpoint was created successfully'
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
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Hotpoint::query()
            ->with('product')
            ->get();
    }

    /**
     * @param Hotpoint $hotpoint
     * @return RepositoryResponse
     */
    public function delete(Hotpoint $hotpoint): RepositoryResponse
    {
        try {

            $hotpoint->delete();

            return new RepositoryResponse([
                'status' => Status::SUCCESS,
                'message' => 'Hotpoint was deleted successfully'
            ]);

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return new RepositoryResponse([
                'status' => Status::ERROR,
                'message' => 'Internal Server Error'
            ]);
        }
    }
}
