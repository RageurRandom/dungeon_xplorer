-- Insertion des monstres
INSERT INTO monster (monster_id, monster_name, monster_HP, monster_mana, monster_strength, monster_initiative, monster_xp) VALUES
(1, 'Sanglier enragé', 30, 0, 12, 5, 50),
(2, 'Loup noir', 20, 0, 20, 15, 80);

-- Insertion des chapitres
INSERT INTO chapter (chapter_num, chapter_content, chapter_img, chapter_xp) VALUES
(1, 'Le ciel est lourd ce soir sur le village du Val Perdu... La quête commence.', 'assets/images/StoneWall01.jpg', 0),
(2, 'Vous franchissez la lisière des arbres... Deux chemins s’offrent à vous.', 'assets/images/forest_edge.jpg', 10),
(3, 'Votre choix vous mène devant un vieux chêne... Un prédateur rôde.', 'assets/images/crows_tree.jpg', 20),
(4, 'En progressant, un énorme sanglier enragé surgit... Il vous charge !', 'assets/images/wild_boar.jpg', 30),
(5, 'Vous rencontrez un vieux paysan qui vous met en garde...', 'assets/images/farmer.jpg', 15),
(6, 'Un loup noir surgit des buissons, prêt à attaquer.', 'assets/images/black_wolf.jpg', 40),
(7, 'Une clairière étrange entoure un ancien autel... La lueur de la lune danse.', 'assets/images/stone_clearing.jpg', 25),
(8, 'Près d’un ruisseau, des murmures étranges émanent de la rive.', 'assets/images/stream.jpg', 20),
(9, 'Devant vous se dresse une colline escarpée avec un château en ruines.', 'assets/images/ruined_castle.jpg', 100),
(10, 'Le monde se dérobe sous vos pieds, mais une seconde chance vous est accordée.', 'assets/images/void.jpg', 0),
(11, 'Votre curiosité vous a perdu, retournez au chapitre 10.', 'assets/images/mistake.jpg', 0),
(12, 'ceci est la fin de cette aventure, merci d''avoir joué et à la prochaine', 'assets/images/mistake.jpg', 0);


-- Insertion des items
INSERT INTO item (item_id, item_name, item_weight, item_size, item_desc) VALUES
(1, 'Épée en fer', 10, 3, 'Une épée simple mais efficace.'),
(2, 'Potion de soin', 1, 1, 'Restaure 50 points de vie.'),
(3, 'Bouclier de bois', 8, 4, 'Offre une protection de base contre les attaques.'),
(4, 'Potion de mana', 1, 1, 'Restaure 30 points de mana.'),
(5, 'Anneau magique', 1, 1, 'Un anneau qui augmente votre défense.');

-- Insertion des armes
INSERT INTO weapon (item_id, weapon_attack_value, weapon_is_one_hand) VALUES
(1, 15, 1);

-- Insertion des potions
INSERT INTO potion (item_id, potion_value, type) VALUES
(2, 50, 'health'),
(4, 30, 'mana');

-- Insertion des armures
INSERT INTO armor (item_id, armor_defence_rate, armor_is_shield) VALUES
(3, 10, 1);

-- Insertion des loots
INSERT INTO loot (monster_id, item_id, loot_quantity, loot_proba) VALUES
(1, 2, 1, 0.8),
(2, 3, 1, 0.5);

-- Insertion des sorts
INSERT INTO spell (spell_id, spell_name, spell_mana_cost) VALUES
(1, 'Boule de feu', 20),
(2, 'Bouclier magique', 15),
(3, 'Soin mineur', 10);

-- Insertion des liens entre chapitres
INSERT INTO link (chapter_num, chapter_num_next, link_desc, monster_id, link_treasure, item_id, spell_id) VALUES
(1, 2, 'Commencez votre quête.', NULL, 0, 1, NULL),
(2, 3, 'Empruntez le chemin sinueux.', NULL, 0, NULL, NULL),
(2, 4, 'Prenez le sentier couvert de ronces.', 1, 100, NULL, NULL),
(3, 5, 'Restez prudent face au prédateur.', NULL, 0, NULL, 2),
(3, 6, 'Ignorez les bruits et poursuivez votre route.', 2, 50, 3, NULL),
(4, 8, 'Vous avez vaincu le sanglier, continuez.', NULL, 30, NULL, NULL),
(4, 10, 'Le sanglier vous terrasse.', NULL, 0, NULL, NULL),
(5, 7, 'Continuez après avoir écouté le paysan.', NULL, 10, NULL, NULL),
(6, 7, 'Vous survivez au loup et poursuivez votre quête.', NULL, 40, 4, NULL),
(6, 10, 'Le loup vous terrasse.', NULL, 0, NULL, NULL),
(7, 8, 'Prenez le sentier couvert de mousse.', NULL, 20, NULL, NULL),
(7, 9, 'Suivez le chemin tortueux à travers les racines.', NULL, 25, 5, NULL),
(8, 11, 'Touchez la pierre gravée.', NULL, 0, NULL, 1),
(8, 9, 'Ignorez la pierre gravée et poursuivez.', NULL, 15, NULL, NULL),
(9, 12, 'Approchez le château en ruines.', NULL, 50, NULL, NULL),
(10, 1, 'Recommencez depuis le début.', NULL, 0, NULL, NULL),
(11, 10, 'Retournez au chapitre 10.', NULL, 0, NULL, NULL),
(12, 1, 'bravo, vous avez gagné.', NULL, 0, NULL, NULL);

-- Insertion des sorts d'attaque
INSERT INTO spell_attack (spell_id, spell_attack_value) VALUES
(1, 30);

-- Insertion des sorts de boost
INSERT INTO spell_boost (spell_id, spell_boost_value, spell_boost_target, spell_boost_duration) VALUES
(2, 20, 'hp', 3);

-- Insertion des classes
INSERT INTO class (class_id, class_starting_HP, class_starting_mana, class_starting_intitiative, class_starting_strength, class_description, class_name) VALUES
(1, 100, 0, 10, 15, 'Un guerrier robuste qui excelle au combat physique.', 'Guerrier'),
(2, 80, 50, 20, 10, 'Un voleur agile qui utilise sa vitesse et sa ruse.', 'Voleur'),
(3, 60, 100, 5, 13, 'Un magicien maîtrisant de puissants sorts magiques.', 'Magicien');

-- Insertion des niveaux
INSERT INTO level (level_num, class_id, level_required_xp, level_HP_bonus, level_mana_bonus, level_initiative_bonus, level_strength_bonus) VALUES
(1, 1, 0, 10, 0, 0, 2),
(2, 1, 100, 20, 0, 0, 4),
(3, 1, 300, 30, 0, 0, 6),
(1, 2, 0, 5, 10, 2, 1),
(2, 2, 100, 10, 20, 4, 2),
(3, 2, 300, 15, 30, 6, 3),
(1, 3, 0, 0, 20, 0, 0),
(2, 3, 100, 0, 40, 0, 0),
(3, 3, 300, 0, 60, 0, 0);


commit; 