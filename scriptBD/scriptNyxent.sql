-- drop database  nyxent
create database nyxent;
use nyxent;

-- crear tablas
create table pages (
id_page int auto_increment primary key,
id_docs_page int,
num_page int,
json_page varchar(1000),
id_imag_page int
);

create table documents (
id_docs int auto_increment primary key,
name_docs varchar (80)
);

create table images (
id_imag int auto_increment primary key,
json_imag varchar(500)
);

-- modelo entidad relacion

ALTER TABLE `nyxent`.`pages` ADD CONSTRAINT `idDocument`
  FOREIGN KEY (`id_docs_page`)
  REFERENCES `nyxent`.`documents` (`id_docs`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `idImage`
  FOREIGN KEY (`id_imag_page`)
  REFERENCES `nyxent`.`images` (`id_imag`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

-- datos
insert into `nyxent`.`documents` (name_docs) values ('document1');
insert into `nyxent`.`images` (json_imag) values ('{"img":{"src":"img/doc1/img1.jpg", "alt":"img1", "height":"400", "width":"400"}}');
insert into `nyxent`.`images` (json_imag) values ('{"img":{"src":"img/doc1/img2.jpg", "alt":"img1", "height":"400", "width":"400"}}');

insert into `nyxent`.`pages` (id_docs_page, num_page, json_page,id_imag_page)
values (1,1,'{"objects":[{"text":{"x":643,"y":71,"width":82,"height":33,"font":"Arial","style":"bold","size":24,"label":"Part A"}},{"text":{"x":643,"y":116,"width":389,"height":42,"font":"Arial","style":"bold","size":16,"label":"What does \"novel\" mean as it is used in paragraph 8 of \"Turning Down a New Road\"? "}},{"radiobutton":{"x":643,"y":170,"width":100,"height":20,"label":"A. old"}},{"radiobutton":{"x":643,"y":209,"width":100,"height":20,"label":"B. afraid"}},{"radiobutton":{"x":643,"y":250,"width":100,"height":20,"label":"C. new"}},{"radiobutton":{"x":643,"y":289,"width":100,"height":20,"label":"D. friendly"}}]}',1)
,(1,2,'{"objects":[{"text":{"x":643,"y":315,"width":82,"height":33,"font":"Arial","style":"bold","size":24,"label":"Part B"}},{"text":{"x":643,"y":361,"width":537,"height":27,"font":"Arial","style":"bold","size":16,"label":"Mai Chong changes during the story.<br/><br/>Which two words best describes Mai Chong at the END?"}},{"checkbox":{"x":643,"y":450,"width":537,"height":20,"label":"A. powerless"}},{"checkbox":{"x":643,"y":490,"width":537,"height":20,"label":"B. helpful"}},{"checkbox":{"x":643,"y":530,"width":537,"height":20,"label":"C. angry"}},{"checkbox":{"x":643,"y":570,"width":537,"height":20,"label":"D. hurt"}},{"checkbox":{"x":643,"y":610,"width":537,"height":20,"label":"E. brave"}}]}',2)


