create database mkolaric_19 default character set utf8;

use mkolaric_19;

create table ontologija(
    sifra int not null primary key auto_increment,
    nazivPodcasta varchar(255) not null,
    voditelj varchar(255) not null,
    brojPregleda int(255) not null,
    podcastTrajanje varchar(255) not null,
    uriPodcasta varchar(255) not null
);


drop table ontologija;

insert into ontologija(sifra, nazivPodcasta, voditelj, brojPregleda, podcastTrajanje, uriPodcasta) values (2, "Test","Test","Test",2689,"01:03:07");

select * from ontologija 

DELETE FROM ontologija
WHERE sifra = 1;