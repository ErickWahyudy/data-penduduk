#
# TABLE STRUCTURE FOR: tb_admin
#

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `id_admin` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'Administrator',
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_admin` (`id_admin`, `nama`, `status`, `email`, `password`, `level`) VALUES ('axsj001sAOWn', 'Erik Wahyudi', 'Admin web', 'erik@gmail.com', '202cb962ac59075b964b07152d234b70', 'Administrator');


#
# TABLE STRUCTURE FOR: tb_anggota
#

DROP TABLE IF EXISTS `tb_anggota`;

CREATE TABLE `tb_anggota` (
  `id_anggota` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp_anggota` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `pendidikan` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `hubungan` varchar(100) NOT NULL,
  `perkawinan` varchar(11) NOT NULL,
  `kewarganegaraan` varchar(3) NOT NULL,
  `nama_ayah` varchar(255) NOT NULL,
  `nama_ibu` varchar(255) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `id_kk` varchar(50) NOT NULL,
  `id_rt` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'anggota_kk',
  PRIMARY KEY (`id_anggota`),
  KEY `id_kk` (`id_kk`),
  CONSTRAINT `tb_anggota_ibfk_1` FOREIGN KEY (`id_kk`) REFERENCES `tb_kk` (`id_kk`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `no_hp_anggota`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `agama`, `pendidikan`, `pekerjaan`, `hubungan`, `perkawinan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `nik`, `id_kk`, `id_rt`, `level`) VALUES ('A001TYC1ZWrkelhS', 'Ratnasari', '', 'Perempuan', '1983-03-12', 'Ponorogo', 'Islam', 'D3', 'Wiraswasta', 'Istri', 'Kawin', 'WNI', '', '', '3502115203830007', 'K001MehsVaetEa2N', 'jfeed001jddSWc', 'anggota_kk');
INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `no_hp_anggota`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `agama`, `pendidikan`, `pekerjaan`, `hubungan`, `perkawinan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `nik`, `id_kk`, `id_rt`, `level`) VALUES ('A002760ObMjkIFOH', 'Nabila Faiz Indrastata', '', 'Perempuan', '2009-02-17', 'Ponorogo', 'Islam', 'SMP', 'Pelajar/Mahasiswa', 'Anak', 'Belum Kawin', 'WNI', '', '', '3502115702090004', 'K001MehsVaetEa2N', 'jfeed001jddSWc', 'anggota_kk');
INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `no_hp_anggota`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `agama`, `pendidikan`, `pekerjaan`, `hubungan`, `perkawinan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `nik`, `id_kk`, `id_rt`, `level`) VALUES ('A003ItYWt2Mfso3P', 'Naeva Aisy Anindya', '', 'Perempuan', '2013-12-13', 'Ponorogo', 'Islam', 'SD', 'Belum/Tidak Bekerja', 'Anak', 'Belum Kawin', 'WNI', '', '', '3502115312130001', 'K001MehsVaetEa2N', 'jfeed001jddSWc', 'anggota_kk');
INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `no_hp_anggota`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `agama`, `pendidikan`, `pekerjaan`, `hubungan`, `perkawinan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `nik`, `id_kk`, `id_rt`, `level`) VALUES ('A004i0Lrs4QuXvyo', 'Fahri Alfath Aryasetya', '', 'Laki-laki', '2017-12-26', '', 'Islam', 'Tidak Sekolah', 'Belum/Tidak Bekerja', 'Anak', '', '', '', '', '3502112612170001', 'K001MehsVaetEa2N', 'jfeed001jddSWc', 'anggota_kk');
INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `no_hp_anggota`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `agama`, `pendidikan`, `pekerjaan`, `hubungan`, `perkawinan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `nik`, `id_kk`, `id_rt`, `level`) VALUES ('A005tLnlg6n3GCzT', 'Mualif Syaifl Bakri', '', 'Laki-laki', '1982-07-21', '', 'Islam', 'D4', 'Kepolisian RI', 'Suami', '', '', '', '', '3502112107820005', 'K001MehsVaetEa2N', 'jfeed001jddSWc', 'anggota_kk');
INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `no_hp_anggota`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `agama`, `pendidikan`, `pekerjaan`, `hubungan`, `perkawinan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `nik`, `id_kk`, `id_rt`, `level`) VALUES ('A006blqkF9zP9IJR', 'Soiman', '', 'Laki-laki', '1967-06-30', 'Ponorogo', 'Islam', 'SMP', 'Belum/Tidak Bekerja', 'Lainnya', 'Kawin', 'WNI', '', '', '3502113006670066', 'K003OsocExjAHR9C', 'jfeed001jddSWc', 'anggota_kk');
INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `no_hp_anggota`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `agama`, `pendidikan`, `pekerjaan`, `hubungan`, `perkawinan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `nik`, `id_kk`, `id_rt`, `level`) VALUES ('A007JUKeOSb1RzCH', 'Sabar Wahyu Eko', '', 'Laki-laki', '1964-03-09', '', 'Islam', 'SMP', 'Petani/Pekebun', 'Suami', '', '', '', '', '3502111903640006', 'K004pP0LF3wzmZ8n', 'jfeed001jddSWc', 'anggota_kk');
INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `no_hp_anggota`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `agama`, `pendidikan`, `pekerjaan`, `hubungan`, `perkawinan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `nik`, `id_kk`, `id_rt`, `level`) VALUES ('A008wigE6bypfccH', 'Mujiati', '', 'Perempuan', '1963-10-21', '', 'Islam', 'SD', 'Petani/Pekebun', 'Istri', '', '', '', '', '3502116110630001', 'K004pP0LF3wzmZ8n', 'jfeed001jddSWc', 'anggota_kk');
INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `no_hp_anggota`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `agama`, `pendidikan`, `pekerjaan`, `hubungan`, `perkawinan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `nik`, `id_kk`, `id_rt`, `level`) VALUES ('A009XXL0o8NAxQYp', 'Risqi Wahyu Alfajar', '62877578172', 'Laki-laki', '1999-02-28', 'ponorogo', 'Islam', 'SMA', 'Wiraswasta', 'Anak', 'Kawin', 'WNI', '', '', '3502112802990001', 'K004pP0LF3wzmZ8n', 'jfeed001jddSWc', 'anggota_kk');
INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `no_hp_anggota`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `agama`, `pendidikan`, `pekerjaan`, `hubungan`, `perkawinan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `nik`, `id_kk`, `id_rt`, `level`) VALUES ('A010bRx6QUwaYy2i', 'Daman', '121', 'Laki-laki', '1951-06-30', 'Ponorogo', 'Islam', 'SD', 'Petani/Pekebun', 'Kepala Keluarga', 'Kawin', 'WNI', 'Tukiran', 'Surip', '3502113006510137', 'K005PcxMPJMXG6mD', 'jfeed001jddSWc', 'anggota_kk');
INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `no_hp_anggota`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `agama`, `pendidikan`, `pekerjaan`, `hubungan`, `perkawinan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `nik`, `id_kk`, `id_rt`, `level`) VALUES ('A011zI6PDNdjwJGt', 'Katijem', '', 'Perempuan', '1958-08-28', '', 'Islam', 'SD', 'Petani/Pekebun', 'Istri', 'Kawin', 'WNI', 'Saniman', 'Sadinem', '3502116808580001', 'K005PcxMPJMXG6mD', 'jfeed001jddSWc', 'anggota_kk');
INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `no_hp_anggota`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `agama`, `pendidikan`, `pekerjaan`, `hubungan`, `perkawinan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `nik`, `id_kk`, `id_rt`, `level`) VALUES ('A012mn8V2U4ZuUHd', 'Solikin', '', 'Laki-laki', '1970-03-10', 'Ponorogo', 'Islam', 'SD', 'Petani/Pekebun', 'Kepala Keluarga', 'Kawin', 'WNI', '', '', '3502111003700001', 'K006nFRjCbsqWfTY', 'jfeed001jddSWc', 'anggota_kk');
INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `no_hp_anggota`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `agama`, `pendidikan`, `pekerjaan`, `hubungan`, `perkawinan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `nik`, `id_kk`, `id_rt`, `level`) VALUES ('A0130wwmaVC5117g', 'Mukadasah', '', 'Laki-laki', '1981-09-15', 'Ponorogo', 'Islam', 'SMA', 'Petani/Pekebun', 'Istri', 'Kawin', 'WNI', '', '', '3502125509810001', 'K006nFRjCbsqWfTY', 'jfeed001jddSWc', 'anggota_kk');
INSERT INTO `tb_anggota` (`id_anggota`, `nama`, `no_hp_anggota`, `jenis_kelamin`, `tgl_lahir`, `tempat_lahir`, `agama`, `pendidikan`, `pekerjaan`, `hubungan`, `perkawinan`, `kewarganegaraan`, `nama_ayah`, `nama_ibu`, `nik`, `id_kk`, `id_rt`, `level`) VALUES ('A014Qqm5ZtuIiET5', 'man', '11123411', 'Laki-laki', '2023-08-18', 'ponorogo', 'Islam', 'SD', 'Belum/Tidak Bekerja', 'Kepala Keluarga', 'Kawin', 'WNI', '', '', '21221221212', 'K003OsocExjAHR9C', 'jfeed001jddSWc', 'anggota_kk');


#
# TABLE STRUCTURE FOR: tb_data_lain
#

DROP TABLE IF EXISTS `tb_data_lain`;

CREATE TABLE `tb_data_lain` (
  `id_data_lain` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `id_rt` varchar(50) NOT NULL,
  PRIMARY KEY (`id_data_lain`),
  KEY `id_rt` (`id_rt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_data_lain` (`id_data_lain`, `nama`, `nik`, `jenis_kelamin`, `alamat`, `keterangan`, `tanggal`, `id_rt`) VALUES ('D001kU5vUxeAUCz1', 'Kademo', '3502110000000000', 'Laki-laki', 'Jl. Agus salim Dkh. Medelan', 'Meninggal', '2023-04-05', 'jfeed001jddSWc');


#
# TABLE STRUCTURE FOR: tb_informasi
#

DROP TABLE IF EXISTS `tb_informasi`;

CREATE TABLE `tb_informasi` (
  `id_informasi` varchar(50) NOT NULL,
  `informasi` text NOT NULL,
  `berkas` text NOT NULL,
  PRIMARY KEY (`id_informasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_informasi` (`id_informasi`, `informasi`, `berkas`) VALUES ('I0015LKklU', '<p><span style=\"font-size:22px\"><strong>Selamat Datang Di Web Data Penduduk Ds. Jalen</strong></span></p>\r\n\r\n<p><span style=\"font-size:14px\"><strong>1. Web app ini masih dalam pengembangan, mohon pengertiannya jika nanti menemui suatu error</strong></span></p>\r\n\r\n<p><span style=\"font-size:14px\"><strong>2. untuk info lebih lanjut bisa menghubungi cs@kassandra.my.id sbg dari pengembangan web</strong></span></p>\r\n', '');


#
# TABLE STRUCTURE FOR: tb_kk
#

DROP TABLE IF EXISTS `tb_kk`;

CREATE TABLE `tb_kk` (
  `id_kk` varchar(50) NOT NULL,
  `no_kk` varchar(50) NOT NULL,
  `nama_kk` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `foto_kk` text NOT NULL,
  `id_rt` varchar(50) NOT NULL,
  `tgl_update` datetime NOT NULL,
  `uuid` text NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'kepala_kk',
  PRIMARY KEY (`id_kk`),
  KEY `id_rt` (`id_rt`),
  CONSTRAINT `tb_kk_ibfk_1` FOREIGN KEY (`id_rt`) REFERENCES `tb_rt` (`id_rt`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_kk` (`id_kk`, `no_kk`, `nama_kk`, `alamat`, `no_hp`, `foto_kk`, `id_rt`, `tgl_update`, `uuid`, `level`) VALUES ('K001MehsVaetEa2N', '3502112407070001', 'Mualif Syaiful Bakri', 'Jl. Gajah Mada Dkh. Medelan', '087758999875', 'Mualif Syaiful Bakri_6447bad17bfbf.jpg', 'jfeed001jddSWc', '2023-05-06 21:35:46', 'MGavhjVOWRAHwtWERE1h', 'kepala_kk');
