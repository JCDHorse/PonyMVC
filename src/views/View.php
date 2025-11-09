<?php

namespace views;

abstract class View
{
    public abstract function render(array $params);
}