CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_temporary_user` smallint(6) DEFAULT 0,
  `token` varchar(255) DEFAULT NULL,
  `token_expired_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;