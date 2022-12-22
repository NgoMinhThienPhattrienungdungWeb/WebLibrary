<?php

abstract class Controller
{
    /**
     * View
     */
    public function view(string $path, array $data = []): void
    {
        if (is_array($data)) {
            extract($data);
        }
        require(ROOT . '/app/views/' . $path . '.php');
    }
}