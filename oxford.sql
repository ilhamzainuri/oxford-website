-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2025 at 03:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oxford`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` int(11) NOT NULL,
  `nama_fakultas` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`) VALUES
(1, 'Humanities Division'),
(2, 'Mathematical, Physical and Life Sciences (MPLS) Division'),
(3, 'Medical Sciences Division'),
(4, 'Social Sciences Division');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `field` varchar(100) DEFAULT NULL,
  `file_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `title`, `author`, `year`, `field`, `file_url`) VALUES
(7, 'Implementation of the Regional Spatial Plan in the Development Process of North Minahasa Regency', 'Michael C. Nelwan , Evi Elvira Masengi , Steven Vleike Tarore', '2025', 'Education', 'uploads/jurnal/A1.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(150) NOT NULL,
  `id_fakultas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `id_fakultas`) VALUES
(1, 'Faculty of Classics', 1),
(2, 'Faculty of English Language and Literature', 1),
(3, 'Faculty of History', 1),
(4, 'Faculty of Linguistics, Philology and Phonetics', 1),
(5, 'Faculty of Medieval and Modern Languages', 1),
(6, 'Faculty of Music', 1),
(7, 'Faculty of Oriental Studies', 1),
(8, 'Faculty of Philosophy', 1),
(9, 'Ruskin School of Art', 1),
(10, 'Theology and Religion Faculty', 1),
(11, 'Department of Computer Science', 2),
(12, 'Department of Chemistry', 2),
(13, 'Department of Earth Sciences', 2),
(14, 'Department of Engineering Science', 2),
(15, 'Department of Materials', 2),
(16, 'Department of Mathematics', 2),
(17, 'Department of Physics', 2),
(18, 'Department of Statistics', 2),
(19, 'Department of Plant Sciences', 2),
(20, 'Department of Zoology', 2),
(21, 'Department of Biochemistry', 3),
(22, 'Department of Experimental Psychology', 3),
(23, 'Department of Oncology', 3),
(24, 'Department of Paediatrics', 3),
(25, 'Department of Pharmacology', 3),
(26, 'Department of Physiology, Anatomy and Genetics', 3),
(27, 'Department of Psychiatry', 3),
(28, 'Nuffield Department of Clinical Medicine', 3),
(29, 'Nuffield Department of Orthopaedics, Rheumatology and Musculoskeletal Sciences', 3),
(30, 'Nuffield Department of Population Health', 3),
(31, 'Sir William Dunn School of Pathology', 3),
(32, 'Wellcome Centre for Human Genetics', 3),
(33, 'School of Anthropology and Museum Ethnography', 4),
(34, 'School of Archaeology', 4),
(35, 'Department of Economics', 4),
(36, 'Department of Education', 4),
(37, 'Oxford School of Global and Area Studies', 4),
(38, 'Blavatnik School of Government', 4),
(39, 'Law Faculty', 4),
(40, 'Department of International Development', 4),
(41, 'Oxford Internet Institute', 4),
(42, 'Department of Politics and International Relations', 4),
(43, 'Saïd Business School', 4),
(44, 'Centre for Socio-Legal Studies', 4);

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_mapel` int(11) NOT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `nama_mapel` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_mapel`, `id_jurusan`, `nama_mapel`, `deskripsi`) VALUES
(1, 1, 'Ancient Greek', NULL),
(2, 1, 'Latin Literature', NULL),
(3, 1, 'Classical Mythology', NULL),
(4, 2, 'British Literature', NULL),
(5, 2, 'Shakespeare Studies', NULL),
(6, 2, 'Creative Writing', NULL),
(7, 3, 'World History', NULL),
(8, 3, 'European History', NULL),
(9, 3, 'History of Art', NULL),
(10, 4, 'Phonology', NULL),
(11, 4, 'Syntax', NULL),
(12, 4, 'Historical Linguistics', NULL),
(13, 5, 'French Literature', NULL),
(14, 5, 'German Studies', NULL),
(15, 5, 'Spanish Language & Culture', NULL),
(16, 6, 'Music Theory', NULL),
(17, 6, 'Music History', NULL),
(18, 6, 'Composition', NULL),
(19, 7, 'Arabic Studies', NULL),
(20, 7, 'Chinese Literature', NULL),
(21, 7, 'Japanese Culture', NULL),
(22, 8, 'Ethics', NULL),
(23, 8, 'Logic', NULL),
(24, 8, 'Metaphysics', NULL),
(25, 9, 'Drawing & Painting', NULL),
(26, 9, 'Art History', NULL),
(27, 9, 'Contemporary Art', NULL),
(28, 10, 'Biblical Studies', NULL),
(29, 10, 'World Religions', NULL),
(30, 10, 'Ethics in Religion', NULL),
(31, 11, 'Algorithms', NULL),
(32, 11, 'Operating Systems', NULL),
(33, 11, 'Web Programming', NULL),
(34, 12, 'Organic Chemistry', NULL),
(35, 12, 'Inorganic Chemistry', NULL),
(36, 12, 'Physical Chemistry', NULL),
(37, 13, 'Geology', NULL),
(38, 13, 'Geophysics', NULL),
(39, 13, 'Volcanology', NULL),
(40, 14, 'Thermodynamics', NULL),
(41, 14, 'Fluid Mechanics', NULL),
(42, 14, 'Control Systems', NULL),
(43, 15, 'Materials Science', NULL),
(44, 15, 'Nano Materials', NULL),
(45, 15, 'Polymer Engineering', NULL),
(46, 16, 'Linear Algebra', NULL),
(47, 16, 'Calculus', NULL),
(48, 16, 'Number Theory', NULL),
(49, 17, 'Classical Mechanics', NULL),
(50, 17, 'Quantum Physics', NULL),
(51, 17, 'Electromagnetism', NULL),
(52, 18, 'Probability Theory', NULL),
(53, 18, 'Regression Analysis', NULL),
(54, 18, 'Bayesian Statistics', NULL),
(55, 19, 'Botany', NULL),
(56, 19, 'Plant Physiology', NULL),
(57, 19, 'Plant Genetics', NULL),
(58, 20, 'Animal Biology', NULL),
(59, 20, 'Animal Physiology', NULL),
(60, 20, 'Ecology and Evolution', NULL),
(61, 21, 'Enzymology', NULL),
(62, 21, 'Metabolism', NULL),
(63, 22, 'Cognitive Psychology', NULL),
(64, 22, 'Behavioral Neuroscience', NULL),
(65, 23, 'Cancer Biology', NULL),
(66, 23, 'Radiation Therapy', NULL),
(67, 24, 'Child Development', NULL),
(68, 24, 'Neonatology', NULL),
(69, 25, 'Drug Mechanisms', NULL),
(70, 25, 'Clinical Pharmacokinetics', NULL),
(71, 26, 'Human Anatomy', NULL),
(72, 26, 'Physiology of Organ Systems', NULL),
(73, 27, 'Psychiatric Disorders', NULL),
(74, 27, 'Clinical Psychiatry', NULL),
(75, 28, 'Internal Medicine', NULL),
(76, 28, 'Infectious Diseases', NULL),
(77, 29, 'Orthopaedic Surgery', NULL),
(78, 29, 'Musculoskeletal Pathology', NULL),
(79, 30, 'Epidemiology', NULL),
(80, 30, 'Public Health Ethics', NULL),
(81, 31, 'Cellular Pathology', NULL),
(82, 31, 'Immunopathology', NULL),
(83, 32, 'Human Genomics', NULL),
(84, 32, 'Genetic Epidemiology', NULL),
(85, 33, 'Cultural Anthropology', NULL),
(86, 33, 'Museum Studies', NULL),
(87, 34, 'Field Archaeology', NULL),
(88, 34, 'Ancient Civilizations', NULL),
(89, 35, 'Microeconomics', NULL),
(90, 35, 'Macroeconomics', NULL),
(91, 36, 'Curriculum Theory', NULL),
(92, 36, 'Educational Psychology', NULL),
(93, 37, 'Global Governance', NULL),
(94, 37, 'Regional Studies', NULL),
(95, 38, 'Public Policy Analysis', NULL),
(96, 38, 'Governance and Leadership', NULL),
(97, 39, 'Criminal Law', NULL),
(98, 39, 'International Law', NULL),
(99, 40, 'Development Studies', NULL),
(100, 40, 'Global Poverty & Inequality', NULL),
(101, 41, 'Digital Sociology', NULL),
(102, 41, 'Cyber Policy', NULL),
(103, 42, 'Comparative Politics', NULL),
(104, 42, 'International Relations Theory', NULL),
(105, 43, 'Strategic Management', NULL),
(106, 43, 'Corporate Finance', NULL),
(107, 44, 'Law and Society', NULL),
(108, 44, 'Socio-Legal Research Methods', NULL),
(109, 11, 'Cyber Security', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `minat_mahasiswa`
--

CREATE TABLE `minat_mahasiswa` (
  `id` int(11) NOT NULL,
  `id_student` int(11) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `minat_mahasiswa`
--

INSERT INTO `minat_mahasiswa` (`id`, `id_student`, `id_mapel`) VALUES
(1, 1, 46),
(2, 2, 109);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `domicile` varchar(100) DEFAULT NULL,
  `previous_school` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `major_id` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status_penerimaan` enum('Belum Diterima','Lolos Seleksi','Ditolak') DEFAULT 'Belum Diterima'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `full_name`, `domicile`, `previous_school`, `phone_number`, `email`, `faculty_id`, `major_id`, `username`, `password`, `foto`, `status_penerimaan`) VALUES
(1, 'Ilham Zainuri', 'Indonesia', 'King Highschool', '08316631231', 'artar010404@gmail.com', 2, 16, 'ilham', 'ilham', '1751540789_DSCF2331.JPG', 'Lolos Seleksi'),
(2, 'Daniell', 'Australia', 'King Highschool', '0851523124', 'queen@gmail.com', 2, 11, 'daniel', 'daniel', '1751545724_IMG_1102.HEIC', 'Lolos Seleksi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`),
  ADD KEY `id_fakultas` (`id_fakultas`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id_mapel`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `minat_mahasiswa`
--
ALTER TABLE `minat_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `id_mapel` (`id_mapel`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `major_id` (`major_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `minat_mahasiswa`
--
ALTER TABLE `minat_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `jurusan_ibfk_1` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`);

--
-- Constraints for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD CONSTRAINT `mata_pelajaran_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`);

--
-- Constraints for table `minat_mahasiswa`
--
ALTER TABLE `minat_mahasiswa`
  ADD CONSTRAINT `minat_mahasiswa_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `minat_mahasiswa_ibfk_2` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`id_mapel`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `fakultas` (`id_fakultas`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`major_id`) REFERENCES `jurusan` (`id_jurusan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
