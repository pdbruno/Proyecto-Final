TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`127.0.0.1` TRIGGER `CheckAbonado` BEFORE INSERT ON `asistencias` FOR EACH ROW IF (SELECT COUNT(*) FROM `cobros` WHERE `idClientes` = NEW.idClientes AND `idActividades` = NEW.idActividades AND (NEW.Fecha BETWEEN `Fecha1` AND `Fecha2`)) = 0 THEN\n		SET NEW.Abonado = 0;\nELSE\n		SET NEW.Abonado = 1;\nEND IF'
sql_modes=1073741824
definers='root@127.0.0.1'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_general_ci'
db_cl_names='utf8_general_ci'
