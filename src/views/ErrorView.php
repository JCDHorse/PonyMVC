<?php

namespace PonyMVC\views;

use PonyMVC\views\View;

class ErrorView extends View
{
    /**
     * @inheritDoc
     */
    public function render(array $views, array $params) {
        ob_start();
        ?>
        <h2 class="text-3xl">Error <?= $params["errorCode"] ?></h2>
        <p class="font-bold"><?= $params["errorMessage"] ?></p>
        <?php
        return ob_get_clean();
    }
}