<?php

class LeadController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function cadastrar($dados)
    {
        try {
            if ($this->model->cadastrarLead($dados)) {
                return ['success' => true, 'message' => 'Lead cadastrado com sucesso.'];
            } else {
                return ['success' => false, 'message' => 'Erro ao cadastrar lead.'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function buscarPorID($id)
    {
        try {
            $lead = $this->model->buscarLeadPorID($id);
            if ($lead) {
                return $lead;
            } else {
                return ['success' => false, 'message' => 'Lead não encontrado.'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function atualizar($id, $dados)
    {
        try {
            if ($this->model->atualizarLead($id, $dados)) {
                return ['success' => true, 'message' => 'Lead atualizado com sucesso.'];
            } else {
                return ['success' => false, 'message' => 'Erro ao atualizar lead.'];
            }
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function listar()
    {
        try {
            return $this->model->listarLeads();
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
