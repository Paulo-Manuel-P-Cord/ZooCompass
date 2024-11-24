-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/11/2024 às 19:17
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
-- Banco de dados: `crud`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `animal` varchar(100) NOT NULL,
  `diet` int(11) NOT NULL,
  `habitat` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `origin` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `animals`
--

INSERT INTO `animals` (`id`, `animal`, `diet`, `habitat`, `amount`, `origin`, `created_at`, `updated_at`) VALUES
(7, 'Leão', 1, 'Savanas', 5, 'África', '2024-11-19 23:02:48', '2024-11-19 23:02:48'),
(8, 'Tigre', 1, 'Florestas', 4, 'Ásia', '2024-11-19 23:02:48', '2024-11-19 23:02:48'),
(9, 'Elefante', 2, 'Florestas tropicais', 8, 'África', '2024-11-19 23:02:48', '2024-11-19 23:02:48'),
(10, 'Girafa', 2, 'Savanas', 6, 'África', '2024-11-19 23:02:48', '2024-11-19 23:02:48'),
(11, 'Zebra', 2, 'Savanas', 10, 'África', '2024-11-19 23:02:48', '2024-11-19 23:02:48'),
(12, 'Urso', 3, 'Florestas temperadas', 3, 'América do Norte', '2024-11-19 23:02:48', '2024-11-19 23:02:48'),
(13, 'Macaco', 3, 'Florestas tropicais', 12, 'América do Sul', '2024-11-19 23:02:48', '2024-11-19 23:02:48'),
(14, 'Arara', 4, 'Florestas tropicais', 7, 'América do Sul', '2024-11-19 23:02:48', '2024-11-19 23:02:48'),
(15, 'Pica-pau', 4, 'Florestas temperadas', 5, 'América do Norte', '2024-11-19 23:02:48', '2024-11-19 23:02:48'),
(16, 'Cavalo', 2, 'Pastagens', 15, 'Europa', '2024-11-19 23:02:48', '2024-11-19 23:02:48'),
(17, 'Águia', 5, 'Montanhas', 2, 'América do Norte', '2024-11-19 23:02:48', '2024-11-19 23:02:48'),
(18, 'Morcego', 5, 'Cavernas', 20, 'Mundo inteiro', '2024-11-19 23:02:48', '2024-11-19 23:02:48'),
(19, 'Pinguim', 6, 'Antártica', 8, 'Antártida', '2024-11-19 23:02:48', '2024-11-19 23:02:48'),
(20, 'Golfinho', 6, 'Oceano', 12, 'Mundo inteiro', '2024-11-19 23:02:48', '2024-11-19 23:02:48'),
(21, 'Crocodilo', 1, 'Rios e pântanos', 3, 'África', '2024-11-19 23:02:48', '2024-11-19 23:02:48');

-- --------------------------------------------------------

--
-- Estrutura para tabela `animal_type`
--

