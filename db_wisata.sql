-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 14 Agu 2024 pada 05.44
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wisata`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `partisipan` int(20) NOT NULL,
  `tanggal` date NOT NULL,
  `durasi` int(11) NOT NULL,
  `penginapan` tinyint(1) NOT NULL DEFAULT 0,
  `transportasi` tinyint(1) NOT NULL DEFAULT 0,
  `makanan` tinyint(1) NOT NULL DEFAULT 0,
  `tiket` int(11) NOT NULL,
  `subtotal` bigint(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `nama`, `telp`, `partisipan`, `tanggal`, `durasi`, `penginapan`, `transportasi`, `makanan`, `tiket`, `subtotal`, `total`, `createdAt`) VALUES
(262603, 'Alfian', '081219034353', 2, '2024-08-15', 1, 1, 0, 1, 20000, 1520000, 3040000, '2024-08-13 22:25:54'),
(629441, 'Zaenal', '0838434', 5, '2024-08-15', 1, 0, 1, 0, 30000, 1230000, 6150000, '2024-08-13 22:26:41'),
(916307, 'Zaenal Alfian', '081219034353', 1, '2024-08-15', 1, 1, 0, 0, 50000, 1050000, 1050000, '2024-08-13 13:14:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempat_wisata`
--

CREATE TABLE `tempat_wisata` (
  `id` int(11) NOT NULL,
  `nama_lokasi` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tempat_wisata`
--

INSERT INTO `tempat_wisata` (`id`, `nama_lokasi`, `kategori`, `harga`, `lokasi`, `gambar`, `createdAt`) VALUES
(131303, 'Wisata Alam Kaliwungu', 'Populer', 20000, 'Karawang Barat', 'https://i.ibb.co.com/p1BJgFm/kaliwungu.png', '2024-08-13 04:12:05'),
(159133, 'Wisata Bersejarah Candi Jiwa', 'Monumen', 30000, 'Batujaya', 'https://i.ibb.co.com/mtHnDfW/candijiwa.png', '2024-08-10 08:28:07'),
(185692, 'Wisata Bersejarah Candi Jiwa', 'Populer', 30000, 'Batujaya', 'https://i.ibb.co.com/mtHnDfW/candijiwa.png', '2024-08-13 22:28:20'),
(546997, 'Wisata Alam Kaliwungu', 'Alam', 20000, 'Karawang Barat', 'https://i.ibb.co.com/p1BJgFm/kaliwungu.png', '2024-08-10 06:52:48'),
(769343, 'Pantai Tanjung Pakis', 'Populer', 50000, 'Pakisjaya', 'https://i.ibb.co.com/MSTgRyJ/pakis.png', '2024-08-13 04:10:56'),
(904044, 'Pantai Tanjung Pakis', 'Pantai', 50000, 'Pakisjaya', 'https://i.ibb.co.com/MSTgRyJ/pakis.png', '2024-08-10 06:49:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('operator','customer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `role`) VALUES
(5344, 'Zaenal Alfian', 'zaenal@gmail.com', '$2y$10$inHcZlftOtBKoQDrypUIz.lT0/V9.q1.3251U4EKCWIaMdvdC8SL.', 'operator'),
(5345, 'Operator', 'operator@gmail.com', '$2y$10$RAqwSBAkKHbKJBBXwQ99JegZAymGusDidWd9BQGj/1ofy/AbZ5heC', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tempat_wisata`
--
ALTER TABLE `tempat_wisata`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=958132;

--
-- AUTO_INCREMENT untuk tabel `tempat_wisata`
--
ALTER TABLE `tempat_wisata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=904045;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5346;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
