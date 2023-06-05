<?php

namespace App\Models\Entidades;

class Usuario {
    private $login;
    private $nome;
    private $senha;
    private $email;
    private $permissao;

    public function getLogin() {
        return $this->login;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPermissao() {
        return $this->permissao;
    }

    public function setLogin($login): void {
        $this->login = $login;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setSenha($senha): void {
        $this->senha = $senha;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setPermissao($permissao): void {
        $this->permissao = $permissao;
    }

    public function setUsuario($dados) {
        if (isset($dados['login'])) {
            $this->setLogin($dados['login']);
        }
    
        if (isset($dados['nome'])) {
            $this->setNome($dados['nome']);
        }
    
        if (isset($dados['senha'])) {
            $this->setSenha($dados['senha']);
        }
    
        if (isset($dados['email'])) {
            $this->setEmail($dados['email']);
        }
    
        if (isset($dados['permissao'])) {
            $this->setPermissao($dados['permissao']);
        }
    }
    
}