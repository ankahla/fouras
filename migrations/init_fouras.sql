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
(2, NULL, 2, 'vendor', 'vendor', 'kahla.anoir@gmail.com', 'kahla.anoir@gmail.com', 1, 'tda98zxnryoc8cokws84cow0400owcg', '$2y$13$7tBHHyMfeMMjtKthvB64Q.GhhdEh7UYK.D12pkvCw/M773Cr9BEAq', '2017-10-13 22:06:35', NULL, NULL, 'a:1:{i:0;s:11:"ROLE_VENDOR";}', 'Vendor first name', 'vendor last name', NULL, NULL, NULL, '369edf0d5672317500ad0bc09b22fb31.jpeg'),
(3, NULL, 2, 'John', 'john', 'hohn@demo.fr', 'hohn@demo.fr', 1, 's8k5xorzkdwcw00wcgksowcgokcwgo0', '$2y$13$s8k5xorzkdwcw00wcgksouyeqb4roRhtduD5WMEH8Ira7YNfVOsKC', '2017-10-08 13:22:26', NULL, NULL, 'a:1:{i:0;s:11:"ROLE_VENDOR";}', 'John', 'Travolta', NULL, NULL, NULL, '08657410177ef1ad67c2ee666c63bcf0.jpeg'),
(4, NULL, 1, 'couple', 'couple', 'test@test.fr', 'test@test.fr', 1, '5nyr0w6hgcwsow48w4040wscscsoss0', '$2y$13$6qyzbN6Z3aGwYCQX6axZZefNeEGP8zMZbfECzJvrz2vPqnY4IkUzK', '2017-10-08 13:51:35', NULL, NULL, 'a:1:{i:0;s:11:"ROLE_COUPLE";}', 'test', 'test', NULL, NULL, NULL, '1db62ca19e3c1e0ab68286e0d879839a.jpeg');

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

INSERT INTO `service` (`id`, `name`, `image`, `map_icon`) VALUES
(1, 'Wedding Cakes', 'cake-5f0741434e609.jpeg', 'party.png'),
(2, 'Wedding Dress', 'dress-5f06e4f76a714.png', 'love.png'),
(3, 'Wedding Photography', 'weddingstudioblogthepressuretoperform-5f07021302122.png', 'media.png'),
(4, 'Jewellery', 'jewelry-5f0702245b792.png', 'love.png'),
(5, 'Ceremony', 'cermony-5f07023201ce6.jpeg', 'music.png'),
(6, 'Clothing, Accessories & Makeup', 'coiffure-5f07024ad0418.jpeg', 'love.png'),
(7, 'Invites & Gift', 'gift-5f070258b90db.png', 'party.png'),
(8, 'Honeymoon', 'honeymoon-5f07026818db2.jpeg', 'love.png');

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
(17, 'http://facebook.com/imen.mabrouk', 'facebook'),
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

INSERT INTO `vendor` (`id`, `user_id`, `city_id`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `address`) VALUES
(1, 2, 2, 'Anouar', 'Kahla', 'kahla.anoir@gmail.com', null, null, null),
(2, 3, 15, 'Françoise', 'dupond', 'francoise@test.com', 0155875141, 0655875141, 'Avenue du grand combattant');


--
-- Contenu de la table `vendor_service`
--

