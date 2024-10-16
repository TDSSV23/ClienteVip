<?php
class LeadController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function criarLead($dados)
    {
        if ($this->model->criarLead($dados)) {
            return true;
        } else {
            echo '<div class="alert alert-danger">Erro ao criar lead.</div>';
            return false;
        }
    }

    public function obterLeads()
    {
        return $this->model->obterLeads();
    }
}
