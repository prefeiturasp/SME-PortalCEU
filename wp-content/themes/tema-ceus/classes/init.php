<?php
/* Inicialização das Classes */

require_once 'LoadDependences.php';
require_once 'Lib/Util.php';
require_once 'Lib/SimpleXLSXGen.php';

require_once 'Header/Header.php';

require_once 'Usuarios/Editor/Editor.php';
require_once 'Usuarios/Colaborador/Colaborador.php';
require_once 'Usuarios/Administrador/Administrador.php';
//require_once 'Usuarios/Dre/Dre.php';
require_once 'Usuarios/EnviarParaRevisao.php';
require_once 'Usuarios/CamposAdicionais.php';

//tutorial
require_once 'tutorial/tutorial.php';

require_once 'Cpt/Cpt.php';
require_once 'Cpt/CptPosts.php';
require_once 'Cpt/CptPages.php';
require_once 'Cpt/CptCard.php';
require_once 'Cpt/CptAgendaSecretario.php';
require_once 'Cpt/CptContato.php';
require_once 'Cpt/CptOrganograma.php';
require_once 'Cpt/CptAba.php';
require_once 'Cpt/CptBotao.php';
require_once 'Cpt/CptCurriculoDaCidade.php';
require_once 'Cpt/cptProgramaProjeto.php';
require_once 'Cpt/CptUnidades.php';
require_once 'Cpt/CptDestaque.php';

require_once 'TemplateHierarchy/Page.php';
require_once 'TemplateHierarchy/Tag.php';
require_once 'TemplateHierarchy/LoopSingleCard.php';
require_once 'TemplateHierarchy/LoopSingle/LoopSingle.php';
require_once 'TemplateHierarchy/LoopSingle/LoopSingleCabecalho.php';
require_once 'TemplateHierarchy/LoopSingle/LoopSingleMenuInterno.php';
require_once 'TemplateHierarchy/LoopSingle/LoopSingleNoticiaPrincipal.php';
require_once 'TemplateHierarchy/LoopSingle/LoopSingleMaisRecentes.php';
require_once 'TemplateHierarchy/LoopSingle/LoopSingleRelacionadas.php';

require_once 'TemplateHierarchy/LoopUnidades/LoopUnidades.php';
require_once 'TemplateHierarchy/LoopUnidades/LoopUnidadesCabecalho.php';
require_once 'TemplateHierarchy/LoopUnidades/LoopUnidadesSlide.php';
require_once 'TemplateHierarchy/LoopUnidades/LoopUnidadesTabs.php';

require_once 'TemplateHierarchy/ArchiveAgenda/ArchiveAgendaGetDatasEventos.php';
require_once 'TemplateHierarchy/ArchiveContato/ArchiveContatoMetabox.php';
require_once 'TemplateHierarchy/ArchiveContato/ArchiveContato.php';
require_once 'TemplateHierarchy/ArchiveContato/ExibirContatosTodasPaginas.php';
//require_once 'TemplateHierarchy/ArchiveAgenda/ArchiveAgenda.php';
//require_once 'TemplateHierarchy/ArchiveAgenda/ArchiveAgendaAjaxCalendario.php';
require_once 'TemplateHierarchy/ArchiveOrganograma/ArchiveOrganogramaDetectMobile.php';
require_once 'TemplateHierarchy/ArchiveOrganograma/ArchiveOrganograma.php';
require_once 'TemplateHierarchy/ArchiveOrganograma/ArchiveOrganogramaConselhos.php';
require_once 'TemplateHierarchy/ArchiveOrganograma/ArchiveOrganogramaSecretario.php';
require_once 'TemplateHierarchy/ArchiveOrganograma/ArchiveOrganogramaAssessorias.php';
require_once 'TemplateHierarchy/ArchiveOrganograma/ArchiveOrganogramaCoordenadorias.php';
require_once 'TemplateHierarchy/ArchiveOrganograma/ArchiveOrganogramaDres.php';
require_once 'TemplateHierarchy/ArchiveOrganograma/ArchiveOrganogramaRodape.php';
require_once 'TemplateHierarchy/ArchiveOrganograma/Mobile/ArchiveOrganogramaMobile.php';
require_once 'TemplateHierarchy/ArchiveOrganograma/Mobile/ArchiveOrganogramaConselhosMobile.php';
require_once 'TemplateHierarchy/ArchiveOrganograma/Mobile/ArchiveOrganogramaSecretarioMobile.php';
require_once 'TemplateHierarchy/ArchiveOrganograma/Mobile/ArchiveOrganogramaAssessoriasMobile.php';
require_once 'TemplateHierarchy/ArchiveOrganograma/Mobile/ArchiveOrganogramaCoordenadoriasMobile.php';
require_once 'TemplateHierarchy/ArchiveOrganograma/Mobile/ArchiveOrganogramaDresMobile.php';
require_once 'TemplateHierarchy/ArchiveOrganograma/Mobile/ArchiveOrganogramaRodape.php';
require_once 'TemplateHierarchy/ArchiveCurriculoDaCidade/ArchiveCurriculoDaCidade.php';
require_once 'TemplateHierarchy/ArchiveProgramaProjeto/ArchiveProgramaProjeto.php';

