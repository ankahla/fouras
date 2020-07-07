--
-- Contenu de la table `city`
--

INSERT INTO `city` (`id`, `name`, `zipcode`) VALUES
(1, 'Ariana', ''),
(2, 'Béja', ''),
(3, 'Ben Arous', ''),
(4, 'Bizerte', ''),
(5, 'Gabès', ''),
(6, 'Gafsa', ''),
(7, 'Jendouba', ''),
(8, 'Kairouan', ''),
(9, 'Kasserine', ''),
(10, 'Kébili', ''),
(11, 'La Manouba', ''),
(12, 'Le Kef', ''),
(13, 'Mahdia', ''),
(14, 'Médenine', ''),
(15, 'Monastir', ''),
(16, 'Nabeul', ''),
(17, 'Sfax', ''),
(18, 'Sidi Bouzid', ''),
(19, 'Siliana', ''),
(20, 'Sousse', ''),
(21, 'Tataouine', ''),
(22, 'Tozeur', ''),
(23, 'Tunis', ''),
(24, 'Zaghouan', '');

--
-- Contenu de la table `user_group`
--

INSERT INTO `user_group` (`id`, `name`, `roles`) VALUES
(1, 'vendor', 'a:0:{}'),
(2, 'couple', 'a:0:{}'),
(3, 'test', 'a:0:{}');

--
-- Contenu de la table `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'couple'),
(2, 'vendor');

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `city_id`, `user_type_id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `first_name`, `last_name`, `address`, `phone`, `mobile`, `profile_picture`) VALUES
(1, NULL, 1, 'kahla', 'kahla', 'kahla.anouar@yahoo.fr', 'kahla.anouar@yahoo.fr', 1, '5fkmxei2w44cg00s4skkwc08w0kokgc', '$2y$13$5fkmxei2w44cg00s4skkwOkDMH8Yni7H5J47Jds.Mdbttpx73oZAG', '2017-10-13 13:57:53', NULL, NULL, 'a:2:{i:0;s:11:"ROLE_COUPLE";i:1;s:10:"ROLE_ADMIN";}', 'Anouar', 'Kahla', NULL, NULL, NULL, 'ce97372417e768c78d9691b444a5ed9d.png'),
(2, NULL, 2, 'vendor', 'vendor', 'kahla.anoir@gmail.com', 'kahla.anoir@gmail.com', 1, 'tda98zxnryoc8cokws84cow0400owcg', '$2y$13$7tBHHyMfeMMjtKthvB64Q.GhhdEh7UYK.D12pkvCw/M773Cr9BEAq', '2017-10-13 22:06:35', NULL, NULL, 'a:1:{i:0;s:11:"ROLE_VENDOR";}', 'Vendor first name', 'vendor last name', NULL, NULL, NULL, '3dd9885c20edb757eeab88d64f35a77b.jpeg'),
(3, NULL, 2, 'John', 'john', 'hohn@demo.fr', 'hohn@demo.fr', 1, 's8k5xorzkdwcw00wcgksowcgokcwgo0', '$2y$13$s8k5xorzkdwcw00wcgksouyeqb4roRhtduD5WMEH8Ira7YNfVOsKC', '2017-10-08 13:22:26', NULL, NULL, 'a:1:{i:0;s:11:"ROLE_VENDOR";}', 'John', 'Travolta', NULL, NULL, NULL, 'http://www.gravatar.com/avatar.php?gravatar_id=dab47db918f088950221e2cd0bc06999&default=&size=260'),
(4, NULL, 1, 'couple', 'couple', 'test@test.fr', 'test@test.fr', 1, '5nyr0w6hgcwsow48w4040wscscsoss0', '$2y$13$6qyzbN6Z3aGwYCQX6axZZefNeEGP8zMZbfECzJvrz2vPqnY4IkUzK', '2017-10-08 13:51:35', NULL, NULL, 'a:1:{i:0;s:11:"ROLE_COUPLE";}', 'test', 'test', NULL, NULL, NULL, '');