INSERT INTO `tb_kk` (`id_kk`, `no_kk`, `nama_kk`, `alamat`, `no_hp`, `foto_kk`, `id_rt`, `tgl_update`, `uuid`, `level`) VALUES ('K003OsocExjAHR9C', '3502110405210001', 'Soiman', 'Jl. H. Agus salim', '111111111111', '', 'jfeed001jddSWc', '2023-08-18 15:01:16', 'Vy7DkCPz0iNaQ13wBSgt', 'kepala_kk');
INSERT INTO `tb_kk` (`id_kk`, `no_kk`, `nama_kk`, `alamat`, `no_hp`, `foto_kk`, `id_rt`, `tgl_update`, `uuid`, `level`) VALUES ('K004pP0LF3wzmZ8n', '3502111211011026', 'Sabar Wahyu Eko', 'Jl. H. Agus Salim RT. 007 RW. 003 Dkh. Medelan Ds. Jalen', '999999999999', '', 'jfeed001jddSWc', '2023-08-18 15:30:09', 'aarvOIC1SZRtK7AKznPZ', 'kepala_kk');
INSERT INTO `tb_kk` (`id_kk`, `no_kk`, `nama_kk`, `alamat`, `no_hp`, `foto_kk`, `id_rt`, `tgl_update`, `uuid`, `level`) VALUES ('K005PcxMPJMXG6mD', '3502111211011085', 'Daman', 'Jl. Agus salim Dkh. Medelan', '', '', 'jfeed001jddSWc', '2023-08-24 08:24:47', '8CeXXnHYqj7OhnEZQyZA', 'kepala_kk');
INSERT INTO `tb_kk` (`id_kk`, `no_kk`, `nama_kk`, `alamat`, `no_hp`, `foto_kk`, `id_rt`, `tgl_update`, `uuid`, `level`) VALUES ('K006nFRjCbsqWfTY', '3502111109160001', 'Solikin', 'Jl. Agus salim Dkh. Medelan', '', '', 'jfeed001jddSWc', '2023-05-06 20:47:43', '', 'kepala_kk');
INSERT INTO `tb_kk` (`id_kk`, `no_kk`, `nama_kk`, `alamat`, `no_hp`, `foto_kk`, `id_rt`, `tgl_update`, `uuid`, `level`) VALUES ('K007D8mq3mFLgriH', '3502111211010959', 'Boyadi', 'Jl. Agus salim Dkh. Medelan', '', '', 'jfeed001jddSWc', '2023-05-06 20:49:45', '', 'kepala_kk');
INSERT INTO `tb_kk` (`id_kk`, `no_kk`, `nama_kk`, `alamat`, `no_hp`, `foto_kk`, `id_rt`, `tgl_update`, `uuid`, `level`) VALUES ('K008OdUlAzvQ6Few', '3502111211011098', 'Aji Suwarno', 'Jl. Agus salim Dkh. Medelan', '6289606790384', '', 'jfeed001jddSWc', '2023-08-18 14:46:46', '', 'kepala_kk');
INSERT INTO `tb_kk` (`id_kk`, `no_kk`, `nama_kk`, `alamat`, `no_hp`, `foto_kk`, `id_rt`, `tgl_update`, `uuid`, `level`) VALUES ('K009ePQFuNitKlLT', '3502111508230004', 'Adji Soko', 'Jl. Agus salim Dkh. Medelan', '000000', '', 'jfeed001jddSWc', '2023-08-24 08:27:39', '', 'kepala_kk');


