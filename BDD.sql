drop table if exists `user`; 
CREATE TABLE `user` (
  `user_id` integer PRIMARY KEY AUTO_INCREMENT,
  `hero_id` integer,
  `user_name` varchar(255),
  `user_mail` varchar(255) UNIQUE NOT NULL,
  `user_password` varchar(255) NOT NULL
);

drop table if exists `hero`; 
CREATE TABLE `hero` (
  `hero_id` integer PRIMARY KEY AUTO_INCREMENT,
  `class_id` integer,
  `level_num` integer,
  `chapter_num` integer,
  `hero_name` varchar(255) NOT NULL,
  `hero_HP` int NOT NULL,
  `hero_XP` int NOT NULL,
  `hero_mana` int NOT NULL,
  `hero_strength` int NOT NULL,
  `hero_initiative` int NOT NULL
);

drop table if exists `class`; 
CREATE TABLE `class` (
  `class_id` integer PRIMARY KEY AUTO_INCREMENT,
  `class_starting_HP` int NOT NULL,
  `class_starting_mana` int NOT NULL,
  `class_starting_intitiative` int NOT NULL,
  `class_starting_strength` int NOT NULL,
  `class_description` varchar(255),
  `class_name` varchar(255) NOT NULL
);

drop table if exists `level`; 
CREATE TABLE `level` (
  `level_num` int,
  `class_id` integer,
  `level_required_xp` integer NOT NULL,
  `level_HP_bonus` integer NOT NULL,
  `level_mana_bonus` integer NOT NULL,
  `level_initiative_bonus` integer NOT NULL,
  `level_strength_bonus` integer NOT NULL,
  PRIMARY KEY (`level_num`, `class_id`)
);

drop table if exists `item`; 
CREATE TABLE `item` (
  `item_id` integer PRIMARY KEY AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `item_weight` int NOT NULL,
  `item_size` int NOT NULL,
  `item_desc` varchar(255) NOT NULL
);

drop table if exists `weapon`; 
CREATE TABLE `weapon` (
  `item_id` integer PRIMARY KEY,
  `weapon_attack_value` integer NOT NULL,
  `weapon_is_one_hand` TINYINT(1) NOT NULL
);

drop table if exists `potion`; 
CREATE TABLE `potion` (
  `item_id` integer PRIMARY KEY,
  `potion_value` integer NOT NULL,
  `type` varchar(255) NOT NULL
);

drop table if exists `armor`; 
CREATE TABLE `armor` (
  `item_id` integer PRIMARY KEY,
  `armor_defence_rate` integer NOT NULL,
  `armor_is_shield` TINYINT(1) NOT NULL
);

drop table if exists `treasure`; 
CREATE TABLE `treasure` (
  `item_id` integer,
  `chapter_num` int,
  `treasure_quantity` int NOT NULL check(`treasure_quantity` > 0),
  PRIMARY KEY (`item_id`, `chapter_num`)
);

drop table if exists `inventory`; 
CREATE TABLE `inventory` (
  `hero_id` int,
  `item_id` int,
  `item_quantity` int NOT NULL check(`item_quantity` > 0),
  PRIMARY KEY (`hero_id`, `item_id`)
);

drop table if exists `monster`; 
CREATE TABLE `monster` (
  `monster_id` integer PRIMARY KEY AUTO_INCREMENT,
  `monster_name` varchar(255) NOT NULL,
  `monster_HP` integer NOT NULL,
  `monster_mana` int NOT NULL,
  `monster_strength` int NOT NULL,
  `monster_initiative` int NOT NULL
);

drop table if exists `loot`; 
CREATE TABLE `loot` (
  `monster_id` integer,
  `item_id` integer,
  `loot_quantity` integer NOT NULL check(`loot_quantity` > 0),
  `loot_proba` float NOT NULL,
  PRIMARY KEY (`monster_id`, `item_id`)
);

drop table if exists `spell`; 
CREATE TABLE `spell` (
  `spell_id` integer PRIMARY KEY AUTO_INCREMENT,
  `spell_name` varchar(255) NOT NULL,
  `spell_mana_cost` int NOT NULL
);

drop table if exists `spell_attack`; 
CREATE TABLE `spell_attack` (
  `spell_id` integer PRIMARY KEY,
  `spell_attack_value` int NOT NULL
);

drop table if exists `spell_boost`; 
CREATE TABLE `spell_boost` (
  `spell_id` integer PRIMARY KEY,
  `spell_boost_value` int NOT NULL,
  `spell_boost_target` varchar(255) NOT NULL,
  `spell_boost_duration` int NOT NULL
);

drop table if exists `spell_book`; 
CREATE TABLE `spell_book` (
  `spell_id` int,
  `hero_id` int,
  PRIMARY KEY (`spell_id`, `hero_id`)
);

drop table if exists `chapter`; 
CREATE TABLE `chapter` (
  `chapter_num` int PRIMARY KEY,
  `monster_id` int,
  `chapter_content` varchar(2000) NOT NULL,
  `chapter_img` varchar(255) NOT NULL
);

drop table if exists `link`; 
CREATE TABLE `link` (
  `chapter_num` int,
  `chapter_num_next` int,
  `link_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`chapter_num`, `chapter_num_next`)
);

ALTER TABLE `user` ADD FOREIGN KEY (`hero_id`) REFERENCES `hero` (`hero_id`);

ALTER TABLE `level` ADD FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`);

ALTER TABLE `hero` ADD FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`);

ALTER TABLE `hero` ADD FOREIGN KEY (`level_num`) REFERENCES `level` (`level_num`);

ALTER TABLE `inventory` ADD FOREIGN KEY (`hero_id`) REFERENCES `hero` (`hero_id`);

ALTER TABLE `inventory` ADD FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

ALTER TABLE `weapon` ADD FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

ALTER TABLE `potion` ADD FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

ALTER TABLE `armor` ADD FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

ALTER TABLE `loot` ADD FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

ALTER TABLE `loot` ADD FOREIGN KEY (`monster_id`) REFERENCES `monster` (`monster_id`);

ALTER TABLE `spell_attack` ADD FOREIGN KEY (`spell_id`) REFERENCES `spell` (`spell_id`);

ALTER TABLE `spell_boost` ADD FOREIGN KEY (`spell_id`) REFERENCES `spell` (`spell_id`);

ALTER TABLE `spell_book` ADD FOREIGN KEY (`spell_id`) REFERENCES `spell` (`spell_id`);

ALTER TABLE `spell_book` ADD FOREIGN KEY (`hero_id`) REFERENCES `hero` (`hero_id`);

ALTER TABLE `treasure` ADD FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

ALTER TABLE `treasure` ADD FOREIGN KEY (`chapter_num`) REFERENCES `chapter` (`chapter_num`);

ALTER TABLE `chapter` ADD FOREIGN KEY (`monster_id`) REFERENCES `monster` (`monster_id`);

ALTER TABLE `link` ADD FOREIGN KEY (`chapter_num`) REFERENCES `chapter` (`chapter_num`);

ALTER TABLE `link` ADD FOREIGN KEY (`chapter_num_next`) REFERENCES `chapter` (`chapter_num`);

ALTER TABLE `hero` ADD FOREIGN KEY (`chapter_num`) REFERENCES `chapter` (`chapter_num`);
