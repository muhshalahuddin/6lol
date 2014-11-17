-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 17, 2014 at 02:03 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `9gag`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `adminuser` varchar(500) NOT NULL,
  `adminpassword` varchar(999) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminuser`, `adminpassword`) VALUES
(1, 'admin', 'master753');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(500) CHARACTER SET utf8 NOT NULL,
  `description` varchar(250) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cname`, `description`) VALUES
(1, 'Cute', ''),
(2, 'Geeky', ''),
(3, 'MeMe', ''),
(4, 'Food', ''),
(5, 'WTF', ''),
(6, 'Comic', ''),
(7, 'Cool', '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `comment` varchar(999) NOT NULL,
  `date` varchar(500) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(999) NOT NULL,
  `image` varchar(999) NOT NULL,
  `thumb` varchar(999) NOT NULL,
  `video_type` varchar(250) NOT NULL,
  `vine_mp4` varchar(999) NOT NULL,
  `video_url` varchar(999) NOT NULL,
  `video_embed` varchar(999) NOT NULL,
  `type` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  `views` int(250) NOT NULL,
  `cmts` int(11) NOT NULL,
  `date` varchar(500) NOT NULL,
  `active` int(11) NOT NULL,
  `feat` int(11) NOT NULL,
  `time_viewed` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `title`, `image`, `thumb`, `video_type`, `vine_mp4`, `video_url`, `video_embed`, `type`, `catid`, `uid`, `votes`, `views`, `cmts`, `date`, `active`, `feat`, `time_viewed`) VALUES
