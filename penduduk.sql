-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Apr 2023 pada 05.39
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penduduk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'Administrator'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama`, `status`, `email`, `password`, `level`) VALUES
('axsj001sAOWn', 'Erik Wahyudi', 'Admin web', 'erik@gmail.com', '202cb962ac59075b964b07152d234b70', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama` varchar(50) NOT NULL,
  `pendidikan` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `hubungan` varchar(100) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `id_kk` varchar(50) NOT NULL,
  `id_rt` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'anggota_kk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `jenis_kelamin`, `tgl_lahir`, `agama`, `pendidikan`, `pekerjaan`, `hubungan`, `nik`, `id_kk`, `id_rt`, `level`) VALUES
('A001TYC1ZWrkelhS', 'Ratnasari', 'Perempuan', '1983-03-12', 'Islam', 'D3', 'Wiraswasta', 'Istri', '3502115203830007', 'K001MehsVaetEa2N', 'jfeed001jddSWc', 'anggota_kk'),
('A002760ObMjkIFOH', 'Nabila Faiz Indrastata', 'Perempuan', '2009-02-17', 'Islam', 'SMP', 'Pelajar/Mahasiswa', 'Anak', '3502115702090004', 'K001MehsVaetEa2N', 'jfeed001jddSWc', 'anggota_kk'),
('A003ItYWt2Mfso3P', 'Naeva Aisy Anindya', 'Perempuan', '2013-12-13', 'Islam', 'SD', 'Pelajar/Mahasiswa', 'Anak', '3502115312130001', 'K001MehsVaetEa2N', 'jfeed001jddSWc', 'anggota_kk'),
('A004i0Lrs4QuXvyo', 'Fahri Alfath Aryasetya', 'Laki-laki', '2017-12-26', 'Islam', 'Tidak Sekolah', 'Belum/Tidak Bekerja', 'Anak', '3502112612170001', 'K001MehsVaetEa2N', 'jfeed001jddSWc', 'anggota_kk'),
('A005tLnlg6n3GCzT', 'Mualif Syaifl Bakri', 'Laki-laki', '1982-07-21', 'Islam', 'D4', 'Kepolisian RI', 'Suami', '3502112107820005', 'K001MehsVaetEa2N', 'jfeed001jddSWc', 'anggota_kk'),
('A006blqkF9zP9IJR', 'Soiman', 'Laki-laki', '1967-06-30', 'Islam', 'SMP', 'Belum/Tidak Bekerja', 'Lainnya', '3502113006670066', 'K003OsocExjAHR9C', 'jfeed001jddSWc', 'anggota_kk'),
('A007JUKeOSb1RzCH', 'Sabar Wahyu Eko', 'Laki-laki', '1964-03-09', 'Islam', 'SMP', 'Petani/Pekebun', 'Suami', '3502111903640006', 'K004pP0LF3wzmZ8n', 'jfeed001jddSWc', 'anggota_kk'),
('A008wigE6bypfccH', 'Mujiati', 'Perempuan', '1963-10-21', 'Islam', 'SD', 'Petani/Pekebun', 'Istri', '3502116110630001', 'K004pP0LF3wzmZ8n', 'jfeed001jddSWc', 'anggota_kk'),
('A009XXL0o8NAxQYp', 'Risqi Wahyu Alfajar', 'Laki-laki', '1999-02-28', 'Islam', 'SMA', 'Wiraswasta', 'Anak', '3502112802990001', 'K004pP0LF3wzmZ8n', 'jfeed001jddSWc', 'anggota_kk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_informasi`
--

CREATE TABLE `tb_informasi` (
  `id_informasi` varchar(50) NOT NULL,
  `informasi` text NOT NULL,
  `berkas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_informasi`
--

INSERT INTO `tb_informasi` (`id_informasi`, `informasi`, `berkas`) VALUES
('I0015LKklU', '<p><span style=\"font-size:22px\"><strong>Selamat Datang Di Web Data Penduduk Ds. Jalen</strong></span></p>\r\n\r\n<p><span style=\"font-size:14px\"><strong>1. Web app ini masih dalam pengembangan, mohon pengertiannya jika nanti menemui suatu error</strong></span></p>\r\n\r\n<p><span style=\"font-size:14px\"><strong>2. untuk info lebih lanjut bisa menghubungi cs@kassandra.my.id sbg dari pengembangan web</strong></span></p>\r\n', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kk`
--

CREATE TABLE `tb_kk` (
  `id_kk` varchar(50) NOT NULL,
  `no_kk` varchar(50) NOT NULL,
  `nama_kk` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `foto_kk` text NOT NULL,
  `password` text NOT NULL,
  `id_rt` varchar(50) NOT NULL,
  `uuid` text NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'kepala_kk'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kk`
--

INSERT INTO `tb_kk` (`id_kk`, `no_kk`, `nama_kk`, `alamat`, `no_hp`, `foto_kk`, `password`, `id_rt`, `uuid`, `level`) VALUES
('K001MehsVaetEa2N', '3502112407070001', 'Mualif Syaiful Bakri', 'Jl. Gajah Mada Dkh. Medelan', '087758999875', 'Mualif Syaiful Bakri_64339cb808121.jpg', '202cb962ac59075b964b07152d234b70', 'jfeed001jddSWc', 'JvibHIeIkLvlswEuGmny', 'kepala_kk'),
('K003OsocExjAHR9C', '3502110405210001', 'Soiman', 'Jl. H. Agus salim', '111111111111', '', '202cb962ac59075b964b07152d234b70', 'jfeed001jddSWc', 'Vy7DkCPz0iNaQ13wBSgt', 'kepala_kk'),
('K004pP0LF3wzmZ8n', '3502111211011026', 'Sabar Wahyu Eko', 'Jl. H. Agus Salim RT. 007 RW. 003 Dkh. Medelan Ds. Jalen', '999999999999', '', '202cb962ac59075b964b07152d234b70', 'jfeed001jddSWc', 'aarvOIC1SZRtK7AKznPZ', 'kepala_kk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rt`
--

CREATE TABLE `tb_rt` (
  `id_rt` varchar(50) NOT NULL,
  `no_rt` varchar(50) NOT NULL,
  `nama_rt` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'ketua_rt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_rt`
--

INSERT INTO `tb_rt` (`id_rt`, `no_rt`, `nama_rt`, `alamat`, `no_hp`, `password`, `level`) VALUES
('jfeed001jddSWc', '007', 'Zhamrin', 'Jl. H. Agus salim', '087758999875', '202cb962ac59075b964b07152d234b70', 'ketua_rt'),
('RT00183eRdZr0ObWy', '002', 'Soilan', 'Jl. Hassanudin Dkh. Medelan', '999999999999', '202cb962ac59075b964b07152d234b70', 'ketua_rt'),
('RT001KeaT2w', '001', 'Wahyu', 'Jl. blbla dkh. jalen', '1233456789', '202cb962ac59075b964b07152d234b70', 'ketua_rt');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `id_kk` (`id_kk`);

--
-- Indeks untuk tabel `tb_informasi`
--
ALTER TABLE `tb_informasi`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indeks untuk tabel `tb_kk`
--
ALTER TABLE `tb_kk`
  ADD PRIMARY KEY (`id_kk`),
  ADD KEY `id_rt` (`id_rt`);

--
-- Indeks untuk tabel `tb_rt`
--
ALTER TABLE `tb_rt`
  ADD PRIMARY KEY (`id_rt`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD CONSTRAINT `tb_anggota_ibfk_1` FOREIGN KEY (`id_kk`) REFERENCES `tb_kk` (`id_kk`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_kk`
--
ALTER TABLE `tb_kk`
  ADD CONSTRAINT `tb_kk_ibfk_1` FOREIGN KEY (`id_rt`) REFERENCES `tb_rt` (`id_rt`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
