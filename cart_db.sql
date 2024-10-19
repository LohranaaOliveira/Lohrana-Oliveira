-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/10/2024 às 13:49
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
-- Banco de dados: `cart_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `mensagem` text NOT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`id`, `nome`, `sobrenome`, `email`, `telefone`, `mensagem`, `data_envio`, `rating`) VALUES
(1, 'Gabriel ', 'Lima', 'gabriel.lima@example.com', '(31) 98765-4321', 'O \"TopLevel\" é um bom site para comprar jogos e componentes. A variedade é ótima, e encontrei facilmente o que procurava. A única coisa que me deixou um pouco desapontado foi o tempo de entrega, que demorou um dia a mais do que o prometido. No entanto, o produto chegou em perfeitas condições. O suporte ao cliente também foi eficiente e me ajudou rapidamente com uma dúvida que eu tinha.\r\n\r\n', '2024-10-18 02:15:51', 4),
(2, 'Marina ', 'Costa', 'marina.costa@example.com', '(41) 91234-6789', 'Estou muito satisfeita com minha compra no \"TopLevel\"! A interface do site é intuitiva e agradável. A busca por jogos e acessórios é super fácil, e adorei a seção de recomendações, que me ajudou a descobrir novos títulos. Fiz um pedido de um jogo e ele chegou antes do previsto! Com certeza, recomendo este site a todos os meus amigos gamers.', '2024-10-18 02:16:40', 5),
(3, 'Lucas ', 'Oliveira', 'lucas.oliveira@example.com', '(11) 91234-5678', 'Eu tive uma experiência incrível comprando no site \"TopLevel\". Desde o momento em que entrei, a interface moderna e intuitiva me surpreendeu. A navegação é fluida, permitindo encontrar facilmente jogos e componentes. As imagens dos produtos são de alta qualidade, e as descrições são detalhadas, o que ajuda na hora da decisão de compra.\r\n\r\nO que mais me impressionou foi a variedade de produtos disponíveis. Eu encontrei desde os lançamentos mais recentes até clássicos que são difíceis de achar em outros lugares. Além disso, as opções de filtragem, como categorias e faixas de preço, facilitam ainda mais a busca pelo que você precisa.\r\n\r\nA finalização da compra foi simples e rápida, com várias opções de pagamento disponíveis. Recebi meu pedido dentro do prazo e em perfeitas condições, o que é sempre um alívio.\r\n\r\nOutro ponto positivo é o atendimento ao cliente. Tive uma dúvida sobre um produto e entrei em contato via chat. O atendente foi super prestativo e resolveu minha questão em poucos minutos.\r\n\r\nSe você é um entusiasta de jogos, definitivamente recomendo o \"TopLevel\". É um site que se destaca pela qualidade, variedade e atendimento excepcional. Com certeza, voltarei para novas compras!', '2024-10-18 02:14:06', 5),
(4, 'Ana ', 'Souza', 'ana.souza@example.com', '(21) 99876-5432', 'A experiência de compra no \"TopLevel\" foi excelente! O site é muito bem organizado e as informações dos produtos são claras e objetivas. Adorei a variedade de jogos disponíveis, desde os mais novos até os clássicos. O sistema de pagamento é seguro e a entrega foi super rápida. Recebi meu pedido em dois dias e tudo chegou em perfeito estado. Com certeza voltarei para comprar mais!', '2024-10-18 02:15:14', 5),
(5, 'Felipe ', 'Martins', 'felipe.martins@example.com', '(51) 92345-6789', 'Tive uma experiência razoável no \"TopLevel\". O site é bonito e fácil de navegar, mas encontrei alguns problemas. O produto que eu queria estava com estoque baixo e demorei para conseguir finalizar a compra. A entrega também foi um pouco mais lenta do que eu esperava. No entanto, quando recebi o jogo, fiquei satisfeito com a qualidade e com o ótimo preço. Espero que eles melhorem a disponibilidade dos produtos no futuro!', '2024-10-18 02:17:09', 3),
(11, 'Jonas ', 'Gostoso', 'jonas.venzel@escola.pr.gov.br', '42991163806', 'Oi, eu sou o Jonas Gostoso', '2024-10-18 10:55:32', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cart`
--

