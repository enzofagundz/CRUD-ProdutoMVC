<main role="main" class="flex-shrink-0">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h1 class="mt-2">Editar dados do Usuario</h1>
                <?php
                //Mensagens de Erro ou Sucesso na execução das funções
                echo $Sessao::retornaMensagem();
                $Sessao::limpaMensagem();

                ?>

                <form action="<?php echo 'http://' . APP_HOST . '/usuario/salvar/editar'; ?>" method="post" id="formEditarUsuario">
                    <div class="form-group">
                        <input type="hidden" name="login" value="<?php echo $viewVar['usuario']->getLogin(); ?>">
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome do Usuario</label>
                        <input type="text" class="form-control" name="nome" value="<?php echo $viewVar['usuario']->getNome(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" name="senha" value="<?php echo $viewVar['usuario']->getSenha(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $viewVar['usuario']->getEmail(); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="permissao">Permissão</label>
                        <select class="form-control" name="permissao" required>
                            <option <?php if ($viewVar['usuario']->getPermissao() == 'Admin') echo 'selected'; ?>>Admin</option>
                            <option <?php if ($viewVar['usuario']->getPermissao() == 'Normal') echo 'selected'; ?>>Normal</option>
                            <option <?php if ($viewVar['usuario']->getPermissao() == 'Leitura') echo 'selected'; ?>>Leitura</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                </form>
            </div>
            <div class=" col-md-3"></div>
        </div>
    </div>

</main>