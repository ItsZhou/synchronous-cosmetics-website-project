DROP DATABASE IF EXISTS Cosmetica_v1;

CREATE DATABASE Cosmetica_v1 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE Cosmetica_v1;

CREATE TABLE `USUARIOS`
(
    idusuario       MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nomusuario      VARCHAR (15) NOT NULL,
    apellidos       VARCHAR (20) NOT NULL,
    fecnacimiento   DATE NOT NULL,
    direccion       VARCHAR (40) NOT NULL,
    email           VARCHAR (40) NOT NULL,
    telefono        VARCHAR (12) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `PEDIDOSONLINE`
(
    idpedido        MEDIUMINT UNSIGNED UNIQUE AUTO_INCREMENT,
    idusuario       MEDIUMINT UNSIGNED,
    PRIMARY KEY ( idpedido, idusuario ),
    numpedido       VARCHAR (20) NOT NULL,
    fecpedido       DATE NOT NULL,
    preciopedido    FLOAT (5,2) NOT NULL,
    CONSTRAINT fk_PEDIDOSONLINE_idusuario
        FOREIGN KEY ( idusuario ) 
        REFERENCES USUARIOS ( idusuario )
) ENGINE = InnoDB;

CREATE TABLE `CODIGOSPROMOCIONALES`
(
    idcodigopromocional     TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    codigopromocional       CHAR (8) NOT NULL,
    fecinicio               DATE NOT NULL,
    descuento               FLOAT (4,2) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `CADUCIDADCODIGOSPROMOCIONALES`
(
    idcodigopromocional     TINYINT UNSIGNED PRIMARY KEY,
    fecfincodigo            DATE NOT NULL,
    CONSTRAINT fk_CADUCIDADCODIGOSPROMOCIONALES_idcodigopromocional
        FOREIGN KEY ( idcodigopromocional )
        REFERENCES CODIGOSPROMOCIONALES ( idcodigopromocional )
) ENGINE = InnoDB;

CREATE TABLE `USUARIOSCODIGOSPROMOCIONALES`
(
    idusuario               MEDIUMINT UNSIGNED,
    idcodigopromocional     TINYINT UNSIGNED,
    PRIMARY KEY ( idusuario, idcodigopromocional ),
    fecinicio               DATE NOT NULL,
    CONSTRAINT fk_USUARIOSCODIGOSPROMOCIONALES_idusuario
        FOREIGN KEY ( idusuario )
        REFERENCES USUARIOS ( idusuario ),
    CONSTRAINT fk_USUARIOSCODIGOSPROMOCIONALES_idcodigopromocional
        FOREIGN KEY ( idcodigopromocional )
        REFERENCES CODIGOSPROMOCIONALES ( idcodigopromocional )  
) ENGINE = InnoDB;

CREATE TABLE `CODIGOSPROMOCIONALESPORPEDIDO`
(
    idpedido                MEDIUMINT UNSIGNED PRIMARY KEY UNIQUE,
    idusuario               MEDIUMINT UNSIGNED NOT NULL,
    idcodigopromocional     TINYINT UNSIGNED NOT NULL,
    CONSTRAINT fk_CODIGOSPROMOCIONALESPORPEDIDO_idped_idusu
        FOREIGN KEY ( idpedido, idusuario )
        REFERENCES PEDIDOSONLINE ( idpedido, idusuario ),
    CONSTRAINT fk_CODIGOSPROMOCIONALESPORPEDIDO_idusuario
        FOREIGN KEY ( idusuario )
        REFERENCES USUARIOSCODIGOSPROMOCIONALES ( idusuario ),
    CONSTRAINT fk_CODIGOSPROMOCIONALESPORPEDIDO_idcodigopromocional
        FOREIGN KEY ( idcodigopromocional )
        REFERENCES USUARIOSCODIGOSPROMOCIONALES ( idcodigopromocional )
) ENGINE = InnoDB;

CREATE TABLE `CATEGORIAS`
(
    idcategoria             TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,             
    nomcategoria            VARCHAR (35) NOT NULL,
    icono                   VARCHAR (40) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `SUBCATEGORIAS`
(
    idsubcategoria          TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,             
    nomsubcategoria         VARCHAR (35) NOT NULL,
    idcategoria             TINYINT UNSIGNED NOT NULL,
    CONSTRAINT fk_SUBCATEGORIAS_idcategoria
        FOREIGN KEY ( idcategoria )
        REFERENCES CATEGORIAS ( idcategoria )
) ENGINE = InnoDB;

CREATE TABLE `SUBCATEGORIATIPOS`
(
    idsubcategoriatipo      TINYINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,             
    nomsubcategoriatipo     VARCHAR (35) NOT NULL,
    idsubcategoria          TINYINT UNSIGNED NOT NULL,
    CONSTRAINT fk_SUBCATEGORIATIPOS_idsubcategoria
        FOREIGN KEY ( idsubcategoria )
        REFERENCES SUBCATEGORIAS ( idsubcategoria )
) ENGINE = InnoDB;

CREATE TABLE `MARCAS`
(
    idmarca                 SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,             
    nommarca                VARCHAR (30) NOT NULL,
    foto                    VARCHAR (40) NOT NULL,
    descripcion             TEXT NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `PRODUCTOS`
(
    idproducto              MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,             
    nomproducto             VARCHAR (45) NOT NULL,
    descripcion             TEXT NOT NULL,
    precio                  FLOAT (6,2) NOT NULL,
    idsubcategoriatipo      TINYINT UNSIGNED NOT NULL,
    idmarca                 SMALLINT UNSIGNED NOT NULL,
    CONSTRAINT fk_PRODUCTOS_idsubcategoriatipo
        FOREIGN KEY ( idsubcategoriatipo )
        REFERENCES SUBCATEGORIATIPOS ( idsubcategoriatipo ),
    CONSTRAINT fk_PRODUCTOS_idmarca
        FOREIGN KEY ( idmarca )
        REFERENCES MARCAS ( idmarca )  
) ENGINE = InnoDB;

CREATE TABLE `ARTICULOS`
(
    idarticulo              MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,             
    idproducto              MEDIUMINT UNSIGNED NOT NULL,
    CONSTRAINT fk_ARTICULOS_idproducto
        FOREIGN KEY ( idproducto )
        REFERENCES PRODUCTOS ( idproducto )
) ENGINE = InnoDB;

CREATE TABLE `ARTICULOSPEDIDOSONLINE`
(
    idarticulo              MEDIUMINT UNSIGNED PRIMARY KEY,             
    idpedido                MEDIUMINT UNSIGNED NOT NULL,
    CONSTRAINT fk_ARTICULOSPEDIDOSONLINE_idarticulo
        FOREIGN KEY ( idarticulo )
        REFERENCES ARTICULOS ( idarticulo ),
    CONSTRAINT fk_ARTICULOSPEDIDOSONLINE_idpedido
        FOREIGN KEY ( idpedido )
        REFERENCES PEDIDOSONLINE ( idpedido )
) ENGINE = InnoDB;

CREATE TABLE `CALIFICACIONES`
(
    idarticulo              MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,             
    calificacion            TINYINT UNSIGNED NOT NULL,
    CONSTRAINT ck_calificacion
        CHECK ( calificacion >=1 AND calificacion <=9 ),
    feccalificacion         DATE NOT NULL,
    CONSTRAINT fk_CALIFICACIONES_idarticulo
        FOREIGN KEY ( idarticulo )
        REFERENCES ARTICULOSPEDIDOSONLINE ( idarticulo )
) ENGINE = InnoDB;

CREATE TABLE `COMENTARIOS`
(
    idarticulo              MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,             
    comentario              TEXT NOT NULL,
    feccomentario           DATE NOT NULL,
    CONSTRAINT fk_COMENTARIOS_idarticulo
        FOREIGN KEY ( idarticulo )
        REFERENCES ARTICULOSPEDIDOSONLINE ( idarticulo )
) ENGINE = InnoDB;


CREATE TABLE `IMAGENES`
(
    idimagen                SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,             
    nomimagen               VARCHAR (40) NOT NULL,
    iorden                  SMALLINT UNSIGNED NOT NULL,
    idproducto              MEDIUMINT UNSIGNED NOT NULL,
    CONSTRAINT fk_IMAGENES_idproducto
        FOREIGN KEY ( idproducto )
        REFERENCES PRODUCTOS ( idproducto )  
) ENGINE = InnoDB;

