<?php

namespace PonyMVC\controllers;

class ControllerResponse
{
    private int $responseCode;
    private string $response;

    public function __construct(int $responseCode, string $response) {
        $this->responseCode = $responseCode;
        $this->response = $response;
    }
    public function getResponseCode(): int {
        return $this->responseCode;
    }

    public function getResponse(): string {
        return $this->response;
    }

}