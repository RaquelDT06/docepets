create database docepets_php;

use docepets_php;

create table tipo_pet (
id_pet int auto_increment primary key not null,
descricao varchar (100) not null 
);

create table raca_pet (
id_raca int auto_increment primary key not null,
descricao varchar (100) not null 
);

create table cadastro_pet (
id_pet_cad int auto_increment primary key not null,
nasc_data date not null,
genero varchar (100) not null,
tipo_id int not null,
raca_id int not null,
foreign key (tipo_id) references  tipo_pet (id_pet),
foreign key (raca_id) references raca_pet (id_raca)
);

create table produtos (

id_produto int auto_increment primary key not null,
nome varchar(50) not null,
codigo varchar (50) not null,
preco decimal (11) not null,
estoque varchar (50) not null,
descricao varchar (50) not null
);

create table usuario (

id_usuario int auto_increment primary key not null,
nome varchar(100) not null,
sobrenome varchar (100) not null,
email varchar(100) not null,
senha varchar (255) not null,
nivel tinyint not null default 1,
ativo tinyint not null default 1,
delect_at datetime default null,
updated_at datetime default null,
created_at datetime not null
);

create table agendamentos (
id_agendamento int auto_increment primary key not null,
nomePet varchar(50) not null,
nasc_data date not null,
animal_tipo varchar(45) not null,
data_agend date not null,
horario datetime not null,
usuario_id int not null,
foreign key (usuario_id) references usuario (id_usuario)
);

ALTER TABLE docepets_php.agendamentos DROP COLUMN nomePet;

ALTER TABLE docepets_php.cadastro_pet ADD COLUMN usuario_id int not null;

