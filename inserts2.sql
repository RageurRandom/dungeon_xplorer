-- Insertion des monstres
INSERT INTO monster (monster_id, monster_name, monster_HP, monster_mana, monster_strength, monster_initiative, monster_xp) VALUES
(1, 'Sanglier enragé', 80, 0, 12, 6, 50),
(2, 'Loup noir', 70, 0, 15, 8, 80),
(3, 'Araignée géante', 90, 0, 10, 7, 60),
(4, 'Guerrier squelette', 120, 0, 18, 10, 100),
(5, 'Dragonnet de feu', 150, 50, 25, 12, 150);

-- Insertion des chapitres
INSERT INTO chapter (chapter_num, chapter_content, chapter_img, chapter_xp) VALUES
(1, 'Vous vous réveillez dans une petite auberge située au cœur d’un village reculé. Le maire vous confie une mission périlleuse : retrouver sa fille disparue dans la forêt sombre. Votre aventure commence.', 'assets/images/StoneWall01.jpg', 0),
(2, 'Devant vous, la forêt dense s’étend à perte de vue. Deux chemins se présentent : l’un sinueux et inquiétant, l’autre droit mais encombré de ronces épaisses. Vous devez choisir votre voie.', 'assets/images/forest_edge.jpg', 10),
(3, 'En suivant le chemin sinueux, vous arrivez devant un chêne imposant rempli de corbeaux silencieux. Soudain, vous ressentez une présence hostile dans les environs.', 'assets/images/crows_tree.jpg', 20),
(4, 'Le sentier des ronces vous mène à un sanglier furieux surgissant des buissons. Ses yeux rouges montrent qu’il est prêt à se battre pour sa vie.', 'assets/images/wild_boar.jpg', 30),
(5, 'Vous rencontrez un paysan qui cueille des champignons. Il vous avertit des dangers de la forêt et vous conseille de rester sur vos gardes.', 'assets/images/farmer.jpg', 15),
(6, 'Le bruissement des feuilles se transforme en grognement : un loup noir surgit de l’ombre. Ses crocs luisants et son regard perçant montrent qu’il ne reculera pas.', 'assets/images/black_wolf.jpg', 40),
(7, 'Vous arrivez dans une clairière entourée de pierres anciennes. La brume légère et les ombres dansantes des pierres créent une atmosphère mystique.', 'assets/images/stone_clearing.jpg', 25),
(8, 'Un ruisseau scintillant serpente au milieu des arbres. Sur une pierre moussue, des inscriptions mystérieuses captent votre attention. Vous ressentez une étrange énergie.', 'assets/images/stream.jpg', 20),
(9, 'Devant vous se dresse une colline escarpée. Au sommet, le château en ruines projette une ombre menaçante, comme un rappel des dangers à venir.', 'assets/images/ruined_castle.jpg', 100),
(10, 'Un épais brouillard vous enveloppe. Vous ressentez une lourde défaite : votre équipement est perdu, et vous êtes renvoyé au point de départ.', 'assets/images/void.jpg', 0),
(11, 'Votre curiosité vous mène à toucher une pierre mystérieuse. Une force magique vous projette violemment en arrière. Vous perdez connaissance.', 'assets/images/mistake.jpg', 0),
(12, 'Vous pénétrez dans une grotte sombre. Des bruits d’araignées géantes résonnent dans l’obscurité.', 'assets/images/cave.jpg', 50),
(13, 'Un pont suspendu vous mène à une tour en ruine. Le vent hurle et vous devez avancer avec prudence.', 'assets/images/suspended_bridge.jpg', 60),
(14, 'Vous découvrez une crypte ancienne. Un guerrier squelette émerge des ombres, prêt à combattre.', 'assets/images/crypt.jpg', 80),
(15, 'Dans une clairière illuminée par des flammes magiques, un dragonnet de feu vous bloque la route.', 'assets/images/dragon.jpg', 120),
(16, 'Vous arrivez à la salle du trône. Une présence maléfique emplit l’air, et le véritable défi commence.', 'assets/images/throne_room.jpg', 150);


-- Insertion des items
INSERT INTO item (item_id, item_name, item_weight, item_size, item_desc) VALUES
(1, 'Épée en fer', 10, 3, 'Une épée simple mais efficace.'),
(2, 'Potion de soin', 1, 1, 'Restaure 50 points de vie.'),
(3, 'Bouclier de bois', 8, 4, 'Offre une protection de base contre les attaques.'),
(4, 'Potion de mana', 1, 1, 'Restaure 30 points de mana.'),
(5, 'Anneau magique', 1, 1, 'Un anneau qui augmente votre défense.');

