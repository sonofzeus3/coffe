CREATE TABLE `menus` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(100) DEFAULT NULL,
 `description` text DEFAULT NULL,
 `price` decimal(10,2) DEFAULT NULL,
 `image` varchar(255) DEFAULT NULL,
 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(100) DEFAULT NULL,
 `email` varchar(100) DEFAULT NULL,
 `password` varchar(255) DEFAULT NULL,
 `role` enum('admin','customer') DEFAULT 'customer',
 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
 `status` enum('aktif','tidak aktif') NOT NULL DEFAULT 'aktif',
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

	CREATE TABLE `settings` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `store_name` varchar(255) NOT NULL,
 `store_address` varchar(255) NOT NULL,
 `store_phone` varchar(20) NOT NULL,
 `store_email` varchar(100) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

 KEY `order_id` (`order_id`),
 KEY `menu_id` (`menu_id`),
 CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
 CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci