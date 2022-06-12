<?php
function register_user(string $email, string $username, string $password, bool $is_admin = false): bool
{
    $sql = 'INSERT INTO users(username, email, password, is_admin) VALUES(:username, :email, :password, :is_admin)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
    $statement->bindValue(':is_admin', (int)$is_admin, PDO::PARAM_INT);

    return $statement->execute();
}