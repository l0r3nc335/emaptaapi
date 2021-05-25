CREATE TABLE `ticket_conversations` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_send` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `ticket_conversations`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `ticket_conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;