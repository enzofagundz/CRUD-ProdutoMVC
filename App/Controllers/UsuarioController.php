<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;
use App\Lib\Util;

class UsuarioController extends Controller
{

    public function listar($param)
    {
        $usuarioDAO = new UsuarioDAO();

        self::setViewParam('listaUsuarios', $usuarioDAO->listar());

        $this->render('/usuario/listar');

        Sessao::limpaMensagem();
    }

    public function editar($param)
    {
        if (self::verificaPermissao() == 0) {
            $this->redirect('/home/negado');
            die();
        }

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

    public function salvar($param)
    {
        if (self::verificaPermissao() == 0) {
            $this->redirect('/home/negado');
            die();
        }

        $cmd = $param[0];

        $dadosForm = Util::sanitizar($_POST);

        $objUsuario = new Usuario();

        $objUsuario->setUsuario($dadosForm);

        $erro = false;

        if (empty($dadosForm['nome'])) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Nome é obrigatório</div>');
            Sessao::gravaErro('ErroNome', 'Nome é obrigatório');
            $erro = true;
        }

        if ($erro) {
            self::setViewParam('usuario', $objUsuario);
            if ($cmd == 'editar') {
                $this->render('/usuario/editar');
            } else if ($cmd == 'novo') {
                $this->render('/usuario/cadastrar');
            }

            die();
        }

        $usuarioDAO = new UsuarioDAO();

        if ($cmd == 'editar') {
            $usuarioDAO->atualizar($objUsuario);
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Usuario atualizado com sucesso</div>');
        } else if ($cmd == 'novo') {
            $usuarioDAO->salvar($objUsuario);
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Usuario cadastrado com sucesso</div>');
        }

        Sessao::limpaErro();
        $this->redirect('/usuario/listar');
    }

    public function cadastrar()
    {
        if (self::verificaPermissao() == 0) {
            $this->redirect('/home/negado');
            die();
        }

        $objUsuario = new Usuario();
        self::setViewParam('usuario', $objUsuario);

        $this->render('/usuario/cadastrar');
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function excluirConfirma($param) //Confirma Exclusão do Usuario
    {
        if (self::verificaPermissao() == 0) {
            $this->redirect('/home/negado');
            die();
        }

        $dados = Util::sanitizar($param); //Pega o id do Usuario a ser excluído e sanitiza

        $objUsuario = new Usuario();
        $objUsuario->setLogin($dados[0]);  //Pega o id do Usuario a ser excluído
        $objUsuario->setNome($dados[1]); //Pega o nome do Usuario a ser excluído

        self::setViewParam('usuario', $objUsuario);
        $this->render('/usuario/excluirConfirma'); //Retorna ao Formulário
    }

    public function excluir($param)
    {
        $objUsuario = new Usuario();
        //Pega o id do Usuario a ser excluído

        $objUsuario->setLogin(Util::sanitizar($_POST['login']));

        $usuarioDAO = new UsuarioDAO();

        // if (!$UsuarioDAO->excluir($objUsuario)) {
        //     Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Usuario Não Encontrado.</div>');
        // } else {
        //     Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Usuario excluído com sucesso!.</div>');
        // }
        
        if (!$usuarioDAO->excluir($objUsuario)) {
            Sessao::gravaMensagem('<div class="alert alert-danger" role="alert">Usuário Não Encontrado.</div>');
        } else {
            Sessao::gravaMensagem('<div class="alert alert-success" role="alert">Usuário excluído com sucesso!</div>');
        }
        
        $this->redirect('/usuario/listar');
    }
}
