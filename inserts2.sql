
-- Insertion des monstres
INSERT INTO monster (monster_id, monster_name, monster_HP, monster_mana, monster_strength, monster_initiative, monster_xp) VALUES
(1, 'Sanglier enragé', 50, 0, 15, 5, 50),
(2, 'Loup noir', 40, 0, 10, 7, 80);

-- Insertion des chapitres
INSERT INTO chapter (chapter_num, chapter_content, chapter_img, chapter_xp) VALUES
(1, 'Le ciel est lourd ce soir sur le village du Val Perdu, dissimulé entre les montagnes. La petite taverne, dernier refuge avant l''immense forêt, est étrangement calme quand le bourgmestre s’approche de vous. Homme d’apparence usée par les années et les soucis, il vous adresse un regard désespéré.

« Ma fille… elle a disparu dans la forêt. Personne n''a osé la chercher… sauf vous, peut-être ? On raconte qu’un sorcier vit dans un château en ruines, caché au cœur des bois. Depuis des mois, des jeunes filles disparaissent… J''ai besoin de vous pour la retrouver. »

Vous sentez le poids de la mission qui s''annonce, et un frisson parcourt votre échine. Bientôt, la forêt s''ouvre devant vous, sombre et menaçante. La quête commence.', 'assets/images/StoneWall01.jpg', 0),

(2, 'Vous franchissez la lisière des arbres, la pénombre de la forêt avalant le sentier devant vous. Un vent froid glisse entre les troncs, et le bruissement des feuilles ressemble à un murmure menaçant. Deux chemins s''offrent à vous : l''un sinueux, bordé de vieux arbres noueux ; l''autre droit mais envahi par des ronces épaisses.
• Si vous empruntez le chemin sinueux, rendez-vous au chapitre 3.
• Si vous choisissez le sentier couvert de ronces, rendez-vous au chapitre 4.', 'assets/images/forest_edge.jpg', 10),

(3, 'Votre choix vous mène devant un vieux chêne aux branches tordues, grouillant de corbeaux noirs qui vous observent en silence. À vos pieds, des traces de pas légers, probablement récents, mènent plus loin dans les bois. Soudain, un bruit de pas feutrés se fait entendre. Vous ressentez la présence d’un prédateur.
• Si vous choisissez de rester prudent, rendez-vous au chapitre 5.
• Si vous décidez d''ignorer les bruits et de poursuivre votre route, rendez-vous au chapitre 6.', 'assets/images/crows_tree.jpg', 20),

(4, 'En progressant, le calme de la forêt est soudain brisé par un grognement. Surgissant des buissons, un énorme sanglier, au pelage épais et aux yeux injectés de sang, se dirige vers vous. Sa rage est palpable, et il semble prêt à en découdre. Le voici qui décide brutalement de vous charger !
• Après avoir vaincu le sanglier, vous pourrez vous rendre au chapitre 8 sinon rendez-vous au chapitre 10.', 'assets/images/wild_boar.jpg', 30),

(5, 'Après votre rencontre, vous atteignez une clairière étrange, entourée de pierres dressées,comme un ancien autel oublié par le temps. Une légère brume rampe au sol, et les  ombres des pierres semblent danser sous la lueur de la lune.
• Si vous décidez de prendre le sentier couvert de mousse, rendez-vous au
chapitre 8.
• Si vous choisissez de suivre le chemin tortueux à travers les racines, allez au
chapitre 9.', 'assets/images/farmer.jpg', 15),

(6, 'Essoufflé mais déterminé, vous arrivez près d''un petit ruisseau qui serpente au milieu des arbres. Le chant de l’eau vous apaise quelque peu, mais des murmures étranges semblent émaner de la rive. Vous apercevez des inscriptions anciennes gravées dans une pierre moussue.
• Si vous touchez la pierre gravée, allez au chapitre 11.
• Si vous ignorez cette curiosité et poursuivez votre route, allez au chapitre 9.', 'assets/images/black_wolf.jpg', 40),
(7, 'La forêt se disperse enfin, et devant vous se dresse une colline escarpée. Au sommet, le château en ruines projette une ombre menaçante sous le clair de lune. Les murs effrités et les tours en partie effondrées ajoutent à la sinistre réputation du lieu. Vous sentez que la véritable aventure commence ici, et que l''influence du sorcier n’est peut-être pas qu''une légende..', 'assets/images/stone_clearing.jpg', 25),

(8, 'Le monde se dérobe sous vos pieds, et une obscurité profonde vous enveloppe, glaciale et insondable. Vous ne sentez plus le poids de votre équipement, ni la morsure de la douleur. Juste un vide infini, vous aspirant lentement dans les ténèbres. Alors que vous perdez toute notion du temps, une lueur douce apparaît au loin, vacillante comme une flamme fragile dans l''obscurité. Au fur et à mesure que vous approchez, vous entendez une voix, faible mais bienveillante, qui murmure des mots oubliés, anciens. « Brave âme, ton chemin n''est pas achevé... À ceux qui échouent, une seconde chance est accordée. Mais les caprices du destin exigent un sacrifice. » La lumière s''intensifie, et vous sentez vos forces revenir, mais vos poches sont vides, votre sac allégé de tout trésor. Votre équipement, vos armes, tout a disparu, laissant place à une sensation de vulnérabilité Lorsque la lumière vous enveloppe, vous ouvrez de nouveau les yeux, retrouvant la terre ferme sous vos pieds. Vous êtes de retour, sans autre possession que votre volonté de reprendre cette quête. Mais cette fois-ci, peut-être, saurez-vous éviter les pièges fatals qui vous ont mené à votre perte.
• Si vous souhaitez reprendre l’aventure depuis le début, rendez-vous de nouveau au chapitre 1.', 'assets/images/stream.jpg', 20),

(9, 'Qu''avez-vous fait, Malheureux !
Rendez-vous sans perdre de temps au chapitre 10.', 'assets/images/ruined_castle.jpg', 100),

(10, 'Vous fouillez le camp abandonné. Les lieux sont déserts depuis longtemps, mais les occupants semblent être partis dans la précipitation : ils ont en effet oublié beaucoup d''affaires. 
La plupart des objets ne vous sont d''aucune utilité mais un saucissson retient votre attention. Vous tentez de le découper, mais il est trop durcis.
Vous décidez de quand même le prendre : si vous ne pouvez le découper alors il découpera (ou plutôt fracassera) vos ennemis', 'assets/images/void.jpg', 0),

(11, 'Votre curiosité vous a perdu, retournez au chapitre 10.', 'assets/images/mistake.jpg', 0);

-- Insertion des liens entre chapitres
INSERT INTO link (chapter_num, chapter_num_next, link_desc, monster_id, link_treasure) VALUES
(1, 2, 'Commencez votre quête.', NULL, 0),
(2, 3, 'Empruntez le chemin sinueux.', NULL, 0),
(2, 4, 'Prenez le sentier couvert de ronces.', 1, 100),
(3, 5, 'Restez prudent face au prédateur.', NULL, 0),
(3, 6, 'Ignorez les bruits et poursuivez votre route.', 2, 50),
(4, 8, 'Vous avez vaincu le sanglier, continuez.', NULL, 30),
(4, 10, 'Le sanglier vous terrasse.', NULL, 0),
(5, 7, 'Continuez après avoir écouté le paysan.', NULL, 10),
(6, 7, 'Vous survivez au loup et poursuivez votre quête.', NULL, 40),
(6, 10, 'Le loup vous terrasse.', NULL, 0),
(7, 8, 'Prenez le sentier couvert de mousse.', NULL, 20),
(7, 9, 'Suivez le chemin tortueux à travers les racines.', NULL, 25),
(8, 11, 'Touchez la pierre gravée.', NULL, 0),
(8, 9, 'Ignorez la pierre gravée et poursuivez.', NULL, 15),
(9, 10, 'Approchez le château en ruines.', NULL, 50),
(10, 1, 'Recommencez depuis le début.', NULL, 0),
(11, 10, 'Retournez au chapitre 10.', NULL, 0);


-- Insertion des items
INSERT INTO item (item_id, item_name, item_weight, item_size, item_desc) VALUES
(1, 'Épée en fer', 10, 3, 'Une épée simple mais efficace.'),
(2, 'Potion de soin', 1, 1, 'Restaure 50 points de vie.'),
(3, 'Bouclier de bois', 8, 4, 'Offre une protection de base contre les attaques.'),
(4, 'Potion de mana', 1, 1, 'Restaure 30 points de mana.');

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
(2, 'Armure magique', 15);

-- Insertion des sorts d'attaque
INSERT INTO spell_attack (spell_id, spell_attack_value) VALUES
(1, 30);

-- Insertion des sorts de boost
INSERT INTO spell_boost (spell_id, spell_boost_value, spell_boost_target, spell_boost_duration) VALUES
(2, 20, 'defense', 3);


-- Insertion des classes
INSERT INTO class (class_id, class_starting_HP, class_starting_mana, class_starting_intitiative, class_starting_strength, class_description, class_name) VALUES
(1, 100, 0, 10, 15, 'Un guerrier robuste qui excelle au combat physique.', 'Guerrier'),
(2, 80, 50, 20, 10, 'Un voleur agile qui utilise sa vitesse et sa ruse.', 'Voleur'),
(3, 60, 100, 5, 5, 'Un magicien maîtrisant de puissants sorts magiques.', 'Magicien');

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