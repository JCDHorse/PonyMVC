<?php

namespace views;

class HomeView extends View
{

    public function render(array $params): string
    {
        $ponyView = new PonyView();
        ob_start();
        ?>
        <!doctype html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="/style.css">
            <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
            <title>Document</title>
        </head>
        <body>
            <main class="container mx-auto px-4 py-4 py-6">
                <h1 class="text-4xl">Hello, World</h1>
                <?= $ponyView->render($params) ?>
            </main>
        </body>
        </html>
        <?php
        return ob_get_clean();
    }
}