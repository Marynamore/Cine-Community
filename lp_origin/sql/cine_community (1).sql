-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Jun-2023 às 21:39
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cine_community`
--
CREATE DATABASE IF NOT EXISTS `cine_community` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cine_community`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `canal_filme`
--

DROP TABLE IF EXISTS `canal_filme`;
CREATE TABLE `canal_filme` (
  `id_canal_filme` int(11) NOT NULL,
  `canal_filme` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `canal_filme`
--

INSERT INTO `canal_filme` (`id_canal_filme`, `canal_filme`) VALUES
(1, 'Netflix'),
(2, 'Amazon Prime Video'),
(3, 'Globoplay'),
(4, 'Disney+'),
(5, 'Telecine'),
(6, 'Now'),
(7, 'Paramount+'),
(8, 'HBO Max'),
(9, 'Star+');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

DROP TABLE IF EXISTS `carrinho`;
CREATE TABLE `carrinho` (
  `id_carrinho` int(11) NOT NULL,
  `qtd_compra` varchar(2) NOT NULL DEFAULT '1',
  `dt_hora_car` timestamp NOT NULL DEFAULT current_timestamp(),
  `fk_id_item` int(11) NOT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `fk_id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_filme`
--

DROP TABLE IF EXISTS `categoria_filme`;
CREATE TABLE `categoria_filme` (
  `id_categoria_filme` int(11) NOT NULL,
  `categoria_filme` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria_filme`
--

INSERT INTO `categoria_filme` (`id_categoria_filme`, `categoria_filme`) VALUES
(1, 'INFANTIL'),
(2, 'ROMANCE'),
(3, 'AÇÃO'),
(4, 'FICÇÃO'),
(5, 'TERROR'),
(6, 'COMEDIA'),
(7, 'DRAMA'),
(8, 'FAROESTE'),
(9, 'SUSPENSE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_item`
--

DROP TABLE IF EXISTS `categoria_item`;
CREATE TABLE `categoria_item` (
  `id_categoria_item` int(11) NOT NULL,
  `categoria_item` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categoria_item`
--

INSERT INTO `categoria_item` (`id_categoria_item`, `categoria_item`) VALUES
(1, 'Livros e Revistas'),
(2, 'Adereços'),
(3, 'Posters e Pôsteres');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `quant_compra` varchar(45) DEFAULT NULL,
  `fk_id_carrinho` int(11) NOT NULL,
  `fk_id_item` int(11) NOT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `fk_id_perfil` int(11) NOT NULL,
  `preco_compra` varchar(45) DEFAULT NULL,
  `dt_hora_compra` datetime DEFAULT current_timestamp(),
  `status_compra` varchar(45) DEFAULT NULL COMMENT 'Em progresso, Pendente, Concluída, Cancelada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favorito`
--

DROP TABLE IF EXISTS `favorito`;
CREATE TABLE `favorito` (
  `id_favorito` int(11) NOT NULL,
  `favorito` tinyint(2) DEFAULT NULL COMMENT 'inativo\nativo',
  `fk_id_usuario` int(11) NOT NULL,
  `fk_id_perfil` int(11) NOT NULL,
  `fk_id_filme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `filme`
--

DROP TABLE IF EXISTS `filme`;
CREATE TABLE `filme` (
  `id_filme` int(11) NOT NULL,
  `nome_filme` varchar(80) NOT NULL,
  `dt_de_lancamento_filme` date DEFAULT NULL,
  `duracao_filme` time DEFAULT NULL,
  `sinopse_filme` varchar(500) NOT NULL,
  `classificacao_filme` varchar(50) NOT NULL,
  `capa_filme` varchar(50) NOT NULL,
  `trailer_filme` varchar(50) DEFAULT NULL,
  `fk_id_categoria_filme` int(11) NOT NULL,
  `fk_id_canal_filme` int(11) NOT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `fk_id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `filme`
--

INSERT INTO `filme` (`id_filme`, `nome_filme`, `dt_de_lancamento_filme`, `duracao_filme`, `sinopse_filme`, `classificacao_filme`, `capa_filme`, `trailer_filme`, `fk_id_categoria_filme`, `fk_id_canal_filme`, `fk_id_usuario`, `fk_id_perfil`) VALUES
(1, 'Menina de Ouro', '2005-02-11', '02:12:00', 'Frankie Dunne (Clint Eastwood) passou toda a sua vida no ringue, gerenciando e treinando boxeadores de elite. Frankie costuma passar para os lutadores com quem trabalha as mesmas li??es que seguiu ao longo de sua vida: acima de tudo, proteja-se. Feri', '12', 'meninadeouro.jfif', '', 3, 1, 1, 2),
(3, 'Aftersun', '2022-12-01', '01:42:00', 'Em Aftersun, Sophie, de onze anos, e seu pai Callum est?o de f?rias em um clube na costa da Turquia no final dos anos 90. Eles tomam banho, jogam sinuca e desfrutam da companhia amig?vel um do outro. Callum era a melhor vers?o de si mesmo quando esta', '14', 'Aftersun.jfif', NULL, 7, 1, 2, 2),
(4, 'Inc?ndios', '2010-09-17', '02:10:00', 'Nawal, uma mulher moribunda do Oriente M?dio que vive em Montreal, deixou cartas para seus filhos g?meos lerem quando ela morreu. Jenny deve dar seu pai a um pai que ela nunca conheceu, e Simon deve dar seu pai a um irm?o que ele nunca conheceu.', '14', 'incendios.jpg', NULL, 7, 1, 2, 2),
(5, 'Druk - Mais uma Rodada', '2020-09-24', '01:57:00', '? um filme dinamarqu?s que conta a hist?ria de quatro amigos professores que decidem embarcar em um experimento arriscado: manter um n?vel constante de ?lcool no sangue todos os dias. O experimento come?a como uma tentativa de encontrar mais prazer n', '16', 'druk.jfif', NULL, 7, 1, 2, 2),
(6, 'A Ca?a', '2012-05-20', '01:55:00', '? um drama dinamarqu?s dirigido por Thomas Vinterberg e estrelado por Mads Mikkelsen. O filme conta a hist?ria de Lucas, um professor de jardim de inf?ncia que ? injustamente acusado de abusar sexualmente de uma crian?a. Apesar de sua inoc?ncia, Luca', '14', 'acaca.jfif', NULL, 7, 1, 2, 2),
(7, 'Arctic', '2018-05-10', '01:37:00', 'O filme conta a hist?ria de um piloto de avi?o que fica preso em meio ao ?rtico ap?s um acidente a?reo. Ele tenta sobreviver em um ambiente hostil e desolado, lutando contra as condi??es adversas e a falta de recursos, enquanto espera pelo resgate.', '14', 'artic.jpg', NULL, 7, 1, 2, 2),
(8, 'Bastardos Ingl?rios', '2009-10-09', '02:33:00', '? um filme de guerra dirigido por Quentin Tarantino que se passa na Fran?a ocupada pelos nazistas durante a Segunda Guerra Mundial. O filme segue um grupo de soldados judeus americanos liderados pelo Tenente Aldo Raine (interpretado por Brad Pitt), q', '18', 'bastardos.jfif', NULL, 3, 1, 2, 2),
(9, 'A Baleia', '2023-02-26', '01:57:00', 'Segue a hist?ria de Charlie (interpretado por Brendan Fraser), um professor de ingl?s recluso que luta contra um transtorno de compuls?o alimentar e vive com obesidade severa. Ele d? aulas online, mas tem medo de ser visto e sempre deixa a webcam des', '16', 'baleia.jfif', NULL, 7, 1, 2, 2),
(10, 'Halloween - A noite do Terror', '1978-10-25', '01:31:00', 'Michael Myers (interpretado por Tony Moran) ? um psicopata que foi internado em uma institui??o h? 15 anos, ap?s ter assassinado brutalmente sua pr?pria irm?. Apesar de estar sob cust?dia, ele consegue escapar e volta para sua cidade natal com o intu', '16', 'halloween.jfif', NULL, 5, 1, 2, 2),
(11, 'Halloween 2 - O Pesadelo Continua', '1981-10-30', '01:45:00', 'Em Haddonfield, Illinois, na noite de Halloween de 1978, Michael Myers matou tr?s estudantes e tentou assassinar Laurie Strode. Ele foi impedido pelo psiquiatra dele, Samuel Loomis, que o feriu com seis tiros. Myers conseguiu escapar mesmo ferido, e ', '18', 'halloween2.jfif', NULL, 5, 1, 2, 2),
(12, 'Halloween III - A Noite das Bruxas', '1982-10-22', '01:39:00', 'Um m?dico e uma jovem investigam uma empresa que fabrica m?scaras de Halloween que possuem um efeito estranho e fatal sobre as crian?as. Eles descobrem que o dono da empresa planeja us?-las em um ritual antigo para ressuscitar a era das bruxas de Sal', '16', 'halloween3.jpg', NULL, 5, 1, 2, 2),
(13, 'Halloween 4 – O Retorno de Michael Myers', '1988-10-21', '01:28:00', 'Depois de dez anos em coma, Michael Myers escapa de um hospital psiqui?trico e retorna ? cidade de Haddonfield para continuar sua onda de assassinatos. Ele persegue sua sobrinha Jamie Lloyd, que come?a a ter vis?es dele e se comporta de maneira estra', '18', 'Halloween4poster.jpg', NULL, 5, 1, 2, 2),
(14, 'Halloween 5 - A Vingan?a de Michael Myers', '1989-10-13', '01:36:00', 'Um ano depois dos eventos do filme anterior, Michael Myers sobrevive ? sua aparente morte e continua sua persegui??o a Jamie Lloyd, que agora est? internada em uma cl?nica psiqui?trica. Enquanto isso, o Dr. Loomis tenta capturar Myers e descobrir a o', '18', 'halloween5.jfif', NULL, 5, 1, 2, 2),
(15, 'Halloween 6: A ?ltima Vingan?a', '1995-10-29', '01:27:00', 'Seis anos ap?s os eventos do filme anterior, Michael Myers retorna a Haddonfield para perseguir Jamie Lloyd, agora uma m?e solteira, e seu filho rec?m-nascido. Enquanto isso, um culto misterioso liderado por um homem chamado Dr. Wynn est? envolvido e', '18', 'halloween6.jpg', NULL, 5, 1, 2, 2),
(16, 'Halloween H20: Vinte Anos Depois', '1998-08-05', '01:43:00', 'Vinte anos ap?s os eventos do filme original de Halloween, Laurie Strode (Jamie Lee Curtis), agora vivendo sob um nome falso, ? diretora de uma escola particular em um local isolado na Calif?rnia. Ela tenta levar uma vida normal com seu filho adolesc', '18', 'halloweenh20.jpg', NULL, 5, 1, 2, 2),
(17, 'Halloween – Ressurrei??o', '2002-07-12', '01:34:00', 'Um grupo de estudantes de uma universidade ? convidado para participar de um reality show transmitido ao vivo na internet em que eles precisam passar a noite na casa onde Michael Myers supostamente cresceu. Mas o que eles n?o sabem ? que Michael Myer', '18', 'halloweenre.jpg', NULL, 5, 1, 2, 2),
(18, 'Halloween – O In?cio', '2007-08-31', '02:01:00', 'Este filme ? um reboot da s?rie \"Halloween\" e conta a hist?ria de Michael Myers quando ele era crian?a, mostrando como ele se tornou um assassino em s?rie. O filme segue a inf?ncia de Michael Myers, que foi abusado pela m?e e pelo padrasto e passou p', '18', 'halloween1.jfif', NULL, 5, 1, 2, 2),
(19, 'Halloween II (remake)', '2009-08-28', '01:45:00', 'O filme continua a hist?ria de Michael Myers e Laurie Strode ap?s os eventos do filme anterior. Laurie tenta lidar com os traumas que sofreu e come?a a ter vis?es de Michael. Enquanto isso, Michael sobrevive ao tiroteio da pol?cia e segue sua jornada', '18', 'halloween2.jfif', NULL, 5, 2, 2, 2),
(20, 'Halloween(remake)', '2018-10-19', '01:46:00', 'O filme ? uma sequ?ncia direta do filme original de 1978 e ignora todos os outros filmes da franquia \"Halloween\". A hist?ria se passa 40 anos ap?s os eventos do filme original e mostra Laurie Strode (interpretada novamente por Jamie Lee Curtis) prepa', '18', 'halloween11.jfif', NULL, 5, 1, 2, 2),
(21, 'Halloween Kills: O Terror Continua', '2021-10-15', '01:45:00', 'O filme ? uma sequ?ncia direta de \"Halloween\" (remake) de 2018 e mostra a continua??o da hist?ria de Laurie Strode e sua fam?lia enquanto enfrentam novamente Michael Myers, que sobreviveu ao inc?ndio na casa de Laurie. A cidade de Haddonfield agora e', '18', 'kills.png', NULL, 5, 5, 2, 2),
(22, 'Halloween Ends', '2022-10-14', '01:51:00', 'O filme ? o terceiro e ?ltimo da trilogia iniciada com \"Halloween\" (2018) e seguida por \"Halloween Kills\" (2021). A trama acompanha Laurie Strode e sua fam?lia em um confronto final contra Michael Myers, que j? causou muitas mortes e destrui??o em Ha', '18', 'halloweenEnds.jpg', NULL, 5, 5, 2, 2),
(23, 'Um Lugar Silencioso', '2018-04-05', '01:30:00', 'Em um futuro p?s-apocal?ptico, a humanidade ? dizimada por criaturas misteriosas que s?o cegas mas t?m um senso agu?ado de audi??o. Uma fam?lia tenta sobreviver em meio ao sil?ncio absoluto, enquanto tenta evitar chamar a aten??o das criaturas.', '14', 'umlugarsilencioso.jpg', NULL, 5, 1, 2, 2),
(24, 'Um Lugar Silencioso - Parte II', '2021-05-28', '01:37:00', 'Na continua??o, a fam?lia Abbott continua a enfrentar as criaturas que ca?am pela audi??o, enquanto tenta sobreviver em um mundo p?s-apocal?ptico. O filme tamb?m explora a hist?ria de outros personagens, como um grupo de sobreviventes liderado por Em', '12', 'umlugarsilencioso2.jpg', NULL, 5, 1, 2, 2),
(26, 'Os Imperdo?veis', '1992-08-07', '02:11:00', 'O filme conta a hist?ria de William Munny (Clint Eastwood), um antigo pistoleiro que agora vive como fazendeiro vi?vo com seus filhos. Quando uma jovem prostituta ? brutalmente espancada por um dos clientes em um bordel, outras prostitutas decidem co', '14', 'imperdoaveis.jfif', NULL, 8, 1, 2, 2),
(27, 'Tr?s Homens em Conflito', '1966-12-23', '02:41:00', ' A hist?ria come?a com \"O Bom\" (Clint Eastwood), um pistoleiro solit?rio que est? em busca de uma fortuna em ouro. \"O Mau\" (Lee Van Cleef), outro pistoleiro experiente, est? atr?s da mesma fortuna e se alia a \"O Feio\" (Eli Wallach), um ladr?o mexican', '14', 'treshomens.jfif', NULL, 8, 1, 2, 2),
(28, 'Django Livre', '2012-12-25', '02:45:00', ' Se passa no sul dos Estados Unidos, dois anos antes da Guerra Civil Americana. Django (Jamie Foxx) ? um escravo liberto que se une a um ca?ador de recompensas alem?o chamado Dr. King Schultz (Christoph Waltz) para encontrar e libertar sua esposa, Br', '16', 'django.jpg', NULL, 3, 1, 2, 2),
(29, 'O Regresso', '2015-12-25', '02:36:00', ' Conta a hist?ria do explorador Hugh Glass (Leonardo DiCaprio), que ? atacado por um urso e deixado para morrer por sua equipe. Apesar dos ferimentos graves, Glass sobrevive e inicia uma jornada ?pica de vingan?a contra seus companheiros, liderados p', '16', 'oregresso.png', NULL, 8, 1, 2, 2),
(30, 'A Salva??o', '2014-05-17', '01:40:00', ' A trama se passa na Am?rica do Norte do final do s?culo XIX e segue a hist?ria de Jon (Mads Mikkelsen), um imigrante dinamarqu?s que vive em uma comunidade de fazendeiros em terras ?ridas. Quando sua esposa e filho s?o brutalmente assassinados, Jon ', '16', 'asalvacao.png', NULL, 8, 1, 2, 2),
(31, 'Terra Sem Lei', '2016-12-10', '01:40:00', ' A trama se passa no final do s?culo XIX em uma regi?o remota do oeste americano, onde uma jovem chamada Liz (Dakota Fanning) busca vingan?a contra um pastor fan?tico e seus seguidores, que acreditam em castigo divino e aterrorizam a comunidade local', '16', 'terra-sem-lei-poster.png', NULL, 8, 1, 2, 2),
(32, 'A marca da Forca', '1968-07-31', '01:56:00', ' O filme conta a hist?ria de um cowboy chamado Jed Cooper (Clint Eastwood), que ? injustamente acusado de roubo e assassinato e, em seguida, sentenciado ? forca. Ele consegue sobreviver e ? encontrado por um juiz que lhe oferece um cargo de xerife, d', '16', 'amarcadaforca.jpg', NULL, 8, 1, 2, 2),
(33, 'Onde os Fracos N?o T?m Vez', '2007-11-21', '02:02:00', 'A hist?ria se passa em 1980, no Texas. Llewelyn Moss (interpretado por Josh Brolin) encontra uma mala cheia de dinheiro ap?s um tiroteio que ocorreu nas proximidades e decide ficar com o dinheiro. Logo, ele ? perseguido por um assassino implac?vel, A', '16', 'ondeosfracosnaotemvez.jfif', NULL, 7, 1, 2, 2),
(34, 'Bravura Ind?mita', '2010-12-22', '01:50:00', ' A hist?ria se passa em 1870, no Velho Oeste americano. A adolescente Mattie Ross (interpretada por Hailee Steinfeld) contrata o xerife Rooster Cogburn (interpretado por Jeff Bridges), um homem dur?o e b?bado, para encontrar e capturar o homem que ma', '16', 'bravuraindomita.jpg', NULL, 8, 1, 2, 2),
(35, 'Era uma Vez no Oeste', '1968-12-21', '02:45:00', '  A hist?ria se passa no Velho Oeste americano e gira em torno de um conflito entre um bando de assassinos liderados por Frank (interpretado por Henry Fonda) e uma mulher misteriosa chamada Jill (interpretada por Claudia Cardinale), que herda terras ', '14', 'era-uma-vez-no-oeste-poster-1.jpg', NULL, 8, 1, 2, 2),
(36, 'Por um Punhado de D?lares', '1964-09-12', '01:39:00', '   O filme conta a hist?ria de Joe (Clint Eastwood), um pistoleiro que chega a uma cidade fronteiri?a dominada por duas gangues rivais. Joe decide usar a rivalidade entre as gangues para seu pr?prio benef?cio, mas acaba se envolvendo em uma trama per', '14', 'porumpunhadodedolares.jfif', NULL, 8, 1, 2, 2),
(37, 'Me Chame Pelo Seu Nome', '2017-11-24', '02:10:00', '   O filme se passa na It?lia no ver?o de 1983 e conta a hist?ria de Elio (Timoth?e Chalamet), um jovem de 17 anos que se apaixona por Oliver (Armie Hammer), um acad?mico americano de 24 anos que est? hospedado na casa de Elio como assistente de pesq', '14', 'mechamepelonome.jfif', '', 2, 1, 1, 2),
(38, 'As Pontes de Madison', '1995-06-02', '02:15:00', '  O filme ? baseado no romance hom?nimo de Robert James Waller e conta a hist?ria de Francesca Johnson (Meryl Streep), uma dona de casa do interior de Iowa que vive uma vida mon?tona com seu marido e filhos. Um dia, enquanto seu marido e filhos est?o', '12', 'pontedemadison.jpg', '', 2, 1, 1, 2),
(39, 'Di?rio de uma Paix?o', '2004-06-25', '02:01:00', '  O filme conta a hist?ria de Noah Calhoun (Ryan Gosling) e Allie Hamilton (Rachel McAdams), que se apaixonam no ver?o de 1940. Os dois s?o de mundos diferentes e a fam?lia de Allie n?o aprova o relacionamento, ent?o eles se separam. Anos depois, All', '14', 'diariodeumapaixao.jpg', '', 2, 1, 1, 2),
(40, 'Uma Linda Mulher', '1990-03-23', '01:59:00', ' O filme conta a hist?ria de Edward Lewis (Richard Gere), um rico empres?rio que est? em Los Angeles a neg?cios e acaba se perdendo na cidade. Ele conhece Vivian Ward (Julia Roberts), uma prostituta que lhe oferece ajuda para encontrar o caminho de v', '12', 'umalindamulher.webp', '', 2, 1, 1, 2),
(41, 'Orgulho e Preconceito', '2005-09-16', '02:07:00', '  O filme conta a hist?ria das irm?s Bennet, que vivem na Inglaterra rural no final do s?culo XVIII. Quando o rico e misterioso Mr. Bingley aluga uma propriedade pr?xima, as irm?s se preparam para o baile que ser? realizado em sua honra. ? l? que Eli', '12', 'orgulho-e-preconceito-19.jpg', '', 2, 1, 1, 2),
(42, '10 Coisas que Eu Odeio em Voce', '1999-03-31', '01:37:00', '  Cameron James, um estudante novo na escola secund?ria Padua, se apaixona por Bianca Stratford. No entanto, o pai super protetor de Bianca estabeleceu uma regra que ela n?o pode namorar a menos que sua irm? mais velha, a durona Kat, tamb?m esteja na', '10', '10-coisas-que-eu-odeio-em-voce.png', '', 2, 1, 1, 2),
(43, 'Como Se Fosse a Primeira Vez', '2004-02-13', '01:39:00', '  Henry Roth ? um veterin?rio marinho que vive no Hava? e se apaixona por Lucy Whitmore, uma mulher que sofre de perda de mem?ria de curto prazo e acorda todas as manh?s sem se lembrar do dia anterior. Henry tem que conquist?-la todos os dias e faz?-', '10', 'comosefosseaprimeriavez.jpg', '', 2, 1, 1, 2),
(44, 'Os Segredos de Brokeback Mountain', '2005-12-02', '02:14:00', '  Ennis Del Mar e Jack Twist s?o contratados para trabalhar como pastores em Brokeback Mountain. Durante o isolamento e a solid?o do trabalho, eles se aproximam e se apaixonam, iniciando um relacionamento secreto que dura anos. Ap?s um longo per?odo ', '14', 'O-Segredo-de-Brokeback-Mountain.webp', '', 2, 1, 1, 2),
(45, 'Alerta Maximo\r\n', '2023-01-23', '01:47:00', 'O piloto Brodie Torrance salva seus passageiros de um raio pousando em uma ilha. Os moradores rebeldes e perigosos do local fazem a tripulacao refem e Torrance procura ajuda de um passageiro acusado de assassinato.', '14', 'alertamaximo.jfif', '', 3, 1, 1, 2),
(46, 'Invas?o ao Servi?o Secreto\r\n', '2019-11-14', '02:01:00', 'Dedicado e sempre focado em seu trabalho, o agente do Servi?o Secreto Mike Banning v? sua vida mudar completamente da noite para o dia ao ser acusado de conspirar para o assassinato do presidente dos Estados Unidos. Quando percebe que todos est?o atr', '14', 'invasaoaoservicosecreto.jpg', '', 3, 1, 1, 2),
(47, 'A Cinco Passos de Voc?', '2019-03-21', '01:57:00', 'Stella passa muito tempo no hospital por causa de uma fibrose c?stica. L?, ela conhece Will, que sofre da mesma doen?a. Eles s?o obrigados a manter dist?ncia, mas mesmo assim se apaixonam.\r\n', '12', 'acincopassosdevoce.webp', '', 2, 1, 1, 2),
(48, 'Como Eu Era Antes de Voc?', '2016-06-16', '01:46:00', 'De origem modesta e sem grandes aspira??es, a peculiar Louisa Clark ? contratada para ser cuidadora de Will, um jovem tetrapl?gico depressivo e c?nico.\r\n', '12', 'comoeueraantesdevoce.jfif', '', 2, 1, 1, 2),
(49, 'Ghosted: Sem Resposta', '2023-04-21', '01:56:00', 'Traduzido do ingl?s-Ghosted ? um filme americano de com?dia rom?ntica de a??o e aventura de 2023, dirigido por Dexter Fletcher e escrito por Rhett Reese, Paul Wernick, Chris McKenna e Erik Sommers, a partir de uma hist?ria de Reese e Wernick. O filme', '12', 'ghosted-sem-resposta-poster.jpg', NULL, 3, 3, 2, 2),
(50, 'Ghost - Do Outro Lado da Vida', '1990-11-01', '02:02:00', 'Sam Wheat ? um jovem executivo apaixonado por sua namorada, Molly. Ele acaba morto em um assalto, mas seu esp?rito n?o vai para o outro plano e descobre que Molly tamb?m corre perigo. Para salv?-la, Sam pede ajuda a uma m?dium que consegue ouvi-lo.\r\n', '14', 'ghost.jfif', '', 2, 3, 1, 2),
(51, 'Atrav?s da Minha Janela', '2022-02-04', '01:52:00', 'Raquel ? apaixonada pelo seu vizinho, Ares, um rapaz frio que vive em um mundo completamente diferente do seu. Por?m, o acaso acaba unindo os dois, que se veem envolvidos em uma trama de desejo e amor.\r\n', '16', 'atravesdaminhajanela.jfif', '', 2, 3, 1, 2),
(52, 'Vizinhan?a do Barulho', '1996-01-12', '01:34:00', 'Ashtray retorna ? sua cidade natal e se reencontra com seu pai e os amigos com quem costumava jogar basquete. No entanto, a par?dia dos filmes afro-americanos rapidamente se desenrola, trazendo ? tona eventos estranhos e absurdos.', '16', 'vizinhancadobarulho.jpg', '', 6, 1, 1, 2),
(53, 'As Branquelas\r\n', '2004-08-27', '01:49:00', 'Marcus e Kevin Copeland, irm?os e agentes do FBI, acabam inadvertidamente prejudicando uma opera??o de pris?o de criminosos envolvidos com drogas. Em consequ?ncia, s?o obrigados a escoltar duas socialites para os Hamptons. No entanto, quando as garot', '12', 'asbranquelas.jpg', '', 6, 1, 1, 2),
(54, 'Norbit - Uma Comedia de Peso', '2007-02-09', '01:43:00', 'Norbit ? um homem solit?rio que cresceu em um orfanato e se casou com a terr?vel Rasputia, uma mulher rude e agressiva que o trata mal e o impede de realizar seus sonhos. Quando Norbit reencontra sua paix?o de inf?ncia, Kate, ele come?a a ter esperan', '12', 'norbit.jpg', '', 6, 1, 1, 2),
(55, 'O Pequenino', '2006-07-14', '01:38:00', 'Calvin, um an?o que acabou de sair da pris?o, planeja um novo assalto a uma joalheria e acaba sendo perseguido pela pol?cia. Em sua fuga, esconde um valioso diamante na bolsa de Vanessa, cujo marido, Darryl, est? desesperado para ter um filho. Para r', '12', 'opequenino.jpg', '', 6, 1, 1, 2),
(56, 'Projeto X - Uma Festa Fora de Controle', '2012-03-16', '01:28:00', 'Projeto X ? um filme de com?dia e drama que segue tr?s amigos do ensino m?dio que decidem realizar a festa mais ?pica da hist?ria, na tentativa de se tornarem populares e impressionar suas paix?es. A festa come?a pequena, mas rapidamente sai do contr', '18', 'projetox.jpg', '', 6, 1, 1, 2),
(57, 'American Pie — A Primeira Vez e Inesquecivel\r\n', '1999-10-29', '01:35:00', 'Jim Levenstein, Kevin Myers, Oz Ostreicher e Paul Finch s?o quatro amigos que est?o prestes a se formar no ensino m?dio e ainda s?o virgens. Enquanto tentam de todas as formas poss?veis ter rela??es sexuais com suas namoradas, procuram por mulheres n', '14', 'americanpie.jpg', '', 6, 1, 1, 2),
(58, 'American Pie 2 - A Segunda Vez e Ainda Melhor\r\n', '2001-12-21', '01:50:00', 'Depois de um ano separados - frequentando escolas diferentes e conhecendo pessoas diferentes - os rapazes alugam uma casa de praia e prometem que ser? o melhor ver?o de todos os tempos. Mas, para que isso aconte?a, vai depender das garotas. Entre fes', '14', 'americanpie2.jpg', '', 6, 1, 1, 2),
(59, 'Superbad - e Hoje', '2007-10-19', '01:59:00', 'Superbad ? uma com?dia americana que acompanha a hist?ria de dois amigos insepar?veis, Seth e Evan, que est?o prestes a se formar no ensino m?dio e se preparam para seguir caminhos diferentes na faculdade. Antes disso, eles decidem se divertir em uma', '14', 'superbad.jpg', '', 6, 1, 1, 2),
(60, 'Sexta-Feira em Apuros', '1995-07-14', '01:37:00', '? uma com?dia americana de 1995, dirigida por F. Gary Gray. A hist?ria segue o personagem principal Craig Jones, um jovem de vinte e poucos anos que est? desempregado e passando o dia de folga com seu amigo Smokey em um bairro de Los Angeles. Quando ', '16', 'sextafeira.jpg', '', 6, 1, 1, 2),
(61, 'EuroTrip - Passaporte para a Confusao', '2004-02-20', '01:33:00', 'Eurotrip ? uma com?dia adolescente que conta a hist?ria de Scott Thomas, um jovem americano que, depois de se formar no ensino m?dio, ? dispensado pela namorada e decide viajar para a Europa com os amigos para esquecer os problemas. Juntos, eles emba', '16', 'eurotrip.jpg', '', 6, 1, 1, 2),
(62, 'Se Beber, Nao Case!\r\n', '2009-08-21', '01:40:00', '\"Se Beber, N?o Case\" ? uma com?dia americana que segue a hist?ria de quatro amigos que viajam para Las Vegas para celebrar a despedida de solteiro de um deles. Eles acordam na manh? seguinte sem mem?ria da noite anterior e descobrem que o noivo est? ', '14', 'sebebernaocase.jpg', '', 6, 1, 1, 2),
(63, 'Se Beber, Nao Case! Parte II', '2011-05-27', '01:42:00', 'Na sequ?ncia de \"Se Beber, N?o Case\", Phil, Stu, Alan e Doug viajam para a Tail?ndia para celebrar o casamento de Stu. No entanto, depois de uma noite de festa, eles acordam em um quarto de hotel sem lembrar do que aconteceu. Para piorar a situa??o, ', '16', 'sebebernaocase2_3.jpg', '', 6, 1, 1, 2),
(64, 'Um Dia de C?o', '1975-09-21', '02:04:00', 'Este filme retrata o assalto a um banco em Nova York. Sonny Wortzik planeja o assalto desesperado para financiar a cirurgia de mudan?a de sexo de seu parceiro. No entanto, o assalto n?o sai como planejado e se transforma em um impasse tenso com ref?m', '14', 'umdiadecao.jfif', NULL, 7, 2, 2, 2),
(65, 'Menina de Ouro', '2004-12-15', '02:13:00', 'A hist?ria gira em torno de Frankie Dunn (interpretado por Clint Eastwood), um treinador de boxe amargurado que administra sua academia com a ajuda de seu amigo Eddie \"Scrap-Iron\" Dupris (interpretado por Morgan Freeman). Maggie Fitzgerald (interpret', '12', 'meninadeouro.jfif', NULL, 7, 2, 2, 2),
(66, 'John Wick – De Volta ao Jogo', '2014-11-27', '01:41:00', 'Um ex-assassino profissional que ? arrastado de volta ao mundo do crime ap?s a morte de sua esposa e o roubo de seu carro e a morte de seu filhote de cachorro. Determinado a se vingar, John Wick embarca em uma miss?o de vingan?a contra uma fam?lia cr', '16', 'devoltaaojogo.jfif', NULL, 3, 2, 2, 2),
(67, 'John Wick: Um Novo Dia Para Matar', '2017-06-02', '02:02:00', 'John Wick (interpretado por Keanu Reeves) ? for?ado a retornar ao mundo do crime ap?s um acordo de sangue ter sido quebrado. Ele ? convocado por um antigo associado para cumprir uma miss?o que o leva a Roma. Enquanto cumpre sua tarefa, John se v? env', '16', 'johnwick2.jfif', NULL, 3, 2, 2, 2),
(68, 'John Wick 3: Parabellum', '2019-05-16', '02:11:00', 'A hist?ria continua logo ap?s os eventos do filme anterior. John Wick (interpretado por Keanu Reeves) agora est? em fuga, sendo considerado excomungado da organiza??o assassina a qual ele fazia parte. Com um contrato de alto valor em sua cabe?a, Wick', '16', 'JOHNWICK3.jfif', NULL, 3, 2, 2, 2),
(69, 'John Wick 4: Baba Yaga', '2023-03-23', '01:48:00', ' o lend?rio assassino de aluguel John Wick enfrenta um desafio ainda maior. Com um alto valor em sua cabe?a, Wick leva sua luta contra a influente organiza??o conhecida como High Table para um n?vel global. Determinado a se vingar e acabar com os jog', '16', 'johnwick4.jfif', NULL, 3, 2, 2, 2),
(70, 'Deadpool', '2016-11-02', '01:48:00', 'Wade Wilson, um ex-mercen?rio com c?ncer em est?gio avan?ado, se submete a um experimento que o deixa com poderes de cura, mas tamb?m o desfigura. Agora conhecido como Deadpool, ele busca vingan?a contra o respons?vel por sua transforma??o, enquanto ', '16', 'deadpool.jpg', NULL, 3, 5, 2, 2),
(71, 'Uma Sa?da de Mestre', '2003-10-03', '01:51:00', 'm grupo de ladr?es habilidosos liderados por Charlie Croker (interpretado por Mark Wahlberg) planeja um roubo ?pico em Veneza. Ap?s um assalto bem-sucedido, eles s?o tra?dos por um dos membros do grupo, Steve (interpretado por Edward Norton), que fog', '12', 'umasaidademestre.jfif', NULL, 3, 5, 2, 2),
(72, 'Vingadores: Ultimato', '2019-04-25', '03:02:00', 'Os her?is remanescentes se unem em uma miss?o ousada para desfazer os danos causados por Thanos. Eles viajam no tempo para recuperar as Joias do Infinito e tentar reverter o estalar de dedos que dizimou metade da popula??o do universo. O filme ? uma ', '12', 'vingadores.jfif', NULL, 4, 6, 2, 2),
(73, 'Blade Runner', '1982-06-25', '01:57:00', 'No futuro dist?pico de Los Angeles em 2019, os seres humanos criaram replicantes, androides id?nticos aos humanos em apar?ncia, mas projetados para trabalhar em col?nias extraterrestres perigosas. Quando um grupo de replicantes rebeldes retorna ? Ter', '18', 'bladerunner1.jpg', NULL, 4, 7, 2, 2),
(74, 'Blade Runner 2049', '2017-10-05', '02:43:00', 'Um novo policial chamado K descobre um segredo que tem o potencial de abalar a sociedade. Determinado a desvendar a verdade, ele embarca em uma miss?o para encontrar Rick Deckard, um ex-Blade Runner que est? desaparecido h? tr?s d?cadas. Enquanto enf', '14', 'bladerunner2.jpg', NULL, 4, 5, 2, 2),
(75, 'Interestelar', '2014-11-06', '02:49:00', 'as reservas naturais da Terra est?o se esgotando e um grupo de astronautas ? enviado em uma miss?o crucial: encontrar um novo planeta habit?vel para a continuidade da esp?cie humana. Cooper ? escolhido para liderar a equipe, mesmo sabendo que essa jo', '10', 'interestelar.jpg', NULL, 4, 2, 2, 2),
(76, 'A Casa Monstro', '2006-11-03', '01:31:00', 'A hist?ria acompanha tr?s crian?as, DJ, Chowder e Jenny, que descobrem que a casa do misterioso Nebbercracker, um velho rabugento da vizinhan?a, ? na verdade uma criatura viva e assustadora. Enquanto tentam desvendar o segredo por tr?s da casa, eles ', '10', 'acasamonstro.jpg', NULL, 1, 1, 2, 2),
(77, 'Monstros S.A.', '2001-11-02', '01:32:00', 'A trama gira em torno de dois monstros, Sulley e seu assistente Mike, que trabalham na Monstros S.A., a maior f?brica de sustos do mundo dos monstros. A energia deles ? obtida atrav?s dos sustos das crian?as humanas.', '10', 'monstrossa.webp', NULL, 1, 4, 2, 2),
(78, 'Shrek', '2001-05-18', '01:29:00', ' conta a hist?ria de um ogro verde chamado Shrek, que vive em um p?ntano isolado e tranquilo. Sua vida solit?ria ? interrompida quando o maligno Lorde Farquaad exila uma s?rie de personagens de contos de fadas em seu p?ntano.', '10', 'shrek1.jpg', NULL, 1, 4, 2, 2),
(79, 'Shrek 2', '2004-05-19', '01:33:00', 'No filme, Shrek e Fiona s?o convidados pelo rei Harold e pela rainha Lillian para visitar o reino de T?o T?o Distante e conhecer seus sogros.', '10', 'shrek2.jpg', NULL, 1, 4, 2, 2),
(80, 'Shrek Terceiro', '2007-05-18', '01:33:00', 'Segue as aventuras do ogro verde e seus amigos em uma nova jornada. No filme, Shrek enfrenta um desafio inesperado quando o Rei Harold, pai de Fiona, falece, deixando vago o trono de T?o T?o Distante.', '10', 'shrek3.jpg', NULL, 1, 4, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `nome_item` varchar(50) NOT NULL,
  `descricao_item` varchar(800) NOT NULL,
  `preco_item` decimal(13,2) NOT NULL DEFAULT 0.00,
  `imagem_item` varchar(50) NOT NULL,
  `qtd_item` varchar(2) NOT NULL DEFAULT '1',
  `fk_id_categoria_item` int(11) NOT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `fk_id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`id_item`, `nome_item`, `descricao_item`, `preco_item`, `imagem_item`, `qtd_item`, `fk_id_categoria_item`, `fk_id_usuario`, `fk_id_perfil`) VALUES
(1, 'Action Figure - Rambo ', 'Este action figure do Rambo é uma representação impressionante do icônico personagem de ação. Com 15 centímetros de altura, ele possui um visual realista, calças pretas e botas robustas. O rosto esculpido exibe uma expressão determinada, com cabelo curto castanho escuro. Com várias articulações, o action figure pode ser colocado em diferentes poses. Vem com um arsenal de armas realistas. É o item perfeito para os fãs de ação e colecionadores, recriando cenas emocionantes do personagem.', '199.99', 'rambo.webp', '1', 2, 4, 3),
(2, 'Action FIgure - Monkey D. Luffy', 'Este boneco do Luffy é uma representação impressionante do protagonista de \"One Piece\". Com 18 centímetros de altura. O rosto esculpido transmite a felicidade característica do personagem, com detalhes como o cabelo de borracha e o  traje de samurai autêntico. Com articulações flexíveis, permite poses dinâmicas e vem com acessórios como o chapéu de palha removível. É um item essencial para fãs e colecionadores, capturando a personalidade e aventuras do carismático Luffy.', '499.99', 'luffao.jpg', '2', 2, 4, 3),
(3, 'Action Figure - Jason Voorhees', 'Este boneco é ideal para brincar seguindo suas histórias ou colecionar.Seu tamanho é de 20 cm. Com suas articulações, você pode ajustar as poses e criar histórias emocionantes com os personagens ganhando vida. É perfeito para colecionadores que desejam expandir e diversificar sua coleção.', '299.99', 'jason.webp', '4', 2, 4, 3),
(4, 'Livro - Pôsters ', 'O livro \"Posters\" é o quinto da série Star Wars Art, curada por George Lucas. Ele reúne os melhores pôsteres de todos os seis filmes de Star Wars, da série animada The Clone Wars e de edições limitadas. Esta coleção é uma homenagem à arte dos pôsteres de Star Wars, apresentando a ação, a arte e o drama da saga em um volume magnificamente produzido.', '320.00', 'livrostarwars.jpg', '10', 1, 4, 3),
(5, 'Revista - Aranhaverso: Aranha Zero  ', ' Miles Morales é transportado através de um portal dimensional para uma nova e perigosa aventura no multiverso! No entanto, acredita-se que a Teia da Vida e do Destino havia sido destruída. Agora surge a pergunta: quem teceu a nova Teia e por quê? O Aranhaverso está em grave perigo, e é chegada a hora de uma nova reunião. Miles e seus amigos enfrentarão o desafio de consertar a Teia e restaurar o equilíbrio no multiverso. Prepare-se para testemunhar o retorno do Homem-Aranha Noir, que retorna do além-túmulo! Além disso, surge o enigma do Aranha-Zero.', '29.99', 'hqmiranha.jpg', '20', 1, 4, 3),
(6, 'Pôster - Vingadores: Guerra Infinita  ', 'A Marvel Studios revolucionou a cultura pop ao criar a épica Saga do Infinito, um arco de histórias lendário que marcou uma geração de fãs. Agora, em uma edição especial, apresentamos os 23 filmes que compõem esse universo cinematográfico, cada um com seu próprio pôster gigante estilo \"enciclopédia\". Esses pôsteres oficiais do MCU, em formato 50x70cm, são perfeitos para colecionadores e fãs de super-heróis, permitindo que eles leiam, guardem e decorem suas paredes com essas obras de arte icônicas.', '29.99', 'guerrainfinita.webp', '20', 3, 4, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_contem_compra`
--

DROP TABLE IF EXISTS `item_contem_compra`;
CREATE TABLE `item_contem_compra` (
  `fk_id_item` int(11) NOT NULL,
  `fk_id_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `perfil_usu` varchar(45) NOT NULL COMMENT 'Administrador, Moderador, Colecionador, Usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `perfil_usu`) VALUES
(1, 'Administrador'),
(2, 'Moderador'),
(3, 'Colecionador'),
(4, 'Usuario');

-- --------------------------------------------------------

--
-- Estrutura da tabela `resenha`
--

DROP TABLE IF EXISTS `resenha`;
CREATE TABLE `resenha` (
  `id_resenha` int(11) NOT NULL,
  `avaliacao_res` varchar(50) DEFAULT NULL,
  `titulo_res` varchar(45) DEFAULT NULL,
  `descricao_res` varchar(800) DEFAULT NULL,
  `dt_hora_res` timestamp NULL DEFAULT NULL,
  `denuncia_res` varchar(50) DEFAULT NULL,
  `situacao_res` varchar(50) DEFAULT 'Ativo' COMMENT 'Ativo, Inativo ou Bloqueado\n',
  `fk_id_usuario` int(11) NOT NULL,
  `fk_id_perfil` int(11) NOT NULL,
  `fk_id_filme` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `resenha`
--

INSERT INTO `resenha` (`id_resenha`, `avaliacao_res`, `titulo_res`, `descricao_res`, `dt_hora_res`, `denuncia_res`, `situacao_res`, `fk_id_usuario`, `fk_id_perfil`, `fk_id_filme`) VALUES
(1, NULL, 'comédia romântica', 'Acho que me pareço com a Kat que é uma jovem inteligente e independente que odeia o colégio e tem uma personalidade forte. Muito eu!', '2011-05-27 04:42:00', NULL, 'Ativo', 3, 1, 42),
(2, NULL, 'comédia romântica', 'E eu pareço com a  Bianca!', '2011-05-27 04:42:00', NULL, 'Ativo', 4, 1, 42);

-- --------------------------------------------------------

--
-- Estrutura da tabela `transacao`
--

DROP TABLE IF EXISTS `transacao`;
CREATE TABLE `transacao` (
  `id_transacao` int(11) NOT NULL,
  `tipo_trans` enum('compra','venda') NOT NULL COMMENT 'Compra, Venda',
  `dt_hora_trans` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_trans` varchar(50) NOT NULL DEFAULT 'Em Progresso' COMMENT 'Pendente, Concluída, Cancelada,Em Progresso',
  `valor_total` decimal(13,2) NOT NULL,
  `tipo_pagamento_trans` varchar(45) DEFAULT 'PIX' COMMENT 'PIX\\nCartão de Crédio\\nCartão de Débito\\nMercado Pago',
  `qtd_trans` varchar(2) NOT NULL DEFAULT '1',
  `fk_id_compra` int(11) NOT NULL,
  `fk_id_carrinho` int(11) NOT NULL,
  `fk_id_item` int(11) NOT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `fk_id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome_usu` varchar(100) NOT NULL,
  `nickname_usu` varchar(100) DEFAULT NULL,
  `dt_de_nasci_usu` date DEFAULT NULL,
  `genero_usu` enum('masculino','feminino','naoBinario','naoDeclarar') NOT NULL COMMENT 'Masculino, Feminino, Não Binário, Não Declarar',
  `email_usu` varchar(100) NOT NULL,
  `senha_usu` varchar(60) NOT NULL,
  `situacao_usu` varchar(50) DEFAULT 'Ativo' COMMENT 'Ativo, Inativo ou Bloqueado\\n',
  `foto_usu` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cpf_cnpj` varchar(14) DEFAULT NULL,
  `endereco` varchar(70) DEFAULT NULL,
  `numero` char(7) DEFAULT NULL,
  `complemento` varchar(15) DEFAULT NULL,
  `bairro` varchar(70) DEFAULT NULL,
  `cidade` varchar(70) DEFAULT NULL,
  `cep` varchar(15) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `fk_id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome_usu`, `nickname_usu`, `dt_de_nasci_usu`, `genero_usu`, `email_usu`, `senha_usu`, `situacao_usu`, `foto_usu`, `telefone`, `cpf_cnpj`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `cep`, `uf`, `fk_id_perfil`) VALUES
(1, 'Rafaela Medeiros da Silva', NULL, '1987-06-05', 'naoBinario', 'adm@email.com', 'e10adc3949ba59abbe56e057f20f883e', 'Ativo', 'pic-2.png', '(61)77777-6565', '000.000.888-99', 'QNM 11', '11', 'Casa', 'CEILANDIA NORTE', 'BRASILIA', '72211-111', 'DF', 1),
(2, 'Maya', 'Mayalice', '2000-12-08', 'feminino', 'maya@email.com', '202cb962ac59075b964b07152d234b70', 'Ativo', 'img-5.jpg', '6198887-0909', '333.444.777-77', 'QSC 01 AREA ESP ', '444', 'Ap', 'CEILANDIA NORTE', 'BRASILIA', '72-999-02', 'MG', 2),
(3, 'Fatima', 'Fafa', '1999-05-12', 'feminino', 'fafa@gmail.com', 'b2b95d2ed89b9e922775bea179801c95', 'Ativo', 'pic-4.png', '6199641-1008', '079.321.888-30', 'QSC 09', '563', 'Ap', 'TAGUATINGA NORTE', 'SALVADOR', '72-923-800', 'BH', 4),
(4, 'Gabriela', 'GabGabi', '2004-07-25', 'feminino', 'gabgabi@outlook.com', '52b341f3c35a14e33b91e28b334a1db0', 'Ativo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `canal_filme`
--
ALTER TABLE `canal_filme`
  ADD PRIMARY KEY (`id_canal_filme`);

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id_carrinho`,`fk_id_item`,`fk_id_usuario`,`fk_id_perfil`),
  ADD KEY `fk_carrinho_item1_idx` (`fk_id_item`),
  ADD KEY `fk_carrinho_usuario1_idx` (`fk_id_usuario`),
  ADD KEY `fk_carrinho_peril1_idx` (`fk_id_perfil`);

--
-- Índices para tabela `categoria_filme`
--
ALTER TABLE `categoria_filme`
  ADD PRIMARY KEY (`id_categoria_filme`);

--
-- Índices para tabela `categoria_item`
--
ALTER TABLE `categoria_item`
  ADD PRIMARY KEY (`id_categoria_item`);

--
-- Índices para tabela `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`,`fk_id_carrinho`,`fk_id_item`,`fk_id_usuario`,`fk_id_perfil`),
  ADD KEY `fk_compra_carrinho1_idx` (`fk_id_carrinho`),
  ADD KEY `fk_compra_item1_idx` (`fk_id_item`),
  ADD KEY `fk_compra_usuario1_idx` (`fk_id_usuario`),
  ADD KEY `fk_compra_peril1_idx` (`fk_id_perfil`);

--
-- Índices para tabela `favorito`
--
ALTER TABLE `favorito`
  ADD PRIMARY KEY (`id_favorito`,`fk_id_filme`,`fk_id_usuario`,`fk_id_perfil`),
  ADD KEY `fk_favorito_favorito1_idx` (`id_favorito`),
  ADD KEY `fk_favorito_filme1_idx` (`fk_id_filme`),
  ADD KEY `fk_favorito_usuario1_idx` (`fk_id_usuario`),
  ADD KEY `fk_favorito_perfil1_idx` (`fk_id_perfil`);

--
-- Índices para tabela `filme`
--
ALTER TABLE `filme`
  ADD PRIMARY KEY (`id_filme`,`fk_id_categoria_filme`,`fk_id_canal_filme`,`fk_id_usuario`,`fk_id_perfil`),
  ADD KEY `fk_filme_categoria_filme1_idx` (`fk_id_categoria_filme`),
  ADD KEY `fk_filme_canal_filme1_idx` (`fk_id_canal_filme`),
  ADD KEY `fk_filme_usuario1_idx` (`fk_id_usuario`),
  ADD KEY `fk_filme_perfil1_idx` (`fk_id_perfil`);

--
-- Índices para tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`,`fk_id_categoria_item`,`fk_id_usuario`,`fk_id_perfil`),
  ADD KEY `fk_item_categoria_item1_idx` (`fk_id_categoria_item`),
  ADD KEY `fk_item_usuario1_idx` (`fk_id_usuario`),
  ADD KEY `fk_item_perfil1_idx` (`fk_id_perfil`);

--
-- Índices para tabela `item_contem_compra`
--
ALTER TABLE `item_contem_compra`
  ADD PRIMARY KEY (`fk_id_item`,`fk_id_compra`),
  ADD KEY `fk_item_has_compra_compra1_idx` (`fk_id_compra`),
  ADD KEY `fk_item_has_compra_item1_idx` (`fk_id_item`);

--
-- Índices para tabela `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Índices para tabela `resenha`
--
ALTER TABLE `resenha`
  ADD PRIMARY KEY (`id_resenha`,`fk_id_usuario`,`fk_id_perfil`,`fk_id_filme`),
  ADD KEY `fk_resenha_usuario1_idx` (`fk_id_usuario`),
  ADD KEY `fk_resenha_filme1_idx` (`fk_id_filme`),
  ADD KEY `fk_resenha_perfil1_idx` (`fk_id_perfil`);

--
-- Índices para tabela `transacao`
--
ALTER TABLE `transacao`
  ADD PRIMARY KEY (`id_transacao`,`fk_id_compra`,`fk_id_item`,`fk_id_usuario`,`fk_id_perfil`),
  ADD KEY `fk_transacao_compra1_idx` (`fk_id_compra`),
  ADD KEY `fk_transacao_item1_idx` (`fk_id_item`),
  ADD KEY `fk_transacao_usuario1_idx` (`fk_id_usuario`),
  ADD KEY `fk_transacao_peril1_idx` (`fk_id_perfil`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`,`fk_id_perfil`),
  ADD KEY `fk_usuario_perfil_usu1_idx` (`fk_id_perfil`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `canal_filme`
--
ALTER TABLE `canal_filme`
  MODIFY `id_canal_filme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id_carrinho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categoria_filme`
--
ALTER TABLE `categoria_filme`
  MODIFY `id_categoria_filme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `categoria_item`
--
ALTER TABLE `categoria_item`
  MODIFY `id_categoria_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `favorito`
--
ALTER TABLE `favorito`
  MODIFY `id_favorito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `filme`
--
ALTER TABLE `filme`
  MODIFY `id_filme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de tabela `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `resenha`
--
ALTER TABLE `resenha`
  MODIFY `id_resenha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `transacao`
--
ALTER TABLE `transacao`
  MODIFY `id_transacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `fk_carrinho_item1` FOREIGN KEY (`fk_id_item`) REFERENCES `item` (`id_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_carrinho_perfil1` FOREIGN KEY (`fk_id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_carrinho_usuario1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_compra_carrinho1` FOREIGN KEY (`fk_id_carrinho`) REFERENCES `carrinho` (`id_carrinho`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compra_item1` FOREIGN KEY (`fk_id_item`) REFERENCES `item` (`id_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compra_perfil1` FOREIGN KEY (`fk_id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compra_usuario1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `fk_favorito_filme1` FOREIGN KEY (`fk_id_filme`) REFERENCES `filme` (`id_filme`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_favorito_perfil1` FOREIGN KEY (`fk_id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_favorito_usuario1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `filme`
--
ALTER TABLE `filme`
  ADD CONSTRAINT `fk_filme_canal_filme1` FOREIGN KEY (`fk_id_canal_filme`) REFERENCES `canal_filme` (`id_canal_filme`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_filme_categoria_filme1` FOREIGN KEY (`fk_id_categoria_filme`) REFERENCES `categoria_filme` (`id_categoria_filme`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_filme_perfil1` FOREIGN KEY (`fk_id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_filme_usuario1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_item_categoria_item1` FOREIGN KEY (`fk_id_categoria_item`) REFERENCES `categoria_item` (`id_categoria_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_perfil1` FOREIGN KEY (`fk_id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_usuario1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `item_contem_compra`
--
ALTER TABLE `item_contem_compra`
  ADD CONSTRAINT `fk_item_has_compra_compra1` FOREIGN KEY (`fk_id_compra`) REFERENCES `compra` (`id_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_has_compra_item1` FOREIGN KEY (`fk_id_item`) REFERENCES `item` (`id_item`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `resenha`
--
ALTER TABLE `resenha`
  ADD CONSTRAINT `fk_resenha_filme1` FOREIGN KEY (`fk_id_filme`) REFERENCES `filme` (`id_filme`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_resenha_perfil1` FOREIGN KEY (`fk_id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_resenha_usuario1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `transacao`
--
ALTER TABLE `transacao`
  ADD CONSTRAINT `fk_transacao_compra1` FOREIGN KEY (`fk_id_compra`) REFERENCES `compra` (`id_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transacao_item1` FOREIGN KEY (`fk_id_item`) REFERENCES `item` (`id_item`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transacao_perfil1` FOREIGN KEY (`fk_id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transacao_usuario1` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_perfil_usu1` FOREIGN KEY (`fk_id_perfil`) REFERENCES `perfil` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
