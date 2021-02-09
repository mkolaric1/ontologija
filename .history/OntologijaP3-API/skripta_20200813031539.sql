create database bungar_19 default character set utf8;
use bungar_19;
create table ontologija(
    sifra int not null primary key auto_increment,
    naziv varchar(255) not null,
    tip varchar(100) not null,
    opis varchar(500) not null,
    anotacija text not null
);
insert into ontologija(naziv, tip, opis, anotacija) values ("Test", "fake:test", "Nije dio ontologije!", "fake:test : Ovo je dio testa");
