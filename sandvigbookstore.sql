-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 10/06/2017 às 21:13
-- Versão do servidor: 5.7.18-0ubuntu0.16.04.1
-- Versão do PHP: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sandvigbookstore`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `bookauthors`
--

CREATE TABLE `bookauthors` (
  `AuthorID` int(11) NOT NULL,
  `nameF` varchar(15) NOT NULL,
  `nameL` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `bookauthors`
--

INSERT INTO `bookauthors` (`AuthorID`, `nameF`, `nameL`) VALUES
(1, 'Jason', 'Gilmore'),
(2, 'David', 'Sklar'),
(3, 'Luke', 'Welling'),
(4, 'Laura', 'Thomson'),
(5, 'Steve', 'Krug'),
(6, 'Ben', 'Forta'),
(8, 'Jakob', 'Nielsen'),
(9, 'Hoa', 'Loranger'),
(11, 'Alan', 'Beaulieu'),
(12, 'Jesse', 'Liberty'),
(13, 'Dan', 'Hurwitz'),
(14, 'Michele E.', 'Davis'),
(15, 'John A.', 'Phillips'),
(16, 'Jeffrey', 'Friedl'),
(17, 'Michael J.', 'Hernandez'),
(18, 'John L.', 'Viescas'),
(22, 'Stephan', 'Walther'),
(23, 'Andrew', 'Watt'),
(24, 'Eric', 'Rosebrok'),
(25, 'Kevin', 'Tatroe'),
(26, 'Rasmus', 'Lerdorf'),
(27, 'Peter', 'MacIntyre'),
(29, 'Matthew', 'MacDonald'),
(30, 'Julian', 'Templeman'),
(31, 'Thomas', 'Erl'),
(32, 'Hugh E.', 'Williams'),
(33, 'David', 'Lane');

-- --------------------------------------------------------

--
-- Estrutura para tabela `bookauthorsbooks`
--

CREATE TABLE `bookauthorsbooks` (
  `ISBN` varchar(15) NOT NULL,
  `AuthorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `bookauthorsbooks`
--

INSERT INTO `bookauthorsbooks` (`ISBN`, `AuthorID`) VALUES
('0131428985', 2),
('0201433362', 31),
('0321344758', 5),
('0321350316', 8),
('0596005601', 2),
('0596006810', 27),
('0596007272', 11),
('0596101104', 14),
('0596528124', 16),
('0672325675', 6),
('0672326728', 3),
('0672328232', 22),
('0764574892', 23),
('0782142796', 24),
('1590595521', 1),
('1590595726', 29);

-- --------------------------------------------------------

--
-- Estrutura para tabela `bookcategories`
--

