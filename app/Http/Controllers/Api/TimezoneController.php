<?php

namespace App\Http\Controllers\Api;

use App\Helpers\StatusCodeHelper;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class TimezoneController extends Controller
{
    private $statusCode;
    private $success;
    private $data;
    private $errors;

    public function __construct()
    {
        $this->statusCode = StatusCodeHelper::HTTP_BAD_REQUEST;
        $this->success = false;
        $this->data = [];
        $this->errors = [];
    }

    /**
     * Get all timezones
     *
     * @return mixed
     */
    public function __invoke()
    {
        $timezones = [];
        $timestamp = time();
        foreach (timezone_identifiers_list() as $key => $zone) {
            date_default_timezone_set($zone);
            $timezones[$key] = 'UTC/GMT ' . date('P', $timestamp);
        }
        $this->data['timezones'] = $timezones;
        $this->success = true;
        $this->statusCode = StatusCodeHelper::HTTP_OK;
        return Response::api($this->success, $this->data, $this->errors, $this->statusCode);
    }
}
