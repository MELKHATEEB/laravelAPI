<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;


trait ExceptionTrait
{
    public function apiException($request, $e)
    {
        if ($this->isModelException($e)) {
            return $this->modelExceptionRespone($e);
        } else if ($this->isHttpException($e)) {
            return $this->httpExceptionResponse($e);
        } else {
            return parent::render($request, $e);
        }
    }

    protected function isModelException($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    protected function isHttpException($e)
    {
        return $e instanceof NotFoundHttpException;
    }

    protected function modelExceptionRespone($e)
    {
        return response()->json([
            'errors' => 'Product Model Not Found'
        ], Response::HTTP_NOT_FOUND);
    }

    protected function httpExceptionResponse($e)
    {
        return response()->json([
            'errors' => 'Invalid URL'
        ], Response::HTTP_NOT_FOUND);
    }
}
