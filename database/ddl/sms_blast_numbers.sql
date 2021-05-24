CREATE TABLE `sms_blast_numbers` (
  `id` int(11) NOT NULL,
  `sms_blast_id` int(11) DEFAULT NULL,
  `mobile_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `sms_blast_numbers`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `sms_blast_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;