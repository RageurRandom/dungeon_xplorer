/*
A METTRE A JOUR A CHAQUE AJOUT DANS LE FICHIER EXCEL
*/
delete from item;

INSERT INTO item (item_name, item_weight, item_size, item_desc) VALUES( 'Épée de Chevalier', 10, 4, 'Une épée longue et tranchante utilisée par les chevaliers, parfaite pour les combats rapprochés.');
INSERT INTO item (item_name, item_weight, item_size, item_desc) VALUES( 'Arc Élfique', 7, 3, 'Un arc élégant fabriqué par les elfes, permettant des tirs précis à longue distance.');
INSERT INTO item (item_name, item_weight, item_size, item_desc) VALUES( 'Bouclier d''Acier', 12, 5, 'Un bouclier solide conçu pour encaisser les coups les plus puissants.');
INSERT INTO item (item_name, item_weight, item_size, item_desc) VALUES( 'Potion de Vitalité', 2, 1, 'Une potion rouge qui restaure 50 points de vie lorsqu''elle est consommée.');
INSERT INTO item (item_name, item_weight, item_size, item_desc) VALUES( 'Potion de Mana', 2, 1, 'Une potion bleue qui restaure 40 points de mana pour lancer des sorts.');
INSERT INTO item (item_name, item_weight, item_size, item_desc) VALUES( 'Armure d''Écailles', 20, 6, 'Une armure lourde recouverte d''écailles métalliques, offrant une excellente protection.');
INSERT INTO item (item_name, item_weight, item_size, item_desc) VALUES( 'Grimoire Enchanté', 8, 2, 'Un ancien livre de magie contenant des sorts puissants et secrets.');
INSERT INTO item (item_name, item_weight, item_size, item_desc) VALUES( 'Hache de Guerre', 15, 5, 'Une hache imposante capable de briser les armures les plus résistantes.');
INSERT INTO item (item_name, item_weight, item_size, item_desc) VALUES( 'Dague Envenimée', 3, 1, 'Une petite lame enduite d''un poison mortel, efficace pour les assassinats.');
INSERT INTO item (item_name, item_weight, item_size, item_desc) VALUES( 'Amulette Mystique', 1, 1, 'Un bijou magique qui augmente la résistance aux dégâts élémentaires.');
INSERT INTO item (item_name, item_weight, item_size, item_desc) VALUES( 'Corde Renforcée', 4, 2, 'Une corde solide idéale pour grimper ou pour capturer des ennemis.');
INSERT INTO item (item_name, item_weight, item_size, item_desc) VALUES( 'Anneau de Force', 1, 1, 'Un anneau enchanté qui augmente temporairement la force de son porteur.');
INSERT INTO item (item_name, item_weight, item_size, item_desc) VALUES( 'Sceptre Royal', 6, 3, 'Un bâton magique orné de pierres précieuses, amplifiant les capacités magiques.');
INSERT INTO item (item_name, item_weight, item_size, item_desc) VALUES( 'Bottes de Vitesse', 5, 2, 'Des bottes légères qui augmentent considérablement la vitesse de déplacement.');
INSERT INTO item (item_name, item_weight, item_size, item_desc) VALUES( 'Torche Durable', 3, 2, 'Une torche capable de brûler longtemps, essentielle pour explorer les donjons sombres.');

commit;

delete from spell;
INSERT INTO spell (spell_name, spell_mana_cost) VALUES ('Boule de Feu', 10);
INSERT INTO spell (spell_name, spell_mana_cost) VALUES ('Éclat de Glace', 8);
INSERT INTO spell (spell_name, spell_mana_cost) VALUES ('Éclair', 12);
INSERT INTO spell (spell_name, spell_mana_cost) VALUES ('Tremblement de Terre', 15);
INSERT INTO spell (spell_name, spell_mana_cost) VALUES ('Frappe de l''Ombre', 10);
INSERT INTO spell (spell_name, spell_mana_cost) VALUES ('Explosion Arcanique', 7);
INSERT INTO spell (spell_name, spell_mana_cost) VALUES ('Nuage Toxique', 9);
INSERT INTO spell (spell_name, spell_mana_cost) VALUES ('Tranche de Vent', 5);
INSERT INTO spell (spell_name, spell_mana_cost) VALUES ('Jet d''Eau', 6);
INSERT INTO spell (spell_name, spell_mana_cost) VALUES ('Onde Obscure', 13);
INSERT INTO spell (spell_name, spell_mana_cost) VALUES ('Tempête de Foudre', 18);
INSERT INTO spell (spell_name, spell_mana_cost) VALUES ('Décharge d''Énergie', 7);

commit;