CREATE TABLE `animal_type` (
  `id` int(11) NOT NULL,
  `diet` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `animal_type`
--

INSERT INTO `animal_type` (`id`, `diet`) VALUES
(1, 'Carnívoros'),
(2, 'Herbívoros'),
(3, 'Onívoros'),
(4, 'Frugívoros'),
(5, 'Insetívoros'),
(6, 'Piscívoros');

-- --------------------------------------------------------

--
-- Estrutura para tabela `maintenances`
--

CREATE TABLE `maintenances` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `animal_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `completed` tinyint(1) DEFAULT 0,
  `cost` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `maintenances`
--

INSERT INTO `maintenances` (`id`, `date`, `type`, `description`, `animal_id`, `employee_id`, `completed`, `cost`, `created_at`, `updated_at`) VALUES
(7, '2024-11-06', 'veterinario', 'cuidar dos leões', 7, 9, 1, 1000.00, '2024-11-21 19:13:23', '2024-11-21 19:13:55'),
(18, '2024-11-22', 'Veterinário', 'Revisão geral de saúde', 7, 3, 1, 500.00, '2024-11-21 21:42:04', '2024-11-21 21:42:04'),
(19, '2024-11-22', 'Limpeza', 'Higienização do habitat', 8, 1, 1, 200.00, '2024-11-21 21:42:04', '2024-11-24 17:54:00'),
(20, '2024-11-22', 'Manutenção', 'Reparação de cercado', 9, 2, 1, 800.00, '2024-11-21 21:42:04', '2024-11-21 21:42:04'),
(21, '2024-11-22', 'Alimentação', 'Compra de ração especial', 10, 10, 0, 300.00, '2024-11-21 21:42:04', '2024-11-21 21:42:04'),
(22, '2024-11-22', 'Veterinário', 'Aplicação de vacinas', 11, 3, 1, 600.00, '2024-11-21 21:42:04', '2024-11-21 21:42:04'),
(23, '2024-11-22', 'Veterinário', 'Cirurgia de emergência', 12, 9, 1, 1200.00, '2024-11-21 21:42:04', '2024-11-21 21:42:04'),
(24, '2024-11-22', 'Limpeza', 'Troca de água do tanque', 13, 1, 0, 150.00, '2024-11-21 21:42:04', '2024-11-21 21:42:04'),
(25, '2024-11-22', 'Reparação', 'Substituição de vidro', 14, 2, 0, 900.00, '2024-11-21 21:42:04', '2024-11-21 21:42:04'),
(26, '2024-11-22', 'Veterinário', 'Tratamento dentário', 15, 9, 1, 400.00, '2024-11-21 21:42:04', '2024-11-21 21:42:04'),
(27, '2024-11-22', 'Manutenção', 'Conserto de portão', 16, 2, 1, 750.00, '2024-11-21 21:42:04', '2024-11-21 21:42:04');

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `positions`
--

INSERT INTO `positions` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Zelador', 'faz a limpeza dos locais', '2024-11-17 10:46:37', '2024-11-17 23:06:02'),
(2, 'Mecânico', 'mantém e repara equipamentos e instalações no zoológico.', '2024-11-17 10:46:37', '2024-11-17 23:07:22'),
(3, 'Veterinário', 'Um veterinário de zoológico cuida da saúde e bem-estar dos animais, realizando exames, diagnósticos e tratamentos médicos.', '2024-11-17 10:46:37', '2024-11-17 23:07:48'),
(4, 'Cuidador', 'responsável por alimentar, limpar e monitorar os animais', '2024-11-17 10:46:37', '2024-11-17 23:08:20'),
(5, 'admin', 'responsável pela gestão das operações diárias, incluindo o orçamento, pessoal e coordenação de programas e eventos.', '2024-11-17 10:46:37', '2024-11-17 23:08:52'),
(9, 'teste', NULL, '2024-11-21 19:05:14', '2024-11-21 19:05:14');

-- --------------------------------------------------------

--
-- Estrutura para tabela `stock_categories`
--

CREATE TABLE `stock_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT 'Não tem descrição',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `stock_categories`
--

INSERT INTO `stock_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Alimentos', 'Alimentos para os animais', '2024-11-17 10:46:37', '2024-11-20 07:32:48'),
(2, 'Medicamento', 'Medicamentos e vacinas', '2024-11-17 10:46:37', '2024-11-20 07:32:48'),
(3, 'Limpeza', 'Produtos de limpeza', '2024-11-17 10:46:37', '2024-11-20 07:32:48'),
(4, 'Habitat', 'Materiais para habitat', '2024-11-17 10:46:37', '2024-11-20 07:32:48'),
(5, 'Educação', 'Materiais educativos', '2024-11-17 10:46:37', '2024-11-20 07:32:48'),
(6, 'Vestuário', 'Roupas para os funcionários', '2024-11-17 10:46:37', '2024-11-20 07:32:48'),
(7, 'Manutenção', 'Ferramentas e suprimentos de manutenção', '2024-11-17 10:46:37', '2024-11-20 07:32:48'),
(8, 'Segurança', 'Equipamentos de segurança', '2024-11-17 10:46:37', '2024-11-20 07:32:48'),
(9, 'Outros', 'Outros suprimentos diversos', '2024-11-17 10:46:37', '2024-11-20 07:32:48');

-- --------------------------------------------------------

--
-- Estrutura para tabela `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `stores`
--

INSERT INTO `stores` (`id`, `name`, `amount`, `category`, `created_at`, `updated_at`) VALUES
(22, 'Ração para felinos', 50, 1, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(23, 'Ração para herbívoros', 30, 1, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(24, 'Vacinas diversas', 20, 2, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(25, 'Sacos de serragem', 100, 3, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(26, 'Cascalho para tanque', 200, 4, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(27, 'Livros educativos', 15, 5, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(28, 'Uniformes de inverno', 25, 6, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(29, 'Kit de primeiros socorros', 10, 7, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(30, 'Trancas para portões', 40, 8, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(31, 'Barras de ferro', 80, 7, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(32, 'Comedouros', 15, 4, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(33, 'Potes para água', 25, 4, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(34, 'Areia higiênica', 300, 3, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(35, 'Medicamentos especiais', 10, 2, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(36, 'Feno para cavalos', 40, 1, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(37, 'Cordas de segurança', 20, 7, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(38, 'Cadeiras dobráveis', 10, 5, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(39, 'Luvas de proteção', 50, 6, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(40, 'Lâmpadas de aquecimento', 30, 4, '2024-11-21 21:49:27', '2024-11-21 21:49:27'),
(41, 'Placas de identificação', 50, 8, '2024-11-21 21:49:27', '2024-11-21 21:49:27');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(125) NOT NULL,
  `cpf` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `position` varchar(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `cpf`, `email`, `phone`, `birth`, `position`, `created_at`, `updated_at`) VALUES
(5, 'Paulo Manuel', '$2y$12$8TH.qYPxtHA.5wIMa3H2N.SjM1F/95HswhdUvpV.6N2iDVvIZYLv.', NULL, 'paulo.cordeiro6@aluno.ce.gov.br', NULL, NULL, '1', '2024-11-21 17:10:11', '2024-11-21 14:10:40'),
(1, 'admin', '$2y$12$i/usBMJmzTchn7F4OM8l4O0HJukYc5AvmtuOK5t5YXkvkds4m5tIa', NULL, 'admin@admin', NULL, NULL, '1', '2024-11-20 11:49:21', '2024-11-20 20:18:18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `workers`
--

CREATE TABLE `workers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `hire_date` date NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `workers`
--

INSERT INTO `workers` (`id`, `name`, `position_id`, `email`, `phone`, `hire_date`, `created_at`, `updated_at`) VALUES
(1, 'João Silva', 1, 'joao.silva@email.com', '1234-5678', '2020-01-15', '2024-11-17 10:46:37', '2024-11-17 10:46:37'),
(2, 'Carlos Santos', 2, 'carlos.santos@email.com', '2345-6789', '2019-04-22', '2024-11-17 10:46:37', '2024-11-17 10:46:37'),
(3, 'Maria Oliveira', 3, 'maria.oliveira@email.com', '3456-7890', '2018-03-22', '2024-11-17 10:46:37', '2024-11-17 10:46:37'),
(6, 'paulo manuel', 5, 'paulo@gmail.com', '1234-5678', '2024-11-20', '2024-11-20 01:03:31', '2024-11-20 01:03:42'),
(9, 'vettel', 3, 'vettelVoltapff@gmail.com', '2039-3896', '2024-11-26', '2024-11-20 02:13:10', '2024-11-20 02:23:19'),
(10, 'teste', 4, 'teste@gmail', '1234-5678', '2024-11-21', '2024-11-21 20:18:57', '2024-11-21 20:18:57'),
(11, 'teste1', 9, 'teste@teste1', '2345-3456', '2024-11-21', '2024-11-21 20:19:26', '2024-11-21 20:19:26');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_diet` (`diet`);

--
-- Índices de tabela `animal_type`
--
ALTER TABLE `animal_type`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `maintenances`
--
ALTER TABLE `maintenances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_animal` (`animal_id`),
  ADD KEY `fk_employee` (`employee_id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `stock_categories`
--
ALTER TABLE `stock_categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`category`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Índices de tabela `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_position` (`position_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `animal_type`
--
ALTER TABLE `animal_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `maintenances`
--
ALTER TABLE `maintenances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `stock_categories`
--
ALTER TABLE `stock_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `fk_animal_diet` FOREIGN KEY (`diet`) REFERENCES `animal_type` (`id`);

--
-- Restrições para tabelas `maintenances`
--
ALTER TABLE `maintenances`
  ADD CONSTRAINT `fk_maintenances_animal` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`id`),
  ADD CONSTRAINT `fk_maintenances_worker` FOREIGN KEY (`employee_id`) REFERENCES `workers` (`id`);

--
-- Restrições para tabelas `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `fk_store_category` FOREIGN KEY (`category`) REFERENCES `stock_categories` (`id`);

--
-- Restrições para tabelas `workers`
--
ALTER TABLE `workers`
  ADD CONSTRAINT `fk_employee_position` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
