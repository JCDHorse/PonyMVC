<?php

namespace views;

use views\View;

class PonyView extends View
{

    public function render(array $views, array $params): string
    {
        ob_start();
        ?>
        <h2 class="text-2xl">Ponies !</h2>
            <? if (isset($params['single'])): ?>
                <? $pony = $params['ponies'][0]; ?>
                <section id="pony-container">
                    <img
                        src="<?= htmlspecialchars($pony['src']) ?>"
                        alt="<?= htmlspecialchars($pony['alt']) ?>">
                </section>
            <? else: ?>
                <section
                id="ponies-container"
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3
                            xl:grid-cols-6 gap-20">
                <?foreach ($params['ponies'] as $pony): ?>
                    <div class="pony-item">
                        <img class="h-max w-max"
                             src="<?= htmlspecialchars($pony['src']) ?>"
                             alt="<?= htmlspecialchars($pony['alt']) ?>">
                    </div>
                <?endforeach;?>
                </section>
            <? endif; ?>

        <?php
        return ob_get_clean();
    }
}