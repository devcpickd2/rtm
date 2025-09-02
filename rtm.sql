-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2025 at 08:14 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rtm`
--

-- --------------------------------------------------------

--
-- Table structure for table `departemens`
--

CREATE TABLE `departemens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departemens`
--

INSERT INTO `departemens` (`id`, `uuid`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'a5544f26-ee76-4012-afa8-eaa40c1c4656', 'PDQC', '2025-08-25 03:00:49', '2025-08-25 03:00:49'),
(2, 'ca394a66-bd78-4f06-935f-8513ff4cfc9d', 'Produksi', '2025-08-25 03:00:59', '2025-08-25 03:00:59'),
(3, '9919bfc8-bbb5-4f91-a3e8-983630694417', 'Engineering', '2025-08-25 03:01:04', '2025-08-25 03:01:04'),
(4, '2e8f0bae-d598-48b9-b4d4-03e65be9a1c6', 'Warehouse', '2025-08-25 03:01:10', '2025-08-25 03:01:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gmps`
--

CREATE TABLE `gmps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `date` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `noodle_rice` longtext DEFAULT NULL,
  `cooking` longtext DEFAULT NULL,
  `packing` longtext DEFAULT NULL,
  `nama_produksi` varchar(255) DEFAULT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gmps`
--

INSERT INTO `gmps` (`id`, `uuid`, `date`, `username`, `username_updated`, `noodle_rice`, `cooking`, `packing`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '9fc53c1d-1a46-4b2b-abcd-6ef42e50bbcf', '2025-09-01', 'Putri', 'Harnis', '[{\"nama_karyawan\":\"Ardillah Jaelani\",\"seragam\":\"1\",\"boot\":\"0\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"}]', '[{\"nama_karyawan\":\"Ardillah Jaelani\",\"seragam\":\"0\",\"boot\":\"1\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"}]', '[{\"nama_karyawan\":\"Aliah\",\"seragam\":\"1\",\"boot\":\"0\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"},{\"nama_karyawan\":\"Anang Ma\'ruf\",\"seragam\":\"0\",\"boot\":\"1\",\"masker\":\"1\",\"ciput\":\"0\",\"parfum\":\"0\"},{\"nama_karyawan\":\"Ardillah Jaelani\",\"seragam\":\"1\",\"boot\":\"0\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"},{\"nama_karyawan\":\"Arsya\",\"seragam\":\"0\",\"boot\":\"1\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"},{\"nama_karyawan\":\"Awab Purnama\",\"seragam\":\"0\",\"boot\":\"0\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"1\"}]', 'Produksi RTM', '', NULL, NULL, NULL, NULL, NULL, '2025-09-01 02:44:19', '2025-09-01 02:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `institusis`
--

CREATE TABLE `institusis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `date` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `shift` varchar(255) NOT NULL,
  `jenis_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `waktu_proses_mulai` time NOT NULL,
  `waktu_proses_selesai` time NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `suhu_sebelum` float NOT NULL,
  `suhu_sesudah` float NOT NULL,
  `sensori` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) DEFAULT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `institusis`
--

