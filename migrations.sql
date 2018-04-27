Migration table created successfully.

CreateUsersTable: create table `users` (`id` int unsigned not null auto_increment primary key, `email` varchar(191) not null, `password` varchar(191) null, `valid_step` int not null default '0', `valid_at` timestamp null, `token` varchar(191) null, `ip_token` varchar(191) null, `confirmed` int not null default '0', `confirmed_at` timestamp null, `referred_by` varchar(191) null, `affiliate_id` varchar(191) not null, `remember_token` varchar(100) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate utf8mb4_unicode_ci
CreateUsersTable: alter table `users` add unique `users_email_unique`(`email`)
CreateUsersTable: alter table `users` add unique `users_affiliate_id_unique`(`affiliate_id`)
CreateUserPersonalFieldsTable: create table `user_personal_fields` (`id` int unsigned not null auto_increment primary key, `user_id` int unsigned null, `name_surname` varchar(191) null, `telegram` varchar(191) null, `emergency_email` varchar(191) null, `permanent_address` varchar(191) null, `contact_number` varchar(191) null, `date_place_birth` varchar(191) null, `nationality` varchar(191) null, `source_of_funds` varchar(191) null, `presumptive_investment` varchar(191) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate utf8mb4_unicode_ci engine = InnoDB
CreateUserPersonalFieldsTable: alter table `user_personal_fields` add constraint `user_personal_fields_user_id_foreign` foreign key (`user_id`) references `users` (`id`)
CreatePasswordResetsTable: create table `password_resets` (`email` varchar(191) not null, `token` varchar(191) not null, `created_at` timestamp null) default character set utf8mb4 collate utf8mb4_unicode_ci
CreatePasswordResetsTable: alter table `password_resets` add index `password_resets_email_index`(`email`)
CreateHistoryTable: create table `history` (`id` int unsigned not null auto_increment primary key, `user_id` int unsigned null, `reg_email` varchar(191) null, `reg_password` varchar(191) null, `reg_at` timestamp null, `forgot_pwd_new` varchar(191) null, `forgot_pwd_old` varchar(191) null, `forgot_pwd_at` timestamp null, `change_email_new` varchar(191) null, `change_email_old` varchar(191) null, `change_email_at` timestamp null, `change_pwd_new` varchar(191) null, `change_pwd_old` varchar(191) null, `change_pwd_at` timestamp null, `add_coin_currency` varchar(191) null, `add_coin_number` varchar(191) null, `add_coin_at` timestamp null, `change_coin_currency_new` varchar(191) null, `change_coin_currency_old` varchar(191) null, `change_coin_number_new` varchar(191) null, `change_coin_number_old` varchar(191) null, `change_coin_at` timestamp null) default character set utf8mb4 collate utf8mb4_unicode_ci
CreateHistoryTable: alter table `history` add constraint `history_user_id_foreign` foreign key (`user_id`) references `users` (`id`)
CreateTranslationsTable: create table `ltm_translations` (`id` int unsigned not null auto_increment primary key, `status` int not null default '0', `locale` varchar(191) not null, `group` varchar(191) not null, `key` varchar(191) not null, `value` text null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate utf8mb4_unicode_ci
CreateUserWalletFieldsTable: create table `user_wallet_fields` (`id` int unsigned not null auto_increment primary key, `user_id` int unsigned null, `wallet_invest_from` varchar(191) null, `name_of_wallet_invest_from` varchar(191) null, `wallet_get_tokens` varchar(191) null, `ETH` varchar(191) null, `BTC` varchar(191) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate utf8mb4_unicode_ci engine = InnoDB
CreateUserWalletFieldsTable: alter table `user_wallet_fields` add constraint `user_wallet_fields_user_id_foreign` foreign key (`user_id`) references `users` (`id`)
CreateUserHistoryFieldsTable: create table `user_history_fields` (`id` int unsigned not null auto_increment primary key, `user_id` int unsigned null, `reg_email` varchar(191) null, `reg_pwd` varchar(191) null, `reg_at` timestamp null, `forgot_pwd_new` varchar(191) null, `forgot_pwd_old` varchar(191) null, `forgot_pwd_at` timestamp null, `change_email_new` varchar(191) null, `change_email_old` varchar(191) null, `change_email_at` timestamp null, `change_pwd_new` varchar(191) null, `change_pwd_old` varchar(191) null, `change_pwd_at` timestamp null, `wallet_currency_new` varchar(191) null, `wallet_invest_from_new` varchar(191) null, `wallet_get_tokens_new` varchar(191) null, `wallet_currency_old` varchar(191) null, `wallet_invest_from_old` varchar(191) null, `wallet_get_tokens_old` varchar(191) null, `update_wallet_at` timestamp null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate utf8mb4_unicode_ci
CreateUserHistoryFieldsTable: alter table `user_history_fields` add constraint `user_history_fields_user_id_foreign` foreign key (`user_id`) references `users` (`id`)
