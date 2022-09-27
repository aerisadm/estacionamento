-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Set-2022 às 01:09
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estacionamento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carros`
--

CREATE TABLE `carros` (
  `id_carro` int(11) NOT NULL,
  `vaga_id` int(100) NOT NULL,
  `placa_carro` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `cor` varchar(50) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `verificar_pagamento` varchar(255) NOT NULL,
  `data_entrada` datetime NOT NULL DEFAULT current_timestamp(),
  `data_saida` datetime NOT NULL,
  `valor_total` float(10,2) NOT NULL,
  `tarifa_unica` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `carros`
--

INSERT INTO `carros` (`id_carro`, `vaga_id`, `placa_carro`, `modelo`, `cor`, `marca`, `verificar_pagamento`, `data_entrada`, `data_saida`, `valor_total`, `tarifa_unica`) VALUES
(1, 1, 'GJH-8789', 'Camaro', 'preto', 'chevrolet', 'pago', '2021-11-23 14:10:32', '2021-11-23 14:11:31', 5.00, 12.00),
(2, 2, 'GJH-1245', 'Camaro', 'preto', 'chevrolet', 'pago', '2021-11-23 14:10:37', '2021-11-23 14:11:37', 5.00, 12.00),
(3, 3, 'GJH-8788', 'Camaro', 'preto', 'chevrolet', 'pendente', '2021-11-23 14:10:42', '0000-00-00 00:00:00', 0.00, 12.00),
(113, 1, 'GJH-8789', 'Camaro', 'amarelo', 'chevrolet', 'pago', '2021-11-30 12:06:47', '2021-11-30 12:06:55', 5.00, 12.00),
(114, 3, 'GJH-8789', 'Camaro', 'preto', 'chevrolet', 'pago', '2021-11-30 13:13:44', '2021-11-30 13:14:19', 5.00, 12.00),
(115, 1, 'GJH-1245', 'Camaro', 'preto', 'chevrolet', 'pago', '2021-11-30 13:15:02', '2021-11-30 13:15:09', 10.00, 12.00),
(116, 1, 'GJH-8789', 'Camaro', 'amarelo', 'chevrolet', 'pago', '2021-11-30 13:16:14', '2021-11-30 13:16:21', 6.00, 0.00),
(117, 1, 'KJL-8587', 'Palio', 'Preto', 'Fiat', 'pago', '2022-07-17 11:13:34', '2022-07-17 11:14:10', 6.00, 0.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lojas`
--

CREATE TABLE `lojas` (
  `id_loja` int(100) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `pago_loja` float(10,2) NOT NULL,
  `verificar_pagamento` varchar(100) NOT NULL,
  `nome_responsavel` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `lojas`
--

INSERT INTO `lojas` (`id_loja`, `nome`, `pago_loja`, `verificar_pagamento`, `nome_responsavel`, `endereco`, `email`) VALUES
(10, 'Amazon', 0.00, 'pago', 'Guilherme Bastos Leone', 'Rua Alexandre Vanucchi', 'guilhermebastosleone@gmail.com'),
(11, 'Sansung', 0.00, 'pago', 'Guilherme Bastos Leone', 'Rua Alexandre Vanucchi', 'guilhermebastosleone@gmail.com'),
(12, 'SpaceX', 6.00, 'pendente', 'Eduardo', 'Rua Alexandre', 'leone@gmail.com'),
(13, 'Kabum', 0.00, 'pago', 'Danilo', 'Rua  Vanucchi', 'guilherme@gmail.com'),
(14, 'Americanas', 0.00, 'pago', 'Guilherme Bastos Leone', 'Rua Alexandre Vanucchi', 'bastosleone@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `telefone` bigint(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `senha`, `nome`, `endereco`, `telefone`) VALUES
(1, 'admin@ifsp.edu.br', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', 'rua abacate', 54544568878),
(2, 'eduardomartins@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'eduardo Martins de Barros Moreira', 'rua Londr', 1997142),
(3, 'guilhermebastosleone@gmail.com', '9443ea4dc941df45117b3e194041274b', 'Guilherme Bastos Leone', 'Rua Alexandre, 26', 19971);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vagas`
--

CREATE TABLE `vagas` (
  `vaga_id` int(100) NOT NULL,
  `vaga_tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vagas`
--

INSERT INTO `vagas` (`vaga_id`, `vaga_tipo`) VALUES
(1, 'vaga_sem_carro.png'),
(2, 'vaga_sem_carro.png'),
(3, 'vaga_sem_carro.png'),
(4, 'vaga_sem_carro.png'),
(5, 'vaga_sem_carro.png'),
(7, 'vaga_sem_carro.png'),
(8, 'vaga_sem_carro.png'),
(9, 'vaga_sem_carro.png'),
(10, 'vaga_sem_carro.png'),
(11, 'vaga_sem_carro.png'),
(12, 'vaga_sem_carro.png'),
(13, 'vaga_sem_carro.png'),
(14, 'vaga_sem_carro.png'),
(15, 'vaga_sem_carro.png'),
(16, 'vaga_sem_carro.png');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `carros`
--
ALTER TABLE `carros`
  ADD PRIMARY KEY (`id_carro`),
  ADD KEY `vaga_id` (`vaga_id`);

--
-- Índices para tabela `lojas`
--
ALTER TABLE `lojas`
  ADD PRIMARY KEY (`id_loja`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Índices para tabela `vagas`
--
ALTER TABLE `vagas`
  ADD PRIMARY KEY (`vaga_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carros`
--
ALTER TABLE `carros`
  MODIFY `id_carro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de tabela `lojas`
--
ALTER TABLE `lojas`
  MODIFY `id_loja` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `vagas`
--
ALTER TABLE `vagas`
  MODIFY `vaga_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `carros`
--
ALTER TABLE `carros`
  ADD CONSTRAINT `carros_ibfk_1` FOREIGN KEY (`vaga_id`) REFERENCES `vagas` (`vaga_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
