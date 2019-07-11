CREATE DATABASE Annonceo
USE Annonceo

-- pour la table annonce
CREATE TABLE `annonce` (
  `id_annonce` int(3) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description_courte` varchar(255) NOT NULL,
  `description_longue` text NOT NULL,
  `prix` int(6) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` int(5) UNSIGNED ZEROFILL NOT NULL,
  `membre_id` int(3) NOT NULL,
  `photo_id` int(3) NOT NULL,
  `categorie_id` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO annonce(
  id_annonce,
  titre,
  description_courte,
  description_longue,
  prix,
  pays,
  ville,
  adresse,
  cp,
  membre_id,
  categorie_id,
  date_enregistrement
) VALUES (
  1508,
'Peugeot 406',
  'PEUGEOT 406 coupe pack sport avec faible kilométrage et CT ok. Je met en vente ma voiture qui est en parfait état de marche',
  'Cette voiture est une Peugeot 406.',
  2500,
  'France',
  'Paris',
  '30 rue mademoiselle',
  75015,
  4,
  2,
  '2017-05-25  14:00:00.00'
)


INSERT INTO annonce(
  `id_annonce`,
  `titre`,
  `description_courte`,
  `description_longue`,
  `prix`,
  `pays`,
  `ville`,
  `adresse`,
  `cp`,
  `membre_id`,
  `categorie_id`,
 `date_enregistrement`
) VALUES (
  1507,
  'iPhone 5S',
  'iPhone 5S 16 go couleur blanc',
  'Ce téléphone vous donnera entière satisfaction. il est comme neuf tout est d\'origine. je le vends également avec des accesoires ',
  175,
  'France',
  'Paris',
  '17 rue de trubigo',
  75002,
  2,
  5,
  '2017-05-25 13:50:00.00'
)

INSERT INTO annonce(
  `id_annonce`,
  `titre`,
  `description_courte`,
  `description_longue`,
  `prix`,
  `pays`,
  `ville`,
  `adresse`,
  `cp`,
  `membre_id`,
  `categorie_id`,
 `date_enregistrement`
) VALUES (
  1506,
'Appartement 4 pièces - 80m²',
  'Au 3éme et dernier étage ...',
  'Cet appartement est mis en location au prix de 1000 €/mois. la superficie est de 80m². Il est situé en plein centre de Lyon',
  650000,
  'France',
  'Lyon',
  '28 quai claude bernard',
  69007,
  1,
  3,
  '2017-05-25 12:30:00'
)