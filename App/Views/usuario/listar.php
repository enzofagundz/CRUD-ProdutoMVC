<main role="main" class="flex-shrink-0">
    <div class="container">
        <div class="row align-items-center mt-5 mb-3 justify-content-between">
            <div>
                <h1>Manutenção de Usuários do Sistema</h1>
            </div>
            <div>
                <!-- Button trigger modal Cadastro Novo Usuário-->
                <a type="button" class="btn btn-outline-primary btn-sm mb-2 mt-2" href="http://<?php echo APP_HOST."/usuario/cadastrar"; ?>">Novo Usuário</a>
            </div>
        </div>

        <?php
        //Mensagens de Erro ou Sucesso na execução das funções
        echo $Sessao::retornaMensagem();
        $Sessao::limpaMensagem();


        if (count($viewVar['listaUsuarios']) > 0) {
            echo '<div class="table-responsive">';
            echo ' <table class="table table-bordered table-hover table-sm">';
            echo ' <thead >';
            echo ' <tr style="background-color: #bee5eb;">';
            echo ' <th class="info">Login</th>';
            echo ' <th class="info">Nome Completo</th>';
            echo ' <th class="info">Email</th>';
            echo ' <th class="info">Tipo de Permissão</th>';
            echo ' <th class="info"></th>';

            echo ' </tr>';
            echo ' </thead>';
            echo ' <tbody>';
            foreach ($viewVar['listaUsuarios'] as $objUsuario) {
                $login = $objUsuario->getLogin();
                $nome = $objUsuario->getNome();
                $email = $objUsuario->getEmail();
                $permissao = $objUsuario->getPermissao();

                echo '<tr>';
                echo ' <td>' . $login. '</td>';
                echo ' <td>' . $nome . '</td>';
                echo ' <td>' . $email . '</td>';
                echo ' <td>' . $permissao . '</td>';
                echo ' <td> <a href="http://' . APP_HOST . '/usuario/editar/' . $login . '" class="btn btn-info btn-sm">Editar</a>  
              <a href="http://' . APP_HOST . '/usuario/excluirConfirma/' . $login . '/' . $nome . '" class="btn btn-danger btn-sm mt-1">Excluir</a>';
                echo '</tr>';
            }
            echo ' </tbody>';
            echo ' </table>';
            echo '</div>';
        } else {
            echo "Nenhum Usuario Encontrado.";
        }
        ?>

    </div>
</main>