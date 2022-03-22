-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.34-log - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando dados para a tabela sepulturareg.documentos: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
INSERT INTO `documentos` (`id`, `tipo_doc`, `imagem`, `nome`, `user_id`) VALUES
	(7, 1, 'storage/65688223880/16542220220311622ba8ee1b54a.jpg', 'Documento de Identificação Frente', 3),
	(11, 1, 'storage/92863727443/1003162022031562308e940e1d2.png', 'Documento de Identificação Frente', 4),
	(12, 1, 'storage/80426280644/10203320220315623092a16c816.png', 'Documento de Identificação Frente', 5),
	(13, 2, 'storage/65688223880/1108182022031562309dd212145.jpg', 'Documento de Identificação Verso', 3);
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;

-- Copiando dados para a tabela sepulturareg.failed_jobs: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Copiando dados para a tabela sepulturareg.migrations: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_03_04_084451_create_documentos_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando dados para a tabela sepulturareg.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Copiando dados para a tabela sepulturareg.personal_access_tokens: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Copiando dados para a tabela sepulturareg.users: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `Doc_Ident`, `CPF`, `celular`, `fixo`, `whats_tele`, `endereco`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`, `tipo`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'CRISTOVAO A GATTEI', 'gatteicristovao@gmail.com', '10.166.856', '009.515.508-29', '(31) 97348-3097', NULL, NULL, 'Rua Coronel Jairo Pereira', 320, NULL, 'Palmares', 'Belo Oriente', 'Minas Gerais', '31160560', 'A', NULL, '$2y$10$UDQrTDzC3M9r6h4Jwrb/zu73h0BODv3txC7Dd.kVfK1kNAsYJsCm6', NULL, '2022-03-08 16:05:34', '2022-03-08 16:05:34'),
	(2, 'CRISTOVAO A GATTEI', 'gatteicristovao@gmail.com', '10.166.856', '009.515.508-30', '(31) 97348-3097', NULL, NULL, NULL, NULL, NULL, NULL, 'Belo Oriente', 'Minas Gerais', '31160560', 'U', NULL, '$2y$10$jk.sl6q9PDOBElKfsVqaIuu.eBTQ0ZmsN1CdJ.wghbuY56ce.OJcm', NULL, '2022-03-08 16:14:12', '2022-03-08 16:14:12'),
	(3, 'Teste de Formulário', 'gatteicristovao@gmail.com', '10.166.856', '656.882.238-80', '(31) 97332-3488', NULL, '(31) 97332-3488', 'Av Cristiano Machado', 320, 'Casa', 'Palmares', 'Belo Horizonte', 'Minas Gerais', '31160560', 'U', NULL, '$2y$10$S.cPk2/ZQY5N4HOp/Yb4MutbF8BckQX6TfZbsz8xzrndHLpzgzv8S', NULL, '2022-03-11 16:53:54', '2022-03-11 16:53:54'),
	(4, 'Teste de Segunda Feira', 'gattei.cristovao@gmail.com', '10166856', '928.637.274-43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'U', NULL, '$2y$10$v8WNCu2BHUzSSHxg2PoZSOr4AGU7InbTvDduaI7A18FaC7v5szoJe', NULL, '2022-03-14 10:17:15', '2022-03-14 10:17:15'),
	(5, 'Teste de Terça Feira', NULL, '10166856', '804.262.806-44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'U', NULL, '$2y$10$pLW8AYK09vt8823swvxEnO1DYTYwXwLI0nh1wJZ01.yK.6dzoaF3G', NULL, '2022-03-15 10:16:08', '2022-03-15 10:16:08');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
