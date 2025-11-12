<?php

namespace controllers;

use controllers\Controller;
use views\ErrorView;
use views\HomeView;

class ErrorController extends Controller
{
    private HomeView $homeView;
    private ErrorView $errorView;

    public function __construct() {
        $this->homeView = new HomeView();
        $this->errorView = new ErrorView();
    }

    public function getError(int $code, string $errorMsg): ControllerResponse {
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