--
-- Contenu de la table `capacity`
--

INSERT INTO `capacity` (`id`, `name`) VALUES
(1, 'Under 50'),
(2, 'Between 50 and 100'),
(3, 'Between 100 and 200'),
(4, 'Between 200 and 500'),
(5, 'Between 500 and 1000'),
(6, 'Over 1000');

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`id`, `name`, `image`) VALUES
(1, 'Wedding Cakes', '/assets/images/vendor-categories-2.jpg'),
(2, 'Wedding Dress', '/bundles/front/images/vendor-categories-3.jpg'),
(3, 'Wedding Photography', 'bundles/front/images/vendor-categories-4.jpg'),
(4, 'Jewellery', NULL),
(5, 'Ceremony', NULL),
(6, 'Clothing, Accessories & Makeup', NULL),
(7, 'Invites & Gift', NULL),
(8, 'Honeymoon', NULL);

--
-- Contenu de la table `task`
--

INSERT INTO `task` (`id`, `user_id`, `title`, `description`, `date`, `created_at`, `updated_at`) VALUES
(5, 1, 'tache5', 'ma descriptionkkkkkkkkkkk', '2018-06-02', '2017-09-21 14:42:21', '2017-09-21 14:42:20'),
(7, 1, 'tache1', 'test testAAAAAAAAAAAAA', '2017-09-14', '2017-09-21 14:47:35', '2017-09-21 14:47:35'),
(13, 1, 'tach6', 'hello world', '2018-06-25', '2017-09-23 11:10:10', '2017-09-23 11:10:09'),
(14, 1, 'tach7', 'hello world2', '2018-06-25', '2017-09-23 11:10:33', '2017-09-23 11:10:33'),
(17, 1, 'test', 'test', '2012-01-01', '2017-09-23 11:20:00', '2017-09-23 11:20:00'),
(18, 1, 'test444', 'test444', '2012-01-01', '2017-09-23 11:23:00', '2017-09-23 11:23:00'),
(19, 1, 'test01', 'test', '2017-11-15', '2017-10-02 14:54:28', '2017-10-02 14:54:27'),
(20, 1, 'test', 'test', '2017-11-15', '2017-10-02 14:56:07', '2017-10-02 14:56:07'),
(21, 1, 'tache test', 'voyage', '2017-10-20', '2017-10-06 13:43:37', '2017-10-06 13:43:37'),
(22, 2, 'tache1', 'hello wahou', '2017-11-10', '2017-10-07 23:05:44', '2017-10-07 23:05:44');

--
-- Contenu de la table `url`
--

INSERT INTO `url` (`id`, `url`, `type`) VALUES
(12, 'http://test.fr', 'other'),
(13, 'http://facebook.com/kahla.anouar', 'facebook'),
(14, 'http://facebook.com/kahla.anouar', 'facebook'),
(16, 'http://test.Fr', 'facebook'),
(17, '', 'facebook'),
(18, NULL, 'youtube'),
(19, 'http://youtube.com', 'youtube'),
(20, NULL, NULL),
(21, NULL, NULL),
(22, NULL, NULL),
(23, NULL, 'youtube'),
(24, NULL, 'youtube');

--
-- Contenu de la table `vendor`
--

