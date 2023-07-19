<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Joy2362\ServiceGenerator\Helper\ApiHelper;
use Illuminate\Http\{JsonResponse, Request};
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function __construct(public UserService $service)
    {
    }

    public function index(Request $request): JsonResponse
    {
        return ApiHelper::response($this->service->index($request));
    }

    public function store(UserRequest $request): JsonResponse
    {
        return ApiHelper::response($this->service->store($request));
    }

    public function show($id): JsonResponse
    {
        return ApiHelper::response($this->service->show($id));
    }

    public function update(UserRequest $request, $id): JsonResponse
    {
        return ApiHelper::response($this->service->update($request, $id));
    }

    public function destroy($id): JsonResponse
    {
        return ApiHelper::response($this->service->destroy($id));
    }
}