require_once 'TemplateHierarchy/Search/GetTipoDePost.php';
require_once 'TemplateHierarchy/Search/SearchForm.php';
require_once 'TemplateHierarchy/Search/LoopSearch.php';
require_once 'TemplateHierarchy/Search/SearchFormSingle.php';
require_once 'TemplateHierarchy/Search/LoopSearchSingle.php';

require_once 'ModelosDePaginas/PaginaInicial/PaginaInicial.php';
require_once 'ModelosDePaginas/PaginaInicial/PaginaInicialIconesDetectMobile.php';
require_once 'ModelosDePaginas/PaginaInicial/PaginaInicialIcones.php';
require_once 'ModelosDePaginas/PaginaInicial/Mobile/PaginaInicialIconesMobile.php';
require_once 'ModelosDePaginas/PaginaInicial/PaginaInicialNoticiasDestaquePrimaria.php';
require_once 'ModelosDePaginas/PaginaInicial/PaginaInicialNoticiasDestaqueSecundarias.php';
require_once 'ModelosDePaginas/PaginaInicial/PaginaInicialTwitter.php';
require_once 'ModelosDePaginas/PaginaInicial/PaginaInicialNewsletter.php';
require_once 'ModelosDePaginas/PaginaInicial/PaginaInicialFacebook.php';
require_once 'ModelosDePaginas/PaginaCards/PaginaCards.php';
require_once 'ModelosDePaginas/PaginaImagemVideo/PaginaImagemVideo.php';
require_once 'ModelosDePaginas/PaginaLayoutColunas/PaginaLayoutColunas.php';
require_once 'ModelosDePaginas/PaginaAbas/PaginaAbas.php';
require_once 'ModelosDePaginas/PaginaAbas/PaginaAbasTitulos.php';
require_once 'ModelosDePaginas/PaginaAbas/PaginaAbasContato.php';
require_once 'ModelosDePaginas/PaginaAbas/PaginaAbasBotoes.php';
require_once 'ModelosDePaginas/PaginaAbas/PaginaAbasAcoesDestaque.php';
require_once 'ModelosDePaginas/PaginaAbas/PaginaAbasConteudos.php';
require_once 'ModelosDePaginas/PaginaBotoes/PaginaBotoes.php';
require_once 'ModelosDePaginas/LandingPages/Modelo_1.php';
require_once 'ModelosDePaginas/LandingPages/Modelo_2.php';
require_once 'ModelosDePaginas/Layout/construtor.php';

require_once 'ModelosDePaginas/PaginaMaisNoticias/PaginaMaisNoticias.php';
require_once 'ModelosDePaginas/PaginaMaisNoticias/PaginaMaisNoticiasArrayIdNoticias.php';
require_once 'ModelosDePaginas/PaginaMaisNoticias/PaginaMaisNoticiasMenu.php';
require_once 'ModelosDePaginas/PaginaMaisNoticias/PaginaMaisNoticiasTitulo.php';
require_once 'ModelosDePaginas/PaginaMaisNoticias/PaginaMaisNoticiasDestaques.php';
require_once 'ModelosDePaginas/PaginaMaisNoticias/PaginaMaisNoticiasProgramasProjetos.php';
require_once 'ModelosDePaginas/PaginaMaisNoticias/PaginaMaisNoticiasMaisLidas.php';
require_once 'ModelosDePaginas/PaginaMaisNoticias/PaginaMaisNoticiasOutrasNoticias.php';
require_once 'ModelosDePaginas/PaginaMaisNoticias/PaginaMaisNoticiasNewsletter.php';

require_once 'ModelosDePaginas/PaginaMapaDres/PaginaMapaDres.php';
require_once 'ModelosDePaginas/PaginaMapaDres/PaginaMapaDresMapa.php';
require_once 'ModelosDePaginas/PaginaMapaDres/PaginaMapaDresBotoes.php';
require_once 'ModelosDePaginas/PaginaMapaDres/PaginaMapaDresBlocosDeTextosAdicionais.php';

