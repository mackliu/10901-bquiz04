
insert into admin (`acc`,`pw`,`pr`) values('admin','1234','<?=serialize([1,2,3,4,5]);?>');
