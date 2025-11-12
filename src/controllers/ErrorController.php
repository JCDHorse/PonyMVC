<?php

namespace PonyMVC\controllers;

use PonyMVC\controllers\Controller;
use PonyMVC\views\ErrorView;
use PonyMVC\views\HomeView;

class ErrorController extends Controller
{
    private HomeView $homeView;
    private ErrorView $errorView;

    public function __construct() {
        $this->homeView = new HomeView();
        $this->errorView = new ErrorView();
    }

    public function getError(int $code, string $errorMsg): ControllerResponse {
        if ($code >= 300 && $code < 400) {
            return new ControllerResponse($code, $errorMsg);
        }
        $content = $this->homeView->render(
            [$this->errorView],
            [
                "errorCode" => $code,
                "errorMessage" => $errorMsg,
            ],
        );
        return new ControllerResponse($code, $content);
    }
}