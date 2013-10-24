<?php

/**
 * infoDPRF
 * Arquivo respons�vel pelo template base do projeto.
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

    require_once 'infodprf.class.php';
    
    // Inicia a classe principal do projeto
    $infoDPRF = new infoDPRF;
    
    // Configura a classe para o per�odo atual
    $infoDPRF->configure();
    
    // Seta o tema do conte�do (clean/dark)
    $infoDPRF->setTheme('dark');
    
    // Faz a verifica��o da exist�ncia do cache para agilizar no carregamento da p�gina
    $Dados = $infoDPRF->getData();
    
    // Se o cache ainda n�o existir, vamos fazer uma conex�o com as tabelas
    if(!$Dados){
        $getDataSQL = true;
    }
    // Cria o objeto que retorna os dados do per�odo anterior
    $infoDPRF_Anterior = new infoDPRF;
    
    // Configura a classe para o per�odo anterior
    $infoDPRF_Anterior->configure();
    
    // Conecta ao objeto do per�odo anterior
    $infoDPRF_Anterior->getData(0);
    
    if(!file_exists($infoDPRF_Anterior->cache_file)){
        // Conecta ao objeto do per�odo anterior
        $infoDPRF_Anterior->getDataSQL(0);
    }
    
    // URL Intranet (Utilizei para testes)
    $Url_Base = '/';

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html>
<!--<![endif]-->
<head>

<title><?php echo $infoDPRF->Title; ?></title>

<meta charset="iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="description" content="<?php echo $infoDPRF->Description; ?>" />
<meta name="keywords" content="estatisticas, rodovias federais, estat�sticas, federal, policia rodoviaria federal, infodprf, estatisticas de acidentes, transito, acidentes, rodovias federais" />
<meta name="author" content="M�rio P�cio" />

<meta property="fb:app_id" content="471052223008882" />
<meta property="og:title" content="<?php echo $infoDPRF->Title; ?>" />
<meta property="og:url" content="http://dprf.info" />
<meta property="og:image" content="http://dprf.info/assets/img/tags/facebook_200x200.png" />
<meta property="og:site_name" content="DPRF.info - Estat�sticas em rodovias federais" />
<meta property="og:description" content="<?php echo $infoDPRF->Description; ?>" />

<!-- CSS -->
<link href="<?php echo $Url_Base; ?>assets/css/lib/bootstrap.css" rel="stylesheet" />
<link href="<?php echo $Url_Base; ?>assets/css/lib/bootstrap-responsive.css" rel="stylesheet" />
<link href="<?php echo $Url_Base; ?>assets/css/extension.css" rel="stylesheet" />
<link href="<?php echo $Url_Base; ?>assets/css/dprf.css" rel="stylesheet" />
<link href="<?php echo $Url_Base; ?>assets/css/coloring.css" rel="stylesheet" />
<link href="<?php echo $Url_Base; ?>assets/css/utility.css" rel="stylesheet" />

<!-- elementos HTML5 para IE6-8 -->
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="<?php echo $Url_Base; ?>assets/plugins/selectivizr/selectivizr-min.js"></script>
    <script src="<?php echo $Url_Base; ?>assets/plugins/flot/excanvas.min.js"></script>
<![endif]-->

<!-- fav/touch -->
<link rel="shortcut icon" href="<?php echo $Url_Base; ?>assets/img/tags/favicon_16x16.ico"/>
<link rel="apple-touch-icon" href="<?php echo $Url_Base; ?>assets/img/tags/touch-icon-iphone.png" />
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $Url_Base; ?>assets/img/tags/touch-icon-ipad.png" />
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $Url_Base; ?>assets/img/tags/touch-icon-iphone-retina.png" />
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $Url_Base; ?>assets/img/tags/touch-icon-ipad-retina.png" />
<link rel="apple-touch-startup-image" href="<?php echo $Url_Base; ?>assets/img/tags/startup.png" />
<link id="book-index-page" rel="In�cio" title="Tela inicial" type="text/html" href="<?php echo $Url_Base; ?>" />

</head>

<body class="sidebar-left panel-side">

<div class="page-container">
    <div id="header-container">
        <div id="header">
            <div class="navbar navbar-inverse navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        
                        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                        
                        <a class="brand" href="<?php echo $Url_Base; ?>"><img src="<?php echo $Url_Base; ?>assets/img/logo.png" title="infoDPRF" /></a>
                        
                        <div class="search-global Btip" title="Procure pela BR ou pela data.">
                        
                        <form onsubmit="return validaBusca(0)" method="post" action="<?php echo $Url_Base; ?>Busca" id="form_busca_topo">
                            <input id="input_busca_topo" name="input_busca_topo" autocomplete="off" value="<?php echo $_SESSION['input_busca_topo']; ?>" placeholder="Procurar por.." class="search search-query input-medium" type="search" data-items="4" />
                            <a href="javascript:validaBusca(1)" class="search-button"><i class="fontello-icon-search-5"></i></a> 
                        </form>
                        
                        </div>
                        
                        <div class="nav-collapse collapse">
                            <ul class="nav">
                                <li> <a href="<?php echo $Url_Base; ?>About">O que �?</a> </li>
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><span class="fontello-icon-list-1"></span>Links <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-header">Desenvolvimento</li>
                                        <li><a href="<?php echo $Url_Base; ?>MarioPacio"><i class="fontello-icon-user-3"></i> M�rio P�cio</a></li>
                                        <li class="divider"></li>
                                        <li class="nav-header">Organiza��o</li>
                                        <li><a href="http://portal.mj.gov.br/" target="_blank" title="Minist�rio da Justi�a"><i class="fontello-icon-globe"></i> Minist�rio da Justi�a</a></li>
                                        <li><a href="http://www.dprf.gov.br/" target="_blank" title="Pol�cia Rodovi�ria Federal"><i class="fontello-icon-globe"></i> Pol�cia Rodovi�ria Federal</a></li>
                                        <li><a href="http://www.w3c.br/" target="_blank" title="W3C Brasil"><i class="fontello-icon-globe"></i> W3C Brasil</a></li>
                                        <li class="divider"></li>
                                        <li class="nav-header">Dados abertos</li>
                                        <li><a href="http://dados.gov.br/" target="_blank"><i class="fontello-icon-download-1"></i> Dados.gov.br</a></li>
                                        <li><a href="https://github.com/mariopacio/projeto.dprf.info" target="_blank"><i class="fontello-icon-github-text"></i> infoDPRF</a></li>
                                        <li><a href="http://www.gnu.org/licenses/agpl-3.0.html" target="_blank" title="Licen�a AGPLv3"><i class="fontello-icon-thumbs-up-3"></i> Licen�a AGPLv3</a></li>
                                                                       
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // navbar -->
            
            <div class="header-drawer">
                <div class="mobile-nav text-center visible-phone"> <a href="javascript:void(0);" class="mobile-btn" data-toggle="collapse" data-target=".sidebar"><i class="aweso-icon-chevron-down"></i> Navegar por...</a> </div>
                <!-- // Resposive navigation -->
                <div class="breadcrumbs-nav hidden-phone">
                    <ul id="breadcrumbs" class="breadcrumb">
                        <?php if($_GET['tipo'] == '404'): ?>
                        <li><a href="<?php echo $Url_Base; ?>"><i class="fontello-icon-home f12"></i> In�cio</a> <span class="divider">/</span></li>
                        <li class="active">P�gina n�o encontrada</li>
                        <?php elseif($_GET['tipo'] == 'notfound'): ?>
                        <li><a href="<?php echo $Url_Base; ?>"><i class="fontello-icon-home f12"></i> In�cio</a> <span class="divider">/</span></li>
                        <li class="active">Nenhum resultado</li>
                        <?php elseif($_GET['tipo'] == 'mario'): ?>
                        <li><a href="<?php echo $Url_Base; ?>"><i class="fontello-icon-home f12"></i> In�cio</a> <span class="divider">/</span></li>
                        <li class="active">M�rio P�cio</li>
                        <?php elseif($_GET['tipo'] == 'about'): ?>
                        <li><a href="<?php echo $Url_Base; ?>"><i class="fontello-icon-home f12"></i> In�cio</a> <span class="divider">/</span></li>
                        <li class="active">Projeto</li>
                        <?php else: ?>
                        <li><a href="<?php echo $Url_Base; ?>"><i class="fontello-icon-home f12"></i> Estat�sticas</a> <span class="divider">/</span></li>
                        <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><?php echo $infoDPRF->Tipo_Periodo; ?> </a> <b class="caret"></b> <span class="divider">/</span>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo $Url_Base; ?>Semestre"><i class="fontello-icon-calendar"></i> Semestral</a></li>
                                <li><a href="<?php echo $Url_Base; ?>Trimestre"><i class="fontello-icon-calendar"></i> Trimestral</a></li>
                                <li><a href="<?php echo $Url_Base; ?>Mensal"><i class="fontello-icon-calendar"></i> Mensal</a></li>
                                <li><a href="<?php echo $Url_Base; ?>Diario"><i class="fontello-icon-calendar"></i> Di�rio</a></li>
                            </ul>
                        </li>
                        <li class="active"><?php echo $infoDPRF->Legenda_Periodo; ?> </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- // breadcrumbs --> 
            </div>
            <!-- // drawer --> 
        </div>
    </div>
    <!-- // header-container -->
    
    <div id="main-container">
        <div id="main-sidebar" class="sidebar sidebar-inverse">
            
            <ul id="mainSideMenu" class="nav nav-list nav-side">
            
                <li class="accordion-group">
                    <div class="accordion-heading"> <a href="#accPeriodos" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle"> <span class="item-icon fontello-icon-calendar"></span> <i class="chevron fontello-icon-right-open-3"></i> Per�odos </a> </div>
                    <ul class="accordion-content nav nav-list collapse in" id="accPeriodos">
                        <li> <a href="<?php echo $Url_Base; ?>Semestre"> <i class="fontello-icon-right-dir"></i> Semestral </a> </li>
                        <li> <a href="<?php echo $Url_Base; ?>Trimestre"> <i class="fontello-icon-right-dir"></i> Trimestral </a> </li>
                        <li> <a href="<?php echo $Url_Base; ?>Mensal"> <i class="fontello-icon-right-dir"></i> Mensal </a> </li>
                        <li> <a href="<?php echo $Url_Base; ?>Diario"> <i class="fontello-icon-right-dir"></i> Di�rio </a> </li>
                    </ul>
                </li>

                <li class="accordion-group">
                    <div class="accordion-heading"> <a href="#accAcidentes" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle"> <span class="item-icon fontello-icon-shuffle-1"></span><i class="chevron fontello-icon-right-open-3"></i> Acidentes </a> </div>
                    <ul class="accordion-content nav nav-list collapse" id="accAcidentes">
                        <li> <a href="<?php echo $Url_Base; ?><?php echo $infoDPRF->URL; ?>/Tipos"> <i class="fontello-icon-right-dir"></i> Tipos de acidentes </a> </li>
                        <li> <a href="<?php echo $Url_Base; ?><?php echo $infoDPRF->URL; ?>/Causas"> <i class="fontello-icon-right-dir"></i> Causas de acidentes</a> </li>
                    </ul>
                </li>

                <li class="accordion-group">
                    <div class="accordion-heading"> <a href="#accPessoas" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle"> <span class="item-icon fontello-icon-users"></span> <i class="chevron fontello-icon-right-open-3"></i> Condutores </a> </div>
                    <ul class="accordion-content nav nav-list collapse" id="accPessoas">
                        <li> <a href="<?php echo $Url_Base; ?><?php echo $infoDPRF->URL; ?>/Idade"> <i class="fontello-icon-right-dir"></i> Faixa de idade  </a> </li>
                    </ul>
                </li>

                <li class="accordion-group">
                    <div class="accordion-heading"> <a href="#accVeiculos" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle"> <span class="item-icon  aweso-icon-truck"></span> <i class="chevron fontello-icon-right-open-3"></i> Ve�culos </a> </div>
                    <ul class="accordion-content nav nav-list collapse" id="accVeiculos">
                        <li> <a href="<?php echo $Url_Base; ?><?php echo $infoDPRF->URL; ?>/Marcas"> <i class="fontello-icon-right-dir"></i> Marcas <span class="hidden-tablet">mais envolvidas</span> </a> </li>
                        <li> <a href="<?php echo $Url_Base; ?><?php echo $infoDPRF->URL; ?>/Modelos"> <i class="fontello-icon-right-dir"></i> Modelos <span class="hidden-tablet">mais envolvidos</span> </a> </li>
                    </ul>
                </li>

                <li class="accordion-group">
                    <div class="accordion-heading"> <a href="#accTrechos" data-parent="#mainSideMenu" data-toggle="collapse" class="accordion-toggle"> <span class="item-icon fontello-icon-road"></span> <i class="chevron fontello-icon-right-open-3"></i> Rodovias </a> </div>
                    <ul class="accordion-content nav nav-list collapse" id="accTrechos">
                        <li> <a href="<?php echo $Url_Base; ?>BR/Procurar/<?php echo $infoDPRF->URL; ?>"> <i class="fontello-icon-right-dir"></i> �ndice de rodovias </a> </li>
                        <li> <a href="<?php echo $Url_Base; ?>BR/Perigosas/<?php echo $infoDPRF->URL; ?>"> <i class="fontello-icon-right-dir"></i> Trechos <span class="hidden-tablet">mais</span> perigosos </a> </li>
                    </ul>
                </li>
                
                <li class="accordion-group">
                    <div class="accordion-heading"> <a href="#responsive" data-toggle="modal" class="accordion-toggle"> <span class="item-icon fontello-icon-calendar"></span> <i class="chevron fontello-icon-right-open-3"></i> Filtrar <span class="hidden-tablet">por</span> Per�odo</a> </div>
                </li>

            </ul>
            <div class="class_org">
                <img src="<?php echo $Url_Base; ?>assets/img/footer_partners.png" />
            </div>
            <!-- // sidebar menu -->
            
            <div class="sidebar-item"></div>
            
        </div>
        <!-- // sidebar -->
        
        <div id="main-content" class="main-content container-fluid">
        
            <?php 
                
                if($getDataSQL){
                    
                    $include = 'infodprf/infodprf.cache.php';
                    $js_chart = 'infodprf.cache';
                    
                } else {
                    
                    if($_GET['tipo']){
                        $include = 'infodprf/infodprf.'.$_GET['tipo'].'.php';
                        $js_chart = 'infodprf.'.$_GET['tipo'];
                    } else {
                        $include = 'infodprf/infodprf.resumo.php';
                        $js_chart = 'infodprf.resumo';
                    }
                    
                }
                
                require $include;
                
            ?>
            
        </div>
        <!-- // main-content --> 
        
    </div>
    <!-- // main-container  -->
    
    <?php if($infoDPRF->QRCode): ?>
    <div id="QRCode" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="QRCodeLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fontello-icon-cancel-1"></i></button>
                    <h4 id="QRCodeLabel"><i class="fontello-icon-qrcode"></i> Dispositivos m�veis</h4>
                </div>
                <div class="modal-body">
                    <p>
                        <img src="<?php echo $infoDPRF->QRCode('2'); ?>" class="pull-left" /> 
                        Voc� sabia que pode acessar os resultados desta p�gina diretamente de seu celular ou tablet? 
                        <br /><br />
                        Basta utilizar o leitor QRCode de seu aparelho na imagem ao lado.
                        <br /><br />
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-red" data-dismiss="modal">Fechar</button>
                </div>
    </div>
    <?php endif; ?>
    
    <div id="ErroBusca" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="ErroBuscaLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fontello-icon-cancel-1"></i></button>
                    <h4 id="ErroBuscaLabel"><i class="fontello-icon-info-circle-1"></i> Digite algo para pesquisar!</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Voc� sabia que pode pesquisar rapidamente as estat�sticas na p�gina diretamente pela busca no topo do aplicativo? 
                        <br /><br />
                        <strong>Procure pelo nome da BR.</strong><br />
                        <em>Exemplo:</em> BR-101/SC
                        <br />
                        <strong>Procure por per�odos.</strong><br /> 
                        <em>Exemplos:</em> <br />
                        2012 (buscar pelo ano)<br />
                        02/2012 (buscar por Fevereiro de 2012)<br />
                        01/01/2012 (buscar pelo dia 01 de Janeiro de 2012)
                        <!--br />
                        <strong>Procure pelo N�mero da Ocorr�ncia.</strong>
                        <br /><br /-->
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-red" data-dismiss="modal">Fechar</button>
                </div>
    </div>
    
    <div id="responsive" class="modal hide fade" tabindex="-1" data-width="400">
        <form method="post" name="valida_filtro" id="valida_filtro" action="<?php echo $Url_Base; ?>Busca" onsubmit="return valida_filtro()">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4>Filtrar por per�odo</h4>
        </div>
        <div class="modal-body seleciona_periodo">
                <div class="row-fluid">
                    <div class="span12">
                        <p>Selecione o tipo de per�odo desejado para consulta.</p>
                        <p class="block-tp-periodo">
                            <select name="sel_tp_periodo" id="sel_tp_periodo" class="input-block-level" onchange="escolhe_periodo(this.value)">
                                <option value=""></option>
                                <option value="Semestral">Semestral</option>
                                <option value="Trimestral">Trimestral</option>
                                <option value="Mensal">Mensal</option>
                                <option value="Diario">Di�rio</option>
                            </select>
                        </p>
                        <p class="block-ano hide">
                            <select name="sel_ano" id="sel_ano" class="input-block-level" onchange="escolhe_ano(this.value)">
                                <option value="">Selecione o ano</option>
                                <?php for($ano = 2013; $ano >= 2007; $ano--){ ?>
                                <option value="<?php echo $ano; ?>"><?php echo $ano; ?></option>
                                <?php } ?>
                            </select>
                        </p>
                        <p class="block-semestre hide">
                            <select name="sel_semestre" id="sel_semestre" class="input-block-level" onchange="escolhe_semestre(this.value)">
                                <option value="">Selecione o semestre</option>
                                <option value="1">1� Semestre</option>
                                <option value="2">2� Semestre</option>
                            </select>
                        </p>
                        <p class="block-trimestre hide">
                            <select name="sel_trimestre" id="sel_trimestre" class="input-block-level" onchange="escolhe_trimestre(this.value)">
                                <option value="">Selecione o trimestre</option>
                                <option value="1">1� Trimestre</option>
                                <option value="2">2� Trimestre</option>
                                <option value="3">3� Trimestre</option>
                                <option value="4">4� Trimestre</option>
                            </select>
                        </p>
                        <p class="block-mes hide">
                            <select name="sel_mes" id="sel_mes" class="input-block-level" onchange="escolhe_mes(this.value)">
                                <option value="">Selecione o m�s</option>
                                <?php for($mes = 1; $mes <= 12; $mes++){ ?>
                                <option value="<?php echo (($mes < 10) ? '0'.$mes : $mes); ?>"><?php echo $infoDPRF->getMesFull((($mes < 10) ? '0'.$mes : $mes)); ?></option>
                                <?php } ?>
                            </select>
                        </p>
                        <p class="block-dia hide">
                            <select name="sel_dia" id="sel_dia" class="input-block-level" onchange="escolhe_dia(this.value)">
                                <option value="">Selecione o dia</option>
                                <?php for($dia = 1; $dia <= 31; $dia++){ ?>
                                <option value="<?php echo (($dia < 10) ? '0'.$dia : $dia); ?>"><?php echo (($dia < 10) ? '0'.$dia : $dia); ?></option>
                                <?php } ?>
                            </select>
                        </p>
                    </div>
                </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-boo fleft">Fechar</button>
            <button type="submit" class="btn btn-orange fright">Pesquisar</button>
        </div>
    </div>    
    </form>
</div>
<!-- // page-container  --> 

<div id="ajax-modal" class="modal hide fade" tabindex="-1"></div>

<!-- javascript --> 
<script src="<?php echo $Url_Base; ?>assets/js/lib/jquery.js"></script> 
<script src="<?php echo $Url_Base; ?>assets/js/lib/jquery-ui.js"></script>
<script src="<?php echo $Url_Base; ?>assets/js/lib/bootstrap.js"></script> 

<!-- Plugins Bootstrap --> 
<script src="<?php echo $Url_Base; ?>assets/plugins/bootstrap-progressbar/js/bootstrap-progressbar.js"></script> 
<script src="<?php echo $Url_Base; ?>assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script> 
<script src="<?php echo $Url_Base; ?>assets/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
<script src="<?php echo $Url_Base; ?>assets/plugins/bootstrap-toggle-buttons/js/bootstrap-toggle-buttons.js"></script>

<!-- Plugins Custom -->
<script src="<?php echo $Url_Base; ?>assets/plugins/nicescroll/jquery.nicescroll.js"></script> 
<script src="<?php echo $Url_Base; ?>assets/plugins/qtip2/dist/jquery.qtip.min.js"></script> 

<!-- Plugins Forms --> 
<script src="<?php echo $Url_Base; ?>assets/plugins/xbreadcrumbs/xbreadcrumbs.js"></script> 

<!-- Charts --> 
<script src="<?php echo $Url_Base; ?>assets/plugins/sparkline/jquery.sparkline.js"></script> 
<script src="<?php echo $Url_Base; ?>assets/plugins/flot/jquery.flot.js"></script> 
<script src="<?php echo $Url_Base; ?>assets/plugins/flot/jquery.flot.categories.js"></script> 
<script src="<?php echo $Url_Base; ?>assets/plugins/flot/jquery.flot.grow.js"></script> 
<script src="<?php echo $Url_Base; ?>assets/plugins/flot/jquery.flot.pie.js"></script> 
<script src="<?php echo $Url_Base; ?>assets/plugins/flot/jquery.flot.resize.js"></script> 
<script src="<?php echo $Url_Base; ?>assets/plugins/flot/jquery.flot.time.js"></script> 
<script src="<?php echo $Url_Base; ?>assets/plugins/NumberFormat.js"></script> 

<!-- js principal -->
<script src="<?php echo $Url_Base; ?>assets/js/infodprf.js"></script>  

<!-- js dinamico -->
<?php if($js_chart): ?>
<script src="<?php echo $Url_Base; ?>infodprf/js/<?php echo $js_chart; ?>.php?cache=<?php echo $infoDPRF->cache_file; ?>&periodo=<?php echo $infoDPRF->Periodo; ?>&tp_periodo=<?php echo $infoDPRF->Tipo_Periodo; ?>&ano=<?php echo $infoDPRF->Ano; ?>&mes=<?php echo $infoDPRF->Mes; ?>&dia=<?php echo $infoDPRF->Dia; ?>&br=<?php echo $infoDPRF->BR; ?>&uf=<?php echo $infoDPRF->UF; ?>&trecho=<?php echo $infoDPRF->Trecho; ?>&theme_name=<?php echo $infoDPRF->theme_name; ?>"></script> 
<?php endif; ?>
<?php if($showMaps): ?>
<!-- js mapa -->
<script src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="<?php echo $Url_Base; ?>assets/js/maps/markerclusterer.min.js"></script>
<script type="text/javascript" src="<?php echo $Url_Base; ?>assets/js/maps/infodprf.maps.js"></script>
<script type="text/javascript">
    google.load('maps', '3', {
   	    other_params: 'sensor=false'
    });
    google.setOnLoadCallback(speedTest.init);
</script>
<?php endif; ?>

</body>
</html>