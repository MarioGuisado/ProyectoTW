/* Database export results for db marioguisado2223 */

/* Preserve session variables */
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS=0;

/* Export data */

/* Table structure for COMENTARIOS */
CREATE TABLE `COMENTARIOS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USUARIO` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `FECHA` datetime NOT NULL,
  `DESCRIPCION` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* data for Table COMENTARIOS */
INSERT INTO `COMENTARIOS` VALUES (10,"Colaborador Colaborador Anónimo","2023-06-27 01:22:59","Creo que tienes toda la razon.");
INSERT INTO `COMENTARIOS` VALUES (11,"Pepito Fernandez Hernandez","2023-06-27 08:57:47","Eso no es verdad. Vuestra calle es muy segura y tiene policía vigilando a todas horas.");
INSERT INTO `COMENTARIOS` VALUES (12,"Colaborador Colaborador Anónimo","2023-06-27 09:06:27","Isabel, esto es un foro para asuntos serios que interesen al pueblo...");
INSERT INTO `COMENTARIOS` VALUES (17,"Colaborador Colaborador Anónimo","2023-06-27 09:25:04","Hola, le escribo desde el ayuntamiento para confirmarle que aquí nadie trabaja, de hecho ahora mismo estoy en un chiringuito");
INSERT INTO `COMENTARIOS` VALUES (18,"Anónimo","2023-06-27 09:27:01","Os echaremos de menos");
INSERT INTO `COMENTARIOS` VALUES (19,"Anónimo","2023-06-27 09:27:26","Parece que os quedareis atrapados para siempre");
INSERT INTO `COMENTARIOS` VALUES (20,"Anónimo","2023-06-27 09:29:53","Completamente de acuerdo, todo el pueblo huele mal.");
INSERT INTO `COMENTARIOS` VALUES (21,"Jesús Casas Martos","2023-06-27 09:36:47","Pues a mi me va bien... Será problema de tu proveedor.");
INSERT INTO `COMENTARIOS` VALUES (22,"Pepito Fernandez Hernandez","2023-06-27 10:41:31","Pues no dejes la bicicleta al aire libre sin vigilar...");

