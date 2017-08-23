-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2016 at 03:25 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `megafuse`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(11) NOT NULL,
  `admin` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin`, `pass`) VALUES
(1, 'megafuse', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
`id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `question` text NOT NULL,
  `ans` text NOT NULL,
  `correct` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `countdown`
--

CREATE TABLE IF NOT EXISTS `countdown` (
`id` int(11) NOT NULL,
  `loginkey` varchar(100) NOT NULL,
  `countdown` varchar(50) NOT NULL,
  `date` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countdown`
--

INSERT INTO `countdown` (`id`, `loginkey`, `countdown`, `date`) VALUES
(62, '12/69/0191', '00:29:18', '13-03-16 22:31');

-- --------------------------------------------------------

--
-- Table structure for table `exam_addsubject`
--

CREATE TABLE IF NOT EXISTS `exam_addsubject` (
`id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `date_created` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_addsubject`
--

INSERT INTO `exam_addsubject` (`id`, `subject`, `date_created`) VALUES
(2, ' ENGLISH', 'June,04 2015'),
(3, 'com 111', 'June,04 2015'),
(4, 'COBOL', 'June,04 2015'),
(6, 'ruby', 'June,04 2015'),
(7, 'python', 'June,04 2015'),
(8, 'php', 'June,04 2015'),
(9, 'javascript', 'June,04 2015'),
(10, 'angular', 'June,04 2015'),
(11, 'node.js', 'June,04 2015'),
(12, 'java', 'June,04 2015'),
(13, 'c/c++', 'June,04 2015'),
(14, 'english language', 'June,12 2015'),
(15, '', 'June,15 2015'),
(16, 'BIOLOGY', 'June,30 2015'),
(17, 'GEOGRAPHY', 'June,30 2015'),
(18, 'HISTORY', 'June,30 2015'),
(19, 'FURTHER MATHS', 'June,30 2015'),
(20, 'CHEMISTRY', 'June,30 2015'),
(21, 'PHYSICS', 'June,30 2015'),
(22, 'YORUBA', 'June,30 2015'),
(23, 'FINE ART', 'June,30 2015'),
(24, 'intro to computing', 'July,07 2015'),
(25, 'web technology', 'August,09 2015');

-- --------------------------------------------------------

--
-- Table structure for table `practisetime`
--

CREATE TABLE IF NOT EXISTS `practisetime` (
`id` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  `minute` int(11) NOT NULL,
  `second` int(11) NOT NULL,
  `datetime` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `practisetime`
--

INSERT INTO `practisetime` (`id`, `hour`, `minute`, `second`, `datetime`) VALUES
(1, 0, 30, 0, '17-08-15 0');

-- --------------------------------------------------------

--
-- Table structure for table `qtn_limit`
--

CREATE TABLE IF NOT EXISTS `qtn_limit` (
`id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `qtn` int(11) NOT NULL,
  `max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
`id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `question` text NOT NULL,
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `date_registered` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `subject`, `answer`, `question`, `A`, `B`, `C`, `D`, `date_registered`) VALUES
(1, 'com_111', 'A', 'what is computer hardware', 'computer hardware are component which support the usage of software and human ware', 'computer hardware are human ware', 'computer hardware are supportive', 'all of the above', 'June,04 2015'),
(2, 'ruby', 'B', ' what is ruby ?', 'ruby is a compiled programming language', 'ruby is an interpreted language which can be used for various operation', 'ruby is a japanese language', 'ruby is a parent language', 'June,04 2015'),
(3, 'ruby', 'D', ' how do we declare variable in ruby', '$a = \\&amp;quot;michael\\&amp;quot;', 'String a = \\&amp;quot;michael\\&amp;quot;', 'var a = \\&amp;quot;michael\\&amp;quot;', 'a = \\&amp;quot;michael', 'June,04 2015'),
(4, 'ruby', 'A', ' simple array in ruby is', ' a = [''name'',''sex'', ''age'']', 'a = {'':name'' => ''michael'', '':age''=>19}', 'a = "michael''', 'none of the above', 'June,04 2015'),
(5, 'ruby', 'A', 'how to declare function in ruby is ', 'def fun()\r\n   put \\&quot;hello world\\&quot;\r\nend', 'def fun()\r\n   put \\&quot;hello world\\&quot;', 'class fun()\r\n    put \\&quot;hello world\\&quot;', 'function fun() {\r\n    echo \\&quot;hello world\\&quot;', 'June,04 2015'),
(6, 'ruby', 'A', 'how to check if file exist is ', 'File.exist(''todo.txt'') ? true', 'file.exit(''todo.txt'') ? true', 'file_exist(''todo.txt'')', 'File_exist(''todo.txt'')', 'June,04 2015'),
(7, 'english_language', 'A', ' what is communication ?', 'communication is the means of send and receiving information', 'communication is only sending stuff', 'communication is not a good thing', 'all of the above', 'June,12 2015'),
(8, 'english_language', 'D', '  what is figures of speech', 'is define as stuff we don''t know', 'is stuff i know', 'is stuff i love ', 'all of the above', 'June,12 2015'),
(9, 'english_language', 'B', 'what is programming language', 'programming language is to chill with your idea', 'programming language is understand by computer', 'programming language is life', 'all of the above', 'June,13 2015'),
(10, 'english_language', 'A', 'who developed node.js', 'ryan darl', 'bredan eich', 'rasmus lardorf', 'matz', 'June,13 2015'),
(11, 'english_language', 'A', ' what are the characteristics of human language ?', 'innateness', 'nateness', 'unateness', 'none of the above', 'June,25 2015'),
(12, 'english_language', 'B', 'functions of language ?', 'personality', 'communication', 'a and b', 'none of the above', 'June,25 2015'),
(13, 'english_language', 'C', 'what is a noun ?', 'a noun is a word that describe itself', 'a noun is word that describe pronoun', 'a noun is a name of any person, animal, place or thing', 'a noun is saying much about an object', 'June,25 2015'),
(14, 'english_language', 'A', 'what is a verb', 'verb describe an action', 'verb describe an object', 'verb qualifies a noun', 'all of the above', 'June,25 2015'),
(15, 'english_language', 'B', 'uses of paragraph', 'paragraph is used to divide sentence', 'paragraph is used to end sentence', 'paragraph is used to start sentence', 'used for sentence continuation', 'June,25 2015'),
(16, 'english_language', 'A', 'item the plural of ''men''', 'women', 'girl', 'lady', 'all', 'June,25 2015'),
(17, 'english_language', 'A', ' identify the plural of ''man''', 'woman', 'women', 'men', 'guy', 'June,25 2015'),
(18, 'ruby', 'C', 'what is the differences between rails and ruby', 'rails is a programming language built for ruby', 'rails is a system module while ruby is a scripting language', 'rails is a web development framework or gems built on ruby while ruby is a scripting language', 'all of the above', 'June,30 2015'),
(19, 'java', 'C', 'how do we display hello ', 'System.out.println(&quot;Hello world&quot;)', 'print &quot;Hello world&quot;\r\n', 'System.out.println(&quot;Hello world&quot;);', 'puts &quot;Hello world&quot;\r\n', 'June,30 2015'),
(20, 'intro_to_computing', 'A', 'A typical data processing contains of ________, _______ &amp; ___________', 'Data, processor &amp; information', 'Data, system &amp; instruction', 'Instruction, processor &amp; data', 'Information, data &amp; instruction', 'July,07 2015'),
(21, 'intro_to_computing', 'D', 'These include the merit of a computer except?', 'Speed', 'Accuracy', 'Reliability', 'Unreliable', 'July,07 2015'),
(22, 'intro_to_computing', 'A', 'The first Generation of computer uses___________', 'Vacuum tube', 'Transistor', 'Integrated circuit', 'Microprocessor', 'July,07 2015'),
(23, 'intro_to_computing', 'C', 'The third Generation of computer uses ___________', 'Transistor ', 'Integrated circuit', 'Artificial intelligence', 'Microprocessor', 'July,07 2015'),
(24, 'intro_to_computing', 'A', 'IBM Means what?', 'International Business machine', 'Integrated Business machine', 'Implemented Business machine', 'International base machine', 'July,07 2015'),
(25, 'intro_to_computing', 'C', 'POST means what?', 'Power on self-tech', 'Portable oriented system technology', 'Power on self-test', 'Programmable oriented system technology', 'July,07 2015'),
(26, 'intro_to_computing', 'C', 'These are examples of hardware except', 'RAM', 'Monitor', 'Word 2013', 'HDD', 'July,07 2015'),
(27, 'intro_to_computing', 'C', 'Data are transfer through ____________', 'RAM', 'Cache', 'Buses', 'ROM', 'July,07 2015'),
(28, 'intro_to_computing', 'B', 'OMR Means _________________', 'Optical mark radiation', 'Optical mark reader', 'Optical mark resolution', 'Optional mark resolution', 'July,07 2015'),
(29, 'intro_to_computing', 'B', 'These are example of output device except', 'Monitor', 'Keyboard', 'Printer', 'Speakers', 'July,07 2015'),
(30, 'intro_to_computing', 'B', 'The three major Computer languages are _________, ___________ &amp; ___________', 'High level, low level, &amp;  intermediary languages', 'Machine, high level &amp; lower level languages', 'Hide, visible, &amp; transparent', 'Big, bigger &amp; biggest languages', 'July,07 2015'),
(31, 'intro_to_computing', 'D', 'These are types of systems except', 'Open system', 'Closed system', 'Hard &amp; Software system', 'Personal system', 'July,07 2015'),
(32, 'intro_to_computing', 'B', 'MAC Means ________________________', 'Media access porter', 'Media access point', 'Machine access point ', 'Media accessories point', 'July,07 2015'),
(33, 'intro_to_computing', 'A', 'An example of network cable is___________', 'Coaxial cables', 'Tinted cable', 'Nigerian wire', 'Pasted cable', 'July,07 2015'),
(34, 'intro_to_computing', 'B', '_________ is a type of network topology', 'Junk topology', 'Ring topology', 'List topology ', 'Space topology', 'July,07 2015'),
(35, 'intro_to_computing', 'C', 'An application use to type letter is known as__________', 'Corel draw', 'Photo paint', 'Microsoft word', 'Proxifier', 'July,07 2015'),
(36, 'intro_to_computing', 'A', '_______ is an example of software use for design', 'Corel draw', 'Microsoft excel', 'Microsoft word', 'Word pad', 'July,07 2015'),
(37, 'intro_to_computing', 'B', 'The first processes a computer goes through when turn on is known as_________', 'BIOS', 'POST', 'FTP', 'HTTP', 'July,07 2015'),
(38, 'intro_to_computing', 'D', 'The short key for copying files on a system unit is known as __________', 'Alt-f4', 'Ctrl-v', 'Fn-p', 'Ctrl-c', 'July,07 2015'),
(39, 'intro_to_computing', 'D', 'Fields in computer science include the following except', 'Networking', 'Programming', 'Web Development', 'Land Surveying', 'July,07 2015'),
(40, 'intro_to_computing', 'B', 'A set of Logical Instructions written to perform a specific task on a computer system is called_____', 'Information', 'Program', 'Instructions', 'Codes', 'July,07 2015'),
(41, 'intro_to_computing', 'B', 'Transistor is the underlying technology for __________ generation of computer', 'First Generation', 'Second Generation', 'Third Generation', 'Fourth Generation', 'July,07 2015'),
(42, 'intro_to_computing', 'B', 'A network device use for wide area network is ________', 'Hub', 'Router', 'Repeater', 'Flash Drive', 'July,07 2015'),
(43, 'intro_to_computing', 'D', 'These are types of network except', 'LAN', 'PAN', 'WAN', 'DAN', 'July,07 2015'),
(44, 'intro_to_computing', 'C', 'Pascaline was invented in the year', '1685', '1889', '1642', '1980', 'July,07 2015'),
(45, 'intro_to_computing', 'B', 'The first existing system was ', 'IBM', 'Human', 'Pascaline', 'Jacquard Loom', 'July,07 2015'),
(46, 'intro_to_computing', 'B', 'Herman Hollerith introduced the ', 'Jacquard Loom', 'Punched Card', 'Pascaline', 'IBM', 'July,07 2015'),
(47, 'intro_to_computing', 'B', 'Inter connection of 2 or more computer to share resources is known as______________', 'programming', 'Networking', 'Coding', 'Compiler', 'July,07 2015'),
(48, 'intro_to_computing', 'A', 'The 2 interface of computer system include _______&amp;__________', 'CLI &amp; GUI', 'GUI &amp; CMD', 'SAT &amp; VAT', 'CLS &amp; NIT', 'July,07 2015'),
(49, 'intro_to_computing', 'B', 'UPS stands for', 'Unshielded Protected System', 'Uninterrupted Power Supply', 'Unlock Power System', 'Universal Power Supply', 'July,07 2015'),
(50, 'intro_to_computing', 'D', 'ICT Lab Safety Rules include the following except', 'No Eating', 'No Sleeping', 'No Rough Play', 'Do not wear Lab Coat', 'July,07 2015'),
(51, 'web_technology', 'C', ' A webpage displays a picture. What tag was used to display that picture?', 'picture', 'image', 'img', ' src', 'August,09 2015'),
(52, 'web_technology', 'A', '&lt;b&gt; tag makes the enclosed text bold. What is other tag to make text bold?', '&lt;strong&gt;', ' &lt;dar&gt;', '&lt;black&gt;', '&lt;emp&gt;', 'August,09 2015'),
(53, 'web_technology', 'C', 'Tags and test that are not directly displayed on the page are written in _____ section.', '&lt;html&gt;', '&lt;head&gt;', '&lt;title&gt;', '&lt;body&gt;', 'August,09 2015'),
(54, 'web_technology', 'A', ' Which tag inserts a line horizontally on your web page?', '&lt;hr&gt;', '&lt;line&gt;', '&lt;line direction=&quot;horizontal&quot;&gt;', '&lt;tr&gt;', 'August,09 2015'),
(55, 'web_technology', 'C', '  What should be the first tag in any HTML document? ', '&lt;head&gt;', ' &lt;title&gt;', ' &lt;html&gt;', ' &lt;document&gt;', 'August,09 2015'),
(56, 'web_technology', 'C', 'Which tag allows you to add a row in a table?   ', '&lt;td&gt; and &lt;/td&gt;', '&lt;cr&gt; and &lt;/cr&gt;', '&lt;th&gt; and &lt;/th&gt;', ' &lt;tr&gt; and &lt;/tr&gt;', 'August,09 2015'),
(57, 'web_technology', 'C', ' How can you make a bulleted list?   ', ' &lt;list&gt;', '&lt;nl&gt;', '&lt;ul&gt;', '&lt;ol&gt;', 'August,09 2015'),
(58, 'web_technology', 'B', ' How can you make a numbered list?    ', '&lt;dl&gt;', '&lt;ol&gt;', '&lt;list&gt;', '&lt;ul&gt;', 'August,09 2015'),
(59, 'web_technology', 'D', ' How can you make an e-mail link?   ', '&lt;a href=&quot;xxx@yyy&quot;&gt;', '&lt;mail href=&quot;xxx@yyy&quot;&gt;', '&lt;mail&gt;xxx@yyy&lt;/mail&gt;', '&lt;a href=&quot;mailto:xxx@yyy&quot;&gt;', 'August,09 2015'),
(60, 'web_technology', 'A', '  What is the correct HTML for making a hyperlink?  ', '&lt;a href=&quot;http:// mcqsets.com&quot;&gt;ICT Trends Quiz&lt;/a&gt;', '&lt;a name=&quot;http://mcqsets.com&quot;&gt;ICT Trends Quiz&lt;/a&gt;', '&lt;http://mcqsets.com&lt;/a&gt;', '&lt;a url=&quot;http://mcqsets.com&quot;&gt;ICT Trends Quiz&lt;/a&gt;', 'August,09 2015'),
(61, 'web_technology', 'D', '   Choose the correct HTML tag to make a text italic ', '&lt;ii&gt;', '&lt;italics&gt;', '&lt;italic&gt;', '&lt;i&gt;', 'August,09 2015'),
(62, 'web_technology', 'A', '    Choose the correct HTML tag to make a text bold?', '&lt;b&gt;', ' &lt;bold&gt;', '&lt;bb&gt;', '&lt;bld&gt;', 'August,09 2015'),
(63, 'web_technology', 'B', 'What is the correct HTML for adding a background color?', '&lt;body color=&quot;yellow&quot;&gt;', '&lt;body bgcolor=&quot;yellow&quot;&gt;', '&lt;background&gt;yellow&lt;/background&gt;', '&lt;body background=&quot;yellow&quot;&gt;', 'August,09 2015'),
(64, 'web_technology', 'B', 'Choose the correct HTML tag for the smallest size heading? ', '&lt;heading&gt;', '&lt;h6&gt;', '&lt;h1&gt;', ' &lt;head&gt;', 'August,09 2015'),
(65, 'web_technology', 'A', ' What is the correct HTML tag for inserting a line break?', '&lt;br&gt;', '&lt;lb&gt;', '&lt;break&gt;', '&lt;newline&gt;', 'August,09 2015'),
(66, 'web_technology', 'A', '  What does vlink attribute mean?', 'visited link', '  virtual link', 'very good link', 'active link', 'August,09 2015'),
(67, 'web_technology', 'B', 'Which attribute is used to name an element uniquely?', 'class', 'id', ' dot', 'all of above', 'August,09 2015'),
(68, 'web_technology', 'B', 'Which tag creates a check box for a form in HTML? ', '&lt;checkbox&gt;', '&lt;input type=&quot;checkbox&quot;&gt;', '&lt;input=checkbox&gt;', '&lt;input checkbox&gt;', 'August,09 2015'),
(69, 'web_technology', 'A', 'To create a combo box (drop down box) which tag will you use? ', '&lt;select&gt;', '&lt;list&gt;', '&lt;input type=&quot;dropdown&quot;&gt;', ' all of above', 'August,09 2015'),
(70, 'web_technology', 'D', 'Which of the following is not a pair tag? ', '&lt;p&gt;', '&lt; u &gt;', ' &lt;i&gt;', ' &lt;img&gt;', 'August,09 2015'),
(71, 'web_technology', 'C', ' To create HTML document you require a', 'web page editing software', 'High powered computer', 'Just a notepad can be used', 'None of the above', 'August,10 2015'),
(72, 'web_technology', 'A', 'The special formatting codes in HTML document used to present content are ', ' tags', ' attributes', 'values', 'None of above', 'August,10 2015'),
(73, 'web_technology', 'C', ' HTML documents are saved in', ' Special binary format', 'Machine language codes', ' ASCII text', 'None of above', 'August,10 2015'),
(74, 'web_technology', 'D', ' Some tags enclose the text. Those tags are known as', ' Couple tags', 'Single tags', 'Double tags', 'Pair tags', 'August,10 2015'),
(75, 'web_technology', 'B', 'The _____ character tells browsers to stop tagging the text5  ', '?', '/', ' &gt;', ' %', 'August,10 2015'),
(77, 'web_technology', 'D', ' In HTML document the tags  ', 'Should be written in upper case', 'should be written in lower case', 'should be written in proper case', 'can be written in both uppercase or lowercase', 'August,10 2015'),
(78, 'web_technology', 'C', 'Marquee is a tag in HTML to  ', ' mark the list of items to maintain inqueue', 'Mark the text so that it is hidden in browser', ' Display text with scrolling effect', 'None of above', 'August,10 2015'),
(79, 'web_technology', 'C', 'There are ____ different of heading tags in HTML ', '4', '5', '6', '7', 'August,10 2015'),
(80, 'web_technology', 'C', ' To create a blank line in your web page', 'press Enter two times', 'press Shift + Enter', 'insert &lt;BR&gt; tag', 'insert &lt;BLINE&gt;', 'August,10 2015'),
(81, 'web_technology', 'D', 'Which of the following is not a style tag?', '&lt;b&gt;', '&lt;tt&gt;', '&lt;i&gt;', ' All of above are style tags', 'August,10 2015'),
(82, 'web_technology', 'A', 'The way the browser displays the object can be modified by', 'attributes', ' parameters', 'modifiers', 'None of above', 'August,10 2015'),
(83, 'web_technology', 'B', 'Which of the following HTML code is valid?', '&lt;font colour=&quot;red&quot;&gt;', '&lt;font color=&quot;red&quot;&gt;', '&lt;red&gt;&lt;font&gt;', 'All of above are style tags', 'August,10 2015'),
(84, 'web_technology', 'D', 'Which of the following is an attribute related to font tag?', ' size', 'face', ' color', ' All of above are style tags', 'August,10 2015'),
(85, 'web_technology', 'C', ' HTML supports', 'ordered lists', 'unordered lists', ' both type of lists', 'does not support those types', 'August,10 2015'),
(86, 'web_technology', 'A', 'What tag is used to list individual items of an ordered list?  ', ' LI', ' OL', ' UL', 'None of above', 'August,10 2015'),
(87, 'web_technology', 'B', 'When should you use path along with file name of picture in  IMG tag?\r\n    ', 'path is optional and not necessary', 'when the location of image file and html file are different', 'when image file and html file both are on same location', 'path is always necessary when inserting image', 'August,10 2015'),
(88, 'web_technology', 'D', ' Which of the following is not a valid alignment attribute?\r\n    ', ' Left\r\n', 'Righ', ' Top', 'All of above', 'August,10 2015'),
(89, 'web_technology', 'C', 'Which attribute is used with img tag to display the text it image could not load in browser? \r\n    ', 'description', ' name', ' alt\r\n', ' id', 'August,10 2015'),
(90, 'web_technology', 'B', 'Which attribute can be used with BODY tag to set background color green? \r\n    ', 'background=&quot;green&quot;\r\n\r\n', 'bgcolor=&quot;green&quot;', 'vlink=&quot;green&quot;', 'None of above', 'August,10 2015'),
(91, 'web_technology', 'C', 'Which attribute youâ€™ll use with TD tag to merge two cells horizontally? \r\n    ', 'merge=colspan2\r\n', 'rowspan=2', 'colspan=2', 'merge=row2', 'August,10 2015'),
(92, 'web_technology', 'C', 'A webpage displays a picture. What tag was used to display that picture? \r\n    ', 'picture\r\n', 'mage', 'img', 'src', 'August,10 2015'),
(93, 'web_technology', 'A', ' &lt;b&gt; tag makes the enclosed text bold. What is other tag to make text bold?\r\n    ', '&lt;strong&gt;\r\n', '&lt;dar&gt;', '&lt;black&gt;', '&lt;emp&gt;', 'August,10 2015'),
(94, 'web_technology', 'B', ' Tags and test that are not directly displayed on the page are written in _____ section. \r\n    ', '&lt;html&gt;\r\n', '&lt;head&gt;', '. &lt;title&gt;', '&lt;body&gt;', 'August,10 2015'),
(95, 'web_technology', 'A', ' Which tag inserts a line horizontally on your web page?\r\n    ', '&lt;hr&gt;\r\n', '&lt;line&gt;', '&lt;line direction=&quot;horizontal&quot;&gt;', '&lt;tr&gt;', 'August,10 2015'),
(96, 'web_technology', 'C', 'What should be the first tag in any HTML document?\r\n    ', '&lt;head&gt;\r\n', '&lt;title&gt;', '&lt;html&gt;', '&lt;document&gt;', 'August,10 2015'),
(97, 'web_technology', 'D', ' Which tag allows you to add a row in a table?\r\n    ', '&lt;td&gt; and &lt;/td&gt;\r\n', '&lt;cr&gt; and &lt;/cr&gt;', '&lt;th&gt; and &lt;/th&gt;', '&lt;tr&gt; and &lt;/tr&gt;', 'August,10 2015'),
(98, 'web_technology', 'C', 'How can you make a bulleted list?\r\n    ', '&lt;list&gt;', ' &lt;nl&gt;', '&lt;ul&gt;', ' &lt;ol&gt;', 'August,10 2015'),
(99, 'web_technology', 'B', 'How can you make a numbered list?\r\n    ', '&lt;dl&gt;', '&lt;ol&gt;', '&lt;list&gt;', '&lt;ul&gt;', 'August,10 2015'),
(100, 'web_technology', 'D', ' How can you make an e-mail link?\r\n    ', ' &lt;a href=&quot;xxx@yyy&quot;&gt;\r\n', '&lt;mail href=&quot;xxx@yyy&quot;&gt;', '&lt;mail&gt;xxx@yyy&lt;/mail&gt;', '&lt;a href=&quot;mailto:xxx@yyy&quot;&gt;', 'August,10 2015'),
(101, 'web_technology', 'A', 'What is the correct HTML for making a hyperlink?\r\n    ', ' &lt;a href=&quot;http://mcqsets.com&quot;&gt;MCQ Sets Quiz&lt;/a&gt;', '&lt;a name=&quot;http://mcqsets.com&quot;&gt;MCQ Sets Quiz&lt;/a&gt;', '&lt;http://mcqsets.com&lt;/a&gt;', '&lt;a url=&quot;http://mcqsets.com&quot;&gt;MCQ Sets Quiz&lt;/a&gt;', 'August,10 2015'),
(103, 'web_technology', 'B', ' Which tag creates a check box for a form in HTML?', '&lt;checkbox&gt;\r\n', '&lt;input type=&quot;checkbox&quot;&gt;', '&lt;input=checkbox&gt;', '&lt;input checkbox&gt;', 'August,10 2015'),
(104, 'web_technology', 'A', ' To create a combo box (drop down box) which tag will you use?', '&lt;select&gt;\r\n', '&lt;list&gt;', '&lt;input type=&quot;dropdown&quot;&gt;', 'all of above', 'August,10 2015'),
(105, 'web_technology', 'D', ' Which of the following is not a pair tag?', ' &lt;p&gt;\r\n', '&lt; u &gt;', '&lt;i&gt;', '&lt;img&gt;', 'August,10 2015'),
(106, 'web_technology', 'A', ' What is the full form of HTML?', ' Hyper text markup language\r\n', 'Hyphenation text markup language', 'Hyphenation test marking language', 'Hyper text marking language', 'August,10 2015'),
(107, 'web_technology', 'A', ' What is the full form of HTTP?', 'Hyper text transfer protocol\r\n', 'Hyper text transfer package', 'Hyphenation text test program', 'none of the above', 'August,10 2015'),
(108, 'web_technology', 'B', 'What is a search engine?', ' a program that searches engines\r\n', 'a web site that searches anything', 'a hardware component', 'a machinery engine that search data', 'August,10 2015'),
(109, 'web_technology', 'A', 'What is the full form of TCP/IP?', 'transmission control protocol / internet protocol\r\n', ' telephone call protocol / international protocol', 'transport control protocol / internet protocol', 'none of the above', 'August,10 2015'),
(110, 'web_technology', 'C', ' HTML document start and end with which tag pairs?', '&lt;HEAD&gt;â€¦.&lt;/HEAD&gt;\r\n', '&lt;BODY&gt;â€¦.&lt;/BODY&gt;', '&lt;HTML&gt;â€¦.&lt;/HTML&gt;', ' &lt;WEB&gt;â€¦.&lt;/WEB&gt;', 'August,10 2015'),
(111, 'web_technology', 'A', ' &quot;Yahoo&quot;, &quot;Infoseek&quot; and &quot;Lycos&quot; are _________?', ' Search Engineszq\r\n', ' Browsers', 'News groups', 'None of the above', 'August,10 2015'),
(112, 'web_technology', 'B', 'What does the .com domain represents?', 'Education domain\r\n', 'Commercial domain', 'Network', 'None of the above', 'August,10 2015'),
(113, 'web_technology', 'A', 'In Satellite based communication, VSAT stands for?', 'Very Small Aperture Terminal\r\n', 'Varying Size Aperture Terminal', 'Very Small Analog Terminal', 'None of the above', 'August,10 2015'),
(114, 'web_technology', 'A', 'Outlook Express is a _________', ' E-Mail Client\r\n', 'Browser', 'Search Engine', 'None of the above', 'August,10 2015'),
(115, 'web_technology', 'C', ' &lt;TITLE&gt; â€¦ &lt;/TITLE&gt; tag must be within _______', ' Title\r\n', 'Form', ' Heade', 'Body', 'August,10 2015'),
(116, 'web_technology', 'B', 'Text within &lt;EM&gt; â€¦ &lt;/EM&gt; tag is displayed as ______', ' bold', 'italic ', ' list', ' indented', 'August,10 2015'),
(117, 'web_technology', 'A', ' Text within &lt;STRONG&gt; â€¦ &lt;/STRONG&gt; tag is displayed as ________', 'bold\r\n', ' italic', 'list', 'indented', 'August,10 2015'),
(118, 'web_technology', 'C', '&lt;UL&gt; â€¦ &lt;/UL&gt; tag is used to ________', ' display the numbered list\r\n', 'underline the text', 'display the bulleted list', 'bold the text', 'August,10 2015'),
(119, 'web_technology', 'A', 'Which tag is used to display the numbered list?', '. &lt;OL&gt;&lt;/OL&gt;\r\n', ' &lt;DL&gt;&lt;/DL&gt;', '&lt;UL&gt;&lt;/UL&gt;', '&lt;LI&gt;&lt;/LI&gt;', 'August,10 2015'),
(120, 'web_technology', 'B', 'Which tag is used to display the large font size?', ' &lt;LARGE&gt;&lt;/LARGE&gt;\r\n', '&lt;BIG&gt;&lt;/BIG&gt;', '&lt; SIZE &gt;&lt;/SIZE&gt;', '&lt;FONT&gt;&lt;/FONT&gt;', 'August,10 2015'),
(121, 'web_technology', 'C', '&lt;SCRIPT&gt; â€¦ &lt;/SCRIPT&gt; tag can be placed within _______', ' Header\r\n', 'Body', 'both A and B', 'none of the above', 'August,10 2015'),
(122, 'web_technology', 'A', ' using &lt;P&gt; tag will', 'start a new paragraph\r\n', 'break the line', 'end the current paragraph', 'none of the above', 'August,10 2015'),
(123, 'web_technology', 'B', '&lt;TD&gt; â€¦ &lt;/TD&gt; tag is used for ______', '. Table heading\r\n', 'Table Records', 'Table row', 'none of the above', 'August,10 2015'),
(124, 'web_technology', 'B', 'Which is true to change the text color to red?', ' &lt;BODY BGCOLOR=RED&gt;\r\n', '&lt;BODY TEXT=RED&gt;', '&lt;BODY COLOR=RED&gt;', 'none of the above', 'August,10 2015'),
(125, 'web_technology', 'D', 'With regards to e-mail addresses:', 'hey must always contain an @ symbol\r\nb. hey can never contain spaces\r\nc. they are case-insensitive\r\nd. all of the above', 'they can never contain spaces', 'they are case-insensitive', 'all of the above', 'August,10 2015'),
(126, 'web_technology', 'D', 'A homepage is _________', ' an index of encyclopedia articles\r\n', 'where all Internet data is stored', 'required for access to the Internet', 'the first page of a website', 'August,10 2015'),
(127, 'web_technology', 'A', 'Which of the following is used to explore the Internet?', ' Browser\r\n', 'Spreadsheet', 'Clipboard', 'Draw', 'August,10 2015'),
(128, 'web_technology', 'C', 'What is Internet Explorer?', ' An Icon\r\n', 'A File Manager', 'A Browser', 'The Interne', 'August,10 2015'),
(129, 'web_technology', 'D', 'What do I need to get onto the Internet?', ' Computer\r\n', 'Modem', 'Browser', 'All of the above', 'August,10 2015'),
(130, 'web_technology', 'C', 'What is an ISP?', ' internet System Protocol\r\n', 'internet System Protocol', 'Internet Service Provider', 'None of the above', 'August,10 2015'),
(131, 'web_technology', 'D', 'Which of the following is valid IP address?', ' 984.12.787.76\r\n', '192.168.321.10', '1.888.234.3456', '192.168.56.115', 'August,10 2015'),
(132, 'web_technology', 'C', 'Which of this is not a domain name extension', '. mil\r\n', '.org', '.int', '.com', 'August,10 2015'),
(133, 'web_technology', 'A', 'What is a FTP program used for?', 'Transfer files to and from an Internet Server\r\n', 'Designing a website', 'Connecting to the internet', 'None of the above', 'August,10 2015'),
(134, 'web_technology', 'B', 'Which of the following are commonly found on web pages?', ' internet\r\n', 'hyperlinks', 'intranet', 'all of the above', 'August,10 2015'),
(135, 'web_technology', 'D', ' What is the correct syntax in HTML for creating a link on a webpage?', ' &lt;LINK SRC= &quot;mcqsets.html&quot;&gt;\r\n', '&lt;BODY LINK = &quot;mcqsets.html&quot;&gt;', '&lt;A SRC = &quot;mcqsets.html&quot; &gt;', '&lt; A HREF = &quot;mcqsets.html&quot;&gt;', 'August,10 2015'),
(136, 'web_technology', 'C', ' Which of the following is an attribute of &lt;Table&gt; tag?', 'SRC\r\n', 'LINK', 'CELLPADDING', 'BOLD', 'August,12 2015'),
(137, 'web_technology', 'D', ' Choose the correct HTML tag to make the text bold?', '&lt;B&gt;\r\n', '&lt;BOLD&gt;', '&lt;STRONG&gt;', 'Both A) and C)', 'August,12 2015'),
(138, 'web_technology', 'A', ' Which HTML tag would be used to display power in expression (A+B)2 ?', '&lt;SUP&gt;\r\n', '&lt;SUB&gt;', '&lt;B&gt;', ' &lt;P&gt;', 'August,12 2015'),
(139, 'web_technology', 'B', 'Choose the correct HTML code to create an email link?', ' &lt;A HREF = &quot;admin@mcqsets.com&quot;&gt;&lt;/A&gt;\r\n', '&lt;A HREF = &quot;admin:ganesh@mcqsets.com&quot;&gt;&lt;/A&gt;', '&lt;MAIL&gt;admin@mcqsets.com &lt;/MAIL&gt;', '&lt;A MAILHREF = &quot;admin@mcqsets.com&quot;&gt;&lt;/A&gt;', 'August,12 2015'),
(140, 'web_technology', 'A', 'Choose the correct HTML tag for the largest heading?', '&lt;H1&gt;\r\n', '&lt;H6&gt;', '&lt;H10&gt;', '&lt;HEAD&gt;', 'August,12 2015'),
(141, 'web_technology', 'B', 'Output of XML document can be viewed in a', 'Word Processor\r\n', 'Web browser', 'Notepad', 'None of the above', 'August,12 2015'),
(142, 'web_technology', 'C', 'What is the correct way of describing XML data?', 'XML uses a DTD to describe data', 'XML uses a description node to describe data\r\n', 'XML uses XSL to describe the data', 'XML uses a validator to describe the data', 'August,12 2015'),
(143, 'web_technology', 'C', ' Comments in XML document is given by:', '&lt;?-- _ _--&gt;\r\n', '&lt;!_ _ _ _!&gt;', '&lt;!_ _ _ _&gt;', '&lt;/_ _ _ _&gt;', 'August,12 2015'),
(144, 'web_technology', 'A', 'Which of this statement is true?', ' An XML document can have one root element\r\n', 'An XML document can have one child element', 'XML elements have to be in lower case', 'All of the above', 'August,12 2015'),
(145, 'web_technology', 'B', 'How to define the link should open in new page in HTML?', '&lt;a href = &quot;http://www.mcqsets.com/&quot; target = &quot;blank&quot;&gt; Click Here &lt;/a&gt;\r\n\r\n\r\n', '&lt;a href = &quot;http://www.mcqsets.com/&quot; target = &quot;_blank&quot;&gt; Click Here &lt;/a&gt;', '&lt;a href = &quot;http://www.mcqsets.com/&quot; target = &quot;#blank&quot;&gt; Click ', '&lt;a href = &quot;http://www.mcqsets.com/&quot; target = &quot;@blank&quot;&gt; Click', 'August,12 2015'),
(146, 'web_technology', 'D', 'In HTML, Uniform Resource Identifier (URI) is used to', ' To create a frame document .\r\n ', 'To create a image map in the webpage.', ' To customize the image in the webpage.', 'To identify a name or a resource on the internet', 'August,12 2015'),
(147, 'web_technology', 'A', 'CSS is an acronym for', ' Cascading Style Sheet\r\n\r\n\r\n', 'Costume Style Sheet', 'Cascading System Style', 'None of the Above', 'August,12 2015'),
(148, 'web_technology', 'D', 'Who invented World Wide Web (WWW)?', ' Blaise Pascal\r\n', 'Charles Babbage', 'Herman Hollerith', 'Tim Berners-Lee', 'August,12 2015'),
(149, 'web_technology', 'B', ' Which of the following protocol is not used in the Internet', 'Telnet', 'WIRL', 'HTTP', ' Gopher', 'August,12 2015'),
(150, 'web_technology', 'B', 'What is the use of Web Font in HTML ?', ' that is the core font that is use to develop Web Pages.\r\n', 'that enables to use fonts over the Web without installation.', ' that is the special font that developed by Microsoft Corp.', ' All of the Above.', 'August,12 2015'),
(151, 'web_technology', 'A', 'What is &lt;tt&gt; tag in HTML?', ' It renders fonts as teletype text font style.\r\n', 'It renders fonts as truetype text font style.', ' It renders fonts as truncate text font style.', 'None of the Above', 'August,12 2015'),
(152, 'web_technology', 'A', 'which of the following is a web server ?', 'nginx', 'xampp', 'wampp', 'lampp', 'August,16 2015');

