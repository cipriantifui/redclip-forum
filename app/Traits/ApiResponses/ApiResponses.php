<?php

namespace App\Traits\ApiResponses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as Response;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponses
{
    /**
     * Return the formatted request item with its specific status code and message.
     * @param $data
     * @param int $status
     * @return JsonResponse
     */
    public function item($data, $status = Response::HTTP_OK)
    {
        return response()->json($data, $status);
    }

    /**
     * Return the formatted request list of items with its specific status code and message.
     * @param $data
     * @param int $status
     * @return JsonResponse
     */
    public function collection($data, $status = Response::HTTP_OK)
    {
        if ($data instanceof LengthAwarePaginator) {
            $paginated = [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage()
            ];

            $response = [
                'data' => $data->getCollection(),
                'pager' => $paginated,
            ];
            return response()->json($response, $status);
        }

        return response()->json($data, $status);
    }

    /**
     * Return a formatted not found error with its specific status code and message.
     * @param $error
     * @param int $status
     * @return JsonResponse
     */
    public function notFound($error, $status = Response::HTTP_NOT_FOUND)
    {
        return $this->generalError($error, $status);
    }

    /**
     * Return a default format for error handling.
     * @param $errors
     * @param int $status
     * @return JsonResponse
     */
    public function rawError($errors, $status = Response::HTTP_NOT_FOUND)
    {
        return response()->json($errors, $status);
    }

    /**
     * Return the Unprocessable Entity error with the corresponding invalid fields.
     * @param $errors
     * @param int $status
     * @return JsonResponse
     */
    public function unprocessableEntity($errors, $status = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return $this->generalError($errors, $status);
    }

    /**
     * Return the Unauthenticated error with the corresponding invalid fields.
     * @param $errors
     * @param int $status
     * @return JsonResponse
     */
    public function unauthenticatedErrorMessage($errors, $status = Response::HTTP_UNAUTHORIZED)
    {
        return $this->generalError($errors, $status);
    }

    /**
     * Return the Forbidden error with the corresponding invalid fields.
     * @param $errors
     * @param int $status
     * @return JsonResponse
     */
    public function forbidden($errors, $status = Response::HTTP_FORBIDDEN)
    {
        return $this->generalError($errors, $status);
    }

    /**
     * Return the Internal Server with its specific status code and message.
     * @param $errors
     * @return JsonResponse
     */
    public function internalServerError($errors)
    {
        return $this->generalError($errors, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Return a formatted default error with its specific status code and message.
     * @param $error
     * @param int $status
     * @return JsonResponse
     */
    public function generalError($error, $status = Response::HTTP_NOT_FOUND)
    {
        return $this->rawError($error, $status);
    }

    /**
     * Returns default ok Message
     * @param null $message
     * @param int $status
     * @return JsonResponse
     */
    public function generalOkMessage($message = null, $status = Response::HTTP_OK) {
        return response()->json($message, $status);
    }
}
