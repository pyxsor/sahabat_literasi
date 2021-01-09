-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jan 2021 pada 15.16
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sahabat_literasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `penulis` varchar(50) DEFAULT NULL,
  `tahun` varchar(10) DEFAULT NULL,
  `penerbit` varchar(80) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `cover` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `judul`, `penulis`, `tahun`, `penerbit`, `lokasi`, `status`, `cover`) VALUES
(8, 'Dunia Sophie', 'Jostein Garder', '2000', 'Mizan', 'MOLING-2', 'Dipinjam', 'Dunia Sophie_5fed4fd6e2169.jpeg'),
(9, 'Ayahku bukan Pembohong', 'Tereliye', '2001', 'Gramedia', 'MOLING-1', 'Dipinjam', 'Ayahku bukan Pembohong_5fed501cd82b5.jpeg'),
(10, 'Rintik Sedu Kata', 'Tsana', '2017', 'Gramedia', 'MOLING-3', 'Tersedia', 'Rintik Sedu Kata_5fed5065808d7.jpeg'),
(11, 'Jatuh dan Cinta', 'Boy Candra', '2006', 'Mizan', 'MOLING-1', 'Dipinjam', 'Jatuh dan Cinta_5fed50ce1192b.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `id_buku` int(10) NOT NULL,
  `nama_peminjam` varchar(50) NOT NULL,
  `alamat_peminjam` varchar(100) NOT NULL,
  `notelp_peminjam` varchar(20) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status_peminjaman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `id_buku`, `nama_peminjam`, `alamat_peminjam`, `notelp_peminjam`, `tanggal_pinjam`, `tanggal_kembali`, `status_peminjaman`) VALUES
(1, 8, 'sadd', 'asdsad', 'adsad', '2021-01-07', '2021-01-21', 'Sudah Kembali'),
(7, 9, 'awdawdawd', 'asdsad', 'adsad', '2021-01-21', '2021-01-30', 'Sudah Kembali'),
(8, 10, 'awdawdawd', 'asdsad', 'adsad', '2021-01-20', '2021-01-23', 'Sudah Kembali'),
(9, 11, 'sadd', 'asdsad', 'adsad', '2021-01-07', '2021-01-06', 'Belum Kembali'),
(10, 9, '234', '234', '234', '2021-01-08', '1970-01-01', 'Belum Kembali'),
(11, 8, 'sadd', 'asdsad', 'adsad', '2021-01-08', '2021-01-22', 'Belum Kembali');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', '123'),
(2, '234', '$2y$10$zyNTalfOgyAkMlVko8OxquZu3/fLy6Zafdi9BF26NXE9/TvR6Jy9O'),
(5, '123', '$2y$10$2ElwUKFllxKdhGwOaYz9H.95XDXUMPcINvJHusFOoSJaPLXUOvOiy'),
(6, '345', '$2y$10$qKxlA8iiiH2UTd16/cdF.u.qx6kLp7scX0EYcACUr7l9WqRhKQyfS'),
(8, '456', '$2y$10$/LG/WwtUOS5mMl3IuE4Uz.4Dr4/rLqDUKvdmaRtVU6aUxtxwQsUKe'),
(9, 'admin', '$2y$10$h285fimS90xspnxR3hbnl.dlNOabVIbjlGnLF.gWTUQ3efgqGrX22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