-- --------------------------------------------------------

--
-- Table structure for table `studentlog`
--

CREATE TABLE IF NOT EXISTS `studentlog` (
`id` int(11) NOT NULL,
  `loginkey` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `count` int(11) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentlog`
--

INSERT INTO `studentlog` (`id`, `loginkey`, `status`, `count`, `datetime`) VALUES
(113, '12/69/0191', 'complete', 0, '13-03-16 22:30');

-- --------------------------------------------------------

--
-- Table structure for table `studentrecord`
--

CREATE TABLE IF NOT EXISTS `studentrecord` (
`id` int(11) NOT NULL,
  `surName` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `loginkey` varchar(20) NOT NULL,
  `department` varchar(100) NOT NULL,
  `subject` text NOT NULL,
  `photo` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentrecord`
--

INSERT INTO `studentrecord` (`id`, `surName`, `firstName`, `loginkey`, `department`, `subject`, `photo`, `datetime`) VALUES
(1, 'azeez', '', '12/69/0191', 'computer science', 'ruby', '', '2016-03-04 11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_answer`
--

CREATE TABLE IF NOT EXISTS `tmp_answer` (
`id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `ans` varchar(50) NOT NULL,
  `correct` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `date` varchar(20) NOT NULL,
  `question` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_answer`
--

INSERT INTO `tmp_answer` (`id`, `subject`, `ans`, `correct`, `username`, `date`, `question`) VALUES
(51, 'ruby', 'C', 'B', '12/69/0191', '13-03-16 22:30', 2),
(52, 'ruby', 'C', 'C', '12/69/0191', '13-03-16 22:30', 18),
(53, 'ruby', 'C', 'A', '12/69/0191', '13-03-16 22:30', 6),
(54, 'ruby', 'C', 'D', '12/69/0191', '13-03-16 22:30', 3),
(55, 'ruby', 'B', 'A', '12/69/0191', '13-03-16 22:30', 4),
(56, 'ruby', 'A', 'A', '12/69/0191', '13-03-16 22:30', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_question`
--

CREATE TABLE IF NOT EXISTS `tmp_question` (
`id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `question` int(11) NOT NULL,
  `A` text NOT NULL,
  `B` text NOT NULL,
  `C` text NOT NULL,
  `D` text NOT NULL,
  `date_registered` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countdown`
--
ALTER TABLE `countdown`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_addsubject`
--
ALTER TABLE `exam_addsubject`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `practisetime`
--
ALTER TABLE `practisetime`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qtn_limit`
--
ALTER TABLE `qtn_limit`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentlog`
--
ALTER TABLE `studentlog`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentrecord`
--
ALTER TABLE `studentrecord`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmp_answer`
--
ALTER TABLE `tmp_answer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmp_question`
--
ALTER TABLE `tmp_question`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `countdown`
--
ALTER TABLE `countdown`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `exam_addsubject`
--
ALTER TABLE `exam_addsubject`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `practisetime`
--
ALTER TABLE `practisetime`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `qtn_limit`
--
ALTER TABLE `qtn_limit`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT for table `studentlog`
--
ALTER TABLE `studentlog`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `studentrecord`
--
ALTER TABLE `studentrecord`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tmp_answer`
--
ALTER TABLE `tmp_answer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `tmp_question`
--
ALTER TABLE `tmp_question`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
