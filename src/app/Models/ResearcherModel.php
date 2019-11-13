<?php

namespace App\Models;

use Core\Model;
use PDO;

class ResearcherModel extends Model
{
    protected $table = "person";

    public function getResearchers()
    {
        $query = "SELECT * FROM {$this->table} WHERE `type` = '_RESEARCHER_'";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }

    public function getResearcherByID($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE `type` = '_RESEARCHER_' AND `id_person` = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }

}