<?php

require_once '../models/Negocio.php';

class NegocioController
{
    private $negocioModel;

    public function __construct($db)
    {
        $this->negocioModel = new Negocio($db);
    }

    // Criar novo negócio
    public function criar($data)
    {
        if ($this->negocioModel->criar($data['data_negocio'], $data['valor_transacao'], $data['notas'], $data['id_cliente'])) {
            echo json_encode(['message' => 'Negócio criado com sucesso']);
        } else {
            echo json_encode(['error' => 'Erro ao criar negócio']);
        }
    }

    // Listar negócios
    public function listar()
    {
        $negocios = $this->negocioModel->listar();
        echo json_encode($negocios);
    }

    // Atualizar negócio
    public function atualizar($data)
    {
        if ($this->negocioModel->atualizar($data['id_negocio'], $data['data_negocio'], $data['valor_transacao'], $data['notas'])) {
            echo json_encode(['message' => 'Negócio atualizado com sucesso']);
        } else {
            echo json_encode(['error' => 'Erro ao atualizar negócio']);
        }
    }

    // Deletar negócio
    public function deletar($id_negocio)
    {
        if ($this->negocioModel->deletar($id_negocio)) {
            echo json_encode(['message' => 'Negócio deletado com sucesso']);
        } else {
            echo json_encode(['error' => 'Erro ao deletar negócio']);
        }
    }
}
