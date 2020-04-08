<?php

include_once 'users.php';
include_once 'Stats.php';

// класс для работы с сущностью пользователя
class User

{
    public static function searchForUsers(string $searchquery): array
    {
        $result = Users::getById((int)$searchquery);
        return mysqli_fetch_all($result);
    }

    public static function showAllUsers(): array
    {
        $result = Users::getAllUsers();
        return mysqli_fetch_all($result);
    }

    public static function createUser(array $user_data): int
    {
        // распаковываем массив
        $name = $user_data["name"];
        $surname = $user_data["surname"];
        $age = $user_data["age"];
        $phone_number = $user_data["phone_number"];
        $email = $user_data["email"];

        // инкрементим статистику добавленных юзеров и создаем запись с юзером в базе
        Stats::incAddedUsers(date("d.m.y"));
        return Users::createUser($name, $surname, $age, $phone_number, $email);
    }

    public static function deleteUser($id): bool
    {
        // инкрементим статистику удаленных юзеров и удаляем запись с юзером из базы
        Stats::incRemovedUsers(date("d.m.y"));
        return Users::deleteUser($id);
    }

}