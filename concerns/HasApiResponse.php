<?php namespace Codecycler\Toolbox\Concerns;

trait HasApiResponse
{
    public function apiError($message, $solution) {
        return response([
            'error' => $message,
        ])->setStatusCode(400);
    }

    public function apiResponse($data)
    {
        return response([
            'status' => 'OK',
            'results' => $data,
        ]);
    }
}