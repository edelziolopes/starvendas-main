-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/11/2025 às 18:26
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ecommerce`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_carrinhos`
--

CREATE TABLE `tb_carrinhos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_endereco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_categorias`
--

CREATE TABLE `tb_categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_categorias`
--

INSERT INTO `tb_categorias` (`id`, `nome`) VALUES
(1, 'Chaveiro de controle'),
(2, 'Chaveiro F1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_compras`
--

CREATE TABLE `tb_compras` (
  `id` int(11) NOT NULL,
  `id_carrinho` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_enderecos`
--

CREATE TABLE `tb_enderecos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `cep` int(11) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `numero` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_fotos`
--

CREATE TABLE `tb_fotos` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_fotos`
--

INSERT INTO `tb_fotos` (`id`, `id_produto`, `foto`) VALUES
(1, 2, 'gatinho.png'),
(2, 2, '20251105183157.jpg'),
(3, 1, '20251105184144.jpg'),
(4, 1, '20251105184826.jpg'),
(5, 1, '20251105184916.jpg'),
(6, 2, '20251112101159.jpg'),
(7, 1, '20251112101726.jpg'),
(8, 2, '20251112101734.jpg'),
(9, 1, '20251112102107.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` float NOT NULL,
  `imagem` text NOT NULL,
  `quantidade` int(11) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_produtos`
--

INSERT INTO `tb_produtos` (`id`, `id_categoria`, `nome`, `preco`, `imagem`, `quantidade`, `descricao`) VALUES
(1, 1, 'Mini controle', 10, '20251103172054.jpg', 12, 'Chaveiro em formato de controle de videogame — o acessório ideal para quem ama o mundo dos games!'),
(2, 2, 'Mini carrinho de F1', 50, '20251103172446.jpg', 5, 'Leve a velocidade da Fórmula 1 com você! Esse chaveiro traz uma miniatura de carro de F1 feita em impressora 3D, combinando tecnologia e estilo.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `email` varchar(40) NOT NULL,
  `senha` text NOT NULL,
  `foto` varchar(40) NOT NULL,
  `tipo` int(11) NOT NULL,
  `creditos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id`, `nome`, `email`, `senha`, `foto`, `tipo`, `creditos`) VALUES
(1, 'Ana Tavares', 'ana@c.com', '$2y$10$UP0CWGaposwGI/h.B/yUte0X3qGWa8NLM62cGVMIrqEo294nW0UwS', '20251103171418.jpg', 1, 2000),
(2, 'Bianca', 'bibi@cruz.com', '$2y$10$yxjlB6/AWNo7464nlLIc9.Rgg8OrG8MRq6dT8zyYhanwXlAO5s4NG', '20251104105442.jpg', 2, 0),
(3, 'Gabriel ', 'gab@asafe.com', '$2y$10$w32HuTUfC6Evmj/Sz2UvROBu7zBXUcFV0Grn2e93MI17hF4e8e/0q', '20251104185618.jpg', 2, 0),
(4, 'Filhinho lindinho', 'Filhinho@lindinho.com', '$2y$10$FmEjIzYJVXRvFPtPff3ZyOloLT0CTd4JOXQ/VYe4/u.0cL3hMwMpu', '20251105134410.jpg', 1, 0),
(5, 'e@e.com', 'e@e.com', '$2y$10$5yuRynej80rmF0.z2OKdiejkYTbS7rsYzLlBxjfduPmMPr09.IIPW', '20251106182936.jpg', 2, 0),
(6, 'Edelzio', 'edelzio@e.com', '$2y$10$9bz7PGyqxQGDWQWpI3y0VOQqOhtYHEZ9w4x.RjA83rcVqP9KiUAUa', '20251106183037.jpg', 2, 0),
(7, 'dada', 'ada@ada', '$2y$10$Gkd/eukRo3ZmOJa2RV0XfOpLWcC4SiZex9M35nl6SYA2CJsY7KGAa', '20251107105733.jpg', 2, 0),
(8, 'dada', 'dada@dada', '$2y$10$MGB2Uo.Hqi/qmeJcvTtyTu5oiBZj0WoWHLgo6KByORbj7jeLJEhPW', '20251107110911.jpg', 2, 0),
(9, 'renan', 'renan@c.com', '$2y$10$uV8ZSASkEbteXOLMx7/dT.85fm72Baxm1yHigi4yXy95OmM9hiASi', '20251110101931.jpg', 2, 0),
(10, 'João', 'joao@marcos.com', '$2y$10$D2GWH8SA3HeCiqaxUYFsR.Dr4NcUV28dZ/b4hg09sqWSnBqiXSp/m', '20251110115624.jpg', 2, 0),
(11, 'Ray', 'ray@silva.com', '$2y$10$Uy37trEHJsKv/bBbfLwY9OpCQqPy2ZbA.Wwpk93DFCTxtzDOUu94i', '20251111112833.jpg', 2, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_carrinhos`
--
ALTER TABLE `tb_carrinhos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_categorias`
--
ALTER TABLE `tb_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_compras`
--
ALTER TABLE `tb_compras`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_enderecos`
--
ALTER TABLE `tb_enderecos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_fotos`
--
ALTER TABLE `tb_fotos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_carrinhos`
--
ALTER TABLE `tb_carrinhos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_categorias`
--
ALTER TABLE `tb_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_compras`
--
ALTER TABLE `tb_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_enderecos`
--
ALTER TABLE `tb_enderecos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tb_fotos`
--
ALTER TABLE `tb_fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
