CREATE TABLE IF NOT EXISTS `calendar` (
`calendar_desc` VARCHAR(35) NULL,
`calendar_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`calendar_title` VARCHAR(10) NULL,
`calendar_start` int(10) DEFAULT '0',
`calendar_end` int(10) DEFAULT '0',
PRIMARY KEY (`calendar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `chat` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`chat_id` VARCHAR(24) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `chat_dialog` (
`chat_id` int(10) unsigned DEFAULT '0',
`chat_dialog_message` VARCHAR(96) NULL,
`chat_dialog_time` VARCHAR(24) NULL,
`chat_dialog_who` VARCHAR(24) NULL
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `chat_contacts` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`user_id` int(10) unsigned DEFAULT '0',
`chat_contacts_avatar` VARCHAR(33) NULL,
`chat_contacts_id` VARCHAR(24) NULL,
`chat_contacts_mood` VARCHAR(58) NULL,
`chat_contacts_name` VARCHAR(7) NULL,
`chat_contacts_status` VARCHAR(14) NULL,
`chat_contacts_unread` INT NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `chat_user` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`chat_user_avatar` VARCHAR(33) NULL,
`chat_user_id` VARCHAR(24) NULL,
`chat_user_mood` VARCHAR(34) NULL,
`chat_user_name` VARCHAR(8) NULL,
`chat_user_status` VARCHAR(6) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `chat_user_chat_list` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`user_id` int(10) unsigned DEFAULT '0',
`chat_id` int(10) unsigned DEFAULT '0',
`contact_id` int(10) unsigned DEFAULT '0',
`chat_user_chat_list_chat_id` VARCHAR(24) NULL,
`chat_user_chat_list_contact_id` VARCHAR(24) NULL,
`chat_user_chat_list_last_message_time` VARCHAR(24) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS contacts (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`contacts_address` VARCHAR(39) NULL,
`contacts_avatar` VARCHAR(53) NULL,
`contacts_company` VARCHAR(10) NULL,
`contacts_email` VARCHAR(24) NULL,
`contacts_id` VARCHAR(24) NULL,
`contacts_job_title` VARCHAR(21) NULL,
`contacts_last_name` VARCHAR(10) NULL,
`contacts_name` VARCHAR(7) NULL,
`contacts_nickname` VARCHAR(10) NULL,
`contacts_notes` VARCHAR(0) NULL,
`contacts_phone` VARCHAR(15) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS file_manager (
`file_manager_files_created` VARCHAR(12) NULL,
`file_manager_files_extention` VARCHAR(0) NULL,
`file_manager_files_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`file_manager_files_location` VARCHAR(20) NULL,
`file_manager_files_modified` VARCHAR(12) NULL,
`file_manager_files_name` VARCHAR(17) NULL,
`file_manager_files_opened` VARCHAR(12) NULL,
`file_manager_files_owner` VARCHAR(13) NULL,
`file_manager_files_preview` VARCHAR(41) NULL,
`file_manager_files_size` VARCHAR(6) NULL,
`file_manager_files_type` VARCHAR(8) NULL,
PRIMARY KEY (`file_manager_files_id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS mail (
     `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `mail_id` VARCHAR(19) CHARACTER SET utf8,
    `mail_from_name` VARCHAR(16) CHARACTER SET utf8,
    `mail_from_avatar` VARCHAR(33) CHARACTER SET utf8,
    `mail_from_email` VARCHAR(28) CHARACTER SET utf8,
    `mail_to_name` VARCHAR(2) CHARACTER SET utf8,
    `mail_to_email` VARCHAR(20) CHARACTER SET utf8,
    `mail_subject` VARCHAR(87) CHARACTER SET utf8,
    `mail_message` INT (10) default 0,
    `mail_time` VARCHAR(6) CHARACTER SET utf8,
    `mail_read` VARCHAR(5) CHARACTER SET utf8,
    `mail_starred` VARCHAR(5) CHARACTER SET utf8,
    `mail_important` VARCHAR(5) CHARACTER SET utf8,
    `mail_hasAttachments` VARCHAR(5) CHARACTER SET utf8,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS mail_attachments (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`mail_id` int(10) unsigned DEFAULT '0',
    `mail_attachments_type` VARCHAR(5) CHARACTER SET utf8,
    `mail_attachments_fileName` VARCHAR(7) CHARACTER SET utf8,
    `mail_attachments_preview` VARCHAR(35) CHARACTER SET utf8,
    `mail_attachments_url` VARCHAR(25) NULL,
    `mail_attachments_size` VARCHAR(5) CHARACTER SET utf8,
    `mail_labels` INT (10) default 0,
    `mail_folder` INT (10) default 0,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS mail_folders (
    `folders_id` INT (10),
    `folders_handle` VARCHAR(6) CHARACTER SET utf8,
    `folders_title` VARCHAR(6) CHARACTER SET utf8,
    `folders_icon` VARCHAR(10) CHARACTER SET utf8
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS mail_filters (
    `filters_id` INT (10),
    `filters_handle` VARCHAR(9) CHARACTER SET utf8,
    `filters_title` VARCHAR(9) CHARACTER SET utf8,
    `filters_icon` VARCHAR(5) CHARACTER SET utf8
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS mail_labels (
    `labels_id` INT (10),
    `labels_handle` VARCHAR(7) CHARACTER SET utf8,
    `labels_title` VARCHAR(7) CHARACTER SET utf8,
    `labels_color` VARCHAR(7) CHARACTER SET utf8
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `notes` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`notes_description` VARCHAR(34) NULL,
`notes_id` VARCHAR(24) NULL,
`notes_image` VARCHAR(30) NULL,
`notes_reminder` VARCHAR(24) NULL,
`notes_time` VARCHAR(24) NULL,
`notes_title` VARCHAR(34) NULL,
`notes_nlabels` VARCHAR(24) NULL,
`notes_user` int(10) DEFAULT '0',
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `notes_checklist` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`notes_checklist_id` INT NULL,
`notes_id` INT NULL,
`notes_checklist_text` VARCHAR(36) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `notes_labels` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`notes_labels_handle` VARCHAR(8) NULL,
`notes_labels_id` VARCHAR(24) NULL,
`notes_labels_name` VARCHAR(8) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS profile_about (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`user_id` int(10) DEFAULT '0',
`profile_about_contact_address` VARCHAR(121) NULL,
`profile_about_groups_category` VARCHAR(10) NULL,
`profile_about_work_jobs_date` VARCHAR(11) NULL,
`profile_about_general_locations` VARCHAR(13) NULL,
`profile_about_groups_members` VARCHAR(9) NULL,
`profile_about_friends_avatar` VARCHAR(33) NULL,
`profile_about_friends_id` INT NULL,
`profile_about_general_about` VARCHAR(289) NULL,
`profile_about_work_jobs_company` VARCHAR(13) NULL,
`profile_about_contact_websites` VARCHAR(16) NULL,
`profile_about_friends_name` VARCHAR(14) NULL,
`profile_about_groups_id` INT NULL,
`profile_about_general_gender` VARCHAR(4) NULL,
`profile_about_work_occupation` VARCHAR(9) NULL,
`profile_about_contact_emails` VARCHAR(21) NULL,
`profile_about_groups_name` VARCHAR(7) NULL,
`profile_about_general_birthday` VARCHAR(19) NULL,
`profile_about_contact_tel` VARCHAR(11) NULL,
`profile_about_work_skills` VARCHAR(43) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS profile_photos_videos (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`user_id` int(10) DEFAULT '0',
`profile_photos_videos_id` INT NULL,
`profile_photos_videos_info` VARCHAR(18) NULL,
`profile_photos_videos_media_title` VARCHAR(22) NULL,
`profile_photos_videos_name` VARCHAR(10) NULL,
`profile_photos_videos_media_preview` VARCHAR(54) NULL,
`profile_photos_videos_media_type` VARCHAR(5) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS profile_timeline (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`user_id` int(10) DEFAULT '0',
`profile_timeline_posts_share` INT NULL,
`profile_timeline_posts_article_media_type` VARCHAR(5) NULL,
`profile_timeline_posts_message` VARCHAR(216) NULL,
`profile_timeline_posts_media_preview` VARCHAR(37) NULL,
`profile_timeline_posts_id` INT NULL,
`profile_timeline_posts_article_media_preview` VARCHAR(45) NULL,
`profile_timeline_activities_user_avatar` VARCHAR(33) NULL,
`profile_timeline_posts_comments_message` VARCHAR(195) NULL,
`profile_timeline_posts_media_type` VARCHAR(5) NULL,
`profile_timeline_posts_comments_user_avatar` VARCHAR(31) NULL,
`profile_timeline_posts_comments_id` INT NULL,
`profile_timeline_activities_time` VARCHAR(12) NULL,
`profile_timeline_posts_time` VARCHAR(14) NULL,
`profile_timeline_posts_like` INT NULL,
`profile_timeline_activities_user_name` VARCHAR(14) NULL,
`profile_timeline_posts_user_avatar` VARCHAR(32) NULL,
`profile_timeline_posts_article_title` VARCHAR(20) NULL,
`profile_timeline_posts_article_subtitle` VARCHAR(13) NULL,
`profile_timeline_posts_comments_time` VARCHAR(13) NULL,
`profile_timeline_activities_message` VARCHAR(39) NULL,
`profile_timeline_posts_user_name` VARCHAR(14) NULL,
`profile_timeline_activities_id` INT NULL,
`profile_timeline_posts_type` VARCHAR(9) NULL,
`profile_timeline_posts_comments_user_name` VARCHAR(13) NULL,
`profile_timeline_posts_article_excerpt` VARCHAR(136) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS scrumboard (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`scrumboard_boards_name` VARCHAR(25) NULL,
`scrumboard_boards_id` VARCHAR(8) NULL,
`scrumboard_boards_uri` VARCHAR(25) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS scrumboard_settings(
`board_id` int(10) unsigned DEFAULT '0',
`scrumboard_boards_settings_color` VARCHAR(9) NULL,
`scrumboard_boards_settings_subscribed` tinyint(1) default 0,
`scrumboard_boards_settings_cardCoverImages` tinyint(1) default 0
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS scrumboard_boards_lists (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`board_id` int(10) unsigned DEFAULT '0',
`scrumboard_boards_lists_id` VARCHAR(84) NULL,
`scrumboard_boards_lists_name` VARCHAR(17) NULL,
`scrumboard_boards_lists_id_cards` VARCHAR(84) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS scrumboard_boards_cards (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`list_id` int(10) unsigned DEFAULT '0',
`scrumboard_boards_cards_due` VARCHAR(24) NULL,
`scrumboard_boards_cards_id` VARCHAR(84) NULL,
`scrumboard_boards_cards_name` VARCHAR(36) NULL,
`scrumboard_boards_cards_description` VARCHAR(104) NULL,
`scrumboard_boards_cards_activities_id` INT NULL,
`scrumboard_boards_cards_attachments_type` VARCHAR(5) NULL,
`scrumboard_boards_cards_id_members` VARCHAR(24) NULL,
`scrumboard_boards_cards_id_labels` VARCHAR(24) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS scrumboard_attachments (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`card_id` int(10) unsigned DEFAULT '0',
`scrumboard_boards_cards_attachments_id` VARCHAR(24) NULL,
`scrumboard_boards_cards_id_attachment_cover` VARCHAR(24) NULL,
`scrumboard_boards_cards_attachments_src` VARCHAR(37) NULL,
`scrumboard_boards_cards_attachments_name` VARCHAR(23) NULL,
`scrumboard_boards_cards_attachments_url` VARCHAR(37) NULL,
`scrumboard_boards_cards_attachments_time` VARCHAR(22) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS scrumboard_activities (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`card_id` int(10) unsigned DEFAULT '0',
`scrumboard_boards_cards_activities_time` VARCHAR(12) NULL,
`scrumboard_boards_cards_activities_id_member` VARCHAR(24) NULL,
`scrumboard_boards_cards_activities_type` VARCHAR(10) NULL,
`scrumboard_boards_cards_activities_message` VARCHAR(97) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS scrumboard_checklists (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`card_id` int(10) unsigned DEFAULT '0',
`scrumboard_boards_cards_checklists_name` VARCHAR(14) NULL,
`scrumboard_boards_cards_checklists_check_items_name` VARCHAR(66) NULL,
`scrumboard_boards_cards_checklists_check_items_id` INT NULL,
`scrumboard_boards_cards_checklists_id` VARCHAR(84) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS scrumboard_members (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`board_id` int(10) unsigned DEFAULT '0',
scrumboard_boards_members_id VARCHAR(24) NULL,
scrumboard_boards_members_name VARCHAR(15) NULL,
scrumboard_boards_members_avatar VARCHAR(35) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS scrumboard_labels (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`board_id` int(10) unsigned DEFAULT '0',
`scrumboard_boards_labels_id` VARCHAR(24) NULL,
`scrumboard_boards_labels_class` VARCHAR(20) NULL,
`scrumboard_boards_labels_name` VARCHAR(13) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS todo (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`todo_id` VARCHAR(24) NULL,
`todo_notes` VARCHAR(104) NULL,
`todo_title` VARCHAR(38) NULL,
`todo_startdate` int(10) DEFAULT '0',
`todo_duedate` int(10) DEFAULT '0',
`todo_completed` tinyint(1) unsigned DEFAULT NULL,
`todo_starred` tinyint(1) unsigned DEFAULT NULL,
`todo_important` tinyint(1) unsigned DEFAULT NULL,
`todo_deleted` tinyint(1) unsigned DEFAULT NULL,
`todo_labels` text,
`todo_user` int(10) DEFAULT '0',
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS todo_filters (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`todo_filters_handle` VARCHAR(9) NULL,
`todo_filters_icon` VARCHAR(8) NULL,
`todo_filters_id` INT NULL,
`todo_filters_title` VARCHAR(8) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS todo_folders (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`todo_folders_handle` VARCHAR(3) NULL,
`todo_folders_icon` VARCHAR(13) NULL,
`todo_folders_id` INT NULL,
`todo_folders_title` VARCHAR(3) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS todo_labels (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`todo_labels_color` VARCHAR(7) NULL,
`todo_labels_handle` VARCHAR(8) NULL,
`todo_labels_id` INT NULL,
`todo_labels_title` VARCHAR(8) NULL,
PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

