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

    public function getFilteredByColumn($column, $value)
    {
        $query = "SELECT * FROM {$this->table} WHERE {$column} = :value";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':value', $value);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
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

    public function create(array $data)
    {
        $data = $this->prepareDataToInsert($data);
        $query = "INSERT INTO {$this->table} ({$data[0]}) VALUES ({$data[1]})";
        $stmt = $this->pdo->prepare($query);
        $limit = count($data[2]);
        for ($i=0; $i < $limit; ++$i) {
            $stmt->bindValue("{data[2][$i]}", $data[3][$i]);
        }

        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }


    public function delete($id)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id_' . $this->table . '= :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id",$id);
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }

    public function update(array $data, $id)
    {
        $data = $this->prepareDataToUpdate($data);
        $query = 'UPDATE {$this->table} SET {$data[0]} WHERE id=:id';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $limit = count($data[1]);
        for ($i = 0; $i < limit; ++$i) {
            $stmt->bindValue("{$data[1][$i]}", $data[2][$i]);
        }
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }

    private function prepareDataToInsert(array $data)
    {
        $strKeys = "";
        $strBinds = "";
        $binds = [];
        $values = [];
        foreach ($data as $key => $value){
            $strKeys = "{$strKeys},{$key}";
            $strBinds = "{$strBinds},:{$key}";
            $binds[] = ":{$key}";
            $values[] = $value;
        }
        $strKeys = substr($strKeys, 1);
        $strBinds = substr($strBinds, 1);
        return [$strKeys, $strBinds, $binds, $values];
    }

    private function prepareDataToUpdate(array $data)
    {
        $strKeysBinds   = "";
        $binds          = [];
        $values         = [];

        foreach ($data as $key => $value) {
            $strKeysBinds = "{$strKeysBinds},{$key}=:{$key}";
            $binds[] = ":{$key}";
            $values[] = $value;
        }
        $strKeysBinds = substr($strKeysBinds,1);

        return [$strKeysBinds, $binds, $values];
    }
}