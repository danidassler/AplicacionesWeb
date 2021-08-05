<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estiloProyecto.css" />
	<title>Inicio</title>
</head>

<body>
<header class="super-cabecera">
    <nav>
        <ul>
			<li><a href="index.php">
            <span class="image"><img src="img/Re(Supreme).png"  height="60" width="200" /></span>
            </a>
			
			<li><a href='vistaNoticias.php'>
            <i class="noticias"></i>
            
            <span class="texto">NOTICIAS</span>
            </a>
            </li>
			
            </li><!--
            --><li><a href="vistaProductos.php?categoria=ropa">
            <i class="ropa"></i>
            
            <span class="texto">ROPA</span>
            </a>
            </li><!--
            --><li><a href="vistaProductos.php?categoria=sneakers">
            <i class="sneakers"></i>
            
            <span class="texto">SNEAKERS</span>
            </a>
            </li><!--
            --><li><a href="vistaProductos.php?categoria=accesorios">
            <i class="accesorios"></i>
            
            <span class="texto">ACCESORIOS</span>
            </a>
            </li><!--
            --><li><a href="vistaProductos.php?categoria=todos">
            <i class="novedades"></i>
           
            <span class="texto">NOVEDADES</span>
            </a>
            </li><!--
			
        --><li><a href="contacto1.php">
            <i class="contacto"></i>
            
            <span class="texto">CONTACTO</span>
            </a>
            </li>

		<?php 
			if(!isset($_SESSION["login"]) || $_SESSION["login"] == false){
				?>
				
				<li><a href='registro.php'>
            <i class="registrarse"></i>
            
            <span class="texto">REGISTRARSE</span>
            </a>
            </li><!--
        --><li><a href='login.php'>
            <i class="login"></i>
            
            <span class="texto">LOGIN</span>
            </a>
            </li><!--
        -->
			
				<?php
			}
			else if ($_SESSION["login"]== true){
				$nombre_user = $_SESSION["usuario"];
                if($_SESSION["esAdmin"]== false){
				?>
    				<li><a href='perfilUsuario.php'>
                <i class="saludo"></i>
               
                <span class="texto">Perfil de <?php echo $nombre_user ?></span>
                </a>
                </li>
            <?php
                }else{
            ?>  <li><a href='perfilAdmin.php'>
                <i class="saludo"></i>
               
                <span class="texto">ADMINISTRAR</span>
                </a>
                </li>
            
            <?php      
                }   

            ?>

            <li><a href='logout.php'>
            <i class="logout"></i>
            
            <span class="texto">LOGOUT</span>
            </a>
            </li><!--
        -->
				
				<?php
			}
		?>
		<li><a href='buscador.php'>
            
            <span class="texto"><img src= "img/buscador2.png" alt="Carrito" height="50" width="50" class="carrito1"/><img src="img/buscador2n.png" alt="Carrito" height="50" width="50" class="carrito2"/></span>

            </a>
			</li>
		<li><a href='carrito.php'>
            
            <span class="texto"><img src= "img/carritoC.png" alt="Carrito" height="50" width="50" class="carrito1"/><img src="img/carritoC1.png" alt="Carrito" height="50" width="50" class="carrito2"/></span>
			<span class="texto">
			<?php 
			if (!isset($_SESSION["ocarrito"])){
				echo "0";
			}
			else{
				echo $_SESSION["ocarrito"]->numElems();
			}
			?>
			</span>
            </a>
           </li><!--
        -->
		
		</ul>
    </nav>
</header>


</body>
</html>