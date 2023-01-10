 <?php
	require ("mod001_conexion.php");

	function mod002_executeQuery( $strSQL, $arAttributes ) {
        $link = mod001_conectoBD();

        if ( $result = $link -> query( $strSQL ) ) {
            if ( $result -> num_rows !== 0 ) {
                $arRetorno[ "status" ][ "codError" ] = "000"; // Con datos.
                $arRetorno[ "status" ][ "numRows" ]  = $result -> num_rows;
                
                $i = 0;
                while ( $row = $result -> fetch_array( MYSQLI_ASSOC ) ) {
                    foreach( $arAttributes as $element ) {
                        if ( isset( $element[ 2 ] ) ) {
                            if ( $element[ 2 ] === "bool" ) {
                                $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = (bool)$row[ $element[ 0 ] ];
                            } else if ( $element[ 2 ] === "int" ) {
                                if ( $row[ $element[ 0 ] ] !== null ) {
                                    $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = intval( $row[ $element[ 0 ] ] );
                                } else {
                                    $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = null;
                                }
                            }
                        } else {
                            $arRetorno[ "data" ][ $i ][ $element[ 1 ] ] = $row[ $element[ 0 ] ];
                        }                 
                    }
                    $i++;
                }
            } else {
                $arRetorno[ "status" ][ "codError" ]    = "001"; // Sin datos.
                $arRetorno[ "status" ][ "strSQL" ]      = $strSQL;
            }
        } else {
            $arRetorno[ "status" ][ "codError" ]        = "002"; // Error Query.
            $arRetorno[ "status" ][ "strSQL" ]          = $strSQL;
            $arRetorno[ "status" ][ "codSQL" ]          = $link -> errno;
            $arRetorno[ "status" ][ "desSQL" ]          = $link -> error;
        }

        mod001_desconectoBD($link);

        return $arRetorno;
    }

	function mod002_getUsuarios() {
		//$link = mod001_conectoBD();
		// Realizar la query de recuperacion…..
		// Escribir en el array los datos a recuperar. No hay tratamiento de datos.
		$arAttributes =[
			[ "idusuario",		"idUser",		"int"       ],
			[ "nomusuario",		"nameUser",			        ],
            [ "apellidos",		"surnameUser",			    ],
			[ "direccion",		"addressUser",		        ],
			[ "email",			"emailUser",		        ],
            [ "telefono",		"telephoneUser",		    ],
		];

        $strSQL = "SELECT idusuario, nomusuario, apellidos, direccion, email, telefono
                    FROM USUARIOS";
		
		$arRetorno = mod002_executeQuery( $strSQL, $arAttributes );

		return $arRetorno;
	}

    function mod002_getUsuariosSheet( $idUsuario ) {
		$arAttributes =[
			[ "nomusuario",		"nomuser"	                ],
			[ "idpedido",		"idOrder",		"int"       ],
            [ "numpedido",		"numberOrder",			    ],
			[ "fecpedido",		"dateOrder",		        ],
			[ "preciopedido",	"priceOrder",		        ]
		];

        $strSQL = "SELECT nomusuario, idpedido, numpedido, fecpedido, preciopedido
                    FROM USUARIOS
                    INNER JOIN PEDIDOSONLINE
                    ON USUARIOS.idusuario = PEDIDOSONLINE.idusuario
                    WHERE PEDIDOSONLINE.idusuario = $idUsuario";
		
		$arRetorno = mod002_executeQuery( $strSQL, $arAttributes );
//dump( $arRetorno );
		return $arRetorno;
	}

    function mod002_getMarcas() {
		//$link = mod001_conectoBD();
		// Realizar la query de recuperacion…..
		// Escribir en el array los datos a recuperar. No hay tratamiento de datos.
		$arAttributes =[
			[ "idmarca",		"idBrand",			"int" 	  ],
			[ "nommarca",		"nameBrand",			  	  ],
			[ "foto",			"photoBrand",		  	      ],
			[ "descripcion",	"descriptionBrand",		      ]
		];

        $strSQL = "SELECT idmarca, LOWER( nommarca ) as nommarca, foto, descripcion
                    FROM MARCAS
                    ORDER BY nommarca ASC";
		
		$arRetorno = mod002_executeQuery( $strSQL, $arAttributes);
		
		return $arRetorno;
	}

    function mod002_getMarcasProductosSheet($idMarca) {
		//$link = mod001_conectoBD();
		// Realizar la query de recuperacion…..
		// Escribir en el array los datos a recuperar. No hay tratamiento de datos.
		$arAttributes =[
			[ "nomproducto",		"nameProduct",			 	  ],
			[ "descripcion",		"descriptionProduct",		  ],
			[ "precio",			    "priceProduct",		  	      ],
            [ "nomimagen",			"photoProduct",		  	      ]
		];

        /*$strSQL = "SELECT nomproducto, descripcion, precio, nomimagen
                    FROM PRODUCTOS 
                    INNER JOIN IMAGENES
                    ON PRODUCTOS.idproducto = IMAGENES.idproducto
                    WHERE PRODUCTOS.idproducto = $idProduct";*/

        $strSQL = "SELECT nomproducto, PRODUCTOS.descripcion, precio, nomimagen, PRODUCTOS.idmarca
                    FROM PRODUCTOS 
                    INNER JOIN IMAGENES
                    ON PRODUCTOS.idproducto = IMAGENES.idproducto
                    INNER JOIN MARCAS
                    ON PRODUCTOS.idmarca = MARCAS.idmarca
                    WHERE MARCAS.idmarca = $idMarca";
		
		$arRetorno = mod002_executeQuery( $strSQL, $arAttributes);
		
		return $arRetorno;
	}

    function mod002_getCategorias() {
        $arAttributes =[
			[ "idcategoria",		"idCategory",		"int"   ],
			[ "nomcategoria",		"nameCategory",		        ],
			[ "icono",			    "iconoCategory",		  	]
		];

        $strSQL = "SELECT idcategoria, nomcategoria, icono
                    FROM CATEGORIAS";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes);
                
        return $arRetorno;
    }

    function mod002_getCategoriasSheet($idCategoria) {
        $arAttributes =[
            [ "idsubcategoria",		    "idSubCategory",		"int"   ],
			[ "nomsubcategoria",		"nameSubCategory",	            ]
		];

        $strSQL = "SELECT nomsubcategoria, SUBCATEGORIAS.idsubcategoria
                    FROM SUBCATEGORIAS
                    INNER JOIN CATEGORIAS
                    ON SUBCATEGORIAS.idcategoria = CATEGORIAS.idcategoria
                    WHERE CATEGORIAS.idcategoria = $idCategoria";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes);
                
        return $arRetorno;
    }

    function mod002_getCategoriasSheetMenuOld() { // FORMA MIA
        $arAttributes =[
            [ "idcategoria",            "idCategory",           "int"   ],         
            [ "nomcategoria",           "nameCategory"                  ],
            [ "idsubcategoria",         "idSubCategory",        "int"   ],
            [ "nomsubcategoria",        "nameSubCategory",              ]

        ];

        $strSQL = "SELECT CATEGORIAS.idcategoria, nomcategoria, nomsubcategoria, idsubcategoria
                    FROM CATEGORIAS
                    INNER JOIN SUBCATEGORIAS
                    ON CATEGORIAS.idcategoria = SUBCATEGORIAS.idcategoria";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes);
    
        return $arRetorno;

    }

    function mod002_getCategoriasSheetMenu() { //FORMA DEL PROFE
        $arAttributes =[
            [ "idcategoria",                "idCategory",                   "int"   ],         
            [ "nomcategoria",               "nameCategory"                          ],
            [ "idsubcategoria",             "idSubCategory",                "int"   ],
            [ "nomsubcategoria",            "nameSubCategory",                      ],
            [ "idsubcategoriatipo",		    "idSubCategoryType",		    "int"   ],
			[ "nomsubcategoriatipo",		"nameSubCategoryType",	                ]
        ];

        $strSQL = "SELECT CATEGORIAS.idcategoria, nomcategoria, SUBCATEGORIAS.idsubcategoria, nomsubcategoria, SUBCATEGORIATIPOS.idsubcategoriatipo, SUBCATEGORIATIPOS.nomsubcategoriatipo
                    FROM CATEGORIAS
                    INNER JOIN SUBCATEGORIAS
                    ON CATEGORIAS.idcategoria = SUBCATEGORIAS.idcategoria
                    INNER JOIN SUBCATEGORIATIPOS
                    ON SUBCATEGORIAS.idsubcategoria = SUBCATEGORIATIPOS.idsubcategoria";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes);
    //dump($arRetorno);
        return $arRetorno;

    }

    function mod002_getSubCategoriasSheet($idSubCategoria) {
        $arAttributes =[
            [ "idsubcategoriatipo",		    "idSubCategoryType",		"int"   ],
			[ "nomsubcategoriatipo",		"nameSubCategoryType",	            ]
		];

        $strSQL = "SELECT nomsubcategoriatipo, SUBCATEGORIATIPOS.idsubcategoriatipo
                    FROM SUBCATEGORIATIPOS
                    INNER JOIN SUBCATEGORIAS
                    ON SUBCATEGORIATIPOS.idsubcategoria = SUBCATEGORIAS.idsubcategoria
                    WHERE SUBCATEGORIAS.idsubcategoria = $idSubCategoria";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes);
                
        return $arRetorno;
    }

    function mod002_getSubCategoriasProductos($idSubCategoriaProducto) {
        $arAttributes =[
			[ "nomproducto",		"nameSubCategoryProduct",	  ],
            [ "descripcion",		"descriptionProduct",		  ],
			[ "precio",			    "priceProduct",		  	      ],
            [ "nomimagen",			"photoProduct",		  	      ]
		];

        $strSQL = "SELECT nomproducto, PRODUCTOS.descripcion, precio, PRODUCTOS.idsubcategoriatipo, nomimagen
                    FROM PRODUCTOS
                    INNER JOIN SUBCATEGORIATIPOS
                    ON PRODUCTOS.idsubcategoriatipo = SUBCATEGORIATIPOS.idsubcategoriatipo
                    INNER JOIN IMAGENES
                    ON PRODUCTOS.idproducto = IMAGENES.idproducto
                    WHERE SUBCATEGORIATIPOS.idsubcategoriatipo = $idSubCategoriaProducto";

        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes);
                
        return $arRetorno;
    }

    function mod002_validateUser( $email, $password ){
        $arAttributes = [
            [ "idusuario",      "idUser",      "int"            ],
            [ "nomusuario",     "nameUser"                      ]
        ];
    
        $strSQL = "SELECT idusuario, nomusuario
                    FROM USUARIOS
                    WHERE email = '$email'
                    AND contrasena = '$password'";
    
        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );
        
        return $arRetorno;
    }

    function mod002_getProductosMarcasPaginacion ( $idMarca, $initialRow, $amountRowsPerPage ) {
        $arAttributes = [
            [ "nomproducto",		"nameProduct",			 	  ],
			[ "descripcion",		"descriptionProduct",		  ],
			[ "precio",			    "priceProduct",		  	      ],
            [ "nomimagen",			"photoProduct",		  	      ]
        ];
        $strSQL = "SELECT nomproducto, PRODUCTOS.descripcion, precio, nomimagen, PRODUCTOS.idmarca
                    FROM PRODUCTOS 
                    INNER JOIN IMAGENES
                    ON PRODUCTOS.idproducto = IMAGENES.idproducto
                    INNER JOIN MARCAS
                    ON PRODUCTOS.idmarca = MARCAS.idmarca
                    WHERE MARCAS.idmarca = $idMarca
                    LIMIT $initialRow, $amountRowsPerPage";
    
        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );
        //dump($arRetorno);
        return $arRetorno;
    }

    function mod002_getTotalProductosMarcasPaginacion( $idMarca ) {
        $arAttributes = [
            
            [ "totalProductosMarcas",      "totalProductosMarcas",      "int"            ]
        ];
       
        $strSQL = "SELECT COUNT( * ) AS totalProductosMarcas
                    FROM PRODUCTOS 
                    INNER JOIN MARCAS
                    ON PRODUCTOS.idmarca = MARCAS.idmarca
                    WHERE MARCAS.idmarca = $idMarca";
    
        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );
        
        return $arRetorno;
    }

    function mod002_getUsuariosPaginacion( $initialRow, $amountRowsPerPage) {
    
        $arAttributes =[
			[ "idusuario",		"idUser",		"int"       ],
			[ "nomusuario",		"nameUser",			        ],
            [ "apellidos",		"surnameUser",			    ],
			[ "direccion",		"addressUser",		        ],
			[ "email",			"emailUser",		        ],
            [ "telefono",		"telephoneUser"		        ]
		];
       
        $strSQL = "SELECT idusuario, nomusuario, apellidos, direccion, email, telefono
                    FROM USUARIOS
                    LIMIT $initialRow, $amountRowsPerPage";
    
        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );
        
        //dump( $arRetorno );
        
        return $arRetorno;
    }

    function mod002_getTotalUsuariosPaginacion() {
        $arAttributes = [
            [ "totalUsuarios",      "totalUsuarios",      "int"            ]
        ];
       
        $strSQL = "SELECT COUNT( * ) AS totalUsuarios
                    FROM USUARIOS";
    
        $arRetorno = mod002_executeQuery( $strSQL, $arAttributes );
        
        return $arRetorno;
    }
?>