CREATE TABLE `cart` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cart`
--

INSERT INTO `cart` (`id`, `name`, `price`, `image`, `quantity`, `user_email`) VALUES
(183, 'Cadeira Gamer Mach', 584.99, 'cadeira-gamer-mach.webp', 1, NULL),
(184, 'Mouse Wireless X2', 124.99, 'mause-wirelessX2.webp', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `method` varchar(100) NOT NULL,
  `flat` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `status` enum('pendente','entregue') DEFAULT 'pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `name`, `phone`, `email`, `method`, `flat`, `street`, `city`, `state`, `total_products`, `total_price`, `status`) VALUES
(47, 'Tatiane Rodrigues de Oliveira', '(41) 99876-5', 'tatiane.oliveira@example.com', 'Pix', 'Alto da Glória', 'Rua do Sol, 369', 'Curitiba', 'PR', 'headset L503 (1) , Cadeira Gamer Impact (1) , Mouse Wireless Blaze (1) ', '1059.97', 'entregue'),
(48, 'Tatiane Rodrigues de Oliveira', '(41) 99876-5', 'tatiane.oliveira@example.com', 'Boleto', 'Alto da Glória', 'Rua do Sol, 369 ', 'Curitiba', 'PR', 'Playbox XZ Edição Ouro (1) ', '10000', 'pendente'),
(49, 'Daniel dos Reis Ferreira', '(27) 92345-6', 'daniel.ferreira@example.com', 'Boleto', 'Jardim da Penha', 'Rua das Oliveiras, 246', 'Vitória', 'ES', 'Wave Gen RX (1) , Flint (1) ', '3629.98', 'pendente'),
(50, 'Renata Alves de Souza', '(62) 98765-4', 'renata.souza@example.com', 'Cartão de crédito', 'Setor Central', 'Avenida Goiás, 753', 'Belo Horizonte', 'MG', 'Ancient Souls (4) , Chronosplit (1) , Kira and the Fading Islands (1) ', '1179.94', 'pendente'),
(51, 'Renata Alves de Souza', '(62) 98765-4', 'renata.souza@example.com', 'Pix', 'Setor Central', 'Avenida Goiás, 753', 'Belo Horizonte', 'MG', 'Gameflow (1) ', '2609.99', 'pendente'),
(52, 'Thiago da Rocha Pereira', '(85) 99876-5', 'thiago.pereira@example.com', 'Boleto', 'Aldeota', 'Rua das Margaridas', 'Caxias do Sul', 'RS', 'Playbox XZ Edição Ouro (10) ', '100000', 'entregue'),
(53, 'Thiago da Rocha Pereira', '(85) 99876-5', 'thiago.pereira@example.com', 'Cartão de crédito', 'Aldeota', 'Rua das Margaridas', 'Caxias do Sul', 'RS', 'Gameflow Black (10) , Playbox XZ Edição Ouro (10) , Gameflow (10) , Set VR Veritas (7) , Wave Gen RX (7) ', '217509.76', 'pendente'),
(54, 'Ana Paula dos Santos', '(21) 99876-5', 'ana.santos@example.com', 'Boleto', 'Centro', 'Avenida Brasil', 'Rio de Janeiro', 'RJ', 'Cyber Kid Infinite (1) , Gameflow (1) , Wave (2) ', '3109.96', 'pendente'),
(55, 'Jonas Augusto Venzel', '(42) 99116-3', 'jonas.venzel@escola.pr.gov.br', 'Pix', 'Gostoso', 'Rua do Jonas Gostoso', 'Curitiba', 'PR', 'Teclado Mecânico Spartan (1) , headset L503 (2) ', '490.97', 'entregue');

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `promotion` tinyint(1) DEFAULT 0,
  `previous_price` decimal(10,2) DEFAULT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `promotion`, `previous_price`, `category`) VALUES
(1, 'Cadeira Gamer Impact', 799.99, 'cadeira-gamer-impact.webp', 0, 0.00, 'Acessórios'),
(2, 'Cadeira Gamer Mach', 584.99, 'cadeira-gamer-mach.webp', 1, 649.99, 'Acessórios'),
(3, 'headset echo', 199.99, 'headset-echo.webp', 0, 0.00, 'Acessórios'),
(4, 'headset L503', 134.99, 'headsetL503.webp', 1, 149.99, 'Acessórios'),
(5, 'Mouse Wireless Blaze', 124.99, 'Mouse Wireless Blaze.webp', 0, 0.00, 'Acessórios'),
(6, 'Mouse Wireless X2', 124.99, 'mause-wirelessX2.webp', 0, 0.00, 'Acessórios'),
(7, 'Teclado Mecânico CO-21', 220.99, 'Teclado Mecânico CO-21.webp', 0, 0.00, 'Acessórios'),
(8, 'Teclado Mecânico Spartan', 220.99, 'teclado-mecanico-spartan.webp', 1, 198.99, 'Acessórios'),
(9, 'Gameflow Black', 4500.00, 'Gameflow Black.webp', 1, 5000.00, 'Consoles'),
(10, 'Gameflow', 2609.99, 'gameflow.webp', 1, 2999.99, 'Consoles'),
(11, 'Playbox XZ Edição Ouro', 10000.00, 'playbox-XZ-edição-ouro.webp', 0, 0.00, 'Consoles'),
(12, 'Set VR Veritas', 3149.99, 'set-VR-veritas.webp', 0, 0.00, 'Consoles'),
(13, 'Wave Gen RX', 3479.99, 'Wave Gen RX.webp', 0, 0.00, 'Consoles'),
(14, 'Flint', 149.99, 'Flint.webp', 0, 0.00, 'Controles'),
(15, 'Ghost', 134.99, 'Ghost.webp', 1, 149.99, 'Controles'),
(16, 'Libra 2.0', 149.99, 'Libra 2.0.webp', 0, 0.00, 'Controles'),
(17, 'Raptor', 134.99, 'Raptor.webp', 1, 149.99, 'Controles'),
(18, 'Stealth X', 149.99, 'Stealth X.webp', 0, 0.00, 'Controles'),
(19, 'Wave', 149.99, 'Wave.webp', 0, 0.00, 'Controles'),
(20, 'Ancient Souls', 199.99, 'ancient-souls.webp', 0, 0.00, 'Games'),
(21, 'Chronosplit', 199.99, 'chronosplit.webp', 0, 0.00, 'Games'),
(22, 'Cyber Kid Infinite', 199.99, 'cyberkid.webp', 0, 0.00, 'Games'),
(23, 'Dead at Last', 161.99, 'dead-at-last.webp', 1, 179.99, 'Games'),
(24, 'Kira and the Fading Islands', 179.99, 'Kira and the Fading Islands.webp', 1, 199.99, 'Games'),
(25, 'Ice Dome Exile', 179.99, 'ice-dome-exile.webp', 1, 199.99, 'Games');

-- --------------------------------------------------------

--
-- Estrutura para tabela `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `subscribed_at`) VALUES
(1, 'lohranaoliv2@gmail.com', '2024-10-15 17:40:16'),
(2, 'lohrana.oliveira@escola.pr.gov.pr', '2024-10-15 17:41:20'),
(6, 'lollatyn@gmail.com', '2024-10-18 00:24:02'),
(7, 'jonasvenzel@escola.pr.gov.br', '2024-10-18 10:48:54'),
(8, 'cassiae.deandrade@gmail.com', '2024-10-18 11:30:25'),
(9, 'gionmarcos0609@gmail.com', '2024-10-18 11:31:09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `email` varchar(110) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `data_nasc` date NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `endereco` varchar(45) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `senha`, `email`, `telefone`, `sexo`, `data_nasc`, `cidade`, `estado`, `endereco`, `cep`, `numero`, `bairro`) VALUES
(1, 'Lohrana Oliveira', 'teste123', 'lohranaoliv2@gmail.com', '(42) 98853-7485', 'feminino', '2004-05-31', 'Guarapuava', 'PR', 'Rua de testes', '88888888', 123, 'Teste'),
(68, 'Jonas Gostoso', 'jonasgostoso123', 'jonasgostoso@gmail.com', '(42) 99116-3806', 'masculino', '2006-05-29', '0', 'ES', 'no cu de judas', '85010330', 123, 'Centro'),
(69, 'Lohrana Oliveira ', 'teste123', 'lohrana.oliveira@escola.pr.gov.br', '(42) 98853-7485', 'feminino', '2004-05-31', 'Guarapuava', 'PR', 'Rua de testes', '88888888', 123, 'teste'),
(70, 'TopLevel', 'teste123', 'toplevelbrasil@gmail.com', '', 'outro', '2004-05-31', '', '', '', '', 0, ''),
(71, 'Lucas Almeida da Silva', 'senha1234', 'lucas.silva@example.com', '', 'masculino', '1995-03-15', '', '', '', '', 0, ''),
(72, 'Ana Paula dos Santos', 'senha5678', 'ana.santos@example.com', '', 'feminino', '1990-07-22', '', '', '', '', 0, ''),
(73, 'Gabriel Oliveira de Souza', 'senha91011', 'gabriel.souza@example.com', '', 'masculino', '1988-11-30', '', '', '', '', 0, ''),
(74, 'Mariana Costa da Silva', 'senha1213', 'mariana.costa@example.com', '', 'feminino', '1993-02-05', '', '', '', '', 0, ''),
(75, 'Felipe Martins Ribeiro', 'senha1415', 'felipe.ribeiro@example.com', '', 'masculino', '1985-09-18', '', '', '', '', 0, ''),
(76, ' Juliana Fernandes de Lima', 'senha1617', 'juliana.lima@example.com', '', 'feminino', '1992-12-10', '', '', '', '', 0, ''),
(77, 'Thiago da Rocha Pereira', 'senha1819', 'thiago.pereira@example.com', '', 'masculino', '1991-05-25', '', '', '', '', 0, ''),
(78, 'Renata Alves de Souza', 'senha2021', 'renata.souza@example.com', '', 'feminino', '1994-04-02', '', '', '', '', 0, ''),
(79, 'Daniel dos Reis Ferreira', 'senha2223', 'daniel.ferreira@example.com', '', 'masculino', '1986-08-28', '', '', '', '', 0, ''),
(80, 'Tatiane Rodrigues de Oliveira', 'senha2425', 'tatiane.oliveira@example.com', '', 'masculino', '1989-06-17', '', '', '', '', 0, ''),
(81, 'Jonas Augusto Venzel', 'jonas123', 'jonas.venzel@escola.pr.gov.br', '(42) 99116-3806', 'masculino', '2006-05-29', 'Guarapuava', 'PR', 'Rua do Jonas Gostoso', '85010330', 1104, 'Gostoso');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD UNIQUE KEY `id` (`id`,`nome`,`email`,`sexo`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de tabela `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
