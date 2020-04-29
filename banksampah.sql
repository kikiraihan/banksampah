-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 19 Des 2019 pada 23.58
-- Versi Server: 10.1.43-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.1.33-3+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banksampah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2019_06_14_114625_create_permission_tables', 1),
(12, '2019_06_15_080233_create_nasabahs_table', 1),
(13, '2019_06_15_083827_create_sampahs_table', 1),
(14, '2019_06_15_084937_create_rewards_table', 1),
(15, '2019_06_15_094244_create_transaksi_sampahs_table', 1),
(16, '2019_06_15_134511_create_transaksi_rewards_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 7),
(1, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nasabahs`
--

CREATE TABLE `nasabahs` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `ktp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dusun` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `nasabahs`
--

INSERT INTO `nasabahs` (`id`, `id_user`, `ktp`, `alamat`, `dusun`, `saldo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '370701082921227', '3821 Colten Pine Apt. 138\nNew Brennan, RI 68401-4646', 'sukabera', 3760, '2019-07-26 17:10:21', '2019-07-26 17:54:36', NULL),
(2, 3, '6011381678259480', '52831 Dach Skyway\nLake Fidel, MO 15858-4449', 'sukabangkit', 4000, '2019-07-26 17:10:21', '2019-07-26 17:49:26', NULL),
(3, 4, '2670101113659461', '79672 Nathanael Field Suite 412\nPort Sydneyburgh, IN 94626-2534', 'sukamaju', 3000, '2019-07-26 17:10:21', '2019-07-26 17:10:21', NULL),
(4, 5, '2396306168465101', '3262 Dayton Manors Apt. 733\nJaskolskifort, OR 82297-4831', 'sukamaju', 1000, '2019-07-26 17:10:22', '2019-07-26 17:10:22', NULL),
(5, 6, '4556493583821795', '606 Frankie Well\nKendrickborough, MT 49643', 'sukamaju', 1000, '2019-07-26 17:10:22', '2019-07-26 17:10:22', NULL),
(6, 8, '4916407609924388', '25310 Christophe Trace\nWest Mathew, HI 03117', 'sukamaju', 2000, '2019-07-26 17:10:22', '2019-07-26 17:10:22', NULL),
(7, 10, '4929594076150020', '28165 Gabriella Extension\nLehnermouth, IN 17812-0635', 'sukabangkit', 3000, '2019-07-26 17:10:22', '2019-07-26 17:10:22', NULL),
(8, 14, '912381237897', 'alamasidhiasdhanskjs adjadnjksad askdjnsajd', 'sukabera', 0, '2019-08-02 07:46:24', '2019-08-02 07:46:24', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rewards`
--

CREATE TABLE `rewards` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `point` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rewards`
--

INSERT INTO `rewards` (`id`, `nama`, `point`, `stock`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Beras 1 Kg', 60, 6, 'reward/Beras 1 Kg/2019-07-27 01:51:35.png', '2019-07-26 17:51:35', '2019-07-26 17:54:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2019-07-26 17:10:18', '2019-07-26 17:10:18'),
(2, 'Nasabah', 'web', '2019-07-26 17:10:18', '2019-07-26 17:10:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sampahs`
--

CREATE TABLE `sampahs` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `point` int(11) NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sampahs`
--

INSERT INTO `sampahs` (`id`, `nama`, `point`, `deskripsi`, `satuan`, `created_at`, `updated_at`) VALUES
(1, 'Botol kaca', 100, 'Pembungkus makanan ringan, plastik kemasan, dll', 'gram', '2019-07-26 17:10:22', '2019-07-26 17:10:22'),
(2, 'Botol kaca', 300, 'Botol sosro, fanta, cocacola, cocol aku bang, dan botol minuman lain.', 'gram', '2019-07-26 17:10:22', '2019-07-26 17:10:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_rewards`
--

CREATE TABLE `transaksi_rewards` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_nasabah` int(10) UNSIGNED NOT NULL,
  `id_reward` int(10) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_point` int(11) NOT NULL,
  `total_jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_rewards`
--

INSERT INTO `transaksi_rewards` (`id`, `id_nasabah`, `id_reward`, `status`, `total_point`, `total_jumlah`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'terkonfirmasi', 120, 2, '2019-07-26 17:51:57', '2019-07-26 17:51:57', NULL),
(2, 1, 1, 'terkonfirmasi', 120, 2, '2019-07-26 17:54:36', '2019-07-26 17:54:36', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_sampahs`
--

CREATE TABLE `transaksi_sampahs` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_nasabah` int(10) UNSIGNED NOT NULL,
  `id_sampah` int(10) UNSIGNED NOT NULL,
  `total_point` int(11) NOT NULL,
  `total_satuan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_sampahs`
--

INSERT INTO `transaksi_sampahs` (`id`, `id_nasabah`, `id_sampah`, `total_point`, `total_satuan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 1000, 10, '2019-07-26 17:49:26', '2019-07-26 17:49:26', NULL),
(2, 1, 1, 2000, 20, '2019-07-26 17:49:48', '2019-07-26 17:49:48', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `kategori` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `kategori`, `name`, `username`, `email`, `telepon`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nasabah', 'Kikis', 'lowell10', 'mohzulkiflikatili@gmail.com', '+6551225166555', '$2y$10$l2.WAx54Vm8S4.V0tDcLku0K9ua3oeUYsyRwmWj4M/ss54bJU5xai', 'kmyI49eStBI233Zlw4UxosWXwxWcTOamuIQFsOu0kwq5D7487TTYozqN4VTb', '2019-07-26 17:10:20', '2019-07-26 17:11:39'),
(2, 'Admin', 'admin', 'dernser', 'admin@gmail.com', '+7260272958196', '$2y$10$vEduHt6mK3OIFdXYX0ubfuyZI4eOmab.EbXI1psku6k4VNyw5xUq2', 'aS2bfyPR6J9BNNuQLEZ198T6P1dzSR0wAGQDQ2BRIO0YFYtPJYhFnnQkHJZ5', '2019-07-26 17:10:20', '2019-07-26 17:10:21'),
(3, 'Nasabah', 'Francesco Hickle', 'ziemann.vanessa', 'hunter00@example.org', '+4834237429041', '$2y$10$Ulr0MFs2yv4fctNMI61kYu2m670l7mJ.NlgcqLo4DC8XQKUwqTPN.', '2ftyHKFol1', '2019-07-26 17:10:20', '2019-07-26 17:10:20'),
(4, 'Nasabah', 'Brian Morar', 'dibbert.shanna', 'xsatterfield@example.net', '+9392972622007', '$2y$10$QSiCGCz3M.XZJV6FOzlQSOAnYBMrjHWTVxLWb3Q8Sy6i8qJckXFwS', 'l6cjGJCeAE', '2019-07-26 17:10:20', '2019-07-26 17:10:20'),
(5, 'Nasabah', 'Ms. Virginia Crooks IV', 'ryan.julie', 'stark.virginia@example.org', '+1080787579703', '$2y$10$caYM4MVhaGl4.hxx4X3DRuUHNZT3z.MBQ03hcWfwmruKw7uaOS6Zy', 'CZ9nnfFrxb', '2019-07-26 17:10:20', '2019-07-26 17:10:20'),
(6, 'Nasabah', 'Mr. Arnoldo Jerde V', 'ramona.ohara', 'aufderhar.josie@example.org', '+6209500600390', '$2y$10$cpn2uHwY42MhdtdpunlkSeX3YFt.FAQS46orQuI4QzMLCkv187QxW', 'ikaGur6ovn', '2019-07-26 17:10:20', '2019-07-26 17:10:20'),
(7, 'Admin', 'Geovanny Satterfield II', 'carol.steuber', 'cleora.baumbach@example.net', '+8117740135202', '$2y$10$jsBLeDvvCVztBR6ZpTb1e.vm1RHbvgEcg7DsjPyL8NPu0SaKbdcZK', 'lwYA3qd4n2', '2019-07-26 17:10:20', '2019-07-26 17:10:20'),
(8, 'Nasabah', 'Terrell Swaniawski', 'israel85', 'fadel.ollie@example.net', '+2252304968373', '$2y$10$kLhUVrQGBYBFcxfUrrl18OJvGc81SzE4eYyNQk85IXFnokcWbFzYy', 'z524GyJou1', '2019-07-26 17:10:20', '2019-07-26 17:10:20'),
(9, 'Admin', 'Quinton Baumbach', 'ifeil', 'mcdermott.declan@example.com', '+8010778128890', '$2y$10$yH6NvFVPmwte/NGYnpKeMepYdttAYbq9HXUcQA8KaFKmcN444ZBT2', 'KhPQrCKv92', '2019-07-26 17:10:20', '2019-07-26 17:10:20'),
(10, 'Nasabah', 'Jasper Mertz', 'gay74', 'reichel.jeremie@example.org', '+2476123792809', '$2y$10$1edcRWgS.kxN9tO98Kvil..pmaxfHR0wFLi2XEsS18wd2HTJ/2BHC', 'EA39R0vfal', '2019-07-26 17:10:20', '2019-07-26 17:10:20'),
(14, 'Nasabah', 'baru', 'baru', 'baru@gmail.com', '0821378912', '$2y$10$RGCwwy2U4DqM8PJxLesG1e1OBY.P0wAmisfyDfOwA7yFeIGxiVO3C', 'JsWxRiw2uiKTDUveEO9iHZqAJqSp6mOvxRU0T8SWYIJ3JGwRIbMD6TXKG8tm', '2019-08-02 07:46:24', '2019-08-02 07:46:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `nasabahs`
--
ALTER TABLE `nasabahs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nasabahs_ktp_unique` (`ktp`),
  ADD KEY `nasabahs_id_user_foreign` (`id_user`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rewards_nama_unique` (`nama`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sampahs`
--
ALTER TABLE `sampahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_rewards`
--
ALTER TABLE `transaksi_rewards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_rewards_id_nasabah_foreign` (`id_nasabah`),
  ADD KEY `transaksi_rewards_id_reward_foreign` (`id_reward`);

--
-- Indexes for table `transaksi_sampahs`
--
ALTER TABLE `transaksi_sampahs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_sampahs_id_nasabah_foreign` (`id_nasabah`),
  ADD KEY `transaksi_sampahs_id_sampah_foreign` (`id_sampah`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_telepon_unique` (`telepon`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `nasabahs`
--
ALTER TABLE `nasabahs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sampahs`
--
ALTER TABLE `sampahs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaksi_rewards`
--
ALTER TABLE `transaksi_rewards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaksi_sampahs`
--
ALTER TABLE `transaksi_sampahs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nasabahs`
--
ALTER TABLE `nasabahs`
  ADD CONSTRAINT `nasabahs_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_rewards`
--
ALTER TABLE `transaksi_rewards`
  ADD CONSTRAINT `transaksi_rewards_id_nasabah_foreign` FOREIGN KEY (`id_nasabah`) REFERENCES `nasabahs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_rewards_id_reward_foreign` FOREIGN KEY (`id_reward`) REFERENCES `rewards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_sampahs`
--
ALTER TABLE `transaksi_sampahs`
  ADD CONSTRAINT `transaksi_sampahs_id_nasabah_foreign` FOREIGN KEY (`id_nasabah`) REFERENCES `nasabahs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_sampahs_id_sampah_foreign` FOREIGN KEY (`id_sampah`) REFERENCES `sampahs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
