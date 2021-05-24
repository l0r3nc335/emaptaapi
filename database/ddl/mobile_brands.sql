CREATE TABLE `mobile_brands` (
  `id` int(11) DEFAULT NULL,
  `prefix` varchar(5) DEFAULT NULL,
  `brand` varchar(15) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `mobile_brands`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `mobile_brands`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