/*
NE FONCTIONNE PAS CAR 'assets/images/StoneWall01.jpg' DANS IMAGE
*/
delete from chapter;
INSERT INTO chapter (chapter_num, chapter_content, chapter_img) VALUES (1, 'Le ciel est lourd ce soir sur le village du Val Perdu, dissimulé entre les montagnes. La petite taverne, dernier refuge avant l''immense forêt, est étrangement calme quand le bourgmestre s’approche de vous. Homme d’apparence usée par les années et les soucis, il vous adresse un regard désespéré.

« Ma fille… elle a disparu dans la forêt. Personne n''a osé la chercher… sauf vous, peut-être ? On raconte qu’un sorcier vit dans un château en ruines, caché au cœur des bois. Depuis des mois, des jeunes filles disparaissent… J''ai besoin de vous pour la retrouver. »

Vous sentez le poids de la mission qui s''annonce, et un frisson parcourt votre échine. Bientôt, la forêt s''ouvre devant vous, sombre et menaçante. La quête commence.', '');
INSERT INTO chapter (chapter_num, chapter_content, chapter_img) VALUES (2, 'Vous franchissez la lisière des arbres, la pénombre de la forêt avalant le sentier devant vous. Un vent froid glisse entre les troncs, et le bruissement des feuilles ressemble à un murmure menaçant. Deux chemins s''offrent à vous : l''un sinueux, bordé de vieux arbres noueux ; l''autre droit mais envahi par des ronces épaisses.
• Si vous empruntez le chemin sinueux, rendez-vous au chapitre 3.
• Si vous choisissez le sentier couvert de ronces, rendez-vous au chapitre 4.', 'assets/images/StoneWall01.jpg');
INSERT INTO chapter (chapter_num, chapter_content, chapter_img) VALUES (3, 'Votre choix vous mène devant un vieux chêne aux branches tordues, grouillant de corbeaux noirs qui vous observent en silence. À vos pieds, des traces de pas légers, probablement récents, mènent plus loin dans les bois. Soudain, un bruit de pas feutrés se fait entendre. Vous ressentez la présence d’un prédateur.
• Si vous choisissez de rester prudent, rendez-vous au chapitre 5.
• Si vous décidez d''ignorer les bruits et de poursuivre votre route, rendez-vous au chapitre 6.', 'assets/images/StoneWall01.jpg');
INSERT INTO chapter (chapter_num, chapter_content, chapter_img) VALUES (4, 'En progressant, le calme de la forêt est soudain brisé par un grognement. Surgissant des buissons, un énorme sanglier, au pelage épais et aux yeux injectés de sang, se dirige vers vous. Sa rage est palpable, et il semble prêt à en découdre. Le voici qui décide brutalement de vous charger !
• Après avoir vaincu le sanglier, vous pourrez vous rendre au chapitre 8 sinon rendez-vous au chapitre 10.', 'assets/images/StoneWall01.jpg');
INSERT INTO chapter (chapter_num, chapter_content, chapter_img) VALUES (5, 'Après votre rencontre, vous atteignez une clairière étrange, entourée de pierres dressées,comme un ancien autel oublié par le temps. Une légère brume rampe au sol, et les  ombres des pierres semblent danser sous la lueur de la lune.
• Si vous décidez de prendre le sentier couvert de mousse, rendez-vous au
chapitre 8.
• Si vous choisissez de suivre le chemin tortueux à travers les racines, allez au
chapitre 9.', 'assets/images/StoneWall01.jpg');
INSERT INTO chapter (chapter_num, chapter_content, chapter_img) VALUES (6, 'Essoufflé mais déterminé, vous arrivez près d''un petit ruisseau qui serpente au milieu des arbres. Le chant de l’eau vous apaise quelque peu, mais des murmures étranges semblent émaner de la rive. Vous apercevez des inscriptions anciennes gravées dans une pierre moussue.
• Si vous touchez la pierre gravée, allez au chapitre 11.
• Si vous ignorez cette curiosité et poursuivez votre route, allez au chapitre 9.', 'assets/images/StoneWall01.jpg');
INSERT INTO chapter (chapter_num, chapter_content, chapter_img) VALUES (7, 'La forêt se disperse enfin, et devant vous se dresse une colline escarpée. Au sommet, le château en ruines projette une ombre menaçante sous le clair de lune. Les murs effrités et les tours en partie effondrées ajoutent à la sinistre réputation du lieu. Vous sentez que la véritable aventure commence ici, et que l''influence du sorcier n’est peut-être pas qu''une légende..', 'assets/images/StoneWall01.jpg');
INSERT INTO chapter (chapter_num, chapter_content, chapter_img) VALUES (8, 'Le monde se dérobe sous vos pieds, et une obscurité profonde vous enveloppe, glaciale et insondable. Vous ne sentez plus le poids de votre équipement, ni la morsure de la douleur. Juste un vide infini, vous aspirant lentement dans les ténèbres. Alors que vous perdez toute notion du temps, une lueur douce apparaît au loin, vacillante comme une flamme fragile dans l''obscurité. Au fur et à mesure que vous approchez, vous entendez une voix, faible mais bienveillante, qui murmure des mots oubliés, anciens. « Brave âme, ton chemin n''est pas achevé... À ceux qui échouent, une seconde chance est accordée. Mais les caprices du destin exigent un sacrifice. » La lumière s''intensifie, et vous sentez vos forces revenir, mais vos poches sont vides, votre sac allégé de tout trésor. Votre équipement, vos armes, tout a disparu, laissant place à une sensation de vulnérabilité Lorsque la lumière vous enveloppe, vous ouvrez de nouveau les yeux, retrouvant la terre ferme sous vos pieds. Vous êtes de retour, sans autre possession que votre volonté de reprendre cette quête. Mais cette fois-ci, peut-être, saurez-vous éviter les pièges fatals qui vous ont mené à votre perte.
• Si vous souhaitez reprendre l’aventure depuis le début, rendez-vous de nouveau au chapitre 1.', 'assets/images/StoneWall01.jpg');
INSERT INTO chapter (chapter_num, chapter_content, chapter_img) VALUES (9, 'Qu''avez-vous fait, Malheureux !
Rendez-vous sans perdre de temps au chapitre 10.', 'assets/images/StoneWall01.jpg');
INSERT INTO chapter (chapter_num, chapter_content, chapter_img) VALUES (10, 'Vous fouillez le camp abandonné. Les lieux sont déserts depuis longtemps, mais les occupants semblent être partis dans la précipitation : ils ont en effet oublié beaucoup d''affaires. 
La plupart des objets ne vous sont d''aucune utilité mais un saucissson retient votre attention. Vous tentez de le découper, mais il est trop durcis.
Vous décidez de quand même le prendre : si vous ne pouvez le découper alors il découpera (ou plutôt fracassera) vos ennemis', 'assets/images/StoneWall01.jpg');

commit;

delete from class;

INSERT INTO class (class_id, class_starting_HP, class_starting_mana, class_starting_intitiative, class_starting_strength , class_description, class_name) VALUES (1, 10, 0, 1, 3, 'un spécialiste du combat au corps à corps. Il peut posséder un bouclier pour se protéger', 'guerrier');
INSERT INTO class (class_id, class_starting_HP, class_starting_mana, class_starting_intitiative, class_starting_strength , class_description, class_name) VALUES (2, 7, 2, 1, 2, 'un combattant agile pouvant utiliser des sorts et des armes. Possède le plus d''initiative', 'voleur');
INSERT INTO class (class_id, class_starting_HP, class_starting_mana, class_starting_intitiative, class_starting_strength , class_description, class_name) VALUES (3, 5, 5, 1, 1, 'un combattant spécialisé dans le lancement de sorts. Ne peut utiliser qu''un baton ou une dague. Peut apprendre tous les sorts', 'magicien');

commit;

delete from `level`;

INSERT INTO `level` (level_num, class_id, level_required_xp, level_HP_bonus, level_mana_bonus, level_initiative_bonus, level_strength_bonus ) VALUES (1, 1, 5, 3, 0, 1, 3); /*celle la ne marche pas wtf*/
INSERT INTO `level` (level_num, class_id, level_required_xp, level_HP_bonus, level_mana_bonus, level_initiative_bonus, level_strength_bonus ) VALUES (1, 2, 5, 1, 2, 3, 1);
INSERT INTO `level` (level_num, class_id, level_required_xp, level_HP_bonus, level_mana_bonus, level_initiative_bonus, level_strength_bonus ) VALUES (1, 3, 5, 0, 4, 1, 0);

commit;

delete from monster;

INSERT INTO monster (monster_id, monster_name, monster_HP, monster_mana, monster_strength, monster_initiative) VALUES (1, 'gobelin', 4, 0, 3, 3);

commit;

delete from link;

INSERT INTO link (chapter_num, chapter_num_next, link_desc) VALUES (1, 2, 'continuer');
INSERT INTO link (chapter_num, chapter_num_next, link_desc) VALUES (2, 3, 'emprunter le chemin sinueux');
INSERT INTO link (chapter_num, chapter_num_next, link_desc) VALUES (2, 4, 'emprunter le sentier couvert de ronces');
INSERT INTO link (chapter_num, chapter_num_next, link_desc) VALUES (3, 5, 'rester prudent');
INSERT INTO link (chapter_num, chapter_num_next, link_desc) VALUES (3, 6, 'ignorer les bruits');
INSERT INTO link (chapter_num, chapter_num_next, link_desc) VALUES (4, 8, 'affronter le sanglier');
INSERT INTO link (chapter_num, chapter_num_next, link_desc) VALUES (5, 7, 'poursuivre votre chemin');
INSERT INTO link (chapter_num, chapter_num_next, link_desc) VALUES (6, 7, 'affronter le loup');
INSERT INTO link (chapter_num, chapter_num_next, link_desc) VALUES (7, 8, 'prendre le sentier couvert de mousse');
INSERT INTO link (chapter_num, chapter_num_next, link_desc) VALUES (7, 9, 'suivre le chemin tortueux à travers les racines');
INSERT INTO link (chapter_num, chapter_num_next, link_desc) VALUES (8, 11, 'toucher la pierre gravée');
INSERT INTO link (chapter_num, chapter_num_next, link_desc) VALUES (8, 9, 'ignorer la pierre');
INSERT INTO link (chapter_num, chapter_num_next, link_desc) VALUES (10, 1, 'reprendre l’aventure depuis le début');

commit;