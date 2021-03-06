<?php

namespace App\Support\Response;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use stdClass;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponseTrait
{
    /** @var int */
    private $statusCode = 200;

    /** @var array|null */
    private $pagination = null;

    /**
     * @param int $statusCode
     * @return $this
     */
    protected function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param LengthAwarePaginator $paginator
     * @return $this
     */
    protected function setPagination(LengthAwarePaginator $paginator)
    {
        $this->pagination = [
            'page'  => $paginator->currentPage(),
            'by'    => $paginator->perPage(),
            'total' => $paginator->lastPage()
        ];

        return $this;
    }

    /**
     * @return int
     */
    protected function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param array $data
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    private function respond($data = [], $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param array|null  $data
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithSuccess(
        array $data = null,
        string $message = null
    ) {
        $responseBody = $data !== null ? $data : [];
        if ($message !== null) {
            $responseBody['message'] = $message;
        }
        if ($this->pagination !== null) {
            $responseBody['pagination'] = $this->pagination;
            $this->pagination = null;
        }
        if (empty($responseBody)) {
            $responseBody = new stdClass;
        }

        return $this->respond($responseBody);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithError(string $message = null)
    {
        return $this->respondRawError($message);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondNotFound(string $message = null)
    {
        return $this->respondRawError($message, Response::HTTP_NOT_FOUND);
    }

    /**
     * @param $data
     * @param int $statusCode
     * @return JsonResponse
     */
    private function respondRawError($data, int $statusCode = 400)
    {
        if (is_string($data)) {
            $responseBody = [
                'error' => []
            ];
            if ($data !== null) {
                $responseBody['error']['message'] = $data;
            }
            if (empty($responseBody['error'])) {
                $responseBody['error'] = new stdClass;
            }
        } elseif (is_array($data)) {
            $responseBody = [
                'error' => [
                    'message' => $data
                ]
            ];
        } else {
            $responseBody = [
                'error' => [
                    'message' => 'Unknown error.'
                ]
            ];
        }

        return $this->setStatusCode($statusCode)
            ->respond($responseBody);
    }

    /**
     * @param array $messages
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithValidationError(array $messages)
    {
        return $this->respondRawError($messages, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithAuthorizationError(string $message = null)
    {
        $message = ($message === null ? 'Authorization error.' : $message);

        return $this->respondRawError($message, Response::HTTP_UNAUTHORIZED);
    }
}
