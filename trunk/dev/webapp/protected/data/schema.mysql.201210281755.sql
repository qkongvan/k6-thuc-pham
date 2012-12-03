/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : plugins_dev

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2012-10-28 17:55:04
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `tbl_news_categories`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_news_categories`;
CREATE TABLE `tbl_news_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text,
  `is_active` tinyint(1) DEFAULT '1',
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `root` varchar(16) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_news_categories
-- ----------------------------
INSERT INTO `tbl_news_categories` VALUES ('9', 'Root', null, null, '1', '1', '6', null, '1', null, null, null);
INSERT INTO `tbl_news_categories` VALUES ('10', 'Hoạt Động', null, '', '1', '2', '3', '9', '2', null, '2012-07-29 09:33:40', '2012-07-29 09:33:40');
INSERT INTO `tbl_news_categories` VALUES ('11', 'Công Nghệ', null, '', '1', '4', '5', '9', '2', null, '2012-07-29 09:34:41', '2012-07-29 09:34:41');

-- ----------------------------
-- Table structure for `tbl_news_category_item`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_news_category_item`;
CREATE TABLE `tbl_news_category_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_item_id` (`item_id`) USING BTREE,
  KEY `idx_caregory_id` (`category_id`) USING BTREE,
  CONSTRAINT `frk_category_id` FOREIGN KEY (`category_id`) REFERENCES `tbl_news_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `frk_item_id` FOREIGN KEY (`item_id`) REFERENCES `tbl_news_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_news_category_item
-- ----------------------------
INSERT INTO `tbl_news_category_item` VALUES ('28', '10', '13');
INSERT INTO `tbl_news_category_item` VALUES ('33', '10', '12');
INSERT INTO `tbl_news_category_item` VALUES ('34', '11', '14');
INSERT INTO `tbl_news_category_item` VALUES ('35', '11', '15');

-- ----------------------------
-- Table structure for `tbl_news_items`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_news_items`;
CREATE TABLE `tbl_news_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `short_content` text,
  `content` text,
  `status` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_news_items
-- ----------------------------
INSERT INTO `tbl_news_items` VALUES ('12', 'PHP 5.4 và những điều nên biết', null, 'PHP 5.4 ra đời là một bước tiến quan trọng kể từ phiên bản 5.3- các tính năng mới sẽ được giữ lại trong phiên bản PHP 6 sau này (được hỗ trợ đầy đủ Unicode). Bản nâng cấp mang ý nghĩa quan trọng gần đây nhất là hoàn thiện tính năng cùng với việc bỏ hẳn các chức năng bị phản đối, kết quả là tận', '<p>\r\n	PHP 5.4 ra đời l&agrave; một bước tiến quan trọng kể từ phi&ecirc;n bản 5.3- c&aacute;c t&iacute;nh năng mới sẽ được giữ lại trong phi&ecirc;n bản PHP 6 sau n&agrave;y (được hỗ trợ đầy đủ Unicode). Bản n&acirc;ng cấp mang &yacute; nghĩa quan trọng gần đ&acirc;y nhất l&agrave; ho&agrave;n thiện t&iacute;nh năng c&ugrave;ng với việc bỏ hẳn c&aacute;c chức năng bị phản đối, kết quả l&agrave; tận dụng triệt để runtime (tăng 20% tốc độ v&agrave; giảm bộ nhớ sử dụng).</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://toancauxanh.vn/sites/default/files/549401_400249583333124_359033514121398_1341852_315531098_n.jpg\" /></p>\r\n<p>\r\n	Những cải tiến v&agrave; t&iacute;nh năng mới</p>\r\n<p>\r\n	Những t&iacute;nh năng mới quan trọng bao gồm c&aacute;c&nbsp;trait, c&uacute; ph&aacute;p&nbsp;array&nbsp;r&uacute;t gọn, webserver nh&uacute;ng sẵn cho ph&eacute;p test code nhanh ch&oacute;ng, sử dụng từ kh&oacute;a&nbsp;$this&nbsp;trong c&aacute;c closure, truy cập c&aacute;c lớp th&agrave;nh vi&ecirc;n v&agrave;o trong hiện thể,&nbsp;short_open_tag lu&ocirc;n được bật sẵn v&agrave; c&ograve;n nhiều hơn thế nữa!</p>\r\n<p>\r\n	Đ&aacute;ng n&oacute;i ở đ&acirc;y, PHP 5.4.0 đ&atilde; n&acirc;ng cấp hiệu suất, memory footprint v&agrave; chỉnh sửa tr&ecirc;n 100 bug. Bỏ c&aacute;c t&iacute;nh năng &nbsp;đ&aacute;ng ch&uacute; &yacute; bao gồm&nbsp;register_globals, magic_quotes&nbsp;(về thời gian) v&agrave;&nbsp;safe_mode. Điều đ&aacute;ng ch&uacute; &yacute; ở đ&acirc;y nữa l&agrave; thực tế sự hỗ trợ multibyte đ&atilde; được k&iacute;ch hoạt mặc định v&agrave;&nbsp;default_charset&nbsp;đ&atilde; thay đổi từ ISO-8859 th&agrave;nh UTF-8.</p>\r\n<p>\r\n	&quot;Content-Type: text/html; charset=utf-8&nbsp;th&igrave; lu&ocirc;n được gởi đi, v&igrave; vậy kh&ocirc;ng cần thiết phải c&agrave;i đặt thẻ HTML meta hoặc gởi th&ecirc;m c&aacute;c header để tương th&iacute;ch với UTF-8&quot;</p>\r\n<p>\r\n	Traits</p>\r\n<p>\r\n	Thế mạnh của c&aacute;c trait thể hiện r&otilde; khi nhiều&nbsp;class&nbsp;d&ugrave;ng chung một nh&oacute;m chức năng.</p>\r\n<p>\r\n	Trait (chuyển sang phong c&aacute;ch kế thừa h&agrave;ng ngang thay v&igrave; kiểu phả hệ trước đ&acirc;y) l&agrave; một tập hợp c&aacute;c phương thức với c&aacute;c cấu tr&uacute;c tương tự như một class (nhưng kh&ocirc;ng thể được khởi tạo), n&oacute; cho ph&eacute;p c&aacute;c nh&agrave; ph&aacute;t triển c&oacute; thể d&ugrave;ng lại c&aacute;c tập hợp phương thức một c&aacute;ch tự do ở trong c&aacute;c class độc lập. PHP l&agrave; một ng&ocirc;n ngữ đơn kế thừa, do vậy một subclass c&oacute; thể thừa hưởng từ một superclass duy nhất; đ&oacute; l&agrave; l&iacute; do v&igrave; sao trait xuất hiện.</p>\r\n<p>\r\n	C&aacute;ch d&ugrave;ng tối ưu nhất của&nbsp;traits&nbsp;được thể hiện khi nhiều class d&ugrave;ng chung một nh&oacute;m chức năng. V&iacute; dụ, h&igrave;nh ảnh ch&uacute;ng ta tạo ra tr&ecirc;n c&aacute;c website v&agrave; cần sử dụng cả API của Facebook lẫn Twitter. Ch&uacute;ng ta sẽ tạo 2 class v&agrave; c&oacute; một cURL bao gồm chức năng/phương thức. Thay v&igrave; thường sử dụng phương thức thực hiện copy &amp; paste ở 2 class, ch&uacute;ng ta sẽ sử dụng Trait (copy &amp; paste, c&aacute;ch tr&igrave;nh bi&ecirc;n dịch). Theo c&aacute;ch n&agrave;y, ch&uacute;ng ta sẽ tận dụng code v&agrave; l&agrave;m theo đ&uacute;ng quy tắc DRY (Don&rsquo;t Repeat Yourself).</p>\r\n<p>\r\n	Dưới đ&acirc;y l&agrave; v&iacute; dụ:</p>\r\n<blockquote>\r\n	<p>\r\n		/** cURL wrapper trait */</p>\r\n	<p>\r\n		trait cURL</p>\r\n	<p>\r\n		{</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;public function curl($url)</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;{</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ch = curl_init();</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch, CURLOPT_URL, $url);</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$output = curl_exec($ch);</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;curl_close($ch);</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return $output;</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;}</p>\r\n	<p>\r\n		}</p>\r\n	<p>\r\n		/** Twitter API Class */</p>\r\n	<p>\r\n		class Twitter_API</p>\r\n	<p>\r\n		{</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;use cURL; // use trait here</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;public function get($url)</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;{</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return json_decode($this-&gt;curl(&#39;<a href=\"http://api.twitter.com/\">http://api.twitter.com/</a>&#39;.$url));</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;}</p>\r\n	<p>\r\n		}</p>\r\n	<p>\r\n		/** Facebook API Class */</p>\r\n	<p>\r\n		class Facebook_API</p>\r\n	<p>\r\n		{</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;use cURL; // and here</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;public function get($url)</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;{</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return json_decode($this-&gt;curl(&#39;<a href=\"http://graph.facebook.com/\">http://graph.facebook.com/</a>&#39;.$url));</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;}</p>\r\n	<p>\r\n		}</p>\r\n	<p>\r\n		$facebook = new Facebook_API();</p>\r\n	<p>\r\n		echo $facebook-&gt;get(&#39;500058753&#39;)-&gt;name; // Rasmus Lerdorf</p>\r\n	<p>\r\n		/** Now demonstrating the awesomeness of PHP 5.4 syntax */</p>\r\n	<p>\r\n		echo (new Facebook_API)-&gt;get(&#39;500058753&#39;)-&gt;name; // Rasmus Lerdorf</p>\r\n	<p>\r\n		$foo = &#39;get&#39;;</p>\r\n	<p>\r\n		echo (new Facebook_API)-&gt;$foo(&#39;500058753&#39;)-&gt;name; // and again, Rasmus Lerdorf</p>\r\n	<p>\r\n		echo (new Twitter_API)-&gt;get(&#39;1/users/show.json?screen_name=rasmus&#39;)-&gt;name;</p>\r\n	<p>\r\n		// and yet again, Rasmus Lerdorf</p>\r\n	<p>\r\n		// P.S. I&#39;m not obsessed with Rasmus :)</p>\r\n</blockquote>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Bạn vẫn chưa hiểu? V&iacute; dụ n&agrave;y sẽ đơn giản v&agrave; dễ hiểu hơn!</p>\r\n<blockquote>\r\n	<p>\r\n		trait Net</p>\r\n</blockquote>\r\n<blockquote>\r\n	<p>\r\n		{</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;public function net()</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;{</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return &#39;Net&#39;;</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;}</p>\r\n	<p>\r\n		}</p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		trait Tuts</p>\r\n	<p>\r\n		{</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;public function tuts()</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;{</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return &#39;Tuts&#39;;</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;}</p>\r\n	<p>\r\n		}</p>\r\n	<p>\r\n		class NetTuts</p>\r\n	<p>\r\n		{</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;use Net, Tuts;</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;public function plus()</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;{</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return &#39;+&#39;;</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;}</p>\r\n	<p>\r\n		}</p>\r\n	<p>\r\n		$o = new NetTuts;</p>\r\n	<p>\r\n		echo $o-&gt;net(), $o-&gt;tuts(), $o-&gt;plus();</p>\r\n	<p>\r\n		echo (new NetTuts)-&gt;net(), (new NetTuts)-&gt;tuts(), (new NetTuts)-&gt;plus();</p>\r\n</blockquote>\r\n<blockquote>\r\n	<p>\r\n		Gợi &yacute; : Hằng số bất biến của c&aacute;c trait l&agrave; __TRAIT__.</p>\r\n</blockquote>\r\n<p>\r\n	Nh&uacute;ng sẵn webserver CLI</p>\r\n<p>\r\n	Trong ph&aacute;t triển web, người bạn th&acirc;n thiết của PHP l&agrave; Apache HTTPD Server. D&ugrave; đ&ocirc;i l&uacute;c n&oacute; c&oacute; thể bị hủy để c&agrave;i đặt httpd.conf cho việc sử dụng trong m&ocirc;i trường ph&aacute;t triển, khi bạn thật sự cần web server nhỏ m&agrave; c&oacute; thể khởi động n&oacute; chỉ bằng một d&ograve;ng lệnh đơn giản. May mắn thay, PHP 5.4 ra đời c&ugrave;ng với việc nh&uacute;ng sẵn webserver CLI.</p>\r\n<p>\r\n	Web server CLI PHP được thiết kế d&agrave;nh cho c&aacute;c mục đ&iacute;ch ph&aacute;t triển v&agrave; kh&ocirc;ng n&ecirc;n d&ugrave;ng để chạy c&aacute;c hệ thống đ&atilde; ho&agrave;n thiện.</p>\r\n<p>\r\n	Ch&uacute; &yacute;&nbsp;: Hướng dẫn dưới d&acirc;y d&agrave;nh cho Window</p>\r\n<p>\r\n	Bước 1 &ndash; Tạo thư mục gốc Document, File Router v&agrave; File Index</p>\r\n<p>\r\n	V&agrave;o thư mục ổ cứng ch&iacute;nh (thường l&agrave; C:\\). Tạo một đường dẫn/thư mục, c&oacute; t&ecirc;n gọi l&agrave;&nbsp;public_html. Tạo một file mới trong thư mục c&oacute; t&ecirc;n gọi l&agrave;&nbsp;router.php. Copy nội dung dưới đ&acirc;y v&agrave; paste n&oacute; v&agrave;o trong file vừa tạo mới.</p>\r\n<blockquote>\r\n	<p>\r\n		// router.php</p>\r\n	<p>\r\n		if (preg_match(&#39;#\\.php$#&#39;, $_SERVER[&#39;REQUEST_URI&#39;]))</p>\r\n</blockquote>\r\n<blockquote>\r\n	<p>\r\n		{</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;require basename($_SERVER[&#39;REQUEST_URI&#39;]); // serve php file</p>\r\n	<p>\r\n		}</p>\r\n	<p>\r\n		else if (strpos($_SERVER[&#39;REQUEST_URI&#39;], &#39;.&#39;) !== false)</p>\r\n	<p>\r\n		{</p>\r\n	<p>\r\n		&nbsp;&nbsp;&nbsp;&nbsp;return false; // serve file as-is</p>\r\n	<p>\r\n		}</p>\r\n	<p>\r\n		?&gt;</p>\r\n</blockquote>\r\n<p>\r\n	B&acirc;y giờ, tạo một file kh&aacute;c, gọi l&agrave;&nbsp;index.php. Copy nội dung ở dưới v&agrave; lưu file.</p>\r\n<blockquote>\r\n	<p>\r\n		// index.php</p>\r\n	<p>\r\n		echo &#39;Hello Nettuts+ Readers!&#39;;</p>\r\n	<p>\r\n		?&gt;</p>\r\n</blockquote>\r\n<p>\r\n	Mở file php.ini (n&oacute; nằm trong đường dẫn c&agrave;i đặt PHP &ndash;v&iacute; dụ: C:\\php).</p>\r\n<p>\r\n	T&igrave;m phần c&agrave;i đặt&nbsp;include_path&nbsp;(n&oacute; nằm ở v&agrave;o khoảng d&ograve;ng thứ 708). Th&ecirc;m&nbsp;C:\\public_html&nbsp;v&agrave;o cuối chuỗi giữa c&aacute;c dấu nh&aacute;y, c&aacute;ch nhau bởi dấu phẩy. Kết quả cuối c&ugrave;ng sẽ giống như vậy:</p>\r\n<p>\r\n	include_path = &quot;.;C:\\php\\PEAR;C:\\public_html&quot;</p>\r\n<p>\r\n	Lưu v&agrave; đ&oacute;ng file. Chuyển qua bước tiếp theo.</p>\r\n<p>\r\n	Bước 2 &ndash; Chạy web server</p>\r\n<p>\r\n	Mở bảng g&otilde; lệnh (Windows + R, g&otilde; v&agrave;o CMD v&agrave; nhấn Enter); t&ugrave;y thuộc v&agrave;o phi&ecirc;n bản Windows, bạn sẽ thấy d&ograve;ng như dưới đ&acirc;y,</p>\r\n<blockquote>\r\n	<p>\r\n		Microsoft Windows XP [Version 5.1.2600]</p>\r\n	<p>\r\n		(C) Copyright 1985-2001 Microsoft Corp.</p>\r\n	<p>\r\n		C:\\Documents and Settings\\nettuts&gt;</p>\r\n</blockquote>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Thay đổi đường dẫn hiện tại đến c&agrave;i đặt PHP theo v&iacute; dụ sau:</p>\r\n<blockquote>\r\n	<p>\r\n		C:\\Documents and Settings\\nettuts&gt;cd C:\\php</p>\r\n	<p>\r\n		C:\\php&gt;</p>\r\n</blockquote>\r\n<p>\r\n	Phần quan trọng nhất- chạy web-server. Copy đoạn dưới&hellip;</p>\r\n<blockquote>\r\n	<p>\r\n		php -S 0.0.0.0:8080 -t C:\\public_html router.php</p>\r\n</blockquote>\r\n<p>\r\n	&hellip;v&agrave; d&aacute;n n&oacute; v&agrave;o d&ograve;ng lệnh ( click chuột phải, chọn Paste để paste). Nhấn Enter. Nếu n&oacute; hoạt động, bạn sẽ thấy c&aacute;c d&ograve;ng giống như ở dưới. Đừng đ&oacute;ng bảng g&otilde; lệnh, nếu bạn l&agrave;m vậy,&nbsp; bạn sẽ tho&aacute;t khỏi web-server.</p>\r\n<p>\r\n	<img alt=\"\" src=\"http://toancauxanh.vn/sites/default/files/579572_400250789999670_359033514121398_1341866_81751371_n.jpg\" /></p>\r\n<blockquote>\r\n	<p>\r\n		C:\\php&gt;php -S 0.0.0.0:8080 -t C:\\public_html router.php</p>\r\n	<p>\r\n		PHP 5.4.0 Development Server started at Fri Mar 02 09:36:40 2012</p>\r\n	<p>\r\n		Listening on 0.0.0.0:8080</p>\r\n	<p>\r\n		Document root is C:\\public_html</p>\r\n	<p>\r\n		Press Ctrl-C to quit.</p>\r\n</blockquote>\r\n<p>\r\n	Mở tr&ecirc;n tr&igrave;nh duyệt của bạn địa chỉ&nbsp;<a href=\"http://localhost:8080/index.php\">http://localhost:8080/index.php</a>&nbsp;v&agrave; bạn sẽ thấy:</p>\r\n<blockquote>\r\n	<p>\r\n		Hello Nettuts+ Readers!</p>\r\n</blockquote>\r\n<p>\r\n	Mẹo 1:&nbsp;Tạo một file&nbsp;php-server&nbsp;với nội dung sau:&nbsp;C:\\php\\php -S 0.0.0.0:8080 -t C:\\public_html router.php. Click đ&ocirc;i v&agrave; b&acirc;y giờ, m&aacute;y chủ đ&atilde; được tải l&ecirc;n v&agrave; hoạt động.</p>\r\n<p>\r\n	Mẹo 2:&nbsp;D&ugrave;ng&nbsp;0.0.0.0&nbsp;thay cho&nbsp;localhost&nbsp;nếu như bạn đo&aacute;n trước được m&aacute;y chủ của bạn sẽ truy cập từ Internet.</p>\r\n<p>\r\n	C&uacute; ph&aacute;p Array r&uacute;t gọn</p>\r\n<p>\r\n	PHP 5.4 đưa ra một c&uacute; ph&aacute;p&nbsp;array&nbsp;mới ngắn hơn</p>\r\n<blockquote>\r\n	<p>\r\n		&nbsp;</p>\r\n</blockquote>\r\n', '1', '2012-07-29 09:56:41', '2012-07-29 11:13:26');
INSERT INTO `tbl_news_items` VALUES ('13', 'Điều hướng người dùng trong thiết kế website', null, 'Sẽ thế nào nếu có một anh chàng chạy đến bạn và thét lên “Tôi đã thiết kế một website rất tuyệt vời, nhưng tại sao mọi người lại không vào truy cập, tại sao vậy?” Bạn sẽ phản ứng thế nào trong tình huống đó, liệu bạn có hỏi anh ta là đã sử dụng phép thử A/B chưa hay bạn sẽ khuyên anh ta nên kiểm tra lại tính khả dụng của website đó?\r\n\r\n(A/B testing hay còn gọi là phép thử A/B, đây là phương pháp thử dùng để so sánh hoạt động của hai trang web, hoặc hai nội dung, chiến dịch khác - ND)', 'Sẽ thế nào nếu có một anh chàng chạy đến bạn và thét lên “Tôi đã thiết kế một website rất tuyệt vời, nhưng tại sao mọi người lại không vào truy cập, tại sao vậy?” Bạn sẽ phản ứng thế nào trong tình huống đó, liệu bạn có hỏi anh ta là đã sử dụng phép thử A/B chưa hay bạn sẽ khuyên anh ta nên kiểm tra lại tính khả dụng của website đó?\r\n\r\n(A/B testing hay còn gọi là phép thử A/B, đây là phương pháp thử dùng để so sánh hoạt động của hai trang web, hoặc hai nội dung, chiến dịch khác - ND)', '1', '2012-07-29 10:41:07', '2012-07-29 10:48:13');
INSERT INTO `tbl_news_items` VALUES ('14', 'Vụ trồng su su Sa Pa năm nay: Được mùa, được giá', '13514107501190.jpg', 'Với giá bình quân khoảng từ 4.000đ/kg quả su su thịt và 12.000đ/kg quả su su giống, vụ su su năm nay ở Sa Pa (Lào Cai), người trồng \"trúng\" cả về sản lượng và giá cả, bình quân mỗi ha thu về từ 80 đến 100 triệu đồng.', '<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Với gi&aacute; b&igrave;nh qu&acirc;n khoảng từ 4.000đ/kg quả su su thịt v&agrave; 12.000đ/kg quả su su giống, vụ su su năm nay ở Sa Pa (L&agrave;o Cai), người trồng &quot;tr&uacute;ng&quot; cả về sản lượng v&agrave; gi&aacute; cả, b&igrave;nh qu&acirc;n mỗi ha thu về từ 80 đến 100 triệu đồng.</p>\r\n<p style=\"text-align: center; \">\r\n	<img alt=\"\" height=\"225\" src=\"http://www.vietnamplus.vn/avatar.aspx?ID=168358&amp;at=0&amp;ts=300&amp;lm=634865006322500000\" width=\"300\" /></p>\r\n<p>\r\n	Theo Ph&ograve;ng Kinh tế huyện Sa Pa, to&agrave;n huyện trồng khoảng 90 ha su su. Do chăm s&oacute;c tốt v&agrave; điều kiện thời tiết thuận lợi n&ecirc;n su su sai quả, chất lượng quả to đều, tươi ngon, được kh&aacute;ch h&agrave;ng ưa chuộng.</p>\r\n<p>\r\n	Đầu vụ, gi&aacute; su su quả l&ecirc;n tới 5.000đ/kg v&agrave; su su giống l&agrave; 8.000đ/kg, c&oacute; thời điểm l&ecirc;n tới 18.000đ/kg, trung b&igrave;nh l&agrave; 12.000đ/kg.</p>\r\n<p>\r\n	B&agrave; Trần Thị Dung người trồng su su l&acirc;u năm ở khu vực &Ocirc; Qu&yacute; Hồ (Sa Pa) cho biết, hiện nay, su su đang v&agrave;o m&ugrave;a thu hoạch. Chưa năm n&agrave;o su su Sa Pa lại được m&ugrave;a, được gi&aacute; như năm nay. Gia đ&igrave;nh b&agrave; trồng 1,5ha mới được 2/3 thời gian thu hoạch m&agrave; đ&atilde; b&aacute;n được 35 tấn quả, thu về gần 140 triệu đồng. Từ nay đến hết vụ ( cuối th&aacute;ng 11) gia đ&igrave;nh b&agrave; c&oacute; thể thu th&ecirc;m gần 10 tấn su su nữa.</p>\r\n<p>\r\n	Sa Pa từ l&acirc;u đ&atilde; nổi tiếng với sản phẩm su su, một loại rau kh&ocirc;ng sử dụng thuốc bảo vệ thực vật. Tuy nhi&ecirc;n, do sự cạnh tranh của c&aacute;c loại rau quả nhập ngoại, nhận thức của người ti&ecirc;u d&ugrave;ng chưa đầy đủ n&ecirc;n c&oacute; năm ti&ecirc;u thụ chưa được tốt.&nbsp;</p>\r\n<p>\r\n	Su su Sa Pa trồng tập trung ở khu vực &Ocirc; Qu&yacute; Hồ, bao gồm c&aacute;c tổ d&acirc;n phố 12, 13 v&agrave; 14 thị trấn Sa Pa. Tại c&aacute;c điểm tập kết dọc quốc lộ 4E Lai Ch&acirc;u đi L&agrave;o Cai - H&agrave; Nội, su su được c&acirc;n, đ&oacute;ng t&uacute;i cẩn thận, xếp th&agrave;nh h&agrave;ng ven đường để chờ xe chở đi ti&ecirc;u thụ ở nhiều tỉnh, th&agrave;nh phố trong cả nước.&nbsp;</p>\r\n<p>\r\n	Su su Sa Pa năm nay được gi&aacute; c&oacute; phần đ&oacute;ng g&oacute;p kh&ocirc;ng nhỏ của hợp t&aacute;c x&atilde; Hoa Đ&agrave;o, đơn vị đ&atilde; x&acirc;y dựng được thương hiệu &ldquo;Su su sạch &Ocirc; Qu&yacute; Hồ&rdquo;.</p>\r\n<p>\r\n	Đ&acirc;y được coi như tấm thẻ bảo h&agrave;nh đưa sản phẩm vươn ra thị trường trong v&agrave; ngo&agrave;i nước.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Hợp t&aacute;c x&atilde; Hoa Đ&agrave;o hiện c&oacute; 30 x&atilde; vi&ecirc;n sản xuất su su v&agrave; hoa hồng, sản phẩm do c&aacute;c hộ x&atilde; vi&ecirc;n sản xuất ra được hợp t&aacute;c x&atilde; bao ti&ecirc;u to&agrave;n bộ. Trung b&igrave;nh mỗi ng&agrave;y, hợp t&aacute;c x&atilde; Hoa Đ&agrave;o thu mua xấp xỉ 20 tấn su su c&aacute;c loại của c&aacute;c hộ x&atilde; vi&ecirc;n.</p>\r\n<p>\r\n	Ngo&agrave;i su su, Sa Pa c&ograve;n ph&aacute;t triển mạnh v&ugrave;ng rau chuy&ecirc;n canh. Năm 2012, được sự hỗ trợ từ dự &aacute;n sản xuất rau chuy&ecirc;n canh an to&agrave;n v&ugrave;ng cao của tỉnh, huyện Sa Pa đ&atilde; chuyển đổi 22 ha đất l&uacute;a k&eacute;m hiệu quả sang trồng rau chuy&ecirc;n canh 3 vụ tại 4 x&atilde; gồm Sa Pả, Tả Ph&igrave;n, Bản Khoang, Trung Chải v&agrave; thị trấn Sa Pa.&nbsp;</p>\r\n<p>\r\n	Theo đ&aacute;nh gi&aacute; của Ph&ograve;ng Kinh tế huyện Sa Pa, dự &aacute;n triển khai tại địa phương cho hiệu quả r&otilde; n&eacute;t, cụ thể một ha rau bắp cải trồng một vụ trung b&igrave;nh đạt 20 tấn, với nguồn thu khoảng 100 triệu đồng, trừ chi ph&iacute; người trồng rau c&oacute; l&atilde;i 50 - 60 triệu đồng.</p>\r\n<p>\r\n	Trong thời gian tới, Sa Pa tiếp tục quy hoạch v&ugrave;ng rau chuy&ecirc;n canh v&agrave; rau su su. Trong đ&oacute; rau chuy&ecirc;n canh khoảng 85 ha, su su khoảng 100ha nhằm khai th&aacute;c lợi thế đất đai v&agrave; kh&iacute; hậu v&ugrave;ng &ocirc;n đới./.</p>', '1', '2012-10-28 08:52:30', '2012-10-28 08:52:30');
INSERT INTO `tbl_news_items` VALUES ('15', 'zfbdfbdbzdf', null, 'sgdf', '<p>\r\n	zdbdfbbz</p>\r\n', '1', '2012-10-28 09:47:04', '2012-10-28 09:47:04');

-- ----------------------------
-- Table structure for `tbl_product_categories`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_categories`;
CREATE TABLE `tbl_product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text,
  `is_active` tinyint(1) DEFAULT '1',
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `root` varchar(16) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_product_categories
-- ----------------------------
INSERT INTO `tbl_product_categories` VALUES ('1', 'Root', null, null, '1', '1', '16', null, '1', null, null, null);
INSERT INTO `tbl_product_categories` VALUES ('2', 'Computer', null, 'gdfgd f gdfg', '1', '2', '9', '1', '2', null, '2011-11-05 02:52:43', '2011-11-05 02:52:43');
INSERT INTO `tbl_product_categories` VALUES ('3', 'Keyboard', null, 'dfgdf', '1', '3', '4', '2', '3', null, '2011-11-05 02:57:50', '2011-11-05 02:57:50');
INSERT INTO `tbl_product_categories` VALUES ('4', 'Mouse', '13204586023673.jpg', '', '1', '5', '8', '2', '3', null, '2011-11-05 02:58:15', '2011-11-05 03:03:23');
INSERT INTO `tbl_product_categories` VALUES ('5', 'Acer', '13204586392390.jpg', '', '1', '6', '7', '2', '4', null, '2011-11-05 03:04:00', '2012-07-23 18:02:06');
INSERT INTO `tbl_product_categories` VALUES ('6', 'Thuc Pham Sach', null, '', '1', '10', '15', '1', '2', null, '2012-07-23 18:02:22', '2012-07-23 18:02:22');
INSERT INTO `tbl_product_categories` VALUES ('7', 'Rau An Toàn', null, '', '1', '11', '12', '6', '3', null, '2012-07-25 14:37:53', '2012-07-25 14:37:53');
INSERT INTO `tbl_product_categories` VALUES ('8', 'Thực Phẩm An Toàn', null, '', '1', '13', '14', '6', '3', null, '2012-07-25 14:38:14', '2012-07-25 14:38:39');

-- ----------------------------
-- Table structure for `tbl_product_category_item`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_category_item`;
CREATE TABLE `tbl_product_category_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_item_id` (`item_id`),
  KEY `fk_category_id` (`category_id`),
  CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `tbl_product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_item_id` FOREIGN KEY (`item_id`) REFERENCES `tbl_product_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_product_category_item
-- ----------------------------
INSERT INTO `tbl_product_category_item` VALUES ('14', '7', '5');
INSERT INTO `tbl_product_category_item` VALUES ('16', '7', '7');
INSERT INTO `tbl_product_category_item` VALUES ('17', '7', '8');
INSERT INTO `tbl_product_category_item` VALUES ('18', '7', '9');
INSERT INTO `tbl_product_category_item` VALUES ('24', '7', '2');
INSERT INTO `tbl_product_category_item` VALUES ('26', '7', '6');

-- ----------------------------
-- Table structure for `tbl_product_items`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_items`;
CREATE TABLE `tbl_product_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `short_description` text,
  `description` text,
  `status` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_product_items
-- ----------------------------
INSERT INTO `tbl_product_items` VALUES ('2', 'Cải Thìa', '13434931281205.jpg', '14000', null, 'Sản xuất tại Hưng Nguyên', 'Cải thìa được sản xuất ở vùng rau an toàn Hưng Nguyên với sự giám sát kỹ thuật chặt chẽ của DNTN Phú Tứ với tiêu chuẩn không hóa chất bảo vệ thực vật.', '1', '2012-07-25 16:27:30', '2012-07-28 18:32:08');
INSERT INTO `tbl_product_items` VALUES ('3', 'Rau Muống', '1343226700394.jpg', '8000', null, 'Sản xuất tại thành phố vinh', 'Cải thìa được sản xuất ở vùng rau an toàn của thành phố vinh với sự giám sát kỹ thuật chặt chẽ của DNTN Phú Tứ với tiêu chuẩn không hóa chất bảo vệ thực vật.', '1', '2012-07-25 16:31:40', '2012-07-25 16:31:40');
INSERT INTO `tbl_product_items` VALUES ('5', 'Mướp Đắng', '1343227123405.jpg', '9000', null, 'Sản xuất tại vùng rau an toàn Quỳnh Lương', 'Sản xuất tại vùng rau an toàn Quỳnh Lương - Quỳnh Lưu - Nghệ An - Dưới sự giám sát chặt chẽ của DNTN Phú Tứ với tiêu chí \"Nói không với hóa chất bảo vệ thực vật\"', '1', '2012-07-25 16:38:43', '2012-07-25 16:38:43');
INSERT INTO `tbl_product_items` VALUES ('6', 'Giá Đỗ', '13432278331057.jpg', '17000', 'kg', 'Sản xuất tại chỗ với công thức cổ truyền', 'Sản xuất tại chỗ với công thức cổ truyền của dân tộc. Sử dụng nguyên liệu đậu xanh lòng nổi tiếng của vùng đất thanh chương và nguồn nước ngầm tinh khiết, giá đỗ của công ty đảm bảo chất lượng cao nhất.', '1', '2012-07-25 16:42:53', '2012-07-29 12:19:40');
INSERT INTO `tbl_product_items` VALUES ('7', 'Cẩn Tây', '13432275662981.jpg', '12000', null, 'Sản xuất tại vùng rau an toàn Quỳnh Lương', 'Sản xuất tại vùng rau an toàn Quỳnh Lương - Quỳnh Lưu - Nghệ An dưới sự giám sát chặt chẽ của DNTN Phú với tiêu chí \"Nói không với chất hóa học bảo vệ thực vật\"', '1', '2012-07-25 16:46:06', '2012-07-25 16:46:06');
INSERT INTO `tbl_product_items` VALUES ('8', 'Cải Ngọt', '13432277582770.jpg', '9000', null, 'Sản xuất tại vùng rau an toàn Quỳnh Lương', 'Sản xuất tại vùng rau an toàn Quỳnh Lương - Quỳnh Lưu - Nghệ An dưới sự giám sát chặt chẽ của DNTN Phú với tiêu chí \"Nói không với chất hóa học bảo vệ thực vật\"', '1', '2012-07-25 16:49:18', '2012-07-25 16:49:18');
INSERT INTO `tbl_product_items` VALUES ('9', 'Cải Bẹ', '13432278121364.jpg', '7000', null, 'Sản xuất tại vùng rau an toàn Quỳnh Lương', 'Sản xuất tại vùng rau an toàn Quỳnh Lương - Quỳnh Lưu - Nghệ An dưới sự giám sát chặt chẽ của DNTN Phú với tiêu chí \"Nói không với chất hóa học bảo vệ thực vật\"', '1', '2012-07-25 16:50:12', '2012-07-25 16:50:12');
INSERT INTO `tbl_product_items` VALUES ('10', 'Cà Chua', '13434931692914.jpg', '15000', null, 'Sản xuất tại vùng rau an toàn Quỳnh Lương', 'Sản xuất tại vùng rau an toàn Quỳnh Lương - Quỳnh Lưu - Nghệ An dưới sự giám sát chặt chẽ của DNTN Phú với tiêu chí \"Nói không với chất hóa học bảo vệ thực vật\"', '1', '2012-07-25 16:57:33', '2012-07-28 18:32:50');
INSERT INTO `tbl_product_items` VALUES ('11', 'Cải Thảo', '13432283473397.jpg', '12000', null, 'Sản xuất tại vùng rau an toàn Quỳnh Lương', 'Sản xuất tại vùng rau an toàn Quỳnh Lương - Quỳnh Lưu - Nghệ An dưới sự giám sát chặt chẽ của DNTN Phú với tiêu chí \"Nói không với chất hóa học bảo vệ thực vật\"', '1', '2012-07-25 16:59:07', '2012-07-25 16:59:07');
INSERT INTO `tbl_product_items` VALUES ('12', 'Củ cải', '13514061602510.jpg', '123445', 'KG', 'dfgd fgdf gdfg dfg dfgdfg dfgdfg', 'df gdfgd fgfdgdfg dfg dfg dfg dfgdf \r\ngdf gdfgdfgdfg dlfgdfgdfg df gldlfg ldlfgl dlfgl dlfl gldlf gldfgl dlflg dlfgl dlf lgdf dfg dllllllllllllllllll', '1', '2012-10-28 07:36:00', '2012-10-28 09:12:09');

-- ----------------------------
-- Table structure for `tbl_profiles`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_profiles`;
CREATE TABLE `tbl_profiles` (
  `user_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_profiles
-- ----------------------------
INSERT INTO `tbl_profiles` VALUES ('1', 'Admin', 'Administrator', '0000-00-00');
INSERT INTO `tbl_profiles` VALUES ('2', 'Demo', 'Demo', '0000-00-00');

-- ----------------------------
-- Table structure for `tbl_profiles_fields`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_profiles_fields`;
CREATE TABLE `tbl_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_profiles_fields
-- ----------------------------
INSERT INTO `tbl_profiles_fields` VALUES ('1', 'lastname', 'Last Name', 'VARCHAR', '50', '3', '1', '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', '1', '3');
INSERT INTO `tbl_profiles_fields` VALUES ('2', 'firstname', 'First Name', 'VARCHAR', '50', '3', '1', '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', '0', '3');
INSERT INTO `tbl_profiles_fields` VALUES ('3', 'birthday', 'Birthday', 'DATE', '0', '0', '2', '', '', '', '', '0000-00-00', 'UWjuidate', '{\"ui-theme\":\"redmond\"}', '3', '2');

-- ----------------------------
-- Table structure for `tbl_users`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `saltkey` varchar(16) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES ('1', 'admin', 'c1fcc27b17ec025bcbc0e287e98a236d26610368', 'webmaster@example.com', '1261146094', '1351405985', '1', '1', '1234567891230', 'ad1a172d73432cffb3f506885646390b');
INSERT INTO `tbl_users` VALUES ('2', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', '1261146096', '0', '0', '1', '', '099f825543f7850cc038b90aaff39fac');
INSERT INTO `tbl_users` VALUES ('4', 'test', '4a93bb8f2a5d77c70f358cbe07e4e6b739043567', 'huyt2bt@webdev.vn', '1320389872', '1320396537', '0', '0', '4eb38cf04b5cb', '');
INSERT INTO `tbl_users` VALUES ('9', 'huytbt', 'ce46dcc0ceb76fcf18bc8edcbb5bd748af0890d2', 'huytbt@webdev.vn', '1320390511', '1320456076', '1', '1', '4eb3ad45f3e47', '9ea927ef933c468bc81280f554bd557f2bc83de0');
