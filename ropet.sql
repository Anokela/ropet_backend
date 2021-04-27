drop DATABASE if exists roolipelit;

create DATABASE roolipelit CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
use roolipelit;


create table peli (
    pelinro int primary key AUTO_increment,
    pelin_nimi varchar (30) NOT NULL,
    pelinjohtaja varchar (30) NOT NULL
);

INSERT INTO peli (pelin_nimi, pelinjohtaja) VALUES ('Witcher RPG','Aleksi'),('Vampire:The Masquerade', 'Tomme'),('Shadowrun','Taneli'),('Twilight:2000','Severi');

create table hahmo (
    hahmonro int primary key AUTO_increment,
    pelinro int NOT NULL,    
    pelaaja_nimi varchar (30) NOT NULL,
    hahmon_nimi varchar (30) NOT NULL,
    CONSTRAINT hahmo_fk FOREIGN KEY (pelinro) 
        REFERENCES peli (pelinro)
);

INSERT INTO hahmo (pelinro,pelaaja_nimi,hahmon_nimi) VALUES (1, 'Matti','Ansell RindelÃ¤inen'),(1,'Heikki','Konrad'),(2,'Mika','Janitsaari'),(2,'Juha','Earl'),(3,'Marko','Hakon Hardbein'),(3,'Jani','Arianne'),(4,'Kirsi','Isabella Perez'),
(4,'Jaakko','Kurt Von Steiner');

create table tila (
    ID int PRIMARY KEY AUTO_increment,
    luontipvm date NOT NULL,
    hahmonro int unique NOT NULL,
    hahmon_nimi varchar (30) NOT NULL,
    tila varchar (7) NOT NULL,
    kuolinpvm date,
    CONSTRAINT fk_tila FOREIGN KEY (hahmonro)
        REFERENCES hahmo (hahmonro)
);

INSERT INTO tila (luontipvm,hahmonro,hahmon_nimi, tila) VALUES
 ('2019-06-20',1,'Ansell RindelÃ¤inen','Elossa'),('2019-06-14',2,'Konrad','Elossa'),('2020-04-22',3,'Janitsaari','Elossa'),('2020-03-12',4,'Earl','Elossa'),('2021-01-02',5,'Hakon Hardbein','Elossa'),
 ('2019-04-15',6,'Arianne','Elossa'),('2019-12-22',7,'Isabella Perez','Elossa'),('2017-06-22',8,'Kurt Von Steiner','Elossa');

UPDATE  tila SET tila = 'Kuollut' where hahmon_nimi = 'Konrad'; 
UPDATE  tila SET kuolinpvm = '2020-10-14' where hahmon_nimi = 'Konrad';
UPDATE  tila SET tila = 'Kuollut' where hahmon_nimi = 'Kurt Von Steiner';
UPDATE  tila SET kuolinpvm = '2019-07-02' where hahmon_nimi = 'Kurt Von Steiner';
UPDATE  tila SET tila = 'Kuollut' where hahmon_nimi = 'Hakon Hardbein';      
UPDATE  tila SET kuolinpvm = '2021-06-13' where hahmon_nimi = 'Hakon Hardbein';
















