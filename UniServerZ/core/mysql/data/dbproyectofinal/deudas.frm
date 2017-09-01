TYPE=VIEW
query=select distinct concat(`dbproyectofinal`.`clientes`.`Nombres`,\' \',`dbproyectofinal`.`clientes`.`Apellidos`) AS `Nombres`,`dbproyectofinal`.`asistencias`.`idActividades` AS `idActividades`,`dbproyectofinal`.`actividades`.`Nombre` AS `Actividad`,if(((`dbproyectofinal`.`actividades`.`XMes` = 1) and (`dbproyectofinal`.`actividades`.`XClase` = 0)),month(`dbproyectofinal`.`asistencias`.`Fecha`),`dbproyectofinal`.`asistencias`.`Fecha`) AS `Fecha`,(select if(((`dbproyectofinal`.`actividades`.`XMes` = 1) and (`dbproyectofinal`.`actividades`.`XClase` = 0)),\'PrecioXMes\',\'PrecioXFecha\') from `dbproyectofinal`.`actividadesaranceles` where ((`dbproyectofinal`.`actividadesaranceles`.`idActividades` = `dbproyectofinal`.`asistencias`.`idActividades`) and (`dbproyectofinal`.`actividadesaranceles`.`FechaInicio` < `dbproyectofinal`.`asistencias`.`Fecha`) and (`dbproyectofinal`.`actividadesaranceles`.`idModalidades` = (select `dbproyectofinal`.`clientesactividades`.`idModalidades` from `dbproyectofinal`.`clientesactividades` where ((`dbproyectofinal`.`clientesactividades`.`idClientes` = `dbproyectofinal`.`asistencias`.`idClientes`) and (`dbproyectofinal`.`clientesactividades`.`idActividades` = `dbproyectofinal`.`asistencias`.`idActividades`)))))) AS `Monto`,`dbproyectofinal`.`asistencias`.`idClientes` AS `idClientes` from ((`dbproyectofinal`.`asistencias` left join `dbproyectofinal`.`clientes` on((`dbproyectofinal`.`asistencias`.`idClientes` = `dbproyectofinal`.`clientes`.`idClientes`))) left join `dbproyectofinal`.`actividades` on((`dbproyectofinal`.`asistencias`.`idActividades` = `dbproyectofinal`.`actividades`.`idActividades`))) where (`dbproyectofinal`.`asistencias`.`Abonado` = 0)
md5=b64e7bad982b541fbe34776c38b5f6ca
updatable=0
algorithm=0
definer_user=root
definer_host=127.0.0.1
suid=1
with_check_option=0
timestamp=2017-08-31 13:35:15
create-version=1
source=select distinct concat(`dbproyectofinal`.`clientes`.`Nombres`,\' \',`dbproyectofinal`.`clientes`.`Apellidos`) AS `Nombres`,`dbproyectofinal`.`asistencias`.`idActividades` AS `idActividades`,`dbproyectofinal`.`actividades`.`Nombre` AS `Actividad`,if(((`dbproyectofinal`.`actividades`.`XMes` = 1) and (`dbproyectofinal`.`actividades`.`XClase` = 0)),month(`dbproyectofinal`.`asistencias`.`Fecha`),`dbproyectofinal`.`asistencias`.`Fecha`) AS `Fecha`,(select if(((`dbproyectofinal`.`actividades`.`XMes` = 1) and (`dbproyectofinal`.`actividades`.`XClase` = 0)),\'PrecioXMes\',\'PrecioXFecha\') from `dbproyectofinal`.`actividadesaranceles` where ((`dbproyectofinal`.`actividadesaranceles`.`idActividades` = `dbproyectofinal`.`asistencias`.`idActividades`) and (`dbproyectofinal`.`actividadesaranceles`.`FechaInicio` < `dbproyectofinal`.`asistencias`.`Fecha`) and (`dbproyectofinal`.`actividadesaranceles`.`idModalidades` = (select `dbproyectofinal`.`clientesactividades`.`idModalidades` from `dbproyectofinal`.`clientesactividades` where ((`dbproyectofinal`.`clientesactividades`.`idClientes` = `dbproyectofinal`.`asistencias`.`idClientes`) and (`dbproyectofinal`.`clientesactividades`.`idActividades` = `dbproyectofinal`.`asistencias`.`idActividades`)))))) AS `Monto`,`dbproyectofinal`.`asistencias`.`idClientes` AS `idClientes` from ((`dbproyectofinal`.`asistencias` left join `dbproyectofinal`.`clientes` on((`dbproyectofinal`.`asistencias`.`idClientes` = `dbproyectofinal`.`clientes`.`idClientes`))) left join `dbproyectofinal`.`actividades` on((`dbproyectofinal`.`asistencias`.`idActividades` = `dbproyectofinal`.`actividades`.`idActividades`))) where (`dbproyectofinal`.`asistencias`.`Abonado` = 0)
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_general_ci
view_body_utf8=select distinct concat(`dbproyectofinal`.`clientes`.`Nombres`,\' \',`dbproyectofinal`.`clientes`.`Apellidos`) AS `Nombres`,`dbproyectofinal`.`asistencias`.`idActividades` AS `idActividades`,`dbproyectofinal`.`actividades`.`Nombre` AS `Actividad`,if(((`dbproyectofinal`.`actividades`.`XMes` = 1) and (`dbproyectofinal`.`actividades`.`XClase` = 0)),month(`dbproyectofinal`.`asistencias`.`Fecha`),`dbproyectofinal`.`asistencias`.`Fecha`) AS `Fecha`,(select if(((`dbproyectofinal`.`actividades`.`XMes` = 1) and (`dbproyectofinal`.`actividades`.`XClase` = 0)),\'PrecioXMes\',\'PrecioXFecha\') from `dbproyectofinal`.`actividadesaranceles` where ((`dbproyectofinal`.`actividadesaranceles`.`idActividades` = `dbproyectofinal`.`asistencias`.`idActividades`) and (`dbproyectofinal`.`actividadesaranceles`.`FechaInicio` < `dbproyectofinal`.`asistencias`.`Fecha`) and (`dbproyectofinal`.`actividadesaranceles`.`idModalidades` = (select `dbproyectofinal`.`clientesactividades`.`idModalidades` from `dbproyectofinal`.`clientesactividades` where ((`dbproyectofinal`.`clientesactividades`.`idClientes` = `dbproyectofinal`.`asistencias`.`idClientes`) and (`dbproyectofinal`.`clientesactividades`.`idActividades` = `dbproyectofinal`.`asistencias`.`idActividades`)))))) AS `Monto`,`dbproyectofinal`.`asistencias`.`idClientes` AS `idClientes` from ((`dbproyectofinal`.`asistencias` left join `dbproyectofinal`.`clientes` on((`dbproyectofinal`.`asistencias`.`idClientes` = `dbproyectofinal`.`clientes`.`idClientes`))) left join `dbproyectofinal`.`actividades` on((`dbproyectofinal`.`asistencias`.`idActividades` = `dbproyectofinal`.`actividades`.`idActividades`))) where (`dbproyectofinal`.`asistencias`.`Abonado` = 0)