/* Table structure for CONTIENEN */
CREATE TABLE `CONTIENEN` (
  `IDINCIDENCIA` int(11) NOT NULL,
  `IDFOTO` int(11) NOT NULL,
  PRIMARY KEY (`IDINCIDENCIA`,`IDFOTO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* data for Table CONTIENEN */

/* Table structure for CREAN */
CREATE TABLE `CREAN` (
  `IDINCIDENCIA` int(11) NOT NULL,
  `EMAIL` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IDINCIDENCIA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* data for Table CREAN */
INSERT INTO `CREAN` VALUES (62,"hola@go.es");
INSERT INTO `CREAN` VALUES (65,"wills@go.es");
INSERT INTO `CREAN` VALUES (66,"isabel@go.es");
INSERT INTO `CREAN` VALUES (67,"jesus@hotmail.es");
INSERT INTO `CREAN` VALUES (68,"pepito@go.es");
INSERT INTO `CREAN` VALUES (69,"isabel@go.es");
INSERT INTO `CREAN` VALUES (70,"julia@gmail.com");

/* Table structure for FOTOS */
CREATE TABLE `FOTOS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IMAGEN` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* data for Table FOTOS */

/* Table structure for GENERAN */
CREATE TABLE `GENERAN` (
  `IDLOGS` int(11) NOT NULL,
  `EMAIL` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IDLOGS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* data for Table GENERAN */

/* Table structure for INCIDENCIAS */
CREATE TABLE `INCIDENCIAS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLAVES` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `LUGAR` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `FECHA` datetime NOT NULL,
  `NOMBRE` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `TITULO` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `DESCRIPCION` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `ESTADO` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOS` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `VALORACION` int(120) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* data for Table INCIDENCIAS */
INSERT INTO `INCIDENCIAS` VALUES (62,"Calle Basura Huelga","Calles","2023-06-27 01:15:37","Admin","Basura acumulada","Se está acumulando mucha basura en las calles por la huelga. Alguien en el ayuntamiento tiene que solucionarlo ya.","pendiente","Administrador del Sistema",2);
INSERT INTO `INCIDENCIAS` VALUES (65,"Robos","C/Doctor Fleming, n20","2023-06-27 08:53:22","Will","Falta de seguridad","En mi calle robaron hasta las bombillas de las farolas. Hay que aumentar la seguridad del pueblo.","pendiente","Smith",-2);
INSERT INTO `INCIDENCIAS` VALUES (66,"Parque Desactualizado","Parque municipal","2023-06-27 09:00:06","Isabel","Necesitamos un parque nuevo","Este pueblo necesita un parque nuevo. El que tenemos esta desactualizado y mi hijo necesita los columpios de última generación.","pendiente","Castro Rivas",-1);
INSERT INTO `INCIDENCIAS` VALUES (67,"Puente Derrumbado","Puente","2023-06-27 09:08:21","Jesús","Puente principal derrumbado","El puente principal de acceso al pueblo se ha derrumbado y a nadie parece importarle. ¿Como vamos a salir de aquí?","pendiente","Casas Martos",4);
INSERT INTO `INCIDENCIAS` VALUES (68,"Ayuntamiendo LLamada","Ayuntamiento","2023-06-27 09:23:51","Pepito","El ayuntamiento no responde","LLevo dias intentando contactar con el ayuntamiento para resolver un problema, pero nadie coge el telefono, ¿en este pueblo nadie trabaja?","pendiente","Fernandez Hernandez",0);
INSERT INTO `INCIDENCIAS` VALUES (69,"Internet Conexion","Mi casa","2023-06-27 09:35:32","Isabel","Problemas con internet","El internet últimamente va muy mal. Estoy pagando 300 euros al mes y no me carga ni la bandeja de correos.","pendiente","Castro Rivas",1);
INSERT INTO `INCIDENCIAS` VALUES (70,"Pinchazo Delincuencia","C/Portugal, n14","2023-06-27 10:38:45","Julia","Ruedas pinchadas","Ayer me pincharon las ruedas de la bici. Necesitamos más policía en el barrio","pendiente","Casas Fernandez",2);

/* Table structure for LOGS */
CREATE TABLE `LOGS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FECHA` datetime NOT NULL,
  `DESCRIPCION` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* data for Table LOGS */
INSERT INTO `LOGS` VALUES (129,"2023-06-27 01:14:22","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (130,"2023-06-27 01:15:37","El usuario hola@go.es ha añadido una incidencia");
INSERT INTO `LOGS` VALUES (131,"2023-06-27 01:16:00","El usuario hola@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (132,"2023-06-27 01:16:16","Se ha intentado acceder sin éxito con la cuenta colaborador@go.es al sistema");
INSERT INTO `LOGS` VALUES (133,"2023-06-27 01:16:49","Se ha intentado acceder sin éxito con la cuenta colaborador@go.es al sistema");
INSERT INTO `LOGS` VALUES (134,"2023-06-27 01:22:22","El usuario colaborador@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (135,"2023-06-27 01:22:59","El usuario colaborador@go.es ha añadido un comentario");
INSERT INTO `LOGS` VALUES (136,"2023-06-27 01:23:06","El usuario colaborador@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (137,"2023-06-27 01:29:29","El usuario  sale del sistema");
INSERT INTO `LOGS` VALUES (138,"2023-06-27 01:29:33","El usuario  sale del sistema");
INSERT INTO `LOGS` VALUES (139,"2023-06-27 01:29:39","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (140,"2023-06-27 01:29:51","El usuario hola@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (141,"2023-06-27 01:40:22","Se ha intentado acceder sin éxito con la cuenta jesus@hotmail.es al sistema");
INSERT INTO `LOGS` VALUES (142,"2023-06-27 01:40:39","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (143,"2023-06-27 01:42:43","El usuario hola@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (144,"2023-06-27 01:42:58","El usuario isabel@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (145,"2023-06-27 01:44:33","El usuario julia@gmail.com ha modificado sus datos");
INSERT INTO `LOGS` VALUES (146,"2023-06-27 03:33:35","El usuario isabel@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (147,"2023-06-27 03:34:31","El usuario wills@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (148,"2023-06-27 06:14:12","El usuario wills@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (149,"2023-06-27 06:14:22","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (150,"2023-06-27 06:34:50","El usuario hola@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (151,"2023-06-27 06:35:06","El usuario wills@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (152,"2023-06-27 06:37:13","El usuario wills@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (153,"2023-06-27 06:41:06","El usuario wills@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (154,"2023-06-27 06:41:11","El usuario wills@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (155,"2023-06-27 06:41:27","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (156,"2023-06-27 06:42:19","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (157,"2023-06-27 06:43:35","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (158,"2023-06-27 06:43:57","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (159,"2023-06-27 06:47:15","El usuario hola@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (160,"2023-06-27 06:47:32","El usuario pepito@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (161,"2023-06-27 06:59:09","El usuario pepito@go.es ha modificado sus datos");
INSERT INTO `LOGS` VALUES (162,"2023-06-27 06:59:20","El usuario pepito@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (163,"2023-06-27 06:59:41","Se ha intentado acceder sin éxito con la cuenta pepito@go.es al sistema");
INSERT INTO `LOGS` VALUES (164,"2023-06-27 07:01:04","Se ha intentado acceder sin éxito con la cuenta pepito@go.es al sistema");
INSERT INTO `LOGS` VALUES (165,"2023-06-27 07:01:49","El usuario wills@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (166,"2023-06-27 07:02:21","El usuario wills@go.es ha modificado sus datos");
INSERT INTO `LOGS` VALUES (167,"2023-06-27 07:04:53","El usuario wills@go.es ha modificado sus datos");
INSERT INTO `LOGS` VALUES (168,"2023-06-27 07:12:01","El usuario wills@go.es ha añadido una incidencia");
INSERT INTO `LOGS` VALUES (169,"2023-06-27 07:12:37","El usuario wills@go.es ha añadido una incidencia");
INSERT INTO `LOGS` VALUES (170,"2023-06-27 07:46:31","El usuario wills@go.es ha modificado sus datos");
INSERT INTO `LOGS` VALUES (171,"2023-06-27 08:19:45","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (172,"2023-06-27 08:32:56","El usuario hola@go.es ha modificado sus datos");
INSERT INTO `LOGS` VALUES (173,"2023-06-27 08:34:09","El usuario wills@go.es ha modificado sus datos");
INSERT INTO `LOGS` VALUES (174,"2023-06-27 08:38:46","El usuario hola@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (175,"2023-06-27 08:38:55","Se ha intentado acceder sin éxito con la cuenta wills@go.es al sistema");
INSERT INTO `LOGS` VALUES (176,"2023-06-27 08:44:32","Se ha intentado acceder sin éxito con la cuenta hola@go.es al sistema");
INSERT INTO `LOGS` VALUES (177,"2023-06-27 08:44:34","Se ha intentado acceder sin éxito con la cuenta hola@go.es al sistema");
INSERT INTO `LOGS` VALUES (178,"2023-06-27 08:44:36","Se ha intentado acceder sin éxito con la cuenta hola@go.es al sistema");
INSERT INTO `LOGS` VALUES (179,"2023-06-27 08:44:40","Se ha intentado acceder sin éxito con la cuenta hola@go.es al sistema");
INSERT INTO `LOGS` VALUES (180,"2023-06-27 08:44:49","Se ha intentado acceder sin éxito con la cuenta hola@go.es al sistema");
INSERT INTO `LOGS` VALUES (181,"2023-06-27 08:45:36","Se ha intentado acceder sin éxito con la cuenta hola@go.es al sistema");
INSERT INTO `LOGS` VALUES (182,"2023-06-27 08:45:46","Se ha intentado acceder sin éxito con la cuenta hola@go.es al sistema");
INSERT INTO `LOGS` VALUES (183,"2023-06-27 08:46:00","Se ha intentado acceder sin éxito con la cuenta hola@go.es al sistema");
INSERT INTO `LOGS` VALUES (184,"2023-06-27 08:47:10","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (185,"2023-06-27 08:47:37","El usuario hola@go.es ha modificado sus datos");
INSERT INTO `LOGS` VALUES (186,"2023-06-27 08:47:43","El usuario hola@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (187,"2023-06-27 08:47:47","Se ha intentado acceder sin éxito con la cuenta hola@go.es al sistema");
INSERT INTO `LOGS` VALUES (188,"2023-06-27 08:47:55","Se ha intentado acceder sin éxito con la cuenta hola@go.es al sistema");
INSERT INTO `LOGS` VALUES (189,"2023-06-27 08:49:03","Se ha intentado acceder sin éxito con la cuenta hola@go.es al sistema");
INSERT INTO `LOGS` VALUES (190,"2023-06-27 08:49:08","Se ha intentado acceder sin éxito con la cuenta hola@go.es al sistema");
INSERT INTO `LOGS` VALUES (191,"2023-06-27 08:49:48","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (192,"2023-06-27 08:50:47","El usuario hola@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (193,"2023-06-27 08:50:54","El usuario wills@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (194,"2023-06-27 08:51:32","El usuario wills@go.es ha modificado sus datos");
INSERT INTO `LOGS` VALUES (195,"2023-06-27 08:53:22","El usuario wills@go.es ha añadido una incidencia");
INSERT INTO `LOGS` VALUES (196,"2023-06-27 08:53:45","El usuario wills@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (197,"2023-06-27 08:54:07","El usuario pepito@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (198,"2023-06-27 08:57:47","El usuario pepito@go.es ha añadido un comentario");
INSERT INTO `LOGS` VALUES (199,"2023-06-27 08:58:24","El usuario pepito@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (200,"2023-06-27 08:58:55","El usuario isabel@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (201,"2023-06-27 09:00:06","El usuario isabel@go.es ha añadido una incidencia");
INSERT INTO `LOGS` VALUES (202,"2023-06-27 09:05:23","El usuario isabel@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (203,"2023-06-27 09:05:56","El usuario colaborador@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (204,"2023-06-27 09:06:27","El usuario colaborador@go.es ha añadido un comentario");
INSERT INTO `LOGS` VALUES (205,"2023-06-27 09:06:43","El usuario colaborador@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (206,"2023-06-27 09:07:02","El usuario jesus@hotmail.es accede al sistema");
INSERT INTO `LOGS` VALUES (207,"2023-06-27 09:08:21","El usuario jesus@hotmail.es ha añadido una incidencia");
INSERT INTO `LOGS` VALUES (208,"2023-06-27 09:10:05","El usuario jesus@hotmail.es sale del sistema");
INSERT INTO `LOGS` VALUES (210,"2023-06-27 09:10:53","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (211,"2023-06-27 09:13:16","El usuario hola@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (213,"2023-06-27 09:14:18","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (214,"2023-06-27 09:14:26","El usuario hola@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (217,"2023-06-27 09:22:32","El usuario pepito@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (218,"2023-06-27 09:23:51","El usuario pepito@go.es ha añadido una incidencia");
INSERT INTO `LOGS` VALUES (219,"2023-06-27 09:24:11","El usuario pepito@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (220,"2023-06-27 09:24:18","El usuario colaborador@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (221,"2023-06-27 09:25:04","El usuario colaborador@go.es ha añadido un comentario");
INSERT INTO `LOGS` VALUES (222,"2023-06-27 09:26:36","El usuario colaborador@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (223,"2023-06-27 09:27:01","El usuario Anónimo ha añadido un comentario");
INSERT INTO `LOGS` VALUES (224,"2023-06-27 09:27:26","El usuario Anónimo ha añadido un comentario");
INSERT INTO `LOGS` VALUES (225,"2023-06-27 09:29:53","El usuario Anónimo ha añadido un comentario");
INSERT INTO `LOGS` VALUES (226,"2023-06-27 09:31:56","El usuario julia@gmail.com accede al sistema");
INSERT INTO `LOGS` VALUES (227,"2023-06-27 09:34:05","El usuario julia@gmail.com sale del sistema");
INSERT INTO `LOGS` VALUES (228,"2023-06-27 09:34:22","El usuario jesus@hotmail.es accede al sistema");
INSERT INTO `LOGS` VALUES (229,"2023-06-27 09:34:47","El usuario jesus@hotmail.es sale del sistema");
INSERT INTO `LOGS` VALUES (230,"2023-06-27 09:34:54","El usuario isabel@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (231,"2023-06-27 09:35:32","El usuario isabel@go.es ha añadido una incidencia");
INSERT INTO `LOGS` VALUES (232,"2023-06-27 09:35:52","El usuario isabel@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (233,"2023-06-27 09:36:12","El usuario jesus@hotmail.es accede al sistema");
INSERT INTO `LOGS` VALUES (234,"2023-06-27 09:36:47","El usuario jesus@hotmail.es ha añadido un comentario");
INSERT INTO `LOGS` VALUES (235,"2023-06-27 09:40:37","El usuario jesus@hotmail.es sale del sistema");
INSERT INTO `LOGS` VALUES (236,"2023-06-27 10:25:57","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (237,"2023-06-27 10:34:51","El usuario hola@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (238,"2023-06-27 10:34:56","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (239,"2023-06-27 10:36:05","El usuario hola@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (240,"2023-06-27 10:36:30","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (241,"2023-06-27 10:36:50","El usuario hola@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (242,"2023-06-27 10:36:57","El usuario julia@gmail.com accede al sistema");
INSERT INTO `LOGS` VALUES (243,"2023-06-27 10:38:45","El usuario julia@gmail.com ha añadido una incidencia");
INSERT INTO `LOGS` VALUES (244,"2023-06-27 10:39:32","El usuario julia@gmail.com sale del sistema");
INSERT INTO `LOGS` VALUES (245,"2023-06-27 10:39:49","El usuario pepito@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (246,"2023-06-27 10:41:31","El usuario pepito@go.es ha añadido un comentario");
INSERT INTO `LOGS` VALUES (247,"2023-06-27 10:41:48","El usuario pepito@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (248,"2023-06-27 10:41:50","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (249,"2023-06-27 10:41:59","El usuario hola@go.es sale del sistema");
INSERT INTO `LOGS` VALUES (250,"2023-06-27 10:42:09","Se ha intentado acceder sin éxito con la cuenta hola@go.es al sistema");
INSERT INTO `LOGS` VALUES (251,"2023-06-27 10:42:11","El usuario hola@go.es accede al sistema");
INSERT INTO `LOGS` VALUES (252,"2023-06-27 10:42:19","El usuario hola@go.es sale del sistema");

/* Table structure for TIENEN */
CREATE TABLE `TIENEN` (
  `IDCOMENTARIO` int(11) NOT NULL,
  `IDINCIDENCIA` int(11) NOT NULL,
  PRIMARY KEY (`IDCOMENTARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* data for Table TIENEN */
INSERT INTO `TIENEN` VALUES (10,62);
INSERT INTO `TIENEN` VALUES (11,65);
INSERT INTO `TIENEN` VALUES (12,66);
INSERT INTO `TIENEN` VALUES (17,68);
INSERT INTO `TIENEN` VALUES (18,67);
INSERT INTO `TIENEN` VALUES (19,67);
INSERT INTO `TIENEN` VALUES (20,62);
INSERT INTO `TIENEN` VALUES (21,69);
INSERT INTO `TIENEN` VALUES (22,70);

/* Table structure for USUARIOS */
CREATE TABLE `USUARIOS` (
  `EMAIL` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `NOMBRE` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `APELLIDOS` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `FOTO` blob,
  `DIRECCION` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `PASSWD` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `TLFN` int(9) NOT NULL,
  `ADMIN` tinyint(1) NOT NULL,
  `ESTADO` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/* data for Table USUARIOS */
INSERT INTO `USUARIOS` VALUES ("colaborador@go.es","Colaborador","Colaborador Anónimo","","Calle Anónima","$2y$10$XOc3Iu4nTA/SqYuSaA/CU.K9h3Y9gGHnD8hDgGuHqdin4rv0tW3iu",995745063,0,"Activo");
INSERT INTO `USUARIOS` VALUES ("hola@go.es","Admin","Administrador del Sistema","","C/Francia, n13","$2y$10$XOc3Iu4nTA/SqYuSaA/CU.K9h3Y9gGHnD8hDgGuHqdin4rv0tW3iu",165745063,1,"Activo");
INSERT INTO `USUARIOS` VALUES ("isabel@go.es","Isabel","Castro Rivas","","Av. Andalucia, n3","$2y$10$XOc3Iu4nTA/SqYuSaA/CU.K9h3Y9gGHnD8hDgGuHqdin4rv0tW3iu",655241001,1,"Activo");
INSERT INTO `USUARIOS` VALUES ("jesus@hotmail.es","Jesús","Casas Martos","","C/Italia, n22","$2y$10$XOc3Iu4nTA/SqYuSaA/CU.K9h3Y9gGHnD8hDgGuHqdin4rv0tW3iu",755623110,1,"Activo");
INSERT INTO `USUARIOS` VALUES ("julia@gmail.com","Julia","Casas Fernandez","","C/Portugal, n14","$2y$10$XOc3Iu4nTA/SqYuSaA/CU.K9h3Y9gGHnD8hDgGuHqdin4rv0tW3iu",655968523,1,"Activo");
INSERT INTO `USUARIOS` VALUES ("pepito@go.es","Pepito","Fernandez Hernandez","","C/Grecia n14","$2y$10$XOc3Iu4nTA/SqYuSaA/CU.K9h3Y9gGHnD8hDgGuHqdin4rv0tW3iu",970504621,0,"Activo");
INSERT INTO `USUARIOS` VALUES ("wills@go.es","Will","Smith","","C/Doctor Fleming, n20","$2y$10$M4EdvTv91.ooOA5uCjUhZ.zMgE/UiHy/4sAtlz521qqZxW/tqdOcC",999663300,1,"Activo");

/* Restore session variables to original values */
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
