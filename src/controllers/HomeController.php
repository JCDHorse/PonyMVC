<?php


namespace controllers;

use models\ModelFactory;
use models\PonyImg;
use views\HomeView;
use views\PonyView;

class HomeController extends Controller
{
    private PonyImg $ponyImg;
    private HomeView $homeView;
    private PonyView $ponyView;

    public function __construct() {
        $this->ponyImg = ModelFactory::getPonyImgModel();
        $this->homeView = new HomeView();
        $this->ponyView = new PonyView();
    }
    public function getIndex(): ControllerResponse {
        $response = $this->homeView->render([
            $this->ponyView
        ],[
            'ponies' => $this->ponyImg->getAll()
        ]);
        return new ControllerResponse(200, $response);
    }

}