-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2025 at 10:30 AM
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
-- Table structure for table `cold_storages`
--

CREATE TABLE `cold_storages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `pukul` time NOT NULL,
  `shift` varchar(255) NOT NULL,
  `suhu_cs` longtext DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_warehouse` varchar(255) DEFAULT NULL,
  `status_warehouse` varchar(255) DEFAULT NULL,
  `tgl_update_warehouse` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cold_storages`
--

INSERT INTO `cold_storages` (`id`, `uuid`, `username`, `username_updated`, `date`, `pukul`, `shift`, `suhu_cs`, `catatan`, `nama_warehouse`, `status_warehouse`, `tgl_update_warehouse`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(2, '019974da-37f1-7320-8709-49c38d3accc2', 'Putri', 'Harnis', '2025-09-23', '11:34:00', '1', '\"[{\\\"nama_produk\\\":\\\"Fiesta Rice with Chicken Rendang\\\",\\\"kode_produksi\\\":\\\"PH 22 101 AA0\\\",\\\"suhu_standar\\\":\\\"-19.4\\\",\\\"cek_1\\\":\\\"-18.1\\\",\\\"cek_2\\\":\\\"-18.2\\\",\\\"cek_3\\\":\\\"-18.3\\\",\\\"cek_4\\\":\\\"-18.6\\\",\\\"cek_5\\\":\\\"-18.4\\\",\\\"rata_rata\\\":\\\"-18.3\\\",\\\"keterangan\\\":\\\"xixixi\\\"},{\\\"nama_produk\\\":\\\"Fiesta Rice with Balinese Betutu Duck\\\",\\\"kode_produksi\\\":\\\"PH 22 101 AA0\\\",\\\"suhu_standar\\\":\\\"-18.7\\\",\\\"cek_1\\\":\\\"-18.4\\\",\\\"cek_2\\\":\\\"-18.6\\\",\\\"cek_3\\\":\\\"-18.7\\\",\\\"cek_4\\\":\\\"-18.2\\\",\\\"cek_5\\\":\\\"-18.4\\\",\\\"rata_rata\\\":\\\"-18.5\\\",\\\"keterangan\\\":\\\"sadnb\\\"}]\"', 'asda', 'Fikri', '1', NULL, NULL, '0', NULL, NULL, '2025-09-23 04:34:42', '2025-09-23 04:34:53'),
(3, '01997b13-0d84-71f5-aec2-7a1168c8cee4', 'admin', NULL, '2025-09-24', '16:34:00', '2', '\"[{\\\"nama_produk\\\":\\\"Fiesta RTS Chicken Rendang\\\",\\\"kode_produksi\\\":\\\"PH 22 101 AA0\\\",\\\"suhu_standar\\\":\\\"-18.3\\\",\\\"cek_1\\\":\\\"-18.4\\\",\\\"cek_2\\\":null,\\\"cek_3\\\":null,\\\"cek_4\\\":null,\\\"cek_5\\\":null,\\\"rata_rata\\\":\\\"-18.4\\\",\\\"keterangan\\\":null},{\\\"nama_produk\\\":\\\"Fiesta Rice with Beef Yakiniku\\\",\\\"kode_produksi\\\":\\\"PH 22 101 AA0\\\",\\\"suhu_standar\\\":\\\"-18.3\\\",\\\"cek_1\\\":\\\"-18.2\\\",\\\"cek_2\\\":null,\\\"cek_3\\\":null,\\\"cek_4\\\":null,\\\"cek_5\\\":null,\\\"rata_rata\\\":\\\"-18.2\\\",\\\"keterangan\\\":null}]\"', NULL, 'Fikri', '1', '2025-09-24 10:34:30', NULL, NULL, NULL, NULL, '2025-09-24 09:34:30', '2025-09-24 09:34:30');

-- --------------------------------------------------------

--
-- Table structure for table `cookings`
--

CREATE TABLE `cookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `sub_produk` varchar(255) DEFAULT NULL,
  `jenis_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `nama_mesin` longtext DEFAULT NULL,
  `pemasakan` longtext DEFAULT NULL,
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
-- Dumping data for table `cookings`
--

INSERT INTO `cookings` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `nama_produk`, `sub_produk`, `jenis_produk`, `kode_produksi`, `waktu_mulai`, `waktu_selesai`, `nama_mesin`, `pemasakan`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(7, '01994cb6-e633-7043-8cdc-b17525ebce8e', 'Putri', 'Harnis', '2025-09-15', '2', 'Fiesta Rice with Beef Bulgogi', 'Saus', 'RTS', 'PG 15 101 AA0', '16:30:00', '17:30:00', '[\"Provisur\",\"Kettle Api\"]', '[{\"pukul\":\"14:30\",\"tahapan\":\"Stirring\",\"jenis_bahan\":[\"Minyak Goreng\",null,null,null,null,null,null,null,null,null],\"kode_bahan\":[\"10.68.1.26\",null,null,null,null,null,null,null,null,null],\"jumlah_standar\":[\"100\",null,null,null,null,null,null,null,null,null],\"jumlah_aktual\":[\"100.5\",null,null,null,null,null,null,null,null,null],\"sensori\":[\"Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\"],\"lama_proses\":\"6\",\"paddle_on\":\"1\",\"paddle_off\":\"0\",\"pressure\":\"12\",\"temperature\":\"API 2-2.5\",\"target_temp\":\"95\",\"actual_temp\":\"26\",\"suhu_pusat\":\"97.5\",\"suhu_pusat_menit\":\"1\",\"warna\":\"Oke\",\"aroma\":\"Oke\",\"rasa\":\"Oke\",\"tekstur\":\"Oke\",\"catatan\":\"gaada\"},{\"pukul\":\"17:30\",\"tahapan\":\"Finish\",\"jenis_bahan\":[\"yaudah\",null,null,null,null,null,null,null,null,null],\"kode_bahan\":[null,null,null,null,null,null,null,null,null,null],\"jumlah_standar\":[null,null,null,null,null,null,null,null,null,null],\"jumlah_aktual\":[null,null,null,null,null,null,null,null,null,null],\"sensori\":[\"Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\"],\"lama_proses\":null,\"paddle_on\":\"0\",\"paddle_off\":\"0\",\"pressure\":null,\"temperature\":null,\"target_temp\":null,\"actual_temp\":null,\"suhu_pusat\":null,\"warna\":\"Tidak Oke\",\"aroma\":\"Tidak Oke\",\"rasa\":\"Tidak Oke\",\"tekstur\":\"Tidak Oke\",\"catatan\":null}]', 'Kkkk', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-15 09:31:18', '2025-09-19 07:30:38'),
(8, '019960d4-c62d-71e1-90d9-4107ab5a42e5', 'Putri', 'Harnis', '2025-09-19', '1', 'Fiesta RTS Beef Yakiniku', 'Saus', 'RTM', 'PF 23 101 BB0', '17:04:00', '18:04:00', '[\"Provisur\",\"Alco\"]', '[{\"pukul\":\"17:17\",\"tahapan\":\"Stiring & Cooking\",\"jenis_bahan\":[null,null,null,null,null,null,null,null,null,null],\"kode_bahan\":[null,null,null,null,null,null,null,null,null,null],\"jumlah_standar\":[null,null,null,null,null,null,null,null,null,null],\"jumlah_aktual\":[null,null,null,null,null,null,null,null,null,null],\"sensori\":[\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\"],\"lama_proses\":null,\"paddle_on\":\"0\",\"paddle_off\":\"0\",\"pressure\":null,\"temperature\":null,\"target_temp\":null,\"actual_temp\":null,\"suhu_pusat\":null,\"suhu_pusat_menit\":\"1\",\"warna\":\"Tidak Oke\",\"aroma\":\"Tidak Oke\",\"rasa\":\"Tidak Oke\",\"tekstur\":\"Tidak Oke\",\"catatan\":null},{\"pukul\":\"14:18\",\"tahapan\":\"Finish\",\"jenis_bahan\":[null,null,null,null,null,null,null,null,null,null],\"kode_bahan\":[null,null,null,null,null,null,null,null,null,null],\"jumlah_standar\":[null,null,null,null,null,null,null,null,null,null],\"jumlah_aktual\":[null,null,null,null,null,null,null,null,null,null],\"sensori\":[\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\",\"Tidak Oke\"],\"lama_proses\":null,\"paddle_on\":\"0\",\"paddle_off\":\"0\",\"pressure\":null,\"temperature\":null,\"target_temp\":null,\"actual_temp\":null,\"suhu_pusat\":null,\"suhu_pusat_menit\":\"1\",\"warna\":\"Tidak Oke\",\"aroma\":\"Tidak Oke\",\"rasa\":\"Tidak Oke\",\"tekstur\":\"Tidak Oke\",\"catatan\":null}]', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-19 07:16:21', '2025-09-19 07:19:42');

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
(1, 'a5544f26-ee76-4012-afa8-eaa40c1c4656', 'Quality Control', '2025-08-25 03:00:49', '2025-09-24 04:08:01'),
(2, 'ca394a66-bd78-4f06-935f-8513ff4cfc9d', 'Produksi', '2025-08-25 03:00:59', '2025-08-25 03:00:59'),
(3, '9919bfc8-bbb5-4f91-a3e8-983630694417', 'Engineering', '2025-08-25 03:01:04', '2025-08-25 03:01:04'),
(4, '2e8f0bae-d598-48b9-b4d4-03e65be9a1c6', 'Warehouse', '2025-08-25 03:01:10', '2025-08-25 03:01:10');

-- --------------------------------------------------------

--
-- Table structure for table `disposisis`
--

CREATE TABLE `disposisis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `jumlah` double NOT NULL,
  `ketidaksesuaian` varchar(255) DEFAULT NULL,
  `tindakan` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
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
(1, '9fc53c1d-1a46-4b2b-abcd-6ef42e50bbcf', '2025-09-01', 'Putri', 'Harnis', '[{\"nama_karyawan\":\"Ardillah Jaelani\",\"seragam\":\"1\",\"boot\":\"0\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"}]', '[{\"nama_karyawan\":\"Ardillah Jaelani\",\"seragam\":\"0\",\"boot\":\"1\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"}]', '[{\"nama_karyawan\":\"Aliah\",\"seragam\":\"1\",\"boot\":\"0\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"},{\"nama_karyawan\":\"Anang Ma\'ruf\",\"seragam\":\"0\",\"boot\":\"1\",\"masker\":\"1\",\"ciput\":\"0\",\"parfum\":\"0\"},{\"nama_karyawan\":\"Ardillah Jaelani\",\"seragam\":\"1\",\"boot\":\"0\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"},{\"nama_karyawan\":\"Arsya\",\"seragam\":\"0\",\"boot\":\"1\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"},{\"nama_karyawan\":\"Awab Purnama\",\"seragam\":\"0\",\"boot\":\"0\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"1\"}]', 'Produksi RTM', '1', NULL, NULL, NULL, NULL, NULL, '2025-09-01 02:44:19', '2025-09-01 02:58:53'),
(5, '01997b21-ce60-706d-858f-e93e72c19ace', '2025-09-24', 'admin', 'admin', '[{\"nama_karyawan\":\"Ardillah Jaelani\",\"seragam\":\"1\",\"boot\":\"1\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"}]', '[{\"nama_karyawan\":\"Ardillah Jaelani\",\"seragam\":\"0\",\"boot\":\"0\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"}]', '[{\"nama_karyawan\":\"Aliah\",\"seragam\":\"0\",\"boot\":\"0\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"},{\"nama_karyawan\":\"Anang Ma\'ruf\",\"seragam\":\"0\",\"boot\":\"0\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"},{\"nama_karyawan\":\"Ardillah Jaelani\",\"seragam\":\"0\",\"boot\":\"0\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"},{\"nama_karyawan\":\"Arsya\",\"seragam\":\"0\",\"boot\":\"0\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"},{\"nama_karyawan\":\"Awab Purnama\",\"seragam\":\"0\",\"boot\":\"0\",\"masker\":\"0\",\"ciput\":\"0\",\"parfum\":\"0\"}]', 'Khoerunnisa', '1', '2025-09-24 10:50:37', NULL, '0', NULL, NULL, '2025-09-24 09:50:37', '2025-09-24 09:50:37');

-- --------------------------------------------------------

--
-- Table structure for table `gramasis`
--

CREATE TABLE `gramasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `gramasi_topping` longtext DEFAULT NULL,
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
-- Dumping data for table `gramasis`
--

INSERT INTO `gramasis` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `nama_produk`, `kode_produksi`, `gramasi_topping`, `tindakan_koreksi`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '01994c9f-5833-73e2-bc15-2f38f4c166d5', 'Putri', 'Harnis', '2025-09-15', '2', 'Fiesta Rice with Beef Bulgogi', 'PF 23 101 BB0', '\"[{\\\"jenis_topping\\\":\\\"Saus\\\",\\\"standar\\\":\\\"50\\\",\\\"pukul_1\\\":\\\"18:05\\\",\\\"gramasi_1\\\":\\\"50.2\\\",\\\"pukul_2\\\":\\\"18:15\\\",\\\"gramasi_2\\\":\\\"52.1\\\",\\\"pukul_3\\\":null,\\\"gramasi_3\\\":null},{\\\"jenis_topping\\\":\\\"Daging\\\",\\\"standar\\\":\\\"65\\\",\\\"pukul_1\\\":\\\"18:05\\\",\\\"gramasi_1\\\":\\\"65.3\\\",\\\"pukul_2\\\":\\\"18:15\\\",\\\"gramasi_2\\\":\\\"67.2\\\",\\\"pukul_3\\\":null,\\\"gramasi_3\\\":null}]\"', NULL, 'cccc', 'Produksi RTM', '1', '2025-09-16 10:40:56', NULL, '0', NULL, NULL, '2025-09-15 09:05:35', '2025-09-16 10:40:56');

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
-- Table structure for table `iqfs`
--

CREATE TABLE `iqfs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `no_iqf` varchar(255) DEFAULT NULL,
  `pukul` time NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `std_suhu` varchar(255) DEFAULT NULL,
  `suhu_pusat` longtext DEFAULT NULL,
  `average` varchar(255) DEFAULT NULL,
  `problem` varchar(255) DEFAULT NULL,
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
-- Dumping data for table `iqfs`
--

