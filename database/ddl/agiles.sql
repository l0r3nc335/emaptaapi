CREATE TABLE `agiles` (
  `id` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `agiles`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `agiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;



  INSERT INTO `agiles` (`id`, `description`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, 'Early and Continuous Delivery of Valuable Software', 'principle', current_timestamp(), current_timestamp(), NULL), (NULL, 'Embrace Change', 'principle', current_timestamp(), current_timestamp(), NULL);
