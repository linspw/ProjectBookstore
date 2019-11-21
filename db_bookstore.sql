-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Nov-2019 às 02:32
-- Versão do servidor: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bookstore`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `employee`
--

CREATE TABLE `employee` (
  `EPY_ID` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `employee`
--

INSERT INTO `employee` (`EPY_ID`, `cpf`, `name`, `email`, `password`) VALUES
(1, '1000002020', 'Root1', 'root1@admin.com', '1'),
(2, '1000002020', 'Root2', 'root2@admin.com', '2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `order_buy`
--

CREATE TABLE `order_buy` (
  `COD_ODB` int(11) NOT NULL,
  `EPY_ID` int(11) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Habilitado',
  `order_date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `order_date_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_qnt_itens` int(11) NOT NULL DEFAULT '0',
  `total_price_itens` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `order_buy_temp`
--

CREATE TABLE `order_buy_temp` (
  `COD_ODB` int(11) NOT NULL,
  `EPY_ID` int(11) NOT NULL,
  `COD_PDT` int(11) NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `quant` int(11) NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `order_buy_temp`
--

INSERT INTO `order_buy_temp` (`COD_ODB`, `EPY_ID`, `COD_PDT`, `price`, `quant`, `status`) VALUES
(3, 1, 16, 10.2, 1, 'Vendido');

-- --------------------------------------------------------

--
-- Estrutura da tabela `order_itens`
--

CREATE TABLE `order_itens` (
  `COD_ODI` int(11) NOT NULL,
  `COD_ODB` int(11) NOT NULL,
  `COD_PDT` int(11) NOT NULL,
  `total_qnt` int(11) NOT NULL DEFAULT '0',
  `total_price` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `product`
--

CREATE TABLE `product` (
  `COD_PDT` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `product`
--

INSERT INTO `product` (`COD_PDT`, `name`, `description`, `value`) VALUES
(16, 'Uma vida com Propósito', 'Muito legal', 10.2),
(17, 'A arte da Guerra', 'Livro de Estratégias para vida', 29.9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `stock`
--

CREATE TABLE `stock` (
  `COD_STK` int(11) NOT NULL,
  `COD_PDT` int(11) NOT NULL,
  `enable_product` tinyint(1) NOT NULL DEFAULT '1',
  `avaliable_qnt_products` int(11) NOT NULL,
  `sold_qnt_products` int(11) NOT NULL,
  `total_qnt_products` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `stock`
--

INSERT INTO `stock` (`COD_STK`, `COD_PDT`, `enable_product`, `avaliable_qnt_products`, `sold_qnt_products`, `total_qnt_products`) VALUES
(16, 16, 1, 0, 1, 1),
(17, 17, 1, 1, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EPY_ID`);

--
-- Indexes for table `order_buy`
--
ALTER TABLE `order_buy`
  ADD PRIMARY KEY (`COD_ODB`),
  ADD KEY `EPY_ID` (`EPY_ID`);

--
-- Indexes for table `order_buy_temp`
--
ALTER TABLE `order_buy_temp`
  ADD PRIMARY KEY (`COD_ODB`),
  ADD KEY `EPY_ID` (`EPY_ID`),
  ADD KEY `COD_PDT` (`COD_PDT`);

--
-- Indexes for table `order_itens`
--
ALTER TABLE `order_itens`
  ADD PRIMARY KEY (`COD_ODI`),
  ADD KEY `COD_ODB` (`COD_ODB`),
  ADD KEY `COD_PDT` (`COD_PDT`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`COD_PDT`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`COD_STK`),
  ADD KEY `COD_PDT` (`COD_PDT`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EPY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `order_buy`
--
ALTER TABLE `order_buy`
  MODIFY `COD_ODB` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_buy_temp`
--
ALTER TABLE `order_buy_temp`
  MODIFY `COD_ODB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `order_itens`
--
ALTER TABLE `order_itens`
  MODIFY `COD_ODI` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `COD_PDT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `COD_STK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `order_buy`
--
ALTER TABLE `order_buy`
  ADD CONSTRAINT `order_buy_ibfk_1` FOREIGN KEY (`EPY_ID`) REFERENCES `employee` (`EPY_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `order_buy_temp`
--
ALTER TABLE `order_buy_temp`
  ADD CONSTRAINT `order_buy_temp_ibfk_1` FOREIGN KEY (`COD_PDT`) REFERENCES `product` (`COD_PDT`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_buy_temp_ibfk_2` FOREIGN KEY (`EPY_ID`) REFERENCES `employee` (`EPY_ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Limitadores para a tabela `order_itens`
--
ALTER TABLE `order_itens`
  ADD CONSTRAINT `order_itens_ibfk_1` FOREIGN KEY (`COD_ODB`) REFERENCES `order_buy` (`COD_ODB`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_itens_ibfk_2` FOREIGN KEY (`COD_PDT`) REFERENCES `product` (`COD_PDT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`COD_PDT`) REFERENCES `product` (`COD_PDT`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