(3, 'funny', 'funny_3132290327.jpg', '', '', '', '', '', 1, 4, 3, 0, 0, 0, '2014-09-30T17:33:34+08:00', 1, 0, ''),
(4, 'test 2', 'test_2_2244130270.jpg', '', '', '', '', '', 1, 3, 3, 0, 0, 0, '2014-10-06T09:33:03+08:00', 1, 0, ''),
(5, 'SpongeBob', 'spongebob_2326127984.jpg', '', '', '', '', '', 1, 3, 3, 0, 0, 0, '2014-10-06T09:34:10+08:00', 1, 0, ''),
(6, 'ujian', 'ujian_2524882792.jpg', '', '', '', '', '', 1, 3, 3, 0, 0, 0, '2014-10-06T09:34:48+08:00', 1, 0, ''),
(7, 'CETAR!', 'cetar_4757426651.jpg', '', '', '', '', '', 1, 3, 3, 1, 0, 0, '2014-10-06T09:35:30+08:00', 1, 0, ''),
(8, 'Meme', 'meme_1100873718.jpg', '', '', '', '', '', 1, 3, 3, 0, 0, 0, '2014-11-14T13:10:01+07:00', 1, 0, ''),
(9, 'asdasda', 'asdasda_5649214205.jpg', '', '', '', '', '', 1, 2, 3, 4, 0, 0, '2014-11-14T14:52:42+07:00', 1, 0, ''),
(10, 'FileTitle', 'LargeThumb', 'SmallThumb', 'host', '', '$SubmitURL', 'EmbedCode', 0, 0, 0, 0, 0, 0, 'Date', 0, 0, ''),
(12, '.$FileTitle.', '''.$LargeThumb.''', '''.$SmallThumb.''', '.$host.', '', '.$SubmitURL.', '''.$EmbedCode.''', 0, 0, 0, 0, 0, 0, '''.$Date.''', 0, 0, ''),
(13, '.$FileTitle.', '''.$LargeThumb.''', '''.$SmallThumb.''', '.$host.', '', '.$SubmitURL.', '''.$EmbedCode.''', 0, 0, 0, 0, 0, 0, '''.$Date.''', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL,
  `page` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page`) VALUES
(1, 'Website Visitors<br>\r\nLike most website operators, 9GAG collects non-personally-identifying information of the sort that web browsers and servers typically make available, such as the browser type, language preference, referring site, and the date and time of each visitor request. 9GAG’s purpose in collecting non-personally identifying information is to better understand how 9GAG’s visitors use its website. From time to time, 9GAG may release non-personally-identifying information in the aggregate, e.g. by publishing a report on trends in the usage of its website.\r\n<br>\r\n<br>\r\n9GAG also collects potentially personally-identifying information like Internet Protocol (IP) addresses. 9GAG does not use such information to identify its visitors, and does not disclose such information, other than under the same circumstances that it uses and discloses personally-identifying information, as described below.\r\n<br>\r\nGathering of Personally-Identifying Information<br>\r\nCertain visitors to 9GAG’s websites choose to interact with 9GAG in ways that require 9GAG to gather personally-identifying information. The amount and type of information that 9GAG gathers depends on the nature of the interaction. For example, we ask visitors who sign up for 9GAG.com to provide a username and email address. In each case, 9GAG collects such information only insofar as is necessary or appropriate to fulfill the purpose of the visitor’s interaction with 9GAG. 9GAG does not disclose personally-identifying information other than as described below. And visitors can always refuse to supply personally-identifying information, with the caveat that it may prevent them from engaging in certain website-related activities.\r\n<br>\r\nAggregated Statistics<br>\r\n9GAG may collect statistics about the behavior of visitors to its websites. For instance, 9GAG may monitor the most popular collections on 9GAG.com. 9GAG may display this information publicly or provide it to others. However, 9GAG does not disclose personally-identifying information other than as described below.\r\n<br>\r\nProtection of Certain Personally-Identifying Information<br>\r\n9GAG discloses potentially personally-identifying and personally-identifying information only to those of its employees, contractors and affiliated organizations that (i) need to know that information in order to process it on 9GAG’s behalf or to provide services available at 9GAG’s websites, and (ii) that have agreed not to disclose it to others. Some of those employees, contractors and affiliated organizations may be located outside of your home country; by using 9GAG’s websites, you consent to the transfer of such information to them. In addition, in some cases we may choose to buy or sell assets. In these types of transactions, user information is typically one of the business assets that is transferred. Moreover, if 9GAG or substantially all of its assets were acquired, or in the unlikely event that 9GAG goes out of business or enters bankruptcy, user information would be one of the assets that is transferred or acquired by a third party. You acknowledge that such transfers may occur, and that any acquiror of 9GAG may continue to use your personal and non-personal information only as set forth in this policy. Otherwise, 9GAG will not rent or sell potentially personally-identifying and personally-identifying information to anyone.<br>\r\n<br>\r\n<br>\r\nOther than to its employees, contractors and affiliated organizations, as described above, 9GAG discloses potentially personally-identifying and personally-identifying information only when required to do so by law, or when 9GAG believes in good faith that disclosure is reasonably necessary to protect the property or rights of 9GAG, third parties or the public at large. If you are a registered user of a 9GAG website and have supplied your email address, 9GAG may occasionally send you an email to tell you about new features, solicit your feedback, or just keep you up to date with what’s going on with 9GAG and its products. If you send us a request (for example via a support email or via one of our feedback mechanisms), we reserve the right to publish it in order to help us clarify or respond to your request or to help us support other users. 9GAG takes all measures reasonably necessary to protect against the unauthorized access, use, alteration or destruction of potentially personally-identifying and personally-identifying information.\r\n<br>\r\n<br>\r\nYou should also be aware that if you submit information to “chat rooms,” “forums” or “message boards” such information becomes public information, meaning that you lose any privacy rights you might have with regards to that information. Such disclosures may also increase your chances of receiving unwanted communications.\r\n<br>\r\nCookies<br>\r\nA cookie is a string of information that a website stores on a visitor’s computer, and that the visitor’s browser provides to the website each time the visitor returns. 9GAG uses cookies to help 9GAG identify and track visitors, their usage of 9GAG websites, and their website access preferences. 9GAG visitors who do not wish to have cookies placed on their computers should set their browsers to refuse cookies before using 9GAG’s websites, with the drawback that certain features of 9GAG’s websites may not function properly without the aid of cookies.\r\n<br>\r\nAds<br>\r\nAds appearing on any 9GAG websites may be delivered to users by advertising partners, who may set cookies. These cookies allow the ad server to recognize your computer each time they send you an online advertisement to compile information about you or others who use your computer. This information allows ad networks to, among other things, deliver targeted advertisements that they believe will be of most interest to you. This privacy policy covers the use of cookies by 9GAG and does not cover the use of cookies by any advertisers.\r\n<br>\r\nLinks to Third Party Sites<br>\r\nThis privacy policy only applies to information collected by 9GAG. This privacy policy does not apply to the practices of companies that 9GAG does not own or control, or employees that 9GAG does not manage. A 9GAG website may contain links to third party websites. Any information you provide to, or that is collected by, third-party sites may be subject to the privacy policies of those sites, if any. We encourage you to read such privacy policies of any third-party sites you visit. It is the sole responsibility of such third parties to adhere to any applicable restrictions on the disclosure of your personally-identifying information, and 9GAG and its affiliates shall not be liable for wrongful use or disclosure of your personally-identifying information by any third party.\r\n<br>\r\nSecurity<br>\r\nAll non-personally-identifying information, potentially personally-identifying and personally identifying-information described above is stored on restricted database servers.\r\n<br>\r\nChoice/Opt-out<br>\r\nIf we ever send you information by email concerning new products, services or information that you did not expressly request, we will provide you with an email address by which you may request no further notices.\r\n<br>\r\nAddress Book Data<br>\r\nAny external address book data (email contacts, etc.) that a user voluntarily gives 9GAG access to will only be used for the described feature (looking up friends, etc.), and will not be stored or repurposed.\r\n<br>\r\nPrivacy Policy Changes<br>\r\nAlthough most changes are likely to be minor, 9GAG may change its privacy policy from time to time, and in 9GAG’s sole discretion. 9GAG encourages visitors to frequently check this page for any changes to its privacy policy. Your continued use of this site after any change in this privacy policy will constitute your acceptance of such change.<br>'),
(2, ''),
(3, '<br>Accepting the Terms of Service\r\nThe purpose of this website, 9gag.com (the "Site"), owned and operated by 9GAG, Inc, is to provide web publishing services. Please read these terms of service ("Agreement") carefully before using the Site or any services provided on the Site (collectively, "Services"). By using or accessing the Services, you agree to become bound by all the terms and conditions of this Agreement. If you do not agree to all the terms and conditions of this Agreement, do not use the Services. The Services are accessed by You ("Subscriber" or "You") under the following terms and conditions:\r\n<br>\r\n<br>\r\n<br><h1> 1. Access to the Services </h1><br>\r\nSubject to the terms and conditions of this Agreement, 9GAG, Inc may offer to provide the Services, as described more fully on the Site, and which are selected by Subscriber, solely for Subscriber''s own use, and not for the use or benefit of any third party. Services shall include, but not be limited to, any services 9GAG, Inc performs for Subscriber, as well as the offering of any Content (as defined below) on the Site. 9GAG, Inc may change, suspend or discontinue the Services at any time, including the availability of any feature, database, or Content. 9GAG, Inc may also impose limits on certain features and services or restrict Subscriber''s access to parts or all of the Services without notice or liability. 9GAG, Inc reserves the right, at its discretion, to modify these Terms of Service at any time by posting revised Terms of Service on the Site and by providing notice via e-mail, where possible, or on the Site. Subscriber shall be responsible for reviewing and becoming familiar with any such modifications. Use of the Services by Subscriber following such modification constitutes Subscriber''s acceptance of the terms and conditions of this Agreement as modified.\r\n<br>\r\nSubscriber certifies to 9GAG, Inc that if Subscriber is an individual (i.e., not a corporate entity), Subscriber is at least 13 years of age. No one under the age of 13 may provide any personal information to or on 9GAG, Inc (including, for example, a name, address, telephone number or email address). Subscriber also certifies that it is legally permitted to use the Services and access the Site, and takes full responsibility for the selection and use of the Services and access of the Site. This Agreement is void where prohibited by law, and the right to access the Site is revoked in such jurisdictions. 9GAG, Inc makes no claim that the Site may be lawfully viewed or that Content may be downloaded outside of Hong Kong. Access to the Content may not be legal by certain persons or in certain countries. If You access the Site from outside Hong Kong, You do so at Your own risk and You are responsible for compliance with the laws of Your jurisdiction.\r\n<br>\r\n9GAG, Inc will use reasonable efforts to ensure that the Site and Services are available twenty-four hours a day, seven days a week. However, there will be occasions when the Site and/or Services will be interrupted for maintenance, upgrades and repairs or due to failure of telecommunications links and equipment. Every reasonable step will be taken by 9GAG, Inc to minimize such disruption where it is within 9GAG, Inc''s reasonable control.\r\n<br>\r\nYou agree that neither 9GAG, Inc nor the Site will be liable in any event to you or any other party for any suspension, modification, discontinuance or lack of availability of the Site, the service, your Subscriber Content or other Content.\r\n<br>\r\n9GAG, Inc retains the right to create limits on use and storage in its sole discretion at any time with or without notice.\r\n<br>\r\nSubscriber shall be responsible for obtaining and maintaining any equipment or ancillary services needed to connect to, access the Site or otherwise use the Services, including, without limitation, modems, hardware, software, and long distance or local telephone service. Subscriber shall be responsible for ensuring that such equipment or ancillary services are compatible with the Services.\r\n<br>\r\n<br><h1>2. Site Content</h1><br>\r\nThe Site and its contents are intended solely for the use of 9GAG, Inc Subscribers and may only be used in accordance with the terms of this Agreement. All materials displayed or performed on the Site, including, but not limited to text, graphics, logos, tools, photographs, images, illustrations, software or source code, audio and video, animations and Themes (as defined below), including without limitation the 9GAG, Inc Template Code (as defined below) (collectively, "Content") (other than Content posted by Subscriber ("Subscriber Content")) are the property of 9GAG, Inc and/or third parties and are protected by Hong Kong and international copyright laws. The 9GAG, Inc API shall be used solely pursuant to the terms of the API Terms of Service. All trademarks, service marks, and trade names are proprietary to 9GAG, Inc and/or third parties. Subscriber shall abide by all copyright notices, information, and restrictions contained in any Content accessed through the Services.\r\n<br>\r\nThe Site is protected by copyright as a collective work and/or compilation, pursuant to Hong Kong copyright laws, international conventions, and other copyright laws. Other than as expressly set forth in this Agreement, Subscriber may not copy, modify, publish, transmit, upload, participate in the transfer or sale of, reproduce (except as provided in this Section), create derivative works based on, distribute, perform, display, or in any way exploit, any of the Content, software, materials, or Services in whole or in part.\r\n<br>\r\nSubscriber may download or copy the Content, and other items displayed on the Site for download, for personal use only, provided that Subscriber maintains all copyright and other notices contained in such Content. Downloading, copying, or storing any Content for other than personal, noncommercial use is expressly prohibited without prior written permission from 9GAG, Inc, or from the copyright holder identified in such Content''s copyright notice. In the event You download software from the Site, the software, including any files, images incorporated in or generated by the software, and the data accompanying the software (collectively, the "Software") is licensed to You by 9GAG, Inc or third party licensors for Your personal, noncommercial use, and no title to the Software shall be transferred to You. You may own the Subscriber Content on which the Software is recorded, but 9GAG, Inc or third party licensors retain full and complete title to the Software and all intellectual property rights therein.\r\n<br>\r\n<br><h1>3. Subscriber Content</h1><br>\r\nSubscriber shall own all Subscriber Content that Subscriber contributes to the Site, but hereby grants and agrees to grant 9GAG, Inc a non-exclusive, worldwide, royalty-free, transferable right and license (with the right to sublicense), to use, copy, cache, publish, display, distribute, modify, create derivative works and store such Subscriber Content and to allow others to do so ("Content License") in order to provide the Services. On termination of Subscriber''s membership to the Site and use of the Services, 9GAG, Inc shall make all reasonable efforts to promptly remove from the Site and cease use of the Subscriber Content; however, Subscriber recognizes and agrees that caching of or references to the Subscriber Content may not be immediately removed. Subscriber warrants, represents and agrees Subscriber has the right to grant 9GAG, Inc and the Site the rights set forth above. Subscriber represents, warrants and agrees that it will not contribute any Subscriber Content that (a) infringes, violates or otherwise interferes with any copyright or trademark of another party, (b) reveals any trade secret, unless Subscriber owns the trade secret or has the owner''s permission to post it, (c) infringes any intellectual property right of another or the privacy or publicity rights of another, (d) is libelous, defamatory, abusive, threatening, harassing, hateful, offensive or otherwise violates any law or right of any third party, (e) contains a virus, trojan horse, worm, time bomb or other computer programming routine or engine that is intended to damage, detrimentally interfere with, surreptitiously intercept or expropriate any system, data or information, or (f) remains posted after Subscriber has been notified that such Subscriber Content violates any of sections (a) to (e) of this sentence. 9GAG, Inc reserves the right to remove any Subscriber Content from the Site, suspend or terminate Subscriber''s right to use the Services at any time, or pursue any other remedy or relief available to 9GAG, Inc and/or the Site under equity or law, for any reason (including, but not limited to, upon receipt of claims or allegations from third parties or authorities relating to such Subscriber Content or if 9GAG, Inc is concerned that Subscriber may have breached the immediately preceding sentence), or for no reason at all.\r\n<br>\r\n<br><h1>4. Restrictions</h1><br>\r\nSubscriber is responsible for all of its activity in connection with the Services and accessing the Site. Any fraudulent, abusive, or otherwise illegal activity or any use of the Services or Content in violation of this Agreement may be grounds for termination of Subscriber''s right to Services or to access the Site. Subscriber may not post or transmit, or cause to be posted or transmitted, any communication or solicitation designed or intended to obtain password, account, or private information from any 9GAG, Inc user.\r\n<br>\r\nUse of the Site or Services to violate the security of any computer network, crack passwords or security encryption codes, transfer or store illegal material including that are deemed threatening or obscene, or engage in any kind of illegal activity is expressly prohibited. Under no circumstances will Subscriber use the Site or the Service to (a) send unsolicited e-mails, bulk mail, spam or other materials to users of the Site or any other individual, (b) harass, threaten, stalk or abuse any person or party, including other users of the Site, (c) create a false identity or to impersonate another person, or (d) post any false, inaccurate or incomplete material or delete or revise any material that was not posted by You.\r\n<br>\r\n<br><h1>5. Warranty disclaimer</h1><br>\r\n9GAG, Inc has no special relationship with or fiduciary duty to Subscriber. Subscriber acknowledges that 9GAG, Inc has no control over, and no duty to take any action regarding: which users gains access to the Site; which Content Subscriber accesses via the Site; what effects the Content may have on Subscriber; how Subscriber may interpret or use the Content; or what actions Subscriber may take as a result of having been exposed to the Content. Much of the Content of the Site is provided by and is the responsibility of the user or subscriber who posted the Content. 9GAG, Inc does not monitor the Content of the Site and takes no responsibility for such Content. Subscriber releases 9GAG, Inc from all liability for Subscriber having acquired or not acquired Content through the Site. The Site may contain, or direct Subscriber to sites containing, information that some people may find offensive or inappropriate. 9GAG, Inc makes no representations concerning any content contained in or accessed through the Site, and 9GAG, Inc will not be responsible or liable for the accuracy, copyright compliance, legality or decency of material contained in or accessed through the Site.\r\n<br>\r\nAlthough 9GAG, Inc and the Site will make reasonable efforts to store and preserve the material residing on the Site, neither 9GAG, Inc nor the Site is responsible or liable in any way for the failure to store, preserve or access Subscriber Content or other materials you transmit or archive on the Site. You are strongly urged to take measures to preserve copies of any data, material, content or information you post or upload on the Site. You are solely responsible for creating back-ups of your Subscriber Content.\r\n<br>\r\nThe Services, Content, Site and any Software are provided on an "as is" basis, without warranties of any kind, either express or implied, including, without limitation, implied warranties of merchantability, fitness for a particular purpose or non-infringement. 9GAG, Inc makes no representations or warranties of any kind with respect to the Site, the Services, including any representation or warranty that the use of the Site or Services will (a) be timely, uninterrupted or error-free or operate in combination with any other hardware, software, system or data, (b) meet your requirements or expectations, (c) be free from errors or that defects will be corrected, (d) be free of viruses or other harmful components.\r\n<br>\r\nTo the fullest extent allowed by law, 9GAG, Inc disclaims any liability or responsibility for the accuracy, reliability, availability, completeness, legality or operability of the material or services provided on this Site. By using this Site, you acknowledge that 9GAG, Inc is not responsible or liable for any harm resulting from (1) use of the Site; (2) downloading information contained on the Site including but not limited to downloads of content posted by subscribers; (3) unauthorized disclosure of images, information or data that results from the upload, download or storage of content posted by subscribers; (4) the temporary or permanent inability to access or retrieve any Subscriber Content from the Site, including, without limitation, harm caused by viruses, worms, trojan horses, or any similar contamination or destructive program.\r\n<br>\r\nSome places do not allow limitations on how long an implied warranty lasts, so the above limitations may not apply to Subscriber.\r\n<br>\r\n<br><h1>6. Third party websites</h1><br>\r\nUsers of the Site may gain access from the Site to third party sites on the Internet through hypertext or other computer links on the Site. Third party sites are not within the supervision or control of 9GAG, Inc or the Site. Unless explicitly otherwise provided, neither 9GAG, Inc nor the Site make any representation or warranty whatsoever about any third party site that is linked to the Site, or endorse the products or services offered on such site. 9GAG, Inc and the Site disclaim: (a) all responsibility and liability for content on third party websites and (b) any representations or warranties as to the security of any information (including, without limitation, credit card and other personal information) You might be requested to give any third party, and You hereby irrevocably waive any claim against the Site or 9GAG, Inc with respect to such sites and third party content.\r\n<br>\r\n<br><h1>7. Registration and security</h1><br>\r\nAs a condition to using Services, Subscriber will be required to register with 9GAG, Inc and select a password and 9GAG, Inc URL. Subscriber shall provide 9GAG, Inc with accurate, complete, and updated registration information, including Subscriber''s e-mail address. Failure to do so shall constitute a breach of this Agreement, which may result in immediate termination of Subscriber''s account. Subscriber may not (a) select or use as a 9GAG, Inc URL a name of another person with the intent to impersonate that person; or (b) use as a 9GAG, Inc URL a name subject to any rights of a person other than Subscriber without appropriate authorization. 9GAG, Inc reserves the right to refuse registration of, or cancel a 9GAG, Inc URL in its discretion. Subscriber shall be responsible for maintaining the confidentiality of Subscriber''s 9GAG, Inc password. Subscriber is solely responsible for any use of or action taken under Subscriber''s password and accepts full responsibility for all activity conducted through Subscriber''s account and agrees to and hereby releases the Site and 9GAG, Inc from any and all liability concerning such activity. Subscriber agrees to notify 9GAG, Inc immediately of any actual or suspected loss, theft, or unauthorized use of Subscriber''s account or password. The Site will take reasonably security precautions when using the internet, telephone or other means to transport date or other communications, but expressly disclaims any and all liability for the accessing of any such data communications by unauthorized persons or entities.\r\n<br>\r\n<br><h1>8. Indemnity</h1><br>\r\nSubscriber will indemnify and hold 9GAG, Inc, its directors, officers and employees, harmless, including costs and attorneys'' fees, from any claim or demand made by any third party due to or arising out of Subscriber''s access to the Site, use of the Services, the violation of this Agreement by Subscriber, or the infringement by Subscriber, or any third party using the Subscriber''s account, of any intellectual property or other right of any person or entity.\r\n<br>\r\n<br><h1>9. Limitation of liability</h1><br>\r\nIn no event shall 9GAG, Inc, its directors, officers, shareholders, employees or members be liable with respect to the Site or the Services for (a) any indirect, incidental, punitive, or consequential damages of any kind whatsoever; (b) damages for loss of use, profits, data, images, Subscriber Content or other intangibles; (c) damages for unauthorized use, non-performance of the Site, errors or omissions; or (d) damages related to downloading or posting Content. 9GAG, Inc''s and the Site''s collective liability under this agreement shall be limited to three hundred U.S. Dollars. Some places do not allow the exclusion or limitation of incidental or consequential damages, so the above limitations and exclusions may not apply to Subscriber.\r\n<br>\r\n<br><h1>10. Fees and payment</h1><br>\r\nSome of the Services require payment of fees. All fees are stated in U.S. dollars. Subscriber shall pay all applicable fees, as described on the Site in connection with such Services selected by Subscriber, and any related taxes or additional charges. All fees are non-refundable unless expressly stated otherwise on the Site. Subscriber represents to 9GAG, Inc that Subscriber is the authorized account holder or an authorized user of the chosen method of payment used to pay for the paid aspects of the Services. All fee-based Services and virtual goods are provided "AS IS" with no warranties of any kind. 9GAG, Inc may modify and/or eliminate such fee-based Services at its discretion. Subscriber understands and agrees that the payment for virtual goods grants Subscriber a limited license to use the virtual goods as specified on the Site.\r\n<br>\r\n9GAG, Inc may change its prices at any time but will provide you reasonable notice of any such changes by posting the new prices on the Site and by sending you email notification. If you do not wish to pay the new prices, you may cancel the services prior to the change going into effect.\r\n<br>\r\n<br><h1>11. Termination</h1><br>\r\nEither party may terminate the Services at any time by notifying the other party by any means. 9GAG, Inc may also terminate or suspend any and all Services and access to the Site immediately, without prior notice or liability, if Subscriber breaches any of the terms or conditions of this Agreement. Upon termination of Subscriber''s account, Subscriber''s right to use the Services, access the Site, and any Content will immediately cease. All provisions of this Agreement which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, and limitations of liability. Termination of Your access to and use of the Site and the Services shall not relieve Subscriber of any obligations arising or accruing prior to such termination or limit any liability which Subscriber otherwise may have to 9GAG, Inc or the Site, including without limitation any indemnification obligations contained herein.\r\n<br>\r\n<br><h1>12. Privacy</h1><br>\r\nPlease review our Privacy Policy, which governs the use of personal information on the Site and to which Subscriber agrees to be bound as a user of the Site.\r\n<br>\r\n<br><h1>13. Miscellaneous</h1><br>\r\nThis Agreement (including the Privacy Policy), as modified from time to time, constitutes the entire agreement between You, the Site and 9GAG, Inc with respect to the subject matter hereof. This Agreement replaces all prior or contemporaneous understandings or agreements, written or oral, regarding the subject matter hereof. The failure of either party to exercise in any respect any right provided for herein shall not be deemed a waiver of any further rights hereunder. 9GAG, Inc shall not be liable for any failure to perform its obligations hereunder where such failure results from any cause beyond 9GAG, Inc''s reasonable control, including, without limitation, mechanical, electronic or communications failure or degradation. If any provision of this Agreement is found to be unenforceable or invalid, that provision shall be limited or eliminated to the minimum extent necessary so that this Agreement shall otherwise remain in full force and effect and enforceable. This Agreement is not assignable, transferable or sublicensable by Subscriber except with 9GAG, Inc''s prior written consent. 9GAG, Inc may assign this Agreement in whole or in part at any time without Subscriber''s consent. This Agreement shall be governed by and construed in accordance with the laws of the state of Delaware without regard to the conflict of laws provisions thereof. No agency, partnership, joint venture, or employment is created as a result of this Agreement and Subscriber does not have any authority of any kind to bind 9GAG, Inc in any respect whatsoever.\r\n<br>\r\n<br><h1>14. Notice and Procedure for Making Claims of Copyright or Other Intellectual Property Infringements</h1><br>\r\n9GAG respects the intellectual property of others and takes the protection of copyrights and all other intellectual property very seriously, and we ask our users to do the same. Infringing activity will not be tolerated on or through the Services.\r\n<br>\r\n9GAG''s intellectual property policy is to (a) remove material that 9GAG believes in good faith, upon notice from an intellectual property owner or their agent, is infringing the intellectual property of a third party by being made available through the Services, and (b) remove any Subscriber Content posted to the Services by "repeat infringers." 9GAG considers a "repeat infringer" to be any user that has uploaded Subscriber Content to the Services and for whom 9GAG has received more than two takedown notices compliant with the provisions of 17 U.S.C. § 512(c) with respect to such Subscriber Content. 9GAG has discretion, however, to terminate the account of any user after receipt of a single notification of claimed infringement or upon 9GAG''s own determination.\r\n<br>\r\nProcedure for Reporting Claimed Infringement\r\n<br>\r\nIf you believe that any content made available on or through the Services has been used or exploited in a manner that infringes an intellectual property right you own or control, then please promptly send a "Notification of Claimed Infringement" containing the following information to the Designated Agent identified below. Your communication must include substantially the following:\r\n<br>\r\n- A physical or electronic signature of a person authorized to act on behalf of the owner of the work(s) that has/have been allegedly infringed;\r\n<br>\r\n- Identification of works or materials being infringed, or, if multiple works are covered by a single notification, a representative list of such works;\r\n<br>\r\n- Identification of the specific material that is claimed to be infringing or to be the subject of infringing activity and that is to be removed or access to which is to be disabled, and information reasonably sufficient to permit 9GAG to locate the material;\r\n<br>\r\n- Information reasonably sufficient to permit 9GAG to contact you, such as an address, telephone number, and, if available, an electronic mail address at which you may be contacted;\r\n<br>\r\n- A statement that you have a good faith belief that the use of the material in the manner complained of is not authorized by the copyright owner, its agent, or the law; and\r\n<br>\r\n- A statement that the information in the notification is accurate, and under penalty of perjury, that you are authorized to act on behalf of the owner of an exclusive right that is allegedly infringed.\r\n<br>\r\nYou should consult with your own lawyer and/or see 17 U.S.C. § 512 to confirm your obligations to provide a valid notice of claimed infringement.'),
(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce porttitor\r\n lobortis tortor sit amet auctor. Praesent pretium, leo eget luctus \r\ntempor, lectus erat vulputate libero, in viverra dolor velit quis ante. \r\nVivamus viverra pulvinar sollicitudin. Vivamus dictum orci sed lorem \r\nvenenatis quis rutrum risus dictum. Ut non enim elit. In consectetur, \r\nnibh sed iaculis pellentesque, nisi ligula egestas enim, sagittis \r\nfermentum nulla nisl sit amet velit. Aliquam erat volutpat. Suspendisse \r\nac mi tortor, at vestibulum augue. Suspendisse ut nisl quam, euismod \r\nscelerisque urna. Donec non leo et nisi tempus fermentum. Cum sociis \r\nnatoque penatibus et magnis dis parturient montes, nascetur ridiculus \r\nmus. Donec gravida sodales est vitae tincidunt.<br><br>Curabitur neque \r\ndui, adipiscing a dignissim sed, congue ut sem. Vivamus eget tellus \r\nlectus. Nullam ut tempus purus. Vestibulum pellentesque lorem nec velit \r\nhendrerit porta. Cras sit amet mauris odio. Sed sit amet libero nec \r\nipsum venenatis interdum. Class aptent taciti sociosqu ad litora \r\ntorquent per conubia nostra, per inceptos himenaeos. Sed at ligula eu \r\nenim congue molestie. Lorem ipsum dolor sit amet, consectetur adipiscing\r\n elit. Praesent tincidunt diam at metus facilisis aliquam. Vivamus a \r\norci nunc, molestie consectetur purus. Vivamus aliquam, diam eu rhoncus \r\nmollis, est lorem aliquam neque, elementum molestie sapien velit id \r\nsapien. Maecenas quis dolor nisl.<br><br>Morbi nisi quam, suscipit eu \r\naccumsan a, porttitor sed risus. Donec laoreet, dolor semper eleifend \r\nsodales, erat lacus pretium velit, vitae dignissim felis risus non \r\nmagna. Suspendisse potenti. Proin at nulla massa, et dictum magna. Lorem\r\n ipsum dolor sit amet, consectetur adipiscing elit. Integer pharetra, \r\npurus vel egestas egestas, orci lectus vehicula quam, non placerat massa\r\n lacus id justo. Integer posuere laoreet porttitor.<br><br>Nam nulla \r\nmetus, rutrum in suscipit ac, hendrerit eget nunc. In hac habitasse \r\nplatea dictumst. Mauris at justo magna. Class aptent taciti sociosqu ad \r\nlitora torquent per conubia nostra, per inceptos himenaeos. Duis \r\nmalesuada ultricies hendrerit. Vivamus ullamcorper consectetur \r\ndignissim. Praesent nunc lorem, elementum vitae scelerisque vitae, \r\npellentesque quis ipsum. Cras volutpat, erat eu mollis pulvinar, justo \r\nlibero dictum leo, ac accumsan tellus ipsum eget magna. Suspendisse \r\ntristique mauris nec odio fringilla sagittis. Donec rhoncus euismod \r\ntortor, nec commodo magna cursus at. Nunc ut euismod dui. Suspendisse \r\nsollicitudin, magna eget auctor euismod, dolor mi aliquet tellus, et \r\nsuscipit dui est nec odio. Aliquam rutrum tellus in nisi ultricies sed \r\nelementum nisi molestie. Praesent sit amet ligula id lorem ultrices \r\ntristique.<br><br>Suspendisse potenti. Sed urna est, fringilla a \r\ncondimentum eu, dapibus et erat. Cras ac aliquet erat. Integer eget \r\nrisus magna, non egestas nulla. Maecenas ut ante tortor. Pellentesque \r\nhabitant morbi tristique senectus et netus et malesuada fames ac turpis \r\negestas. Morbi vel eros nec quam cursus porttitor et nec orci. Nulla vel\r\n odio sit amet nisi feugiat dignissim. Mauris tincidunt enim quam, non \r\npharetra risus. Sed sed mi nulla, sit amet aliquam ipsum. Ut faucibus \r\nvestibulum feugiat. Nulla ut dui eget massa pellentesque scelerisque. \r\nAenean ut ipsum at orci lacinia mollis id nec urna. Proin eros dui, \r\nfeugiat vitae adipiscing ut, rutrum vitae quam. Nam et convallis augue. \r\nQuisque ut odio eu ante consequat elementum. <br>');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(1) NOT NULL,
  `name` varchar(100) NOT NULL,
  `siteurl` varchar(500) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `descrp` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fbapp` varchar(500) NOT NULL,
  `active` int(11) NOT NULL,
  `open_posts` int(11) NOT NULL,
  `fbpage` varchar(900) NOT NULL,
  `twitter` varchar(500) NOT NULL,
  `gplus` varchar(500) NOT NULL,
  `template` varchar(255) NOT NULL,
  `site_hits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `siteurl`, `keywords`, `descrp`, `email`, `fbapp`, `active`, `open_posts`, `fbpage`, `twitter`, `gplus`, `template`, `site_hits`) VALUES
(1, '6lol - Why so serius?', 'localhost/DDA/6lol/', 'meme, lol, fun, wtf', 'a funny website bro!', 'isal.maarif@gmail.com', 'Facebook App Id', 1, 1, 'Facebook Fan Page URL', 'Twitter URL', 'Google + URL', 'default', 3665);

-- --------------------------------------------------------

--
-- Table structure for table `siteads`
--

CREATE TABLE IF NOT EXISTS `siteads` (
  `id` int(11) NOT NULL,
  `ad1` varchar(500) NOT NULL,
  `ad2` varchar(500) NOT NULL,
  `ad3` varchar(999) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `siteads`
--

INSERT INTO `siteads` (`id`, `ad1`, `ad2`, `ad3`) VALUES
(1, '<script type="text/javascript"><!--\r\ngoogle_ad_client = "ca-pub-9634676781117222";\r\n/* 300x250, created 9/4/10 */\r\ngoogle_ad_slot = "2205194959";\r\ngoogle_ad_width = 300;\r\ngoogle_ad_height = 250;\r\n//-->\r\n</script>\r\n<script type="text/javascript"\r\nsrc="//pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', '<script type="text/javascript"><!--\r\ngoogle_ad_client = "ca-pub-9634676781117222";\r\n/* 300x250, created 9/4/10 */\r\ngoogle_ad_slot = "2205194959";\r\ngoogle_ad_width = 300;\r\ngoogle_ad_height = 250;\r\n//-->\r\n</script>\r\n<script type="text/javascript"\r\nsrc="//pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', '<script type="text/javascript"><!--\r\ngoogle_ad_client = "ca-pub-9634676781117222";\r\n/* answers */\r\ngoogle_ad_slot = "7102746441";\r\ngoogle_ad_width = 728;\r\ngoogle_ad_height = 90;\r\n//-->\r\n</script>\r\n<script type="text/javascript"\r\nsrc="//pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(500) CHARACTER SET utf8 NOT NULL,
  `country` varchar(500) CHARACTER SET utf8 NOT NULL,
  `gender` varchar(500) CHARACTER SET utf8 NOT NULL,
  `birthday` varchar(500) CHARACTER SET utf8 NOT NULL,
  `password` varchar(999) CHARACTER SET utf8 NOT NULL,
  `avatar` varchar(500) CHARACTER SET utf8 NOT NULL,
  `about` varchar(999) CHARACTER SET utf8 NOT NULL,
  `reg_date` varchar(500) CHARACTER SET utf8 NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `email`, `country`, `gender`, `birthday`, `password`, `avatar`, `about`, `reg_date`, `points`) VALUES
(1, 'Max', 'info@flippyscripts.com', 'Sri Lanka', '', '', 'a9575efd6da5a277322853c68081ab88', '14020407841.jpg', 'My Funny Collection	', 'June 5, 2014', 0),
(2, 'Flippy', 'sales@flippyscripts.com', 'Sri Lanka', '', '', 'a9575efd6da5a277322853c68081ab88', '', 'My Funny Collection	', 'June 6, 2014', 0),
(3, 'isalmaarif', 'isal@gmail.com', 'Indonesia', '', '', '1017cee7ee892dc7a8351bfe954801e2', '', 'My Funny Collection	', 'September 30, 2014', 0),
(4, 'blabla', 'blabla@gmail.com', 'Indonesia', '', '', '1017cee7ee892dc7a8351bfe954801e2', '', 'My Funny Collection	', 'September 30, 2014', 0),
(5, 'jika', 'jika@gmail.com', 'Indonesia', '', '', '1017cee7ee892dc7a8351bfe954801e2', '', 'My Funny Collection	', 'September 30, 2014', 0),
(7, 'alien', 'ali@firzil.co.id', 'indonesia', 'srilangka', '10-11-1992', 'admin123', 'admin.jpg', 'tentang', '2014-10-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `votecmt`
--

CREATE TABLE IF NOT EXISTS `votecmt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `cmt_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `voteip`
--

CREATE TABLE IF NOT EXISTS `voteip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(500) CHARACTER SET utf8 NOT NULL,
  `media_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
