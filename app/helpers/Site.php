<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/23/2022
 * Time: 12:43 AM
 */

class Site
{
    /**
     * Redirect
     */
    public static function redirect(string $location): void
    {
        header('Location: ' . $location);
    }

}