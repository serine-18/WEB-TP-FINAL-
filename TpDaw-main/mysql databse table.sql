step 1 :- 
create databse in phpmyadmin (user_prof)

step 2 :-

click on create table and then select sql on the top and copy and paste below code in the query.









CREATE TABLE `prof` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci