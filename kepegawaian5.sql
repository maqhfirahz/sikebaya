-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Apr 2025 pada 15.15
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kepegawaian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_harian`
--

CREATE TABLE `absensi_harian` (
  `id` int(11) NOT NULL,
  `id_pegawai` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` enum('Hadir','Sakit','Alpha') NOT NULL,
  `waktu_input` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi_harian`
--

INSERT INTO `absensi_harian` (`id`, `id_pegawai`, `tanggal`, `status`, `waktu_input`) VALUES
(12, '133', '2025-04-07', 'Hadir', '2025-04-07 13:04:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_cuti`
--

CREATE TABLE `data_cuti` (
  `id_cuti` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `jenis_cuti` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` enum('Pending','Disetujui','Ditolak') DEFAULT 'Pending',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_cuti`
--

INSERT INTO `data_cuti` (`id_cuti`, `id_pegawai`, `jenis_cuti`, `tanggal_mulai`, `tanggal_selesai`, `status`, `keterangan`, `created_at`) VALUES
(5, 133, 'Cuti Tahunan', '2025-04-30', '2025-05-07', 'Disetujui', 'izin bos', '2025-04-07 04:12:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jabatan`
--

CREATE TABLE `data_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(120) NOT NULL,
  `gaji_pokok` varchar(50) NOT NULL,
  `tj_transport` varchar(50) NOT NULL,
  `uang_makan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_jabatan`
--

INSERT INTO `data_jabatan` (`id_jabatan`, `nama_jabatan`, `gaji_pokok`, `tj_transport`, `uang_makan`) VALUES
(1, 'IT Support', '4000000', '100000', '40000'),
(2, 'Programmer', '6000000', '1000000', '500000'),
(3, 'PM', '5000000', '3000000', '1000000'),
(8, 'Admin', '5000000', '2000000', '1000000'),
(13, 'Data Analyst', '7000000', '1500000', '800000'),
(14, 'Software Engineer', '8000000', '2000000', '1000000'),
(15, 'DevOps Engineer', '9000000', '2500000', '1200000'),
(16, 'UI/UX Designer', '6500000', '1800000', '900000'),
(17, 'QA Engineer', '7500000', '2200000', '1100000'),
(18, 'Technical Writer', '6000000', '1700000', '750000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kehadiran`
--

CREATE TABLE `data_kehadiran` (
  `id_kehadiran` int(11) NOT NULL,
  `bulan` varchar(15) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_pegawai` varchar(225) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL,
  `hadir` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `alpha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_kehadiran`
--

INSERT INTO `data_kehadiran` (`id_kehadiran`, `bulan`, `nik`, `nama_pegawai`, `jenis_kelamin`, `nama_jabatan`, `hadir`, `sakit`, `alpha`) VALUES
(1, '052025', '8888', 'sakjcnn', 'Laki-Laki', 'Programmer', 14, 2, 11),
(3, '062025', '8888', 'sakjcnn', 'Laki-Laki', 'Programmer', 16, 5, 9),
(7, '052025', '55555', 'dean', 'Laki-Laki', 'IT Support', 29, 0, 2),
(8, '052025', '978', 'sasa', 'Perempuan', 'Admin', 31, 0, 0),
(9, '032025', '327500000000148', 'Aditya Pratama', 'Laki-Laki', 'Software Engineer', 27, 0, 0),
(10, '032025', '327500000000138', 'Ahmad Surya', 'Laki-Laki', 'Data Analyst', 27, 0, 0),
(11, '032025', '327500000000150', 'Bagas Widodo', 'Laki-Laki', 'Programmer', 27, 0, 0),
(12, '032025', '44433', 'dani', 'Laki-Laki', 'PM', 27, 0, 0),
(13, '032025', '55555', 'dean', 'Laki-Laki', 'IT Support', 27, 0, 0),
(14, '032025', '327500000000140', 'Dwi Pratama', 'Laki-Laki', 'UI/UX Designer', 27, 0, 0),
(15, '032025', '327500000000142', 'Fajar Ramadhan', 'Laki-Laki', 'Programmer', 27, 0, 0),
(16, '032025', '8888', 'idaten', 'Laki-Laki', 'Programmer', 27, 0, 0),
(17, '032025', '327500000000143', 'Intan Sari', 'Perempuan', 'Software Engineer', 27, 0, 0),
(18, '032025', '327500000000146', 'Iqbal Fadhilah', 'Laki-Laki', 'DevOps Engineer', 27, 0, 0),
(19, '032025', '327500000000144', 'Muhammad Rizky', 'Laki-Laki', 'Programmer', 27, 0, 0),
(20, '032025', '327500000000145', 'Nadia Amalia', 'Perempuan', 'Programmer', 27, 0, 0),
(21, '032025', '327500000000149', 'Putri Ayu', 'Perempuan', 'Technical Writer', 27, 0, 0),
(22, '032025', '327500000000139', 'Rina Putri', 'Perempuan', 'Data Analyst', 27, 0, 0),
(23, '032025', '327500000000151', 'Riska Fitria', 'Perempuan', 'UI/UX Designer', 27, 0, 0),
(24, '032025', '327500000000152', 'Ryan Septian', 'Laki-Laki', 'DevOps Engineer', 27, 0, 0),
(25, '032025', '978', 'sasa', 'Perempuan', 'Programmer', 27, 0, 0),
(26, '032025', '327500000000153', 'Shinta Dewi', 'Perempuan', 'QA Engineer', 27, 0, 0),
(27, '032025', '327500000000141', 'Siti Nurul', 'Perempuan', 'Programmer', 27, 0, 0),
(28, '032025', '0', 'Super User', 'Laki-Laki', 'Admin', 0, 0, 0),
(29, '032025', '327500000000154', 'Tri Budiman', 'Laki-Laki', 'UI/UX Designer', 27, 0, 0),
(30, '032025', '327500000000155', 'Umi Salma', 'Perempuan', 'Technical Writer', 27, 0, 0),
(31, '032025', '327500000000147', 'Vera Dwi', 'Perempuan', 'QA Engineer', 27, 0, 0),
(32, '032025', '327500000000156', 'Wahyu Setiawan', 'Laki-Laki', 'QA Engineer', 20, 0, 7),
(33, '032025', '2147483647', 'Yulia Rahma', 'Perempuan', 'UI/UX Designer', 25, 0, 2),
(34, '042025', '55555', 'dean', 'Laki-Laki', 'IT Support', 1, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nik` varchar(15) DEFAULT NULL,
  `nama_pegawai` varchar(225) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `photo` varchar(225) NOT NULL,
  `hak_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_pegawai`
--

INSERT INTO `data_pegawai` (`id_pegawai`, `nik`, `nama_pegawai`, `username`, `password`, `jenis_kelamin`, `jabatan`, `tanggal_masuk`, `status`, `photo`, `hak_akses`) VALUES
(131, '978', 'sasa', 'dai', '698d51a19d8a121ce581499d7b701668', 'Perempuan', 'Programmer', '2025-04-06', 'Pegawai Tetap', '15707964671244.png', 2),
(133, '55555', 'dean', 'dean', 'bcbe3365e6ac95ea2c0343a2395834dd', 'Laki-Laki', 'IT Support', '2025-04-06', 'Pegawai Tetap', 'undraw_profile1.svg', 2),
(134, '0', 'Super User', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Laki-Laki', 'Admin', '2024-07-01', 'Pegawai Tetap', 'undraw_profile_21.svg', 1),
(137, '44433', 'dani', 'dani', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', 'PM', '2025-04-07', 'Pegawai Tetap', '1570952304765.png', 2),
(138, '327500000000138', 'Ahmad Surya', 'ahmad', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', 'Data Analyst', '2023-10-01', 'Pegawai Tetap', 'default1.png', 2),
(139, '327500000000139', 'Rina Putri', 'rina', '202cb962ac59075b964b07152d234b70', 'Perempuan', 'Data Analyst', '2023-10-02', 'Pegawai Tetap', 'undraw_profile_31.svg', 2),
(140, '327500000000140', 'Dwi Pratama', 'dwi', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', 'UI/UX Designer', '2023-10-03', 'Pegawai Tetap', 'photo.png', 2),
(141, '327500000000141', 'Siti Nurul', 'siti', '202cb962ac59075b964b07152d234b70', 'Perempuan', 'Programmer', '2023-10-04', 'Pegawai Tetap', 'photo.png', 2),
(142, '327500000000142', 'Fajar Ramadhan', 'fajar', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', 'Programmer', '2023-10-05', 'Pegawai Tetap', 'photo.png', 2),
(143, '327500000000143', 'Intan Sari', 'intan', '202cb962ac59075b964b07152d234b70', 'Perempuan', 'Software Engineer', '2023-10-06', 'Pegawai Tetap', 'photo.png', 2),
(144, '327500000000144', 'Muhammad Rizky', 'rizky', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', 'Programmer', '2023-10-07', 'Pegawai Tetap', 'photo.png', 2),
(145, '327500000000145', 'Nadia Amalia', 'nadia', '202cb962ac59075b964b07152d234b70', 'Perempuan', 'Programmer', '2023-10-08', 'Pegawai Tetap', 'photo.png', 2),
(146, '327500000000146', 'Iqbal Fadhilah', 'iqbal', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', 'DevOps Engineer', '2023-10-09', 'Pegawai Tetap', 'photo.png', 2),
(147, '327500000000147', 'Vera Dwi', 'vera', '202cb962ac59075b964b07152d234b70', 'Perempuan', 'QA Engineer', '2023-10-10', 'Pegawai Tetap', 'photo.png', 2),
(148, '327500000000148', 'Aditya Pratama', 'aditya', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', 'Software Engineer', '2023-10-11', 'Pegawai Tetap', 'photo.png', 2),
(149, '327500000000149', 'Putri Ayu', 'putri', '202cb962ac59075b964b07152d234b70', 'Perempuan', 'Technical Writer', '2023-10-12', 'Pegawai Tetap', 'photo.png', 2),
(150, '327500000000150', 'Bagas Widodo', 'bagas', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', 'Programmer', '2023-10-13', 'Pegawai Tetap', 'photo.png', 2),
(151, '327500000000151', 'Riska Fitria', 'riski', '202cb962ac59075b964b07152d234b70', 'Perempuan', 'UI/UX Designer', '2023-10-14', 'Pegawai Tetap', 'photo.png', 2),
(152, '327500000000152', 'Ryan Septian', 'ryan', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', 'DevOps Engineer', '2023-10-15', 'Pegawai Tetap', 'photo.png', 2),
(153, '327500000000153', 'Shinta Dewi', 'shinta', '202cb962ac59075b964b07152d234b70', 'Perempuan', 'QA Engineer', '2023-10-16', 'Pegawai Tetap', 'photo.png', 2),
(154, '327500000000154', 'Tri Budiman', 'tri', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', 'UI/UX Designer', '2023-10-17', 'Pegawai Tetap', 'photo.png', 2),
(155, '327500000000155', 'Umi Salma', 'umi', '202cb962ac59075b964b07152d234b70', 'Perempuan', 'Technical Writer', '2023-10-18', 'Pegawai Tetap', 'photo.png', 2),
(156, '327500000000156', 'Wahyu Setiawan', 'wahyu', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', 'QA Engineer', '2023-10-19', 'Pegawai Tetap', 'photo.png', 2),
(157, '2147483647', 'Yulia Rahma', 'yulia', '202cb962ac59075b964b07152d234b70', 'Perempuan', 'UI/UX Designer', '2023-10-20', 'Pegawai Tetap', 'photo.png', 2),
(158, '1234456788', 'Ucup pucU', 'ucup', '202cb962ac59075b964b07152d234b70', 'Laki-Laki', 'QA Engineer', '2025-04-07', 'Pegawai Tetap', 'default2.png', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `hak_akses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hak_akses`
--

INSERT INTO `hak_akses` (`id`, `keterangan`, `hak_akses`) VALUES
(1, 'admin', 1),
(2, 'pegawai', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `potongan_gaji`
--

CREATE TABLE `potongan_gaji` (
  `id_poga` int(11) NOT NULL,
  `potongan` varchar(100) NOT NULL,
  `jml_potongan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `potongan_gaji`
--

INSERT INTO `potongan_gaji` (`id_poga`, `potongan`, `jml_potongan`) VALUES
(3, 'Izin', 0),
(4, 'Alpha', 100000),
(11, 'Sakit', 0),
(12, 'Cuti', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi_harian`
--
ALTER TABLE `absensi_harian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_cuti`
--
ALTER TABLE `data_cuti`
  ADD PRIMARY KEY (`id_cuti`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `data_jabatan`
--
ALTER TABLE `data_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`);

--
-- Indeks untuk tabel `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `potongan_gaji`
--
ALTER TABLE `potongan_gaji`
  ADD PRIMARY KEY (`id_poga`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi_harian`
--
ALTER TABLE `absensi_harian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `data_cuti`
--
ALTER TABLE `data_cuti`
  MODIFY `id_cuti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `data_jabatan`
--
ALTER TABLE `data_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  MODIFY `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `data_pegawai`
--
ALTER TABLE `data_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `potongan_gaji`
--
ALTER TABLE `potongan_gaji`
  MODIFY `id_poga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_cuti`
--
ALTER TABLE `data_cuti`
  ADD CONSTRAINT `data_cuti_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `data_pegawai` (`id_pegawai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
