TYPE=VIEW
query=select concat(concat(`dbproyectofinal`.`clientes`.`Nombres`,\' \',`dbproyectofinal`.`clientes`.`Apellidos`),\' \',`dbproyectofinal`.`actividades`.`Nombre`) AS `Nombre`,`dbproyectofinal`.`cobros`.`Monto` AS `Monto`,`dbproyectofinal`.`cobros`.`Fecha` AS `Fecha`,`dbproyectofinal`.`actividades`.`idFondos` AS `idFondos`,\'Cobro de actividad\' AS `Tipo` from ((`dbproyectofinal`.`cobros` join `dbproyectofinal`.`actividades` on((`dbproyectofinal`.`cobros`.`idActividades` = `dbproyectofinal`.`actividades`.`idActividades`))) join `dbproyectofinal`.`clientes` on((`dbproyectofinal`.`cobros`.`idClientes` = `dbproyectofinal`.`clientes`.`idClientes`))) union select `dbproyectofinal`.`productos`.`Nombre` AS `Nombre`,`dbproyectofinal`.`registroventas`.`Monto` AS `Monto`,`dbproyectofinal`.`registroventas`.`Fecha` AS `Fecha`,`dbproyectofinal`.`registroventas`.`idFondos` AS `idFondos`,\'Venta de stock\' AS `Tipo` from (`dbproyectofinal`.`registroventas` join `dbproyectofinal`.`productos` on((`dbproyectofinal`.`registroventas`.`idProductos` = `dbproyectofinal`.`productos`.`idProductos`))) order by `Fecha` desc
md5=3ac9ab1212047883c51f8c04fbbf97df
updatable=0
algorithm=0
definer_user=root
definer_host=127.0.0.1
suid=1
with_check_option=0
timestamp=2017-09-24 22:25:33
create-version=1
source=select concat(concat(`dbproyectofinal`.`clientes`.`Nombres`,\' \',`dbproyectofinal`.`clientes`.`Apellidos`),\' \',`dbproyectofinal`.`actividades`.`Nombre`) AS `Nombre`,
client_cs_name=utf8mb4
connection_cl_name=utf8mb4_general_ci
view_body_utf8=select concat(concat(`dbproyectofinal`.`clientes`.`Nombres`,\' \',`dbproyectofinal`.`clientes`.`Apellidos`),\' \',`dbproyectofinal`.`actividades`.`Nombre`) AS `Nombre`,`dbproyectofinal`.`cobros`.`Monto` AS `Monto`,`dbproyectofinal`.`cobros`.`Fecha` AS `Fecha`,`dbproyectofinal`.`actividades`.`idFondos` AS `idFondos`,\'Cobro de actividad\' AS `Tipo` from ((`dbproyectofinal`.`cobros` join `dbproyectofinal`.`actividades` on((`dbproyectofinal`.`cobros`.`idActividades` = `dbproyectofinal`.`actividades`.`idActividades`))) join `dbproyectofinal`.`clientes` on((`dbproyectofinal`.`cobros`.`idClientes` = `dbproyectofinal`.`clientes`.`idClientes`))) union select `dbproyectofinal`.`productos`.`Nombre` AS `Nombre`,`dbproyectofinal`.`registroventas`.`Monto` AS `Monto`,`dbproyectofinal`.`registroventas`.`Fecha` AS `Fecha`,`dbproyectofinal`.`registroventas`.`idFondos` AS `idFondos`,\'Venta de stock\' AS `Tipo` from (`dbproyectofinal`.`registroventas` join `dbproyectofinal`.`productos` on((`dbproyectofinal`.`registroventas`.`idProductos` = `dbproyectofinal`.`productos`.`idProductos`))) order by `Fecha` desc