<?php

namespace App\Services;

use Joy2362\ServiceGenerator\{Contracts\ApiServiceContract, Helper\ApiHelper};
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\User;


class UserService implements ApiServiceContract
{
    /**
     * @var Collection
     */
    private Collection $collection;
    /**
     * @var string
     */
    private string $resource = "User";

    /**
     * @inheritDoc
     */
    public function index(Request $request): Collection
    {
         try {
            $query = User::query();

            $query->when($request['field'] && $request['search'], function ($q) use ($request) {
                return $q->where($request['field'], 'like', '%' . $request['search'] . '%');
            });

            $query->when($request['sortField'] && $request['sortBy'], function ($q) use ($request) {
                return $q->orderBy($request['sortField'], $request['sortBy']);
            });

            $data = $request->all ? $query->get() : $query->paginate($request->perPage ?? 10);

            $this->collection =  ApiHelper::success([
                'data' => $data
            ]);
        } catch (Exception $ex) {
            $this->collection = ApiHelper::failed(['errors' => $ex->getMessage()]);
        }
        return $this->collection;

    }

     /**
     * @inheritDoc
     */
    public function store(Request $request): Collection
    {
        try {
            $data = $request->validated();
            User::create($data);
            $this->collection = ApiHelper::success([
                'message' => __('ApiHelper::crud.create', ['resource' => $this->resource])
            ]);
        } catch (Exception $ex) {
            $this->collection = ApiHelper::failed(['errors' => $ex->getMessage()]);
        }
        return $this->collection;
    }


     /**
     * @inheritDoc
     */
    public function show($id): Collection
    {
        if ($data = User::whereId($id)->first()) {
            return ApiHelper::success([
            'data' => $data,
            ]);
        } else {
            return ApiHelper::failed([
                'error' => __('ApiHelper::crud.notFound', ['resource' => $this->resource])
            ]);
        }
    }

     /**
     * @inheritDoc
     */
    public function update(Request $request, $id): Collection
    {
        try {
            if ($user = User::whereId($id)->first()) {
                $data = $request->validated();
                $user->update($data);
                $this->collection = ApiHelper::success([
                    'message' => __('ApiHelper::crud.update', ['resource' => $this->resource])
                ]);
            } else {
                return ApiHelper::failed([
                    'error' => __('ApiHelper::crud.notFound', ['resource' => $this->resource])
                ]);
            }
        } catch (Exception $ex) {
            $this->collection = ApiHelper::failed(['errors' => $ex->getMessage()]);
        }
        return $this->collection;
    }

     /**
     * @inheritDoc
     */
    public function destroy($id): Collection
    {
        try {
            if ($user = User::whereId($id)->first()) {
                $user->delete();
                $this->collection = ApiHelper::success([
                    'message' => __('ApiHelper::crud.destroy', ['resource' => $this->resource])
                ]);
            } else {
                return ApiHelper::failed([
                    'error' => __('ApiHelper::crud.notFound', ['resource' => $this->resource])
                ]);
            }
        } catch (Exception $ex) {
            $this->collection = ApiHelper::failed(['errors' => $ex->getMessage()]);
        }
        return $this->collection;
    }

    /*
    |--------------------------------------------------------------------------
    | class internal methods
    |--------------------------------------------------------------------------
    |
    */
}
