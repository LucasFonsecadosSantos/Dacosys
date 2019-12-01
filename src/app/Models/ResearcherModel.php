<?php

namespace App\Models;

use PDO;
use Core\Model;
use Util\Identificator;

class ResearcherModel extends Model
{
    protected $table = "person";

    public static function where($column, $value)
    {
        $self = new static;
        $query = "SELECT * FROM person WHERE " . $column . "=:value" ;
        $stmt = $self->pdo->prepare($query);
        $stmt->bindValue(':value', $value);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }

    public function prepareToInsert(array $data)
    {
        $data['is_administrator'] = ($data['id_person'] != null) ? false : true;
        $data['hometown_cep'] = str_replace('-','',$data['hometown_cep']);
        $data['id_person'] = (($data['id_person'] != null) || ($data['id_person'] != "")) ? $data['id_person'] : Identificator::generateID('person_');
        return $data;
    }

    public function prepareToView($person)
    {
        switch ($person->color) {
            case '_PRETA_':
                $person->color = 'Preta';
                break;
            case '_BRANCA_':
                $person->color = 'Branca';
                break;
            case '_INDIGENA_':
                $person->color = 'Indigena';
                break;
            case '_PARDA_':
                $person->color = 'Parda';
                break;
            case '_AMARELA_':
                $person->color = 'Amarela';
                break;

        }

        switch ($person->sex) {
            case '_M_':
                $person->sex = 'Masculino';
                break;
            case '_F_':
                $person->sex = 'Feminino';
                break;
            case '_O_':
                $person->sex = 'Outro ou Não Informado';
                break;
        }

        switch ($person->type) {
            case '_RESEARCHER_':
                $person->function = 'Pesquisador';
                break;
            case '_PARTICIPANT_':
                $person->function = 'Participante';
                break;
            case '_ADMINISTRATOR_':
                $person->function = 'Administrador';
                break;
        }

        return $person;
    }

}