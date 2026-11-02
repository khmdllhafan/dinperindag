-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 01 Nov 2026 pada 20.32
-- Versi server: 8.4.3
-- Versi PHP: 8.3.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `dinperindag`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang`
--

CREATE TABLE `bidang` (
  `no` int NOT NULL,
  `bidang` varchar(32) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bidang`
--

INSERT INTO `bidang` (`no`, `bidang`) VALUES
(1, 'kepala dinas'),
(4, 'perdagangan'),
(5, 'perindustrian'),
(3, 'sdp'),
(2, 'sekretariat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int NOT NULL,
  `nama` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `nip` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `bidang` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('PNS','NON-PNS') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `nip`, `jabatan`, `bidang`, `status`) VALUES
(128, 'Andi Saputra', '197812312001121001', 'Kasubbag Umum', 'sekretariat', 'PNS'),
(129, 'Budi Santoso', '198001012002121002', 'Staf', 'sekretariat', 'PNS'),
(130, 'Citra Dewi', '198203152003032003', 'Kasubbag Keuangan', 'perdagangan', 'PNS'),
(131, 'Dedi Pratama', '197905012004041004', 'Staf', 'perdagangan', 'PNS'),
(132, 'Eka Lestari', '198510112005052005', 'Staf', 'sdp', 'PNS'),
(133, 'Fajar Nugroho', '198707072006062006', 'Staf', 'sdp', 'PNS'),
(134, 'Gita Anjani', '198912112007072007', 'Kasubbag TU', 'perindustrian', 'PNS'),
(135, 'Hari Prasetyo', '197811112008082008', 'Staf', 'perindustrian', 'PNS'),
(136, 'Intan Maharani', '198312312009092009', 'Staf', 'kepala dinas', 'PNS'),
(137, 'Joko Suyono', '197705012010102010', 'Staf', 'kepala dinas', 'PNS'),
(138, 'Kiki Ramadhan', NULL, 'Staf', 'sekretariat', 'NON-PNS'),
(139, 'Lina Puspita', NULL, 'Staf', 'sekretariat', 'NON-PNS'),
(140, 'Mahendra Putra', NULL, 'Staf', 'perdagangan', 'NON-PNS'),
(141, 'Nia Safitri', NULL, 'Staf', 'perdagangan', 'NON-PNS'),
(142, 'Okta Rahayu', NULL, 'Staf', 'sdp', 'NON-PNS'),
(143, 'Putra Wijaya', NULL, 'Staf', 'sdp', 'NON-PNS'),
(144, 'Qory Rahmawati', NULL, 'Staf', 'perindustrian', 'NON-PNS'),
(145, 'Rendy Kurniawan', NULL, 'Staf', 'perindustrian', 'NON-PNS'),
(146, 'Sari Amalia', NULL, 'Staf', 'kepala dinas', 'NON-PNS'),
(147, 'Teguh Firmansyah', NULL, 'Staf', 'kepala dinas', 'NON-PNS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perjalanan_dinas`
--

CREATE TABLE `perjalanan_dinas` (
  `ID` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `no_sp` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `pembuat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kegiatan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tujuan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_pulang` date NOT NULL,
  `jenis_dinas` enum('Dinas Luar','Dinas Dalam') COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perjalanan_dinas`
--

INSERT INTO `perjalanan_dinas` (`ID`, `nama`, `no_sp`, `pembuat`, `kegiatan`, `tujuan`, `tanggal`, `tanggal_pulang`, `jenis_dinas`) VALUES
(1, 'Andi Saputra, budi santoso', 'SP001', 'Dedi Pratama', 'Monitoring harga pangan', 'Pasar Bojong', '2025-01-05', '2025-01-06', NULL),
(2, 'Budi Santoso', 'SP002', 'Eka Lestari', 'Rakor lintas OPD', 'Kantor Bupati', '2025-01-10', '2025-01-10', NULL),
(3, 'Citra Dewi', 'SP003', 'Fajar Hidayat', 'Pelatihan aplikasi SIPEG', 'Semarang', '2025-01-15', '2025-01-17', NULL),
(4, 'Dedi Pratama', 'SP004', 'Gita Sari', 'Studi banding UMKM', 'Kudus', '2025-01-22', '2025-01-23', NULL),
(5, 'Eka Lestari', 'SP005', 'Hana Putri', 'Bimbingan teknis', 'Yogyakarta', '2025-02-03', '2025-02-05', NULL),
(6, 'Fajar Hidayat', 'SP006', 'Irfan Maulana', 'Pameran produk lokal', 'Jakarta', '2025-02-10', '2025-02-13', NULL),
(7, 'Gita Sari', 'SP007', 'Joko Prabowo', 'Koordinasi kegiatan', 'Kantor Gubernur', '2025-02-20', '2025-02-20', NULL),
(8, 'Hari Prasetyo', 'SP008', 'Kiki Amelia', 'Sosialisasi peraturan baru', 'Bandung', '2025-02-27', '2025-02-28', NULL),
(9, 'Intan Maharani', 'SP009', 'Lina Marlina', 'Evaluasi triwulan', 'Kantor Sekda', '2025-03-02', '2025-03-02', NULL),
(10, 'Joko Prabowo', 'SP010', 'Maya Sari', 'Konsultasi sistem baru', 'Kemenperin', '2025-03-07', '2025-03-08', NULL),
(11, 'Kiki Ramadhan', 'SP011', 'Nanda Rizki', 'Studi banding pengelolaan pasar', 'Surakarta', '2025-03-10', '2025-03-11', NULL),
(12, 'Lina Puspita', 'SP012', 'Oka Yuliana', 'Workshop digitalisasi UMKM', 'Malang', '2025-03-15', '2025-03-17', NULL),
(13, 'Maya Sari', 'SP013', 'Putri Melati', 'Bimtek laporan keuangan', 'Cilacap', '2025-03-20', '2025-03-22', NULL),
(14, 'Mahendra Putra', 'SP014', 'Qori Ahmad', 'Seminar ekonomi kreatif', 'Jakarta', '2025-03-25', '2025-03-26', NULL),
(15, 'Okta Rahayu', 'SP015', 'Rina Anggraeni', 'Rapat penyusunan anggaran', 'Kantor DPRD', '2025-04-01', '2025-04-01', NULL),
(16, 'Putra Wijaya', 'SP016', 'Seno Wirawan', 'Survei potensi ekonomi', 'Batang', '2025-04-03', '2025-04-04', NULL),
(17, 'Qory Rahmawati', 'SP017', 'Tari Lestari', 'Focus group discussion', 'Magelang', '2025-04-05', '2025-04-06', NULL),
(18, 'Rendy Kurniawan', 'SP018', 'Umar Aziz', 'Koordinasi instansi', 'Kantor Gubernur', '2025-04-10', '2025-04-10', NULL),
(19, 'Sari Amalia', 'SP019', 'Vina Oktaviani', 'Rakor dengan mitra daerah', 'Demak', '2025-04-12', '2025-04-12', NULL),
(20, 'Teguh Firmansyah', 'SP020', 'Wawan Hermawan', 'Pelatihan sistem dinas', 'Kendal', '2025-04-15', '2025-04-16', NULL),
(21, 'Umi Kalsum', 'SP021', 'Xenia Pratiwi', 'Sosialisasi kewajiban pajak', 'Temanggung', '2025-04-17', '2025-04-18', NULL),
(22, 'Vino Septian', 'SP022', 'Yusuf Kurniawan', 'Evaluasi bulanan', 'Kantor Dinas', '2025-04-20', '2025-04-20', NULL),
(23, 'Wawan Hermawan', 'SP023', 'Zahra Indah', 'Pengawasan lapangan', 'Weleri', '2025-04-22', '2025-04-23', NULL),
(24, 'Xenia Pratiwi', 'SP024', 'Andi Saputra', 'Penyusunan dokumen kerja', 'Bandung', '2025-04-25', '2025-04-27', NULL),
(25, 'Yusuf Kurniawan', 'SP025', 'Budi Santoso', 'Workshop pengolahan data', 'Semarang', '2025-04-28', '2025-04-29', NULL),
(26, 'Zahra Indah', 'SP026', 'Citra Dewi', 'Rapat kerja tahunan', 'Kantor Dinas', '2025-04-30', '2025-04-30', NULL),
(27, 'Andi Saputra', 'SP027', 'Dedi Pratama', 'Peninjauan pasar tradisional', 'Comal', '2025-03-05', '2025-03-05', NULL),
(28, 'Citra Dewi', 'SP028', 'Eka Lestari', 'Diskusi produk unggulan', 'Kendal', '2025-02-14', '2025-02-15', NULL),
(29, 'Fajar Hidayat', 'SP029', 'Gita Sari', 'Rapat teknis tahunan', 'Kantor Dinas', '2025-01-30', '2025-01-30', NULL),
(30, 'Joko Prabowo', 'SP030', 'Hana Putri', 'Pelatihan export produk', 'Jakarta', '2025-03-12', '2025-03-13', NULL),
(31, 'Budi santoso, Hari Prasetyo, Intan Maharani', 'SP0031', 'Admin', 'Rapat Koordinasi', 'Jakarta', '2025-03-10', '2025-03-10', NULL),
(32, 'afan', '123132e', 'afan', 'wljcnowdjsnoqewimcxa', 'jbciwdnj owjdsc', '2025-04-14', '2025-04-14', 'Dinas Luar'),
(33, 'afan', '1232112313434', 'afan', 'ejnckmwldsd,;x', 'gvrefefeiwdmfobndeowfmd', '2025-04-21', '2025-04-21', 'Dinas Dalam'),
(34, 'Nia Safitri', '265151651', 'afan', 'tbrwyhbteyhbwr', 'sdsdaververv', '2025-04-23', '2025-04-23', 'Dinas Luar'),
(35, 'Citra Dewi, Dedi Pratama, ${nama}', '252335351651615', 'afan', 'lavnjeiqewkfvlvf', 'ekvbuevhiquv', '2025-04-23', '2025-04-23', 'Dinas Luar'),
(36, 'Mahendra Putra, Nia Safitri, ${nama}', 'sd855', 'afan', 'dqwdqxweffdadffa', 'hfxyjtcyrft', '2025-04-23', '2025-04-23', 'Dinas Luar'),
(37, 'Citra Dewi, Mahendra Putra, Dedi Pratama, ${nama}', 'sa85', 'afan', 'dqwdqxweffdadffa', 'acsdcedwqsewaf', '2025-04-23', '2025-04-23', 'Dinas Dalam'),
(38, 'Citra Dewi, Mahendra Putra, nama', 'sm10', 'afan', 'awefsadsdcdswF', 'wdwdfwdfwd', '2025-04-23', '2025-04-23', 'Dinas Luar'),
(39, 'Citra Dewi, Mahendra Putra, ', 'sd855', 'afan', 'sdfvsadvweafwef', 'assdcawsevaedsf', '2025-04-23', '2025-04-23', 'Dinas Luar'),
(40, 'Citra Dewi, Mahendra Putra', 'wea1123', 'afan', 'qwdwdsfdssad', 'qwddwqwsds', '2025-04-23', '2025-04-23', 'Dinas Dalam'),
(41, 'Citra Dewi, Mahendra Putra', 'we2121', 'afan', 'wfefewrf', 'wfefwefw', '2025-04-24', '2025-04-24', 'Dinas Dalam'),
(42, 'Citra Dewi, Nia Safitri', 'wew21', 'afan', 'eqrfqecefvcqefq3erf', 'dccerfceqw', '2025-04-24', '2025-04-24', 'Dinas Dalam'),
(43, 'Dedi Pratama, Mahendra Putra', 'we2323', 'anang', 'sfbsdfrstghbsrtbsfrtgb', 'srgsfbrsgbsrtgbsrtgb', '2025-04-24', '2025-04-24', 'Dinas Dalam'),
(44, 'Dedi Pratama, Mahendra Putra, Dedi Pratama', 'se121', 'anang', 'wfvwr 3rfwergfewrfd', 'wfeeqvevwrvwrvwgvergqerfe', '2025-04-24', '2025-04-24', 'Dinas Luar'),
(45, 'Citra Dewi, Mahendra Putra, Nia Safitri', 'asd1231', 'anang', 'rerfedceff', 'fefwfewfw3f', '2025-04-24', '2025-04-24', 'Dinas Luar'),
(46, 'Citra Dewi, Dedi Pratama', 't4erd', 'afan', 'dqwdqxweffdadffa', 'acsdcedwqsewaf', '2025-04-25', '2025-04-26', 'Dinas Dalam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pivot`
--

CREATE TABLE `pivot` (
  `no_sp` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_perdin` int NOT NULL,
  `id_pegawai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pivot`
--

INSERT INTO `pivot` (`no_sp`, `id_perdin`, `id_pegawai`) VALUES
('SP001', 1, 128),
('SP002', 2, 129),
('SP003', 3, 130),
('SP004', 4, 131),
('SP005', 5, 132),
('SP006', 6, 133),
('SP007', 7, 134),
('SP008', 8, 135),
('SP009', 9, 136),
('SP010', 10, 137),
('SP011', 11, 138),
('SP012', 12, 139),
('SP013', 13, 140),
('SP014', 14, 141),
('SP015', 15, 142),
('SP016', 16, 143),
('SP017', 17, 144),
('SP018', 18, 145),
('SP019', 19, 146),
('SP020', 20, 147),
('SP021', 21, 128),
('SP022', 22, 129),
('SP023', 23, 130),
('SP024', 24, 131),
('SP025', 25, 132),
('SP001', 1, 129),
('SP001', 1, 129),
('SP001', 1, 129),
('SP0031', 31, 129),
('SP0031', 31, 135),
('SP0031', 31, 136),
(NULL, 34, 130),
(NULL, 34, 131),
(NULL, 34, 141),
(NULL, 35, 130),
(NULL, 35, 131),
(NULL, 36, 140),
(NULL, 36, 141),
(NULL, 37, 130),
(NULL, 37, 140),
(NULL, 37, 131),
(NULL, 38, 130),
(NULL, 38, 140),
(NULL, 39, 130),
(NULL, 39, 140),
(NULL, 40, 130),
(NULL, 40, 140),
(NULL, 41, 130),
(NULL, 41, 140),
(NULL, 42, 130),
(NULL, 42, 141),
('we2323', 43, 131),
('we2323', 43, 140),
('se121', 44, 140),
('se121', 44, 131),
('asd1231', 45, 130),
('asd1231', 45, 140),
('asd1231', 45, 141),
('t4erd', 46, 130),
('t4erd', 46, 131);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('anang', 'a4df9190139007b6170229b83b4be5fd50bebf8e'),
('admin', '$2y$10$kIvQiXHmnBwBSgQ3.Pmrzu0rTYdw38A7q'),
('admin123', '$2y$10$D.hT16nU1XZaV.orktadDebpQfOmObnA9'),
('afan', '$2y$10$7LMpF3d6vVeIm4hPWL3P9ukGNSCqi2paxj.jSvLQUuBC6aIqLrrsy'),
('perdagangan', '$2y$10$8yGMTQmt5VQLxcYA9/vbJOaEM99Eoq7jyOt2uDwwLOZgsmRfENHVq'),
('Ardi', '$2y$10$O0GJMuh9fQOluhAwURbOIuwS2vq.ylBMNG6lUsODilA3f3bu9.5k6');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `Bidang` (`bidang`) USING BTREE;

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `perjalanan_dinas`
--
ALTER TABLE `perjalanan_dinas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Nama` (`nama`),
  ADD KEY `no_sp` (`no_sp`);

--
-- Indeks untuk tabel `pivot`
--
ALTER TABLE `pivot`
  ADD KEY `id_perdin` (`id_perdin`),
  ADD KEY `no_sp` (`no_sp`),
  ADD KEY `id_pegawai` (`id_pegawai`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bidang`
--
ALTER TABLE `bidang`
  MODIFY `no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT untuk tabel `perjalanan_dinas`
--
ALTER TABLE `perjalanan_dinas`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
