<?php

include_once 'db/db.php';

// класс-интерфейс для взаимодействия с таблицей stats
class Stats
{
    public static function incAddedUsers(string $date)
    {
        $query = "UPDATE test.stats SET users_added = users_added+1 WHERE date = '{$date}'";
        return Db::update($query);
    }

    public static function incRemovedUsers(string $date)
    {
        $query = "UPDATE test.stats SET users_removed = users_removed+1 WHERE date = '{$date}'";
        return Db::update($query);
    }

    public static function createNewDay(string $date)
    {
        $query = "INSERT INTO test.stats SET date = '${date}'";
        return Db::insert($query);
    }

    public static function getByDate(string $date): mysqli_result
    {
        $query = "SELECT * FROM test.stats WHERE date = '{$date}'";
        return Db::get($query);
    }
}