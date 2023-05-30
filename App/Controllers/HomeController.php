<?php

/**
 * Description of HomeController
 * Esta classe é chamada por default quando não é digitado um controller
 *   específico na URL. 
 * O método index() será chamado por default e simplesmente renderiza a
 *   view home/index através do método render() da classe Mãe Controller.php 
 */


namespace App\Controllers; #Serve para o autoload das classe do composer saber onde é a classe


class HomeController extends Controller #Todos os controladodres devem ser filhos da classe Controle
{
    #Aqui nós temos os action
    
    public function index() 
    {
        $this->render('home/index');
    }
}
