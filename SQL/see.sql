-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2025 at 10:40 AM
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
-- Database: `se`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'ภาดาเดช ปนิสสวัสดิ์', 'pkadadetp65@nu.ac.th', '1020034'),
(2, 'เพชรลดา เชยเพชร', 'phetradach65@nu.ac.th', '2030405');

-- --------------------------------------------------------

--
-- Table structure for table `admin_action_log`
--

CREATE TABLE `admin_action_log` (
  `admin_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `admin_action_log_action` enum('เพิ่ม','ลบ','แก้ไข','') NOT NULL,
  `admin_action_log_action_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin_action_log`
--

INSERT INTO `admin_action_log` (`admin_id`, `document_id`, `admin_action_log_action`, `admin_action_log_action_date`) VALUES
(1, 1, 'เพิ่ม', '2024-05-25'),
(1, 2, 'เพิ่ม', '2024-05-25'),
(1, 3, 'เพิ่ม', '2024-05-26'),
(2, 4, 'เพิ่ม', '2024-05-26'),
(2, 5, 'เพิ่ม', '2024-05-26'),
(1, 6, 'เพิ่ม', '2024-05-27'),
(2, 7, 'เพิ่ม', '2024-05-27'),
(2, 8, 'เพิ่ม', '2024-05-27'),
(2, 9, 'เพิ่ม', '2024-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `advisor`
--

CREATE TABLE `advisor` (
  `advisor_id` int(11) NOT NULL,
  `advisor_name` varchar(100) NOT NULL,
  `advisor_email` varchar(50) NOT NULL,
  `advisor_tel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `advisor`
--

INSERT INTO `advisor` (`advisor_id`, `advisor_name`, `advisor_email`, `advisor_tel`) VALUES
(1, 'อ.วุฒิพงษ์ เรือนทอง', 'wutttipongr@nu.ac.th', 55963235),
(2, 'รศ.ดร.จักรกฤษณ์ เสน่ห์ นมะหุต', 'chakkrits@nu.ac.th', 55963223),
(3, 'ผศ.ดร.อนงค์พร ไศลวรากุล', 'anongporns@nu.ac.th', NULL),
(4, 'อ.ณัฐวดี หงส์บุญมี', 'nuttavadeeho@nu.ac.th', 55963221),
(5, 'ผศ.ดร.วินัย วงษ์ไทย', 'winaiw@nu.ac.th', 55963234),
(6, 'ดร.ณัฐพล คุ้มใหญ่โต', 'nattaponk@nu.ac.th', NULL),
(7, 'ดร.จรัสศรี รุ่งรัตนาอุบล', 'jaratsrir@nu.ac.th', 55963260),
(8, 'ดร.ธนะธร พ่อค้า', 'thanathornp@nu.ac.th', NULL),
(9, 'ดร.วันสุรีย์ มาศกรัม', 'wansureem@nu.ac.th', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'วิทยานิพนธ์'),
(2, 'สหกิจศึกษา'),
(3, 'ผลงาน');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `document_id` int(11) NOT NULL,
  `document_title` varchar(255) DEFAULT NULL,
  `document_title_english` varchar(255) DEFAULT NULL,
  `document_author` varchar(100) DEFAULT NULL,
  `document_author_english` varchar(100) DEFAULT NULL,
  `document_author_secon` varchar(100) DEFAULT NULL,
  `document_author_secon_english` varchar(100) DEFAULT NULL,
  `document_description` varchar(255) DEFAULT NULL,
  `document_keyword` varchar(255) DEFAULT NULL,
  `document_publisher` enum('วิทยาการคอมพิวเตอร์','เทคโนโลยีสารสนเทศ') NOT NULL,
  `document_language` enum('ไทย','English') NOT NULL,
  `document_upload_date` date NOT NULL DEFAULT current_timestamp(),
  `document_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`document_id`, `document_title`, `document_title_english`, `document_author`, `document_author_english`, `document_author_secon`, `document_author_secon_english`, `document_description`, `document_keyword`, `document_publisher`, `document_language`, `document_upload_date`, `document_file`) VALUES
(1, 'การปรับปรุงวิเคราะห์แบบระดับบนโดเมนความถี่ด้วยตัวกรองเกาส์เซียนหลายระดับแบบปรับเหมาะสำหรับการตรวจจับบริเวณที่น่าสนใจของภาพ', ' Modified Scale-Space Analysis in Frequency Domain Based on Adaptive Multiscale Gaussian Filter\r\nfor Saliency Detection', 'เจนจิรา แจ่มศิริ', 'JENJIRA JAEMSIRI', NULL, NULL, ' การตรวจจับบริเวณที่น่าสนใจเป็นกระบวนการที่สำคัญโดยเฉพาะในการค้นหาบริเวณที่สำคัญบนภาพ ซึ่งเป็นที่นิยม ในการประมวลผลภาพ การตรวจจับบริเวณที่น่าสนใจได้รับการปรับปรุงและประยุกต์ใช้งานในหลาย ๆ ด้านของระบบคอมพิวเตอร์ วิทัศน์โดยคอมพิวเตอร์พยายามที่จะทำงาน เข้าใจ', 'ขนาดและพื้นที่ของตัวกรองเกาส์เซียน, ค่าเอนโทรปีแบบท้องถิ่น, การวิเคราะห์แบบระดับ, การตรวจจับบริเวณที่ น่าสนใจ, Scale-and-space Gaussian filter, local entropy, scale- space analysis, saliency detection', 'เทคโนโลยีสารสนเทศ', 'ไทย', '2019-05-16', 'Files/61060706.pdf'),
(2, 'การปรับปรุงเทคนิคการวิเคราะห์องค์ประกอบหลักสำหรับการรู้จำใบหน้า', 'Modified Principal Component Analysis for Face Recognition', 'กังสดาล หาญเชิงชัย', 'KANGSADAN HANCHERNGCHAI', NULL, NULL, 'การวิเคราะห์องค์ประกอบหลักแบบสองมิติ (2DPCA) ถูกใช้อย่างแพร่หลายในหลาย ๆ แอปพลิเคชันโดยเฉพาะการ จดจำใบหน้า ปัจจัยสำคัญในการปรับปรุงประสิทธิภาพของวิธี 2DPCA นั้นมาจากประสิทธิภาพของเมทริกซ์ความแปรปรวนร่วม ใน วิทยานิพนธ์นี้เชื่อว่า ไอเกนเวกเตอร์ (eigenvector', 'เมทริกซ์ระดับภูมิภาค, เทคนิค ELSSP, การวิเคราะห์องค์ประกอบหลัก, การวิเคราะห์องค์ประกอบหลักแบบสองมิติ, (2DPCA), การรู้จำใบหน้า, Regional Matrix, ELSSP Conversion, Principal Component Analysis, Two-dimensional, PCA (2DPCA), Face Recognition', 'วิทยาการคอมพิวเตอร์', 'ไทย', '2021-01-02', 'Files/61060355.pdf'),
(3, 'ระบบถ่ายโอนข้อมูลแบบกึ่งปิด', 'Semi-closed Data Transfer System', 'อนุรักษ์ นันตา', 'Anuruk Nunta', NULL, NULL, 'งานวิจัยนี้ได้พัฒนาระบบถ่ายโอนข้อมูลแบบกึ่งปิดใช้ในการถ่ายโอนข้อมูลจากเครื่องคอมพิวเตอร์ที่ไม่มีการเชื่อมต่อ กับเครื่องอื่นๆ ภายในองค์กร เป็นการลดความเสี่ยงจากการนำสื่อจัดเก็บข้อมูลจากภายนอกเข้ามาเชื่อมต่อ และลดปริมาณการใช้ สื่อจัดเก็บข้อมูลที่เป็นวัสดุสิ', 'ไวรัสคอมพิวเตอร์, ระบบไซเบอร์-กายภาพ, การเข้ารหัส AES, ไฟร์วอลล์, มัลแวร์, Virus computer, CyberPhysical Systems, Advanced Encryption Standard, Firewall, Malware', 'วิทยาการคอมพิวเตอร์', 'ไทย', '2023-10-28', 'Files/AnurukNunta.pdf'),
(4, NULL, 'Comparison of Three Learning Approaches for Plant Disease Classification', NULL, 'Mr. Phanthawat Phiphatkamtorn', NULL, NULL, 'Plant disease classification is a critical task in agricultural technology, helping to prevent crop losses and improve overall productivity. Deep learning has become a widely used approach due to its high accuracy in image classification. However, alterna', 'Plant Disease, Machine Learning, Deep Learning, Hybrid Learning, Transfer Learning', 'เทคโนโลยีสารสนเทศ', 'English', '2024-06-18', ''),
(5, NULL, 'Adaptive Threshold for Tuberculosis Bacilli Detection Using Sputum Smear\r\nImages\r\n', NULL, 'Supakorn Nakvijitpaitoon', NULL, ' Nungruthai Nilsri', 'Tuberculosis (TB) remains a major global health concern, particularly in high-prevalence countries like Thailand. The standard method for TB diagnosis is Acid-Fast Bacilli (AFB) smear microscopy, which involves staining and examining sputum samples under ', 'Tuberculosis Detection, Acid-Fast Bacilli, Adaptive Thresholding, Image Processing, Medical Imaging', 'เทคโนโลยีสารสนเทศ', 'English', '2024-06-23', ''),
(6, NULL, 'BUILDING SEGMENTATION IN DRONE PHOTOS ACROSS VARIED FLIGHT\r\nALTITUDES USING MASK R-CNN', NULL, ' Kanokwan Khiewwan', NULL, NULL, 'This research proposed a precise altitude-adaptive building segmentation method which employs Mask R-CNN to accurately partition buildings in drone photos taken at various altitudes. We used transfer learning to train our model, starting with a pre-traine', 'Deep learning, Instance segmentation, ResNet, Unmanned aerial vehicle (UAV)', 'เทคโนโลยีสารสนเทศ', 'English', '2024-06-23', ''),
(7, 'การส่งเสริมการท่องเที่ยวด้วยเทคโนโลยีบล็อกเชน ผ่านวิธีการเพิ่มมูลค่าของสินทรัพย์ดิจิทัลประเภทที่ไม่ สามารถทดแทนกันได้', NULL, 'นางสาวพัทธนันท์ จันทะวงษ์', NULL, 'นางสาววิภาดา วิชระโภชน์ ', NULL, NULL, NULL, 'เทคโนโลยีสารสนเทศ', 'ไทย', '2023-03-23', ''),
(8, 'ระบบแบบคำขอรับความช่วยเหลือผู้ประสบปัญหาทางสังคม', NULL, 'นาย พันธวัช พิพัฒน์กำธร', NULL, NULL, NULL, NULL, NULL, 'เทคโนโลยีสารสนเทศ', 'ไทย', '2023-03-23', ''),
(9, 'สติกเกอร์ไลน์ลุงโจนส์เคลื่อนไหว', NULL, 'นาย ภาณุวัฒน์ ศรีสมร', NULL, NULL, NULL, NULL, NULL, 'เทคโนโลยีสารสนเทศ', 'ไทย', '2023-03-23', ''),
(10, 'การวัดและการปรับปรุงประสิทธิภาพของระบบบันทึกเหตุการณ์บนการประมวลผลแบบกลุ่มเมฆ', 'MEASUREMENT AND IMPROVEMENT OF CLOUD LOGGING  SYSTEMS', 'ไกรยวิชช์ ศุภโสภาพงศ์', 'KRAIYAWICH SUPPASOPAPONG', NULL, NULL, 'งานวิจัยนี้มีวัตถุประสงค์เพื่อที่จะทดสอบประสิทธิภาพของระบบบันทึกเหตุการณ์บนการประมวลผลแบบกลุ่มเมฆหรือคลาวด์และทำการปรับปรุงประสิทธิภาพของระบบบันทึกเหตุการณ์เพื่อให้มีประสิทธิภาพที่ดียิ่งขึ้น โดยระบบบันทึกเหตุการณ์เป็นหนึ่งในวิธีที่สามารถช่วยบรรเทาปัจจัย', 'ระบบรักษาความปลอดภัย, การประมวลผลแบบกลุ่มเมฆ, ระบบบันทึกเหตุการณ์,  การทดสอบประสิทธิภาพ', 'วิทยาการคอมพิวเตอร์', 'ไทย', '2025-03-25', 'Files/58060600.pdf'),
(11, 'การตรวจจับและรู้จําข้อความเพื่อการทํางานแบบอัตโนมัติในภาคอุตสาหกรรม', 'TEXT DETECTION AND RECOGNITION FOR INDUSTRIAL  AUTOMATION', 'สรวีย์ โพธิ์พยอม', 'SORAWEE POPAYORM', '', '', 'การตรวจจับตัวเลขที่แสดงผลในรูปแบบเจ็ดส่วนบนจอภาพแอลอีดีนั้นมีความท้าทาย\nโดยเฉพาะอย่างยิ่งในการค้นหาตัวเลขท่ามกลางวัตถุที่หลากหลายบนภาพซึ่งอาจมีส่วนประกอบหรือ\nรูปทรงที่คล้ายคลึงกัน ดังนั้น ในงานวิจัยนี้จะนําเสนอวิธีการนําตัวเลขที่แสดงผลในรูปแบบเจ็ดส่วน\n', 'การแปลงเรดอนหลายขนาด, การตรวจจับจอภาพที่แสดงผลใน\nรูปแบบเจ็ดส่วน, การรู้จําตัวเลขที่แสดงผลในรูปแบบเจ็ดส่วน, การ\nเพิ่มข้อมูล, การตัดแบบกําหนดช่วงบนแบบจําลองสีHSV', 'วิทยาการคอมพิวเตอร์', 'ไทย', '2025-03-28', 'Files/61062373.pdf'),
(12, 'การปรับปรุงวิศวกรรมคุณลักษณะสําหรับตัวจําแนกประเภทแบบต้นไม้สําหรับการตรวจจับการบุกรุกทางเครือข่าย', 'THE MODIFIED FEATURE ENGINEERING APPROACH FOR TREE-BASED CLASSIFIERS OF NETWORK INTRUSION DETECTION', 'กิตติภพ มหาวัน', 'Kittiphop Mahawan', '', '', 'วิทยานิพนธ์ที่นําเสนอเสนอวิธีการปรับปรุงระบบตรวจจับการบุกรุก (IDS) โดยใช้การ\r\nเลือกคุณลักษณะ การสร้างคุณลักษณะพหุนาม และอัลกอริธึมเชิงพันธุกรรม วัตถุประสงค์หลักคือเพื่อ\r\nปรับปรุงความแม่นยําของ IDS ในการตรวจจับและบรรเทาภัยคุกคามทางไซเบอร์วิธีการวิจัย\r\nเกี่', 'ระบบตรวจจับการบุกรุกเครือข่าย, ลักษณนามแบบต้นไม้, วิศวกรรม\r\nคุณลักษณะ, อัลกอริทึมทางพันธุกรรม, การเลือกคุณสมบัติการสร้าง\r\nคุณสมบัติพหุนาม', 'วิทยาการคอมพิวเตอร์', 'ไทย', '2025-03-28', 'Files/KittiphopMahawan.pdf'),
(13, 'การรู้จำอาหารและการประเมินปริมาณอาหารเหลือด้วยเทคนิคการเรียนรู้เชิงลึก', 'FOOD RECOGNITION AND LEFTOVERS FOOD ESTIMATION  USING DEEP LEARNING TECHNIQUES', 'พลเทพ มีไผ่ขอ', 'Phonthep Meephaikhor', '', '', 'การวิจัยครั้งนี้มีวัตถุประสงค์เพื่อพัฒนาการประเมินปริมาณอาหารเหลือหลังจากการ\r\nรับประทานด้วยเทคนิคการเรียนรู้เชิงลึก ซึ่งผู้วิจัยสร้างแบบจ าลองด้วยเทคนิค Mask R-CNN ที่ได้\r\nพัฒนาเพิ่มเติมวิธีการค านวณพื้นที่ภายในภาพ เพื่อให้สามารถประเมินปริมาณอาหารเหลือได้', 'การเรียนรู้เชิงลึก, การรู้จำอาหาร, อาหารเหลือ, การวิเคราะห์ข้อมูล', 'วิทยาการคอมพิวเตอร์', 'ไทย', '2025-03-28', 'Files/PhonthepMeephaikhor.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `document_advisor`
--

CREATE TABLE `document_advisor` (
  `advisor_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `document_advisor`
--

INSERT INTO `document_advisor` (`advisor_id`, `document_id`) VALUES
(7, 1),
(7, 2),
(8, 3),
(2, 4),
(3, 5),
(4, 6),
(4, 7),
(5, 8),
(6, 9),
(5, 10),
(9, 11),
(9, 12),
(9, 13),
(9, 14),
(9, 15),
(9, 16),
(9, 17),
(9, 18),
(9, 19),
(9, 20),
(9, 21),
(9, 11),
(5, 12),
(2, 13);

-- --------------------------------------------------------

--
-- Table structure for table `document_category`
--

CREATE TABLE `document_category` (
  `category_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `document_category`
--

INSERT INTO `document_category` (`category_id`, `document_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(3, 4),
(3, 5),
(3, 6),
(2, 7),
(2, 8),
(2, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `dowload_log`
--

CREATE TABLE `dowload_log` (
  `user_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `download_log_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_role` enum('นิสิต','อาจารย์','','') NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_role`, `user_email`, `user_password`) VALUES
(1, 'ณัชชารย์ พิพิธเดชะพงศ์', 'นิสิต', 'nutchareep65@nu.ac.th', 123456789),
(2, 'ชลธิชา บุญมา', 'นิสิต', 'chontichab65@nu.ac.th', 987654321),
(3, 'อ.วุฒิพงษ์ เรือนทอง', 'อาจารย์', 'wutttipongr@nu.ac.th', 1234),
(4, 'ดร.จรัสศรี รุ่งรัตนาอุบล', 'อาจารย์', 'jaratsrir@nu.ac.th', 4321);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `advisor`
--
ALTER TABLE `advisor`
  ADD PRIMARY KEY (`advisor_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `advisor`
--
ALTER TABLE `advisor`
  MODIFY `advisor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
