<?php

namespace App\Http\Controllers\Api;

use App\Helpers\StatusCodeHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Store\CreateRequest;
use App\Http\Requests\Store\EditRequest;
use App\Models\Store;
use App\Repositories\StoreRepository;
use BrightNucleus\CountryCodes\Country;
use Illuminate\Http\Request;
use Response;

class StoreController extends Controller
{
    private $statusCode;
    private $success;
    private $data;
    private $errors;
    private $repository;

    public function __construct()
    {
        $this->statusCode = StatusCodeHelper::HTTP_BAD_REQUEST;
        $this->success = false;
        $this->data = [];
        $this->errors = [];
        $this->repository = new StoreRepository();
    }

    /**
     * Get stores
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $limit = 20;
        $offset = $request->get('page') * $limit;
//        echo $limit;exit;
        $this->data['stores'] = $this->repository->all($limit, $offset);
        $this->success = true;
        $this->statusCode = StatusCodeHelper::HTTP_OK;
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Get store by id
     *
     * @param Store $store
     * @return mixed
     */
    public function show(Store $store)
    {
        $store = $this->repository->find($store->id);
        if (!$store) {
            $this->errors['store'] = "can't get store info";
        } else {
            $this->statusCode = StatusCodeHelper::HTTP_OK;
            $this->data['store'] = $store;
            $this->success = true;
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Create store
     *
     * @param CreateRequest $request
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        $data = $request->all();
        $data['country'] = Country::getCodeFromName($data['country']);
        $model = $this->repository->create($data)->fresh(['brand']);
        if ($model) {
            $this->statusCode = StatusCodeHelper::HTTP_OK;
            $this->data['store'] = $model;
            $this->success = true;
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    /**
     * Edit store
     *
     * @param EditRequest $request
     * @param Store $store
     * @return mixed
     */
    public function edit(EditRequest $request, Store $store)
    {
        $data = $request->all();
        $data['country'] = Country::getCodeFromName($data['country']);
        $model = $this->repository->edit($store, $data)->fresh(['brand']);
        if ($model) {
            $this->statusCode = StatusCodeHelper::HTTP_OK;
            $this->data['store'] = $model;
            $this->success = true;
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }

    public function delete(Store $store)
    {
        $model = $this->repository->delete($store);
        if ($model) {
            $this->success = true;
            $this->statusCode = StatusCodeHelper::HTTP_OK;
        } else {
            $this->errors['store'] = "can't_delete_store";
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }
}
