/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  07/05/2025 00:14:52                      */
/*==============================================================*/


--
-- Database: `PGE`
--
CREATE DATABASE IF NOT EXISTS `PGE`;
USE `PGE`;


/*==============================================================*/
/* Table : abscence                                             */
/*==============================================================*/
create table abscence
(
   idabscence           int not null,
   idetu                int not null,
   idprofesseur         int not null,
   date                 datetime,
   heure                time,
   justifiee            varchar(254),
   motif                int,
   primary key (idabscence)
);

/*==============================================================*/
/* Table : admin                                                */
/*==============================================================*/
create table admin
(
   idadmin              int not null,
   nom                  varchar(254),
   prenom               varchar(254),
   email                varchar(254),
   motdepasse           varchar(254),
   role                 varchar(254),
   matricule            varchar(254),
   primary key (idadmin)
);

/*==============================================================*/
/* Table : avis                                                 */
/*==============================================================*/
create table avis
(
   idavis               int not null,
   idcour               int not null,
   idetu                int not null,
   contenu              varchar(254),
   note                 float,
   datecreation         datetime,
   primary key (idavis)
);

/*==============================================================*/
/* Table : bulletin                                             */
/*==============================================================*/
create table bulletin
(
   idbulletin           int not null,
   idadmin              int not null,
   semestre             int,
   anneescolaire        int,
   appreciation         int,
   moyennegenerale      int,
   calculermoyennegenerale int,
   primary key (idbulletin)
);

/*==============================================================*/
/* Table : cour                                                 */
/*==============================================================*/
create table cour
(
   idcour               int not null,
   idprofesseur         int not null,
   code                 varchar(254),
   libelle              varchar(254),
   coefficient          int,
   volumehoraire        int,
   datecreation         datetime,
   contenu              varchar(254),
   primary key (idcour)
);

/*==============================================================*/
/* Table : note                                                 */
/*==============================================================*/
create table note
(
   idnote               int not null,
   idbulletin           int not null,
   idetu                int not null,
   idadmin              int not null,
   idcour               int not null,
   valeur               float,
   appreciation         varchar(254),
   dateevaluation       datetime,
   typeevaluation       varchar(254),
   primary key (idnote)
);

/*==============================================================*/
/* Table : planning                                             */
/*==============================================================*/
create table planning
(
   idplanning           int not null,
   idadmin              int not null,
   semestre             varchar(254),
   anneescolaire        int,
   date                 datetime,
   heuredebutfin        time,
   salle                varchar(254),
   type                 varchar(254),
   primary key (idplanning)
);

/*==============================================================*/
/* Table : professeur                                           */
/*==============================================================*/
create table professeur
(
   idprofesseur         int not null,
   nom                  varchar(254),
   prenom               varchar(254),
   email                varchar(254),
   motdepasse           varchar(254),
   role                 varchar(254),
   matricule            varchar(254),
   idadmin              int not null,
   numeremploye         int,
   primary key (idprofesseur)
);

/*==============================================================*/
/* Table : student                                              */
/*==============================================================*/
create table student
(
   idetu                int not null,
   nom                  varchar(254),
   prenom               varchar(254),
   email                varchar(254),
   motdepasse           varchar(254),
   role                 varchar(254),
   matricule            varchar(254),
   idadmin              int not null,
   idbulletin           int not null,
   numeroetudiant       int,
   filiere              varchar(254),
   niveau               int,
   classe               varchar(254),
   primary key (idetu)
);

/*==============================================================*/
/* Table : association12                                        */
/*==============================================================*/
create table association12
(
   idetu                int not null,
   idcour               int not null,
   primary key (idetu, idcour)
);

alter table abscence add constraint fk_association4 foreign key (idetu)
      references student (idetu) on delete restrict on update restrict;

alter table abscence add constraint fk_association5 foreign key (idprofesseur)
      references professeur (idprofesseur) on delete restrict on update restrict;

alter table avis add constraint fk_association10 foreign key (idcour)
      references cour (idcour) on delete restrict on update restrict;

alter table avis add constraint fk_association9 foreign key (idetu)
      references student (idetu) on delete restrict on update restrict;

alter table bulletin add constraint fk_association3 foreign key (idadmin)
      references admin (idadmin) on delete restrict on update restrict;

alter table cour add constraint fk_association8 foreign key (idprofesseur)
      references professeur (idprofesseur) on delete restrict on update restrict;

alter table note add constraint fk_association11 foreign key (idbulletin)
      references bulletin (idbulletin) on delete restrict on update restrict;

alter table note add constraint fk_association14 foreign key (idcour)
      references cour (idcour) on delete restrict on update restrict;

alter table note add constraint fk_association6 foreign key (idadmin)
      references admin (idadmin) on delete restrict on update restrict;

alter table note add constraint fk_association7 foreign key (idetu)
      references student (idetu) on delete restrict on update restrict;

alter table planning add constraint fk_association15 foreign key (idadmin)
      references admin (idadmin) on delete restrict on update restrict;

alter table professeur add constraint fk_association2 foreign key (idadmin)
      references admin (idadmin) on delete restrict on update restrict;

alter table student add constraint fk_association1 foreign key (idadmin)
      references admin (idadmin) on delete restrict on update restrict;

alter table student add constraint fk_association13 foreign key (idbulletin)
      references bulletin (idbulletin) on delete restrict on update restrict;

ALTER TABLE association12 ADD CONSTRAINT fk_association12_idcour FOREIGN KEY (idcour)
      REFERENCES cour (idcour) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE association12 ADD CONSTRAINT fk_association12_idetu FOREIGN KEY (idetu)
      REFERENCES student (idetu) ON DELETE RESTRICT ON UPDATE RESTRICT;

