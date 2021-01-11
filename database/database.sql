-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 11 jan. 2021 à 15:28
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `my_base`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
                              `id` int(11) NOT NULL,
                              `name` varchar(99) NOT NULL,
                              `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'cat 1', 'Les objets inutiles'),
(2, 'cat 2', 'Les objets encore plus inutiles'),
(3, 'cat 3', 'Les objets qui sont trop inutiles');

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE `customers` (
                             `id` int(11) NOT NULL,
                             `first_name` varchar(99) NOT NULL,
                             `last_name` varchar(99) NOT NULL,
                             `adresse` varchar(200) NOT NULL,
                             `zip_code` int(11) NOT NULL,
                             `city` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `adresse`, `zip_code`, `city`) VALUES
(1, 'Chuck', 'Norris', '2 bis rue du slip', 63100, 'Issoire'),
(2, 'Charlize', 'Theron', '26 chemin de mon lit', 38000, 'Grenoble'),
(3, 'Ryan', 'Gosling', '610  Elm Street', 72300, 'Vermillon');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
                          `id` int(11) NOT NULL,
                          `number` int(11) NOT NULL,
                          `date` datetime NOT NULL,
                          `total` int(11) NOT NULL,
                          `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `number`, `date`, `total`, `customer_id`) VALUES
(1, 258258258, '2020-12-11 11:07:38', 120, 1),
(2, 123123123, '2020-12-09 11:07:38', 600, 1),
(3, 456456456, '2020-12-05 11:07:38', 150, 2),
(4, 789789789, '2020-12-06 11:07:38', 520, 2),
(5, 147147147, '2020-12-11 10:07:38', 600, 2);

-- --------------------------------------------------------

--
-- Structure de la table `order_product`
--

CREATE TABLE `order_product` (
                                 `order_id` int(11) NOT NULL,
                                 `product_id` int(11) NOT NULL,
                                 `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `quantity`) VALUES
(1, 1, 1),
(1, 3, 2),
(2, 12, 1),
(2, 9, 2),
(3, 2, 1),
(3, 10, 1),
(4, 4, 2),
(4, 13, 1),
(5, 1, 1),
(5, 11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
                            `id` int(11) NOT NULL,
                            `name` varchar(99) NOT NULL,
                            `description` text NOT NULL,
                            `price` float NOT NULL,
                            `weight` int(11) NOT NULL,
                            `quantity` int(11) NOT NULL,
                            `available` tinyint(1) NOT NULL,
                            `picture` varchar(255) NOT NULL,
                            `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `weight`, `quantity`, `available`, `picture`, `categorie_id`) VALUES
(1, 'Les bottes ouvertes', 'Promenez-vous avec élégance sous la pluie avec nos fameuses bottes ouvertes. Inutiles elles ne vous protègeront absolument pas.', 100, 1000, 10, 1, 'bottes.jpg', 1),
(2, 'L\'arrosoir arrosé', 'Notre arrosoir design est totalement inutile pour arroser vos plantes.', 100, 1000, 10, 1, 'arrosoir.jpg', 1),
(3, 'La rappe sans trou', 'Ne rappez pas votre fromage avec notre super rappe sans trou.', 10, 500, 1, 1, 'rappe.jpg', 1),
(4, 'Les tasses connectées', 'Grâce à nos tasses connectées, vous ne pourrez plus boire votre café chaque matin.', 10, 500, 1, 1, 'tasses.jpg', 1),
(5, 'Le bol percé', 'Avec ce bol percé, votre soupe va couler mais pas au fond de votre gosier.', 10, 500, 1, 0, 'bolperce.jpg', 1),
(6, 'La paille fermée', 'Avec notre paille fermée, vous pouvez toujours tenter d\'aspirer.', 10, 500, 1, 0, 'paille.jpg', 1),
(7, 'Les couverts cordes', 'Avec ces couverts totalement inutiles, vous passerez vos journées à essayer de manger.', 13, 500, 0, 1, 'couverts.jpg', 2),
(8, 'Les couverts chaînes', 'Cette version luxe des couverts inutiles, sont de très bonne facture.', 13, 500, 0, 1, 'couverts_2.jpg', 2),
(9, 'Le parapluie en béton', 'Notre tout nouveau modèle de parapluie en béton, vous ne pourrez plus vous abriter en cas de pluie.', 50, 1200, 2, 1, 'parapluie_beton.jpg', 2),
(10, 'Le skate tourne en rond', 'Avec notre skate tourne en rond, pas besoin d\'aller bien loin pour aller tout droit.', 50, 1200, 2, 1, 'skate.png', 2),
(11, 'Le verre à vin', 'Avec ce nouveau style de verre à vin, vous ne rentrerez plus jamais bourré, mais taché.', 500, 1200, 5, 1, 'verrevin.jpg', 3),
(12, 'La double pinte', 'Ici c\'est deux pour le prix d\'une, choisissez laquelle vous allez boire.', 500, 1200, 5, 1, 'doublepinte.jpg', 3),
(13, 'Les doubles flûtes', 'Avec ces verres de luxe, partagez un bon moment entre votre meilleur(e) ami(e) avec notre double flûte. N\'oubliez pas de trinquer.', 500, 1200, 5, 1, 'doubleflute.jpg', 3);

-- --------------------------------------------------------

--
-- Structure de la table `quality`
--

CREATE TABLE `quality` (
                           `id` int(11) NOT NULL,
                           `article_id` int(11) NOT NULL,
                           `quality` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quality`
--

INSERT INTO `quality` (`id`, `article_id`, `quality`) VALUES
(1, 9, 'légendaire'),
(2, 3, 'légendaire');

-- --------------------------------------------------------

--
-- Structure de la table `size`
--

CREATE TABLE `size` (
                        `id` int(11) NOT NULL,
                        `product_id` int(11) NOT NULL,
                        `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `size`
--

INSERT INTO `size` (`id`, `product_id`, `size`) VALUES
(1, 1, 38),
(2, 1, 40),
(3, 1, 42),
(4, 1, 44);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
    ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
    ADD PRIMARY KEY (`id`),
  ADD KEY `customers_id` (`customer_id`);

--
-- Index pour la table `order_product`
--
ALTER TABLE `order_product`
    ADD KEY `products_id` (`product_id`),
  ADD KEY `orders_id` (`order_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
    ADD PRIMARY KEY (`id`),
  ADD KEY `categories_id` (`categorie_id`);

--
-- Index pour la table `quality`
--
ALTER TABLE `quality`
    ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`);

--
-- Index pour la table `size`
--
ALTER TABLE `size`
    ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `customers`
--
ALTER TABLE `customers`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `quality`
--
ALTER TABLE `quality`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `size`
--
ALTER TABLE `size`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
    ADD CONSTRAINT `customers_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `order_product`
--
ALTER TABLE `order_product`
    ADD CONSTRAINT `orders_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
    ADD CONSTRAINT `categories_id` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `quality`
--
ALTER TABLE `quality`
    ADD CONSTRAINT `quality_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `products` (`id`);

--
-- Contraintes pour la table `size`
--
ALTER TABLE `size`
    ADD CONSTRAINT `size_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