-- Insertion des armes
INSERT INTO weapon (item_id, weapon_attack_value, weapon_is_one_hand) VALUES
(1, 20, 1);

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
(2, 3, 1, 0.5),
(3, 4, 1, 0.7),
(4, 5, 1, 0.6),
(5, 1, 1, 0.4);

-- Insertion des sorts
INSERT INTO spell (spell_id, spell_name, spell_mana_cost) VALUES
(1, 'Boule de feu', 15),
(2, 'Bouclier magique', 10),
(3, 'Soin mineur', 8);

-- Correction des liens entre chapitres
INSERT INTO link (chapter_num, chapter_num_next, link_desc, monster_id, link_treasure, item_id, spell_id) VALUES
-- Chapitre 1
(1, 2, 'Commencez votre quête.', NULL, 0, NULL, NULL),
-- Chapitre 2
(2, 3, 'Prenez le chemin sinueux.', NULL, 0, NULL, NULL),
(2, 8, 'Prenez le sentier encombré de ronces.', 1, 100, NULL, NULL),
-- Chapitre 3
(3, 5, 'Restez prudent et observez.', NULL, 0, NULL, NULL),
(3, 6, 'Continuez malgré les signes de danger.', 2, 50, NULL, NULL),
-- Chapitre 5
(5, 7, 'Continuez votre chemin après avoir écouté le paysan.', NULL, 10, NULL, NULL),
-- Chapitre 6
(6, 7, 'Vous triomphez du loup et avancez.', NULL, 40, NULL, NULL),
-- Chapitre 7
(7, 12, 'Entrez dans la grotte sombre.', 3, 20, NULL, NULL),
-- Chapitre 8
(8, 13, 'Traversez le pont suspendu.', NULL, 30, NULL, 2),
-- Chapitre 12
(12, 14, 'Combattez l’araignée géante pour continuer.', 3, 50, 1, NULL),
-- Chapitre 13
(13, 14, 'Descendez dans la crypte ancienne.', NULL, 40, NULL, NULL),
-- Chapitre 14
(14, 15, 'Affrontez le guerrier squelette.', 4, 80, NULL, NULL),
-- Chapitre 15
(15, 16, 'Affrontez le dragonnet de feu et entrez dans la salle du trône.', 5, 120, NULL, NULL),
-- Chapitre 16
(16, 1, 'Vous échouez dans votre quête et retournez à l’auberge.', NULL, 0, NULL, NULL);

-- Insertion des sorts d'attaque
INSERT INTO spell_attack (spell_id, spell_attack_value) VALUES
(1, 25);

-- Insertion des sorts de boost
INSERT INTO spell_boost (spell_id, spell_boost_value, spell_boost_target, spell_boost_duration) VALUES
(2, 15, 'hp', 3);

-- Insertion des classes
INSERT INTO class (class_id, class_starting_HP, class_starting_mana, class_starting_intitiative, class_starting_strength, class_description, class_name) VALUES
(1, 150, 0, 8, 20, 'Un guerrier robuste qui excelle au combat physique.', 'Guerrier'),
(2, 120, 50, 12, 15, 'Un voleur agile qui utilise sa vitesse et sa ruse.', 'Voleur'),
(3, 100, 100, 6, 10, 'Un magicien maîtrisant de puissants sorts magiques.', 'Magicien');

-- Insertion des niveaux
INSERT INTO level (level_num, class_id, level_required_xp, level_HP_bonus, level_mana_bonus, level_initiative_bonus, level_strength_bonus) VALUES
-- Niveaux pour Guerrier
(1, 1, 0, 20, 0, 0, 5),
(2, 1, 150, 30, 0, 0, 10),
(3, 1, 400, 40, 0, 0, 15),
-- Niveaux pour Voleur
(1, 2, 0, 15, 10, 3, 4),
(2, 2, 150, 20, 20, 5, 6),
(3, 2, 400, 25, 30, 7, 8),
-- Niveaux pour Magicien
(1, 3, 0, 10, 25, 0, 3),
(2, 3, 150, 15, 50, 0, 5),
(3, 3, 400, 20, 75, 0, 7);


commit; 