
CREATE TABLE kriteria (
  id_kriteria int(11) NOT NULL AUTO_INCREMENT,
  nama_kriteria varchar(50) NOT NULL,
  bobot_kriteria float NOT NULL,
  attribute set('benefit', 'cost') NOT NULL,
  PRIMARY KEY (id_kriteria)
);
CREATE TABLE alternatif (
  id_alternatif int(11) NOT NULL AUTO_INCREMENT,
  nama_alternatif varchar(50) NOT NULL,
  PRIMARY KEY (id_alternatif)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
CREATE TABLE nilai_evaluasi (
  id_alternatif int(11) UNSIGNED NOT NULL,
  id_kriteria int(11) UNSIGNED NOT NULL,
  nilai float NOT NULL
); 
CREATE TABLE usesr (
  id_user int(11) NOT NULL AUTO_INCREMENT,
  username varchar(50) NOT NULL,
  password varchar(50) NOT NULL,
  PRIMARY KEY (id_user)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
INSERT INTO usesr (id_user, username, password)
VALUES (1, 'admin', 'admin');
--insert kriteria--
INSERT INTO kriteria (
    id_kriteria,
    nama_kriteria,
    bobot_kriteria,
    attribute
  )
VALUES 
  (1, 'Pelaksanaan  Pembelajaran', '0.1', 'benefit'),
  (2,'Interaksi Belajar Mengajar','0.15','benefit'),
  (3, 'Tugas Rutin', '0.05', 'benefit'),
  (4, 'Kedisiplinan', '0.1', 'benefit'),
  (5, 'Penggunaan IT', '0.1', 'cost'),
  (6, 'Kepuasan Siswa', '0.05', 'cost'),
  (7, 'Kreativitas', '0.1', 'benefit'),
  (8, 'Produktivitas', '0.05', 'benefit'),
  (9, 'Interaksi Sosial', '0.05', 'cost'),
  (10, 'Tanggung Jawab', '0.25', 'benefit');
INSERT INTO alternatif (id_alternatif, nama_alternatif)
VALUES (1, 'Ades Sastra Saragih, ST'),
  (2, 'Eli Wahyuni, S.Pd'),
  (3, 'Elsa Surbakti, S.Pd'),
  (4, 'Fitri Ananda, S.Pd'),
  (5, 'Hadinata, S.Kom'),
  (6, 'Hotnida Situmong, S.Pak'),
  (7, 'Irwan, S.Pd'),
  (8, 'Jafrina Sari, S.Pd'),
  (9, 'Lina Syafriani, S.Pd'),
  (10, 'Muhammad Amsari, S.Pd'),
  (11, 'Selfia Rosa, S.Pd'),
  (12, 'Juka Damanik, S.Pd'),
  (13, 'Esa Mandiahna, S.Pd'),
  (14, 'Nur Asia, S.Pd'),
  (15, 'Royon Sirumpea, S.Kom'),
  (16, 'Nurmayana, S.Kom'),
  (17, 'Risma Yanti, S.E'),
  (18, 'Siti Aisah, S.Pd'),
  (19, 'Sastra, S.Pd'),
  (20, 'Nurisna Chaniago, S.Kom');
INSERT into nilai_evaluasi (id_alternatif, id_kriteria, nilai)
VALUES 
(1, 1, 0.25),
(1, 2, 0.3333),
(1, 3, 0.25),
(1, 4, 1),
(1, 5, 1),
(1, 6, 0.6667),
(1, 7, 1),
(1, 8, 1),
(1, 9, 1),
(1, 10, 0.3333),
(2, 1, 0.25),
(2, 2, 0.6667),
(2, 3, 0.25),
(2, 4, 0.75),
(2, 5, 1),
(2, 6, 1),
(2, 7, 1),
(2, 8, 0.6667),
(2, 9, 0.5),
(2, 10, 1),
(3, 1, 0.5),
(3, 2, 1),
(3, 3, 0.75),
(3, 4, 0.5),
(3, 5, 1),
(3, 6, 1),
(3, 7, 1),
(3, 8, 0.6667),
(3, 9, 0.5),
(3, 10, 1),
(4, 1, 0.5),
(4, 2, 1),
(4, 3, 0.25),
(4, 4, 1),
(4, 5, 1),
(4, 6, 0.6667),
(4, 7, 0.3333),
(4, 8, 1),
(4, 9, 0.5),
(4, 10, 1),
(5, 1, 0.25),
(5, 2, 0.6667),
(5, 3, 0.75),
(5, 4, 0.5),
(5, 5, 1),
(5, 6, 0.6667),
(5, 7, 1),
(5, 8, 1),
(5, 9, 1),
(5, 10, 0.6667),
(6, 1, 1),
(6, 2, 0.6667),
(6, 3, 0.75),
(6, 4, 0.5),
(6, 5, 1),
(6, 6, 1),
(6, 7, 0.3333),
(6, 8, 0.6667),
(6, 9, 0.25),
(6, 10, 0.6667),
(7, 1, 0.5),
(7, 2, 0.1),
(7, 3, 0.1),
(7, 4, 0.75),
(7, 5, 1),
(7, 6, 0.6667),
(7, 7, 0.3333),
(7, 8, 1),
(7, 9, 0.5),
(7, 10, 1),
(8, 1, 0.25),
(8, 2, 1),
(8, 3, 0.75),
(8, 4, 0.75),
(8, 5, 1),
(8, 6, 0.6667),
(8, 7, 0.3333),
(8, 8, 0.6667),
(8, 9, 1),
(8, 10, 1),
(9, 1, 0.75),
(9, 2, 1),
(9, 3, 0.75),
(9, 4, 1),
(9, 5, 1),
(9, 6, 0.6667),
(9, 7, 0.3333),
(9, 8, 0.6667),
(9, 9, 0.3333),
(9, 10, 1),
(10, 1, 0.5),
(10, 2, 1),
(10, 3, 0.75),
(10, 4, 0.5),
(10, 5, 1),
(10, 6, 1),
(10, 7, 0.3333),
(10, 8, 0.6667),
(10, 9, 0.5),
(10, 10, 1);

ALTER TABLE `nilai_evaluasi`
  ADD PRIMARY KEY (`id_alternatif`,`id_kriteria`);