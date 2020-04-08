<?php
include_once 'db/db.php';

// класс-интерфейс для взаимодействия с таблицей users
class Users
{
    public static function createUser(string $name, string $surname, int $age, int $phone_number, string $email)
    {
        $query = "INSERT INTO test.users SET name = '${name}', surname = '${surname}', age = ${age}, phone_number = ${phone_number}, email = '${email}'";
        return Db::insert($query);
    }

    public static function deleteUser(int $id): bool
    {
        $query = "DELETE FROM test.users WHERE id = " . $id;
        return Db::delete($query);
    }

    public static function getById(int $id): mysqli_result
    {
        $query = "SELECT * FROM test.users WHERE id = " . $id;
        return Db::get($query);
    }

    public static function getAllUsers(): mysqli_result
    {
        $query = "SELECT * FROM test.users ORDER BY id LIMIT 1000";
        return Db::get($query);
    }
}