INSERT INTO `iqfs` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `no_iqf`, `pukul`, `nama_produk`, `kode_produksi`, `std_suhu`, `suhu_pusat`, `average`, `problem`, `tindakan_koreksi`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(8, '01995213-9bd5-7145-9bac-62468b2d381a', 'Putri', NULL, '2025-09-18', '1', NULL, '19:30:00', 'Fiesta RTS Chicken Rendang', 'PH 07 101 AA0', '-18.0', '{\"1\":{\"value\":\"-18.6\",\"ket\":\"nasi\"},\"2\":{\"value\":\"-18.9\",\"ket\":\"daging\"},\"3\":{\"value\":\"-17.9\",\"ket\":\"saus\"},\"4\":{\"value\":\"-18.0\",\"ket\":\"Sayur\"},\"5\":{\"value\":null,\"ket\":null},\"6\":{\"value\":null,\"ket\":null},\"7\":{\"value\":null,\"ket\":null},\"8\":{\"value\":null,\"ket\":null},\"9\":{\"value\":null,\"ket\":null},\"10\":{\"value\":null,\"ket\":null}}', '-18.35', 'szdvfsd', 'afaf', 'safsa', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-16 10:30:40', '2025-09-18 03:56:18');

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
  `pukul` time DEFAULT NULL,
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
-- Dumping data for table `kebersihan_ruangs`
--

INSERT INTO `kebersihan_ruangs` (`id`, `uuid`, `date`, `username`, `username_updated`, `pukul`, `shift`, `rice_boiling`, `noodle`, `cr_rm`, `cs_1`, `cs_2`, `seasoning`, `prep_room`, `cooking`, `filling`, `topping`, `packing`, `iqf`, `cs_fg`, `ds`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(9, '0199507d-e6be-71c6-8c8c-0569cde92ad5', '2025-09-16', 'Putri', 'Harnis', NULL, '1', '{\"jam\":\"11:06\",\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bunga es\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rice Washer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Rice Filling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Rice Cooker\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Line Conveyor\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Boiling, Washing, Cooling Shock Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vacuum Mixer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Aging Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Roller Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Cutting & Slitting\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Pemisahan Allergen dan Non Allergen\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Terdapat Tagging\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vegetable Washing Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Slicer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Peeling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Vacuum Tumbler\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '[{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Alco Cooking Mixer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Tilting Kettle\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Exhaust\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Stir Fryer (Provisur)\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Steamer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},{\"lokasi\":\"Bowl Cutter\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}]', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Filling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Vacuum Cooling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Sealer 1\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Sealer 2\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Filler Manual 1\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Filler Manual 2\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Packing Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Tray Sealer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Metal Detector & Rejector\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"X-Ray Detector & Rejector\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Line Conveyor\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Inkjet Printer Plastic\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Dinding Luar\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding Dalam\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Ruang Dalam IQF\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Conveyor IQF\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Terdapat Tagging\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-16 03:07:32', '2025-09-16 03:15:40'),
(10, '0199507e-16b2-7071-977d-f20c6f293f3d', '2025-09-16', 'Putri', NULL, NULL, '1', '{\"jam\":\"00:07\",\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rice Washer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Rice Filling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Rice Cooker\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Line Conveyor\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Boiling, Washing, Cooling Shock Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vacuum Mixer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Aging Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Roller Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Cutting & Slitting\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Pemisahan Allergen dan Non Allergen\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Terdapat Tagging\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vegetable Washing Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Slicer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Peeling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Vacuum Tumbler\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Alco Cooking Mixer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Tilting Kettle\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Exhaust\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Stir Fryer (Provisur)\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Steamer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Bowl Cutter\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Filling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Vacuum Cooling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Sealer 1\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Sealer 2\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Filler Manual 1\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Filler Manual 2\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Packing Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Tray Sealer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Metal Detector & Rejector\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"X-Ray Detector & Rejector\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Line Conveyor\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Inkjet Printer Plastic\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Dinding Luar\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding Dalam\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Ruang Dalam IQF\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Conveyor IQF\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Terdapat Tagging\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-16 03:07:44', '2025-09-16 03:07:44'),
(11, '01997b19-7839-73b4-95fa-018433b633d6', '2025-09-24', 'admin', 'admin', NULL, '2', '{\"jam\":\"18:41\",\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rice Washer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Rice Filling Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Rice Cooker\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Line Conveyor\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Boiling, Washing, Cooling Shock Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vacuum Mixer\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Aging Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Roller Machine\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Cutting & Slitting\",\"kondisi\":\"Bersih\",\"masalah\":null,\"tindakan\":null},\"10\":{\"kondisi\":\"Bersih\"},\"11\":{\"kondisi\":\"Bersih\"},\"12\":{\"kondisi\":\"Bersih\"}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Pemisahan Allergen dan Non Allergen\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Terdapat Tagging\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Vegetable Washing Machine\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Slicer\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Peeling Machine\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Vacuum Tumbler\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Alco Cooking Mixer\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Tilting Kettle\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Exhaust\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Stir Fryer (Provisur)\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Steamer\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Bowl Cutter\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Filling Machine\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Vacuum Cooling Machine\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Sealer 1\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"Sealer 2\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Filler Manual 1\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Filler Manual 2\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"Saluran Air Buangan\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Packing Machine\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Tray Sealer\",\"masalah\":null,\"tindakan\":null},\"9\":{\"lokasi\":\"Metal Detector & Rejector\",\"masalah\":null,\"tindakan\":null},\"10\":{\"lokasi\":\"X-Ray Detector & Rejector\",\"masalah\":null,\"tindakan\":null},\"11\":{\"lokasi\":\"Line Conveyor\",\"masalah\":null,\"tindakan\":null},\"12\":{\"lokasi\":\"Inkjet Printer Plastic\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Dinding Luar\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding Dalam\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Ruang Dalam IQF\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Conveyor IQF\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null}}', '{\"jam\":null,\"0\":{\"lokasi\":\"Lantai\",\"masalah\":null,\"tindakan\":null},\"1\":{\"lokasi\":\"Dinding\",\"masalah\":null,\"tindakan\":null},\"2\":{\"lokasi\":\"Kurtain\",\"masalah\":null,\"tindakan\":null},\"3\":{\"lokasi\":\"Pintu\",\"masalah\":null,\"tindakan\":null},\"4\":{\"lokasi\":\"Langit-langit\",\"masalah\":null,\"tindakan\":null},\"5\":{\"lokasi\":\"AC\",\"masalah\":null,\"tindakan\":null},\"6\":{\"lokasi\":\"Rak Penampung Produk\",\"masalah\":null,\"tindakan\":null},\"7\":{\"lokasi\":\"Terdapat Tagging\",\"masalah\":null,\"tindakan\":null},\"8\":{\"lokasi\":\"Lampu dan Cover\",\"masalah\":null,\"tindakan\":null}}', NULL, 'Khoerunnisa', '1', '2025-09-24 10:41:30', NULL, '0', NULL, NULL, '2025-09-24 09:41:30', '2025-09-24 09:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `kontaminasis`
--

CREATE TABLE `kontaminasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `pukul` time NOT NULL,
  `jenis_kontaminasi` varchar(255) NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `tahapan` varchar(255) DEFAULT NULL,
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
-- Dumping data for table `kontaminasis`
--

INSERT INTO `kontaminasis` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `pukul`, `jenis_kontaminasi`, `bukti`, `nama_produk`, `kode_produksi`, `tahapan`, `tindakan_koreksi`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019931d8-4b47-7220-b36c-2647ed8a4a0b', 'Putri', 'Harnis', '2025-09-10', '1', '11:17:00', 'batu', 'uploads/kontaminasi/QoW5bVSxsPCrTaIh5HKjhe6QGu2zpiZOn1eHXFpi.jpg', 'Fiesta Rice with Beef Bulgogi', 'OL 19 101 AA0', 'sortir mp', 'reject', 'oke', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-10 04:18:02', '2025-09-10 06:12:18');

-- --------------------------------------------------------

--
-- Table structure for table `mesins`
--

CREATE TABLE `mesins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `verif_mesin` longtext DEFAULT NULL,
  `tindakan_perbaikan` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
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
-- Dumping data for table `mesins`
--

INSERT INTO `mesins` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `verif_mesin`, `tindakan_perbaikan`, `keterangan`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(2, '01997e80-3f36-7385-84dc-88d57ffa003c', 'Putri', NULL, '2025-09-25', '1', '\"[{\\\"nama_mesin\\\":\\\"Weigher Portioning\\\",\\\"standar_setting\\\":\\\"200\\\",\\\"aktual\\\":\\\"250\\\"},{\\\"nama_mesin\\\":\\\"Weigher Filling\\\",\\\"standar_setting\\\":\\\"300\\\",\\\"aktual\\\":\\\"400\\\"},{\\\"nama_mesin\\\":\\\"Topseal\\\",\\\"standar_setting\\\":\\\"200\\\",\\\"aktual\\\":\\\"150\\\"}]\"', NULL, NULL, NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-25 01:32:38', '2025-09-25 01:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `metals`
--

CREATE TABLE `metals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `no_program` varchar(255) NOT NULL,
  `pemeriksaan` longtext NOT NULL,
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
-- Dumping data for table `metals`
--

INSERT INTO `metals` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `nama_produk`, `kode_produksi`, `no_program`, `pemeriksaan`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(2, '019941a2-39fa-700c-a6e8-db7f226e82ab', 'Putri', 'Harnis', '2025-09-13', '1', 'Fiesta Rice with Chicken Rendang', 'PG10101AA0', '10', '\"[{\\\"pukul\\\":\\\"13:52\\\",\\\"fe\\\":\\\"Oke\\\",\\\"non_fe\\\":\\\"Oke\\\",\\\"sus_316\\\":\\\"Oke\\\",\\\"keterangan\\\":\\\"Terdeteksi\\\",\\\"tindakan_koreksi\\\":\\\"-\\\"},{\\\"pukul\\\":\\\"13:52\\\",\\\"fe\\\":\\\"Oke\\\",\\\"non_fe\\\":\\\"Oke\\\",\\\"sus_316\\\":\\\"Oke\\\",\\\"keterangan\\\":\\\"Terdeteksi\\\",\\\"tindakan_koreksi\\\":\\\"-\\\"},{\\\"pukul\\\":\\\"19:14\\\",\\\"fe\\\":\\\"Oke\\\",\\\"non_fe\\\":\\\"Oke\\\",\\\"sus_316\\\":\\\"Oke\\\",\\\"keterangan\\\":\\\"Terdeteksi\\\",\\\"tindakan_koreksi\\\":\\\"-\\\"}]\"', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-13 05:52:54', '2025-09-15 09:14:24'),
(3, '019941a4-cf6e-731a-a456-0da7f03c2c99', 'Putri', 'Harnis', '2025-09-13', '1', 'Fiesta Rice with Beef Rendang', 'OL19101AA0', '009', '\"[{\\\"pukul\\\":\\\"13:55\\\",\\\"fe\\\":\\\"Oke\\\",\\\"non_fe\\\":\\\"Oke\\\",\\\"sus_316\\\":\\\"Oke\\\",\\\"keterangan\\\":\\\"Terdeteksi\\\",\\\"tindakan_koreksi\\\":\\\"-\\\"},{\\\"pukul\\\":\\\"15:55\\\",\\\"fe\\\":\\\"Oke\\\",\\\"non_fe\\\":\\\"Oke\\\",\\\"sus_316\\\":\\\"Oke\\\",\\\"keterangan\\\":\\\"Terdeteksi\\\",\\\"tindakan_koreksi\\\":\\\"-\\\"}]\"', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-13 05:55:44', '2025-09-13 05:57:57');

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
(28, '2025_09_02_091935_create_yoshinoyas_table', 16),
(29, '2025_09_02_140326_create_steamers_table', 17),
(30, '2025_09_03_084935_create_rices_table', 18),
(31, '2025_09_04_094224_create_thumblings_table', 19),
(32, '2025_09_04_095055_create_thumblings_table', 20),
(33, '2025_09_08_100642_create_noodles_table', 21),
(34, '2025_09_09_134524_create_cookings_table', 22),
(35, '2025_09_10_102623_create_kontaminasis_table', 23),
(36, '2025_09_10_134110_create_xrays_table', 24),
(37, '2025_09_12_150556_create_metals_table', 25),
(38, '2025_09_12_154311_create_metals_table', 26),
(39, '2025_09_13_130520_create_tahapans_table', 27),
(40, '2025_09_15_144645_create_gramasis_table', 28),
(41, '2025_09_16_132110_create_iqfs_table', 29),
(42, '2025_09_17_100357_create_pengemasans_table', 30),
(43, '2025_09_17_173641_create_mesins_table', 31),
(44, '2025_09_18_135911_create_disposisis_table', 32),
(45, '2025_09_18_150154_create_repacks_table', 33),
(46, '2025_09_18_165145_create_falses_table', 34),
(47, '2025_09_18_165630_create_rejects_table', 35),
(48, '2025_09_19_161155_create_pemusnahans_table', 36),
(49, '2025_09_22_085716_create_verifikasi_sanitasis_table', 37),
(50, '2025_09_22_094559_create_returs_table', 38),
(51, '2025_09_22_105704_create_retains_table', 39),
(52, '2025_09_22_133145_create_sample_bulanans_table', 40),
(53, '2025_09_23_092317_create_cold_storages_table', 41),
(54, '2025_09_23_143701_create_sample_retains_table', 42),
(55, '2025_09_23_155521_create_submissions_table', 43),
(56, '2025_09_24_093658_add_activation_to_users_table', 44),
(57, '2025_09_24_094000_add_updater_to_users_table', 45);

-- --------------------------------------------------------

--
-- Table structure for table `noodles`
--

CREATE TABLE `noodles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `mixing` longtext NOT NULL,
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
-- Dumping data for table `noodles`
--

INSERT INTO `noodles` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `nama_produk`, `mixing`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019928cb-80e8-7036-98cb-58e9ff0cc66a', 'Putri', 'Harnis', '2025-09-09', '1', 'Fiesta Rice with Chicken Teriyaki', '[{\"nama_produk\":\"Fiesta Rice with Chicken Teriyaki\",\"kode_produksi\":\"SRG PH 13 101 AA0\",\"bahan_utama\":\"Semolina\",\"kode_bahan\":\"04.08.2025\\/04.09.2025\",\"berat_bahan\":\"80.20\",\"bahan_lain\":[{\"nama_bahan\":\"Wheat Gluten\",\"kode_bahan_lain\":\"11.01.25\\/16.07.26\",\"berat_bahan\":\"3.20\"},{\"nama_bahan\":\"N56FSN\",\"kode_bahan_lain\":\"PE26101AA0\\/26.09.25\",\"berat_bahan\":\"1.08\"},{\"nama_bahan\":\"Chill Water\",\"kode_bahan_lain\":\"-\",\"berat_bahan\":\"28.92\"},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null}],\"waktu_proses\":[\"6\",\"6\",\"6\",\"6\",\"6\"],\"vacuum\":[null,null,null,null,null],\"suhu_adonan\":[null,null,null,null,null],\"waktu_aging\":[null,null,null,null,null],\"rh_aging\":[null,null,null,null,null],\"suhu_ruang_aging\":[null,null,null,null,null],\"tebal_rolling\":[null,null,null,null,null],\"suhu_setting_boiling\":null,\"suhu_actual_boiling\":[null,null,null,null,null],\"waktu_boiling\":null,\"suhu_setting_washing\":null,\"suhu_actual_washing\":[null,null,null,null,null],\"waktu_washing\":null,\"suhu_setting_cooling\":null,\"suhu_actual_cooling\":[null,null,null,null,null],\"waktu_cooling\":null,\"mulai\":null,\"selesai\":null,\"suhu_akhir\":[null,null,null,null,null],\"suhu_after\":[null,null,null,null,null],\"rasa\":[\"Oke\",\"Oke\"],\"kekenyalan\":[\"Oke\",\"Oke\"],\"warna\":[\"Oke\",\"Oke\"]},{\"nama_produk\":\"Fiesta Rice with Chicken Teriyaki\",\"kode_produksi\":\"SRG PH 13 101 AA0\",\"bahan_utama\":\"Semolina\",\"kode_bahan\":\"04.08.2025\\/04.09.2025\",\"berat_bahan\":\"80.20\",\"bahan_lain\":[{\"kode_bahan_lain\":\"11.01.25\\/16.07.26\",\"berat_bahan\":\"3.20\"},{\"kode_bahan_lain\":\"PE26101AA0\\/26.09.25\",\"berat_bahan\":\"1.08\"},{\"kode_bahan_lain\":\"-\",\"berat_bahan\":\"28.92\"},{\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"kode_bahan_lain\":null,\"berat_bahan\":null}],\"waktu_proses\":[\"6\",\"6\",\"6\",\"6\",\"6\"],\"vacuum\":[null,null,null,null,null],\"suhu_adonan\":[null,null,null,null,null],\"waktu_aging\":[null,null,null,null,null],\"rh_aging\":[null,null,null,null,null],\"suhu_ruang_aging\":[null,null,null,null,null],\"tebal_rolling\":[null,null,null,null,null],\"suhu_setting_boiling\":null,\"suhu_actual_boiling\":[null,null,null,null,null],\"waktu_boiling\":null,\"suhu_setting_washing\":null,\"suhu_actual_washing\":[null,null,null,null,null],\"waktu_washing\":null,\"suhu_setting_cooling\":null,\"suhu_actual_cooling\":[null,null,null,null,null],\"waktu_cooling\":null,\"mulai\":null,\"selesai\":null,\"suhu_akhir\":[null,null,null,null,null],\"suhu_after\":[null,null,null,null,null],\"kekenyalan\":[\"Oke\",\"Oke\",\"Oke\"],\"warna\":[\"Oke\",\"Oke\",\"Oke\"]},{\"nama_produk\":\"Fiesta Rice with Chicken Teriyaki\",\"kode_produksi\":\"SRG PH 13 101 AA0\",\"bahan_utama\":\"Semolina\",\"kode_bahan\":\"04.08.2025\\/04.09.2025\",\"berat_bahan\":\"80.20\",\"bahan_lain\":[{\"kode_bahan_lain\":\"11.01.25\\/16.07.26\",\"berat_bahan\":\"3.20\"},{\"kode_bahan_lain\":\"PE26101AA0\\/26.09.25\",\"berat_bahan\":\"1.08\"},{\"kode_bahan_lain\":null,\"berat_bahan\":\"28.92\"},{\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"kode_bahan_lain\":null,\"berat_bahan\":null}],\"waktu_proses\":[null,null,null,null,null],\"vacuum\":[null,null,null,null,null],\"suhu_adonan\":[null,null,null,null,null],\"waktu_aging\":[null,null,null,null,null],\"rh_aging\":[null,null,null,null,null],\"suhu_ruang_aging\":[null,null,null,null,null],\"tebal_rolling\":[null,null,null,null,null],\"suhu_setting_boiling\":null,\"suhu_actual_boiling\":[null,null,null,null,null],\"waktu_boiling\":null,\"suhu_setting_washing\":null,\"suhu_actual_washing\":[null,null,null,null,null],\"waktu_washing\":null,\"suhu_setting_cooling\":null,\"suhu_actual_cooling\":[null,null,null,null,null],\"waktu_cooling\":null,\"mulai\":null,\"selesai\":null,\"suhu_akhir\":[null,null,null,null,null],\"suhu_after\":[null,null,null,null,null],\"rasa\":[\"Oke\",\"Oke\"],\"kekenyalan\":[\"Oke\",\"Oke\"],\"warna\":[\"Oke\",\"Oke\"]}]', 'weeeee', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-08 10:07:29', '2025-09-09 03:36:01'),
(2, '01992c56-7246-7371-8ba7-2d121cf8997d', 'Putri', 'Harnis', '2025-09-16', '1', 'Fiesta Rice with Chicken Teriyaki', '[{\"nama_produk\":\"Fiesta Rice with Chicken Teriyaki\",\"kode_produksi\":\"SRG PI 09 101 AA0\",\"bahan_utama\":\"Semolina\",\"kode_bahan\":null,\"berat_bahan\":null,\"bahan_lain\":[{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null}],\"waktu_proses\":[null,null,null,null,null],\"vacuum\":[null,null,null,null,null],\"suhu_adonan\":[null,null,null,null,null],\"waktu_aging\":[null,null,null,null,null],\"rh_aging\":[null,null,null,null,null],\"suhu_ruang_aging\":[null,null,null,null,null],\"tebal_rolling\":[null,null,null,null,null],\"suhu_setting_boiling\":null,\"suhu_actual_boiling\":[null,null,null,null,null],\"waktu_boiling\":null,\"suhu_setting_washing\":null,\"suhu_actual_washing\":[null,null,null,null,null],\"waktu_washing\":null,\"suhu_setting_cooling\":null,\"suhu_actual_cooling\":[null,null,null,null,null],\"waktu_cooling\":null,\"mulai\":null,\"selesai\":null,\"suhu_akhir\":[null,null,null,null,null],\"suhu_after\":[null,null,null,null,null]}]', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-09 02:38:06', '2025-09-16 02:01:19'),
(3, '01995043-4039-7282-8d0b-cff7d18b606b', 'Putri', 'Harnis', '2025-09-16', '1', 'Fiesta Rice with Beef Bulgogi', '[{\"nama_produk\":\"Fiesta Rice with Beef Bulgogi\",\"kode_produksi\":\"SRG PI 09 101 AA0\",\"bahan_utama\":\"Semolina\",\"kode_bahan\":\"10.02.2024\",\"berat_bahan\":null,\"bahan_lain\":[{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null}],\"waktu_proses\":[null,null,null,null,null],\"vacuum\":[null,null,null,null,null],\"suhu_adonan\":[null,null,null,null,null],\"waktu_aging\":[null,null,null,null,null],\"rh_aging\":[null,null,null,null,null],\"suhu_ruang_aging\":[null,null,null,null,null],\"tebal_rolling\":[null,null,null,null,null],\"suhu_setting_boiling\":null,\"suhu_actual_boiling\":[null,null,null,null,null],\"waktu_boiling\":null,\"suhu_setting_washing\":null,\"suhu_actual_washing\":[null,null,null,null,null],\"waktu_washing\":null,\"suhu_setting_cooling\":null,\"suhu_actual_cooling\":[null,null,null,null,null],\"waktu_cooling\":null,\"mulai\":null,\"selesai\":null,\"suhu_akhir\":[null,null,null,null,null],\"suhu_after\":[null,null,null,null,null]}]', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-16 02:03:28', '2025-09-16 02:03:45'),
(4, '01995045-515b-71f4-b42d-57268c7d83a0', 'Putri', NULL, '2025-09-16', '1', 'Fiesta Rice with Beef Bulgogi', '[{\"nama_produk\":\"Fiesta Rice with Beef Bulgogi\",\"kode_produksi\":\"SRG PI 09 101 AA0\",\"bahan_utama\":\"Semolina\",\"kode_bahan\":\"10.02.2024\",\"bahan_lain\":[{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null},{\"nama_bahan\":null,\"kode_bahan_lain\":null,\"berat_bahan\":null}]}]', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-16 02:05:44', '2025-09-16 02:05:44'),
(5, '01995047-8b29-72bd-8bd0-cbfb506cef51', 'Putri', 'Harnis', '2025-09-16', '1', 'Fiesta RTS Beef Blackpepper', '[{\"nama_produk\":\"Fiesta RTS Beef Blackpepper\",\"kode_produksi\":\"SRG PI 09 101 AA0\",\"bahan_utama\":\"Semolina\",\"kode_bahan\":\"10.02.2024\",\"berat_bahan\":\"100.2\"},{\"nama_produk\":\"Fiesta RTS Beef Blackpepper\",\"kode_produksi\":\"SRG PI 09 101 AA0\",\"bahan_utama\":\"Semolina\",\"kode_bahan\":\"10.02.2024\",\"berat_bahan\":\"120\"}]', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-16 02:08:10', '2025-09-16 02:55:14');

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
-- Table structure for table `pemusnahans`
--

CREATE TABLE `pemusnahans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `expired_date` date NOT NULL,
  `analisis` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemusnahans`
--

INSERT INTO `pemusnahans` (`id`, `uuid`, `username`, `username_updated`, `date`, `nama_produk`, `kode_produksi`, `expired_date`, `analisis`, `keterangan`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '01996168-7b31-7389-8d68-2bf7afd53d8a', 'Putri', 'Harnis', '2025-09-19', 'Fiesta RTS Chicken Teriyaki', 'PG 10 101 AA0', '2026-09-19', 'svgaf', 'zagvrfgv', NULL, '0', NULL, NULL, '2025-09-19 09:57:41', '2025-09-19 09:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `pengemasans`
--

CREATE TABLE `pengemasans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `pukul` time NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `tray_checking` longtext DEFAULT NULL,
  `box_checking` longtext DEFAULT NULL,
  `keterangan_checking` varchar(255) DEFAULT NULL,
  `date_packing` date DEFAULT NULL,
  `shift_packing` varchar(255) DEFAULT NULL,
  `pukul_packing` time DEFAULT NULL,
  `tray_packing` longtext DEFAULT NULL,
  `box_packing` longtext DEFAULT NULL,
  `keterangan_packing` varchar(255) DEFAULT NULL,
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
-- Dumping data for table `pengemasans`
--

INSERT INTO `pengemasans` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `pukul`, `nama_produk`, `kode_produksi`, `tray_checking`, `box_checking`, `keterangan_checking`, `date_packing`, `shift_packing`, `pukul_packing`, `tray_packing`, `box_packing`, `keterangan_packing`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(3, '0199572a-6a83-7343-bc2e-3a4bb914b24f', 'Putri', 'Harnis', '2025-09-17', '2', '17:13:00', 'Fiesta Rice with Beef Bulgogi', 'PG 10 101 AA0', '\"{\\\"nama_produk\\\":\\\"Fiesta Rice with Beef Bulgogi\\\",\\\"qrcode\\\":\\\"sesuai\\\",\\\"kondisi\\\":\\\"oke\\\",\\\"kode_produksi\\\":\\\"uploads\\\\\\/pengemasan\\\\\\/Gq43P4ZBgJoQbPL8LhcBeyeO97HTEoPe8lM7F82X.jpg\\\"}\"', '\"{\\\"kondisi\\\":\\\"oke\\\",\\\"kode_produksi\\\":\\\"uploads\\\\\\/pengemasan\\\\\\/EG51Fw1SZsY5x2FaFo4VnJKCNJWTLg0bXluT7JIH.jpg\\\"}\"', 'check', NULL, NULL, NULL, '\"{\\\"nama_produk\\\":\\\"Fiesta Rice with Beef Bulgogi\\\",\\\"qrcode\\\":\\\"sesuai\\\",\\\"kondisi\\\":\\\"oke\\\",\\\"kode_produksi\\\":\\\"uploads\\\\\\/pengemasan\\\\\\/3dqrRCPug3KHb85VOTqjFNFD2rsSk89kurreWX2y.jpg\\\"}\"', '\"{\\\"isi_box\\\":\\\"6\\\",\\\"kondisi\\\":\\\"oke\\\",\\\"kode_produksi\\\":\\\"uploads\\\\\\/pengemasan\\\\\\/aI8JANKDIa2HMPsFw5ze8qClkviVUjAulx8TSnRO.jpg\\\"}\"', 'yaa', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-17 10:13:41', '2025-09-17 10:20:49');

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
(1, 'fdaca613-7ab2-4997-8f33-686e886c867d', 'putri', 'Cikande 2', '2025-08-27 01:54:32', '2025-09-24 03:57:58');

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
(2, '9fc55345-3833-48fd-8855-8cc8bd6243e7', '2025-09-01', 'Putri', NULL, '1', 'SRJK A', 'PG 10 101 AA0', 'Oke', NULL, NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-01 03:49:04', '2025-09-01 03:49:04');

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
(4, '0f3232dd-99cf-48c2-af06-fdd663fc8147', 'Fiesta Rice with Beef Blackpepper', 'putri', '2025-08-29 03:24:29', '2025-08-29 03:24:29'),
(5, 'eb23db72-0f0b-44a2-944c-7dd91121d08c', 'Fiesta Rice with Chicken Teriyaki', 'putri', '2025-09-05 02:01:51', '2025-09-05 02:01:51'),
(6, '0accc88a-1072-4087-849e-f91c4cf659fc', 'Fiesta Rice with Beef Yakiniku', 'putri', '2025-09-10 04:59:06', '2025-09-10 04:59:06'),
(7, 'c71405bc-c121-4dc6-9bae-e6eda1ead168', 'Fiesta RTS Chicken Rendang', 'putri', '2025-09-13 04:37:41', '2025-09-13 04:38:48'),
(8, 'd47daa75-f4ef-4787-b165-97e41f3ad03c', 'Fiesta RTS Chicken Teriyaki', 'putri', '2025-09-13 04:39:11', '2025-09-13 04:39:11'),
(9, '973bc652-e689-4f2a-80dd-39ab92147118', 'Fiesta RTS Beef Rendang', 'putri', '2025-09-13 04:39:52', '2025-09-13 04:39:52'),
(10, '415edf49-05cf-4837-93f5-53840909599c', 'Fiesta RTS Beef Yakiniku', 'putri', '2025-09-13 04:40:10', '2025-09-13 04:40:10'),
(11, 'c9a4b876-8d29-48dd-af0b-20ad03001a38', 'Fiesta RTS Beef Bulgogi', 'putri', '2025-09-13 04:40:31', '2025-09-13 04:40:31'),
(12, '24545dc3-e400-41af-8116-47a304345105', 'Fiesta RTS Beef Blackpepper', 'putri', '2025-09-13 04:40:53', '2025-09-13 04:40:53'),
(13, '77ac1d83-51e0-4872-bb5f-e8c7af39c435', 'Fiesta Rice with Balinese Betutu Duck', 'putri', '2025-09-13 04:42:03', '2025-09-13 04:42:26'),
(14, 'e953a8fd-0c02-441a-808a-c4beee05e20e', 'Fiesta Rice with Chicken Cheese Buldak', 'putri', '2025-09-13 04:44:05', '2025-09-13 04:44:05'),
(15, '1f0588f5-08ca-444f-901c-04ae772556fc', 'Fiesta Rice with Chicken Curry', 'putri', '2025-09-13 04:44:41', '2025-09-13 04:44:41'),
(16, '04f1b0f9-e6d9-463d-a44f-6f61cd8c6c86', 'Fiesta Rice with Chicken Donburi', 'putri', '2025-09-13 04:45:09', '2025-09-13 04:45:09'),
(17, 'c0303ea7-80b6-4599-91a7-02a808fa934a', 'Fiesta Rice with Chicken Satay', 'putri', '2025-09-13 04:45:34', '2025-09-13 04:45:34'),
(18, 'c4addb8e-ccbb-4a02-b0ca-3317f87b71d7', 'Fiesta Rice with Chicken Tandori', 'putri', '2025-09-13 04:45:59', '2025-09-13 04:45:59'),
(19, 'a06d0e68-7052-412f-8587-ce9e8b393d29', 'Fiesta Chicken Curry Noodle', 'putri', '2025-09-13 04:46:33', '2025-09-13 04:46:33'),
(20, '22acd8ad-b081-48c3-954e-d30a5dd55de6', 'Family Mart Sambal Bawang', 'putri', '2025-09-13 04:47:01', '2025-09-13 04:47:01'),
(21, '6befcde6-2570-49bf-95f8-08c6e71eeb52', 'Fiesta Rice with Karage and Sweet Sour Sauce', 'putri', '2025-09-13 04:47:36', '2025-09-13 04:48:08'),
(22, 'a6c32d10-d0ac-47cc-9f5e-8928d9cef0bf', 'Fiesta Rice with Korean Barbecue Chicken', 'putri', '2025-09-13 04:49:22', '2025-09-13 04:49:22'),
(23, '07e8f7f3-caec-44e0-8244-1df221857f31', 'Fiesta Chicken Mushroom Noodle', 'putri', '2025-09-13 04:50:00', '2025-09-13 04:50:00'),
(24, 'df328f34-2472-42d3-a69b-4e1b5d2347f0', 'Fiesta Turmeric Rice with Chicken Popbites', 'putri', '2025-09-13 04:50:47', '2025-09-13 04:50:47'),
(25, 'cb0bb1d9-c7f4-40f3-a191-4b4a091d94a5', 'Fiesta Coconut Rice with Spicy Chick', 'putri', '2025-09-13 04:51:20', '2025-09-13 04:51:20'),
(26, '315741be-dae5-4541-90b4-4592942e1bdc', 'OCK Curry', 'putri', '2025-09-13 04:51:34', '2025-09-13 04:51:34'),
(27, '5e406ae3-8cd3-47a0-a917-f5ed6db7433b', 'OCK Mushroom', 'putri', '2025-09-13 04:51:48', '2025-09-13 04:51:48'),
(28, 'cca96680-43bf-4454-885b-83788eebeb78', 'Fiesta RTE Chicken Bolognese', 'putri', '2025-09-13 04:52:14', '2025-09-13 04:52:14'),
(29, '5eb0754e-db2d-48a9-b6b4-2f651e7a7200', 'Fiesta RTE Chicken Rendang', 'putri', '2025-09-13 04:52:33', '2025-09-13 04:52:33'),
(30, 'a004e2d5-c254-4380-9934-bde6062472f8', 'Fiesta RTE Opor Ayam', 'putri', '2025-09-13 04:53:00', '2025-09-13 04:53:00'),
(31, '75714084-78dd-48da-9beb-6b415c195156', 'Fiesta RTS Rujak Sauce', 'putri', '2025-09-13 04:53:27', '2025-09-13 04:53:27'),
(32, '61d98f07-268d-4669-bf14-c7e8ffdd4f00', 'Fiesta Rice with Chicken Rujak Sauce', 'putri', '2025-09-13 04:54:34', '2025-09-13 04:54:34'),
(33, '2153e53c-fa7f-4469-976d-641fbfffc0fb', 'Fiesta Rice with Geprek Chicken', 'putri', '2025-09-13 04:55:03', '2025-09-13 04:55:03'),
(34, '9a7aba8b-53fa-4fef-811c-99c96c265570', 'Fiesta Rice with Pop Bites Sambal Matah', 'putri', '2025-09-13 04:56:05', '2025-09-13 04:56:05'),
(35, '1a092aa3-6ac6-44af-93f6-cd159b5cac33', 'Fiesta SCB and Chicken Sausage Fried Rice', 'putri', '2025-09-13 04:57:12', '2025-09-13 04:57:12'),
(36, 'a8cc35d8-a795-4949-982b-ff51e61b85b0', 'Fiesta Spaghetti Carbonara', 'putri', '2025-09-13 04:57:33', '2025-09-13 04:57:33'),
(37, '14d51d02-c414-4617-a88b-5c904fc15570', 'Fiesta Spaghetti Chicken Bolognese', 'putri', '2025-09-13 04:57:58', '2025-09-13 04:57:58'),
(38, '3bdad590-c98a-4384-bb26-33769d2a0538', 'Fiesta Italian Meat Ball with Spaghetti Bolognese', 'putri', '2025-09-13 04:58:40', '2025-09-13 04:58:40'),
(39, '0992d8aa-ab93-449f-ba29-1d3b88065e73', 'Spicy Glazing Sauce A&W', 'putri', '2025-09-13 04:59:03', '2025-09-13 04:59:03'),
(40, '36709b46-5660-474b-a9fb-69495b295abf', 'Spicy Glazing Sauce', 'putri', '2025-09-13 04:59:25', '2025-09-13 04:59:25'),
(41, 'f562afa0-1b7c-4342-856c-2f96b5af9f36', 'Fiesta Truffle Gyudon', 'putri', '2025-09-13 04:59:47', '2025-09-13 04:59:47'),
(42, '3322fbb6-be74-4ccc-980a-43167dfca46f', 'Yoshinoya Teriyaki', 'putri', '2025-09-13 05:00:00', '2025-09-13 05:00:00'),
(43, 'e010de01-cf17-4955-94b9-465fdc48c187', 'Yoshinoya Vegetable', 'putri', '2025-09-13 05:00:13', '2025-09-13 05:00:13'),
(44, '23471305-91ec-4057-87b6-b29da071ec72', 'Fiesta Sausage & Chicken Ball Pizza', 'putri', '2025-09-13 05:00:38', '2025-09-13 05:00:38'),
(45, 'b95e8fdb-261d-4625-8ca8-6f0e07a2a052', 'Fiesta Cheesy Beef Pizza', 'putri', '2025-09-13 05:00:55', '2025-09-13 05:00:55'),
(46, 'ebaab0fd-b479-4882-9f2e-2b1eefc38ebe', 'Fiesta Hainanese Chicken Rice', 'putri', '2025-09-13 05:01:14', '2025-09-13 05:01:14'),
(47, 'a613ffc8-337e-4eed-afe2-38bbe49c1f4b', 'Bawang Sauted', 'putri', '2025-09-13 05:02:08', '2025-09-13 05:02:08');

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
-- Table structure for table `rejects`
--

CREATE TABLE `rejects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_mesin` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `jumlah_tidak_lolos` double DEFAULT NULL,
  `jumlah_kontaminan` double DEFAULT NULL,
  `jenis_kontaminan` varchar(255) DEFAULT NULL,
  `posisi_kontaminan` varchar(255) DEFAULT NULL,
  `false_rejection` varchar(255) DEFAULT NULL,
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
-- Dumping data for table `rejects`
--

INSERT INTO `rejects` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `nama_mesin`, `nama_produk`, `kode_produksi`, `jumlah_tidak_lolos`, `jumlah_kontaminan`, `jenis_kontaminan`, `posisi_kontaminan`, `false_rejection`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '01996020-87d9-726c-ad7f-6ee2e845bde5', 'Putri', 'Harnis', '2025-09-19', '1', 'X-Ray', 'Fiesta Rice with Chicken Rendang', 'OL 19 101 AA0', 3, 12, 'batu', 'TENGAH PRODUK', '3/3', 'sfszf', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-19 03:59:28', '2025-09-19 04:07:52');

-- --------------------------------------------------------

--
-- Table structure for table `repacks`
--

CREATE TABLE `repacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `karton` varchar(255) NOT NULL,
  `jumlah` double NOT NULL,
  `expired_date` date NOT NULL,
  `kodefikasi` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `kerapihan` varchar(255) DEFAULT NULL,
  `lainnya` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
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
-- Dumping data for table `repacks`
--

INSERT INTO `repacks` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `nama_produk`, `kode_produksi`, `karton`, `jumlah`, `expired_date`, `kodefikasi`, `content`, `kerapihan`, `lainnya`, `keterangan`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(2, '01995c38-5974-718a-8ae7-2b8c132828b9', 'Putri', NULL, '2025-09-18', '2', 'Fiesta Rice with Beef Blackpepper', 'PF 23 101 BB0', 'cp general', 321, '2025-09-27', 'sesuai', 'sesuai', 'sesuai', 'sesuai', 'aaaa', 'ssss', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-18 09:47:00', '2025-09-18 09:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `retains`
--

CREATE TABLE `retains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `sample_type` varchar(255) NOT NULL,
  `sample_storage` longtext DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `production_code` varchar(255) NOT NULL,
  `best_before` date NOT NULL,
  `quantity` double DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `nama_warehouse` varchar(255) DEFAULT NULL,
  `status_warehouse` varchar(255) DEFAULT NULL,
  `tgl_update_warehouse` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returs`
--

CREATE TABLE `returs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `no_mobil` varchar(255) DEFAULT NULL,
  `nama_supir` varchar(255) DEFAULT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `expired_date` date NOT NULL,
  `jumlah` double DEFAULT NULL,
  `bocor` varchar(255) DEFAULT NULL,
  `isi_kurang` varchar(255) DEFAULT NULL,
  `lainnya` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_warehouse` varchar(255) DEFAULT NULL,
  `status_warehouse` varchar(255) DEFAULT NULL,
  `tgl_update_warehouse` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `returs`
--

INSERT INTO `returs` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `no_mobil`, `nama_supir`, `nama_produk`, `kode_produksi`, `expired_date`, `jumlah`, `bocor`, `isi_kurang`, `lainnya`, `keterangan`, `catatan`, `nama_warehouse`, `status_warehouse`, `tgl_update_warehouse`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(2, '01996f73-2eba-72fb-ac85-c5db3f3faff2', 'Putri', 'Harnis', '2025-09-22', '1', 'W 1234 BC', 'Ahmed', 'Fiesta Rice with Chicken Curry', 'PG 10 101 AA0', '2025-09-22', 123, 'sesuai', 'tidak sesuai', 'sesuai', 'hahaha', 'syudah', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-22 03:24:03', '2025-09-22 03:30:20'),
(3, '01996f8c-1535-73d3-94ee-70035a0bff90', 'Putri', 'Harnis', '2025-09-22', '1', 'W 1234 BC', 'asdas', 'Fiesta Rice with Beef Bulgogi', 'PF 23 101 BB0', '2026-09-22', 123, 'sesuai', 'sesuai', 'sesuai', 'asadsa', 'adas', 'Cahyo', '1', NULL, NULL, '0', NULL, NULL, '2025-09-22 03:51:15', '2025-09-22 03:51:30');

-- --------------------------------------------------------

--
-- Table structure for table `rices`
--

CREATE TABLE `rices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `cooker` longtext NOT NULL,
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
-- Dumping data for table `rices`
--

INSERT INTO `rices` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `nama_produk`, `cooker`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '9fc94904-f4b0-4dd8-8959-e9c708e6728f', 'Putri', 'Harnis', '2025-09-03', '1', 'Fiesta Rice with Beef Rendang', '\"[{\\\"kode_beras\\\":\\\"02 09 2025\\\",\\\"berat\\\":\\\"10\\\",\\\"kode_produksi\\\":\\\"PI 03 101 AA0\\\",\\\"basket\\\":\\\"1\\\",\\\"gas\\\":\\\"ON\\\",\\\"waktu_masak\\\":\\\"20\\\",\\\"suhu_produk\\\":\\\"96.2\\\",\\\"suhu_after\\\":\\\"85.2\\\",\\\"suhu_vacuum\\\":\\\"60.4\\\",\\\"jam_mulai\\\":\\\"10:03\\\",\\\"jam_selesai\\\":\\\"11:03\\\",\\\"sensori\\\":{\\\"kematangan\\\":\\\"Oke\\\",\\\"rasa\\\":\\\"Oke\\\",\\\"aroma\\\":\\\"Oke\\\",\\\"tekstur\\\":\\\"Oke\\\",\\\"warna\\\":\\\"Oke\\\"}},{\\\"kode_beras\\\":\\\"02 09 2025\\\",\\\"berat\\\":\\\"10\\\",\\\"kode_produksi\\\":\\\"PI 03 101 AA0\\\",\\\"basket\\\":\\\"2\\\",\\\"gas\\\":\\\"ON\\\",\\\"waktu_masak\\\":\\\"20\\\",\\\"suhu_produk\\\":\\\"97.4\\\",\\\"suhu_after\\\":\\\"85.2\\\",\\\"suhu_vacuum\\\":\\\"63.1\\\",\\\"jam_mulai\\\":\\\"13:15\\\",\\\"jam_selesai\\\":\\\"14:15\\\",\\\"sensori\\\":{\\\"kematangan\\\":\\\"Oke\\\",\\\"rasa\\\":\\\"Oke\\\",\\\"aroma\\\":\\\"Oke\\\",\\\"tekstur\\\":\\\"Oke\\\",\\\"warna\\\":\\\"Oke\\\"}},{\\\"kode_beras\\\":\\\"02 09 2025\\\",\\\"berat\\\":\\\"10\\\",\\\"kode_produksi\\\":\\\"PI 03 101 AA0\\\",\\\"basket\\\":\\\"3\\\",\\\"gas\\\":\\\"ON\\\",\\\"waktu_masak\\\":\\\"20\\\",\\\"suhu_produk\\\":\\\"89.6\\\",\\\"suhu_after\\\":\\\"80.3\\\",\\\"suhu_vacuum\\\":\\\"70.2\\\",\\\"jam_mulai\\\":\\\"14:19\\\",\\\"jam_selesai\\\":\\\"15:19\\\",\\\"sensori\\\":{\\\"kematangan\\\":\\\"Oke\\\",\\\"rasa\\\":\\\"Oke\\\",\\\"aroma\\\":\\\"Oke\\\",\\\"tekstur\\\":\\\"Oke\\\",\\\"warna\\\":\\\"Oke\\\"}}]\"', 'TRIAL 3', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-03 03:03:43', '2025-09-03 04:19:28'),
(3, '019917a2-b8ab-7059-b1d2-03738c43f47b', 'Putri', 'Harnis', '2025-09-05', '1', 'Fiesta Rice with Chicken Rendang', '\"[{\\\"kode_beras\\\":\\\"02 09 2025\\\",\\\"berat\\\":\\\"10\\\",\\\"kode_produksi\\\":null,\\\"basket\\\":null,\\\"gas\\\":\\\"ON\\\",\\\"waktu_masak\\\":null,\\\"suhu_produk\\\":null,\\\"suhu_after\\\":null,\\\"suhu_vacuum\\\":null,\\\"jam_mulai\\\":\\\"10:32\\\",\\\"jam_selesai\\\":\\\"00:32\\\",\\\"sensori\\\":{\\\"kematangan\\\":\\\"Oke\\\",\\\"rasa\\\":\\\"Oke\\\",\\\"aroma\\\":\\\"Oke\\\",\\\"tekstur\\\":\\\"Oke\\\",\\\"warna\\\":\\\"Oke\\\"}},{\\\"kode_beras\\\":\\\"02 09 2025\\\",\\\"berat\\\":\\\"10\\\",\\\"kode_produksi\\\":null,\\\"basket\\\":null,\\\"gas\\\":\\\"ON\\\",\\\"waktu_masak\\\":null,\\\"suhu_produk\\\":null,\\\"suhu_after\\\":null,\\\"suhu_vacuum\\\":null,\\\"jam_mulai\\\":\\\"11:58\\\",\\\"jam_selesai\\\":\\\"00:58\\\"},{\\\"kode_beras\\\":\\\"02 09 2025\\\",\\\"berat\\\":\\\"10\\\",\\\"kode_produksi\\\":null,\\\"basket\\\":null,\\\"gas\\\":\\\"ON\\\",\\\"waktu_masak\\\":null,\\\"suhu_produk\\\":null,\\\"suhu_after\\\":null,\\\"suhu_vacuum\\\":null,\\\"jam_mulai\\\":\\\"11:58\\\",\\\"jam_selesai\\\":\\\"01:58\\\"}]\"', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-05 02:09:24', '2025-09-16 02:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `sample_bulanans`
--

CREATE TABLE `sample_bulanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `plant` varchar(255) NOT NULL,
  `sample_bulan` char(7) NOT NULL,
  `sample_storage` longtext DEFAULT NULL,
  `sample` longtext DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `nama_warehouse` varchar(255) DEFAULT NULL,
  `status_warehouse` varchar(255) DEFAULT NULL,
  `tgl_update_warehouse` timestamp NULL DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sample_bulanans`
--

INSERT INTO `sample_bulanans` (`id`, `uuid`, `username`, `username_updated`, `date`, `plant`, `sample_bulan`, `sample_storage`, `sample`, `catatan`, `nama_warehouse`, `status_warehouse`, `tgl_update_warehouse`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(2, '01997439-ae35-7013-983f-d7509f05b044', 'Putri', NULL, '2025-09-23', 'Cikande 2 Ready Meal', '2025-09', '[\"Frozen (≤ –18 °C)\",\"Chilled (0-5°C)\"]', '\"[{\\\"nama_produk\\\":\\\"Fiesta Rice with Chicken Rendang\\\",\\\"kode_produksi\\\":\\\"PH 23 101 AA0\\\",\\\"best_before\\\":\\\"2025-09-23\\\",\\\"quantity\\\":\\\"1212\\\",\\\"keterangan\\\":\\\"sadada\\\"}]\"', 'agvaegv', 'Fikri', '1', NULL, NULL, '0', NULL, NULL, '2025-09-23 01:39:21', '2025-09-23 01:39:21'),
(4, '01997440-0c04-70bf-a1c8-95e346b7399e', 'Putri', 'Harnis', '2025-09-23', 'Cikande 2 Ready Meal', '2025-09', '[\"Frozen (≤ –18 °C)\"]', '\"[{\\\"nama_produk\\\":\\\"Fiesta Rice with Chicken Donburi\\\",\\\"kode_produksi\\\":\\\"PH 23 101 AA0\\\",\\\"best_before\\\":\\\"2025-09-23\\\",\\\"quantity\\\":\\\"111\\\",\\\"keterangan\\\":\\\"ada\\\"},{\\\"nama_produk\\\":\\\"Fiesta Rice with Chicken Curry\\\",\\\"kode_produksi\\\":\\\"PH 23 101 AA0\\\",\\\"best_before\\\":\\\"2025-09-23\\\",\\\"quantity\\\":\\\"2131\\\",\\\"keterangan\\\":\\\"a ds\\\"}]\"', 'asda', 'Fikri', '1', NULL, NULL, '0', NULL, NULL, '2025-09-23 01:46:18', '2025-09-23 02:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `sample_retains`
--

CREATE TABLE `sample_retains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `analisa` longtext DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sample_retains`
--

INSERT INTO `sample_retains` (`id`, `uuid`, `username`, `username_updated`, `nama_produk`, `kode_produksi`, `analisa`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019975b5-73be-73c0-907d-01302fcf8ca3', 'Putri', NULL, 'Fiesta Rice with Beef Blackpepper', 'OL 19 101 AA0', '\"[{\\\"bulan\\\":\\\"2025-09\\\",\\\"fisik\\\":\\\"1\\\",\\\"aroma\\\":\\\"2\\\",\\\"rasa\\\":\\\"3\\\",\\\"rata_score\\\":\\\"2.0\\\",\\\"cemaran\\\":\\\"lendir\\\",\\\"release\\\":\\\"Release\\\"},{\\\"bulan\\\":null,\\\"fisik\\\":null,\\\"aroma\\\":null,\\\"rasa\\\":null,\\\"rata_score\\\":null,\\\"cemaran\\\":null,\\\"release\\\":null},{\\\"bulan\\\":null,\\\"fisik\\\":null,\\\"aroma\\\":null,\\\"rasa\\\":null,\\\"rata_score\\\":null,\\\"cemaran\\\":null,\\\"release\\\":null},{\\\"bulan\\\":null,\\\"fisik\\\":null,\\\"aroma\\\":null,\\\"rasa\\\":null,\\\"rata_score\\\":null,\\\"cemaran\\\":null,\\\"release\\\":null},{\\\"bulan\\\":null,\\\"fisik\\\":null,\\\"aroma\\\":null,\\\"rasa\\\":null,\\\"rata_score\\\":null,\\\"cemaran\\\":null,\\\"release\\\":null},{\\\"bulan\\\":null,\\\"fisik\\\":null,\\\"aroma\\\":null,\\\"rasa\\\":null,\\\"rata_score\\\":null,\\\"cemaran\\\":null,\\\"release\\\":null},{\\\"bulan\\\":null,\\\"fisik\\\":null,\\\"aroma\\\":null,\\\"rasa\\\":null,\\\"rata_score\\\":null,\\\"cemaran\\\":null,\\\"release\\\":null},{\\\"bulan\\\":null,\\\"fisik\\\":null,\\\"aroma\\\":null,\\\"rasa\\\":null,\\\"rata_score\\\":null,\\\"cemaran\\\":null,\\\"release\\\":null},{\\\"bulan\\\":null,\\\"fisik\\\":null,\\\"aroma\\\":null,\\\"rasa\\\":null,\\\"rata_score\\\":null,\\\"cemaran\\\":null,\\\"release\\\":null},{\\\"bulan\\\":null,\\\"fisik\\\":null,\\\"aroma\\\":null,\\\"rasa\\\":null,\\\"rata_score\\\":null,\\\"cemaran\\\":null,\\\"release\\\":null},{\\\"bulan\\\":null,\\\"fisik\\\":null,\\\"aroma\\\":null,\\\"rasa\\\":null,\\\"rata_score\\\":null,\\\"cemaran\\\":null,\\\"release\\\":null},{\\\"bulan\\\":null,\\\"fisik\\\":null,\\\"aroma\\\":null,\\\"rasa\\\":null,\\\"rata_score\\\":null,\\\"cemaran\\\":null,\\\"release\\\":null}]\"', NULL, '0', NULL, NULL, '2025-09-23 08:34:10', '2025-09-23 08:34:10');

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
(7, '01995029-fe13-7394-95cf-f1f47fd2022a', '2025-09-16', 'Putri', NULL, '08:33:00', '1', '200', '50', 'uploads/footbasin/zydDRGzPYzCuzuKrGSm177yc5ZGvN2z7G7D59WEQ.jpg', 'uploads/handbasin/GAik6O4vC6AqgRJIjECptK4UUJjfxh4gejnDCYCt.jpg', 'Okeee', 'keeyy', NULL, 'Produksi RTM', '1', '2025-09-16 01:35:53', NULL, '0', NULL, '2025-09-16 01:35:53', '2025-09-16 01:35:53', '2025-09-16 01:35:53');

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
-- Table structure for table `steamers`
--

CREATE TABLE `steamers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `steaming` longtext NOT NULL,
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
-- Dumping data for table `steamers`
--

INSERT INTO `steamers` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `nama_produk`, `steaming`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '9fc7c502-fbf4-4354-9232-cf2dfcbb9b93', 'Putri', 'Harnis', '2025-09-02', '1', 'Fiesta Rice with Chicken Rendang', '[{\"kode_produksi\":\"PI 02 101 AA0\",\"suhu_rm\":\"3.2\",\"jumlah_tray\":\"10\",\"suhu_ruang\":\"24.5\",\"suhu_produk\":\"85.4\",\"suhu_after\":\"32.1\",\"waktu\":\"6\",\"keterangan\":\"SBL Dice\",\"jam_mulai\":\"16:58\",\"jam_selesai\":\"17:19\",\"sensori\":{\"kematangan\":\"Oke\",\"rasa\":\"Oke\",\"aroma\":\"Oke\",\"tekstur\":\"Oke\",\"warna\":\"Oke\"}},{\"kode_produksi\":\"PI 02 101 AA0\",\"suhu_rm\":\"4.5\",\"jumlah_tray\":\"10\",\"suhu_ruang\":\"25.6\",\"suhu_produk\":\"87.2\",\"suhu_after\":\"33.6\",\"waktu\":\"6\",\"keterangan\":\"Daun Singkong\",\"jam_mulai\":\"19:58\",\"jam_selesai\":\"20:12\",\"sensori\":{\"kematangan\":\"Oke\",\"rasa\":\"Oke\",\"aroma\":\"Oke\",\"tekstur\":\"Oke\",\"warna\":\"Oke\"}},{\"kode_produksi\":\"PI 02 101 AA0\",\"suhu_rm\":\"2.1\",\"jumlah_tray\":\"10\",\"suhu_ruang\":\"28.2\",\"suhu_produk\":\"82.0\",\"suhu_after\":\"45.2\",\"waktu\":\"6\",\"keterangan\":\"Kentang\",\"jam_mulai\":\"17:12\",\"jam_selesai\":\"18:30\",\"sensori\":{\"kematangan\":\"Oke\",\"rasa\":\"Oke\",\"aroma\":\"Oke\",\"tekstur\":\"Oke\",\"warna\":\"Oke\"}},{\"kode_produksi\":\"PI 02 101 AA0\",\"suhu_rm\":\"3.1\",\"jumlah_tray\":\"10\",\"suhu_ruang\":\"26.5\",\"suhu_produk\":\"86.7\",\"suhu_after\":\"46.5\",\"waktu\":\"6\",\"keterangan\":\"Cabai\",\"jam_mulai\":\"18:09\",\"jam_selesai\":\"19:10\",\"sensori\":{\"kematangan\":\"Oke\",\"rasa\":\"Oke\",\"aroma\":\"Oke\",\"tekstur\":\"Oke\",\"warna\":\"Oke\"}}]', 'yaaa', 'Produksi RTM', '1', NULL, NULL, '2', 'trial', NULL, '2025-09-02 08:58:46', '2025-09-03 04:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `plant` varchar(255) NOT NULL,
  `sample_type` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `sample_storage` longtext NOT NULL,
  `lab_request_micro` longtext DEFAULT NULL,
  `lab_request_chemical` longtext DEFAULT NULL,
  `report` longtext DEFAULT NULL,
  `nama_spv` varchar(255) DEFAULT NULL,
  `status_spv` varchar(255) DEFAULT NULL,
  `catatan_spv` varchar(255) DEFAULT NULL,
  `tgl_update_spv` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `uuid`, `username`, `username_updated`, `plant`, `sample_type`, `date`, `sample_storage`, `lab_request_micro`, `lab_request_chemical`, `report`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(5, '01997609-a1f8-7109-bdd8-772c9e4b27f9', 'Putri', 'Harnis', 'Cikande 2 Ready Meal', 'Frozen', '2025-09-23', '\"[\\\"Chilled (0-5\\u00b0C)\\\"]\"', '\"[\\\"TPC\\\",\\\"Salmonella\\\",\\\"E. Coli\\\"]\"', '\"[\\\"Ash\\\",\\\"Free Fatty Acid\\\",\\\"Protein\\\"]\"', '\"[{\\\"nama_produk\\\":\\\"Fiesta Rice with Chicken Donburi\\\",\\\"kode_produksi\\\":\\\"22 10 2025\\\",\\\"best_before\\\":\\\"2025-09-23\\\",\\\"quantity\\\":\\\"112\\\",\\\"remark\\\":\\\"kee\\\"},{\\\"nama_produk\\\":\\\"Fiesta Rice with Chicken Cheese Buldak\\\",\\\"kode_produksi\\\":\\\"22 10 2025\\\",\\\"best_before\\\":\\\"2025-09-23\\\",\\\"quantity\\\":\\\"120\\\",\\\"remark\\\":\\\"oke\\\"},{\\\"nama_produk\\\":\\\"Air Cooking\\\",\\\"kode_produksi\\\":\\\"22 10 2025\\\",\\\"best_before\\\":\\\"2025-09-26\\\",\\\"quantity\\\":\\\"10\\\",\\\"remark\\\":\\\"yes\\\"}]\"', NULL, '0', NULL, NULL, '2025-09-23 10:06:06', '2025-09-23 10:10:03');

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
  `status_produksi` varchar(255) DEFAULT NULL,
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
(1, '02c80c0c-282a-489a-9c4e-88ae6eeaa877', 'Putri', 'Harnis', '2025-08-28', '15:52:00', '1', 3.2, -18.9, -20.2, 9.2, 26, 86, 14.2, 28.5, 12, 23.5, 22, 10.2, 11.9, 22.5, 45.9, -18.7, 7, 'oke', 'Produksi RTM', '1', '2025-09-04 01:48:31', NULL, NULL, NULL, '2025-09-04 01:48:31', 'oke aja', '2025-08-27 23:07:07', '2025-09-03 10:22:37'),
(5, '01997add-ce55-7198-b1ef-c5e4e0fa70f3', 'admin', NULL, '2025-09-24', '15:36:00', '2', 3.2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2025-09-24 09:36:20', NULL, NULL, '0', '2025-09-24 08:36:20', NULL, '2025-09-24 08:36:20', '2025-09-24 08:36:20'),
(6, '01997adf-0b65-739f-ad6c-04dfce9dcdde', 'admin', NULL, '2025-09-24', '15:37:00', '2', 3.2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2025-09-24 09:37:41', NULL, NULL, '0', '2025-09-24 08:37:41', NULL, '2025-09-24 08:37:41', '2025-09-24 08:37:41'),
(7, '01997ae0-8d08-730d-9ea7-80bf7749ef04', 'admin', NULL, '2025-09-24', '15:39:00', '2', 3.2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2025-09-24 09:39:20', NULL, NULL, '0', '2025-09-24 08:39:20', NULL, '2025-09-24 08:39:20', '2025-09-24 08:39:20'),
(8, '01997ae8-6918-7053-94f7-b4d548b45567', 'admin', NULL, '2025-09-24', '15:47:00', '2', 4.2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '2025-09-24 09:47:55', NULL, NULL, '0', '2025-09-24 08:47:55', NULL, '2025-09-24 08:47:55', '2025-09-24 08:47:55'),
(9, '01997af1-2045-7040-b9f2-a52335f27cb7', 'admin', NULL, '2025-09-24', '15:57:00', '2', 5.2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Khoerunnisa', '1', '2025-09-24 09:57:26', NULL, NULL, '0', '2025-09-24 08:57:26', NULL, '2025-09-24 08:57:26', '2025-09-24 08:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `tahapans`
--

CREATE TABLE `tahapans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `filling_mulai` time DEFAULT NULL,
  `filling_selesai` time DEFAULT NULL,
  `waktu_iqf` time DEFAULT NULL,
  `waktu_sealer` time DEFAULT NULL,
  `waktu_xray` time DEFAULT NULL,
  `waktu_sticker` time DEFAULT NULL,
  `waktu_shrink` time DEFAULT NULL,
  `waktu_packing` time DEFAULT NULL,
  `waktu_cs` time DEFAULT NULL,
  `suhu_filling` longtext DEFAULT NULL,
  `suhu_masuk_iqf` varchar(255) DEFAULT NULL,
  `suhu_keluar_iqf` varchar(255) DEFAULT NULL,
  `suhu_sealer` varchar(255) DEFAULT NULL,
  `suhu_xray` varchar(255) DEFAULT NULL,
  `suhu_sticker` varchar(255) DEFAULT NULL,
  `suhu_shrink` varchar(255) DEFAULT NULL,
  `downtime` varchar(255) DEFAULT NULL,
  `suhu_cs` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
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
-- Dumping data for table `tahapans`
--

INSERT INTO `tahapans` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `nama_produk`, `kode_produksi`, `filling_mulai`, `filling_selesai`, `waktu_iqf`, `waktu_sealer`, `waktu_xray`, `waktu_sticker`, `waktu_shrink`, `waktu_packing`, `waktu_cs`, `suhu_filling`, `suhu_masuk_iqf`, `suhu_keluar_iqf`, `suhu_sealer`, `suhu_xray`, `suhu_sticker`, `suhu_shrink`, `downtime`, `suhu_cs`, `keterangan`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(6, '01994cac-ad11-737c-a5f9-1062a0715b42', 'Putri', 'Harnis', '2025-09-15', '2', 'Fiesta Rice with Beef Rendang', 'PF 23 101 BB0', '19:19:00', '18:19:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '\"[{\\\"nama_bahan\\\":\\\"Saus\\\",\\\"suhu\\\":\\\"2.5\\\"},{\\\"nama_bahan\\\":\\\"Daging\\\",\\\"suhu\\\":\\\"3.5\\\"}]\"', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Produksi RTM', '1', '2025-09-15 09:20:22', NULL, '0', NULL, NULL, '2025-09-15 09:20:08', '2025-09-15 09:20:22');

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
-- Table structure for table `thumblings`
--

CREATE TABLE `thumblings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `thumbls` longtext DEFAULT NULL,
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
-- Dumping data for table `thumblings`
--

INSERT INTO `thumblings` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `nama_produk`, `thumbls`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(8, '019917c0-9766-71a8-8c86-4baa61d2b22b', 'Putri', 'Harnis', '2025-09-09', '1', 'Fiesta Rice with Chicken Rendang', '{\"1\":{\"batch\":\"1\",\"daging\":\"SBL Beef Blade Block 8 - 15 g\",\"asal\":\"CPI 1\",\"kode_daging\":[{\"kode\":\"PH 25 101 AA0\",\"berat\":\"122\",\"suhu_daging\":[\"3.2\",\"3.4\",\"3.2\",\"3.0\"],\"rata_rata_suhu\":\"3.20\",\"kondisi_daging\":\"Aroma segar, tidak busuk, bebas dari kontaminasi benda asing\"},{\"kode\":\"PH 26 101 AA0\",\"berat\":\"124\",\"suhu_daging\":[\"4.2\",\"3.6\",\"4.0\",\"4.1\"],\"rata_rata_suhu\":\"3.98\",\"kondisi_daging\":\"Aroma segar, tidak busuk, bebas dari kontaminasi benda asing\"},{\"kode\":null,\"berat\":null,\"suhu_daging\":[null,null,null,null],\"rata_rata_suhu\":null,\"kondisi_daging\":null}],\"bahan_utama\":[{\"bahan\":\"A 134 CTR\",\"kode\":\"PH 25 101 AA0\",\"berat\":\"12\"},{\"bahan\":\"N 134 CTR\",\"kode\":\"PH 25 101 AA0\",\"berat\":\"13\"},{\"bahan\":null,\"kode\":null,\"berat\":null}],\"bahan_lain\":[{\"premix\":\"Minyak Goreng\",\"kode\":\"17.08.25\",\"berat\":\"12\",\"sens\":\"sesuai\"},{\"premix\":\"Bawang Putih\",\"kode\":null,\"berat\":\"2.4\",\"sens\":\"sesuai\"},{\"premix\":\"Es\",\"kode\":null,\"berat\":\"12.1\",\"sens\":\"sesuai\"},{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"}],\"hasil_tumbling\":{\"0\":{\"suhu_daging\":[\"12.4\",\"12.1\",\"12.3\",\"12.4\"]},\"1\":{\"suhu_daging\":[\"12.8\",\"12.6\",null,null]},\"2\":{\"suhu_daging\":[null,null,null,null]},\"rata_rata\":\"12.30\"},\"air\":\"12.4\",\"suhu_air\":\"22.1\",\"suhu_marinade\":\"3.2\",\"lama_pengadukan\":\"6\",\"brix\":\"10.5\",\"drum_on\":\"6\",\"drum_off\":null,\"drum_speed\":\"3\",\"vacuum_time\":\"2\",\"total_time\":\"11\",\"mulai\":\"10:41\",\"selesai\":\"11:41\",\"kondisi\":\"Sensori sesuai\",\"catatan\":\"brix sekian\"},\"2\":{\"batch\":\"2\",\"daging\":\"SBL Beef Blade Block 8 - 15 g\",\"asal\":\"CPI 1\",\"kode_daging\":[{\"kode\":\"PH 25 101 AA0\",\"berat\":\"111\",\"suhu_daging\":[\"5.9\",\"5.8\",\"5.4\",\"5.6\"],\"rata_rata_suhu\":\"5.68\",\"kondisi_daging\":\"Aroma segar, tidak busuk, bebas dari kontaminasi benda asing\"},{\"kode\":\"PH 26 101 AA0\",\"berat\":\"121\",\"suhu_daging\":[\"5.2\",\"4.2\",\"4.3\",\"4.8\"],\"rata_rata_suhu\":\"4.63\",\"kondisi_daging\":\"Aroma segar, tidak busuk, bebas dari kontaminasi benda asing\"},{\"kode\":null,\"berat\":null,\"suhu_daging\":[null,null,null,null],\"rata_rata_suhu\":null,\"kondisi_daging\":null}],\"bahan_utama\":[{\"bahan\":\"A 134 CTR\",\"kode\":\"PH 25 101 AA0\",\"berat\":\"11\"},{\"bahan\":\"N 134 CTR\",\"kode\":\"PH 25 101 AA0\",\"berat\":\"10\"},{\"bahan\":null,\"kode\":null,\"berat\":null}],\"bahan_lain\":[{\"kode\":\"17.08.25\",\"berat\":\"13\",\"sens\":\"sesuai\"},{\"kode\":null,\"berat\":\"3.4\",\"sens\":\"sesuai\"},{\"kode\":null,\"berat\":\"12.0\",\"sens\":\"sesuai\"},{\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"}],\"hasil_tumbling\":{\"0\":{\"suhu_daging\":[\"12.5\",\"12.4\",\"12.3\",\"12.0\"]},\"1\":{\"suhu_daging\":[\"13.2\",\"13.1\",null,null]},\"2\":{\"suhu_daging\":[null,null,null,null]},\"rata_rata\":\"12.70\"},\"air\":\"15.3\",\"suhu_air\":\"22.4\",\"suhu_marinade\":\"4.2\",\"lama_pengadukan\":\"7\",\"brix\":\"11.2\",\"drum_on\":\"12\",\"drum_off\":null,\"drum_speed\":\"3\",\"vacuum_time\":\"3\",\"total_time\":\"18\",\"mulai\":\"13:41\",\"selesai\":\"14:41\",\"kondisi\":\"Sensori sesuai\",\"catatan\":\"salt sekian\"},\"3\":{\"batch\":\"3\",\"daging\":\"SBL Beef Blade Block 8 - 15 g\",\"asal\":\"CPI 1\",\"kode_daging\":[{\"kode\":\"PH 25 101 AA0\",\"berat\":\"112\",\"suhu_daging\":[null,null,null,null],\"rata_rata_suhu\":null,\"kondisi_daging\":null},{\"kode\":\"PH 26 101 AA0\",\"berat\":\"110\",\"suhu_daging\":[null,null,null,null],\"rata_rata_suhu\":null,\"kondisi_daging\":null},{\"kode\":null,\"berat\":null,\"suhu_daging\":[null,null,null,null],\"rata_rata_suhu\":null,\"kondisi_daging\":null}],\"bahan_utama\":[{\"bahan\":null,\"kode\":null,\"berat\":null},{\"bahan\":null,\"kode\":null,\"berat\":null},{\"bahan\":null,\"kode\":null,\"berat\":null}],\"bahan_lain\":[{\"kode\":null,\"berat\":null,\"sens\":\"sesuai\"},{\"kode\":null,\"berat\":null,\"sens\":\"sesuai\"},{\"kode\":null,\"berat\":null,\"sens\":\"sesuai\"},{\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"}],\"hasil_tumbling\":{\"0\":{\"suhu_daging\":[null,null,null,null]},\"1\":{\"suhu_daging\":[null,null,null,null]},\"2\":{\"suhu_daging\":[null,null,null,null]},\"rata_rata\":null},\"air\":null,\"suhu_air\":null,\"suhu_marinade\":null,\"lama_pengadukan\":null,\"brix\":null,\"drum_on\":null,\"drum_off\":null,\"drum_speed\":null,\"vacuum_time\":null,\"total_time\":null,\"mulai\":null,\"selesai\":null,\"kondisi\":null,\"catatan\":null}}', 'oke', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-05 02:42:01', '2025-09-09 02:59:41'),
(10, '01995091-d590-7001-91ea-5c12074fe081', 'Putri', 'Harnis', '2025-09-16', '1', 'Fiesta Rice with Beef Blackpepper', '{\"1\":{\"batch\":\"1\",\"daging\":\"SBL Beef Blade Block 8 - 15 g\",\"asal\":\"CPI 1\",\"kode_daging\":[{\"kode\":\"PH 25 101 AA0\",\"berat\":\"30\",\"suhu_daging\":[\"25.3\",\"26.2\",\"24.3\",\"24.0\"],\"rata_rata_suhu\":\"24.95\",\"kondisi_daging\":\"Aroma segar, tidak busuk, bebas dari kontaminasi benda asing\"},{\"kode\":\"PH 26 101 AA0\",\"berat\":\"26.3\",\"suhu_daging\":[\"25.1\",\"26.0\",\"45.2\",\"12.0\"],\"rata_rata_suhu\":\"27.08\",\"kondisi_daging\":\"Aroma segar, tidak busuk, bebas dari kontaminasi benda asing\"},{\"kode\":\"PH 26 101 AA0\",\"berat\":\"25.5\",\"suhu_daging\":[null,null,null,null],\"rata_rata_suhu\":null,\"kondisi_daging\":\"Aroma segar, tidak busuk, bebas dari kontaminasi benda asing\"}],\"bahan_utama\":[{\"bahan\":\"A 134 CTR\",\"kode\":\"PH 25 101 AA0\",\"berat\":\"100\"},{\"bahan\":\"A 134 CTR\",\"kode\":\"PH 25 101 AA0\",\"berat\":\"120.2\"},{\"bahan\":\"A 134 CTR\",\"kode\":\"PH 25 101 AA0\",\"berat\":\"120.4\"}],\"bahan_lain\":[{\"premix\":\"Minyak Goreng\",\"kode\":\"17.08.25\",\"berat\":\"12.5\",\"sens\":\"sesuai\"},{\"premix\":\"Bawang Putih\",\"kode\":\"-\",\"berat\":\"20.3\",\"sens\":\"sesuai\"},{\"premix\":\"Es\",\"kode\":\"-\",\"berat\":\"180\",\"sens\":\"sesuai\"},{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"}],\"hasil_tumbling\":{\"0\":{\"suhu_daging\":[\"30.5\",\"20.5\",\"20.4\",\"30.2\"]},\"1\":{\"suhu_daging\":[\"40.2\",\"12.5\",\"16.2\",\"18.2\"]},\"2\":{\"suhu_daging\":[null,null,null,null]},\"rata_rata\":\"25.40\"},\"air\":\"100.5\",\"suhu_air\":\"20.5\",\"suhu_marinade\":\"10.2\",\"lama_pengadukan\":\"6\",\"brix\":\"10.5\",\"drum_on\":\"4\",\"drum_off\":\"2\",\"drum_speed\":\"34\",\"vacuum_time\":\"2\",\"total_time\":\"11\",\"mulai\":\"11:28\",\"selesai\":\"00:28\",\"kondisi\":\"Sensori sesuai\",\"catatan\":\"GAADA\"},\"2\":{\"batch\":\"2\",\"daging\":\"SBL Beef Blade Block 8 - 15 g\",\"asal\":\"CPI 1\",\"kode_daging\":[{\"kode\":\"PH 25 101 AA0\",\"berat\":\"60.2\",\"suhu_daging\":[\"20.2\",\"20.3\",\"15.2\",\"16.2\"],\"rata_rata_suhu\":\"17.98\",\"kondisi_daging\":\"Aroma segar, tidak busuk, bebas dari kontaminasi benda asing\"},{\"kode\":\"PH 25 101 AA0\",\"berat\":\"50.5\",\"suhu_daging\":[\"14.3\",\"16.7\",\"18.0\",\"18.5\"],\"rata_rata_suhu\":\"16.88\",\"kondisi_daging\":\"Aroma segar, tidak busuk, bebas dari kontaminasi benda asing\"},{\"kode\":\"PH 26 101 AA0\",\"berat\":\"40.5\",\"suhu_daging\":[null,null,null,null],\"rata_rata_suhu\":null,\"kondisi_daging\":\"Aroma segar, tidak busuk, bebas dari kontaminasi benda asing\"}],\"bahan_utama\":[{\"bahan\":\"A 134 CTR\",\"kode\":\"PH 25 101 AA0\",\"berat\":\"102.5\"},{\"bahan\":\"A 134 CTR\",\"kode\":\"PH 25 101 AA0\",\"berat\":\"100.3\"},{\"bahan\":\"A 134 CTR\",\"kode\":\"PH 25 101 AA0\",\"berat\":\"120.3\"}],\"bahan_lain\":[{\"kode\":\"17.08.25\",\"berat\":\"20.3\",\"sens\":\"sesuai\"},{\"kode\":\"-\",\"berat\":\"20.6\",\"sens\":\"sesuai\"},{\"kode\":\"-\",\"berat\":\"14.6\",\"sens\":\"sesuai\"},{\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"}],\"hasil_tumbling\":{\"0\":{\"suhu_daging\":[\"20.2\",\"20.1\",\"18.5\",\"17.5\"]},\"1\":{\"suhu_daging\":[\"14.3\",\"14.2\",\"14.3\",\"15.2\"]},\"2\":{\"suhu_daging\":[null,null,null,null]},\"rata_rata\":\"21.78\"},\"air\":\"100.5\",\"suhu_air\":\"20.5\",\"suhu_marinade\":\"10.2\",\"lama_pengadukan\":\"6\",\"brix\":\"11.2\",\"drum_on\":\"4\",\"drum_off\":\"2\",\"drum_speed\":\"22\",\"vacuum_time\":\"2\",\"total_time\":\"25\",\"mulai\":\"14:28\",\"selesai\":\"15:28\",\"kondisi\":\"Sensori sesuai\",\"catatan\":\"IYAAA\"}}', 'AAAAAAAAAAAAA', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-16 03:29:18', '2025-09-16 03:30:51'),
(12, '01996104-0eca-7109-b897-e79bfc83e8a2', 'Putri', NULL, '2025-09-19', '2', 'Fiesta Rice with Chicken Teriyaki', '{\"1\":{\"batch\":\"1\",\"daging\":\"SBL Beef Blade Block 8 - 15 g\",\"asal\":\"CPI 1\",\"kode_daging\":[{\"kode\":\"PH 25 101 AA0\",\"berat\":\"100\",\"suhu_daging\":[null,null,null,null],\"rata_rata_suhu\":null,\"kondisi_daging\":null},{\"kode\":\"PH 28 101 AA0\",\"berat\":\"200\",\"suhu_daging\":[null,null,null,null],\"rata_rata_suhu\":null,\"kondisi_daging\":null},{\"kode\":\"PH 26 101 AA0\",\"berat\":\"300\",\"suhu_daging\":[null,null,null,null],\"rata_rata_suhu\":null,\"kondisi_daging\":null},{\"kode\":\"PH 29 101 AA0\",\"berat\":\"400\"},{\"kode\":\"PH 27 101 AA0\",\"berat\":\"500\"},{\"kode\":\"PH 30 101 AA0\",\"berat\":\"600\"}],\"bahan_utama\":[{\"bahan\":null,\"kode\":null,\"berat\":null},{\"bahan\":null,\"kode\":null,\"berat\":null},{\"bahan\":null,\"kode\":null,\"berat\":null}],\"bahan_lain\":[{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"}],\"hasil_tumbling\":{\"0\":{\"suhu_daging\":[null,null,null,null]},\"1\":{\"suhu_daging\":[null,null,null,null]},\"2\":{\"suhu_daging\":[null,null,null,null]},\"rata_rata\":null},\"air\":null,\"suhu_air\":null,\"suhu_marinade\":null,\"lama_pengadukan\":null,\"brix\":null,\"drum_on\":null,\"drum_off\":null,\"drum_speed\":null,\"vacuum_time\":null,\"total_time\":null,\"mulai\":null,\"selesai\":null,\"kondisi\":null,\"catatan\":null}}', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-19 08:07:59', '2025-09-19 08:07:59'),
(13, '01996123-251d-704d-941e-0c97b048e19d', 'Putri', 'Harnis', '2025-09-19', '2', 'Fiesta Rice with Beef Bulgogi', '{\"1\":{\"batch\":\"1\",\"daging\":\"SBL Beef Blade Block 8 - 15 g\",\"asal\":\"CPI 1\",\"kode_daging\":[{\"kode\":\"PH 25 101 AA0\",\"berat\":\"12\",\"suhu_daging\":[\"12\",\"130.5\",null,null],\"rata_rata_suhu\":\"71.25\",\"kondisi_daging\":\"Aroma segar, tidak busuk, bebas dari kontaminasi benda asing\"},{\"kode\":\"PH 26 101 AA0\",\"berat\":\"123\",\"suhu_daging\":[\"32\",\"250\",null,null],\"rata_rata_suhu\":\"141.00\",\"kondisi_daging\":\"Aroma segar, tidak busuk, bebas dari kontaminasi benda asing\"},{\"kode\":\"PH 25 101 AA0\",\"berat\":\"200\",\"suhu_daging\":[null,null,null,null],\"rata_rata_suhu\":null,\"kondisi_daging\":null},{\"kode\":\"PH 25 101 AA0\",\"berat\":\"300\"},{\"kode\":\"PH 25 101 AA0\",\"berat\":\"400\"},{\"kode\":\"PH 25 101 AA0\",\"berat\":\"405\"}],\"bahan_utama\":[{\"bahan\":null,\"kode\":null,\"berat\":null},{\"bahan\":null,\"kode\":null,\"berat\":null},{\"bahan\":null,\"kode\":null,\"berat\":null}],\"bahan_lain\":[{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"premix\":null,\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"}],\"hasil_tumbling\":{\"0\":{\"suhu_daging\":[null,null,null,null]},\"1\":{\"suhu_daging\":[null,null,null,null]},\"2\":{\"suhu_daging\":[null,null,null,null]},\"rata_rata\":null},\"air\":null,\"suhu_air\":null,\"suhu_marinade\":null,\"lama_pengadukan\":null,\"brix\":null,\"drum_on\":null,\"drum_off\":null,\"drum_speed\":null,\"vacuum_time\":null,\"total_time\":null,\"mulai\":null,\"selesai\":null,\"kondisi\":null,\"catatan\":null},\"2\":{\"batch\":\"2\",\"daging\":\"SBL Beef Blade Block 8 - 15 g\",\"asal\":\"CPI 1\",\"kode_daging\":[{\"kode\":\"PH 25 101 AA0\",\"berat\":\"231\",\"suhu_daging\":[\"12\",\"30.2\",null,null],\"rata_rata_suhu\":\"21.10\",\"kondisi_daging\":\"Aroma segar, tidak busuk, bebas dari kontaminasi benda asing\"},{\"kode\":\"PH 25 101 AA0\",\"berat\":\"213\",\"suhu_daging\":[\"32\",\"52.2\",null,null],\"rata_rata_suhu\":\"42.10\",\"kondisi_daging\":\"Aroma segar, tidak busuk, bebas dari kontaminasi benda asing\"},{\"kode\":\"PH 25 101 AA0\",\"berat\":\"500\",\"suhu_daging\":[null,null,null,null],\"rata_rata_suhu\":null,\"kondisi_daging\":null},{\"kode\":\"PH 25 101 AA0\",\"berat\":\"600\"},{\"kode\":\"PH 25 101 AA0\",\"berat\":\"400\"},{\"kode\":\"PH 25 101 AA0\",\"berat\":\"500\"}],\"bahan_utama\":[{\"bahan\":null,\"kode\":null,\"berat\":null},{\"bahan\":null,\"kode\":null,\"berat\":null},{\"bahan\":null,\"kode\":null,\"berat\":null}],\"bahan_lain\":[{\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"},{\"kode\":null,\"berat\":null,\"sens\":\"tidak_sesuai\"}],\"hasil_tumbling\":{\"0\":{\"suhu_daging\":[null,null,null,null]},\"1\":{\"suhu_daging\":[null,null,null,null]},\"2\":{\"suhu_daging\":[null,null,null,null]},\"rata_rata\":null},\"air\":null,\"suhu_air\":null,\"suhu_marinade\":null,\"lama_pengadukan\":null,\"brix\":null,\"drum_on\":null,\"drum_off\":null,\"drum_speed\":null,\"vacuum_time\":null,\"total_time\":null,\"mulai\":null,\"selesai\":null,\"kondisi\":null,\"catatan\":null}}', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-19 08:41:57', '2025-09-19 08:57:59');

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
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `plant` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `type_user` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `activation` tinyint(1) DEFAULT NULL,
  `updater` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `name`, `username`, `password`, `plant`, `department`, `type_user`, `photo`, `email`, `email_verified_at`, `remember_token`, `activation`, `updater`, `created_at`, `updated_at`) VALUES
(1, 'd63c7564-98f2-11f0-89a1-a4ae122ff856', 'Admin', 'admin', '$2y$10$0K7bcblr/erit.iFY97cseSEapx6NzMJM.uXo7yl/AjJW4RfDtdsm', '1', '1', '0', NULL, 'admin@example.com', NULL, NULL, 1, 'Admin', '2025-09-24 03:02:18', '2025-09-24 04:12:34'),
(2, '01997aab-3cd4-71b5-93a3-812003d69e09', 'Guest', 'guest', '$2y$10$rv1NYVMVz0IZxnXn0/ExQex4RllM5V6T91z6a/vdi7uho0t4XSRmy', '1', '1', '4', NULL, NULL, NULL, NULL, NULL, 'Admin', '2025-09-24 07:41:06', '2025-09-24 07:41:06'),
(3, '01997ab8-f566-7120-b9f3-64e86da627d1', 'Ardillah Jaelani', 'ardillah.jaelani', '$2y$10$d/qzMS0SzJjYd2TVdayZGOR2xplqpHzSnc9UCouatmJqSNWRLus5e', '1', '2', '3', NULL, NULL, NULL, NULL, NULL, 'Admin', '2025-09-24 07:56:05', '2025-09-24 07:56:05'),
(4, '01997ab9-7dfd-7010-aec2-c8d93224c765', 'Khoerunnisa', 'khoerunnisa', '$2y$10$mbBufheXNMZ4Bmve6apMOegBc/Sq16oR/wADQYjjo51ZcJIN9yS.q', '1', '2', '3', NULL, NULL, NULL, NULL, NULL, 'Admin', '2025-09-24 07:56:40', '2025-09-24 07:56:40'),
(5, '01997ab9-ed21-7118-8843-bc2b0a049125', 'Suntaro', 'suntaro', '$2y$10$WSX6D1IOD8mgOTO4vXfvpekR6UI8qozuwdPcnu/a44sfyEiWvs1y2', '1', '2', '3', NULL, NULL, NULL, NULL, NULL, 'Admin', '2025-09-24 07:57:09', '2025-09-24 07:57:09');

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi_sanitasis`
--

CREATE TABLE `verifikasi_sanitasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `pukul` time NOT NULL,
  `area` varchar(255) NOT NULL,
  `mesin` varchar(255) NOT NULL,
  `cleaning_agents` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
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
-- Dumping data for table `verifikasi_sanitasis`
--

INSERT INTO `verifikasi_sanitasis` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `pukul`, `area`, `mesin`, `cleaning_agents`, `keterangan`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(2, '01996f4c-c04f-7051-81f8-0ab2553c2c98', 'Putri', 'Harnis', '2025-09-22', '1', '09:41:00', 'Packing', 'Chingfong', 'Diverfoam', 'okee', 'sudah bersih', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, NULL, NULL),
(3, '01997b1a-a41c-70b4-a102-fe897f6a7c90', 'admin', 'admin', '2025-09-24', '2', '16:42:00', 'Packing', 'Chingfong', 'Diverfoam', NULL, NULL, 'Khoerunnisa', '1', '2025-09-24 10:42:47', NULL, '0', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `xrays`
--

CREATE TABLE `xrays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `username` varchar(255) NOT NULL,
  `username_updated` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `shift` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kode_produksi` varchar(255) NOT NULL,
  `no_program` varchar(255) NOT NULL,
  `pemeriksaan` longtext NOT NULL,
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
-- Dumping data for table `xrays`
--

INSERT INTO `xrays` (`id`, `uuid`, `username`, `username_updated`, `date`, `shift`, `nama_produk`, `kode_produksi`, `no_program`, `pemeriksaan`, `catatan`, `nama_produksi`, `status_produksi`, `tgl_update_produksi`, `nama_spv`, `status_spv`, `catatan_spv`, `tgl_update_spv`, `created_at`, `updated_at`) VALUES
(1, '019932a4-2e94-707c-ac05-ae13cba9381e', 'Putri', 'Harnis', '2025-09-10', '1', 'Fiesta Rice with Beef Blackpepper', 'PF 23 101 BB0', '009', '\"[{\\\"pukul\\\":\\\"19:48\\\",\\\"glass_ball\\\":\\\"3.0-4.0\\\",\\\"glass_ball_status\\\":\\\"Oke\\\",\\\"ceramic\\\":\\\"3.0-4.0\\\",\\\"ceramic_status\\\":\\\"Oke\\\",\\\"sus_wire\\\":\\\"3.0-4.0\\\",\\\"sus_wire_status\\\":\\\"Oke\\\",\\\"sus_ball\\\":\\\"3.0-4.0\\\",\\\"sus_ball_status\\\":\\\"Oke\\\",\\\"keterangan\\\":\\\"Terdeteksi\\\",\\\"tindakan_koreksi\\\":\\\"-\\\"},{\\\"pukul\\\":\\\"19:01\\\",\\\"glass_ball\\\":\\\"3.0-4.0\\\",\\\"glass_ball_status\\\":\\\"Oke\\\",\\\"ceramic\\\":\\\"3.0-4.0\\\",\\\"ceramic_status\\\":\\\"Oke\\\",\\\"sus_wire\\\":\\\"3.0-4.0\\\",\\\"sus_wire_status\\\":\\\"Oke\\\",\\\"sus_ball\\\":\\\"3.0-4.0\\\",\\\"sus_ball_status\\\":\\\"Oke\\\",\\\"keterangan\\\":\\\"Terdeteksi\\\",\\\"tindakan_koreksi\\\":\\\"-\\\"}]\"', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-10 08:00:44', '2025-09-10 09:01:42'),
(2, '019932a7-2523-7321-b8e9-0a41ab8da6b9', 'Putri', 'Harnis', '2025-09-10', '2', 'Fiesta Rice with Chicken Rendang', 'OL 19 101 AA0', '009', '\"[{\\\"pukul\\\":\\\"18:01\\\",\\\"glass_ball\\\":\\\"3.0-4.0\\\",\\\"glass_ball_status\\\":\\\"Oke\\\",\\\"ceramic\\\":\\\"3.0-4.0\\\",\\\"ceramic_status\\\":\\\"Oke\\\",\\\"sus_wire\\\":\\\"3.0-4.0\\\",\\\"sus_wire_status\\\":\\\"Oke\\\",\\\"sus_ball\\\":\\\"3.0-4.0\\\",\\\"sus_ball_status\\\":\\\"Oke\\\",\\\"keterangan\\\":\\\"Terdeteksi\\\",\\\"tindakan_koreksi\\\":\\\"-\\\"}]\"', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-10 08:03:58', '2025-09-10 09:02:03'),
(3, '01995fe5-2896-7328-8626-ff546b152a64', 'Putri', NULL, '2025-09-19', '1', 'Fiesta Rice with Chicken Rendang', 'PG 10 101 AA0', '11', '\"[{\\\"pukul\\\":null,\\\"glass_ball\\\":null,\\\"ceramic\\\":null,\\\"sus_wire\\\":null,\\\"sus_ball\\\":null,\\\"keterangan\\\":\\\"Terdeteksi\\\",\\\"tindakan_koreksi\\\":null}]\"', NULL, 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-19 02:54:37', '2025-09-19 02:54:37');

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
(1, '9fc78249-ee4d-4341-b270-f640eff8d524', 'Putri', 'Harnis', '2025-09-02', 'Teriyaki', '1', 'PG 10 101 AA0', '30', '20', '12', '20', '26', '25', 'asda', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-02 05:52:11', '2025-09-16 03:34:12'),
(2, '9fc78525-3dee-4907-baba-48ee5cfce79b', 'Putri', 'Harnis', '2025-09-02', 'Vegetable', '1', 'PG 10 101 AA0', '25.6', '38', '15', '80', '3000', '3000', 'oke', 'Produksi RTM', '1', NULL, NULL, '0', NULL, NULL, '2025-09-02 06:00:11', '2025-09-16 01:49:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cold_storages`
--
ALTER TABLE `cold_storages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cold_storages_uuid_unique` (`uuid`);

--
-- Indexes for table `cookings`
--
ALTER TABLE `cookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cookings_uuid_unique` (`uuid`);

--
-- Indexes for table `departemens`
--
ALTER TABLE `departemens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departemens_uuid_unique` (`uuid`);

--
-- Indexes for table `disposisis`
--
ALTER TABLE `disposisis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `disposisis_uuid_unique` (`uuid`);

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
-- Indexes for table `gramasis`
--
ALTER TABLE `gramasis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gramasis_uuid_unique` (`uuid`);

--
-- Indexes for table `institusis`
--
ALTER TABLE `institusis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `institusis_uuid_unique` (`uuid`);

--
-- Indexes for table `iqfs`
--
ALTER TABLE `iqfs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iqfs_uuid_unique` (`uuid`);

--
-- Indexes for table `kebersihan_ruangs`
--
ALTER TABLE `kebersihan_ruangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kebersihan_ruangs_uuid_unique` (`uuid`);

--
-- Indexes for table `kontaminasis`
--
ALTER TABLE `kontaminasis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kontaminasis_uuid_unique` (`uuid`);

--
-- Indexes for table `mesins`
--
ALTER TABLE `mesins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mesins_uuid_unique` (`uuid`);

--
-- Indexes for table `metals`
--
ALTER TABLE `metals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `metals_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `noodles`
--
ALTER TABLE `noodles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `noodles_uuid_unique` (`uuid`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pemusnahans`
--
ALTER TABLE `pemusnahans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pemusnahans_uuid_unique` (`uuid`);

--
-- Indexes for table `pengemasans`
--
ALTER TABLE `pengemasans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengemasans_uuid_unique` (`uuid`);

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
-- Indexes for table `rejects`
--
ALTER TABLE `rejects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rejects_uuid_unique` (`uuid`);

--
-- Indexes for table `repacks`
--
ALTER TABLE `repacks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `repacks_uuid_unique` (`uuid`);

--
-- Indexes for table `retains`
--
ALTER TABLE `retains`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `retains_uuid_unique` (`uuid`);

--
-- Indexes for table `returs`
--
ALTER TABLE `returs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `returs_uuid_unique` (`uuid`);

--
-- Indexes for table `rices`
--
ALTER TABLE `rices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rices_uuid_unique` (`uuid`);

--
-- Indexes for table `sample_bulanans`
--
ALTER TABLE `sample_bulanans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sample_bulanans_uuid_unique` (`uuid`);

--
-- Indexes for table `sample_retains`
--
ALTER TABLE `sample_retains`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sample_retains_uuid_unique` (`uuid`);

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
-- Indexes for table `steamers`
--
ALTER TABLE `steamers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `steamers_uuid_unique` (`uuid`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `submissions_uuid_unique` (`uuid`);

--
-- Indexes for table `suhus`
--
ALTER TABLE `suhus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suhus_uuid_unique` (`uuid`);

--
-- Indexes for table `tahapans`
--
ALTER TABLE `tahapans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tahapans_uuid_unique` (`uuid`);

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
-- Indexes for table `thumblings`
--
ALTER TABLE `thumblings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `thumblings_uuid_unique` (`uuid`);

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
-- Indexes for table `verifikasi_sanitasis`
--
ALTER TABLE `verifikasi_sanitasis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `verifikasi_sanitasis_uuid_unique` (`uuid`);

--
-- Indexes for table `xrays`
--
ALTER TABLE `xrays`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `xrays_uuid_unique` (`uuid`);

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
-- AUTO_INCREMENT for table `cold_storages`
--
ALTER TABLE `cold_storages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cookings`
--
ALTER TABLE `cookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `departemens`
--
ALTER TABLE `departemens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `disposisis`
--
ALTER TABLE `disposisis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gmps`
--
ALTER TABLE `gmps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gramasis`
--
ALTER TABLE `gramasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `institusis`
--
ALTER TABLE `institusis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `iqfs`
--
ALTER TABLE `iqfs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kebersihan_ruangs`
--
ALTER TABLE `kebersihan_ruangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kontaminasis`
--
ALTER TABLE `kontaminasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mesins`
--
ALTER TABLE `mesins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `metals`
--
ALTER TABLE `metals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `noodles`
--
ALTER TABLE `noodles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pemusnahans`
--
ALTER TABLE `pemusnahans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengemasans`
--
ALTER TABLE `pengemasans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `produksis`
--
ALTER TABLE `produksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rejects`
--
ALTER TABLE `rejects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `repacks`
--
ALTER TABLE `repacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `retains`
--
ALTER TABLE `retains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `returs`
--
ALTER TABLE `returs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rices`
--
ALTER TABLE `rices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sample_bulanans`
--
ALTER TABLE `sample_bulanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sample_retains`
--
ALTER TABLE `sample_retains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sanitasis`
--
ALTER TABLE `sanitasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sortasis`
--
ALTER TABLE `sortasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `steamers`
--
ALTER TABLE `steamers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suhus`
--
ALTER TABLE `suhus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tahapans`
--
ALTER TABLE `tahapans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT for table `thumblings`
--
ALTER TABLE `thumblings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `timbangans`
--
ALTER TABLE `timbangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `verifikasi_sanitasis`
--
ALTER TABLE `verifikasi_sanitasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `xrays`
--
ALTER TABLE `xrays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `yoshinoyas`
--
ALTER TABLE `yoshinoyas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