INSERT INTO `institusis` (`id`, `uuid`, `date`, `username`, `username_updated`, `shift`, `jenis_produk`, `kode_produksi`, `waktu_proses_mulai`, `waktu_proses_selesai`, `lokasi`, `suhu_sebelum`, `suhu_sesudah`, `sensori`, `keterangan`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '9fc56349-027d-4dd3-a0ba-1a460bc98591', '2025-09-01', 'Putri', 'Harnis', '1', 'Spicy Chick', 'PG 10 101 AA0', '11:33:00', '00:33:00', 'Area Packing', 3, 2.1, 'Oke', 'yaaa', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-01 04:33:51', '2025-09-01 04:39:11');

-- --------------------------------------------------------

--
-- Table structure for table `kebersihan_ruangs`
--

CREATE TABLE `kebersihan_ruangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `date` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `pukul` time NOT NULL,
  `shift` varchar(255) NOT NULL,
  `rice_boiling` longtext DEFAULT NULL,
  `noodle` longtext DEFAULT NULL,
  `cr_rm` longtext DEFAULT NULL,
  `cs_1` longtext DEFAULT NULL,
  `cs_2` longtext DEFAULT NULL,
  `seasoning` longtext DEFAULT NULL,
  `prep_room` longtext DEFAULT NULL,
  `cooking` longtext DEFAULT NULL,
  `filling` longtext DEFAULT NULL,
  `topping` longtext DEFAULT NULL,
  `packing` longtext DEFAULT NULL,
  `iqf` longtext DEFAULT NULL,
  `cs_fg` longtext DEFAULT NULL,
  `ds` longtext DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) DEFAULT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kebersihan_ruangs`
--

INSERT INTO `kebersihan_ruangs` (`id`, `uuid`, `date`, `username`, `username_updated`, `pukul`, `shift`, `rice_boiling`, `noodle`, `cr_rm`, `cs_1`, `cs_2`, `seasoning`, `prep_room`, `cooking`, `filling`, `topping`, `packing`, `iqf`, `cs_fg`, `ds`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(7, '9fc145de-11c5-49db-b68d-97236b1f0168', '2025-08-30', 'Putri', 'Harnis', '10:23:00', '1', '{\"jam\":\"01:23\",\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Berdebu\",\"masalah\":\"zc\",\"tindakan\":\"zc\"},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":\"zc\",\"tindakan\":\"zc\"},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Pecah\\/retak\",\"masalah\":\"zc\",\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":\"zx\",\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Sisa produksi\",\"masalah\":\"zcx\",\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rice Washer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Rice Filling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Rice Cooker\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Line Conveyor\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Boiling, Washing, Cooling Shock Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":\"11:24\",\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Mikroorganisme\",\"masalah\":\"zasc\",\"tindakan\":\"zsc\"},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Basah\",\"masalah\":\"zc\",\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vacuum Mixer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Aging Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Roller Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Cutting & Slitting\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Pemisahan Allergen dan Non Allergen\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Terdapat Tagging\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vegetable Washing Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Slicer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Peeling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Vacuum Tumbler\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '[{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Alco Cooking Mixer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Tilting Kettle\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Exhaust\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Stir Fryer (Provisur)\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Steamer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Bowl Cutter\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}]', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Filling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Vacuum Cooling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Sealer 1\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Sealer 2\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Filler Manual 1\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Filler Manual 2\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Packing Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Tray Sealer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Metal Detector & Rejector\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"X-Ray Detector & Rejector\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Line Conveyor\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Inkjet Printer Plastic\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":\"03:46\",\"0\":{\"lokasi\":\"Dinding Luar\",\"kondisi\":\"Pecah\\/retak\",\"masalah\":\"sfd\",\"tindakan\":\"sdf\"},\"1\":{\"lokasi\":\"Dinding Dalam\",\"kondisi\":\"Basah\",\"masalah\":\"sdf\",\"tindakan\":\"sdf\"},\"2\":{\"lokasi\":\"Ruang Dalam IQF\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Conveyor IQF\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Terdapat Tagging\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', 'asdasd', 'Produksi RTM', '', NULL, NULL, NULL, NULL, NULL, '2025-08-30 03:28:16', '2025-08-30 03:46:34'),
(8, '9fc145ed-dd72-4a26-95aa-aa6ae95ae798', '2025-08-30', 'Putri', 'Harnis', '10:28:00', '1', '{\"jam\":\"01:08\",\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Berdebu\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rice Washer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Rice Filling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Rice Cooker\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Line Conveyor\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Boiling, Washing, Cooling Shock Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":\"02:08\",\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Pecah\\/retak\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vacuum Mixer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Aging Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Roller Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Cutting & Slitting\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Pemisahan Allergen dan Non Allergen\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Terdapat Tagging\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vegetable Washing Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Slicer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Peeling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Vacuum Tumbler\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '[{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Alco Cooking Mixer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Tilting Kettle\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Exhaust\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Stir Fryer (Provisur)\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Steamer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Bowl Cutter\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}]', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Filling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Vacuum Cooling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Sealer 1\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Sealer 2\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Filler Manual 1\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Filler Manual 2\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Packing Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Tray Sealer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Metal Detector & Rejector\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"X-Ray Detector & Rejector\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Line Conveyor\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Inkjet Printer Plastic\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Dinding Luar\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding Dalam\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Ruang Dalam IQF\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Conveyor IQF\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Terdapat Tagging\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', NULL, 'Produksi RTM', '', NULL, NULL, NULL, NULL, NULL, '2025-08-30 03:28:27', '2025-08-30 04:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_07_14_023149_create_produk_table', 1),
(6, '2025_07_14_023447_create_produks_table', 1),
(7, '2025_07_14_031844_create_suhus_table', 1),
(8, '2025_07_14_042251_create_departemens_table', 1),
(9, '2025_08_25_071729_ad_uuid_to_departemens_table', 1),
(10, '2025_08_25_075937_add_uuid_to_users_table', 1),
(11, '2025_08_25_081500_add_uuid_to_produks_table', 1),
(12, '2025_08_25_084114_add_extra_fields_to_users_table', 1),
(13, '2025_08_25_085022_update_users_table_add_constraints', 1),
(14, '2025_08_25_095513_create_plants_table', 2),
(15, '2025_08_28_072233_create_sanitasis_table', 3),
(16, '2025_08_29_102622_create_kebersihan_ruang_table', 4),
(17, '2025_08_29_103447_create_kebersihan_ruangs_table', 5),
(18, '2025_08_30_111605_create_produksi_table', 6),
(19, '2025_08_30_112224_create_produksis_table', 7),
(20, '2025_08_30_112807_create_produksis_table', 8),
(21, '2025_08_30_120005_create_gmps_table', 9),
(22, '2025_09_01_100630_create_premixs_table', 10),
(23, '2025_09_01_105103_create_institusis_table', 11),
(24, '2025_09_01_114259_create_timbangans_table', 12),
(25, '2025_09_01_143741_create_thermometers_table', 13),
(26, '2025_09_01_153325_create_sortasis_table', 14),
(27, '2025_09_01_161515_create_thawings_table', 15),
(28, '2025_09_02_091935_create_yoshinoyas_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `plant` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`id`, `uuid`, `username`, `plant`, `created_at`, `updated_at`) VALUES
(1, 'fdaca613-7ab2-4997-8f33-686e886c867d', 'putri', 'Ready Meal Cikande', '2025-08-27 01:54:32', '2025-08-27 01:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `premixs`
--

CREATE TABLE `premixs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `date` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_premix` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `sensori` varchar(255) NOT NULL,
  `tindakan_koreksi` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) DEFAULT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `premixs`
--

INSERT INTO `premixs` (`id`, `uuid`, `date`, `username`, `username_updated`, `shift`, `nama_premix`, `kode_produksi`, `sensori`, `tindakan_koreksi`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(2, '9fc55345-3833-48fd-8855-8cc8bd6243e7', '2025-09-01', 'Putri', NULL, '1', 'SRJK A', 'PG 10 101 AA0', 'Oke', NULL, NULL, 'Produksi RTM', '', NULL, NULL, NULL, NULL, NULL, '2025-09-01 03:49:04', '2025-09-01 03:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `uuid`, `nama_produk`, `username`, `created_at`, `updated_at`) VALUES
(1, 'ddadddbf-742c-48b9-905b-bb788f45d25e', 'Fiesta Rice with Chicken Rendang', 'putri', '2025-08-27 20:27:36', '2025-08-27 20:27:36'),
(2, 'e27565be-8458-4f86-a483-cf0c701cdf33', 'Fiesta Rice with Beef Rendang', 'putri', '2025-08-27 20:28:07', '2025-08-27 20:28:07'),
(3, '4cb9ff6f-c40e-412a-8031-e776d9c4d01e', 'Fiesta Rice with Beef Bulgogi', 'putri', '2025-08-27 20:31:17', '2025-08-27 20:31:17'),
(4, '0f3232dd-99cf-48c2-af06-fdd663fc8147', 'Fiesta Rice with Beef Blackpepper', 'putri', '2025-08-29 03:24:29', '2025-08-29 03:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `produksis`
--

CREATE TABLE `produksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `nama_karyawan` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produksis`
--

INSERT INTO `produksis` (`id`, `uuid`, `nama_karyawan`, `area`, `created_at`, `updated_at`) VALUES
(2, '971291f7-7b62-462e-88e6-7836bb8a1dff', 'Aliah', 'Packing', '2025-09-01 01:56:29', '2025-09-01 01:56:29'),
(3, 'ef4ccd88-a257-4139-ac51-92e513d38a3b', 'Anang Ma\'ruf', 'Packing', '2025-09-01 01:56:42', '2025-09-01 01:56:42'),
(4, '42f77775-d520-4d49-b301-1eda7132490b', 'Ardillah Jaelani', 'Packing', '2025-09-01 01:56:58', '2025-09-01 01:56:58'),
(5, 'd2ab21d1-01e6-44a9-b0a0-2a2a8d9e2c60', 'Arsya', 'Packing', '2025-09-01 01:57:14', '2025-09-01 01:57:18'),
(6, '2511b458-a613-420d-a6e6-8e7311fd8cd0', 'Awab Purnama', 'Packing', '2025-09-01 01:57:28', '2025-09-01 02:06:11'),
(7, 'ba6cc54c-7593-4d8d-b75c-7e613823c61c', 'Ardillah Jaelani', 'Cooking', '2025-09-01 02:58:08', '2025-09-01 02:58:08'),
(8, '88ee84f7-814f-4c57-9f6a-46a05bdb877a', 'Ardillah Jaelani', 'Noodle & Rice', '2025-09-01 02:58:15', '2025-09-01 02:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `sanitasis`
--

CREATE TABLE `sanitasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `date` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `pukul` time NOT NULL,
  `shift` varchar(255) NOT NULL,
  `std_footbasin` varchar(255) NOT NULL,
  `std_handbasin` varchar(255) NOT NULL,
  `aktual_footbasin` varchar(255) DEFAULT NULL,
  `aktual_handbasin` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tindakan_koreksi` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) DEFAULT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sanitasis`
--

INSERT INTO `sanitasis` (`id`, `uuid`, `date`, `username`, `username_updated`, `pukul`, `shift`, `std_footbasin`, `std_handbasin`, `aktual_footbasin`, `aktual_handbasin`, `keterangan`, `tindakan_koreksi`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(5, '9fc754bd-114a-44a8-bed2-b426993dd288', '2025-09-02', 'Putri', NULL, '10:44:00', '1', '200', '50', 'uploads/footbasin/D6l0GbUFEN4j3NbysCxDNCq14kg0tlSMN16mQKby.jpg', 'uploads/handbasin/aYHAlXhjpeSK8wU7S9vjuf77hGguY8pDuAMAnKfK.jpg', NULL, NULL, NULL, 'Produksi RTM', '1', '2025-09-02 03:44:49', NULL, '0', NULL, '2025-09-02 03:44:49', '2025-09-02 03:44:49', '2025-09-02 03:44:49');

-- --------------------------------------------------------

--
-- Table structure for table `sortasis`
--

CREATE TABLE `sortasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `date` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_bahan` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `jumlah_bahan` varchar(255) DEFAULT NULL,
  `jumlah_sesuai` varchar(255) DEFAULT NULL,
  `jumlah_tidak_sesuai` varchar(255) DEFAULT NULL,
  `tindakan_koreksi` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) DEFAULT NULL,
  `status_produksi` varchar(255) DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sortasis`
--

INSERT INTO `sortasis` (`id`, `uuid`, `date`, `username`, `username_updated`, `shift`, `nama_bahan`, `kode_produksi`, `jumlah_bahan`, `jumlah_sesuai`, `jumlah_tidak_sesuai`, `tindakan_koreksi`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(2, '9fc5c558-43ef-414d-a5a7-b124e31062ab', '2025-09-01', 'Putri', 'Harnis', '1', 'Gula Merah', 'PF 23 101 AA0', '432', '12', '2', 'oke', 'yaa', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-01 09:08:02', '2025-09-01 09:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `suhus`
--

CREATE TABLE `suhus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `pukul` time NOT NULL,
  `shift` varchar(255) NOT NULL,
  `chillroom` float DEFAULT NULL,
  `cs_1` float DEFAULT NULL,
  `cs_2` float DEFAULT NULL,
  `anteroom_rm` float DEFAULT NULL,
  `seasoning_suhu` float DEFAULT NULL,
  `seasoning_rh` float DEFAULT NULL,
  `prep_room` float DEFAULT NULL,
  `cooking` float DEFAULT NULL,
  `filling` float DEFAULT NULL,
  `rice` float DEFAULT NULL,
  `noodle` float DEFAULT NULL,
  `topping` float DEFAULT NULL,
  `packing` float DEFAULT NULL,
  `ds_suhu` float DEFAULT NULL,
  `ds_rh` float DEFAULT NULL,
  `cs_fg` float DEFAULT NULL,
  `anteroom_fg` float DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) DEFAULT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nama_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `catatan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suhus`
--

INSERT INTO `suhus` (`id`, `uuid`, `username`, `username_updated`, `date`, `pukul`, `shift`, `chillroom`, `cs_1`, `cs_2`, `anteroom_rm`, `seasoning_suhu`, `seasoning_rh`, `prep_room`, `cooking`, `filling`, `rice`, `noodle`, `topping`, `packing`, `ds_suhu`, `ds_rh`, `cs_fg`, `anteroom_fg`, `keterangan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `catatan_spv`, `status_spv`, `tgl_update_spv`, `catatan`, `created_at`, `updated_at`) VALUES
(1, '02c80c0c-282a-489a-9c4e-88ae6eeaa877', 'Putri', NULL, '2025-08-28', '12:52:00', '1', 3.2, -18.9, -20.2, 9.2, 26, 86, 14.2, 28.5, 12, 23.5, 22, 10.2, 11.9, 22.5, 45.9, -18.7, 7, 'oke', 'Produksi RTM', '', '2025-08-29 03:18:42', NULL, NULL, NULL, '2025-08-29 03:19:43', 'oke aja', '2025-08-27 23:07:07', '2025-08-27 23:07:07'),
(3, '9fbdab78-208d-414f-8445-ce6f00e6fe6f', 'Putri', NULL, '2025-08-28', '15:28:00', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Produksi RTM', '', '2025-08-29 03:18:42', NULL, NULL, NULL, '2025-08-29 03:19:43', NULL, '2025-08-28 01:29:04', '2025-08-28 01:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `thawings`
--

CREATE TABLE `thawings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `date` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `kondisi_ruangan` varchar(255) NOT NULL,
  `jenis_produk` varchar(255) NOT NULL,
  `jumlah` float DEFAULT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `kondisi_produk` varchar(255) NOT NULL,
  `keterangan_kondisi` varchar(255) DEFAULT NULL,
  `suhu_ruangan` varchar(255) DEFAULT NULL,
  `mulai_thawing` time NOT NULL,
  `selesai_thawing` time NOT NULL,
  `kondisi_produk_setelah` varchar(255) DEFAULT NULL,
  `keterangan_kondisi_setelah` varchar(255) DEFAULT NULL,
  `jumlah_setelah` float DEFAULT NULL,
  `suhu_produk` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) DEFAULT NULL,
  `status_produksi` varchar(255) DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thawings`
--

INSERT INTO `thawings` (`id`, `uuid`, `date`, `username`, `username_updated`, `kondisi_ruangan`, `jenis_produk`, `jumlah`, `kode_produksi`, `kondisi_produk`, `keterangan_kondisi`, `suhu_ruangan`, `mulai_thawing`, `selesai_thawing`, `kondisi_produk_setelah`, `keterangan_kondisi_setelah`, `jumlah_setelah`, `suhu_produk`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '9fc5dd9a-4b0b-44f0-ab35-50518276de0d', '2025-09-01', 'Putri', 'Harnis', 'Oke', 'Spicy Chick', 120, 'PG 10 101 AA0', 'Oke', 'yes', '24.6', '07:15:00', '10:15:00', 'Oke', 'yaudah', 120, '5.4', 'okedeh', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-01 10:15:52', '2025-09-01 10:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `thermometers`
--

CREATE TABLE `thermometers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `date` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `shift` varchar(255) NOT NULL,
  `kode_thermometer` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `standar` varchar(255) NOT NULL,
  `waktu_tera` time NOT NULL,
  `hasil_tera` varchar(255) NOT NULL,
  `tindakan_koreksi` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) DEFAULT NULL,
  `status_produksi` varchar(255) DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thermometers`
--

INSERT INTO `thermometers` (`id`, `uuid`, `date`, `username`, `username_updated`, `shift`, `kode_thermometer`, `area`, `standar`, `waktu_tera`, `hasil_tera`, `tindakan_koreksi`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(2, '9fc5b28e-57c3-4d71-8f79-a589d0aac5c5', '2025-09-01', 'Putri', 'Harnis', '2', '101', 'Warehouse', '0.0', '15:15:00', '0.5', 'inkubasi', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-01 08:15:30', '2025-09-01 08:22:00'),
(3, '9fc5b425-59da-4674-a313-2ea9e1aefcce', '2025-09-01', 'Putri', NULL, '2', '101', 'Packing', '0.0', '15:19:00', '0.4', 'oke', 'oke', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-01 08:19:57', '2025-09-01 08:19:57');

-- --------------------------------------------------------

--
-- Table structure for table `timbangans`
--

CREATE TABLE `timbangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `date` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `shift` varchar(255) NOT NULL,
  `kode_timbangan` varchar(255) NOT NULL,
  `standar` varchar(255) NOT NULL,
  `waktu_tera` time NOT NULL,
  `hasil_tera` varchar(255) NOT NULL,
  `tindakan_perbaikan` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) DEFAULT NULL,
  `status_produksi` varchar(255) NOT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timbangans`
--

INSERT INTO `timbangans` (`id`, `uuid`, `date`, `username`, `username_updated`, `shift`, `kode_timbangan`, `standar`, `waktu_tera`, `hasil_tera`, `tindakan_perbaikan`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(2, '9fc59c42-03f6-4501-aa7d-91efa18fb96c', '2025-09-01', 'Putri', 'Harnis', '1', 'Jadever', '100000', '14:12:00', '100000.2', 'okee', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-01 07:13:09', '2025-09-01 07:30:08'),
(4, '9fc5aa92-116a-4859-b161-b1b3ce5dcb0b', '2025-09-01', 'Putri', 'Harnis', '1', 'Jadever', '150000', '14:52:00', '150000', 'ddd', 'sss', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-01 07:53:10', '2025-09-01 07:53:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `plant` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `type_user` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `yoshinoyas`
--

CREATE TABLE `yoshinoyas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `saus` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `suhu_pengukuran` varchar(255) NOT NULL,
  `brix` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `visco` varchar(255) DEFAULT NULL,
  `brookfield_sebelum` varchar(255) DEFAULT NULL,
  `brookfield_frozen` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_produksi` varchar(255) DEFAULT NULL,
  `status_produksi` varchar(255) DEFAULT NULL,
  `tgl_update_produksi` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yoshinoyas`
--

INSERT INTO `yoshinoyas` (`id`, `uuid`, `username`, `username_updated`, `date`, `saus`, `shift`, `kode_produksi`, `suhu_pengukuran`, `brix`, `salt`, `visco`, `brookfield_sebelum`, `brookfield_frozen`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '9fc78249-ee4d-4341-b270-f640eff8d524', 'Putri', 'Harnis', '2025-09-02', 'Yoshinoya', '1', 'PG 10 101 AA0', '30', '20', '12', '20', '26', '25', 'asda', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-02 05:52:11', '2025-09-02 05:57:23'),
(2, '9fc78525-3dee-4907-baba-48ee5cfce79b', 'Putri', NULL, '2025-09-02', 'Yoshinoya', '1', 'PG 10 101 AA0', '25.6', '38', '15', '80', '3000', '3000', 'oke', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-02 06:00:11', '2025-09-02 06:00:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departemens`
--
ALTER TABLE `departemens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departemens_uuid_unique` (`uuid`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gmps`
--
ALTER TABLE `gmps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gmps_uuid_unique` (`uuid`);

--
-- Indexes for table `institusis`
--
ALTER TABLE `institusis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `institusis_uuid_unique` (`uuid`);

--
-- Indexes for table `kebersihan_ruangs`
--
ALTER TABLE `kebersihan_ruangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kebersihan_ruangs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plants_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `plants_kode_unique` (`username`);

--
-- Indexes for table `premixs`
--
ALTER TABLE `premixs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `premixs_uuid_unique` (`uuid`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `produks_uuid_unique` (`uuid`);

--
-- Indexes for table `produksis`
--
ALTER TABLE `produksis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `produksis_uuid_unique` (`uuid`);

--
-- Indexes for table `sanitasis`
--
ALTER TABLE `sanitasis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sanitasis_uuid_unique` (`uuid`);

--
-- Indexes for table `sortasis`
--
ALTER TABLE `sortasis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sortasis_uuid_unique` (`uuid`);

--
-- Indexes for table `suhus`
--
ALTER TABLE `suhus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suhus_uuid_unique` (`uuid`);

--
-- Indexes for table `thawings`
--
ALTER TABLE `thawings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `thawings_uuid_unique` (`uuid`);

--
-- Indexes for table `thermometers`
--
ALTER TABLE `thermometers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `thermometers_uuid_unique` (`uuid`);

--
-- Indexes for table `timbangans`
--
ALTER TABLE `timbangans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `timbangans_uuid_unique` (`uuid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `yoshinoyas`
--
ALTER TABLE `yoshinoyas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `yoshinoyas_uuid_unique` (`uuid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departemens`
--
ALTER TABLE `departemens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gmps`
--
ALTER TABLE `gmps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `institusis`
--
ALTER TABLE `institusis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kebersihan_ruangs`
--
ALTER TABLE `kebersihan_ruangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `premixs`
--
ALTER TABLE `premixs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produksis`
--
ALTER TABLE `produksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sanitasis`
--
ALTER TABLE `sanitasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sortasis`
--
ALTER TABLE `sortasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suhus`
--
ALTER TABLE `suhus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `thawings`
--
ALTER TABLE `thawings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `thermometers`
--
ALTER TABLE `thermometers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `timbangans`
--
ALTER TABLE `timbangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yoshinoyas`
--
ALTER TABLE `yoshinoyas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