INSERT INTO `vendor` (`id`, `user_id`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `address`, `city_id`) VALUES
(1, 2, 'Anouar', 'Kahla', 'kahla.anoir@gmail.com', NULL, NULL, NULL, 2),
(2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Contenu de la table `vendor_service`
--

INSERT INTO `vendor_service` (`id`, `service_id`, `vendor_id`, `cost_min`, `cost_max`, `email`, `description`, `address`, `latitude`, `longitude`, `city_id`, `capacity_id`, `title`, `picture`) VALUES
(2, 1, 1, '1000.000', '2000.000', 'kahla.anoir@gmail.com', 'Ma description nnnnnnn', 'Téboulba', '35.6439601', '10.946793899999989', 2, 3, 'Dressing service', 'b7db5c3dc415fa0fe696c4d889ce6146.jpeg'),
(3, 1, NULL, '1000.000', '2000.000', 'kahla.anoir@gmail.com', NULL, 'mahdia rajich', '35.46754130000001', '11.042893100000015', 2, 2, 'test', '206c0d4331481377574b4003b05f93c1.gif'),
(4, 1, NULL, NULL, NULL, 'kahla.anoir@gmail.com', NULL, NULL, '34.2723275', '-118.02552129999998', 2, NULL, 'Test', '6d3e9e67962c6fed9ce53c9f1ea38392.gif'),
(5, 1, NULL, NULL, NULL, 'kahla.anoir@gmail.com', NULL, NULL, '34.2723275', '-118.02552129999998', 2, NULL, 'Test', '7a7724496209728d15763b6f42aface6.jpeg');

--
-- Contenu de la table `vendor_service_url`
--

INSERT INTO `vendor_service_url` (`id`, `url_id`, `vendor_service_id`) VALUES
(2, 19, 2),
(3, 20, 3),
(4, 21, 4),
(5, 22, 5);

--
-- Contenu de la table `vendor_url`
--

INSERT INTO `vendor_url` (`id`, `url_id`, `vendor_id`) VALUES
(7, 12, 1),
(8, 13, 1),
(10, 16, 1);

--
-- Contenu de la table `wife`
--

INSERT INTO `wife` (`id`, `father_name`, `mother_name`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `address`) VALUES
(1, 'MUUU', 'WSS', 'ANNN', 'Kahla', 'kahla.anouar@yahoo.f', '96754000', '(+00) 850 850 8899', '141, Street Name, Area Name, Town, Australia.'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Contenu de la table `husband`
--

INSERT INTO `husband` (`id`, `father_name`, `mother_name`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `address`) VALUES
(1, 'MUU', 'WSS', 'Anouar', 'Kahla', 'kahla.anouar@yahoo.f', '96754000', '96754000', 'test'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Contenu de la table `couple`
--

INSERT INTO `couple` (`id`, `user_id`, `husband_id`, `wife_id`, `city_id`, `wedding_date`) VALUES
(1, 1, 1, 1, 15, '2017-12-14'),
(2, 4, 2, 2, NULL, NULL);

--
-- Contenu de la table `couple_url`
--

INSERT INTO `couple_url` (`id`, `url_id`, `couple_id`) VALUES
(1, 14, 1),
(2, 17, 2);

--
-- Contenu de la table `guest`
--

INSERT INTO `guest` (`id`, `couple_id`, `description`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `address`) VALUES
(3, 1, 'sdsdsd kjkjkhjgkjhg_________éà', 'Kahla', 'Anouar', 'kahla.anouar@yahoo.fr', '+216 96 754 000', NULL, NULL);

--
-- Contenu de la table `budget_item`
--

INSERT INTO `budget_item` (`id`, `name`, `estimated_amount`, `actuel_amount`, `paid_amount`, `due_amount`, `budget_id`) VALUES
(3, 'Test3', '300.000', '0.000', '200.000', '0.000', 1),
(5, 'test5', '0.000', '0.000', '0.000', '0.000', 15),
(7, 'honey', '1000.000', '0.000', '0.000', '0.000', 6),
(10, 'kjkjjk', '0.000', '0.000', '0.000', '0.000', 1),
(11, 'rtrtrtrtrtrtrtr', '0.000', '0.000', '0.000', '0.000', 1),
(12, 'HELLO', '0.000', '0.000', '0.000', '0.000', 6),
(13, 'cvcvcv', '0.000', '0.000', '0.000', '0.000', 1);

--
-- Contenu de la table `budget`
--

INSERT INTO `budget` (`id`, `couple_id`, `service_id`) VALUES
(1, 1, 1),
(6, 1, 8),
(15, 1, 7);