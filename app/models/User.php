<?php

class User
{
    public function login($idlogin, $pass)
    {
        $sql = "SELECT * FROM `admins` WHERE Login_id = :login_id AND Password = :passw AND actived_flag > 0";
        $pre = Database::getConnection()->prepare($sql);
        $pre->bindParam(':login_id', $idlogin);
        $pre->bindParam(':passw', $pass);
        $pre->execute();
        return $pre->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addUser($type, $name, $userid, $avatar, $description, $updated)
    {
        $sql = "INSERT INTO `users` (`type`, `name`, `user_id`, `avatar`, `description`,`updated`,`created`) VALUES
				('$type', '$name', '$userid', '$avatar', '$description','$updated','$updated')";
        return Database::getConnection()->query($sql);
    }

    public function updateAvatar($avatar, $cusID)
    {
        $sql = "UPDATE `users` SET
				`avatar`='$avatar'
				WHERE `id` = $cusID";
        return Database::getConnection()->query($sql);
    }

    public function getUserId()
    {
        $sql = "SELECT `user_id`FROM `users` ";
        return Database::getConnection()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
 