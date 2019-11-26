<?php

namespace App\Models;

use Core\Model;
use PDO;

class ParticipantModel extends Model
{
    protected $table = "person";

    public function prepareToInsert(array $data)
    {
        $data['hometown_cep'] = str_replace('-','',$data['hometown_cep']);
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