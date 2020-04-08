<?php

// класс для работы с базой данных
class Db
{
    const host = 'localhost';
    const user = 'password';
    const password = 'password';
    const database = 'test';

    public static function get(string $query)
    {
        $link = self::connectToDatabase();
        $result = mysqli_query($link, $query);
        self::disconnectFromDatabase();
        return $result;
    }

    public static function insert($query): int
    {
        $link = self::connectToDatabase();
        mysqli_query($link, $query);
        $result = mysqli_insert_id($link);
        self::disconnectFromDatabase();
        return $result;
    }

    public static function update($query): bool
    {
        $link = self::connectToDatabase();
        $result = mysqli_query($link, $query);
        self::disconnectFromDatabase();
        return $result;
    }

    public static function delete($query): bool
    {
        $link = self::connectToDatabase();
        $result = mysqli_query($link, $query);
        self::disconnectFromDatabase();
        return $result;
    }

    protected static function connectToDatabase()
    {
        $link = mysqli_connect(self::host, self::user, self::password, self::database)
        or die("Ошибка " . mysqli_error($link));
        return $link;
    }

    protected static function disconnectFromDatabase()
    {
        mysqli_close(mysqli_connect(self::host, self::user, self::password, self::database));
    }

}
