CREATE TABLE `configurations` (
  `id` int(11) NOT NULL,
  `dinstar_url` varchar(100) DEFAULT NULL,
  `receive_ports` varchar(100) DEFAULT NULL,
  `globe_ports` varchar(100) DEFAULT NULL,
  `smart_ports` varchar(100) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `configurations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
