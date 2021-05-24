CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `port` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `assigned_to` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;