INSERT INTO `vendor_service` (`id`, `service_id`, `vendor_id`, `city_id`, `capacity_id`, `title`, `phone`, `cost_min`, `cost_max`, `email`, `description`, `address`, `latitude`, `longitude`, `picture`, `youtube_video_id`) VALUES
(2, 2, 1, 2, 3, 'Robe soirée', null, 100.000, 900.000, 'kahla.anoir@gmail.com', 'Ma description nnnnnnn', 'adresse Béja ....', 35.6439601, 10.946793899999989, 'b769a6cc1110f05be334aceb47fa7657.jpeg', null),
(3, 1, 1, 13, 2, 'كعكة الحظ', +21673765987, 100.000, 900.000, 'kahla.anoir@gmail.com', 'كعكة الزفاف من الأشياء التي أصبحت ضرورية في الأعراس، حتى أن العروسين يختارانها قبل البدلة والفستان، ولكن كيف بدأ تقليد الكعك في حفلات الزفاف.

البعض قد يتفاجأ بأن تقليد كعكة الزفاف تطور كثيرا على مدار العصور ومع اختلاف الحضارات والشعوب، بدأ كل بلد في إضافة التقليد الخاص به إلى الكعكة حتى وصل في النهاية إلى الشكل الحالي.', 'mahdia rajich', 35.46754130000001, 11.042893100000015, 'e50cbc6ddeba4fc51bd95b141d2a5cac.jpeg', 'nYZyI8RsyI8'),
(6, 4, 1, 20, null, 'طقم ذهب مع الماس', null, 10.000, 1000.000, 'kahla.anoir@gmail.com', 'طقم ذهب مع الماس عيار 18', 'fil khlé', 36.82264264847827, 9.883527449609346, 'e8c5cdc5d74bb6c2be5eabfc0bbead52.jpeg', null),
(8, 6, 2, 23, null, 'Coiffure chez la bella', null, 10.000, 1000.000, null, 'Notre équipe de coiffeurs est à votre écoute et vous accueille dans un univers élégant & moderne. 100% urbain et ultra-connecté, votre salon est à la pointe des dernières tendances.', 'Adresse à tunis...', 36.80637856394347, 10.181928566934175, 'bc3e038e3d0db8e7f7403a74d0d60c72.png', 'rzX1KxC_x6o');


--
-- Contenu de la table `vendor_service_url`
--

INSERT INTO `vendor_service_url` (`id`, `url_id`, `vendor_service_id`) VALUES
(2, 19, 2),
(3, 20, 3),
(4, 21, 6),
(5, 22, 8);

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
(2, 'Mabrouk', 'Nouira', 'Imen', 'Mabrouk', 'imen.mabrouk@gmail.com', null, 96123123, 'Avenue 12 mars 4000');

--
-- Contenu de la table `husband`
--

INSERT INTO `husband` (`id`, `father_name`, `mother_name`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `address`) VALUES
(1, 'MUU', 'WSS', 'Anouar', 'Kahla', 'kahla.anouar@yahoo.f', '96754000', '96754000', 'test'),
(2, 'Radhouane', 'Sourour', 'Ahmed', 'Fkih', 'ahmed.fkih@gmail.com', null, 52678678, 'Rue de liberté 5000');

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
(3, 1, 'sdsdsd kjkjkhjgkjhg_________éà', 'Kahla', 'Anouar', 'kahla.anouar@yahoo.fr', '+216 96 754 000', NULL, NULL),
(5, 2, 'lazem tahdhar', 'Yosra', 'Snene', 'yosra.snene@gmail.com', 97123123, null, null);

--
-- Contenu de la table `budget`
--

INSERT INTO `budget` (`id`, `couple_id`, `service_id`) VALUES
(15, 1, 7),
(1, 2, 4),
(2, 1, 3),
(3, 2, 2),
(4, 2, 1),
(6, 2, 8),
(7, 2, 3),
(8, 2, 5);

--
-- Contenu de la table `budget_item`
--

INSERT INTO `budget_item` (`id`, `budget_id`, `name`, `estimated_amount`, `actuel_amount`, `paid_amount`) VALUES
(1, 1, 'Montre rolex', 500.000, 500.000, 500.000),
(2, 3, 'Robe de mariée chez la bella', 1400.000, 0.000, 0.000),
(3, 4, 'Gateau de mariage', 500.000, 500.000, 500.000),
(4, 1, 'Ringggg', 1500.000, 1500.000, 1500.000),
(6, 6, '2 Billets avion maldive', 1200.000, 1200.000, 1200.000),
(7, 6, '2 semaines Hotel', 3000.000, 3000.000, 3000.000),
(8, 7, 'Photographe professionnel', 600.000, 600.000, 600.000),
(9, 8, 'Soulatymiya', 2000.000, 2000.000, 2000.000);

--
-- Contenu de la table `subscription_plan`
--

INSERT INTO `subscription_plan` (`id`, `name`, `description`, `monthly_price`, `in_promotion`, `popular`) VALUES
(1, 'Gratuit', null, 0.000, 0, 0),
(2, 'Basique', null, 400.000, 0, 1),
(3, 'Professionnel', null, 1200.000, 1, 0);

--
-- Contenu de la table `subscription_feature`
--

INSERT INTO `subscription_feature` (`id`, `name`, `description`) VALUES
(1, '+100 abonnés sur la page facebook', null),
(2, 'Visibilité sur la page officielle de Fouras', null),
(3, 'Bannière promotionnel sur le site fouras.com', null),
(4, '+1000 abonnés sur page FB', null),
(5, 'Charte graphique (création de logo, brochures ...)', null),
(6, 'Insérer des produits sur la marketplace', null),
(7, 'Montage video', null),
(8, 'Plus d''abonnés (jusqu''à 100 000 abonnées par mois)', null);

--
-- Contenu de la table `subscription_plan_feature`
--

INSERT INTO `subscription_plan_feature` (`plan_id`, `feature_id`) VALUES
(1, 1),(1, 2),
(2, 1),(2, 2),(2, 3),(2, 4),(2, 5),
(3, 1),(3, 2),(3, 3),(3, 4),(3, 5),(3, 6),(3, 7),(3, 8);

--
-- Contenu de la table `subscription`
--

INSERT INTO `subscription` (`id`, `user_id`, `plan`, `monthly_price`, `created_at`, `updated_at`, `start_at`, `end_at`) VALUES
(1, 2, '{"plan": "Gratuit", "features": ["+100 abonnés sur page fb", "Visible sur page FB de Fouras"]}', 0.000, '2020-09-01 18:56:51', '2020-09-01 18:56:58', '2020-09-06 18:57:03', '2022-09-06 18:57:25');
