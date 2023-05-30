<?php

class Url extends Conn
{

    public function getUserById($id)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($name, $email)
    {
        $stmt = $this->connect()->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $this->connect()->lastInsertId();
    }

    public function updateUser($id, $name, $email)
    {
        $stmt = $this->connect()->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        return $stmt->execute();
    }

    public function deleteUser($id)
    {
        $stmt = $this->connect()->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}