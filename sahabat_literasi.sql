-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Des 2020 pada 04.58
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
(4, 'Hujan', 'Tereliye', '2005', 'Mizan', 'MOLING-1', 'Tersedia', 'Hujan_5fe1460b13014.png'),
(6, 'Rindu', 'Tereliye', '2006', 'Mizan', 'MOLING-2', 'Tersedia', 'Rindu_5fe33cf691c32.jpg'),
(7, 'Khadijah', 'Sibel Eraslan', '2000', 'Gramedia', 'MOLING-3', 'Tersedia', 'Khadijah_5fe369c16eb0b.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
