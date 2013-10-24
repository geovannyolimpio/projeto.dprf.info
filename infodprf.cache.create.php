<?php

/**
 * infoDPRF
 * Arquivo respons�vel pela chamada e cria��o de cache das consultas sql.
 * 
 * @author M�rio P�cio <mario.pacio@gmail.com>
 * @copyright 2013
 * @version 1.0
 * @package infoDPRF
 * @license AGPLv3 - http://www.gnu.org/licenses/agpl-3.0.html
 * 
 */

    ob_start();
    
    ini_set('memory_limit', '-1');
    set_time_limit(0);
    
    mysql_connect('localhost', 'root', '');
    mysql_select_db('dprf');
    
    require_once 'infodprf.class.php';
    
    // Inicia a classe principal do projeto
    $infoDPRF = new infoDPRF;
    
    // Configura a classe para o per�odo atual
    $infoDPRF->configure();
    
    // Faz a verifica��o da exist�ncia do cache para agilizar no carregamento da p�gina
    $Dados = $infoDPRF->getData();
    
    // Se o cache ainda n�o existir, faz a conex�o com a tabela 
    if(!$Dados){
        // Executa o comando sql
        $infoDPRF->getDataSQL();
    }
    
    if(!$infoDPRF->resultados){

        die('nenhum_resultado');

    }
    
    die('ok');
    

?>