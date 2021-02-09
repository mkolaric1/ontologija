create database mkolaric_19 default character set utf8;
use mkolaric_19;
create table ontologija(
    sifra int not null primary key auto_increment,
    gost varchar(255) not null,
    podcast varchar(100) not null,
    voditelj varchar(500) not null
    
);
insert into ontologija(naziv, tip, opis, anotacija) values ("Test", "fake:test", "Nije dio ontologije!", "fake:test : Ovo je dio testa");
