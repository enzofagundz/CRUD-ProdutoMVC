<?php

namespace App\Models\DAO; //Definindo o namespace

use App\Models\Entidades\Usuario; // Importando a classe Usuario

class UsuarioDAO extends BaseDAO
{
    public function listar($login = null)
    {
        if ($login) { //Verficar se possui algo na variável $login
            //Caso possua, executar a query de select

            //Cria-se uma variável $resultado que busca o valor do login presente na variável $login correspondente no banco de dados crudproduto

            $resultado = $this->select( //Executa a query de select através do método select da classe BaseDAO
                "SELECT * FROM usuario WHERE login = '{$login}'"
            );

            return $resultado->fetchObject(Usuario::class); //Retorna o resultado da query de select em forma de objeto da classe Usuario
        } else {
            //Caso não possua, executar a query de select sem a cláusula where

            $resultado = $this->select(
                'SELECT * FROM usuario'
            );

            return $resultado->fetchAll(\PDO::FETCH_CLASS, Usuario::class); //Retorna um array com todos os resultados da query de select em forma de objeto da classe Usuario
        }

    }

    public function salvar(Usuario $usuario)
    {
        //Método para salvar um novo usuário no banco de dados

        //O método salvar recebe um objeto da classe Usuario como parâmetro

        try {
            //Tenta executar o código abaixo, se não for possível, captura a exceção e executa a mensagem de erro

            //Passando os valores dos atributos do objeto Usuario para variáveis
            $login = $usuario->getLogin();
            $nome = $usuario->getNome();
            $senha = $usuario->getSenha();
            $email = $usuario->getEmail();
            $permissao = $usuario->getPermissao();

            //Retorna o resultado da query de insert através do método insert da classe BaseDAO
            return $this->insert(
                'usuario',
                ":login,:nome,:senha,:email,:permissao",
                [
                    ':login' => $login,
                    ':nome' => $nome,
                    ':senha' => $senha,
                    ':email' => $email,
                    ':permissao' => $permissao
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function atualizar(Usuario $usuario)
    {
        try {
            $login = $usuario->getLogin();
            $nome = $usuario->getNome();
            $senha = $usuario->getSenha();
            $email = $usuario->getEmail();
            $permissao = $usuario->getPermissao();

            return $this->update(
                'usuario',
                "nome = :nome, senha = :senha, email = :email, permissao = :permissao",
                [
                    ':nome' => $nome,
                    ':senha' => $senha,
                    ':email' => $email,
                    ':permissao' => $permissao,
                    ':login' => $login
                ],
                "login = :login"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function excluir(Usuario $usuario)
    {
        try {
            $login = $usuario->getLogin();

            return $this->delete('usuario', "login = :login", [':login' => $login]);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar", 500);
        }
    }
}
