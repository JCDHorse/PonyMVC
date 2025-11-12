<?php

namespace views;

abstract class View
{
    /**
     * @param array<View> $views Children views
     * @param array<string, mixed> $params Parameter array
     * @return mixed
     */
    public abstract function render(array $views, array $params);
}