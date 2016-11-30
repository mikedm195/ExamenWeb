-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-11-2016 a las 07:50:22
-- Versión del servidor: 5.5.50-MariaDB
-- Versión de PHP: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `JSON`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Vino`
--

CREATE TABLE `Vino` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `anio` varchar(45) DEFAULT NULL,
  `uvas` varchar(45) DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `region` varchar(45) DEFAULT NULL,
  `descripcion` longtext,
  `imagen` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Vino`
--

INSERT INTO `Vino` (`id`, `nombre`, `anio`, `uvas`, `pais`, `region`, `descripcion`, `imagen`) VALUES
(1, 'CHATEAU DE SAINT COSME', '2010', 'Grenache / Syrah', 'France', 'Southern Rhone / Gigondas', 'En boca el vino encaprichado con seductoras notas de mora, zarzamora y alquitran. La mineralidad es claramente perceptible. A pesar de la 100% -Syrah insertar una impresion de la dulce y terroso al mismo tiempo Mourvedre. En el paladar medio probamos el chocolate terroso y aromas de ciruela se cocina. Con toda la fuerza y vigor de la muestra de vino tanto la raza y la frescura con buena longitud. Un verdadero lujo especialmente con platos de caza o quesos maduros.', 'saint_cosme.jpg'),
(2, 'LAN RIOJA CRIANZA', '2006', 'Tempranillo', 'Spain', 'Rioja', 'Un Rioja moderna, joven con sabor a fruta y el estilo flexible, que impresiona con buena estructura, el paladar completo y gran acabado.', 'lan_rioja.jpg'),
(3, 'MARGERUM SYBARITE', '2010', 'Sauvignon Blanc', 'USA', 'California Central Cosat', 'La cache de un fino Cabernet en la bodega de vinos puede ahora ser reemplazado con un vino jugueton infantil burbujeante con gustos tentadores de\r\nCereza negra y regaliz. Este es un gusto seguro de transportar', 'margerum.jpg'),
(4, 'OWEN ROE "EX UMBRIS"', '2009', 'Syrah', 'USA', 'Washington', 'Un golpe de uno-dos de pimienta negra y jalapenio enviara sus sentidos tambaleandose, como la esencia de naranja hace que vuelva a la realidad. No te pierdas esta sensacion de sabor galardonada.', 'ex_umbris.jpg'),
(5, 'REX HILL', '2009', 'Pinot Noir', 'USA', 'Oregon', 'No se puede dudar que este sera el vino servido en los espectaculos de premios de Hollywood, porque tiene innegable poder de la estrella. Ser el primero en atrapar el debut que todos estaran hablando de maniana.', 'rex_hill.jpg'),
(6, 'VITICCIO CLASSICO RISERVA', '2007', 'Sangiovese Merlot', 'Italy', 'Tuscany', 'Aunque suave y redondeado en textura, el cuerpo de este vino es lleno y rico y oh-tan-atractivo. Esta entrega es aun mas impresionante cuando se toma nota de los taninos tiernos que dejan el paladar', 'viticcio.jpg'),
(7, 'CHATEAU LE DOYENNE', '2005', 'Merlot', 'France', 'Bordeaux', 'Aunque denso y masticable, este vino no domina con su profundidad y estructura finamente equilibrada. Es una experiencia verdaderamente lujosa para los sentidos.', 'le_doyenne.jpg'),
(8, 'DOMAINE DU BOUSCAT', '2009', 'Merlot', 'France', 'Bordeaux', 'El ligero color dorado de este vino desmiente el brillante sabor que posee. Un verdadero vino de verano, pide un almuerzo de picnic en un viniedo empapado de sol.', 'bouscat.jpg'),
(9, 'BLOCK NINE', '2009', 'Pinot Noir', 'USA', 'California', 'Con toques de jengibre y especias, este vino es un excelente complemento para el aperitivo ligero y la tarifa de postre para una reunion de vacaciones.', 'block_nine.jpg'),
(10, 'DOMAINE SERENE', '2007', 'Pinot Noir', 'USA', 'Oregon', 'Aunque sutil en sus complejidades, este vino es seguro para complacer a una amplia gama de entusiastas. Notas de granada se deleitara como el acabado de nuez completa la imagen de una experiencia de sipping.', 'domaine_serene.jpg'),
(11, 'BODEGA LURTON', '2011', 'Pinot Gris', 'Argentina', 'Mendoza', 'Notas solidas de grosella negra mezcladas con un citrico ligero hacen de este vino un vertido facil para paladares variados.', 'bodega_lurton.jpg'),
(12, 'LES MORIZOTTES', '2009', 'Chardonnay', 'France', 'Burgundy', 'Rompiendo el molde de los clasicos, esta ofrenda sorprendera y sin duda hara que las lenguas se meneen con las notas de cafe y tabaco en perfecta alineacion con notas mas tradicionales.', 'morizottes.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Vino`
--
ALTER TABLE `Vino`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Vino`
--
ALTER TABLE `Vino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
