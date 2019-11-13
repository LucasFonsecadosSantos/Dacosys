<?php

namespace Core;

use PDO;

abstract class Model
{

    protected     $pdo;
    protected   $table;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll($type = null)
    {
        if ($type == null) {
            $query = "SELECT * FROM {$this->table}";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            return $result;
        } else {
            $query = "SELECT * FROM {$this->table} WHERE type = :type";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':type', $type);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            return $result;
        }
    }

    public function getByID($id, $type = null)
    {
        if ($type == null) {
            $query = "SELECT * FROM {$this->table} WHERE `id_{$this->table}` = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch();
            $stmt->closeCursor();
            return $result;
        } else {
            $query = "SELECT * FROM {$this->table} WHERE `id_{$this->table}` = :id AND `type` = :type";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":id", $id);
            $stmt->bindValue(":type", $type);
            $stmt->execute();
            $result = $stmt->fetch();
            $stmt->closeCursor();
            return $result;
        }
    }

}