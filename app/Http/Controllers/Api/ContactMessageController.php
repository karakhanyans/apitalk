<?php

namespace App\Http\Controllers\Api;

use App\Helpers\StatusCodeHelper;
use App\Http\Requests\ContactMessageRequest;
use App\Repositories\ContactMessageRepository;
use App\Http\Controllers\Controller;
use Response;

class ContactMessageController extends Controller
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
        $this->repository = new ContactMessageRepository();
    }

    /**
     * Save contact message
     *
     * @param ContactMessageRequest $request
     * @return mixed
     */
    public function __invoke(ContactMessageRequest $request)
    {
        $contactMessage = $this->repository->create($request->all());
        if ($contactMessage) {
            $this->success = true;
            $this->statusCode = StatusCodeHelper::HTTP_CREATED;
        } else {
            $this->errors['contactMessage'] = "can't_save_message";
        }
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }
}
