<?php

abstract class Model
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Database::getConnection();
    }

    /**
     * Bind
     */
    public function bind(object $stmt, array $data): void
    {
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
    }
}