<main role="main" class="flex-shrink-0">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h1 class="mt-2">Cadastro de Usuário</h1>
                <?php
                //Mensagens de Erro ou Sucesso na execução das funções
                echo $Sessao::retornaMensagem();
                $Sessao::limpaMensagem();
                ?>

                <form action="<?php echo 'http://' . APP_HOST . '/usuario/salvar/novo'; ?>" method="post" id="formCadastrarUsuario">
                    <div class="form-group">
                        <label for="login">Login do Usuario</label>
                        <input type="text" class="form-control" name="login" value="<?php echo isset($viewVar['usuario']) ? $viewVar['usuario']->getLogin() : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome do Usuario</label>
                        <input type="text" class="form-control" name="nome" value="<?php echo isset($viewVar['usuario']) ? $viewVar['usuario']->getNome() : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" name="senha" value="<?php echo isset($viewVar['usuario']) ? $viewVar['usuario']->getSenha() : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo isset($viewVar['usuario']) ? $viewVar['usuario']->getEmail() : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="permissao">Permissão</label>
                        <select class="form-control" name="permissao" required>
                            <option <?php if (isset($viewVar['usuario']) && $viewVar['usuario']->getPermissao() == 'Admin') echo 'selected'; ?>>Admin</option>
                            <option <?php if (isset($viewVar['usuario']) && $viewVar['usuario']->getPermissao() == 'Normal') echo 'selected'; ?>>Normal</option>
                            <option <?php if (isset($viewVar['usuario']) && $viewVar['usuario']->getPermissao() == 'Leitura') echo 'selected'; ?>>Leitura</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                </form>
            </div>
            <div class=" col-md-3"></div>
        </div>
    </div>
</main>