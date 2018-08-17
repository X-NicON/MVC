CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `hash` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- password 123123

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `hash`) VALUES
(1, 'Админ', 'admin@example.ru', '$2y$10$6ZbnNIu8x8pHPEgNMylqMOP3by0bAUo1kiP1GixizoMd8aulhruXe', 'xt5kNQbMOFfwPDl6nuP2uau6ExGPqKOP1CtuEw25nHujMHLCEjnCU5yMqIDyYjh7');
