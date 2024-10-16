<?php
class NegocioController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function criarNegocio($dados)
    {
        if ($this->model->criarNegocio($dados)) {
            return true;
        } else {
            echo '<div class="alert alert-danger">Erro ao criar negócio.</div>';
            return false;
        }
    }

    public function obterNegocios()
    {
        return $this->model->obterNegocios();
    }

    public function atualizarStatus($id, $status)
    {
        if ($this->model->atualizarStatus($id, $status)) {
            return true;
        } else {
            echo '<div class="alert alert-danger">Erro ao atualizar status.</div>';
            return false;
        }
    }
}
