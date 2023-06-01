<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Lib\Util;

class UsuarioController extends Controller {

    public function listar($param) {
        $usuarioDAO = new UsuarioDAO();

        self::setViewParam('listaUsuarios', $usuarioDAO->listar());

        $this->render('/usuario/listar');
        
        Sessao::limpaMensagem();
    }

    public function editar($param) {
        $login = $param[0];

        $usuarioDAO = new UsuarioDAO();

        $objUsuario = $usuarioDAO->listar($login);

        if ($objUsuario == null) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Falha ao recuperar dados do usuario login=' . $login . '</div>');
            $this->redirect('/usuario/listar');
        } else {
            self::setViewParam('usuario', $objUsuario);
            $this->render('/usuario/editar');
        }

        Sessao::limpaMensagem();
    }
    
    public function salvar($param) {
        $cmd = $param[0];

        $dadosForm = Util::sanitizar($_POST);

        $objUsuario = new Usuario();
        
        $objUsuario->setUsuario($dadosForm);

        $erro = false;

        if(empty($dadosForm['nome'])) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Nome é obrigatório</div>');
            Sessao::gravaErro('ErroNome', 'Nome é obrigatório');
            $erro = true;
        }

        if($erro) {
            self::setViewParam('usuario', $objUsuario);
            if($cmd == 'editar') {
                $this->render('/usuario/editar');
            } else if ($cmd == 'novo') {
                $this->render('/usuario/cadastrar');
            }

            die();
        }

        $usuarioDAO = new UsuarioDAO();

        if($cmd == 'editar') {
            $usuarioDAO->atualizar($objUsuario);
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Usuario atualizado com sucesso</div>');
        } else if ($cmd == 'novo') {
            $usuarioDAO->salvar($objUsuario);
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Usuario cadastrado com sucesso</div>');
        }

        Sessao::limpaErro();
        $this->redirect('/usuario/listar');
    }

    public function excluirConfirma($param) {
        $dados = Util::sanitizar($param);

        $objUsuario = new Usuario();
        $objUsuario->setLogin($dados['login']);
        $objUsuario->setNome($dados['nome']);

        if(!is_string($objUsuario->getLogin())) {
            die('Login inválido, não pode ser numérico');
        }

        self::setViewParam('usuario', $objUsuario);
        $this->render('/usuario/excluirConfirma');
    }

    public function excluir($param) {
        $objUsuario = new Usuario();

        $objUsuario->setLogin(Util::sanitizar($_POST['login']));

        $usuarioDAO = new UsuarioDAO();

        if(!$usuarioDAO->excluir($objUsuario)) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Falha ao excluir usuario</div>');
        } else {
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Usuario excluido com sucesso</div>');
        }

        $this->redirect('/usuario/listar');
    }
}