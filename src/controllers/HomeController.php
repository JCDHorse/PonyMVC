<?php


namespace controllers;

use models\ModelFactory;
use models\PonyImg;
use views\HomeView;

class HomeController extends Controller
{
    private PonyImg $ponyImg;
    private HomeView $homeView;

    public function __construct() {
        $this->ponyImg = ModelFactory::getPonyImgModel();
        $this->homeView = new HomeView();
    }
    public function getIndex(): void {
        echo $this->homeView->render([
            'ponies' => $this->ponyImg->getAll()
        ]);
    }

}