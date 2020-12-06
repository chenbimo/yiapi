<?php

declare(strict_types=1);
class Db {
    public static function model() {
        return new PDO('mysql:host=localhost;dbname=test', 'root', 'root');
    }
}
