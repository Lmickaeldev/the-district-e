-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 18 avr. 2023 à 11:52
-- Version du serveur : 8.0.32-0ubuntu0.22.04.2
-- Version de PHP : 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `district_base`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `libelle`, `image`, `active`) VALUES
(1, 'Pizza', 'pizza_cat.jpg', 1),
(2, 'Burger', 'burger_cat.jpg', 1),
(3, 'Wraps', 'wrap_cat.jpg', 1),
(4, 'Pasta', 'pasta_cat.jpg', 1),
(5, 'Sandwich', 'sandwich_cat.jpg', 1),
(6, 'Asian Food', 'asian_food_cat.jpg', 0),
(7, 'Salade', 'salade_cat.jpg', 1),
(8, 'Veggie', 'veggie_cat.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int NOT NULL,
  `id_plat` int NOT NULL,
  `quantite` int NOT NULL,
  `total` float NOT NULL,
  `date_commande` datetime NOT NULL,
  `etat` int NOT NULL,
  `id_client` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `id_plat`, `quantite`, `total`, `date_commande`, `etat`, `id_client`) VALUES
(1, 1, 4, 16, '2020-11-30 03:52:43', 1, 1),
(2, 2, 2, 20, '2020-11-30 04:07:17', 1, 2),
(3, 2, 1, 10, '2020-11-30 01:35:34', 1, 3),
(4, 3, 1, 7, '2020-11-30 06:10:37', 1, 4),
(5, 4, 2, 8, '2020-11-30 06:40:21', 4, 5),
(6, 7, 1, 6, '2020-11-30 06:40:57', 2, 6),
(7, 3, 4, 20, '2021-07-20 07:06:06', 3, 7),
(8, 9, 4, 12, '2021-07-20 07:11:06', 1, 8);

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`id`, `nom`) VALUES
(1, 'livrée'),
(2, 'en preparation'),
(3, 'annulée'),
(4, 'en cours de livraison');

-- --------------------------------------------------------

--
-- Structure de la table `plats`
--

CREATE TABLE `plats` (
  `id` int NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `prix` float NOT NULL,
  `image` varchar(100) NOT NULL,
  `id_categorie` int NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `plats`
--

INSERT INTO `plats` (`id`, `libelle`, `description`, `prix`, `image`, `id_categorie`, `active`) VALUES
(1, 'District Burger', 'Burger composé d’un bun’s du boulanger, deux steaks de 80g (origine française), de deux tranches poitrine de porc fumée, de deux tranches cheddar affiné, salade et oignons confits. .', 8, 'hamburger.jpg', 2, 1),
(2, 'Pizza Bianca', 'Une pizza fine et croustillante garnie de crème mascarpone légèrement citronnée et de tranches de saumon fumé, le tout relevé de baies roses et de basilic frais.', 14, 'pizza-salmon.png', 1, 1),
(3, 'Buffalo Chicken Wrap', 'Du bon filet de poulet mariné dans notre spécialité sucrée & épicée, enveloppé dans une tortilla blanche douce faite maison.', 5, 'buffalo-chicken.webp', 3, 1),
(4, 'Cheeseburger', 'Burger composé d’un bun’s du boulanger, de salade, oignons rouges, pickles, oignon confit, tomate, d’un steak d’origine Française, d’une tranche de cheddar affiné, et de notre sauce maison.', 8, 'cheesburger.jpg', 2, 1),
(5, 'Spaghetti aux légumes', 'Un plat de spaghetti au pesto de basilic et légumes poêlés, très parfumé et rapide', 10, 'spaghetti-legumes.jpg', 4, 1),
(6, 'Salade César', 'Une délicieuse salade Caesar (César) composée de filets de poulet grillés, de feuilles croquantes de salade romaine, de croutons à l\'ail, de tomates cerise et surtout de sa fameuse sauce Caesar. Le tout agrémenté de copeaux de parmesan.', 7, 'cesar_salad.jpg', 7, 1),
(7, 'Pizza Margherita', 'Une authentique pizza margarita, un classique de la cuisine italienne! Une pâte faite maison, une sauce tomate fraîche, de la mozzarella Fior di latte, du basilic, origan, ail, sucre, sel & poivre...', 14, 'pizza-margherita.jpg', 1, 1),
(8, 'Courgettes farcies au quinoa et duxelles de champignons', 'Voici une recette équilibrée à base de courgettes, quinoa et champignons, 100% vegan et sans gluten!', 8, 'courgettes_farcies.jpg', 8, 1),
(9, 'Lasagnes', 'Découvrez notre recette des lasagnes, l\'une des spécialités italiennes que tout le monde aime avec sa viande hachée et gratinée à l\'emmental. Et bien sûr, une inoubliable béchamel à la noix de muscade.\n\n', 12, 'lasagnes_viande.jpg\n', 4, 1),
(10, 'Tagliatelles au saumon', 'Découvrez notre recette délicieuse de tagliatelles au saumon frais et à la crème qui qui vous assure un véritable régal!  \n\n', 12, 'tagliatelles_saumon.webp\n', 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `privilleges` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `nom`, `privilleges`) VALUES
(1, 'admin', 1),
(2, 'client', 4);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adesse` text NOT NULL,
  `num` varchar(10) NOT NULL,
  `mail` varchar(150) NOT NULL,
  `inscription` datetime NOT NULL,
  `pass` varchar(100) NOT NULL,
  `role_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `adesse`, `num`, `mail`, `inscription`, `pass`, `role_id`) VALUES
(1, 'dillard', 'kelly', '308 Post Avenue', '7896547800', 'kelly@gmail.com', '2020-11-30 03:52:43', '55b7d29cb81b58fc3df2e7a2b76d3483', '4'),
(2, 'Gilchrist', 'Thomas', '1277 Sunburst Drive', '7410001450', 'thom@gmail.com', '2020-11-30 04:07:17', '55b7d29cb81b58fc3df2e7a2b76d3483', '4'),
(3, 'Woods', 'Martha', '478 Avenue Street', '7896547800', 'marthagmail.com', '2021-05-04 01:35:34', '55b7d29cb81b58fc3df2e7a2b76d3483', '4'),
(4, 'drolededame', 'charlie', '3140 Bartlett Avenue', '7896547800', 'charlie@gmail.com', '2021-07-20 06:10:37', '55b7d29cb81b58fc3df2e7a2b76d3483', '4'),
(5, 'hedley', 'Claudia', '1119 Kinney Street', '7896547800', 'hedley@gmail.com', '2021-07-20 06:40:21', '55b7d29cb81b58fc3df2e7a2b76d3483', '4'),
(6, 'vargas', 'vernon', '1234 Hazelwood Avenue', '7896547800', 'venno@gmail.com', '2021-07-20 06:40:57', '55b7d29cb81b58fc3df2e7a2b76d3483', '4'),
(7, 'grayson', 'carols', '2969 Hartland Avenue', '7896547800', 'carlos@gmail.com', '2021-07-20 07:06:06', '55b7d29cb81b58fc3df2e7a2b76d3483', '4'),
(8, 'caudill', 'jonathan', '1959 Limer Street', '7896547800', 'jonathan@gmail.com', '2020-11-30 03:52:43', '55b7d29cb81b58fc3df2e7a2b76d3483', '4');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `plats`
--
ALTER TABLE `plats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `plats`
--
ALTER TABLE `plats`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