#
# TABLE STRUCTURE FOR: tb_rt
#

DROP TABLE IF EXISTS `tb_rt`;

CREATE TABLE `tb_rt` (
  `id_rt` varchar(50) NOT NULL,
  `no_rt` varchar(50) NOT NULL,
  `nama_rt` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `id_token` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'ketua_rt',
  PRIMARY KEY (`id_rt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_rt` (`id_rt`, `no_rt`, `nama_rt`, `alamat`, `no_hp`, `email`, `password`, `id_token`, `level`) VALUES ('jfeed001jddSWc', '007', 'Zhamrin', 'Jl. H. Agus salim', '087758999875', 'septian@gmail.com', '202cb962ac59075b964b07152d234b70', 'T001', 'ketua_rt');
INSERT INTO `tb_rt` (`id_rt`, `no_rt`, `nama_rt`, `alamat`, `no_hp`, `email`, `password`, `id_token`, `level`) VALUES ('RT00183eRdZr0ObWy', '002', 'Soilan', 'Jl. Hassanudin Dkh. Medelan', '999999999999', '', '202cb962ac59075b964b07152d234b70', '', 'ketua_rt');
INSERT INTO `tb_rt` (`id_rt`, `no_rt`, `nama_rt`, `alamat`, `no_hp`, `email`, `password`, `id_token`, `level`) VALUES ('RT001KeaT2w', '001', 'Wahyu', 'Jl. blbla dkh. jalen', '1233456789', '', '202cb962ac59075b964b07152d234b70', '', 'ketua_rt');


#
# TABLE STRUCTURE FOR: tb_token
#

DROP TABLE IF EXISTS `tb_token`;

CREATE TABLE `tb_token` (
  `id_token` varchar(50) NOT NULL,
  `token` text NOT NULL,
  `expired` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_token` (`id_token`, `token`, `expired`) VALUES ('T001', 'nB4ceSphw8kWjUjgS19HQm9OU', '2023-05-31 20:26:06');


