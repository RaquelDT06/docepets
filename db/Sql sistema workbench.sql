describe agendamentos;
alter table cadastro_pet add column usuario_id int; 
alter table cadastro_pet add foreign key (usuario_id) references usuario (id_usuario) ;
alter table agendamentos drop column animal_tipo;
alter table agendamentos add column nasc_data int ;
drop table funcionario;
ALTER TABLE docepets_php.cadastro_pet ADD observacoes varchar(255);

create database docepets;

alter table clientes modify data_check_out varchar (100) not null;

select * from usuario;
select * from cadastro_pet;
select * from agendamentos;
describe agendamentos;

select * from cadastro_pet;

INSERT INTO `docepets_php`.`agendamentos` (`data_agend`, `horario`, `usuario_id`, `pet_id`, `servicos`) VALUES ('2022-03-03', '00:00:00', '3', '1', 'banho');


alter table agendamentos modify column horario time not null after data_agend;


DELETE FROM usuario WHERE id_usuario=12;


drop table clientes;


use docepets;
describe cadastro_pet;
select a.id_agendamento, a.data_agend, a.horario, a.usuario_id, a.pet_id, 
                a.servicos, u.nome as nome_usuario, u.sobrenome as sobrenome_usuario, p.nomepet from agendamentos as a 
                inner join usuario as u on id_usuario = usuario_id 
                inner join cadastro_pet as p on id_pet_cad = id_agendamento;
















