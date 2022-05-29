/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.24-MariaDB : Database - db_aitixixi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


/*Table structure for table `admin_notifications` */

DROP TABLE IF EXISTS `admin_notifications`;

CREATE TABLE `admin_notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admin_notifications` */

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_address` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admins` */

insert  into `admins`(`id`,`admin_name`,`username`,`password`,`admin_address`,`phone`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Krisna Mahadiputra','admin_krisna','$2y$10$PGW.tnfWpNE47vhfvirAhuFl20Ou9RGPSy4/6tre8d2kUFDRURYQG','Jl. Raya Padang Luwih','089681437135',NULL,'2022-05-26 23:10:28','2022-05-26 23:10:28');

/*Table structure for table `carts` */

DROP TABLE IF EXISTS `carts`;

CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `carts` */

/*Table structure for table `couriers` */

DROP TABLE IF EXISTS `couriers`;

CREATE TABLE `couriers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `courier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `couriers` */

insert  into `couriers`(`id`,`courier`,`created_at`,`updated_at`) values 
(1,'jne',NULL,NULL),
(2,'pos',NULL,NULL),
(3,'tiki',NULL,NULL);

/*Table structure for table `discounts` */

DROP TABLE IF EXISTS `discounts`;

CREATE TABLE `discounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `percentage` int(11) NOT NULL,
  `start` timestamp NULL DEFAULT NULL,
  `end` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `discounts` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2022_03_02_144714_create_admins_table',1),
(6,'2022_03_10_001731_create_products_table',1),
(7,'2022_03_13_032753_create_product_categories_table',1),
(8,'2022_03_13_032827_create_product_categories_details_table',1),
(9,'2022_03_15_101625_create_product_images_table',1),
(10,'2022_03_21_152804_create_carts_table',1),
(11,'2022_03_26_030737_create_couriers_table',1),
(12,'2022_03_27_030533_create_ro_province_table',1),
(13,'2022_03_27_031716_create_ro_city_table',1),
(14,'2022_03_27_031753_create_transactions_table',1),
(15,'2022_03_28_063752_create_transaction_details_table',1),
(16,'2022_04_01_145300_create_product_reviews_table',1),
(17,'2022_04_01_205909_create_response_table',1),
(18,'2022_04_20_151006_create_discounts_table',1),
(19,'2022_05_23_132251_create_user_notifications_table',1),
(20,'2022_05_23_132405_create_admin_notifications_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `product_categories` */

DROP TABLE IF EXISTS `product_categories`;

CREATE TABLE `product_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_categories` */

insert  into `product_categories`(`id`,`category_name`,`created_at`,`updated_at`) values 
(1,'Audio','2022-05-26 23:10:29','2022-05-26 23:14:22'),
(2,'Electronik Rumah Tangga','2022-05-26 23:10:29','2022-05-26 23:14:57'),
(3,'Lampu','2022-05-26 23:10:29','2022-05-26 23:14:48'),
(4,'Aksesoris','2022-05-26 23:10:29','2022-05-26 23:15:22'),
(5,'TV','2022-05-26 23:10:29','2022-05-26 23:15:30'),
(6,'Telepon','2022-05-26 23:10:29','2022-05-26 23:15:44');

/*Table structure for table `product_categories_details` */

DROP TABLE IF EXISTS `product_categories_details`;

CREATE TABLE `product_categories_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_categories_details` */

insert  into `product_categories_details`(`id`,`product_id`,`category_id`,`created_at`,`updated_at`) values 
(1,1,2,'2022-05-26 23:17:31','2022-05-26 23:17:31'),
(2,1,5,'2022-05-26 23:17:31','2022-05-26 23:17:31'),
(3,2,4,'2022-05-26 23:20:09','2022-05-26 23:20:09'),
(4,3,2,'2022-05-26 23:21:21','2022-05-26 23:21:21'),
(5,3,4,'2022-05-26 23:21:21','2022-05-26 23:21:21');

/*Table structure for table `product_images` */

DROP TABLE IF EXISTS `product_images`;

CREATE TABLE `product_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_images` */

insert  into `product_images`(`id`,`product_id`,`image_name`,`created_at`,`updated_at`) values 
(3,1,'post-image/goFAADb0qk0YNbC8r71uaI2etwvT5rtdB74oCEM5.jpg','2022-05-26 23:18:16','2022-05-26 23:18:16'),
(4,1,'post-image/TPwsPrwXUzwqxJ9hiuQ41Z0VFdfBxKtihdEqnYSj.jpg','2022-05-26 23:18:22','2022-05-26 23:18:22'),
(5,1,'post-image/OG0aKHMmLZL4kxv5xtdiNegH9okTSlPABMIuUehC.jpg','2022-05-26 23:18:32','2022-05-26 23:18:32'),
(6,2,'post-image/FkVVL8MbttpjrkratzHZ4ERwiLU1IbA0soWfBUJ8.jpg','2022-05-26 23:20:16','2022-05-26 23:20:16'),
(7,2,'post-image/bVKy9XTHjGekAr47D8iWNew2va2sHCIuD7rcGwGp.jpg','2022-05-26 23:20:23','2022-05-26 23:20:23'),
(8,3,'post-image/ZpcH7uQyLp5ujtyhJcXCZ5IbGIcI82RVR9fAOBM8.jpg','2022-05-26 23:21:43','2022-05-26 23:21:43'),
(9,3,'post-image/8fE1hMfLhCLj58CzxBcv3HJvY1Oj150R07VOmZsb.jpg','2022-05-26 23:21:52','2022-05-26 23:21:52');

/*Table structure for table `product_reviews` */

DROP TABLE IF EXISTS `product_reviews`;

CREATE TABLE `product_reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `transaction_id` bigint(20) unsigned NOT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `product_reviews` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_rate` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`product_name`,`price`,`description`,`product_rate`,`stock`,`weight`,`created_at`,`updated_at`) values 
(1,'Toshiba LED TV - FHD Smart Android 43\" - 43V35KP',4799000,'<ul><li>Kondisi: Baru</li><li>Berat: 27.120 Gram</li><li>Kategori: <a href=\"https://www.tokopedia.com/p/elektronik/tv-aksesoris/televisi\"><strong>Televisi</strong></a></li><li>Etalase: <a href=\"https://www.tokopedia.com/toshiba-store/etalase/television\"><strong>Television</strong></a></li></ul><div><br>Tukarkan TV Lama anda, dengan TV terbaru!<br><br>1. Salin Kode Promo dibawah ini sesuai ukuran TV Lama mu<br>TUKARTVA 19-22 = 350,000<br>TUKARTVB 23-31 = 500,000<br>TUKARTVC 32-38 = 850,000<br>TUKARTVD 39-40 = 1,050,000<br>TUKARTVE 42-48 = 1,300,000<br>TUKARTVF 49-50 = 1,750,000<br>TUKARTVG &gt;50 = 2,400,000<br>2. Pilih TV baru ini dan lanjut bayar<br>3. Pilih pengiriman Kurir Toko &amp; masukkan kode promo<br>4. Pihak Toko akan melakukan pengecekan via chat<br>5. Pastikan TV Lama sudah kondisi siap untuk dijemput kurir<br><br>Pastikan TV Lama Anda sesuai dengan syarat dan ketentuan Tukar<br>Tambah TV:<br><br>1. Jenis TV lama yang dapat ditukar adalah Smart TV/LED TV/LCD<br>TV/Plasma TV, bukan TV tabung<br>2. Kondisi fisik dan fungsi TV lama sesuai dengan kondisi dibawah ini :<br>● TV dapat menyala dan berfungsi dengan baik<br>● Tidak terdapat kerusakan pada bagian fisik TV seperti retak,<br>pecah, patah, penyok, terbakar, dan renggang<br>● Tidak terdapat kerusakan pada bagian layar TV seperti bercak,<br>bergaris, berbayang, redup, dot pixel/defective pixel/bintik kecil<br>● Seluruh username/password/PIN dan akun pribadi lainnya telah<br>di log-out<br>● Terdapat kelengkapan kabel power + remote tv<br><br>Chat langsung Store kami untuk memastikan TV lama kamu bisa untuk dilakukan Tukar Tambah TV.<br><br>Mohon agar TV yang ingin ditukar tambah dimasukkan ke dalam kardus. Jika tidak memiliki kardus, harap menghubungi CS toko kami<br><br>Kunjungi Link dibawah ini, untuk mengetahui informasi lebih lanjut<br><a href=\"https://www.tokopedia.com/discovery/tukar-tambah-tv\">https://www.tokopedia.com/discovery/tukar-tambah-tv</a><br><br>YUK, CHECK OUT SEKARANG JUGA. FREE BERLANGGANAN VIDEO SELAMA SEBULAN! PEMBELIAN TERBATAS!<br><br>Spesifikasi 43V35KP:<br>AndroidTV 9 (RAM 1gb + ROM 5gb)<br><br>WiFi<br>Bluetooth<br>HDMI (ARC) x 2<br>USB x 2<br>LAN (RJ45)<br>CVBS (RCA)<br>Audio Digital (Toslink)<br>Headphone 3.5mm<br>Penerima Sinyal: Analog dan Digital (DVB-T/T2/C)<br>Resolusi Gambar: FHD 1.920 x 1.080px (2K)<br>Speaker: 10watt x 2<br>Konsumsi Daya: 75watt (standby &lt;0.5watt)<br>Dimensi (tanpa penyangga): 95.5 x 55.8x87cm<br><br>Garansi Resmi Toshiba 1 Tahun</div><div><br></div>',NULL,20,2,'2022-05-26 23:17:31','2022-05-26 23:17:31'),
(2,'Acome Wired Earphone Headset AluminumAlloy Garansi Resmi 1 thn AW08',100000,'<ul><li>Kondisi: Baru</li><li>Berat: 200 Gram</li><li>Kategori: <a href=\"https://www.tokopedia.com/p/elektronik/audio/earphone\"><strong>Earphone</strong></a></li><li>Etalase: <a href=\"https://www.tokopedia.com/acomeindone/etalase/new-product\"><strong>New product</strong></a></li></ul><div><br>?Acome Wired Earphone Headset AluminumAlloy Garansi Resmi 1 thn AW08?<br><br>✅ Aluminum Alloy Sound Chamber<br><br>· Mencegah Kebocoran Suara, Mempertahankan Detail Musik, &amp; Memberikan Efek Bass yang Lebih Berasa<br><br>✅ 14.2mm Diameter Speakers<br><br>· Diameter Lebih Besar, Suara Lebih Stereo, Hasil Lebih Natural<br><br>✅ One-button Control<br><br>· Play Music, Stop Music, Angkat Telepon, Tutup Telepon, Semua Dalam 1 Tombol<br><br>✅ Plug &amp; Play<br><br>· Kompatibel dengan Semua Device 3.5mm Audio Jack<br><br>? Ketentuan Garansi ⏰<br><br>1. Garansi 1 Tahun Tukar Baru Untuk Produk Tidak Berlaku Jika:<br><br>A. Tidak Ditemukan Adanya Kerusakan<br><br>B. Kerusakan Disebabkan Oleh Faktor Luar/Di Luar Kuasa<br><br>C. Kerusakan Akibat Dari Kesalahan Pemakaian (Terjatuh, Tergores, Ternoda, Pecah, Terkena Air, Dll.)<br><br>2. Syarat Klaim:<br><br>A. Unit Masih Dalam Masa Garansi Dan Sesuai Dengan Kebijakan Garansi Yang Telah Ditetapkan<br><br>B. Kelengkapan Dari Unit Harus Disertai Secara Lengkap (Dus, Kabel Charger, Buku Manual, Kartu Garansi, Dll)<br><br>C. Dilengkapi Dengan Nota Pembelian (Print Out History Pembelian) Dan Informasi Kerusakan Unit<br><br>⭐ Note: Hubungi Customer Service</div><div><br></div>',NULL,20,2,'2022-05-26 23:20:09','2022-05-26 23:20:09'),
(3,'Monitor LED Philips 241V8 24\" IPS 1080p VGA HDMI Vesa 100x100',1769900,'<ul><li>Kondisi: Baru</li><li>Berat: 7.000 Gram</li><li>Kategori: <a href=\"https://www.tokopedia.com/p/komputer-laptop/monitor/monitor-led\"><strong>Monitor LED</strong></a></li><li>Etalase: <a href=\"https://www.tokopedia.com/ptagi/etalase/philips-led-monitor\"><strong>Philips LED Monitor</strong></a></li><li>Katalog: <a href=\"https://www.tokopedia.com/catalog/philips-75601/philips-241v8\"><strong>Philips 241V8</strong></a></li></ul><div><br><strong>1. Pembelian di kami dapat dilengkapi dengan Faktur Pajak.<br>2. Hari, jam operasional, detail pengiriman &amp; input resi.</strong><br>Dapat dilihat di <strong>Catatan Toko.</strong><br><br>Brand Type : <strong>241V8</strong><br>Panel Size(Inch) : 24”<br>Panel Type : IPS<br>Panel Resolution : 1920x1080<br>Aspect Ratio : 16 : 9<br><br>Brightness (cd/㎡) : 250<br>Refresh Rate(hz) : 75<br>Response Time (ms) : 4<br>Sync : Adaptive Sync Technology<br>Connectivity : D-Sub + HDMI<br><br>Audio port : 1 x 3.5 mm Audio Out<br>Build in Speaker : No<br>VESA mounting (mm) : 100x100<br>Ergonomic Stand :<br>USB Ports : -<br><br>Panel bit : -<br>HDR :<br>NTSC (%) :<br>SRGB (%) : Yes<br>Adobe RGB :<br>DCI-P3 (%) :<br><br>Power Cons (watt) : 19.9 (ON MODE)<br>Product Weight (nw/kg) : 2.66<br>Box Dimension (cm) : 13x43x61<br>Volume Weight (kg) : 7<br><br><strong>Include :</strong><br>HDMI Cable<br>Power Cable<br><br><strong>Garansi &amp; Service Centre</strong> dapat dilihat di <strong>Catatan Toko.</strong></div><div><br></div>',NULL,20,2,'2022-05-26 23:21:21','2022-05-26 23:21:21');

/*Table structure for table `responses` */

DROP TABLE IF EXISTS `responses`;

CREATE TABLE `responses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `review_id` bigint(20) unsigned NOT NULL,
  `admin_id` bigint(20) unsigned NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `responses` */

/*Table structure for table `ro_city` */

DROP TABLE IF EXISTS `ro_city`;

CREATE TABLE `ro_city` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` bigint(20) unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=502 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ro_city` */

insert  into `ro_city`(`id`,`city_name`,`province_id`,`type`,`postal_code`,`created_at`,`updated_at`) values 
(1,'Aceh Barat',21,'Kabupaten','23681','2022-05-26 23:10:32',NULL),
(2,'Aceh Barat Daya',21,'Kabupaten','23764','2022-05-26 23:10:32',NULL),
(3,'Aceh Besar',21,'Kabupaten','23951','2022-05-26 23:10:32',NULL),
(4,'Aceh Jaya',21,'Kabupaten','23654','2022-05-26 23:10:32',NULL),
(5,'Aceh Selatan',21,'Kabupaten','23719','2022-05-26 23:10:32',NULL),
(6,'Aceh Singkil',21,'Kabupaten','24785','2022-05-26 23:10:32',NULL),
(7,'Aceh Tamiang',21,'Kabupaten','24476','2022-05-26 23:10:32',NULL),
(8,'Aceh Tengah',21,'Kabupaten','24511','2022-05-26 23:10:32',NULL),
(9,'Aceh Tenggara',21,'Kabupaten','24611','2022-05-26 23:10:32',NULL),
(10,'Aceh Timur',21,'Kabupaten','24454','2022-05-26 23:10:32',NULL),
(11,'Aceh Utara',21,'Kabupaten','24382','2022-05-26 23:10:32',NULL),
(12,'Agam',32,'Kabupaten','26411','2022-05-26 23:10:32',NULL),
(13,'Alor',23,'Kabupaten','85811','2022-05-26 23:10:32',NULL),
(14,'Ambon',19,'Kota','97222','2022-05-26 23:10:32',NULL),
(15,'Asahan',34,'Kabupaten','21214','2022-05-26 23:10:32',NULL),
(16,'Asmat',24,'Kabupaten','99777','2022-05-26 23:10:32',NULL),
(17,'Badung',1,'Kabupaten','80351','2022-05-26 23:10:32',NULL),
(18,'Balangan',13,'Kabupaten','71611','2022-05-26 23:10:32',NULL),
(19,'Balikpapan',15,'Kota','76111','2022-05-26 23:10:32',NULL),
(20,'Banda Aceh',21,'Kota','23238','2022-05-26 23:10:32',NULL),
(21,'Bandar Lampung',18,'Kota','35139','2022-05-26 23:10:32',NULL),
(22,'Bandung',9,'Kabupaten','40311','2022-05-26 23:10:32',NULL),
(23,'Bandung',9,'Kota','40111','2022-05-26 23:10:32',NULL),
(24,'Bandung Barat',9,'Kabupaten','40721','2022-05-26 23:10:32',NULL),
(25,'Banggai',29,'Kabupaten','94711','2022-05-26 23:10:32',NULL),
(26,'Banggai Kepulauan',29,'Kabupaten','94881','2022-05-26 23:10:32',NULL),
(27,'Bangka',2,'Kabupaten','33212','2022-05-26 23:10:32',NULL),
(28,'Bangka Barat',2,'Kabupaten','33315','2022-05-26 23:10:32',NULL),
(29,'Bangka Selatan',2,'Kabupaten','33719','2022-05-26 23:10:32',NULL),
(30,'Bangka Tengah',2,'Kabupaten','33613','2022-05-26 23:10:32',NULL),
(31,'Bangkalan',11,'Kabupaten','69118','2022-05-26 23:10:32',NULL),
(32,'Bangli',1,'Kabupaten','80619','2022-05-26 23:10:32',NULL),
(33,'Banjar',13,'Kabupaten','70619','2022-05-26 23:10:32',NULL),
(34,'Banjar',9,'Kota','46311','2022-05-26 23:10:32',NULL),
(35,'Banjarbaru',13,'Kota','70712','2022-05-26 23:10:32',NULL),
(36,'Banjarmasin',13,'Kota','70117','2022-05-26 23:10:32',NULL),
(37,'Banjarnegara',10,'Kabupaten','53419','2022-05-26 23:10:32',NULL),
(38,'Bantaeng',28,'Kabupaten','92411','2022-05-26 23:10:32',NULL),
(39,'Bantul',5,'Kabupaten','55715','2022-05-26 23:10:32',NULL),
(40,'Banyuasin',33,'Kabupaten','30911','2022-05-26 23:10:32',NULL),
(41,'Banyumas',10,'Kabupaten','53114','2022-05-26 23:10:32',NULL),
(42,'Banyuwangi',11,'Kabupaten','68416','2022-05-26 23:10:32',NULL),
(43,'Barito Kuala',13,'Kabupaten','70511','2022-05-26 23:10:32',NULL),
(44,'Barito Selatan',14,'Kabupaten','73711','2022-05-26 23:10:32',NULL),
(45,'Barito Timur',14,'Kabupaten','73671','2022-05-26 23:10:32',NULL),
(46,'Barito Utara',14,'Kabupaten','73881','2022-05-26 23:10:32',NULL),
(47,'Barru',28,'Kabupaten','90719','2022-05-26 23:10:32',NULL),
(48,'Batam',17,'Kota','29413','2022-05-26 23:10:32',NULL),
(49,'Batang',10,'Kabupaten','51211','2022-05-26 23:10:32',NULL),
(50,'Batang Hari',8,'Kabupaten','36613','2022-05-26 23:10:32',NULL),
(51,'Batu',11,'Kota','65311','2022-05-26 23:10:32',NULL),
(52,'Batu Bara',34,'Kabupaten','21655','2022-05-26 23:10:32',NULL),
(53,'Bau-Bau',30,'Kota','93719','2022-05-26 23:10:32',NULL),
(54,'Bekasi',9,'Kabupaten','17837','2022-05-26 23:10:32',NULL),
(55,'Bekasi',9,'Kota','17121','2022-05-26 23:10:32',NULL),
(56,'Belitung',2,'Kabupaten','33419','2022-05-26 23:10:32',NULL),
(57,'Belitung Timur',2,'Kabupaten','33519','2022-05-26 23:10:32',NULL),
(58,'Belu',23,'Kabupaten','85711','2022-05-26 23:10:32',NULL),
(59,'Bener Meriah',21,'Kabupaten','24581','2022-05-26 23:10:32',NULL),
(60,'Bengkalis',26,'Kabupaten','28719','2022-05-26 23:10:32',NULL),
(61,'Bengkayang',12,'Kabupaten','79213','2022-05-26 23:10:32',NULL),
(62,'Bengkulu',4,'Kota','38229','2022-05-26 23:10:32',NULL),
(63,'Bengkulu Selatan',4,'Kabupaten','38519','2022-05-26 23:10:32',NULL),
(64,'Bengkulu Tengah',4,'Kabupaten','38319','2022-05-26 23:10:32',NULL),
(65,'Bengkulu Utara',4,'Kabupaten','38619','2022-05-26 23:10:32',NULL),
(66,'Berau',15,'Kabupaten','77311','2022-05-26 23:10:32',NULL),
(67,'Biak Numfor',24,'Kabupaten','98119','2022-05-26 23:10:32',NULL),
(68,'Bima',22,'Kabupaten','84171','2022-05-26 23:10:32',NULL),
(69,'Bima',22,'Kota','84139','2022-05-26 23:10:32',NULL),
(70,'Binjai',34,'Kota','20712','2022-05-26 23:10:32',NULL),
(71,'Bintan',17,'Kabupaten','29135','2022-05-26 23:10:32',NULL),
(72,'Bireuen',21,'Kabupaten','24219','2022-05-26 23:10:32',NULL),
(73,'Bitung',31,'Kota','95512','2022-05-26 23:10:32',NULL),
(74,'Blitar',11,'Kabupaten','66171','2022-05-26 23:10:32',NULL),
(75,'Blitar',11,'Kota','66124','2022-05-26 23:10:32',NULL),
(76,'Blora',10,'Kabupaten','58219','2022-05-26 23:10:32',NULL),
(77,'Boalemo',7,'Kabupaten','96319','2022-05-26 23:10:32',NULL),
(78,'Bogor',9,'Kabupaten','16911','2022-05-26 23:10:32',NULL),
(79,'Bogor',9,'Kota','16119','2022-05-26 23:10:32',NULL),
(80,'Bojonegoro',11,'Kabupaten','62119','2022-05-26 23:10:32',NULL),
(81,'Bolaang Mongondow (Bolmong)',31,'Kabupaten','95755','2022-05-26 23:10:32',NULL),
(82,'Bolaang Mongondow Selatan',31,'Kabupaten','95774','2022-05-26 23:10:32',NULL),
(83,'Bolaang Mongondow Timur',31,'Kabupaten','95783','2022-05-26 23:10:32',NULL),
(84,'Bolaang Mongondow Utara',31,'Kabupaten','95765','2022-05-26 23:10:32',NULL),
(85,'Bombana',30,'Kabupaten','93771','2022-05-26 23:10:32',NULL),
(86,'Bondowoso',11,'Kabupaten','68219','2022-05-26 23:10:32',NULL),
(87,'Bone',28,'Kabupaten','92713','2022-05-26 23:10:32',NULL),
(88,'Bone Bolango',7,'Kabupaten','96511','2022-05-26 23:10:32',NULL),
(89,'Bontang',15,'Kota','75313','2022-05-26 23:10:32',NULL),
(90,'Boven Digoel',24,'Kabupaten','99662','2022-05-26 23:10:32',NULL),
(91,'Boyolali',10,'Kabupaten','57312','2022-05-26 23:10:32',NULL),
(92,'Brebes',10,'Kabupaten','52212','2022-05-26 23:10:32',NULL),
(93,'Bukittinggi',32,'Kota','26115','2022-05-26 23:10:32',NULL),
(94,'Buleleng',1,'Kabupaten','81111','2022-05-26 23:10:32',NULL),
(95,'Bulukumba',28,'Kabupaten','92511','2022-05-26 23:10:32',NULL),
(96,'Bulungan (Bulongan)',16,'Kabupaten','77211','2022-05-26 23:10:32',NULL),
(97,'Bungo',8,'Kabupaten','37216','2022-05-26 23:10:32',NULL),
(98,'Buol',29,'Kabupaten','94564','2022-05-26 23:10:32',NULL),
(99,'Buru',19,'Kabupaten','97371','2022-05-26 23:10:32',NULL),
(100,'Buru Selatan',19,'Kabupaten','97351','2022-05-26 23:10:32',NULL),
(101,'Buton',30,'Kabupaten','93754','2022-05-26 23:10:32',NULL),
(102,'Buton Utara',30,'Kabupaten','93745','2022-05-26 23:10:32',NULL),
(103,'Ciamis',9,'Kabupaten','46211','2022-05-26 23:10:32',NULL),
(104,'Cianjur',9,'Kabupaten','43217','2022-05-26 23:10:32',NULL),
(105,'Cilacap',10,'Kabupaten','53211','2022-05-26 23:10:32',NULL),
(106,'Cilegon',3,'Kota','42417','2022-05-26 23:10:32',NULL),
(107,'Cimahi',9,'Kota','40512','2022-05-26 23:10:32',NULL),
(108,'Cirebon',9,'Kabupaten','45611','2022-05-26 23:10:32',NULL),
(109,'Cirebon',9,'Kota','45116','2022-05-26 23:10:32',NULL),
(110,'Dairi',34,'Kabupaten','22211','2022-05-26 23:10:32',NULL),
(111,'Deiyai (Deliyai)',24,'Kabupaten','98784','2022-05-26 23:10:32',NULL),
(112,'Deli Serdang',34,'Kabupaten','20511','2022-05-26 23:10:32',NULL),
(113,'Demak',10,'Kabupaten','59519','2022-05-26 23:10:32',NULL),
(114,'Denpasar',1,'Kota','80227','2022-05-26 23:10:32',NULL),
(115,'Depok',9,'Kota','16416','2022-05-26 23:10:32',NULL),
(116,'Dharmasraya',32,'Kabupaten','27612','2022-05-26 23:10:32',NULL),
(117,'Dogiyai',24,'Kabupaten','98866','2022-05-26 23:10:32',NULL),
(118,'Dompu',22,'Kabupaten','84217','2022-05-26 23:10:32',NULL),
(119,'Donggala',29,'Kabupaten','94341','2022-05-26 23:10:32',NULL),
(120,'Dumai',26,'Kota','28811','2022-05-26 23:10:32',NULL),
(121,'Empat Lawang',33,'Kabupaten','31811','2022-05-26 23:10:32',NULL),
(122,'Ende',23,'Kabupaten','86351','2022-05-26 23:10:32',NULL),
(123,'Enrekang',28,'Kabupaten','91719','2022-05-26 23:10:32',NULL),
(124,'Fakfak',25,'Kabupaten','98651','2022-05-26 23:10:32',NULL),
(125,'Flores Timur',23,'Kabupaten','86213','2022-05-26 23:10:32',NULL),
(126,'Garut',9,'Kabupaten','44126','2022-05-26 23:10:32',NULL),
(127,'Gayo Lues',21,'Kabupaten','24653','2022-05-26 23:10:32',NULL),
(128,'Gianyar',1,'Kabupaten','80519','2022-05-26 23:10:32',NULL),
(129,'Gorontalo',7,'Kabupaten','96218','2022-05-26 23:10:32',NULL),
(130,'Gorontalo',7,'Kota','96115','2022-05-26 23:10:32',NULL),
(131,'Gorontalo Utara',7,'Kabupaten','96611','2022-05-26 23:10:32',NULL),
(132,'Gowa',28,'Kabupaten','92111','2022-05-26 23:10:32',NULL),
(133,'Gresik',11,'Kabupaten','61115','2022-05-26 23:10:32',NULL),
(134,'Grobogan',10,'Kabupaten','58111','2022-05-26 23:10:32',NULL),
(135,'Gunung Kidul',5,'Kabupaten','55812','2022-05-26 23:10:32',NULL),
(136,'Gunung Mas',14,'Kabupaten','74511','2022-05-26 23:10:32',NULL),
(137,'Gunungsitoli',34,'Kota','22813','2022-05-26 23:10:32',NULL),
(138,'Halmahera Barat',20,'Kabupaten','97757','2022-05-26 23:10:32',NULL),
(139,'Halmahera Selatan',20,'Kabupaten','97911','2022-05-26 23:10:32',NULL),
(140,'Halmahera Tengah',20,'Kabupaten','97853','2022-05-26 23:10:32',NULL),
(141,'Halmahera Timur',20,'Kabupaten','97862','2022-05-26 23:10:32',NULL),
(142,'Halmahera Utara',20,'Kabupaten','97762','2022-05-26 23:10:32',NULL),
(143,'Hulu Sungai Selatan',13,'Kabupaten','71212','2022-05-26 23:10:32',NULL),
(144,'Hulu Sungai Tengah',13,'Kabupaten','71313','2022-05-26 23:10:32',NULL),
(145,'Hulu Sungai Utara',13,'Kabupaten','71419','2022-05-26 23:10:32',NULL),
(146,'Humbang Hasundutan',34,'Kabupaten','22457','2022-05-26 23:10:32',NULL),
(147,'Indragiri Hilir',26,'Kabupaten','29212','2022-05-26 23:10:32',NULL),
(148,'Indragiri Hulu',26,'Kabupaten','29319','2022-05-26 23:10:32',NULL),
(149,'Indramayu',9,'Kabupaten','45214','2022-05-26 23:10:32',NULL),
(150,'Intan Jaya',24,'Kabupaten','98771','2022-05-26 23:10:32',NULL),
(151,'Jakarta Barat',6,'Kota','11220','2022-05-26 23:10:32',NULL),
(152,'Jakarta Pusat',6,'Kota','10540','2022-05-26 23:10:32',NULL),
(153,'Jakarta Selatan',6,'Kota','12230','2022-05-26 23:10:32',NULL),
(154,'Jakarta Timur',6,'Kota','13330','2022-05-26 23:10:32',NULL),
(155,'Jakarta Utara',6,'Kota','14140','2022-05-26 23:10:32',NULL),
(156,'Jambi',8,'Kota','36111','2022-05-26 23:10:32',NULL),
(157,'Jayapura',24,'Kabupaten','99352','2022-05-26 23:10:32',NULL),
(158,'Jayapura',24,'Kota','99114','2022-05-26 23:10:32',NULL),
(159,'Jayawijaya',24,'Kabupaten','99511','2022-05-26 23:10:32',NULL),
(160,'Jember',11,'Kabupaten','68113','2022-05-26 23:10:32',NULL),
(161,'Jembrana',1,'Kabupaten','82251','2022-05-26 23:10:32',NULL),
(162,'Jeneponto',28,'Kabupaten','92319','2022-05-26 23:10:32',NULL),
(163,'Jepara',10,'Kabupaten','59419','2022-05-26 23:10:32',NULL),
(164,'Jombang',11,'Kabupaten','61415','2022-05-26 23:10:32',NULL),
(165,'Kaimana',25,'Kabupaten','98671','2022-05-26 23:10:32',NULL),
(166,'Kampar',26,'Kabupaten','28411','2022-05-26 23:10:32',NULL),
(167,'Kapuas',14,'Kabupaten','73583','2022-05-26 23:10:32',NULL),
(168,'Kapuas Hulu',12,'Kabupaten','78719','2022-05-26 23:10:32',NULL),
(169,'Karanganyar',10,'Kabupaten','57718','2022-05-26 23:10:32',NULL),
(170,'Karangasem',1,'Kabupaten','80819','2022-05-26 23:10:32',NULL),
(171,'Karawang',9,'Kabupaten','41311','2022-05-26 23:10:32',NULL),
(172,'Karimun',17,'Kabupaten','29611','2022-05-26 23:10:32',NULL),
(173,'Karo',34,'Kabupaten','22119','2022-05-26 23:10:32',NULL),
(174,'Katingan',14,'Kabupaten','74411','2022-05-26 23:10:32',NULL),
(175,'Kaur',4,'Kabupaten','38911','2022-05-26 23:10:32',NULL),
(176,'Kayong Utara',12,'Kabupaten','78852','2022-05-26 23:10:32',NULL),
(177,'Kebumen',10,'Kabupaten','54319','2022-05-26 23:10:32',NULL),
(178,'Kediri',11,'Kabupaten','64184','2022-05-26 23:10:32',NULL),
(179,'Kediri',11,'Kota','64125','2022-05-26 23:10:32',NULL),
(180,'Keerom',24,'Kabupaten','99461','2022-05-26 23:10:32',NULL),
(181,'Kendal',10,'Kabupaten','51314','2022-05-26 23:10:32',NULL),
(182,'Kendari',30,'Kota','93126','2022-05-26 23:10:32',NULL),
(183,'Kepahiang',4,'Kabupaten','39319','2022-05-26 23:10:32',NULL),
(184,'Kepulauan Anambas',17,'Kabupaten','29991','2022-05-26 23:10:32',NULL),
(185,'Kepulauan Aru',19,'Kabupaten','97681','2022-05-26 23:10:32',NULL),
(186,'Kepulauan Mentawai',32,'Kabupaten','25771','2022-05-26 23:10:32',NULL),
(187,'Kepulauan Meranti',26,'Kabupaten','28791','2022-05-26 23:10:32',NULL),
(188,'Kepulauan Sangihe',31,'Kabupaten','95819','2022-05-26 23:10:32',NULL),
(189,'Kepulauan Seribu',6,'Kabupaten','14550','2022-05-26 23:10:32',NULL),
(190,'Kepulauan Siau Tagulandang Biaro (Sitaro)',31,'Kabupaten','95862','2022-05-26 23:10:32',NULL),
(191,'Kepulauan Sula',20,'Kabupaten','97995','2022-05-26 23:10:32',NULL),
(192,'Kepulauan Talaud',31,'Kabupaten','95885','2022-05-26 23:10:32',NULL),
(193,'Kepulauan Yapen (Yapen Waropen)',24,'Kabupaten','98211','2022-05-26 23:10:32',NULL),
(194,'Kerinci',8,'Kabupaten','37167','2022-05-26 23:10:32',NULL),
(195,'Ketapang',12,'Kabupaten','78874','2022-05-26 23:10:32',NULL),
(196,'Klaten',10,'Kabupaten','57411','2022-05-26 23:10:32',NULL),
(197,'Klungkung',1,'Kabupaten','80719','2022-05-26 23:10:32',NULL),
(198,'Kolaka',30,'Kabupaten','93511','2022-05-26 23:10:32',NULL),
(199,'Kolaka Utara',30,'Kabupaten','93911','2022-05-26 23:10:32',NULL),
(200,'Konawe',30,'Kabupaten','93411','2022-05-26 23:10:32',NULL),
(201,'Konawe Selatan',30,'Kabupaten','93811','2022-05-26 23:10:32',NULL),
(202,'Konawe Utara',30,'Kabupaten','93311','2022-05-26 23:10:32',NULL),
(203,'Kotabaru',13,'Kabupaten','72119','2022-05-26 23:10:32',NULL),
(204,'Kotamobagu',31,'Kota','95711','2022-05-26 23:10:32',NULL),
(205,'Kotawaringin Barat',14,'Kabupaten','74119','2022-05-26 23:10:32',NULL),
(206,'Kotawaringin Timur',14,'Kabupaten','74364','2022-05-26 23:10:32',NULL),
(207,'Kuantan Singingi',26,'Kabupaten','29519','2022-05-26 23:10:32',NULL),
(208,'Kubu Raya',12,'Kabupaten','78311','2022-05-26 23:10:32',NULL),
(209,'Kudus',10,'Kabupaten','59311','2022-05-26 23:10:32',NULL),
(210,'Kulon Progo',5,'Kabupaten','55611','2022-05-26 23:10:32',NULL),
(211,'Kuningan',9,'Kabupaten','45511','2022-05-26 23:10:32',NULL),
(212,'Kupang',23,'Kabupaten','85362','2022-05-26 23:10:32',NULL),
(213,'Kupang',23,'Kota','85119','2022-05-26 23:10:32',NULL),
(214,'Kutai Barat',15,'Kabupaten','75711','2022-05-26 23:10:32',NULL),
(215,'Kutai Kartanegara',15,'Kabupaten','75511','2022-05-26 23:10:32',NULL),
(216,'Kutai Timur',15,'Kabupaten','75611','2022-05-26 23:10:32',NULL),
(217,'Labuhan Batu',34,'Kabupaten','21412','2022-05-26 23:10:32',NULL),
(218,'Labuhan Batu Selatan',34,'Kabupaten','21511','2022-05-26 23:10:32',NULL),
(219,'Labuhan Batu Utara',34,'Kabupaten','21711','2022-05-26 23:10:32',NULL),
(220,'Lahat',33,'Kabupaten','31419','2022-05-26 23:10:32',NULL),
(221,'Lamandau',14,'Kabupaten','74611','2022-05-26 23:10:32',NULL),
(222,'Lamongan',11,'Kabupaten','64125','2022-05-26 23:10:32',NULL),
(223,'Lampung Barat',18,'Kabupaten','34814','2022-05-26 23:10:32',NULL),
(224,'Lampung Selatan',18,'Kabupaten','35511','2022-05-26 23:10:32',NULL),
(225,'Lampung Tengah',18,'Kabupaten','34212','2022-05-26 23:10:32',NULL),
(226,'Lampung Timur',18,'Kabupaten','34319','2022-05-26 23:10:32',NULL),
(227,'Lampung Utara',18,'Kabupaten','34516','2022-05-26 23:10:32',NULL),
(228,'Landak',12,'Kabupaten','78319','2022-05-26 23:10:32',NULL),
(229,'Langkat',34,'Kabupaten','20811','2022-05-26 23:10:32',NULL),
(230,'Langsa',21,'Kota','24412','2022-05-26 23:10:32',NULL),
(231,'Lanny Jaya',24,'Kabupaten','99531','2022-05-26 23:10:32',NULL),
(232,'Lebak',3,'Kabupaten','42319','2022-05-26 23:10:32',NULL),
(233,'Lebong',4,'Kabupaten','39264','2022-05-26 23:10:32',NULL),
(234,'Lembata',23,'Kabupaten','86611','2022-05-26 23:10:32',NULL),
(235,'Lhokseumawe',21,'Kota','24352','2022-05-26 23:10:32',NULL),
(236,'Lima Puluh Koto/Kota',32,'Kabupaten','26671','2022-05-26 23:10:32',NULL),
(237,'Lingga',17,'Kabupaten','29811','2022-05-26 23:10:32',NULL),
(238,'Lombok Barat',22,'Kabupaten','83311','2022-05-26 23:10:32',NULL),
(239,'Lombok Tengah',22,'Kabupaten','83511','2022-05-26 23:10:32',NULL),
(240,'Lombok Timur',22,'Kabupaten','83612','2022-05-26 23:10:32',NULL),
(241,'Lombok Utara',22,'Kabupaten','83711','2022-05-26 23:10:32',NULL),
(242,'Lubuk Linggau',33,'Kota','31614','2022-05-26 23:10:32',NULL),
(243,'Lumajang',11,'Kabupaten','67319','2022-05-26 23:10:32',NULL),
(244,'Luwu',28,'Kabupaten','91994','2022-05-26 23:10:32',NULL),
(245,'Luwu Timur',28,'Kabupaten','92981','2022-05-26 23:10:32',NULL),
(246,'Luwu Utara',28,'Kabupaten','92911','2022-05-26 23:10:32',NULL),
(247,'Madiun',11,'Kabupaten','63153','2022-05-26 23:10:32',NULL),
(248,'Madiun',11,'Kota','63122','2022-05-26 23:10:32',NULL),
(249,'Magelang',10,'Kabupaten','56519','2022-05-26 23:10:32',NULL),
(250,'Magelang',10,'Kota','56133','2022-05-26 23:10:32',NULL),
(251,'Magetan',11,'Kabupaten','63314','2022-05-26 23:10:32',NULL),
(252,'Majalengka',9,'Kabupaten','45412','2022-05-26 23:10:32',NULL),
(253,'Majene',27,'Kabupaten','91411','2022-05-26 23:10:32',NULL),
(254,'Makassar',28,'Kota','90111','2022-05-26 23:10:32',NULL),
(255,'Malang',11,'Kabupaten','65163','2022-05-26 23:10:32',NULL),
(256,'Malang',11,'Kota','65112','2022-05-26 23:10:32',NULL),
(257,'Malinau',16,'Kabupaten','77511','2022-05-26 23:10:32',NULL),
(258,'Maluku Barat Daya',19,'Kabupaten','97451','2022-05-26 23:10:32',NULL),
(259,'Maluku Tengah',19,'Kabupaten','97513','2022-05-26 23:10:32',NULL),
(260,'Maluku Tenggara',19,'Kabupaten','97651','2022-05-26 23:10:32',NULL),
(261,'Maluku Tenggara Barat',19,'Kabupaten','97465','2022-05-26 23:10:32',NULL),
(262,'Mamasa',27,'Kabupaten','91362','2022-05-26 23:10:32',NULL),
(263,'Mamberamo Raya',24,'Kabupaten','99381','2022-05-26 23:10:32',NULL),
(264,'Mamberamo Tengah',24,'Kabupaten','99553','2022-05-26 23:10:32',NULL),
(265,'Mamuju',27,'Kabupaten','91519','2022-05-26 23:10:32',NULL),
(266,'Mamuju Utara',27,'Kabupaten','91571','2022-05-26 23:10:32',NULL),
(267,'Manado',31,'Kota','95247','2022-05-26 23:10:32',NULL),
(268,'Mandailing Natal',34,'Kabupaten','22916','2022-05-26 23:10:32',NULL),
(269,'Manggarai',23,'Kabupaten','86551','2022-05-26 23:10:32',NULL),
(270,'Manggarai Barat',23,'Kabupaten','86711','2022-05-26 23:10:32',NULL),
(271,'Manggarai Timur',23,'Kabupaten','86811','2022-05-26 23:10:32',NULL),
(272,'Manokwari',25,'Kabupaten','98311','2022-05-26 23:10:32',NULL),
(273,'Manokwari Selatan',25,'Kabupaten','98355','2022-05-26 23:10:32',NULL),
(274,'Mappi',24,'Kabupaten','99853','2022-05-26 23:10:32',NULL),
(275,'Maros',28,'Kabupaten','90511','2022-05-26 23:10:32',NULL),
(276,'Mataram',22,'Kota','83131','2022-05-26 23:10:32',NULL),
(277,'Maybrat',25,'Kabupaten','98051','2022-05-26 23:10:32',NULL),
(278,'Medan',34,'Kota','20228','2022-05-26 23:10:32',NULL),
(279,'Melawi',12,'Kabupaten','78619','2022-05-26 23:10:32',NULL),
(280,'Merangin',8,'Kabupaten','37319','2022-05-26 23:10:32',NULL),
(281,'Merauke',24,'Kabupaten','99613','2022-05-26 23:10:32',NULL),
(282,'Mesuji',18,'Kabupaten','34911','2022-05-26 23:10:32',NULL),
(283,'Metro',18,'Kota','34111','2022-05-26 23:10:32',NULL),
(284,'Mimika',24,'Kabupaten','99962','2022-05-26 23:10:32',NULL),
(285,'Minahasa',31,'Kabupaten','95614','2022-05-26 23:10:32',NULL),
(286,'Minahasa Selatan',31,'Kabupaten','95914','2022-05-26 23:10:32',NULL),
(287,'Minahasa Tenggara',31,'Kabupaten','95995','2022-05-26 23:10:32',NULL),
(288,'Minahasa Utara',31,'Kabupaten','95316','2022-05-26 23:10:32',NULL),
(289,'Mojokerto',11,'Kabupaten','61382','2022-05-26 23:10:32',NULL),
(290,'Mojokerto',11,'Kota','61316','2022-05-26 23:10:32',NULL),
(291,'Morowali',29,'Kabupaten','94911','2022-05-26 23:10:32',NULL),
(292,'Muara Enim',33,'Kabupaten','31315','2022-05-26 23:10:32',NULL),
(293,'Muaro Jambi',8,'Kabupaten','36311','2022-05-26 23:10:32',NULL),
(294,'Muko Muko',4,'Kabupaten','38715','2022-05-26 23:10:32',NULL),
(295,'Muna',30,'Kabupaten','93611','2022-05-26 23:10:32',NULL),
(296,'Murung Raya',14,'Kabupaten','73911','2022-05-26 23:10:32',NULL),
(297,'Musi Banyuasin',33,'Kabupaten','30719','2022-05-26 23:10:32',NULL),
(298,'Musi Rawas',33,'Kabupaten','31661','2022-05-26 23:10:32',NULL),
(299,'Nabire',24,'Kabupaten','98816','2022-05-26 23:10:32',NULL),
(300,'Nagan Raya',21,'Kabupaten','23674','2022-05-26 23:10:32',NULL),
(301,'Nagekeo',23,'Kabupaten','86911','2022-05-26 23:10:32',NULL),
(302,'Natuna',17,'Kabupaten','29711','2022-05-26 23:10:32',NULL),
(303,'Nduga',24,'Kabupaten','99541','2022-05-26 23:10:32',NULL),
(304,'Ngada',23,'Kabupaten','86413','2022-05-26 23:10:32',NULL),
(305,'Nganjuk',11,'Kabupaten','64414','2022-05-26 23:10:32',NULL),
(306,'Ngawi',11,'Kabupaten','63219','2022-05-26 23:10:32',NULL),
(307,'Nias',34,'Kabupaten','22876','2022-05-26 23:10:32',NULL),
(308,'Nias Barat',34,'Kabupaten','22895','2022-05-26 23:10:32',NULL),
(309,'Nias Selatan',34,'Kabupaten','22865','2022-05-26 23:10:32',NULL),
(310,'Nias Utara',34,'Kabupaten','22856','2022-05-26 23:10:32',NULL),
(311,'Nunukan',16,'Kabupaten','77421','2022-05-26 23:10:32',NULL),
(312,'Ogan Ilir',33,'Kabupaten','30811','2022-05-26 23:10:32',NULL),
(313,'Ogan Komering Ilir',33,'Kabupaten','30618','2022-05-26 23:10:32',NULL),
(314,'Ogan Komering Ulu',33,'Kabupaten','32112','2022-05-26 23:10:32',NULL),
(315,'Ogan Komering Ulu Selatan',33,'Kabupaten','32211','2022-05-26 23:10:32',NULL),
(316,'Ogan Komering Ulu Timur',33,'Kabupaten','32312','2022-05-26 23:10:32',NULL),
(317,'Pacitan',11,'Kabupaten','63512','2022-05-26 23:10:32',NULL),
(318,'Padang',32,'Kota','25112','2022-05-26 23:10:32',NULL),
(319,'Padang Lawas',34,'Kabupaten','22763','2022-05-26 23:10:32',NULL),
(320,'Padang Lawas Utara',34,'Kabupaten','22753','2022-05-26 23:10:32',NULL),
(321,'Padang Panjang',32,'Kota','27122','2022-05-26 23:10:32',NULL),
(322,'Padang Pariaman',32,'Kabupaten','25583','2022-05-26 23:10:32',NULL),
(323,'Padang Sidempuan',34,'Kota','22727','2022-05-26 23:10:32',NULL),
(324,'Pagar Alam',33,'Kota','31512','2022-05-26 23:10:32',NULL),
(325,'Pakpak Bharat',34,'Kabupaten','22272','2022-05-26 23:10:32',NULL),
(326,'Palangka Raya',14,'Kota','73112','2022-05-26 23:10:32',NULL),
(327,'Palembang',33,'Kota','30111','2022-05-26 23:10:32',NULL),
(328,'Palopo',28,'Kota','91911','2022-05-26 23:10:32',NULL),
(329,'Palu',29,'Kota','94111','2022-05-26 23:10:32',NULL),
(330,'Pamekasan',11,'Kabupaten','69319','2022-05-26 23:10:32',NULL),
(331,'Pandeglang',3,'Kabupaten','42212','2022-05-26 23:10:32',NULL),
(332,'Pangandaran',9,'Kabupaten','46511','2022-05-26 23:10:32',NULL),
(333,'Pangkajene Kepulauan',28,'Kabupaten','90611','2022-05-26 23:10:32',NULL),
(334,'Pangkal Pinang',2,'Kota','33115','2022-05-26 23:10:32',NULL),
(335,'Paniai',24,'Kabupaten','98765','2022-05-26 23:10:32',NULL),
(336,'Parepare',28,'Kota','91123','2022-05-26 23:10:32',NULL),
(337,'Pariaman',32,'Kota','25511','2022-05-26 23:10:32',NULL),
(338,'Parigi Moutong',29,'Kabupaten','94411','2022-05-26 23:10:32',NULL),
(339,'Pasaman',32,'Kabupaten','26318','2022-05-26 23:10:32',NULL),
(340,'Pasaman Barat',32,'Kabupaten','26511','2022-05-26 23:10:32',NULL),
(341,'Paser',15,'Kabupaten','76211','2022-05-26 23:10:32',NULL),
(342,'Pasuruan',11,'Kabupaten','67153','2022-05-26 23:10:32',NULL),
(343,'Pasuruan',11,'Kota','67118','2022-05-26 23:10:32',NULL),
(344,'Pati',10,'Kabupaten','59114','2022-05-26 23:10:32',NULL),
(345,'Payakumbuh',32,'Kota','26213','2022-05-26 23:10:32',NULL),
(346,'Pegunungan Arfak',25,'Kabupaten','98354','2022-05-26 23:10:32',NULL),
(347,'Pegunungan Bintang',24,'Kabupaten','99573','2022-05-26 23:10:32',NULL),
(348,'Pekalongan',10,'Kabupaten','51161','2022-05-26 23:10:32',NULL),
(349,'Pekalongan',10,'Kota','51122','2022-05-26 23:10:32',NULL),
(350,'Pekanbaru',26,'Kota','28112','2022-05-26 23:10:32',NULL),
(351,'Pelalawan',26,'Kabupaten','28311','2022-05-26 23:10:32',NULL),
(352,'Pemalang',10,'Kabupaten','52319','2022-05-26 23:10:32',NULL),
(353,'Pematang Siantar',34,'Kota','21126','2022-05-26 23:10:32',NULL),
(354,'Penajam Paser Utara',15,'Kabupaten','76311','2022-05-26 23:10:32',NULL),
(355,'Pesawaran',18,'Kabupaten','35312','2022-05-26 23:10:32',NULL),
(356,'Pesisir Barat',18,'Kabupaten','35974','2022-05-26 23:10:32',NULL),
(357,'Pesisir Selatan',32,'Kabupaten','25611','2022-05-26 23:10:32',NULL),
(358,'Pidie',21,'Kabupaten','24116','2022-05-26 23:10:32',NULL),
(359,'Pidie Jaya',21,'Kabupaten','24186','2022-05-26 23:10:32',NULL),
(360,'Pinrang',28,'Kabupaten','91251','2022-05-26 23:10:32',NULL),
(361,'Pohuwato',7,'Kabupaten','96419','2022-05-26 23:10:32',NULL),
(362,'Polewali Mandar',27,'Kabupaten','91311','2022-05-26 23:10:32',NULL),
(363,'Ponorogo',11,'Kabupaten','63411','2022-05-26 23:10:32',NULL),
(364,'Pontianak',12,'Kabupaten','78971','2022-05-26 23:10:32',NULL),
(365,'Pontianak',12,'Kota','78112','2022-05-26 23:10:32',NULL),
(366,'Poso',29,'Kabupaten','94615','2022-05-26 23:10:32',NULL),
(367,'Prabumulih',33,'Kota','31121','2022-05-26 23:10:32',NULL),
(368,'Pringsewu',18,'Kabupaten','35719','2022-05-26 23:10:32',NULL),
(369,'Probolinggo',11,'Kabupaten','67282','2022-05-26 23:10:32',NULL),
(370,'Probolinggo',11,'Kota','67215','2022-05-26 23:10:32',NULL),
(371,'Pulang Pisau',14,'Kabupaten','74811','2022-05-26 23:10:32',NULL),
(372,'Pulau Morotai',20,'Kabupaten','97771','2022-05-26 23:10:32',NULL),
(373,'Puncak',24,'Kabupaten','98981','2022-05-26 23:10:32',NULL),
(374,'Puncak Jaya',24,'Kabupaten','98979','2022-05-26 23:10:32',NULL),
(375,'Purbalingga',10,'Kabupaten','53312','2022-05-26 23:10:32',NULL),
(376,'Purwakarta',9,'Kabupaten','41119','2022-05-26 23:10:32',NULL),
(377,'Purworejo',10,'Kabupaten','54111','2022-05-26 23:10:32',NULL),
(378,'Raja Ampat',25,'Kabupaten','98489','2022-05-26 23:10:32',NULL),
(379,'Rejang Lebong',4,'Kabupaten','39112','2022-05-26 23:10:32',NULL),
(380,'Rembang',10,'Kabupaten','59219','2022-05-26 23:10:32',NULL),
(381,'Rokan Hilir',26,'Kabupaten','28992','2022-05-26 23:10:32',NULL),
(382,'Rokan Hulu',26,'Kabupaten','28511','2022-05-26 23:10:32',NULL),
(383,'Rote Ndao',23,'Kabupaten','85982','2022-05-26 23:10:32',NULL),
(384,'Sabang',21,'Kota','23512','2022-05-26 23:10:32',NULL),
(385,'Sabu Raijua',23,'Kabupaten','85391','2022-05-26 23:10:32',NULL),
(386,'Salatiga',10,'Kota','50711','2022-05-26 23:10:32',NULL),
(387,'Samarinda',15,'Kota','75133','2022-05-26 23:10:32',NULL),
(388,'Sambas',12,'Kabupaten','79453','2022-05-26 23:10:32',NULL),
(389,'Samosir',34,'Kabupaten','22392','2022-05-26 23:10:32',NULL),
(390,'Sampang',11,'Kabupaten','69219','2022-05-26 23:10:32',NULL),
(391,'Sanggau',12,'Kabupaten','78557','2022-05-26 23:10:32',NULL),
(392,'Sarmi',24,'Kabupaten','99373','2022-05-26 23:10:32',NULL),
(393,'Sarolangun',8,'Kabupaten','37419','2022-05-26 23:10:32',NULL),
(394,'Sawah Lunto',32,'Kota','27416','2022-05-26 23:10:32',NULL),
(395,'Sekadau',12,'Kabupaten','79583','2022-05-26 23:10:32',NULL),
(396,'Selayar (Kepulauan Selayar)',28,'Kabupaten','92812','2022-05-26 23:10:32',NULL),
(397,'Seluma',4,'Kabupaten','38811','2022-05-26 23:10:32',NULL),
(398,'Semarang',10,'Kabupaten','50511','2022-05-26 23:10:32',NULL),
(399,'Semarang',10,'Kota','50135','2022-05-26 23:10:32',NULL),
(400,'Seram Bagian Barat',19,'Kabupaten','97561','2022-05-26 23:10:32',NULL),
(401,'Seram Bagian Timur',19,'Kabupaten','97581','2022-05-26 23:10:32',NULL),
(402,'Serang',3,'Kabupaten','42182','2022-05-26 23:10:32',NULL),
(403,'Serang',3,'Kota','42111','2022-05-26 23:10:32',NULL),
(404,'Serdang Bedagai',34,'Kabupaten','20915','2022-05-26 23:10:32',NULL),
(405,'Seruyan',14,'Kabupaten','74211','2022-05-26 23:10:32',NULL),
(406,'Siak',26,'Kabupaten','28623','2022-05-26 23:10:32',NULL),
(407,'Sibolga',34,'Kota','22522','2022-05-26 23:10:32',NULL),
(408,'Sidenreng Rappang/Rapang',28,'Kabupaten','91613','2022-05-26 23:10:32',NULL),
(409,'Sidoarjo',11,'Kabupaten','61219','2022-05-26 23:10:32',NULL),
(410,'Sigi',29,'Kabupaten','94364','2022-05-26 23:10:32',NULL),
(411,'Sijunjung (Sawah Lunto Sijunjung)',32,'Kabupaten','27511','2022-05-26 23:10:32',NULL),
(412,'Sikka',23,'Kabupaten','86121','2022-05-26 23:10:32',NULL),
(413,'Simalungun',34,'Kabupaten','21162','2022-05-26 23:10:32',NULL),
(414,'Simeulue',21,'Kabupaten','23891','2022-05-26 23:10:32',NULL),
(415,'Singkawang',12,'Kota','79117','2022-05-26 23:10:32',NULL),
(416,'Sinjai',28,'Kabupaten','92615','2022-05-26 23:10:32',NULL),
(417,'Sintang',12,'Kabupaten','78619','2022-05-26 23:10:32',NULL),
(418,'Situbondo',11,'Kabupaten','68316','2022-05-26 23:10:32',NULL),
(419,'Sleman',5,'Kabupaten','55513','2022-05-26 23:10:32',NULL),
(420,'Solok',32,'Kabupaten','27365','2022-05-26 23:10:32',NULL),
(421,'Solok',32,'Kota','27315','2022-05-26 23:10:32',NULL),
(422,'Solok Selatan',32,'Kabupaten','27779','2022-05-26 23:10:32',NULL),
(423,'Soppeng',28,'Kabupaten','90812','2022-05-26 23:10:32',NULL),
(424,'Sorong',25,'Kabupaten','98431','2022-05-26 23:10:32',NULL),
(425,'Sorong',25,'Kota','98411','2022-05-26 23:10:32',NULL),
(426,'Sorong Selatan',25,'Kabupaten','98454','2022-05-26 23:10:32',NULL),
(427,'Sragen',10,'Kabupaten','57211','2022-05-26 23:10:32',NULL),
(428,'Subang',9,'Kabupaten','41215','2022-05-26 23:10:32',NULL),
(429,'Subulussalam',21,'Kota','24882','2022-05-26 23:10:32',NULL),
(430,'Sukabumi',9,'Kabupaten','43311','2022-05-26 23:10:32',NULL),
(431,'Sukabumi',9,'Kota','43114','2022-05-26 23:10:32',NULL),
(432,'Sukamara',14,'Kabupaten','74712','2022-05-26 23:10:32',NULL),
(433,'Sukoharjo',10,'Kabupaten','57514','2022-05-26 23:10:32',NULL),
(434,'Sumba Barat',23,'Kabupaten','87219','2022-05-26 23:10:32',NULL),
(435,'Sumba Barat Daya',23,'Kabupaten','87453','2022-05-26 23:10:32',NULL),
(436,'Sumba Tengah',23,'Kabupaten','87358','2022-05-26 23:10:32',NULL),
(437,'Sumba Timur',23,'Kabupaten','87112','2022-05-26 23:10:32',NULL),
(438,'Sumbawa',22,'Kabupaten','84315','2022-05-26 23:10:32',NULL),
(439,'Sumbawa Barat',22,'Kabupaten','84419','2022-05-26 23:10:32',NULL),
(440,'Sumedang',9,'Kabupaten','45326','2022-05-26 23:10:32',NULL),
(441,'Sumenep',11,'Kabupaten','69413','2022-05-26 23:10:32',NULL),
(442,'Sungaipenuh',8,'Kota','37113','2022-05-26 23:10:32',NULL),
(443,'Supiori',24,'Kabupaten','98164','2022-05-26 23:10:32',NULL),
(444,'Surabaya',11,'Kota','60119','2022-05-26 23:10:32',NULL),
(445,'Surakarta (Solo)',10,'Kota','57113','2022-05-26 23:10:32',NULL),
(446,'Tabalong',13,'Kabupaten','71513','2022-05-26 23:10:32',NULL),
(447,'Tabanan',1,'Kabupaten','82119','2022-05-26 23:10:32',NULL),
(448,'Takalar',28,'Kabupaten','92212','2022-05-26 23:10:32',NULL),
(449,'Tambrauw',25,'Kabupaten','98475','2022-05-26 23:10:32',NULL),
(450,'Tana Tidung',16,'Kabupaten','77611','2022-05-26 23:10:32',NULL),
(451,'Tana Toraja',28,'Kabupaten','91819','2022-05-26 23:10:32',NULL),
(452,'Tanah Bumbu',13,'Kabupaten','72211','2022-05-26 23:10:32',NULL),
(453,'Tanah Datar',32,'Kabupaten','27211','2022-05-26 23:10:32',NULL),
(454,'Tanah Laut',13,'Kabupaten','70811','2022-05-26 23:10:32',NULL),
(455,'Tangerang',3,'Kabupaten','15914','2022-05-26 23:10:32',NULL),
(456,'Tangerang',3,'Kota','15111','2022-05-26 23:10:32',NULL),
(457,'Tangerang Selatan',3,'Kota','15435','2022-05-26 23:10:32',NULL),
(458,'Tanggamus',18,'Kabupaten','35619','2022-05-26 23:10:32',NULL),
(459,'Tanjung Balai',34,'Kota','21321','2022-05-26 23:10:32',NULL),
(460,'Tanjung Jabung Barat',8,'Kabupaten','36513','2022-05-26 23:10:32',NULL),
(461,'Tanjung Jabung Timur',8,'Kabupaten','36719','2022-05-26 23:10:32',NULL),
(462,'Tanjung Pinang',17,'Kota','29111','2022-05-26 23:10:32',NULL),
(463,'Tapanuli Selatan',34,'Kabupaten','22742','2022-05-26 23:10:32',NULL),
(464,'Tapanuli Tengah',34,'Kabupaten','22611','2022-05-26 23:10:32',NULL),
(465,'Tapanuli Utara',34,'Kabupaten','22414','2022-05-26 23:10:32',NULL),
(466,'Tapin',13,'Kabupaten','71119','2022-05-26 23:10:32',NULL),
(467,'Tarakan',16,'Kota','77114','2022-05-26 23:10:32',NULL),
(468,'Tasikmalaya',9,'Kabupaten','46411','2022-05-26 23:10:32',NULL),
(469,'Tasikmalaya',9,'Kota','46116','2022-05-26 23:10:32',NULL),
(470,'Tebing Tinggi',34,'Kota','20632','2022-05-26 23:10:32',NULL),
(471,'Tebo',8,'Kabupaten','37519','2022-05-26 23:10:32',NULL),
(472,'Tegal',10,'Kabupaten','52419','2022-05-26 23:10:32',NULL),
(473,'Tegal',10,'Kota','52114','2022-05-26 23:10:32',NULL),
(474,'Teluk Bintuni',25,'Kabupaten','98551','2022-05-26 23:10:32',NULL),
(475,'Teluk Wondama',25,'Kabupaten','98591','2022-05-26 23:10:32',NULL),
(476,'Temanggung',10,'Kabupaten','56212','2022-05-26 23:10:32',NULL),
(477,'Ternate',20,'Kota','97714','2022-05-26 23:10:32',NULL),
(478,'Tidore Kepulauan',20,'Kota','97815','2022-05-26 23:10:32',NULL),
(479,'Timor Tengah Selatan',23,'Kabupaten','85562','2022-05-26 23:10:32',NULL),
(480,'Timor Tengah Utara',23,'Kabupaten','85612','2022-05-26 23:10:32',NULL),
(481,'Toba Samosir',34,'Kabupaten','22316','2022-05-26 23:10:32',NULL),
(482,'Tojo Una-Una',29,'Kabupaten','94683','2022-05-26 23:10:32',NULL),
(483,'Toli-Toli',29,'Kabupaten','94542','2022-05-26 23:10:32',NULL),
(484,'Tolikara',24,'Kabupaten','99411','2022-05-26 23:10:32',NULL),
(485,'Tomohon',31,'Kota','95416','2022-05-26 23:10:32',NULL),
(486,'Toraja Utara',28,'Kabupaten','91831','2022-05-26 23:10:32',NULL),
(487,'Trenggalek',11,'Kabupaten','66312','2022-05-26 23:10:32',NULL),
(488,'Tual',19,'Kota','97612','2022-05-26 23:10:32',NULL),
(489,'Tuban',11,'Kabupaten','62319','2022-05-26 23:10:32',NULL),
(490,'Tulang Bawang',18,'Kabupaten','34613','2022-05-26 23:10:32',NULL),
(491,'Tulang Bawang Barat',18,'Kabupaten','34419','2022-05-26 23:10:32',NULL),
(492,'Tulungagung',11,'Kabupaten','66212','2022-05-26 23:10:32',NULL),
(493,'Wajo',28,'Kabupaten','90911','2022-05-26 23:10:32',NULL),
(494,'Wakatobi',30,'Kabupaten','93791','2022-05-26 23:10:32',NULL),
(495,'Waropen',24,'Kabupaten','98269','2022-05-26 23:10:32',NULL),
(496,'Way Kanan',18,'Kabupaten','34711','2022-05-26 23:10:32',NULL),
(497,'Wonogiri',10,'Kabupaten','57619','2022-05-26 23:10:32',NULL),
(498,'Wonosobo',10,'Kabupaten','56311','2022-05-26 23:10:32',NULL),
(499,'Yahukimo',24,'Kabupaten','99041','2022-05-26 23:10:32',NULL),
(500,'Yalimo',24,'Kabupaten','99481','2022-05-26 23:10:32',NULL),
(501,'Yogyakarta',5,'Kota','55111','2022-05-26 23:10:32',NULL);

/*Table structure for table `ro_province` */

DROP TABLE IF EXISTS `ro_province`;

CREATE TABLE `ro_province` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ro_province` */

insert  into `ro_province`(`id`,`province`,`created_at`,`updated_at`) values 
(1,'Bali','2022-05-26 23:10:30',NULL),
(2,'Bangka Belitung','2022-05-26 23:10:30',NULL),
(3,'Banten','2022-05-26 23:10:30',NULL),
(4,'Bengkulu','2022-05-26 23:10:30',NULL),
(5,'DI Yogyakarta','2022-05-26 23:10:30',NULL),
(6,'DKI Jakarta','2022-05-26 23:10:30',NULL),
(7,'Gorontalo','2022-05-26 23:10:30',NULL),
(8,'Jambi','2022-05-26 23:10:30',NULL),
(9,'Jawa Barat','2022-05-26 23:10:30',NULL),
(10,'Jawa Tengah','2022-05-26 23:10:30',NULL),
(11,'Jawa Timur','2022-05-26 23:10:30',NULL),
(12,'Kalimantan Barat','2022-05-26 23:10:30',NULL),
(13,'Kalimantan Selatan','2022-05-26 23:10:30',NULL),
(14,'Kalimantan Tengah','2022-05-26 23:10:30',NULL),
(15,'Kalimantan Timur','2022-05-26 23:10:30',NULL),
(16,'Kalimantan Utara','2022-05-26 23:10:30',NULL),
(17,'Kepulauan Riau','2022-05-26 23:10:30',NULL),
(18,'Lampung','2022-05-26 23:10:30',NULL),
(19,'Maluku','2022-05-26 23:10:30',NULL),
(20,'Maluku Utara','2022-05-26 23:10:30',NULL),
(21,'Nanggroe Aceh Darussalam (NAD)','2022-05-26 23:10:30',NULL),
(22,'Nusa Tenggara Barat (NTB)','2022-05-26 23:10:30',NULL),
(23,'Nusa Tenggara Timur (NTT)','2022-05-26 23:10:30',NULL),
(24,'Papua','2022-05-26 23:10:30',NULL),
(25,'Papua Barat','2022-05-26 23:10:30',NULL),
(26,'Riau','2022-05-26 23:10:30',NULL),
(27,'Sulawesi Barat','2022-05-26 23:10:30',NULL),
(28,'Sulawesi Selatan','2022-05-26 23:10:30',NULL),
(29,'Sulawesi Tengah','2022-05-26 23:10:30',NULL),
(30,'Sulawesi Tenggara','2022-05-26 23:10:30',NULL),
(31,'Sulawesi Utara','2022-05-26 23:10:30',NULL),
(32,'Sumatera Barat','2022-05-26 23:10:30',NULL),
(33,'Sumatera Selatan','2022-05-26 23:10:30',NULL),
(34,'Sumatera Utara','2022-05-26 23:10:30',NULL);

/*Table structure for table `transaction_details` */

DROP TABLE IF EXISTS `transaction_details`;

CREATE TABLE `transaction_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selling_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transaction_details` */

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `courier_id` bigint(20) unsigned NOT NULL,
  `timeout` datetime NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `shipping_cost` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `proof_of_payment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `transactions` */

/*Table structure for table `user_notifications` */

DROP TABLE IF EXISTS `user_notifications`;

CREATE TABLE `user_notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_notifications` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`user_name`,`email`,`email_verified_at`,`password`,`alamat`,`telepon`,`remember_token`,`created_at`,`updated_at`) values 
(1,'User','user@gmail.com','2022-05-26 23:12:32','$2y$10$al3Ajdnp8tVb5CEVdupT8.8PGQjsZYZQWahYES5yQ.HPwlHE6oWN.','Bali','123456789',NULL,'2022-05-26 23:12:20','2022-05-26 23:12:32');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