CREATE TABLE `bookcategories` (
  `CategoryID` int(4) NOT NULL,
  `CategoryName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `bookcategories`
--

INSERT INTO `bookcategories` (`CategoryID`, `CategoryName`) VALUES
(1, 'PHP'),
(2, 'MySQL'),
(3, 'Web Usability'),
(4, 'SQL'),
(5, 'ASP.NET'),
(6, 'Regular Expressions'),
(7, 'Web Services'),
(8, 'Morse Code');

-- --------------------------------------------------------

--
-- Estrutura para tabela `bookcategoriesbooks`
--

CREATE TABLE `bookcategoriesbooks` (
  `CategoryID` int(4) NOT NULL,
  `ISBN` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `bookcategoriesbooks`
--

INSERT INTO `bookcategoriesbooks` (`CategoryID`, `ISBN`) VALUES
(1, '0596005601'),
(1, '0596006810'),
(1, '0672326728'),
(1, '0782142796'),
(2, '0596101104'),
(2, '1590595521'),
(3, '0321344758'),
(3, '0321350316'),
(4, '0201433362'),
(4, '0596007272'),
(4, '0672325675'),
(5, '0672328232'),
(5, '1590595726'),
(6, '0596528124'),
(6, '0764574892'),
(8, '0131428985');

-- --------------------------------------------------------

--
-- Estrutura para tabela `bookcustomers`
--

CREATE TABLE `bookcustomers` (
  `custID` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `street` varchar(25) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `bookcustomers`
--

INSERT INTO `bookcustomers` (`custID`, `fname`, `lname`, `email`, `street`, `city`, `state`, `zip`) VALUES
(2, 'Gustavo', 'Gomides', 'gustavo.gomides7@gmail.com', 'Street', 'City', 'MG', '37500433');

-- --------------------------------------------------------

--
-- Estrutura para tabela `bookdescriptions`
--

CREATE TABLE `bookdescriptions` (
  `ISBN` varchar(15) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(8000) NOT NULL,
  `price` real NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `pubdate` varchar(25) NOT NULL,
  `edition` int(11) NOT NULL,
  `pages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `bookdescriptions`
--

INSERT INTO `bookdescriptions` (`ISBN`, `title`, `description`, `price`, `publisher`, `pubdate`, `edition`, `pages`) VALUES
('0131428985', 'Service-Oriented Architecture : A Field Guide to Integrating XML and Web Services', '<p>The emergence of key second-generation Web services standards has positioned service-oriented architecture (SOA) as the foremost platform for contemporary business automation solutions. The integration of SOA principles and technology is empowering organizations to build applications with unprecedented levels of flexibility, agility, and sophistication (while also allowing them to leverage existing legacy environments).</p>\n\n<p>This guide will help you dramatically reduce the risk, complexity, and cost of integrating the many new concepts and technologies introduced by the SOA platform. It brings together the first comprehensive collection of field-proven strategies, guidelines, and best practices for making the transition toward the service-oriented enterprise.</p>\n\n<p>Writing for architects, analysts, managers, and developers, Thomas Erl offers expert advice for making strategic decisions about both immediate and long-term integration issues. Erl addresses a broad spectrum of integration challenges, covering technical and design issues, as well as strategic planning.</p>\n\n<ul>\n	<li>Covers crucial second-generation (WS-*) Web services standards: BPEL4WS, WS-Security, S-Coordination, WS-Transaction, WS-Policy, WS-ReliableMessaging, and WS-Attachments</li>\n	<li>Includes hundreds of individual integration strategies and more than 60 best practices for both XML and Web services technologies</li>\n	<li>Includes a complete tutorial on service-oriented design principles for business and technical modeling</li>\n	<li>Explores design issues related to a wide variety of service-oriented integration architectures that integrate XML and Web services into legacy and EAI environments</li>\n	<li>Provides a clear roadmap for planning a long-term migration toward a standardized service-oriented enterprise</li>\n</ul>\n\n<p>Service-oriented architecture is no longer an exclusive discipline practiced only by expensive consultants. With this books help, you can plan, architect, and implement your own service-oriented environments-efficiently and cost-effectively.</p>\n', '45', 'Prentice Hall', 'April 1 ,2004', 1, 560),
('0201433362', 'SQL Queries for Mere Mortals: A Hands-On Guide to Data Manipulation in SQL ', '<p>To the people who are accomplished in its use, Structured Query Language (SQL) is a highly capable, eminently flexible, even beautiful way of describing the data that you want from a database, or the changes that you want to make to a database. For the rest of us, however, SQL is a first-class nuisance that we do our best to avoid by relying on relatively user-friendly--but usually less powerful--tools. <em>SQL Queries for Mere Mortals</em> aims to bring SQL-phobes closer to the first camp by tutoring them carefully in what SQL can do.</p>\n\n<p>The authors recognize that SQL queries usually come about as a result of questions from human beings, and so usefully spend a fair bit of time showing how to convert, say, In what cities do our customers live?&nbsp;into, Select city from the customers table&nbsp;and, finally, SELECT city FROM customers&nbsp;in SQL. They call this the translation and clean up&nbsp;process, and its a fine approach. They dont press it too far, however, and are equally adept at presenting straight explanations of SQL syntax elements in prose. They spend a lot of energy graphically diagramming aspects of SQL syntax in a format that requires some up-front study. A particular reader might prefer text capsules to this arrow-intensive format, but other learners might like the graphical syntax diagrams. <em>--David Wall</em></p>\n', '55', 'Addison-Wesley Professional', 'August 1, 2000', 1, 528),
('0321344758', 'Dont Make Me Think', '<p>Usability design is one of the most important--yet often least attractive--tasks for a Web developer. In <em>Dont Make Me Think</em>, author Steve Krug lightens up the subject with good humor and excellent, to-the-point examples.</p>\n\n<p>The title of the book is its chief personal design premise. All of the tips, techniques, and examples presented revolve around users being able to surf merrily through a well-designed site with minimal cognitive strain. Readers will quickly come to agree with many of the books assumptions, such as We dont read pages--we scan them&nbsp;and We dont figure out how things work--we muddle through.&nbsp;Coming to grips with such hard facts sets the stage for Web design that then produces topnotch sites.</p>\n\n<p>Using an attractive mix of full-color screen shots, cute cartoons and diagrams, and informative sidebars, the book keeps your attention and drives home some crucial points. Much of the content is devoted to proper use of conventions and content layout, and the before and after&nbsp;examples are superb. Topics such as the wise use of rollovers and usability testing are covered using a consistently practical approach.</p>\n\n<p>This is the type of book you can blow through in a couple of evenings. But despite its conciseness, it will give you an experts ability to judge Web design. Youll never form a first impression of a site in the same way again. <em>--Stephen W. Plain</em></p>\n\n<p><strong>Topics covered:</strong></p>\n\n<ul>\n	<li>User patterns</li>\n	<li>Designing for scanning</li>\n	<li>Wise use of copy</li>\n	<li>Navigation design</li>\n	<li>Home page layout</li>\n	<li>Usability testing</li>\n</ul>\n', '35', 'New Riders Press', 'August 4, 2005', 2, 224),
('0321350316', 'Prioritizing Web Usability', '<p>In 2000, Jakob Nielsen, the worlds leading expert on Web usability, published a book that changed how people think about the WebDesigning Web Usability (New Riders). Many applauded. A few jeered. But everyone listened. The best-selling usability guru is back and has revisited his classic guide, joined forces with Web usability consultant Hoa Loranger, and created an updated companion book that covers the essential changes to the Web and usability today. Prioritizing Web Usability is the guide for anyone who wants to take their Web site(s) to next level and make usability a priority! Through the authors&nbsp;wisdom, experience, and hundreds of real-world user tests and contemporary Web site critiques, youll learn about site design, user experience and usability testing, navigation and search capabilities, old guidelines and prioritizing usability issues, page design and layout, content design, and more!</p>\n', '50', 'New Riders Press', 'April 4, 2006', 1, 432),
('0596005601', 'Learning PHP 5', '<p>PHP has gained a following among non-technical web designers who need to add interactive aspects to their sites. Offering a gentle learning curve, PHP is an accessible yet powerful language for creating dynamic web pages. As its popularity has grown, PHPs basic feature set has become increasingly more sophisticated. Now PHP 5 boasts advanced features--such as new object-oriented capabilities and support for XML and Web Services--that will please even the most experienced web professionals while still remaining user-friendly enough for those with a lower tolerance for technical jargon. If youve wanted to try your hand at PHP but havent known where to start, then <em>Learning PHP 5</em> is the book you need. If youve wanted to try your hand at PHP but havent known where to start, then <em>Learning PHP 5</em> is the book you need. With attention to both PHP 4 and the new PHP version 5, it provides everything from a explanation of how PHP works with your web server and web browser to the ins and outs of working with databases and HTML forms. Written by the co-author of the popular <em>PHP Cookbook</em>, this book is for intelligent (but not necessarily highly-technical) readers. <em>Learning PHP 5</em> guides you through every aspect of the language youll need to master for professional web programming results. This book provides a hands-on learning experience complete with exercises to make sure the lessons stick. <em>Learning PHP 5</em> covers the following topics, and more:</p>\n\n<ul>\n	<li>How PHP works with your web browser and web server</li>\n	<li>PHP language basics, including data, variables, logic and looping</li>\n	<li>Working with arrays and functions</li>\n	<li>Making web forms</li>\n	<li>Working with databases like MySQL</li>\n	<li>Remembering users with sessions</li>\n	<li>Parsing and generating XML</li>\n	<li>Debugging</li>\n</ul>\n\n<p>Written by David Sklar, coauthor of the <em>PHP Cookbook</em> and an instructor in PHP, this book offers the ideal classroom learning experience whether youre in a classroom or on your own. From learning how to install PHP to designing database-backed web applications, <em>Learning PHP 5</em> will guide you through every aspect of the language youll need to master to achieve professional web programming results.</p>\n', '30', 'O Reilly Media', 'July 4, 2004', 1, 348),
('0596006810', 'Programming PHP', '<p><em>Programming PHP</em>, 2nd Edition, is the authoritative guide to PHP 5 and is filled with the unique knowledge of the creator of PHP (Rasmus Lerdorf) and other PHP experts. When it comes to creating websites, the PHP scripting language is truly a red-hot property. In fact, PHP is currently used on more than 19 million websites, surpassing Microsofts ASP .NET technology in popularity. Programmers love its flexibility and speed; designers love its accessibility and convenience.</p>\n\n<p>As the industry standard book on PHP, all of the essentials are covered in a clear and concise manner. Language syntax and programming techniques are coupled with numerous examples that illustrate both correct usage and common idioms. With style tips and practical programming advice, this book will help you become not just a PHP programmer, but a <em>good</em> PHP programmer. <em>Programming PHP, Second Edition</em> covers everything you need to know to create effective web applications with PHP. Contents include:</p>\n\n<ul>\n	<li>Detailed information on the basics of the PHP language, including data types, variables, operators, and flow control statements</li>\n	<li>Chapters outlining the basics of functions, strings, arrays, and objects</li>\n	<li>Coverage of common PHP web application techniques, such as form processing and validation, session tracking, and cookies</li>\n	<li>Material on interacting with relational databases, such as MySQL and Oracle, using the database-independent PEAR DB library and the new PDO Library</li>\n	<li>Chapters that show you how to generate dynamic images, create PDF files, and parse XML files with PHP</li>\n	<li>Advanced topics, such as creating secure scripts, error handling, performance tuning, and writing your own C language extensions to PHP</li>\n	<li>A handy quick reference to all the core functions in PHP and all the standard extensions that ship with PHP</li>\n</ul>\n', '26', 'O Reilly Media', 'April 6, 2006', 2, 521),
('0596007272', 'Learning SQL', '<p>SQL (Structured Query Language) is a standard programming language for generating, manipulating, and retrieving information from a relational database. If youre working with a relational database--whether youre writing applications, performing administrative tasks, or generating reports--you need to know how to interact with your data. Even if you are using a tool that generates SQL for you, such as a reporting tool, there may still be cases where you need to bypass the automatic generation feature and write your own SQL statements.</p>\n\n<p>To help you attain this fundamental SQL knowledge, look to <em>Learning SQL</em>, an introductory guide to SQL, designed primarily for developers just cutting their teeth on the language.</p>\n\n<p><em>Learning SQL</em> moves you quickly through the basics and then on to some of the more commonly used advanced features. Among the topics discussed:</p>\n\n<ul>\n	<li>The history of the computerized database</li>\n	<li>SQL Data Statements--those used to create, manipulate, and retrieve data stored in your database; example statements include select, update, insert, and delete</li>\n	<li>SQL Schema Statements--those used to create database objects, such as tables, indexes, and constraints</li>\n	<li>How data sets can interact with queries</li>\n	<li>The importance of subqueries</li>\n	<li>Data conversion and manipulation via SQLs built-in functions</li>\n	<li>How conditional logic can be used in Data Statements</li>\n</ul>\n\n<p>Best of all, <em>Learning SQL</em> talks to you in a real-world manner, discussing various platform differences that youre likely to encounter and offering a series of chapter exercises that walk you through the learning process. Whenever possible, the book sticks to the features included in the ANSI SQL standards. This means youll be able to apply what you learn to any of several different databases; the book covers MySQL, Microsoft SQL Server, and Oracle Database, but the features and syntax should apply just as well (perhaps with some tweaking) to IBM DB2, Sybase Adaptive Server, and PostgreSQL.</p>\n\n<p>Put the power and flexibility of SQL to work. With <em>Learning SQL</em> you can master this important skill and know that the SQL statements you write are indeed correct.</p>\n', '35', 'O Reilly Media', 'August 1, 2005', 1, 289),
('0596101104', 'Learning PHP and MySQL', '<p>The PHP scripting language and MySQL open source database are quite effective independently, but together they make a simply unbeatable team. When working hand-in-hand, they serve as the standard for the rapid development of dynamic, database-driven websites. This combination is so popular, in fact, that its attracting many programming newbies who come from a web or graphic design background and whose first language is HTML. If you fall into this ever-expanding category, then this book is for you.</p>\n', '30', 'O Reilly Media', 'October 0, 2016', 1, 359),
('0596528124', 'Mastering Regular Expressions', '<p>Regular expressions are an extremely powerful tool for manipulating text and data. They are now standard features in a wide range of languages and popular tools, including Perl, Python, Ruby, Java, VB.NET and C# (and any language using the .NET Framework), PHP, and MySQL.</p>\n\n<p>If you dont use regular expressions yet, you will discover in this book a whole new world of mastery over your data. If you already use them, youll appreciate this books unprecedented detail and breadth of coverage. If you think you know all you need to know about regular expressions, this book is a stunning eye-opener.</p>\n\n<p>&nbsp;As this book shows, a command of regular expressions is an invaluable skill. Regular expressions allow you to code complex and subtle text processing that you never imagined could be automated. Regular expressions can save you time and aggravation. They can be used to craft elegant solutions to a wide range of problems. Once youve mastered regular expressions, theyll become an invaluable part of your toolkit. You will wonder how you ever got by without them.</p>\n\n<p>Yet despite their wide availability, flexibility, and unparalleled power, regular expressions are frequently underutilized. Yet what is power in the hands of an expert can be fraught with peril for the unwary. <strong>Mastering Regular Expressions</strong>&nbsp;will help you navigate the minefield to becoming an expert and help you optimize your use of regular expressions. <strong>Mastering Regular Expressions</strong>, Third Edition, now includes a full chapter devoted to PHP and its powerful and expressive suite of regular expression functions, in addition to enhanced PHP coverage in the central &amp;quot;core&amp;quot; chapters. Furthermore, this edition has been updated throughout to reflect advances in other languages, including expanded in-depth coverage of Suns j<strong>ava.util.regex</strong>&nbsp;package, which has emerged as the standard Java regex implementation.Topics include:</p>\n\n<ul>\n	<li>A comparison of features among different versions of many languages and tools</li>\n	<li>How the regular expression engine works</li>\n	<li>Optimization (major savings available here!)</li>\n	<li>Matching just what you want, but not what you dont want</li>\n	<li>Sections and chapters on individual languages</li>\n</ul>\n\n<p>Written in the lucid, entertaining tone that makes a complex, dry topic become crystal-clear to programmers, and sprinkled with solutions to complex real-world problems, <strong>Mastering Regular Expressions</strong>, Third Edition offers a wealth information that you can put to immediate use.</p>\n', '36', 'O Reilly Media', 'October 3, 2014', 3, 515),
('0672325675', 'Teach Yourself SQL in 10 Minutes', '<p><em>Sams Teach Yourself SQL in 10 Minutes</em> has established itself as the gold standard for introductory SQL books, offering a fast-paced accessible tutorial to the major themes and techniques involved in applying the SQL language. Fortas examples are clear and his writing style is crisp and concise. As with earlier editions, this revision includes coverage of current versions of all major commercial SQL platforms. New this time around is coverage of MySQL, and PostgreSQL. All examples have been tested against each SQL platform, with incompatibilities or platform distinctives called out and explained.</p>\n', '15', 'Sams', 'April 3, 2004', 3, 256),
('0672326728', 'PHP and MySQL Web Development', '<p>The PHP server-side scripting language and the MySQL database management system (DBMS) make a potent pair. Both are open-source products--free of charge for most purposes--remarkably strong, and capable of handling all but the most enormous transaction loads. Both are supported by large, skilled, and enthusiastic communities of architects, programmers, and designers. <em>PHP and MySQL Web Development</em> introduces readers (who are assumed to have little or no experience with the title subjects) to PHP and MySQL for the purpose of creating dynamic Internet sites. It teaches the same skills as introductory Active Server Pages (ASP) and ColdFusion books--technologies that address the same niche.</p>\n\n<p>Authors Luke Welling and Laura Thomsons technique aims to get readers going on their own projects as soon as possible. They present easily digestible sections on specific technical processes--Accessing array contents&nbsp;and Using encryption with PHP&nbsp;are two examples. Each section centers on a sample program that strips the task at hand down to its essentials, enabling the reader to fit the process into his or her own solutions as required. Tables that list options and other nuggets of reference material appear as well, but the many examples and the authors&nbsp;commentary on them take center stage.</p>\n\n<p>For reference material on MySQL, have a look at Paul DuBoiss <em><a href="http://www.amazon.com/exec/obidos/ASIN/0735709211/$%7B0%7D">MySQL</a></em>. On the PHP side, <em><a href="http://www.amazon.com/exec/obidos/ASIN/0735709971/$%7B0%7D">Web Application Development with PHP 4.0</a></em> is excellent. <em>--David Wall</em></p>\n\n<p><strong>Topics covered:</strong></p>\n\n<ul>\n	<li>The MySQL database server (for both Unix and Windows)</li>\n	<li>Accessing MySQL databases through PHP scripting (the letters dont really stand for anything)</li>\n	<li>Database creation and modification</li>\n	<li>PHP tricks in order of increasing complexity--everything from basic SQL queries to secure transactions for commerce</li>\n	<li>Authentication</li>\n	<li>Network connectivity</li>\n	<li>Session management</li>\n	<li>Content customization</li>\n</ul>\n', '33', 'Sams', 'September 3, 2004', 3, 984),
('0672328232', 'ASP.NET 2.0 Unleashed', '<p><em>ASP.NET 2.0 Unleashed&nbsp;</em>is a revision of the best-selling <em>ASP.NET Unleashed, </em>by Microsoft Software Legend <strong>Stephen Walther</strong>. It<strong>&nbsp;</strong>covers virtually all features of ASP.NET 2.0&nbsp;including more than 50 new controls, personalization, master pages, and web parts. All code samples are presented in VB and C#. Throughout the more than&nbsp;2,000 pages, you will be shown how to develop state-of-the-art Web applications using Microsofts latest development tools. This resource is guaranteed to be used as a&nbsp;reference guide&nbsp;over and over!</p>\n', '60', 'Sams', 'June 2, 2006', 1, 1992),
('0764574892', 'Beginning Regular Expressions', '<p>Regular expressions help users and developers to find and manipulate text more effectively and efficiently. In addition, regular expressions are supported by many scripting languages, programming languages, and databases. This example-rich tutorial helps debunk the traditional reputation of regular expressions as being cryptic. It explains the various parts of a regular expression pattern, what those parts mean, how to use them, and common pitfalls to avoid when writing regular expressions. With chapters on using regular expressions with popular Windows platform software including databases, cross platform scripting languages, and programming languages, youll learn to make effective use of the power provided by regular expressions once you fully comprehend their strengths and potential. What you will learn from this book -Fundamental concepts of regular expressions and how to write them -How to break down a text manipulation problem into component parts so you can then logically construct a regular expression pattern -How to use regular expressions in several scripting and programming languages and software packages -The variations that exist among regular expression dialects -Reusable, real-world working code that can be used to solve everyday regular expression problems Who this book is for: This book is for developers who need to manipulate text but are new to regular expressions. Some basic programming or scripting experience is useful but not required.</p>\n', '40', 'Wrox', 'February 5, 2005', 1, 768),
('0782142796', 'Creating Interactive Web Sites with PHP and Web Services', '<p>PHP and MySQL are great tools for building database-driven websites. Theres nothing new about that. What is new is the environment in which your site operates&mdash;a world rich (and growing richer) in web services that can add value and functionality in many different ways. Creating Interactive Web Sites with PHP and Web Services walks you through every step of a major web project&mdash;a content-management system&mdash;teaching you both the basic techniques and little-known tricks you need to build successful web sites. And you can use those skills to develop dynamic applications that will meet your special requirements. Heres some of what youll find covered inside:</p>\n\n<ul>\n	<li>Adding, deleting, and displaying data with a custom content-management system</li>\n	<li>Building a template system with PHP</li>\n	<li>Interacting with web services using PHP and MySQL</li>\n	<li>Creating and managing a user system and a shopping cart</li>\n	<li>Processing credit card payments using merchant accounts and third-party payment solutions</li>\n	<li>Tracking site statistics using PHP and MySQL</li>\n	<li>Enhancing your site with third-party scripts</li>\n</ul>\n\n<p>Tons of examples, complete with explanations and supported by online source code, will speed your progress, whether youre a true beginner or already have PHP experience. This book is platform-agnostic, so it doesnt matter if youre deploying your site on Linux or Windows. You also get PHP and MySQL references, so you can quickly resolve questions about syntax and similar issues.</p>\n', '40', 'Sybex', 'December 5, 2003', 1, 512),
('1590595521', 'Beginning PHP and MySQL 5', '<p><em>Beginning PHP 5 and MYSQL: From Novice to Professional</em> offers a comprehensive introduction to two of the most popular Web application building technologies on the planet: the scripting language PHP and the MySQL database server. This book will not only expose you to the core aspects of both technologies, but will provide valuable insight into how they are used in unison to create dynamic data-driven Web applications.</p>\n\n<p><em>Beginning PHP 5 and MYSQL</em> explains the new features of the latest releases of the worlds most popular Open Source Web development technologies: MySQL 4 database server and PHP 5 scripting language. This book explores the benefits, extensive new features, and advantages of the object-oriented PHP 5, and how it can be used in conjunction with MySQL 4 to create powerful dynamic Web sites.</p>\n\n<p>This is the perfect book for the Web designer, programmer, hobbyist, or novice that wants to learn how to create applications with PHP 5 and MySQL 4, and is a great entrance point for Apresss extensive spectrum of PHP books planned for 2004.</p>\n', '45', 'Apress', 'November 3, 2016', 1, 952),
('1590595726', 'Beginning ASP.NET 2.0 in C#', '<p><em>Beginning ASP.NET 2.0 in C# 2005: From Novice to Professional</em> steers you through the maze of ASP.NET web programming concepts. You will learn language and theory simultaneously, mastering the core techniques necessary to develop good coding practices and enhance your skill set.</p>\n\n<p>This book provides thorough coverage of ASP.NET, guiding you from beginning to advanced techniques, such as querying databases from within a web page and performance-tuning your site. Youll find tips for best practices and comprehensive discussions of key database and XML principles.</p>\n\n<p>The book also emphasizes the invaluable coding techniques of object orientation and code-behind, which will enable you to build real-world websites instead of just scraping by with simplified coding practices. By the time you finish this book, you will have mastered the core techniques essential to professional ASP.NET developers.</p>\n', '50', 'Apress', 'January 4, 2006', 1, 1184);

-- --------------------------------------------------------

--
-- Estrutura para tabela `bookorderitems`
--

CREATE TABLE `bookorderitems` (
  `orderID` int(11) NOT NULL,
  `ISBN` varchar(11) NOT NULL,
  `qty` int(4) NOT NULL,
  `price` double(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `bookorders`
--

CREATE TABLE `bookorders` (
  `orderID` int(11) NOT NULL,
  `custID` int(6) NOT NULL,
  `orderdate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `email` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `usuarios`
--

INSERT INTO `usuarios` (`email`, `nome`, `senha`) VALUES
('admin', 'admin', 'admin');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `bookauthors`
--
ALTER TABLE `bookauthors`
  ADD PRIMARY KEY (`AuthorID`);

--
-- Índices de tabela `bookauthorsbooks`
--
ALTER TABLE `bookauthorsbooks`
  ADD PRIMARY KEY (`ISBN`,`AuthorID`);

--
-- Índices de tabela `bookcategories`
--
ALTER TABLE `bookcategories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Índices de tabela `bookcategoriesbooks`
--
ALTER TABLE `bookcategoriesbooks`
  ADD PRIMARY KEY (`CategoryID`,`ISBN`);

--
-- Índices de tabela `bookcustomers`
--
ALTER TABLE `bookcustomers`
  ADD PRIMARY KEY (`custID`);

--
-- Índices de tabela `bookdescriptions`
--
ALTER TABLE `bookdescriptions`
  ADD PRIMARY KEY (`ISBN`),
  ADD KEY `strTitle` (`title`);

--
-- Índices de tabela `bookorderitems`
--
ALTER TABLE `bookorderitems`
  ADD PRIMARY KEY (`orderID`,`ISBN`);

--
-- Índices de tabela `bookorders`
--
ALTER TABLE `bookorders`
  ADD PRIMARY KEY (`orderID`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `bookauthors`
--
ALTER TABLE `bookauthors`
  MODIFY `AuthorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de tabela `bookcategories`
--
ALTER TABLE `bookcategories`
  MODIFY `CategoryID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de tabela `bookcustomers`
--
ALTER TABLE `bookcustomers`
  MODIFY `custID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `bookorders`
--
ALTER TABLE `bookorders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;