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

ALTER TABLE docepets_php.usuario MODIFY COLUMN created_at datetime DEFAULT NOW() NOT NULL;


--liberar login com root

-- for MySQL
--ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';

-- for MariaDB
--ALTER USER 'root'@'localhost' IDENTIFIED VIA mysql_native_password USING PASSWORD('root');

--INSERT INTO `docepets_php`.`usuario` (`id_usuario`, `nome`, `sobrenome`, `email`, `senha`, `nivel`, `ativo`, `created_at`) VALUES ('1', 'admin', 'admin', 'admin@admin', '21232f297a57a5a743894a0e4a801fc3', '1', '1', '2023-01-01');

