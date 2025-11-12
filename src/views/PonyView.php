<?php

namespace PonyMVC\views;

use PonyMVC\views\View;

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
            class="grid auto-rows-fr grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3
                        xl:grid-cols-6 gap-10">
            <?foreach ($params['ponies'] as $pony): ?>
                <div class="pony-item bg-cyan-100 aspect-square w-full h-full border-4 border-solid border-indigo-400 rounded-xl p-4 flex flex-col"
                     id="pony-<?= htmlspecialchars($pony['id']) ?>">
                    <h2 class="text-xl font-bold"><?= htmlspecialchars($pony['alt']) ?></h2>
                    <div class="flex flex-1 items-center justify-center">
                        <img class="object-contain w-full h-full mx-auto"
                             src="<?= htmlspecialchars($pony['src']) ?>"
                             alt="<?= htmlspecialchars($pony['alt']) ?>">
                    </div>
                    <p class="text-sm font-mono font-bold"> <?= htmlspecialchars($pony['id']) ?></p>
                </div>
            <?endforeach;?>
            </section>
        <? endif; ?>
        <?php
        return ob_get_clean();
    }
}