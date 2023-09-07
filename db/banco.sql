create database docepets_php;
use docepets_php;

create table produtos (

id_produto int auto_increment primary key not null,
nome varchar(50) not null,
codigo varchar (50) not null,
preco decimal (11) not null,
estoque varchar (50) not null,
descricao varchar (50) not null

);

create table pet_funcionario (

id_funcionario int auto_increment primary key not null,
nome varchar(200) not null


);

create table pet_funcao (

id_funcao int auto_increment primary key not null,
descricao varchar(100) not null


);

create table agendamentos (

id_agendamento int auto_increment primary key not null,
nomePet varchar(50) not null,
nasc_data date not null,
animal_tipo varchar(45) not null,
data_agend date not null,
horario datetime not null,
funcionario_id int not null,
foreign key (funcionario_id) references pet_funcionario (id_funcionario)

);

create table cadastrodono (

id_donocad int auto_increment primary key not null,
nome varchar(100) not null,
nasc_data date not null,
cpf varchar(15) not null,
email varchar(100) not null,
endereco varchar (150) not null,
cep varchar (10) not null,
cidade varchar (45) not null,
telefone varchar (12) not null,
agend_id int not null,
prod_id int not null,
foreign key (agend_id) references agendamentos (id_agendamento),
foreign key (prod_id) references produtos (id_produto)

);

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

create table usuario (

id_usuario int auto_increment primary key not null,
nome varchar(100) not null,
sobrenome varchar (100) not null,
email varchar(100) not null,
senha varchar (255) not null,
nivel tinyint not null default 1,
ativo tinyint not null default 1,
delect_at datetime ,
updated_at datetime,
created_at datetime not null,
cadDono_id int not null,
foreign key (cadDono_id) references cadastrodono (id_donocad)
);

create table funcionario (

matricula int auto_increment primary key not null,
data_contrato datetime not null,
data_finalContrato datetime,
usuarios_id int not null,
funcoes_id int not null,
foreign key (usuarios_id) references usuario (id_usuario),
foreign key (funcoes_id) references pet_funcao (id_funcao)

);