require_once 'ModelosDePaginas/PaginaProgramacao/PaginaProgramacao.php';
require_once 'ModelosDePaginas/PaginaProgramacao/PaginaProgramacaoSlide.php';
require_once 'ModelosDePaginas/PaginaProgramacao/PaginaProgramacaoBusca.php';
require_once 'ModelosDePaginas/PaginaProgramacao/PaginaProgramacaoCategorias.php';
require_once 'ModelosDePaginas/PaginaProgramacao/PaginaProgramacaoEventos.php';

require_once 'ModelosDePaginas/PaginaUnidades/PaginaUnidades.php';
require_once 'ModelosDePaginas/PaginaUnidades/PaginaUnidadesMapa.php';

require_once 'BuscaDeEscolas/BuscaDeEscolasRewriteUrl.php';
require_once 'BuscaDeEscolas/BuscaDeEscolas.php';

require_once 'Breadcrumb/Breadcrumb.php';

require_once 'ModelosDePaginas/ModelosDePaginaRemoveThemeSupport.php';

require_once 'Cpt/CptMediaImages.php';

/* Inicialização CPTs */
$cptPostsExtend = new \Classes\Cpt\CptPosts();
$cptPagessExtend = new \Classes\Cpt\CptPages();
$cptUnidades = new \Classes\Cpt\Cpt('unidade', 'unidade', 'Sobre o CEU', 'Minhas Unidades', 'Unidades', 'Cadastro de Unidades', '', '', '', 'dashicons-building' , true);
$cptUnidadesExtend = new \Classes\Cpt\CptUnidades();

$cptDestaque = new \Classes\Cpt\Cpt('destaque', 'destaque', 'Destaque', 'Todos os Destaques', 'Destaques', 'Destaque', '', '', '', 'dashicons-feedback', true);
$cptDestaqueExtend = new \Classes\Cpt\CptDestaque();

//$cptAgendaSecretario = new \Classes\Cpt\Cpt('agenda', 'agenda', 'Agenda do Secretário', 'Todos os Eventos', 'Eventos', 'Eventos', null, null, null, 'dashicons-calendar-alt', true);
//$cptAgendaSecretarioExtend = new \Classes\Cpt\CptAgendaSecretario();
//$cptContatoSme = new \Classes\Cpt\Cpt('contato', 'contato', 'Contatos SME', 'Todos os Contatos', 'Contatos', 'Contato', 'categorias-contato', 'Categorias de Contatos', 'Categoria de Contato','dashicons-email-alt', true);
//$cptContatoSmeExtend = new \Classes\Cpt\CptContato();
//$cptOrganograma = new \Classes\Cpt\Cpt('organograma', 'organograma', 'Organograma', 'Todos os Itens', 'Organogramas', 'Organograma', 'categorias-organograma', 'Categorias de Organograma', 'Categoria de Organograma', 'dashicons-networking', true );

//$cptAbas = new \Classes\Cpt\Cpt('aba', 'aba', 'Cadastro de Abas', 'Todos as Abas', 'Abas', 'Cadastro de Abas', 'categorias-aba', 'Categorias de Abas', 'Categoria de Aba', 'dashicons-index-card' , true);
//$cptAbasExtend = new \Classes\Cpt\CptAba();

//$cptBotao = new \Classes\Cpt\Cpt('botao', 'botao', 'Cadastro de Botões', 'Todos os Botões', 'Botões', 'Cadastro de Botões', 'categorias-botao', 'Categorias de Botões', 'Categoria de Botão', 'dashicons-external' , true);
//$cptBotaoExtend = new \Classes\Cpt\CptBotao();

$taxonomiaMediaImages = new \Classes\Cpt\CptMediaImages();

//$cptCurriculoDaCidade = new \Classes\Cpt\Cpt('curriculo-da-cidade', 'curriculo-da-cidade', 'Currículo da Cidade', 'Todos os Currículos', 'Currículos da Cidade', 'Currículo da Cidade', 'categorias-curriculo-da-cidade', 'Categorias de Currículos', 'Categoria de Currículo', 'dashicons-format-image', true);
//$cptCurriculoDaCidadeExtende = new \Classes\Cpt\CptCurriculoDaCidade();

//$cptProgramasEProjetos = new \Classes\Cpt\Cpt('programa-projeto', 'programa-projeto', 'Programas e Projetos', 'Todos os Programas e Projetos', 'Programas e Projetos', 'Programas e Projetos', 'categorias-programa-projeto', 'Categorias de Programas e Projetos', 'Categoria de Programas e Projetos', 'dashicons-format-image', true);
//$cptProgramasEProjetosExtende = new \Classes\Cpt\CptProgramasEProjetos();