ALTER TABLE docepets_php.cadastro_pet ADD CONSTRAINT cadastro_pet_FK FOREIGN KEY (usuario_id) REFERENCES docepets_php.usuario(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE docepets_php.agendamentos ADD pet_id INT NOT NULL;

ALTER TABLE docepets_php.agendamentos ADD CONSTRAINT agendamentos_FK FOREIGN KEY (pet_id) REFERENCES docepets_php.cadastro_pet(id_pet_cad) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE docepets_php.cadastro_pet ADD nomepet varchar(100) NOT NULL;
ALTER TABLE docepets_php.cadastro_pet ADD observacoes varchar(255);
alter table agendamentos add column servicos varchar(100) not null;
alter table agendamentos drop column nasc_data;
alter table agendamentos drop column animal_tipo;

ALTER TABLE docepets_php.usuario MODIFY COLUMN created_at datetime DEFAULT NOW() NOT NULL;


INSERT INTO docepets_php.tipo_pet (descricao)
	VALUES ('Cachorro');
INSERT INTO docepets_php.tipo_pet (descricao)
	VALUES ('Gato');
INSERT INTO docepets_php.tipo_pet (descricao)
	VALUES ('Outros');

INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Afghan Hound');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Airedale Terrier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Akita Americano');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Akita Inu');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('American Bully');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('American StaffordShire Terrier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('American Tenerife');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Australian Silky Terrier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Basenji');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Basset Hound');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Beagle');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Bedlington');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Bernese Mountain');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Bichon Frisé');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Biewer Terrier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Bloodhound');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Blue Heeler Boiadeiro Australiano');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Boiadeiro Bernês');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Boiadeiro de Entlebuch');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Border Collie');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Borzoi');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Boston Terrier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Bouvier de Flandes');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Boxer');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Bull Terrier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Bulldog Americano');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Bulldog Campeiro');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Bulldog Francês');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Bulldog Inglês');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Bullmastiff');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Cairn Terrier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Cane Corso');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Cavalier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Chihuahua');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Chow Chow');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Cimarron Uruguayo');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Clumber Spaniel');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Cocker Americano');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Cocker Spaniel Inglês');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Collie');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Collie Barbudo');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Coton de Tulear');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Cão Dágua Espanhol');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Cão Dágua Irlandes');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Cão Dágua Português');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Cão de Crista Chinês');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Cão de Montanha dos Pireneus');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Dachshund');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Dandie Dimmont Terrier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Dobermann');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Dogo Argentino');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Dogue Alemão');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Dogue de Bourdeaux');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Dálmata');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Fila Brasileiro');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Flat Coated Retrivier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Fox Paulistinha');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Fox Terrier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Galgo Irlandês');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Galgo Italiano');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Golden Retriever');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Greyhound');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Griffon de Bruxelas');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Husky Siberiano');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Italian Greyhond');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Jack Russel Terrier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Japanese Chin');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Kerry Blue Terrier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Komondor');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Kuvasz');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Labradoodle');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Labrador Retriever');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Lhasa Apso');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Lulu da Pomerânia');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Lulu da Pomerânia +5kg');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Lulu da Pomerânia até 5kg');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Malamute');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Maltês');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Maltês +5kg');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Maltês até 5kg');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Mastife');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Mastim Napolitano');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Norfolk');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Norwich Terrier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Papillon');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pastor Alemão');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pastor Australiano');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pastor Belga');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pastor Branco');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pastor Branco Suíço');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pastor Maremano');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pastor Polonês');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pastor de Brie');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pastor de Shetland');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pequinês');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pil');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pinscher');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pinscher Alemão');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pitbull');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pointer');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pomsky');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Poodle Gigante');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Poodle Grande (40-50cm)');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Poodle Mini Toy');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Poodle Médio');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Pug');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Puli');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Red Heeler Boiadeiro Australiano');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Rhodesian Ridgeback');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Rottweiler');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Saluki');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Samoieda');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Schipperke');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Schnauzer Gigante');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Schnauzer Mini Toy');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Schnauzer Médio');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Scottish Terrie');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Sem Raça Definida (35 a 45cm)');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Sem Raça Definida (45 a 50cm)');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Sem Raça Definida (50 a 60cm)');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Sem Raça Definida (até 35cm)');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Sem raça acima 70 cm');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Sem raça definida 60 - 70cm');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Setter Gordon');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Setter Inglês');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Setter Irlandês');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Shar Pei');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Sheepdog');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Shiba');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Shih Tzu');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Skye Terrier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Spaniel Bretao');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Spitz +5kg');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Spitz Alemão');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Spitz Japonês');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Spitz até 5kg');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Spitz da Lapônia');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Spring Spaniel Inglês');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Staffordshire');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('São Bernardo');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Teckel Pelo Curto');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Teckel Pelo Longo');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Tenerife');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Tenerife Bichon Frise');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Terra Nova');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Terrier Escocês');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Terrier Toy');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Vizsla');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Weimaraner');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Welsh Corgi Cardigan');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Welsh Corgi Pembroke');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Welsh Terrier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('West White Terrier');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Whippet');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Whippet Pequeno');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Whippet médio');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Wolfhound');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Xoloitzcuintle');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Yakutian Laika');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('York biewer');
INSERT INTO docepets_php.raca_pet (descricao) VALUES ('Yorkshire Terrier');



--liberar login com root

-- for MySQL
--ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';

-- for MariaDB
--ALTER USER 'root'@'localhost' IDENTIFIED VIA mysql_native_password USING PASSWORD('root');

--INSERT INTO `docepets_php`.`usuario` (`id_usuario`, `nome`, `sobrenome`, `email`, `senha`, `nivel`, `ativo`, `created_at`) VALUES ('1', 'admin', 'admin', 'admin@admin', '21232f297a57a5a743894a0e4a801fc3', '1', '1', '2023-01-01');

select a.id_agendamento, a.data_agend, a.horario, a.usuario_id, a.pet_id, 
                a.servicos, u.nome as nome_usuario, u.sobrenome as sobrenome_usuario, p.nomepet from agendamentos as a 
                inner join usuario as u on id_usuario = usuario_id 
                inner join cadastro_pet as p on id_pet_cad = id_agendamento