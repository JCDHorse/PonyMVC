<?php

namespace PonyMVC\controllers;

use PonyMVC\models\ModelFactory;
use PonyMVC\models\PonyImg;
use PonyMVC\views\HomeView;
use PonyMVC\views\PonyView;

class PonyController extends Controller
{
    private PonyImg $ponyImg;
    private HomeView $homeView;
    private PonyView $ponyView;
    public function __construct() {
        $this->ponyImg = ModelFactory::getPonyImgModel();
        $this->homeView = new HomeView();
        $this->ponyView = new PonyView();
    }
    public function getPony(string $idStr): ControllerResponse {
        $error = new ErrorController();
        if (!is_numeric($idStr)) {
            return new ControllerResponse(400, "/pony/{id}: id <i>{$idStr}</i> must be numeric");
        }
        $id = (int) $idStr;
        $pony = $this->ponyImg->get($id);
        if (!$pony) {
            return new ControllerResponse(404, "/pony/{id}: id #{$id} not found");
        }
        $response = $this->homeView->render(
            [$this->ponyView,],
            [
                "ponies" => [$pony],
                "single" => true,
            ],
        );
        return new ControllerResponse(200, $response);
    }

    public function newPony(): ControllerResponse {
        if ($_SERVER['REQUEST_METHOD'] !== "POST") {
            return new ControllerResponse(405, "Method not allowed");
        }

        $ok = $this->ponyImg->newPony($_POST["src"], $_POST["alt"]);
        if (!$ok) {
            return new ControllerResponse(500, "Pony creation failed");
        }
        return new ControllerResponse(303, "/");
    }

    public function deletePony(string $idStr): ControllerResponse {
        if (!is_numeric($idStr)) {
            return new ControllerResponse(400, "id <i>{$idStr}</i> must be numeric");
        }
        $id = (int) $idStr;
        $pony = $this->ponyImg->get($id);
        if (!$pony) {
            return new ControllerResponse(404, "/pony/{id}: id #{$id} not found");
        }

        $ok = $this->ponyImg->delete($id);
        if (!$ok) {
            return new ControllerResponse(500, "Pony deletion failed");
        }
        return new ControllerResponse(303, "/");
    }

}