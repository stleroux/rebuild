-- Adminer 4.3.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_eng` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_fre` text COLLATE utf8mb4_unicode_ci,
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `articles_user_id_foreign` (`user_id`),
  KEY `articles_category_id_foreign` (`category_id`),
  CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `articles` (`id`, `user_id`, `category_id`, `title`, `description_eng`, `description_fre`, `views`, `created_at`, `updated_at`, `published_at`, `deleted_at`) VALUES
(1, 2,  7,  'Add new user to RM Admin list LIST', '\n<p>Do not send e-mail to Darcy Halverson.</p><p>Create an Assyst ticket or if one already <strong>exists</strong>, assign the ticket to Account Management group Group name : Ent\\sccm-rm10</p>\n', '<p>French</p><p>line one</p><p>line two</p>',  0,  '2017-01-01 05:00:00',  '2018-02-14 20:04:40',  '2018-02-14 15:04:40',  NULL),
(2, 2,  7,  'Adding multiple trustees to multiple documents', '\n<p>You can assign the rights you need to your documents by doing the following:</p>\n<ul>\n<li>In EKME, do a profile search where you are the author Select All (Ctrl-A) the documents and then right click and select Profile</li>\n<li>Click on the Security button at the bottom of the page</li>\n<li>Select All-Tous in the top left box, then find whoever you need to provide rights to in the second section on the left</li>\n<li>Click the &gt;&gt; button to add the people to the list of current trustees</li>\n<li>By default, this action will provide the user Full Control over the documents</li>\n<li>Review the Trustee list and the associated rights and click on the Next button</li>\n<li>After a few moments, you will get a pop up window indicating how many records were successfully updated</li>\n<li>If there are any errors, take note of the document numbers. These will have to be dealt with on an individual basis</li>\n</ul>\n',  '<p>French text goes here</p>', 0,  '2017-01-01 05:00:00',  NULL, NULL, NULL),
(3, 2,  7,  'Adding new Sector - Directorate or Branch',  '\n<p>Region -&gt; MECTS_REGION<br /> Sector -&gt; Mects Sector<br /> Directorate -&gt; MECTS RC DG<br /> Branch -&gt; MECTS RC DIR</p>\n<p>Example: Create the Sector, Directorate and Branch Region: National - Nationale</p>\n<p>Sector: Human resources and Corporate Services - Ressources humains et Serv integres de gestion<br /> Directorate: Human Resources - Ressources humaines<br /> Branch: Staff Rel/Classif/Compensa</p>\n<p>1. Find the region_id value National region in MECTS_REGION -&gt; 0</p>\n<p>2. Go to the Mects Sector table and copy an existing entry from the same region -&gt; Cohen Inquiry Secretariat</p>\n<p>3. Create a new entry in the Mects Sector table</p>\n<ul>\n<li>Human resources and Corporate Services</li>\n<li>Sector Id: make it up</li>\n<li>Region Id: 0 (from step 1)</li>\n<li>Rc: 60002 (needs to be unique)</li>\n<li>Parent RC : blank</li>\n</ul>\n<p>4. Create a new entry in the Mects RC DG table --&gt; Human Resources &lt;-- -&gt; Rc: 60021 (needs to be unique) -&gt; Parent RC: 60002</p>\n<p>5. Create a new entry in Mects RC DIR table --&gt; Staff Rel/Classif/Compensa &lt;-- -&gt; Rc: 60022 (needs to be unique) -&gt; Parent RC: 60021</p>\n<p>6. Start -&gt; DM Server Manager -&gt; Caches tab -&gt; Refresh All</p>\n<p>7. Test in EKME to make sure the changes are valid 8. Advise user that changes have been done and to go to the Options menu in EKME and click on Refresh Cache to see the changes</p>\n', '', 0,  '2017-01-01 05:00:00',  NULL, NULL, NULL),
(4, 2,  7,  'Disabled Items', '\n<p>Open the application in question (Word, Excel, etc) from your desktop and then go to the File tab.<br />Then click on Options -&gt; Add-Ins.<br />At the bottom of the page is a dropdown called Manage.<br /> Select Disabled Items from the dropdown and click on the Go button.<br /> Enable all items listed here.<br /> Close the application and try to open your document again.</p>\n', '', 17, '2016-11-08 19:01:27',  '2018-02-14 20:04:41',  '2018-02-14 15:04:41',  NULL),
(5, 1,  7,  'Unable to connect to EKME',  '\nCan you try the following :\n\n-> Click on the Start button\n-> Go to All Programs\n-> click on Open Text\n-> Click on DM Connection Wizard\n\nServer Name : VSONKENEDOCS01\n\nIf there is nothing listed in the Server Name box\n-> Enter the server name above in the Server Name box\n-> Click Next\n-> Click Finish\n\nIf the server(s) is/are listed in the Previously Connected DM section\n-> Select the server for your region\n-> Click Next\n-> Click Finish\n', '', 0,  '2016-11-08 19:02:03',  NULL, NULL, NULL),
(6, 2,  7,  'Error code 9007',  '\nRun connection wizard\n---------------------------------------------\nStart\nAll Programs\nOpen Text\nDM Connection Wizard\nClick Next\nClick Finish\n\n\nTry a Repair on EKME\n---------------------------------------------\nStart -> Control Panel -> Programs and Features -> Open Text eDOCS DM\nClick on Repair button in toolbar at top of screen\n', '', 0,  '2016-11-09 14:48:07',  NULL, NULL, NULL),
(7, 1,  7,  'File recovery to SSC', '\n<p>Assign ticket to Shard Services and add the following info to the ticket :</p>\n<p>Hi ,</p>\n<p>I have requested a file restore from SSC based on the following information :</p>\n<p>Department : Department of Fisheries and Oceans<br />Internal ticket number : <br />EKME document number : <br />EKME document version : <br />Restore from date : <br />Location of file :&nbsp;</p>\n<p>Note that it may take a few days for the restore to occur.<br />Once the file has been restored, someone from SSC will be contacting you.</p>\n', '', 0,  '2016-11-09 15:03:31',  '2018-02-14 20:04:41',  '2018-02-14 15:04:41',  NULL),
(8, 2,  7,  'Group name change in EKME',  '\nIf a user requests to have some group names and IDs changed in EKME\n-> OK to change group ID as long has users are informed they will have to update their default profile\n\nexec [docsadm].[sp_Transfer_Access] \'old_group_system_id\',\'new_group_system_id\';\n\nMake sure to disable the old groups after the scripts are ran\n', '', 0,  '2016-11-09 20:06:54',  NULL, NULL, NULL),
(9, 2,  7,  'Missing CCM Enterprise menu',  '\n<p>Can you check the following?</p>\n<p>Step 1 : Verify the version of EKME installed on the machine<br /> - Open EKME<br /> - Go to the Help menu<br /> - Select About eDOCS DM<br /> - Note the version number</p>\n<p>If the version is 5.3.1 (EKME2), proceed to Step 2<br />If the version is 10.0.0 (EKME 10), go to Step 3<br />If EKME is not installed on the machine, go to step 5</p>\n<p>Step 2 : Uninstalling EKME 5.3.1<br /> - Close ALL applications on the machine<br /> - Go to the Start menu<br /> - Click on Control Panel<br /> - Click on Programs and Features<br /> - Find eDocs ccm client and select it (may not be installed)<br /> - Click Uninstall at the top of the window<br /> - Find OpenText eDOCS RM 5.3.1 Admin Tool and select it (may not be installed)<br /> - Click Uninstall at the top of the window<br /> - Wait for the popup window that indicates the application was removed successfully<br /> - Click OK<br /> - Find OpenText eDOCS DM 5.3.1 Extensions (x64) and select it<br /> - Click Uninstall at the top of the window<br /> - Wait for the popup window that indicates the application was removed successfully<br /> - Click OK<br /> - Go to Step 4</p>\n<p>Step 3 : Installing the ccmEnterprise menu in EKME<br /> - Close ALL applications on the machine<br /> - Open the Application Catalog<br /> - Find GCCMS &ndash; SGCGS and click on the Install button on the bottom right of the window<br /> - Wait for a pop up message that indicates the application was installed successfully.<br /> o If you get a message that says the application is already installed, please go to Step 5<br />- Reboot the machine<br /> - Try EKME</p>\n<p>Step 4 : Installing EKME 10<br /> - Close ALL applications on the machine<br /> - Open the Application Catalog<br /> - Find EKME10 - MGCE10 and select it<br /> - Click on the Install button on the bottom right<br /> - Wait for the popup window that confirms EKME was installed successfully<br /> - Click OK<br /> - Reboot the machine<br /> If you require the ccmEnterprise menu in EKME, go to step 3</p>\n<p>Step 5 : Uninstalling ccm eDOCS Client<br /> - Close ALL applications on the machine<br /> - Go to Start<br /> - Click on Control Panel<br /> - Click on Program and Features<br /> - Find ccmEdocs client<br /> - Click Uninstall at the top of the window<br /> - Wait for the popup window that indicates the application was removed successfully<br /> - Click OK<br /> - Go to Step 3</p>\n', '', 0,  '2016-11-09 20:13:43',  NULL, NULL, NULL),
(10,  1,  7,  'Invalid security token', '\nCan you try the following to resolve your EKME issue?\n\n- Close all open applications on the machine\n- Go to the Start menu\n- Click on Control Panel\n- Click on Programs and Features\n- Find OpenText eDOCS RM 5.3.1 Admin Tool and select it (if present)\n- Click on the Uninstall button\n-  Find OpenText eDOCS DM 5.3.1 Patch 1 Extensions and select it\n-  Click on the Uninstall button\n-  Once uninstalled, log off/in to the machine\n\n-  Go to the Application Catalog, and install EKME.\n- Follow the prompts to the completion and try EKME again\n-  Let me know if that fixes your issue.\n\nccm eDocs Client\n', '', 0,  '2016-11-09 20:14:35',  NULL, NULL, NULL),
(11,  2,  7,  'Missing folders in Explorer',  '\n2x click on the Computer icon on your Desktop\n2x click on the c:\\ drive\nClick on one of the folders to select it\nClick on the Organize button on the top left of the screen\nClick on Folder and search options\nIn the Navigation pane section, make sure “Automatically expand to current folder” is checked\nClick Apply\nClick OK\nOpen Windows Explorer DM Extensions and see if the EKME folders now show up\n', '', 0,  '2016-11-10 15:08:30',  NULL, NULL, NULL),
(12,  2,  7,  'Missing Save button',  '\n- Click on the Start menu\n- In the Run box, type %Appdata%\n- Navigate to \\Roaming\\opentext\\DM\\Settings\n- Right click the file SaveUIConfig.xml and select edit. (Should open up in notepad) \n- Change the following values from false to true.\n- <SecurityPanelEnabled>True</SecurityPanelEnabled>\n- <SecurityPanelVisible>True</SecurityPanelVisible>\n- Save and close the file.\n', '\n- Clicquer sur le bouton Démarrer\n- Dans la boite de recherche, tapper %Appdata%\n- Naviger à \\Roaming\\Opentext\\DM\\Settings\n- Ouvrir le document SaveUiConfig avec le bouton droit de la souris\n- Changer les valeurs suivante a “True”\n- <SecurityPanelEnabled>True</SecurityPanelEnabled>\n- <SecurityPanelVisible>True</SecurityPanelVisible>\n- Enregistrer et redémarré EKME\n',  0,  '2016-11-10 15:09:47',  '2018-02-14 20:04:41',  '2018-02-14 15:04:41',  NULL),
(13,  2,  7,  'Missing search options', '\nZRM_USERS will provide user with capabilities to search both EKME and RM\n- EKME Search (EKME2_SEARCH_RM)\n- RM Search (EKME_RMSEARCH)\n\nMake sure that ZRM_USERS is the primary group in the user\'s profile\n\nIf DOCS_USERS, only EKME Search will show up\n', '', 0,  '2016-11-14 16:10:48',  NULL, NULL, NULL),
(14,  2,  7,  'Modify registry settings - document limits', '\n<p>Open Regedit <a href=\"http:\\localhost:8000\\admin\\articles\\11\">as admin</a><br />Go to Computer\\ HKEY_CURRENT_USER\\ Software\\ Hummingbird\\ PowerDocs\\ Core\\ Plugins\\ Fusion\\ Settings\\<br />Change Max Size to desired value</p>\n<p>OR</p>\n<p>Computer HKEY_CURRENT_USER\\ Software\\ Hummingbird\\ PowerDOCS\\ Core\\ Plugins\\ Fusion\\ Settings\\ QuickSearches<br />Change Max Size to desired value</p>\n<p>Search Registry for Max Size Computer\\HKEY_USERS\\S-1-5-21-334392860-1687531001-4089495415-95579\\Software\\Hummingbird\\PowerDOCS\\Core\\Plugins\\Fusion\\Settings\\QuickSearches</p>\n',  '', 0,  '2016-11-14 16:11:50',  NULL, NULL, NULL),
(15,  2,  7,  'Move to disposed', '\nGet FileCode values from provided spreadsheet\nCopy whole column from Excel\nPaste in Notepad++\nMake sure you end up with only the file codes (1 per line)\nMake sure the cursor is at the beginning on the page (before any text)\nRun the \"Move to disposed macro\"\n\nRemove excess characters at the beginning\nRemove the last comma at the end and replace it with a )\nTo make sure the statement is valid\n\nYou should end with something like he below\n\n\nUPDATE [DOCSADM].[PD_FILE_PART]\nSET PD_PT2LOC_LINK = \'1023\' -- Disposed\nWHERE PD_PT2LOC_LINK = \'1070\' -- 200 Kent\nAND PD_FILEPT_NO IN (\n\'AAC-1050-13/E001\',\n\'AAC-1050-13/A001\',\n\'AAC-1050-13/V001\'\n)\n\n\nOnce script is completed, send to Julien to run\n', '', 0,  '2016-11-14 16:12:29',  NULL, NULL, NULL),
(16,  2,  7,  'No mail client installed', '\nNo mail client installed error\n\nRegedit\nHKEY_LOCAL_MACHINE -> SOFTWARE ->Wow6432Node -> MICROSOFT -> Windows Messaging SubSystem\nAdd a new string value MAPI = 1\n', '', 0,  '2016-11-14 16:13:07',  NULL, NULL, NULL),
(18,  2,  3,  'Delete Windows user profile',  '\n<p>You can do it with the User Profiles dialog in System Properties:</p>\n<ul>\n<li>Log in as different user (with admin privileges) than you want to delete</li>\n<li>Open Properties for Computer</li>\n<li>Advanced system settings (on the left side)</li>\n<li>Settings for User Profiles (in the middle)</li>\n<li>Select the profile you want to delete and click the delete button</li>\n</ul>\n', '', 0,  '2016-11-15 16:10:09',  NULL, NULL, NULL),
(19,  2,  7,  'Excel rotating screen when opening a document from EKME',  '\n<p>Go to your control panel (start -&gt; control panel)</p>\n<p>Click on Intel&reg; Graphics and Media</p>\n<p>Click on basic or advanced. Then select options and support.</p>\n<p>In the hot key management, uncheck &ldquo;Enable.&rdquo;</p>\n', '', 0,  '2017-01-05 18:38:42',  NULL, NULL, NULL),
(20,  2,  1,  'User not in license role', '\n<p>What you are looking for is \"Contact Users\"</p>\n<p>Go to Configuration menu<br />Expand Organization / Contact User<br />Search for for the Contact User by clicking on yellow folder on the tool bar on the right hand side pane<br />Enter the user ID in the shortcode field<br />Click Ok in the search window<br />Make sure that</p>\n<ol style=\"list-style-type: lower-alpha;\">\n<li style=\"padding-left: 30px;\">Login = cu_[userID]</li>\n<li style=\"padding-left: 30px;\">User Alias = ANET</li>\n<li style=\"padding-left: 30px;\">License Role = DFO-MPO USERS</li>\n</ol>\n<p>If it\'s asking for a password then just add a bogus password in the password field like 123456</p>\n', '', 0,  '2017-01-09 19:56:36',  NULL, NULL, NULL);

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `parent_id`, `name`, `value`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 0,  'recipes',  NULL, NULL, NULL, NULL, NULL),
(2, 1,  'entrees',  NULL, NULL, NULL, '2019-02-23 12:40:52',  '2019-03-03 12:54:51'),
(3, 1,  'desserts', NULL, NULL, NULL, '2019-02-23 12:41:38',  '2019-02-23 12:41:38'),
(4, 1,  'drinks', NULL, '', NULL, '2019-02-23 12:42:42',  '2019-02-23 12:42:42'),
(5, 2,  'beef', NULL, NULL, NULL, '2019-02-24 04:19:01',  '2019-02-24 04:19:01'),
(6, 2,  'pork', NULL, NULL, NULL, '2019-02-27 13:51:56',  '2019-02-27 13:51:56'),
(7, 2,  'chicken',  NULL, NULL, NULL, '2019-02-27 13:52:07',  '2019-02-27 13:52:07'),
(8, 3,  'cakes',  NULL, NULL, NULL, '2019-02-27 14:01:35',  '2019-02-27 14:01:35'),
(9, 3,  'cookies',  NULL, NULL, NULL, '2019-02-27 14:01:45',  '2019-02-27 14:01:45'),
(10,  3,  'pies', NULL, '', NULL, '2019-02-27 14:01:55',  '2019-02-27 14:01:55'),
(11,  0,  'articles', NULL, NULL, NULL, '2019-03-01 12:48:19',  '2019-03-01 12:48:19'),
(12,  0,  'projects', NULL, NULL, NULL, '2019-03-01 12:48:31',  '2019-03-01 12:48:31'),
(13,  11, 'site', NULL, '', NULL, '2019-03-01 20:39:38',  '2019-03-01 20:39:38'),
(14,  0,  'wood type',  NULL, '', NULL, '2019-03-01 20:39:59',  '2019-03-01 20:39:59'),
(15,  0,  'wood specie',  NULL, NULL, NULL, '2019-03-02 12:54:15',  '2019-03-02 12:54:15'),
(16,  0,  'stain type', NULL, NULL, NULL, '2019-03-02 12:54:31',  '2019-03-02 12:54:31'),
(17,  0,  'stain color',  NULL, NULL, NULL, '2019-03-02 12:55:39',  '2019-03-02 12:55:39'),
(18,  0,  'stain sheen',  NULL, NULL, NULL, '2019-03-02 12:55:39',  '2019-03-02 12:55:39'),
(19,  0,  'finish type',  NULL, NULL, NULL, '2019-03-02 12:55:39',  '2019-03-02 12:55:39'),
(20,  0,  'finish sheen', NULL, NULL, NULL, '2019-03-02 12:55:24',  '2019-03-02 12:55:24'),
(32,  4,  'hotDrinks',  NULL, NULL, NULL, '2019-03-03 16:12:11',  '2019-03-04 02:59:12'),
(33,  1,  'salads', NULL, 'N/A',  NULL, '2019-03-03 21:54:15',  '2019-03-03 21:54:15'),
(34,  33, 'Pasta',  NULL, NULL, NULL, '2019-03-03 21:55:33',  '2019-03-03 21:55:33'),
(35,  33, 'garden', NULL, NULL, NULL, '2019-03-03 21:58:35',  '2019-03-03 21:58:35'),
(36,  3,  'fruitDishes',  NULL, NULL, NULL, '2019-03-03 22:03:08',  '2019-03-03 22:03:08'),
(38,  1,  'Soups',  NULL, NULL, NULL, '2019-03-04 02:52:50',  '2019-03-04 02:52:50'),
(39,  38, 'hotSoups', NULL, NULL, NULL, '2019-03-04 02:57:02',  '2019-03-04 02:57:02'),
(40,  4,  'alcoholic',  NULL, NULL, NULL, '2019-03-25 17:51:52',  '2019-03-25 17:51:52'),
(41,  4,  'coldDrinks', NULL, NULL, NULL, '2019-03-25 17:54:03',  '2019-03-25 17:54:03'),
(59,  0,  'posts',  NULL, NULL, NULL, '2019-04-08 15:26:28',  '2019-04-08 15:26:28'),
(60,  59, 'site', NULL, NULL, NULL, '2019-04-08 15:26:58',  '2019-04-08 15:28:16'),
(62,  60, 'general',  NULL, NULL, NULL, '2019-04-08 15:49:39',  '2019-04-08 15:49:39'),
(64,  60, '123456', NULL, NULL, NULL, '2019-04-08 16:39:41',  '2019-04-08 16:39:41'),
(65,  13, 'qwerty', NULL, NULL, NULL, '2019-04-08 16:40:10',  '2019-04-08 16:40:10'),
(67,  12, 'Type', NULL, 'Project types',  NULL, '2019-06-24 12:37:48',  '2019-06-24 12:37:48'),
(68,  67, 'general',  NULL, NULL, NULL, '2019-06-24 15:40:48',  '2019-06-24 15:40:48'),
(69,  67, 'furniture',  NULL, NULL, NULL, '2019-06-24 15:44:08',  '2019-06-24 15:44:08');

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `comments` (`id`, `user_id`, `comment`, `approved`, `commentable_type`, `commentable_id`, `created_at`, `updated_at`) VALUES
(1, 1,  'dsds', 0,  'Modules\\Posts\\Entities\\Post', 1,  '2019-01-27 12:50:08',  '2019-01-27 12:50:08'),
(2, 2,  'dsds', 0,  'Modules\\Recipes\\Entities\\Recipe', 2,  '2019-01-27 13:07:33',  '2019-01-27 13:07:33'),
(3, 1,  'fsdfsdfsdfsdf',  0,  'Modules\\Recipes\\Entities\\Recipe', 11, '2019-01-28 11:28:37',  '2019-01-28 11:28:37'),
(4, 1,  'sdasdsadsad',  0,  'Modules\\Recipes\\Entities\\Recipe', 31, '2019-02-10 14:31:20',  '2019-02-10 14:31:20'),
(5, 1,  'Testing comment feature for recipes',  0,  'Modules\\Recipes\\Entities\\Recipe', 11, '2019-02-11 11:25:52',  '2019-02-11 11:25:52'),
(6, 2,  'test test test test',  0,  'Modules\\Recipes\\Entities\\Recipe', 11, '2019-02-12 17:20:40',  '2019-02-12 17:20:40'),
(7, 2,  'First comment for this recipe',  0,  'App\\Models\\Recipes\\Recipe', 10, '2019-06-10 17:15:07',  '2019-06-10 17:15:07'),
(8, 2,  '22222222222222', 0,  'App\\Models\\Recipes\\Recipe', 10, '2019-06-10 17:16:12',  '2019-06-10 17:16:12'),
(9, 2,  'testing',  0,  'App\\Models\\Projects\\Project', 8,  '2019-07-21 11:08:49',  '2019-07-21 11:08:49'),
(10,  2,  'Best Qwerty project ever built', 0,  'App\\Models\\Projects\\Project', 10, '2019-07-21 12:17:53',  '2019-07-21 12:17:53'),
(11,  2,  'fdsfdsfds',  0,  'App\\Models\\Projects\\Project', 7,  '2019-07-21 13:17:19',  '2019-07-21 13:17:19'),
(12,  2,  'lkjgsdflgkjalkgjalgkj',  0,  'App\\Models\\Projects\\Project', 6,  '2019-07-21 14:20:22',  '2019-07-21 14:20:22'),
(13,  2,  '1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8\r\n9',  0,  'App\\Models\\Projects\\Project', 11, '2019-07-24 10:14:16',  '2019-07-24 10:14:16'),
(14,  2,  '<p>assdsadsad</p>',  0,  'App\\Models\\Post',  2,  '2019-07-31 01:56:27',  '2019-07-31 01:56:27');

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE `favorites` (
  `user_id` int(10) unsigned NOT NULL,
  `favoriteable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favoriteable_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`favoriteable_id`,`favoriteable_type`),
  KEY `favorites_favoriteable_type_favoriteable_id_index` (`favoriteable_type`,`favoriteable_id`),
  KEY `favorites_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `favorites` (`user_id`, `favoriteable_type`, `favoriteable_id`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\Recipes\\Recipe', 1,  '2019-07-24 00:55:45',  '2019-07-24 00:55:45'),
(2, 'App\\Models\\Recipes\\Recipe', 4,  '2019-05-28 19:23:07',  '2019-05-28 19:23:07'),
(2, 'Modules\\Recipes\\Entities\\Recipe', 14, '2019-01-30 02:54:59',  '2019-01-30 02:54:59'),
(2, 'Modules\\Recipes\\Entities\\Recipe', 26, '2019-01-30 00:10:13',  '2019-01-30 00:10:13'),
(2, 'App\\Models\\Recipes\\Recipe', 27, '2019-05-28 16:58:56',  '2019-05-28 16:58:56');

DROP TABLE IF EXISTS `invoicer__clients`;
CREATE TABLE `invoicer__clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cell` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `invoicer__clients` (`id`, `company_name`, `contact_name`, `address`, `city`, `state`, `zip`, `telephone`, `cell`, `fax`, `email`, `website`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'TheWoodBarn.ca', 'Stephane Leroux',  '1216 Ste Marie Rd',  'Embrun', 'On', 'K0A 1W0',  '613-370-0275', '613-402-0275', NULL, 'stleroux@hotmaill.ca', 'thewoodbarn.ca', NULL, '2018-10-30 20:44:04',  '2018-10-30 20:44:04'),
(2, 'Dan Trim', 'Dan Menard', '1000 Notre-Dame Street', 'Embrun', 'On', 'K0A 1W0',  '613 123 4567', '613 456 4566', NULL, 'test2@hotmail.com',  NULL, NULL, '2018-10-30 20:45:03',  '2019-07-26 03:38:10'),
(3, 'DFO',  'Julien Tremblay',  '200 Kent Street',  'Ottawa', 'On', 'K1E 2F8',  '613-444-7878', NULL, NULL, NULL, NULL, NULL, '2018-10-31 20:23:24',  '2018-10-31 20:23:24'),
(4, 'sdasdasd', 'asdasdasd',  NULL, NULL, NULL, NULL, '3412231232', NULL, NULL, 'asdasd@dsdsd.com', NULL, NULL, '2019-07-16 13:57:10',  '2019-07-16 13:57:18'),
(5, 'test', 'Stacie Haynes',  NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test123@test.com', NULL, NULL, '2019-07-26 03:28:07',  '2019-07-26 03:38:26');

DROP TABLE IF EXISTS `invoicer__invoices`;
CREATE TABLE `invoicer__invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_charged` decimal(8,2) unsigned DEFAULT NULL,
  `hst` decimal(8,2) unsigned DEFAULT NULL,
  `sub_total` decimal(8,2) unsigned DEFAULT NULL,
  `wsib` decimal(8,2) unsigned DEFAULT NULL,
  `income_taxes` decimal(8,2) unsigned DEFAULT NULL,
  `total_deductions` decimal(8,2) unsigned DEFAULT NULL,
  `total` decimal(8,2) unsigned DEFAULT NULL,
  `invoiced_at` datetime DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoicer_invoices_client_id_foreign` (`client_id`),
  CONSTRAINT `invoicer__invoices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `invoicer__clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `invoicer__invoices` (`id`, `client_id`, `notes`, `status`, `amount_charged`, `hst`, `sub_total`, `wsib`, `income_taxes`, `total_deductions`, `total`, `invoiced_at`, `paid_at`, `created_at`, `updated_at`) VALUES
(2, 2,  NULL, 'paid', 70.00,  9.10, 79.10,  4.20, 18.20,  22.40,  47.60,  '2019-06-19 09:19:58',  '2019-06-19 09:20:11',  '2018-10-30 20:54:06',  '2019-06-19 13:20:11'),
(3, 3,  NULL, 'logged', 540.00, 70.20,  610.20, 64.80,  140.40, 205.20, 334.80, NULL, NULL, '2019-05-13 18:18:53',  '2019-05-13 18:25:19'),
(4, 1,  NULL, 'invoiced', 450.00, 58.50,  508.50, 54.00,  117.00, 171.00, 279.00, '2019-06-17 13:44:53',  NULL, '2019-05-13 18:26:17',  '2019-06-17 17:44:53'),
(5, 4,  NULL, 'paid', 123.00, 15.99,  138.99, 14.76,  31.98,  46.74,  76.26,  '2019-07-25 00:00:00',  '2019-07-26 00:00:00',  '2019-07-16 13:57:47',  '2019-07-26 00:48:30');

DROP TABLE IF EXISTS `invoicer__invoice_items`;
CREATE TABLE `invoicer__invoice_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` double(8,2) unsigned NOT NULL,
  `price` decimal(8,2) unsigned NOT NULL,
  `total` decimal(8,2) unsigned NOT NULL,
  `work_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoicer__invoice_items_invoice_id_foreign` (`invoice_id`),
  KEY `invoicer__invoice_items_product_id_foreign` (`product_id`),
  CONSTRAINT `invoicer__invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoicer__invoices` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoicer__invoice_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `invoicer__products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `invoicer__invoice_items` (`id`, `invoice_id`, `product_id`, `notes`, `quantity`, `price`, `total`, `work_date`, `created_at`, `updated_at`) VALUES
(2, 2,  2,  NULL, 2.00, 35.00,  70.00,  '2018-10-11 04:00:00',  '2018-10-30 20:54:23',  '2018-10-30 20:54:23'),
(3, 3,  1,  NULL, 1.00, 450.00, 450.00, '2019-05-13 04:00:00',  '2019-05-13 18:19:13',  '2019-05-13 18:25:14'),
(4, 3,  2,  NULL, 2.00, 45.00,  90.00,  '2019-05-13 04:00:00',  '2019-05-13 18:20:04',  '2019-05-13 18:25:18'),
(5, 4,  3,  NULL, 1.00, 450.00, 450.00, '2019-05-13 04:00:00',  '2019-05-13 18:26:38',  '2019-05-13 18:26:38'),
(6, 5,  4,  NULL, 1.00, 123.00, 123.00, '2019-07-18 04:00:00',  '2019-07-16 13:58:17',  '2019-07-16 13:58:17');

DROP TABLE IF EXISTS `invoicer__products`;
CREATE TABLE `invoicer__products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `invoicer__products` (`id`, `code`, `details`, `created_at`, `updated_at`) VALUES
(1, 'H/W',  'Hardware', '2018-10-30 20:40:56',  '2018-10-30 20:40:56'),
(2, 'Labour', 'Hourly labour rate', '2018-10-30 20:41:39',  '2018-10-30 20:41:39'),
(3, 'Trim', 'Trim', '2018-10-30 20:41:52',  '2018-10-30 20:41:52'),
(4, 'sdsad',  'sadasdasdasdasd',  '2019-07-16 13:54:01',  '2019-07-16 13:54:01');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_08_08_100000_create_telescope_entries_table', 1),
(2, '2019_07_16_103027_create_articles_table',  1),
(3, '2019_07_16_103027_create_categories_table',  1),
(4, '2019_07_16_103027_create_comments_table',  1),
(5, '2019_07_16_103027_create_favorites_table', 1),
(6, '2019_07_16_103027_create_invoicer__clients_table', 1),
(7, '2019_07_16_103027_create_invoicer__invoice_items_table', 1),
(8, '2019_07_16_103027_create_invoicer__invoices_table',  1),
(9, '2019_07_16_103027_create_invoicer__products_table',  1),
(10,  '2019_07_16_103027_create_password_resets_table', 1),
(11,  '2019_07_16_103027_create_permission_user_table', 1),
(12,  '2019_07_16_103027_create_permissions_table', 1),
(13,  '2019_07_16_103027_create_post_tag_table',  1),
(14,  '2019_07_16_103027_create_posts_table', 1),
(15,  '2019_07_16_103027_create_profiles_table',  1),
(16,  '2019_07_16_103027_create_projects__finish_project_table',  1),
(17,  '2019_07_16_103027_create_projects__finishes_table',  1),
(18,  '2019_07_16_103027_create_projects__images_table',  1),
(19,  '2019_07_16_103027_create_projects__material_project_table',  1),
(20,  '2019_07_16_103027_create_projects__materials_table', 1),
(21,  '2019_07_16_103027_create_projects__projects_table',  1),
(22,  '2019_07_16_103027_create_recipe_user_table', 1),
(23,  '2019_07_16_103027_create_recipes_table', 1),
(24,  '2019_07_16_103027_create_settings_table',  1),
(25,  '2019_07_16_103027_create_tags_table',  1),
(26,  '2019_07_16_103027_create_users_table', 1),
(27,  '2019_07_16_103029_add_foreign_keys_to_articles_table', 1),
(28,  '2019_07_16_103029_add_foreign_keys_to_invoicer__invoice_items_table',  1),
(29,  '2019_07_16_103029_add_foreign_keys_to_invoicer__invoices_table', 1),
(30,  '2019_07_16_103029_add_foreign_keys_to_projects__finish_project_table', 1),
(31,  '2019_07_16_103029_add_foreign_keys_to_projects__images_table', 1),
(32,  '2019_07_16_103029_add_foreign_keys_to_projects__material_project_table', 1);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(10) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `permissions` (`id`, `name`, `display_name`, `model`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'permission_index', 'index',  'permission', 1,  'List permissions', NULL, '2018-11-28 22:04:45'),
(2, 'permission_create',  'create', 'permission', 1,  'Create and store permissions', NULL, '2018-11-28 22:04:54'),
(3, 'permission_edit',  'edit', 'permission', 1,  'Edit permissions', NULL, '2018-11-28 22:05:08'),
(4, 'permission_delete',  'delete', 'permission', 1,  'Delete permissions', NULL, '2018-11-28 22:05:15'),
(5, 'permission_show',  'show', 'permission', 1,  'View permission',  NULL, '2018-11-28 22:05:32'),
(6, 'user_index', 'index',  'user', 1,  'List users', NULL, '2018-11-28 22:05:41'),
(7, 'user_create',  'create', 'user', 1,  'Create users', NULL, '2018-11-28 22:05:53'),
(8, 'user_edit',  'edit', 'user', 1,  'Edit users', NULL, '2018-11-28 22:06:03'),
(9, 'user_delete',  'delete', 'user', 1,  'Delete users', NULL, '2018-11-28 22:06:13'),
(10,  'user_show',  'show', 'user', 1,  'View users', NULL, '2018-11-28 22:06:24'),
(11,  'post_index', 'index',  'post', 2,  'List posts', NULL, '2018-11-28 21:50:28'),
(12,  'post_create',  'create', 'post', 2,  'Save posts', NULL, '2018-11-28 21:50:20'),
(13,  'post_edit',  'edit', 'post', 2,  'Edit posts', NULL, '2018-11-28 21:50:42'),
(14,  'post_delete',  'delete', 'post', 2,  'Delete posts', NULL, '2018-11-28 21:50:52'),
(15,  'post_show',  'show', 'post', 2,  'View posts', NULL, '2018-11-28 21:51:02'),
(16,  'component_index',  'Index',  'component',  1,  'List components',  '2018-11-26 19:37:41',  '2018-11-28 21:52:00'),
(17,  'component_create', 'create', 'component',  1,  'Create components',  '2018-11-26 19:45:03',  '2018-11-28 21:52:19'),
(18,  'component_enable', 'enable', 'component',  1,  'Enable a component', '2018-11-26 19:46:16',  '2018-11-28 21:53:14'),
(19,  'component_disable',  'disable',  'component',  1,  'Disable a component',  '2018-11-26 19:46:44',  '2018-11-28 21:53:24'),
(20,  'component_delete', 'delete', 'component',  1,  'Delete components',  '2018-11-26 19:47:24',  '2018-11-28 21:53:37'),
(21,  'change_user_pwd',  'Change User PWD',  'user', 1,  'Change another member\'s password',  '2018-11-26 20:15:18',  '2018-11-28 21:55:31'),
(24,  'invoicer_index', 'index',  'invoicer', 2,  'View the invoicer module', '2018-11-26 20:46:46',  '2018-11-28 21:55:45'),
(25,  'invoicer_client_index',  'Client Index', 'invoicer', 2,  'Access the invoicer module client list', '2018-11-26 20:47:42',  '2018-11-28 21:55:55'),
(26,  'invoicer_dashboard', 'dashboard',  'invoicer', 2,  'Access the Invoicer module dashboard', '2018-11-27 18:57:35',  '2018-11-28 22:00:58'),
(27,  'invoicer_ledger',  'ledger', 'invoicer', 2,  'Allow member to access the Invoicer ledger', '2018-11-27 19:15:39',  '2018-11-27 19:15:39'),
(28,  'invoicer_client_create', 'Client Create',  'invoicer', 2,  'Create new clients in the Invoicer module',  '2018-11-27 22:19:07',  '2018-11-28 22:01:20'),
(29,  'invoicer_client_show', 'Client show',  'invoicer', 2,  'View clients in Invoicer module',  '2018-11-27 22:20:11',  '2018-11-28 22:02:03'),
(30,  'invoicer_client_edit', 'Client Edit',  'invoicer', 2,  'Edit clients in the Invoicer module',  '2018-11-27 22:21:02',  '2018-11-28 22:02:15'),
(31,  'invoicer_client_delete', 'Client Delete',  'invoicer', 2,  'Delete clients in the Invoicer module',  '2018-11-27 22:21:45',  '2018-11-28 22:04:16'),
(32,  'invoicer_invoice_index', 'Invoice index',  'invoicer', 2,  'Display invoices in the Invoicer module',  '2018-11-28 01:13:26',  '2018-11-28 22:04:28'),
(33,  'invoicer_invoice_create',  'Invoice Create', 'invoicer', 2,  'Create invoices in the Invoicer module', '2018-11-28 01:18:50',  '2018-11-28 22:06:47'),
(34,  'invoicer_invoice_edit',  'Invoice edit', 'invoicer', 2,  'Edit invoices in the Invoicer module', '2018-11-28 01:19:17',  '2018-11-28 22:06:56'),
(35,  'invoicer_invoice_delete',  'Invoice delete', 'invoicer', 2,  'Delete invoices in the Invoicer module', '2018-11-28 01:19:44',  '2018-11-28 22:07:03'),
(36,  'invoicer_invoice_show',  'Invoice show', 'invoicer', 2,  'View invoices in the Invoicer module', '2018-11-28 19:34:09',  '2018-11-28 22:07:13'),
(37,  'invoicer_product_index', 'product index',  'invoicer', 2,  'Allow member to list products in the Invoicer module', '2018-11-28 19:42:22',  '2018-11-28 19:42:22'),
(38,  'invoicer_product_create',  'product create', 'invoicer', 2,  'Create products in the Invoicer module', '2018-11-28 19:43:05',  '2018-11-28 22:07:23'),
(39,  'invoicer_product_edit',  'product edit', 'invoicer', 2,  'Edit products in the Invoicer module', '2018-11-28 19:43:33',  '2018-11-28 22:07:36'),
(40,  'invoicer_product_show',  'product show', 'invoicer', 2,  'View products in the Invoicer module', '2018-11-28 19:44:02',  '2018-11-28 22:07:47'),
(41,  'invoicer_product_delete',  'product delete', 'invoicer', 2,  'Delete products in the Invoicer module', '2018-11-28 19:44:23',  '2018-11-28 22:08:00'),
(47,  'admin_menu', 'admin menu', 'admin',  0,  '', NULL, NULL),
(48,  'module_index', 'index',  'module', 1,  'list modules', '2018-11-30 19:04:16',  '2018-11-30 19:04:16'),
(49,  'module_create',  'create', 'module', 1,  'create modules', '2018-11-30 20:37:02',  '2018-11-30 20:37:02'),
(50,  'module_edit',  'edit', 'module', 1,  'edit modules', '2018-11-30 21:06:29',  '2018-11-30 21:06:29'),
(51,  'module_delete',  'delete', 'module', 1,  'delete modules', '2018-11-30 21:10:38',  '2018-11-30 21:10:38'),
(52,  'category_index', 'index',  'categories', 1,  'list categories',  '2018-12-03 20:02:47',  '2018-12-03 20:02:47'),
(53,  'category_create',  'create', 'categories', 1,  'create categories',  '2018-12-03 20:04:11',  '2018-12-03 20:04:11'),
(54,  'category_edit',  'edit', 'categories', 1,  'edit categories',  '2018-12-03 21:53:16',  '2018-12-03 21:53:16'),
(55,  'category_delete',  'delete', 'categories', 1,  'delete categories',  '2018-12-03 21:53:48',  '2018-12-03 21:53:48'),
(56,  'category_show',  'show', 'categories', 1,  'show category',  '2018-12-03 22:36:32',  '2018-12-03 22:36:32'),
(57,  'article_index',  'Index',  'Article',  2,  'List articles',  '2019-04-08 12:46:02',  '2019-04-08 12:46:02'),
(58,  'recipe_edit',  'Edit', 'recipe', 2,  'edit all recipes', '2019-05-15 14:28:03',  '2019-05-15 14:28:03'),
(59,  'recipe_publish', 'Publish',  'recipe', 2,  'publish / unpublish recipes',  '2019-05-28 15:44:34',  '2019-05-28 15:44:34'),
(60,  'recipe_published', 'Published',  'recipe', 2,  'view published / unpublished recipes', '2019-05-28 15:44:34',  '2019-05-28 15:44:34'),
(61,  'recipe_private', 'Private/Public', 'recipe', 2,  'hide or show his recipes to the general public', '2019-05-28 15:44:34',  '2019-05-28 15:44:34'),
(62,  'recipe_create',  'Create', 'recipe', 2,  'create recipes', '2019-05-28 15:44:34',  '2019-05-28 15:44:34'),
(63,  'recipe_new', 'New',  'recipe', 2,  'view new recipes', '2019-05-28 15:44:34',  '2019-05-28 15:44:34'),
(64,  'recipe_future',  'Future', 'recipe', 2,  'view future recipes',  '2019-05-28 15:44:34',  '2019-05-28 15:44:34'),
(65,  'comment_store',  'Store',  'comment',  2,  'add comments to items on the site',  '2019-06-10 17:17:15',  '2019-06-10 17:17:15'),
(166, 'projects_index', 'index',  'projects', 2,  'list projects',  NULL, NULL),
(167, 'projects_create',  'create', 'projects', 2,  'create projects',  NULL, NULL),
(168, 'projects_edit',  'edit', 'projects', 2,  'edit projects',  NULL, NULL),
(169, 'projects_show',  'show', 'projects', 2,  'view projects',  NULL, NULL),
(170, 'projects_delete',  'delete', 'projects', 2,  'delete projects',  NULL, NULL);

DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE `permission_user` (
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `permission_user` (`permission_id`, `user_id`) VALUES
(11,  2),
(12,  2),
(13,  2),
(14,  2),
(15,  2),
(16,  2),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(9, 2),
(10,  2),
(17,  2),
(20,  2),
(19,  2),
(18,  2),
(12,  3),
(11,  3),
(15,  3),
(24,  2),
(28,  2),
(31,  2),
(30,  2),
(25,  2),
(29,  2),
(26,  2),
(33,  2),
(35,  2),
(32,  2),
(36,  2),
(38,  2),
(41,  2),
(39,  2),
(37,  2),
(40,  2),
(34,  2),
(48,  2),
(50,  2),
(51,  2),
(49,  2),
(52,  2),
(53,  2),
(55,  2),
(54,  2),
(56,  2),
(21,  2),
(57,  2),
(47,  2),
(62,  2),
(8, 2),
(62,  3),
(53,  8),
(52,  8),
(56,  8),
(166, 2),
(167, 2),
(168, 2),
(169, 2),
(170, 2),
(58,  2),
(64,  2),
(63,  2),
(61,  2),
(59,  2),
(60,  2),
(27,  2);

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `modified_by_id` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `body`, `slug`, `image`, `views`, `created_at`, `updated_at`, `published_at`, `modified_by_id`, `deleted_at`) VALUES
(1, 2,  1,  'First Post', 'Body of first post', 'first_post', '1495544253.png', 59, '2017-12-28 18:10:28',  '2019-04-08 13:31:05',  '2019-04-08 09:31:05',  NULL, NULL),
(2, 2,  1,  'Second blog',  'Content of second blog Content of second blog Content of second blog Content of second blog Content of second blog Content of second blog ', 'second_blog',  '1495544315.png', 25, '2017-12-28 18:20:18',  NULL, '2019-06-04 12:23:52',  NULL, NULL),
(5, 1,  2,  'aaaaasdsadsdasd jkash jshjkh sjkh jkh jhsd kjah dakjdhkjdh kdjh',  '<p>sadasdasd sadasdasd sadasdasd sadasdasd sadasdasd sadasdasd sadasdasd sadasdasd sadasdasd sadasdasd sadasdasd </p>',  'aaaaaaaaaaaaaaa',  '1483551182.jpg', 2,  '2017-01-04 16:55:50',  '2017-10-16 17:05:00',  NULL, NULL, NULL),
(21,  1,  2,  'vfvfvfvffffffffffffffffffffffffffffffffffff',  '<p>111111111111111</p>', '11111111111111', '1496342208.jpg', 3,  '2017-06-01 16:53:01',  '2017-06-13 16:50:45',  NULL, NULL, NULL),
(23,  1,  38, 'New post qwerty',  '<p>Body of new post</p>',  'new_post', '1496335034.png', 3,  '2017-06-21 17:01:19',  '2017-07-28 18:58:46',  '2019-06-04 12:23:52',  NULL, NULL),
(25,  2,  2,  'Post test',  '<p>klj j ljklkj klj klj klj klj lkj klj kl jklj klj</p>',  'post-test',  '1498587512.jpg', 10, '2017-08-08 13:16:08',  '2017-08-08 13:16:08',  '2019-06-04 12:23:52',  NULL, NULL);

DROP TABLE IF EXISTS `post_tag`;
CREATE TABLE `post_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_tag_post_id_foreign` (`post_id`),
  KEY `post_tag_tag_id_foreign` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `civic_number` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frontendStyle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'slate',
  `backendStyle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'bootstrap',
  `date_format` int(11) NOT NULL DEFAULT '1',
  `landing_page_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '41',
  `rows_per_page` int(10) unsigned NOT NULL DEFAULT '15',
  `display_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `action_buttons` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `author_format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `alert_fade_time` int(10) unsigned NOT NULL DEFAULT '5000',
  `layout` int(10) unsigned NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profiles_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `telephone`, `image`, `civic_number`, `address1`, `address2`, `city`, `province`, `postal_code`, `frontendStyle`, `backendStyle`, `date_format`, `landing_page_id`, `rows_per_page`, `display_size`, `action_buttons`, `author_format`, `alert_fade_time`, `layout`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1,  'Admin',  'Istrator', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'slate',  'bootstrap',  1,  '41', 15, 'normal', '1',  '1',  5000, 1,  NULL, '2017-12-28 20:27:35',  '2019-01-18 15:58:00'),
(2, 2,  'Stephane', 'Leroux', '613-370-0275', '1548022561.png', '1216', 'Ste Marie Rd', NULL, 'Embrun', 'Ontario',  'K0A 1W0',  'slate',  'bootstrap',  1,  '41', 15, 'normal', '1',  '1',  5000, 1,  NULL, '2017-12-28 20:28:06',  '2019-02-09 12:19:52'),
(3, 3,  'Stacie', 'Haynes', '613-327-4722', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'slate',  'bootstrap',  1,  '41', 15, 'normal', '1',  '1',  5000, 1,  NULL, '2017-12-28 20:28:26',  '2017-12-28 20:28:26'),
(4, 4,  'Hugues', 'Leroux', '613-255-7754', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'slate',  'bootstrap',  1,  '41', 15, 'normal', '1',  '1',  5000, 1,  NULL, '2017-12-28 20:28:26',  '2017-12-28 20:28:26'),
(5, 5,  'Luc',  'Leveille', '613-204-7525', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'slate',  'bootstrap',  1,  '41', 15, 'normal', '1',  '1',  5000, 1,  NULL, '2017-12-28 20:28:26',  '2017-12-28 20:28:26'),
(6, 6,  'Julien', 'Tremblay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'slate',  'bootstrap',  1,  '41', 15, 'normal', '1',  '1',  5000, 1,  NULL, '2018-06-05 22:40:29',  '2018-06-08 16:47:23'),
(7, 7,  'Brenda', 'Haynes', '613-987-2995', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'slate',  'bootstrap',  1,  '41', 15, 'normal', '1',  '1',  5000, 1,  NULL, '2018-06-05 22:40:15',  '2018-06-05 22:40:15'),
(8, 8,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'slate',  'bootstrap',  1,  '41', 15, 'normal', '1',  '1',  5000, 1,  NULL, '2019-06-18 16:47:35',  '2019-06-18 16:47:35');

DROP TABLE IF EXISTS `projects__finishes`;
CREATE TABLE `projects__finishes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_code` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sheen` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manufacturer` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upc` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `projects__finishes` (`id`, `name`, `type`, `color_name`, `color_code`, `sheen`, `manufacturer`, `upc`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Polyurethane', '', '', '', '1',  '', '', '', NULL, NULL),
(2, 'Varnish',  '', '', '', '3',  '', '', '', NULL, NULL),
(3, 'Shellac',  '', '', '', '4',  '', '', '', NULL, NULL);

DROP TABLE IF EXISTS `projects__finish_project`;
CREATE TABLE `projects__finish_project` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `finish_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `projects__finish_project` FOREIGN KEY (`project_id`) REFERENCES `projects__projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `projects__images`;
CREATE TABLE `projects__images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mine_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `path` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_image` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `projects__images` FOREIGN KEY (`project_id`) REFERENCES `projects__projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `projects__images` (`id`, `project_id`, `name`, `description`, `mine_type`, `size`, `path`, `main_image`, `created_at`, `updated_at`) VALUES
(41,  11, '1563828133.jpg', 'Hallway table',  '', 0,  '', 0,  '2019-07-22 20:42:14',  '2019-07-22 20:42:14'),
(42,  12, '1563828189.jpg', 'Bench',  '', 0,  '', 0,  '2019-07-22 20:43:09',  '2019-07-22 20:43:09'),
(43,  13, '1563828237.jpg', 'Small chalkboard', '', 0,  '', 0,  '2019-07-22 20:43:58',  '2019-07-22 20:43:58'),
(44,  14, '1563828315.jpg', 'Candle box', '', 0,  '', 0,  '2019-07-22 20:45:15',  '2019-07-22 20:45:15'),
(45,  15, '1563828333.jpg', 'Candle Holder 1',  '', 0,  '', 0,  '2019-07-22 20:45:33',  '2019-07-22 20:45:33'),
(47,  19, '1564136980.jpg', 'Antique mirror', '', 0,  '', 0,  '2019-07-26 10:29:40',  '2019-07-26 10:29:40'),
(49,  18, '1564137045.jpg', 'Corner Shelf', '', 0,  '', 0,  '2019-07-26 10:30:45',  '2019-07-26 10:30:45'),
(50,  20, '1564137068.jpg', 'Wine Rack',  '', 0,  '', 0,  '2019-07-26 10:31:09',  '2019-07-26 10:31:09'),
(51,  14, '1564360784.jpg', 'Picture #2', '', 0,  '', 0,  '2019-07-29 00:39:45',  '2019-07-29 00:39:45'),
(52,  15, '1564360848.jpg', 'Picture #2', '', 0,  '', 0,  '2019-07-29 00:40:48',  '2019-07-29 00:40:48');

DROP TABLE IF EXISTS `projects__materials`;
CREATE TABLE `projects__materials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `manufacturer` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `UPC` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `projects__materials` (`id`, `name`, `type`, `notes`, `manufacturer`, `UPC`, `created_at`, `updated_at`) VALUES
(1, 'Ash',  '', '', '', '', '2019-06-30 09:16:22',  '2019-06-30 09:16:22'),
(2, 'Oak',  '', '', '', '', NULL, NULL),
(3, 'Maple',  '', '', '', '', NULL, NULL),
(5, 'Curly Maple',  'Hardwood', 'No notes for this product again',  'ABC Company',  '123123123123', '2019-07-07 01:00:05',  '2019-07-07 01:16:33'),
(6, 'Zebra Wood', 'Fucked up wood', 'I don\'t give a crap', 'NA', 'NA', '2019-07-12 01:04:29',  '2019-07-12 01:04:29');

DROP TABLE IF EXISTS `projects__material_project`;
CREATE TABLE `projects__material_project` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL,
  `material_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `projects__material_project` FOREIGN KEY (`project_id`) REFERENCES `projects__projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `projects__material_project` (`id`, `project_id`, `material_id`, `created_at`, `updated_at`) VALUES
(11,  11, 1,  NULL, NULL);

DROP TABLE IF EXISTS `projects__projects`;
CREATE TABLE `projects__projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `time_invested` int(10) unsigned DEFAULT NULL,
  `price` int(10) unsigned DEFAULT NULL,
  `width` int(10) unsigned DEFAULT NULL,
  `depth` int(10) unsigned DEFAULT NULL,
  `height` int(10) unsigned DEFAULT NULL,
  `weight` int(10) unsigned DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `projects__projects` (`id`, `category`, `name`, `description`, `views`, `time_invested`, `price`, `width`, `depth`, `height`, `weight`, `completed_at`, `created_at`, `updated_at`) VALUES
(11,  2,  'Hallway table',  'Nice hallway table with ceramic tile top', 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-22 02:12:18',  '2019-07-22 02:12:18'),
(12,  2,  'Storage Bench',  'Storage Bench',  25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-22 20:42:54',  '2019-07-22 20:42:54'),
(13,  5,  'Chalkboard', 'Small chalkboard', 3,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-22 20:43:42',  '2019-07-22 20:43:42'),
(14,  1,  'Candle Box', 'Candle box', 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-22 20:44:44',  '2019-07-29 00:40:07'),
(15,  1,  'Candle Holder',  'Candle Holder',  4,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-22 20:44:59',  '2019-07-29 00:40:30'),
(18,  5,  'Corner Shelf', 'Corner Shelf', 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-26 10:28:32',  '2019-07-26 10:30:53'),
(19,  5,  'Antique mirror', 'Antique mirror', 3,  NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-26 10:28:56',  '2019-07-26 10:28:56'),
(20,  5,  'Wine Rack',  'Wine Rack',  25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-26 10:29:12',  '2019-07-26 10:29:12');

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE `recipes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredients` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `methodology` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `servings` int(10) unsigned DEFAULT NULL,
  `prep_time` int(10) unsigned DEFAULT NULL,
  `cook_time` int(10) unsigned DEFAULT NULL,
  `personal` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(10) unsigned DEFAULT '0',
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `private_notes` text COLLATE utf8mb4_unicode_ci,
  `public_notes` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(10) unsigned NOT NULL,
  `modified_by_id` int(10) unsigned DEFAULT NULL,
  `last_viewed_by_id` int(10) unsigned DEFAULT NULL,
  `last_viewed_on` datetime DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  KEY `modified_by` (`modified_by_id`),
  KEY `last_viewed_by_id` (`last_viewed_by_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `recipes` (`id`, `title`, `ingredients`, `methodology`, `image`, `category_id`, `servings`, `prep_time`, `cook_time`, `personal`, `views`, `source`, `private_notes`, `public_notes`, `user_id`, `modified_by_id`, `last_viewed_by_id`, `last_viewed_on`, `published_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Oatmeal Buds', '<p>2 cups of sugar</p>\n<p>dash of salt</p>\n<p>3 tablespoons of cocoa</p>\n<p>1 teaspoon of vanilla</p>\n<p>1/2 cup of butter or margarine</p>\n<p>1/2 cup of peanut butter</p>\n<p>1/2 cup of milk</p>\n<p>3 cups of oatmeal (quick cooking oats)</p>',  '<p>Place sugar, cocoa, butter, milk and salt in a pot. Bring to a full boil and boil for 1 minute.</p>\n<p>Remove from heat and stir in vanilla, peanut butter and oatmeal. Mix well.</p>\n<p>Drop from a teaspoon onto wax paper and let stand for about 30 minutes to dry.</p>', '1.jpg',  5,  0,  20, 20, 0,  47, 'Recipe Box', NULL, NULL, 2,  2,  2,  '2019-05-15 12:08:50',  '2019-05-29 12:02:50',  NULL, '2019-05-15 16:11:12',  '2019-05-29 16:02:50'),
(2, 'Bouchees Aux Cacahuettes', '<p>1/2 cup of brown sugar - well packed</p>\n<p>1/2 cup of peanut butter</p>\n<p>1/2 cup of corn syrup</p>\n<p>1 cup of peanuts (non salted)</p>\n<p>4 cups of Corn Flakes</p>\n<p>2 cups semi sweet chocolate chips</p>', '<p>Mix brown sugar, peanut butter and corn syrup in a pan</p>\n<p>Cook on low heat until it starts to boil, mixing constantly</p>\n<p>Remove form heat and add peanuts and Corn Flakes</p>\n<p>Butter a 9 x 11 pan and spread mix evenly</p>\n<p>Let cool and then melt chocolate chips and spread on top</p>',  '2.jpg',  9,  0,  30, 0,  0,  201,  NULL, NULL, NULL, 2,  2,  2,  '2019-05-06 09:39:44',  '2019-02-13 14:13:21',  NULL, '2019-02-21 12:03:32',  '2019-05-28 17:12:32'),
(4, 'Banana Loaf',  '<p>1 1/2 cups of sugar</p>\n<p>1/2 cup of butter</p>\n<p>2 eggs</p>\n<p>1 teaspoon of vanilla</p>\n<p>4 tablespoons of milk</p>\n<p>1 tablespoon of water</p>\n<p>1 teaspoon of baking soda</p>\n<p>1 teaspoon of baking powder</p>\n<p>1 1/2 cups of flour</p>\n<p>2-2 1/2 bananas</p>',  '<p>Mash bananas up completely and mix in all other ingredients. Pour into a loaf pan (greased) and bake at 350 degrees for 50 minutes.</p>', '4.jpg',  1,  0,  20, 0,  0,  66, 'Recipe Box', '', '', 3,  2,  3,  '2016-10-02 12:27:03',  '2019-05-28 11:49:09',  NULL, '2019-02-21 12:03:32',  '2019-05-28 15:49:09'),
(5, 'Pancakes', '<p>1 1/2 cups of flour</p>\n<p>3 teaspoons of baking powder</p>\n<p>1/2 teaspoon of salt</p>\n<p>2 eggs</p>\n<p>1 cup of milk</p>\n<p>4 tablespoons of melted butter</p>', '<p>Mix flour, baking powder and salt together in large bowl. In a smaller bowl mix eggs and milk together and add to large bowl mixture. Beat well, cool and add melted butter.</p>',  '5.jpg',  1,  6,  20, 0,  0,  37, 'Recipe Box', NULL, NULL, 3,  2,  2,  '2019-02-19 19:37:12',  '2019-02-14 17:47:37',  NULL, '2019-02-21 12:03:32',  '2019-02-20 00:37:12'),
(6, 'Shortbread Cookies', '<p>1 pound of butter</p>\n<p>1 cup of fruit sugar</p>\n<p>4 cups of flour</p>\n<p>2 tablespoons of corn starch</p>\n<p>1/2 teaspoon of vanilla</p>', '<p>Mix butter, sugar, corn starch and vanilla together. Once well blended mix in all flour. Roll dough until it\'\'s about 1/4\" thick and shape cookies as desired.</p>\n<p>Preheat oven at 300 degrees and bake for approximately 16 minutes or until they are starting to brown.</p>',  '6.jpg',  9,  0,  30, 0,  0,  19, 'Recipe Box', NULL, NULL, 3,  2,  2,  '2018-02-13 11:02:05',  '2019-02-13 14:13:21',  NULL, '2016-10-02 18:17:37',  '2019-02-17 12:18:04'),
(7, 'Spinach Dip',  '<p>1 package of frozen spinach (cook as indicated and cool)</p>\n<p>1 cup of sour cream</p>\n<p>1 cup of mayonnaise</p>\n<p>2 tablespoons of parmesan cheese</p>\n<p>1 envelope (45g) of KNORR vegetable soup</p>',  '<p>Mix well and pour in a pumpernickel bread or use as a vegetable dip.</p>',  '7.jpg',  2,  0,  20, 0,  0,  3,  'Recipe Box', '', '', 2,  2,  2,  '2016-10-02 11:19:13',  '2016-10-02 11:19:13',  NULL, '2016-10-02 18:19:13',  '2019-05-29 16:01:29'),
(8, 'French Toast', '<p>3 eggs</p>\n<p>1/2 teaspoon of salt</p>\n<p>2 tablespoons of sugar</p>\n<p>1 cup of milk</p>\n<p>6 slices of bread</p>',  '<p>Beat eggs well and add in all other ingredients. Mix well and soak bread until soft. Fry in a well greased frying pan.</p>',  '8.jpg',  10, 6,  10, 0,  0,  30, 'Recipe Box', NULL, NULL, 3,  2,  2,  '2019-03-08 15:07:23',  '2019-02-28 22:53:42',  NULL, '2016-10-02 18:20:36',  '2019-03-08 20:07:23'),
(9, 'Peanut Butter Cookies',  '<p>1 1/4 cups of Kraft Smooth Peanut Butter</p>\n<p>1/2 cup of margarine or butter</p>\n<p>3/4 cup of white sugar</p>\n<p>3/4 cup of brown sugar</p>\n<p>2 eggs</p>\n<p>2 teaspoons of vanilla</p>\n<p>1 cup of flour</p>\n<p>1/2 teaspoon of salt</p>\n<p>1/2 teaspoon of baking soda</p>', '<p>In a large bowl, mix together the first six ingredients.</p>\n<p>In another bowl mix the remaining 3 ingredients.</p>\n<p>Stir flour mixture into peanut butter mixture. mix well.</p>\n<p>Drop onto a lightly greased sheet and then flatten slightly with a fork. Bake at 350 degrees for 10 to 12 minutes, or until the centers are still soft to the touch. Cool cookies on pan for 5 minutes.</p>',  '9.jpeg', 9,  36, 30, 0,  0,  56, 'Recipe Box', '', '', 3,  2,  2,  '2016-10-02 11:22:47',  '2019-02-19 20:06:13',  NULL, '2016-10-02 18:22:46',  '2019-02-20 01:06:13'),
(10,  'Beef And Vegetable Pie', '<p>2 teaspoons of cooking oil</p>\n<p>1 pound of lean ground beef</p>\n<p>2 cups of frozen mixed vegetables</p>\n<p>1-10 ounce can of condensed cream of mushroom soup</p>\n<p>1 teaspoon of beef bouillon powder</p>\n<p>1/2 teaspoon of onion powder</p>\n<p>1/4 teaspoon of black pepper</p>\n<p>Pastry for 2 crust 9\" pie</p>', '<p>Heat cooking oil in a large frying pan on medium heat.</p>\n<p>Add in ground beef.</p>\n<p>Scramble-fry for about 10 minutes until no longer pink. Drain. Transfer to medium bowl. Cool. Add in rest of ingredients and stir.</p>\n<p>Roll out one shell slightly larger then the other, about 1/8\" thick and place in 9\" pie plate.</p>\n<p>Spoon beef mixture into shell.</p>\n<p>Roll out other shell and place on top of pie mixture.</p>\n<p>Dampen edge of shell with water.</p>\n<p>Trim and crimp decorative edge to seal.</p>\n<p>Cut 2 or 3 vents in top to allow steam to escape.</p>\n<p>Bake on bottom rack at 400 degrees for 15 minutes.</p>\n<p>Reduce heat to 350 degrees and bake for another 35 to 40 minutes until golden.</p>\n<p>Let stand on wire rack for 10 minutes before serving.</p>',  '10.jpg', 5,  6,  25, 0,  0,  73, 'Company\'s Coming',  NULL, '<p>436 calories per wedge</p>',  5,  2,  2,  '2019-02-19 19:02:00',  '2019-02-13 14:13:21',  NULL, '2016-10-02 18:25:20',  '2019-02-22 03:08:12'),
(11,  'Classic Meatloaf', '<p>1 egg</p>\n<p>3/4 cup of quick-cooking rolled oats</p>\n<p>3/4 cup of milk</p>\n<p>1/4 cup on minced onion or 1 tablespoon of onion flakes</p>\n<p>1 teaspoon of parsley flakes</p>\n<p>1 teaspoon of Worcestershire sauce</p>\n<p>1 1/2 teaspoons of salt</p>\n<p>1/4 teaspoon of pepper</p>\n<p>1 1/2 pounds of ground beef</p>\n<p>1 cup of grated medium cheddar cheese</p>\n<p>1/4 cup of ketchup</p>',  '<p>Combine first 8 ingredients in a large bowl.</p>\n<p>Add ground beef.</p>\n<p>Mix well.</p>\n<p>Press 1/2 beef mixture into a 9x5x3 inch loaf pan.</p>\n<p>Sprinkle with cheese.</p>\n<p>Press in remaining beef mixture.</p>\n<p>Spread ketchup on top of beef mixture.</p>\n<p>Bake, uncovered at 350 degrees for 1 1/4 hours to 1 1/2 hours until fully cooked and internal temperature of beef reaches 160 degrees Fahrenheit.</p>\n<p>Let stand for 10 minutes.</p>\n<p>Cuts into 12 slices.</p>', '11.jpg', 5,  6,  35, 0,  0,  137,  'Company\'s Coming',  NULL, NULL, 2,  2,  2,  '2019-05-16 13:02:06',  '2016-02-13 14:13:21',  NULL, '2016-10-02 18:27:37',  '2019-05-16 17:02:06'),
(13,  'Fruity Burritos',  '<p>2/3 cup of fresh raspberries</p>\n<p>1/3 cup of fresh blueberries (or frozen, thawed)</p>\n<p>1/3 cup of sliced strawberries</p>\n<p>1/4 cup of low fat creamed cottage cheese</p>\n<p>4 teaspoons of skim milk</p>\n<p>3/4 teaspoon of lemon juice</p>\n<p>1/2 teaspoon of liquid sweetener</p>\n<p>8 flour tortillas (6 inch) warmed</p>',  '<p>Combine fruit in a shallow dish. Stir gently to mix.</p>\n<p>Measure cottage cheese, milk, lemon juice and sweetener into a blender. Process until smooth.</p>\n<p>Fold warm tortillas in half and then in half again.Lift 1 side to form a hollow.</p>\n<p>Spoon about 2 1/2 tablespoons or about 1/8 of fruit into hollow.</p>\n<p>Add about 1 teaspoon o f cottage cheese mixture.</p>\n<p>Hold tortilla upright so mixture will run down through fruit. Repeat.</p>', '13.jpg', 36, 8,  25, 0,  0,  25, 'Company\'s Coming',  NULL, NULL, 2,  2,  2,  '2019-02-19 19:14:40',  '2019-02-13 14:13:21',  NULL, '2016-10-02 18:31:35',  '2019-02-20 00:14:40'),
(14,  'Lasagna',  '<p>1 tablespoon vegetable oil</p>\n<p>1 medium onion, chopped</p>\n<p>2 pounds ground beef</p>\n<p>1 garlic clove - finely chopped</p>\n<p>2 cans pizza sauce - regular</p>\n<p>1 can sliced mushrooms</p>\n<p>1/2 cup water or mushroom juice</p>\n<p>1 teaspoon oregano</p>\n<p>1 cup cheddar cheese</p>\n<p>1/3 cup Parmesan cheese</p>\n<p>1 tablespoon salt</p>\n<p>1 pack lasagna pasta</p>\n<p>Mozzarella cheese - sliced</p>', '<p>Cook pasta to liking</p>\n<p>Mix all ingredients, except cheese and cook</p>\n<p>Lay lasagna layer, meat layer, until none are left</p>\n<p>Spread Mozzarella cheese on top and cook</p>',  '14.jpg', 5,  8,  35, 0,  0,  36, '', '', '', 2,  2,  2,  '2016-10-02 11:33:31',  '2019-02-13 14:13:21',  NULL, '2016-10-02 18:33:30',  '2019-02-13 17:29:49'),
(15,  'Carrot Muffins', '<p>4 cups of white sugar</p>\n<p>2 teaspoons of cinnamon</p>\n<p>2 teaspoons of baking soda</p>\n<p>2 teaspoons of baking powder</p>\n<p>5 cups of flour</p>\n<p>1 teaspoon of salt</p>\n<p>2 1/2 cups of cooking oil</p>\n<p>6 cups of grated carrots</p>\n<p>8 eggs (whipped)</p>',  '<p>Mix sugar, cinnamon, baking soda, baking powder, flour and salt together. Then add oil, carrots and eggs. Place mixture into muffin cups. Bake at 325 degrees for about 20-25 minutes or until golden brown.</p>',  '15.jpg', 1,  90, 30, 0,  0,  23, 'Recipe Box', '', '', 2,  2,  2,  '2016-10-02 11:35:01',  '2019-02-28 22:53:42',  NULL, '2016-10-02 18:35:01',  '2019-03-01 03:53:42'),
(16,  'Macaroni Salad', '<p>1 cup of real mayonnaise</p>\n<p>2 tablespoons of vinegar</p>\n<p>1 tablespoon of prepared mustard</p>\n<p>1 teaspoon of salt</p>\n<p>1/4 teaspoon of pepper</p>\n<p>8 ounces of macaroni</p>\n<p>1 cup of sliced celery</p>\n<p>1 cup of chopped green pepper</p>\n<p>1/4 cup of onion</p>', '<p>In a large bowl, stir together mayonnaise, vinegar, mustard, sugar, salt, and pepper until smooth.</p>\n<p>Add remaining ingredients, toss to coat well.</p>\n<p>Cover and chill</p>',  '16.jpg', 34, 0,  20, 0,  0,  22, 'Recipe Box', '<p>hghgfhgfhf</p>',  NULL, 2,  2,  2,  '2019-04-01 15:28:38',  '2019-02-13 14:13:21',  NULL, '2016-10-02 18:36:29',  '2019-04-01 19:28:38'),
(17,  'Macaroni And Cheese',  '<p>2 cups of macaroni</p>\n<p>2 tablespoons of butter</p>\n<p>2 tablespoons of flour</p>\n<p>salt and pepper to taste</p>\n<p>2 cups of milk</p>\n<p>2 cups of grated cheddar cheese (or cheddar &amp; colby - colby makes a smoother sauce)</p>', '<p>Cook macaroni until tender. Make a roux of butter, flour, salt and pepper. Add milk and cook on stove top or microwave stirring regularily to make a smooth cream sauce. In a large buttered casserole dish combine: macaroni, sauce and cheese. Stir until mixed. Bake at 300 degrees for 20 minutes.</p>',  '17.jpg', 1,  0,  30, 0,  0,  23, 'Recipe Box', '', '<p>Variations: add onions and peppers (sauteed), add sliced hot dog pieces topped with buttered bread crumbs.</p>',  2,  2,  2,  '2016-10-02 11:38:18',  '2019-02-13 14:13:21',  NULL, '2016-10-02 18:38:17',  '2019-02-13 19:09:45'),
(18,  'Pork Chops A La Ruth', '<p>Salt</p>\n<p>Pepper</p>\n<p>Flour</p>\n<p>Pork Chops</p>\n<p>Sliced Onions</p>\n<p>1/3 cup of water</p>\n<p>1/3 cup of ketchup</p>\n<p>3 tablespoons of brown sugar</p>', '<p>Mix together salt, pepper and flour (the amounts are your own choice)</p>\n<p>Coat pork chops with the flour mixture and brown chops on both sides in a frying pan. Place chops on the bottom of a roasting pan. Slice onions and place them on top of pork chops. Mix water, ketchup and brown sugar together and pour over top of chops. Bake at 300 degrees for approximately an hour.</p>', '18.jpg', 6,  4,  20, 0,  0,  20, 'Recipe Box', '', '<p>You may increase the sauce depending on the number of chops. Each batch covers approximately 4 chops.</p>\n<p>From my experience the best type of chops to use for this recipe is boneless.</p>', 2,  2,  2,  '2016-10-02 11:40:16',  '2019-02-13 14:13:21',  NULL, '2016-10-02 18:40:15',  '2019-02-13 19:09:45'),
(19,  'Spiced Fruit Salad', '<p>2 cups of halved seedless grapes</p>\n<p>2 cups of cubed honeydew</p>\n<p>1 can of drained pineapple chunks (14 oz.)</p>\n<p>1 can of sliced peaches in juice (drained but juice reserved) peaches chopped</p>\n<p>Reserved peach juice</p>\n<p>1 teaspoon of vanilla extract</p>\n<p>1/2 teaspoon of ground ginger</p>\n<p>1/4 teaspoon of ground allspice</p>', '<p>Combine first four ingredients in large bowl.</p>\n<p>Combine remaining 4 ingredients in small bowl.</p>\n<p>Add to fruit. Stir until coated. Chill, covered, for at least 6 hours to blend flavours.</p>', '19.jpg', 36, 6,  20, 0,  0,  17, 'Company\'s Coming',  NULL, '<p>97 calories per serving</p>', 2,  2,  2,  '2019-03-03 17:14:58',  '2019-02-17 19:27:37',  NULL, '2016-10-02 18:42:26',  '2019-05-29 16:01:14'),
(20,  'Snow Angel Trifle',  '<p>4 cups of milk</p>\n<p>2 boxes of instant white chocolate (or vanilla) pudding powder (4 serving size, each)</p>\n<p>17 oz. angel food cake torn into 1 inch pieces</p>\n<p>1-8 oz package of cream-filled chocolate mini cookies (12 reserved for garnish</p>\n<p>3 cups of sliced strawberries</p>\n<p>2 cups of frozen whipped topping, thawed</p>', '<p>Beat milk and pudding powder on low in a medium bowl for about 2 minutes until thickened.</p>\n<p>Layer ingredients in a large glass serving bowl as follows:</p>\n<p>1/2 of cake pieces</p>\n<p>1/2 of cookies</p>\n<p>1/2 of strawberry slices</p>\n<p>2 cups of pudding, spread evenly</p>\n<p>Remaining cake pieces</p>\n<p>Remaining cookies</p>\n<p>Remaining strawberry slices</p>\n<p>Remaining pudding, spread evenly</p>\n<p>Spread or pipe whipped topping in a decorative pattern on top of pudding. Garnish with reserved cookies. Chill for at least 4 hours to blend flavours.</p>', '20.jpeg',  36, 12, 45, 0,  0,  16, 'Company\'s Coming',  '', '', 2,  2,  3,  '2016-10-02 12:32:00',  '2019-02-13 14:13:21',  NULL, '2016-10-02 18:44:42',  '2019-03-01 03:53:57'),
(21,  'Chocolate And Pear Muffins', '<p>2 cups of all purpose flour</p>\n<p>1 1/3 chopped peeled fresh pear</p>\n<p>3/4 of packed brown sugar</p>\n<p>3 1/2 milk chocolate bar, chopped</p>\n<p>2 teaspoons of baking powder</p>\n<p>1/4 teaspoon of ground cinnamon</p>\n<p>1/4 of salt</p>\n<p>1 large egg</p>\n<p>3/4 cup of buttermilk</p>\n<p>1/2 cup of cooking oil</p>', '<p>Combine the first 7 ingredients in a large bowl. Make a well in centre.</p>\n<p>Beat remaining 3 ingredients with whisk in small bowl. Add to well in large bowl. Stir until just moistened. Fill 12 greased muffins cups 3/4 full.</p>\n<p>Bake in 375 degree oven for about 25 minutes until wooden pick inserted in centre of muffin comes out clean. Let stand in pan for 5 minutes before removing to wire rack to cool.</p>', '21.jpg', 1,  12, 30, 0,  0,  29, 'Company\'s Coming',  '', '<p>Muffins may be stored in an airtight container for up to 3 months.</p>',  2,  2,  2,  '2016-10-02 11:46:42',  '2019-02-13 14:13:21',  NULL, '2016-10-02 18:46:42',  '2019-02-17 23:39:27'),
(22,  'Chocolate Peanut Butter Bars', '<p>2 cups of quick-cooking oats</p>\n<p>1 3/4 cups of firmly packed light brown sugar</p>\n<p>1 1/2 cups of all purpose flour</p>\n<p>1 teaspoon of baking powder</p>\n<p>1/2 teaspoon of baking soda</p>\n<p>1 cup of butter</p>\n<p>1/2 cup of chopped peanuts</p>\n<p>1 cup (6 oz. pkg.) of semi-sweet chocolate chips</p>\n<p>1 large egg, beaten</p>\n<p>1 (14 oz.) can of sweetened condensed milk</p>\n<p>1/2 cup of creamy peanut butter</p>', '<p>HEAT oven to 350Â°F.</p>\n<p>Combine oats, brown sugar, flour, baking powder and baking soda in large bowl. Cut in butter with pastry blender or 2 knives until mixture resembles fine crumbs. Stir in peanuts.</p>\n<p>RESERVE 1 1/2 cups crumb mixture. Stir egg into remaining crumb mixture.</p>\n<p>Press onto bottom of 13 x 9-inch baking pan.</p>\n<p>BAKE 15 minutes.</p>\n<p>STIR together sweetened condensed milk and peanut butter in small bowl until well combined. Pour evenly over partially baked crust.</p>\n<p>STIR together reserved crumb mixture and chocolate chips. Sprinkle evenly over peanut butter layer.</p>\n<p>BAKE an additional 15 minutes. Cool. Cut into bars.</p>',  '22.jpg', 1,  12, 30, 30, 0,  14, 'Recipe Box', '', '', 2,  2,  2,  '2016-10-02 11:49:30',  '2019-02-28 22:53:42',  NULL, '2016-10-02 18:49:30',  '2019-03-01 03:53:42'),
(23,  'Baked Soup', '<p>2 pounds of sausage</p>\n<p>3 cups of chopped carrots</p>\n<p>3 cups of chopped celery</p>\n<p>Cabbage to taste (1 use about 1 cup and sometimes substitute leeks)</p>\n<p>1 cup of chopped onions</p>\n<p>2-28 ounce cans of tomatoes with herbs and spices</p>\n<p>3 cloves of minced garlic</p>\n<p>1 tablespoon of basil</p>\n<p>8-10 cups of chicken or beef stock ( I use 1/2 and 1/2)</p>\n<p>Parmesan cheese to grate on top at serving</p>', '<p>Brown sausage and chop into chunks. place in large roasting pan. Cook onion and garlic in the same pan as sausage until transparent and add to roasting pan. Add all other ingredients, cover and bake in oven at 350 degrees for 3-4 hours. About half hour before serving add 1 1/2 cups of el dente cooked pasta. I like fusilli. Top with cheese and enjoy!</p>', '23.jpeg',  39, 10, 30, 180,  0,  67, 'Recipe Box', '', '', 4,  3,  2,  '2018-02-01 14:07:56',  '2019-02-28 22:53:42',  NULL, '2016-10-02 18:52:19',  '2019-03-01 03:53:42'),
(24,  'Chocolate Banana Crepes',  '<p>1 cup of all-purpose flour</p>\n<p>3 tablespoon of unsweetened dutch cocoa powder</p>\n<p>1 tablespoon of powdered sugar</p>\n<p>1 1/2 cups of milk</p>\n<p>2 large egg whites</p>\n<p>1 whole egg</p>\n<p>1 tsp. of oil</p>\n<p>3 bananas, sliced</p>\n<p>Whipped cream (homemade or store-bought)</p>\n<p>Chocolate chips, for sprinkling (optional)</p>\n<p>Chocolate syrup, for drizzling</p>', '<p>In a large bowl, whisk together flour, milk, cocoa powder, powdered sugar, eggs and oil until smooth. (You can also do this with an electric mixer.)</p>\n<p>Heat a large nonstick pan on medium-low heat, and grease with cooking spray. Pour 1/4 cup crepe mixture into pan, immediately the pan so that the batter spreads out thin into a large circle. Cook for 1 to 2 minutes or until bottom of crepe is light golden brown. Flip; cook 30 seconds to 1 minute or until light golden brown. Repeat with remaining cooking spray and crepe mixture.</p>\n<p>To serve, spoon whipped cream into center of each crepe. Top with sliced bananas and fold each edge of crepe over filling. Drizzle with chocolate syrup and any additional toppings. Serve warm.</p>',  '24.jpg', 1,  12, 30, 0,  0,  13, 'Recipe Box', '', '<p>This batter will also keep in the refrigerator for up to a day.</p>', 4,  2,  3,  '2016-10-02 12:32:22',  '2019-02-13 14:13:21',  NULL, '2016-10-02 18:55:51',  '2019-02-17 13:08:22'),
(25,  'Strawberry Cream Cheese Cobbler',  '<p>1 stick (1/2 cup) of butter</p>\n<p>1 egg, lightly beaten</p>\n<p>1 cup of milk</p>\n<p>1 cup of all-purpose flour</p>\n<p>1 cup of sugar</p>\n<p>2 teaspoons of baking powder</p>\n<p>1/2 teaspoon of salt</p>\n<p>2 quarts of whole strawberries, capped and washed</p>\n<p>4 ounces of cream cheese, cut in small pieces</p>\n<p>Vanilla ice cream for serving, optional</p>', '<p>Preheat oven to 350 F. Melt butter and pour into a 9x13-inch glass baking dish. In a small bowl, mix together the egg, milk, flour, sugar, baking powder and salt. Pour directly over the butter in the baking dish, but do not stir.</p>\n<p>Add the strawberries, arranging in a single layer as much as possible. Sprinkle cream cheese pieces over strawberries. Place in preheated oven and bake for 45 minutes, or until top is golden brown and edges are bubbling. (Crust rises up and around the fruit, but fruit will still peek out of top.)</p>\n<p>Serve hot out of the oven with choice of topping, if desired.</p>', '25.jpg', 1,  10, 30, 45, 0,  3,  'Company\'s Coming',  '', '', 4,  2,  2,  '2016-10-02 11:58:10',  '2019-02-13 14:13:21',  NULL, '2016-10-02 18:58:10',  '2019-03-01 03:53:51'),
(26,  'Molasses Cake',  '<p>2 cups of molasses</p>\n<p>2 tbsp of lard or shortening</p>\n<p>1/2 tsp of baking soda</p>\n<p>1 tsp of baking powder</p>\n<p>3 cups of all purpose flour</p>\n<p>1 cup of boiling water</p>\n<p>1/2 tsp of salt</p>',  '<p>Mix baking soda and boiling water.</p>\n<p>Add the rest of the ingredients.</p>\n<p>Grease and flour pan.</p>\n<p>Bake at 350\'\'F for 40 minutes.</p>',  '26.jpg', 8,  10, 50, 40, 0,  43, 'Mom\'s recipe book', '', '', 4,  2,  2,  '2016-10-02 11:59:47',  '2019-02-13 14:13:21',  NULL, '2016-10-02 18:59:47',  '2016-10-02 18:59:47'),
(27,  'Butter Tarts', '<p>2 eggs</p>\n<p>2 cups of brown sugar</p>\n<p>2 teaspoons of vinegar</p>\n<p>1 teaspoon of vanilla</p>\n<p>1/2 cup of melted butter</p>\n<p>2 cups of raisins</p>\n<p>1 cup of chopped walnuts</p>', '<p>Beat eggs until yolks and whites are well blended not frothy.</p>\n<p>Beat in brown sugar, vanilla and vinegar.</p>\n<p>Stir in melted butter, raisins and walnuts.</p>\n<p>Bake at 350 degrees about 15 minutes in unbaked pastry shells (about 1 tablespoon in each)</p>',  '27.jpg', 9,  36, 30, 20, 0,  37, 'Recipe Box', NULL, '<p>Old family recipe</p>', 2,  2,  2,  '2019-05-16 14:29:48',  '2019-05-16 14:18:05',  NULL, '2019-03-05 17:31:22',  '2019-05-16 18:29:48'),
(28,  'Pate Chomeur', '<p>1 cup of white sugar</p>\n<p>1 cup of milk</p>\n<p>2 cups of flour</p>\n<p>2 tsps of baking powder</p>\n<p>2 1/2 cups of brown sugar</p>\n<p>vanilla</p>',  '<p>Mix white sugar, milk, flour and baking powder.</p>\n<p>Pour mixture in ungreased 6 x 9 pan.</p>\n<p>In sperate pot, boil brown sugar, water and vanilla.</p>\n<p>Pour over dough and bake at 350 degrees F for about 30 minutes</p>',  '28.jpg', 8,  10, 20, 30, 0,  10, 'My mom\'s recipe book',  NULL, NULL, 2,  2,  2,  '2019-03-05 12:33:14',  '2019-03-01 12:32:00',  NULL, '2019-03-05 17:33:14',  '2019-03-05 17:33:14'),
(29,  'qqqqq',  '<p>asdasda</p>', '<p>vcxvxcvxcv</p>',  NULL, 32, 2,  12, 2,  0,  0,  NULL, NULL, NULL, 2,  2,  2,  '2019-05-29 12:17:40',  NULL, NULL, '2019-05-29 16:17:40',  '2019-05-29 16:17:40'),
(30,  'wwwwww', '<p>wqwqwqw</p>\n<p>cvccvc</p>\n<p>hghghghgh</p>',  '<p>qtrtrtrtrt</p>\n<p>iuiuiuiu</p>', NULL, 7,  5,  2,  4,  0,  0,  NULL, NULL, NULL, 3,  3,  3,  '2019-05-29 15:19:54',  NULL, NULL, '2019-05-29 16:40:05',  '2019-05-29 19:19:54');

DROP TABLE IF EXISTS `recipe_user`;
CREATE TABLE `recipe_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `recipe_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `favorite_recipe_user_id_foreign` (`user_id`),
  KEY `recipe_id` (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `recipe_user` (`id`, `user_id`, `recipe_id`, `created_at`, `updated_at`) VALUES
(1, 2,  1,  NULL, NULL);

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tab` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_name_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `key`, `value`, `description`, `tab`, `created_at`, `updated_at`) VALUES
(1, 'app_name', 'TheWoodBarn.ca', 'The name of the application \\ website', 'general',  NULL, '2019-05-13 18:24:57'),
(2, 'from_email', 'stleroux@hotmail.ca',  'The email address to be used when sending messages from the application \\ website', 'general',  NULL, '2019-05-13 18:24:57'),
(3, 'from_name',  'Stephane', 'The name that will appear in the From field of messages sent from the application \\ website', 'general',  NULL, '2019-05-13 18:24:57'),
(4, 'login_count_warning',  '10', 'Number of times a user must login for the First Time User block on homepage to stop appearing',  'profile',  NULL, '2019-05-13 18:24:57'),
(5, 'no_records_found', 'No records found', 'Message to display when no records are found', 'profile',  '2019-01-29 17:41:25',  '2019-05-13 18:24:57'),
(6, 'homepage_favorite_recipe_count', '5',  'Number of recipes to show on the homepage\'s Most Popular block',  'profile',  '2019-01-29 19:18:31',  '2019-05-13 18:24:57'),
(7, 'homepage_favorite_post_count', '2',  'Number of posts to show on the homepage\'s Most Popular block',  'profile',  '2019-02-02 12:02:32',  '2019-05-13 18:24:57'),
(8, 'homepage_blog_count',  '3',  'How many blog posts to display on the home page',  'profile',  '2019-02-03 17:35:58',  '2019-05-13 18:24:57'),
(9, 'authorFormat', 'first_name last_name', 'How the author name will be displayed throughout the website (username - last_name, first_name - first_name last_name)', 'general',  '2019-02-09 11:18:53',  '2019-05-13 18:24:57'),
(10,  'dateFormat', 'M d, Y', 'The date format used throughout the site. Use PHP date formats', 'general',  '2019-02-10 11:38:38',  '2019-05-13 18:24:57'),
(11,  'invoicer.companyName', 'TheWoodBarn.ca', 'Name of company to display on invoices', 'invoicer', '2019-05-13 16:31:43',  '2019-05-13 18:24:57'),
(12,  'invoicer.address_1', '1216 Ste Marie Rd',  'Value to display on invoices in the address_1 location', 'invoicer', '2019-05-13 16:35:19',  '2019-05-13 18:24:57'),
(13,  'invoicer.address_2', NULL, 'Value to display in the address_2 location on the invoices', 'invoicer', '2019-05-13 16:36:07',  '2019-05-13 18:24:57'),
(14,  'invoicer.city',  'Embrun', 'Value to display in the companyCity location on the invoices', 'invoicer', '2019-05-13 16:36:36',  '2019-05-13 18:24:57'),
(15,  'invoicer.state', 'On', 'Value to display in the state location on the invoices', 'invoicer', '2019-05-13 16:36:59',  '2019-05-13 18:24:57'),
(16,  'invoicer.zip', 'K0A 1W0',  'Value to display in the zip location on the invoices', 'invoicer', '2019-05-13 16:37:28',  '2019-05-13 18:24:57'),
(17,  'invoicer.telephone', '(613) 370-0275', 'Value to display in the telephone location on the invoices', 'invoicer', '2019-05-13 16:37:52',  '2019-05-13 18:24:57'),
(18,  'invoicer.fax', '(613) 370-0275', 'Value to display in the fax location on the invoices', 'invoicer', '2019-05-13 16:38:24',  '2019-05-13 18:24:57'),
(19,  'invoicer.email', 'stleroux@hotmail.ca',  'Value to display in the email location on the invoices', 'invoicer', '2019-05-13 16:38:45',  '2019-05-13 18:24:57'),
(20,  'invoicer.website', 'TheWoodBarn.ca', 'Value to display in the website location on the invoices', 'invoicer', '2019-05-13 16:39:12',  '2019-05-13 18:24:57'),
(21,  'invoicer.hstNo', NULL, 'Value to display in the HST No location on the invoices',  'invoicer', '2019-05-13 16:39:38',  '2019-05-13 18:24:57'),
(22,  'invoicer.wsibNo',  NULL, 'Value to display in the WSIB No location on the invoices', 'invoicer', '2019-05-13 16:40:01',  '2019-05-13 18:24:57'),
(23,  'invoicer.termsAndConditions',  NULL, 'Value to display in the Terms and conditions location on the invoices',  'invoicer', '2019-05-13 16:40:32',  '2019-05-13 18:24:57'),
(24,  'invoicer.hstRate', '0.13', 'Value to display in the HST Rate location on the invoices',  'invoicer', '2019-05-13 16:40:51',  '2019-05-13 18:24:57'),
(25,  'invoicer.wsibRate',  '.12',  'Value to display in the WSIB Rate location on the invoices', 'invoicer', '2019-05-13 16:41:17',  '2019-05-13 18:24:57'),
(26,  'invoicer.incomeTaxRate', '0.26', 'Value to display in the Income Tax Rate location on the invoices', 'invoicer', '2019-05-13 16:41:51',  '2019-05-13 18:24:57'),
(27,  'invoicer.version', '2.0',  'Value to display in the version location on the invoices', 'invoicer', '2019-05-13 16:42:15',  '2019-05-13 18:24:57');

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Test', '2018-12-28 15:20:10',  '2018-12-28 15:20:10'),
(2, 'Stephane', '2018-12-28 15:23:00',  '2018-12-28 15:23:00');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `public_email` int(10) unsigned NOT NULL DEFAULT '0',
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_date` datetime NOT NULL,
  `login_count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `username`, `email`, `public_email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `last_login_date`, `login_count`) VALUES
(1, 'administrator',  'admin@thewoodbarn.ca', 0,  NULL, '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe', NULL, '2019-02-12 16:58:45',  NULL, '2019-02-12 11:58:45',  0),
(2, 'lerouxs',  'stleroux@hotmail.ca',  1,  NULL, '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe', '3MbflIhg7EjmDHbqQjUgEZJQiUNEexuK8R7uQhrqCFcEbUCTcIAc7uRZfJIY', '2018-10-24 20:31:15',  '2019-08-02 02:04:43',  '2019-08-01 22:04:43',  25),
(3, 'hayness',  'stacie@hotmail.com', 0,  NULL, '$2y$10$968BD2.11mQxrGfKeBWRj.dcgWLalEGjWHX1XKmxk.H.ZP6YPLGau', '55DOB2ljWdlxmhPsrdHq4RPmZLmlSJUgZqAotkJcpUIYEall3mD2hPJZoXHs', '2018-11-02 15:55:55',  '2018-11-02 15:55:55',  '0000-00-00 00:00:00',  0),
(4, 'lerouxh',  'hugues.leroux@rogers.com', 0,  NULL, '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe', NULL, '2019-02-12 16:59:48',  NULL, '2019-02-12 11:17:35',  0),
(5, 'leveillel',  'luc.leveille@icloud.com',  0,  NULL, '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe', NULL, '2019-02-12 17:00:21',  NULL, '2019-02-12 11:15:48',  0),
(6, 'tremblayj',  'julien.tremblay@dfo-mpo.gc.ca',  0,  NULL, '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe', NULL, '2019-02-12 17:02:16',  NULL, '2019-02-12 12:02:16',  0),
(7, 'haynesb',  'brenda.haynes@hotmail.com',  0,  NULL, '$2y$10$a3VOdvKkx9i6yZ3soekk/uhxC8mX76Enn9KJeOCilynZhHQvzitFe', NULL, '2019-02-12 17:02:46',  NULL, '2019-02-12 12:02:46',  0);

-- 2019-08-02 03:14:22
