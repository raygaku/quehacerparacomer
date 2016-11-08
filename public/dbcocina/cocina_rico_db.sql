-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 08, 2016 at 08:23 
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cocina_rico_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesos`
--

CREATE TABLE `accesos` (
  `id` bigint(80) NOT NULL,
  `ruta` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `login` int(11) NOT NULL,
  `funcion` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `accesos`
--

INSERT INTO `accesos` (`id`, `ruta`, `nombre`, `login`, `funcion`) VALUES
(1, 'Login', 'Iniciar Sesión', 0, 'login'),
(2, 'Register', 'Registrarse', 0, 'register'),
(3, '/misRecetas=', 'Mis Recetas', 1, 'misRecetas'),
(4, '/logout', 'Cerrar Sesión', 1, 'cerrarSesion');

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(50) NOT NULL,
  `valor` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_categoria` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `valor`, `nombre_categoria`, `status`) VALUES
(1, 'Reposteria', 'Reposteria', 1),
(2, 'plato_fuerte', 'Plato Fuerte', 1),
(3, 'antojitos', 'Antojitos', 0),
(4, 'reposteria', 'Repostería', 0),
(5, 'gelatinas', 'Gelatinas', 1),
(6, 'Comida Saludable', 'Comida Saludable', 0),
(7, 'Empanadas', 'Empanadas', 1),
(9, 'Cremas y Sopas', 'Cremas y Sopas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pins`
--

CREATE TABLE `pins` (
  `id` bigint(30) NOT NULL,
  `userid` bigint(30) NOT NULL,
  `recetaid` bigint(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `pins`
--

INSERT INTO `pins` (`id`, `userid`, `recetaid`) VALUES
(5, 5, 16),
(6, 4, 16),
(7, 4, 17),
(8, 6, 16),
(9, 4, 18),
(10, 4, 25),
(11, 4, 21),
(12, 8, 34),
(13, 8, 32),
(14, 8, 33);

-- --------------------------------------------------------

--
-- Table structure for table `portada-receta`
--

CREATE TABLE `portada-receta` (
  `id` bigint(20) NOT NULL,
  `ruta` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(1000) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `portada-receta`
--

INSERT INTO `portada-receta` (`id`, `ruta`, `clave`) VALUES
(25, 'files/1475988225jarochas.jpg', '1475988225jarochas'),
(26, 'files/1475989580empanadascajeta.jpg', '1475989580empanadascajeta'),
(27, 'files/1475990517gelatina-nuez.png', '1475990517gelatina-nuez'),
(28, 'files/1475991143gelatina-yogur.jpg', '1475991143gelatina-yogur'),
(29, 'files/1475992388gelatinamango.JPG', '1475992388gelatinamango'),
(30, 'files/1475994236bocadillosnuez.jpg', '1475994236bocadillosnuez'),
(31, 'files/1475995392filetecampirano.png', '1475995392filetecampirano'),
(32, 'files/1476505772cremazanahorias.jpg', '1476505772cremazanahorias'),
(33, 'files/1476506189pescadogabardina.jpg', '1476506189pescadogabardina'),
(34, 'files/1476506846alvapor.jpg', '1476506846alvapor'),
(35, 'files/1476507526ennogada.jpg', '1476507526ennogada'),
(36, 'files/1476508299asadoderex.jpg', '1476508299asadoderex'),
(37, 'files/1477024814platanos.jpg', '1477024814platanos'),
(38, 'files/1477025072ArrozCubano-1.jpg', '1477025072ArrozCubano-1');

-- --------------------------------------------------------

--
-- Table structure for table `recetas`
--

CREATE TABLE `recetas` (
  `id` bigint(50) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `texto` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_subida` date DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `corazones` int(10) DEFAULT NULL,
  `portada` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoria` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `recetas`
--

INSERT INTO `recetas` (`id`, `titulo`, `texto`, `fecha_subida`, `status`, `corazones`, `portada`, `descripcion`, `categoria`) VALUES
(21, 'Empanadas jarochas ', 'Empanaditas:\n\nIngredientes: \n1.- 650 gramos de harina.\n2.- 75 ml. de leche.\n3.- 200 gramos de manteca vegetal.\n4.- 200 gramos de margarina.\n5.- 20 gramos de azúcar.\n6.- Cajeta horneable.\n7.- Huevo para barnizar.\n\nPreparación:\n\nHay que acremar la manteca y la margarina, después \nagregue azúcar y alterne harina y leche. \nPorcione en pequeñas cantidades y forme las empanadas,\nrellene con cajeta, después barnice con huevo.\nColoque en charolas previamente engrasadas y enharinadas y\nhornee a 170 grado centígrados durante 15 a 20 min. aprox.\nRetire y espolvoree azúcar.', NULL, 1, NULL, 'files/1475988225jarochas.jpg', 'Están listas en : 30 min. aprox. \n         (30 piezas)\n', 7),
(22, 'Empanadas de cajeta', 'Receta:\nIngredientes\n1.- 1kg. de harina.\n2.- 1/2 kg. de manteca vegeta.\n3.- 1 lata de cerveza.\n4.- 2 cdas. de azúcar.\n5.- 1 pizca de sal\n6.- 2 rajas de caneja.\n7.- cajeta.\n\nPreparación:\nMezcle con las manos, de manera suave, la harina, la manteca\n el azúcar y la sal hasta que tenga consistencia mas gruesa.\nAgregue la cerveza y amase hasta lograr una masa suave y que se\ndespegue de las manos. Divida la masa en cuatro partes, \nextiéndala en forma de rollo y haga 60 bolitas del mismo tamaño.\nCon una prensa, aplane las bolitas en forma de tortilla, y rellene\nde cajeta. Cierre la empanada con un tenedor. Hornee una charola\nligeramente engrasada a 180 grados centígrados por 30 min.\nCuando saque las empanadas del horno, cúbralas ligeramente\ncon una mezcla de azúcar y canela.\n\nPara la mezcla, licue 2 ramas de canela, después agregue\nun poco de azúcar, vuelva a licuar y deposite en un \nrecipiente con más azúcar y vuelva a revolver.', NULL, 1, NULL, 'files/1475989580empanadascajeta.jpg', 'Están listas en: 45 min. aprox. (25 piezas).', 7),
(23, 'Gelatina de nuez', 'Receta:\n\nIngredientes:\n1.- 70 gramos de nueces.\n2.- 1 litro de leche.\n3.- 30 gramos de grenetina hidratada en 1/2 taza de agua fria.\n4.- 1 taza de azúcar.\n5.- 1 cdita. de esencia de nuez.\n\nPreparación:\n\nLicue 50 gramos de nueces con la leche, el azúcar y la esencia.\nPonga la mezcla en una olla de fuego medio y en cuanto esté caliente\nagregue la grenetina hidratada, hasta que se disuelva perfectamente. \nDeje que se enfría un poco la mezcla y vierta en copas. \nAdorne al gusto con nueces.', NULL, 1, NULL, 'files/1475990517gelatina-nuez.png', 'Está lista en: 4 horas aprox.  (5 personas)', 5),
(24, 'Gelatina de yogur', 'Receta:\n\nIngredientes:\n\n1.- 1 litro de yogur de durazno.\n2.- 1 lata de leche evaporada.\n3.- 1 lata de leche condensada.\n4.- 50 gramos de grenetina.\n5.- 1 taza de agua fría.\n6.- 1 molde redondo de 2 litros de capacidad.\n7.- Fruta de temporada para decorar.\n\nPreparación:\n\nBata el yogur con las dos leches con un batidor o batidora hasta que\nhaga un poco de espuma.\nHidrate la grenetina con el agua; una vez que se haya hidratado, llévela\na baño Maria para que se diluya y esté transparente. \nVierta la grenetina diluida en el batido anterior y siga batiendo en forma\nenvolvente hasta que se integre bien la mezcla.\nVacíe el molde y refrigere de 2 a 3 horas. Decore con fruta.', NULL, 1, NULL, 'files/1475991143gelatina-yogur.jpg', 'Está lista en: 3 horas aprox. (10 personas)', 5),
(25, 'Gelatina de mango', 'Receta:\n\nIngredientes:\n1.- 30 gramos de grenetina.\n2.- 1/2 taza de agua fría.\n3.- 1 lata de leche condensada.\n4.- 1 lata de mangos en almíbar o naturales.\n5.- 150 gramos de coco rallado.\n6.- Rebanadas de mango para decorar.\n\nPreparación:\n\nHidrate la grenetina en el agua fría, disuelva a baño María y reserve.\nLicue la leche y el coco con los mangos sin el almíbar.\nDeposite la grenetina y mezcle. Vierta la mezcla en un molde\ny refrigere. Desmolde y decore con las rebanadas de mango,', NULL, 1, NULL, 'files/1475992388gelatinamango.JPG', 'Está lista en: 4 horas aprox. (8 personas)', 5),
(26, 'Bocadillos de nuez', 'Receta\n\nIngredientes:\n1.- 190 gramos de queso crema.\n2.- 200 gramos de uvas sin semilla.\n3.- 50 gramos de azúcar.\n4.- 150 gramos de nuez finamente picada.\n\nPreparación:\n\nAcreme el queso con el azúcar y revuelva un poco de nuez picada. \nEscoja las uvas más grandes, pártalas por la mitad y cubra con la mezcla\nde queso crema la parte superior de la uva, posteriormente agregue nuez\npicada. Póngalas unos 20 min. en el refrigerador y sirva.', NULL, 1, NULL, 'files/1475994236bocadillosnuez.jpg', 'Están listos en: 30min. (15 personas).', 1),
(27, 'Filete de res campirano', 'Receta: \n\nIngredientes:\n1.- 600 gramos de filete de res.\n2.- sal y pimienta.\n3.- 2 cucharadas de salsa china.\n4.- 1, 1/2 cebolla en medias lunas.\n5.- 6 chiles serranos.\n\nPreparación:\nCortar el filete de res en pedazos chicos. \nCondimentar con sal y pimienta.\nTorear 6 chiles serranos y freír el filete junto con el chile.\nCuando la carne esté a punto de cocerse, agregar la cebolla\ny la salsa china.\nCocinar al gusto.', NULL, 1, NULL, 'files/1475995392filetecampirano.png', 'Cocinar al gusto. (4 personas).', 2),
(28, 'Crema de Zanahoria', '---\nIngredientes:\n* 6 zanahorias.\n* 1/4 de cebolla.\n* 3 cucharadas de mantequilla.\n* 2 cuadros de consomé de pollo.\n * 2 tazas de leche.\n * 1, 1/2 tazas de agua.\n * 2 rebanadas de pan de caja frito cortado en cuadritos.\n\n Preparación:\n Sofreír la cebolla finamente picada en mantequilla a fuego lento.\n Licuar las zanahorias ya cocidas con la taza y media de agua.\n Agregar a la cacerola con la cebolla. Dejar cocinar por tres minutos.\n Incorporar la leche y los cuadros de consomé de pollo.\n Revolver hasta que hierva. Al servir se le agrega el pan frito\n en cuadritos.', NULL, 1, NULL, 'files/1476505772cremazanahorias.jpg', 'Está lista en: 15 min. aprox. (4 personas).', 9),
(29, 'Pescado a la gabardina', '----\nIngredientes:\n* 4 filetes de pescado.\n* 2 huevos.\n* 400 mil de cerveza.\n* 1/2 taza de harina.\n* pimienta blanca.\n* sal de ajo.\n* sal de cebolla.\n* sal de apio.\n* salsa inglesa.\n* aceite.\n\nPreparación:\nSalpimentar los filetes. Mezclar el resto de los ingredientes\ncon las sales, salsa y pimienta al gusto. Envolver los\nfiletes en la mezcla y freír en aceite. Escurrir.', NULL, 1, NULL, 'files/1476506189pescadogabardina.jpg', '(4 personas)', 2),
(30, 'Pescado al vapor', '----\nIngredientes:\n* 1kg de bonete chico.\n* 3 zanahorias.\n* 3 varas de apio.\n* 2 tomates.\n* 1/8 cucharadas de orégano.\n* tomate licuado.\n* 1/2 cebolla.\n* 50 g de aceitunas.\n\nPreparación:\nFiletear y condimentar con sal y pimienta el pescado. \nCortar en juliana la zanahoria y el apio. Licuar los tomates\ncon orégano y sal. Mezclar todos los ingredientes, agregar las\naceitunas y meter al horno de 15 a 20 minutos.', NULL, 1, NULL, 'files/1476506846alvapor.jpg', 'Está listo en: 30 min. aptos. (4 personas)', 2),
(31, 'Chiles en nogada', '----\nIngredientes:\n* 12 chiles.\n* 1 kg de carne molida mixta.\n* 100 g de almendra.\n* 100 g de pasas.\n* 1/2 kg de manzana roja.\n* 1/3 kg de durazno.\n* 1/2 barra de bisnaga.\n* 2 dientes de ajo.\n* 90 g barras de queso crema.\n* 1/4 crema.\n* 1 grabada\n* 4 docenas de nuez de castilla.\n* sal y pimienta.\n\nPreparación:\nSe tuestan los chiles y se limpian. Freír en poco aceite la\ncarne, almendras y pasas, al final agregar la fruta picada, sal,\npimienta y nuez moscada. Rellenar los chiles con el guiso. \nLicuar la nuez pelada, queso crema y se bañan los chiles con la mezcla. \nServir con la granada.', NULL, 1, NULL, 'files/1476507526ennogada.jpg', '(6 personas)', 2),
(32, 'Asado de res', '----\nIngredientes:\n* 1 kg de carne de gusano o cuate.\n* 3 papas cocidas.\n* lechuga.\n* 2 dientes de ajo.\n* cebolla.\n* zanahoria rayada.\n* sal.\n* pimienta.\n\nPreparación:\nSe pone a cocer la carne con 1/2 cebolla, 2 ajos,\nhojas de laurel y sal. Ya que está blandita se parte\nen cuadritos pequeños al igual que las papas y se \nles agrega sal y pimienta.\nSe fríe la carne con las papas. Servir con lechuga \nfinalmente picada, zanahoria rayada, cebolla al gusto.\nBañar con caldillo de tomate.', NULL, 1, NULL, 'files/1476508299asadoderex.jpg', '(4 personas)', 2),
(33, 'Plátanos envueltos', '----\nIngredientes:\n* 2 plátanos de cocer pelados.\n*100 g de tocino.\n\nPreparación:\nEnvolver los plátanos con el tocino.\nFreírlos en un sartén. Servir calientes.', NULL, 1, NULL, 'files/1477024814platanos.jpg', '(4 personas)', 2),
(34, 'Arroz cubano', '-----\n\nIngredientes:\n* 330 g de arroz.\n* 4 huevos.\n* 2 plátanos machos.\n* 2 dientes de ajo.\n* manteca.\n* sal.\n\nPreparación:\nSe fríen los ajos. Agregar el arroz bien lavado, sal\ny agua hirviendo. Ya cocido se pone al horno para\nconsumir el líquido. Los plátanos cortados a lo largo\nse fríen y los huevos fritos se ponen alrededor del arroz\nal igual que las rebanadas de plátano.', NULL, 1, NULL, 'files/1477025072ArrozCubano-1.jpg', '(2 personas)', 2);

-- --------------------------------------------------------

--
-- Table structure for table `recetas_calificacion`
--

CREATE TABLE `recetas_calificacion` (
  `id` int(11) NOT NULL,
  `receta_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `calificacion` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recetas_calificacion`
--

INSERT INTO `recetas_calificacion` (`id`, `receta_id`, `usuario_id`, `calificacion`) VALUES
(2, 33, 8, 3),
(3, 27, 8, 3.5),
(4, 28, 8, 4),
(5, 24, 8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sudos`
--

CREATE TABLE `sudos` (
  `id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sudos`
--

INSERT INTO `sudos` (`id`, `username`, `password`) VALUES
(1, 'cesar_nieto', 'zf4Z8M2K'),
(2, 'edgar_arroyo', 'i5tmXd47'),
(3, 'ivancito', '123');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(100) NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `password`) VALUES
(4, 'hi.ed@hotmail.com', 'e178f759fe55c8c9596f2202060dc7dd'),
(6, 'jjmv.97@hotmail.com', '320e265aaf720e903b1e1561cbd8a75a'),
(7, 'alejandra.jim97@gmail.com', '9f8b9b003eb2c5a823659ebc5d62c706'),
(8, 'xbox_livegold@hotmail.es', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesos`
--
ALTER TABLE `accesos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pins`
--
ALTER TABLE `pins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portada-receta`
--
ALTER TABLE `portada-receta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recetas_calificacion`
--
ALTER TABLE `recetas_calificacion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sudos`
--
ALTER TABLE `sudos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesos`
--
ALTER TABLE `accesos`
  MODIFY `id` bigint(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pins`
--
ALTER TABLE `pins`
  MODIFY `id` bigint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `portada-receta`
--
ALTER TABLE `portada-receta`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `recetas_calificacion`
--
ALTER TABLE `recetas_calificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sudos`
--
ALTER TABLE `sudos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
