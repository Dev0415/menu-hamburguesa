<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Menu de Hamburguesas</title>
    

</head>
<body>

    <h3 class = "primero"  >Menu de Hamburguesas</h3>
    <br>
    <form action="" method="post">
        <label for="hamburguesa">Selecciona una hamburguesa:</label>
        <select name="hamburguesa" id="hamburguesa">
            <option value="Big Bacon">Big Bacon - $8.55</option>
            <option value="Big Bacon Double">Big Bacon Double - $9.90</option>
            <option value="Bacon Parmesan">Bacon Parmesan - $8.80</option>
        </select><br><br>
        
        <label>Complementos:</label><br>
        <input type="checkbox" name="complementos[]" value="Agrandado papa y bebida"> Agrandado de papa y bebida  $2<br>
        <input type="checkbox" name="complementos[]" value="Queso adicional"> Queso adicional  $1.50<br><br>
        
        <label for="medio_pedido">Selecciona el medio de pedido:</label>
        <select name="medio_pedido" id="medio_pedido">
            <option value="Pedidos Ya">Pedidos Ya</option>
            <option value="App Wendys">App Wendys</option>
            <option value="Sucursal">Sucursal</option>
        </select><br><br>

        <label for="cantidad">Cantidad de hamburguesas:</label>
        <input type="number" name="cantidad" id="cantidad" min="1" value="1"><br><br>

        <label for="clasificacion">Clasificación del cliente:</label>
        <select name="clasificacion" id="clasificacion">
            <option value="Normal">Normal</option>
            <option value="Frecuente">Frecuente</option>
            <option value="Fiel">Fiel</option>
            <option value="Empresarial">Empresarial</option>
        </select><br><br>

        <input type="submit" name="calcular" value="Pagar">
    </form>

    <?php
    if(isset($_POST['calcular'])){
        $precio_base = 0;

        // Obtener el precio base de la hamburguesa seleccionada
        if(isset($_POST['hamburguesa'])){
            switch($_POST['hamburguesa']){
                case "Big Bacon":
                    $precio_base = 8.55;
                    break;
                case "Big Bacon Double":
                    $precio_base = 9.90;
                    break;
                case "Bacon Parmesan":
                    $precio_base = 8.80;
                    break;
            }
        }

        // Agregar el precio de los complementos seleccionados
        $precio_complementos = 0;
        if(isset($_POST['complementos'])){
            foreach($_POST['complementos'] as $complemento){
                if($complemento == "Agrandado papa y bebida"){
                    $precio_complementos += 2;
                } elseif($complemento == "Queso adicional"){
                    $precio_complementos += 1.50;
                }
            }
        }

        // Aplicar descuento según el medio de pedido
        $descuento_medio = 0;
        if(isset($_POST['medio_pedido'])){
            switch($_POST['medio_pedido']){
                case "Pedidos Ya":
                    $descuento_medio = 0.05;
                    break;
                case "App Wendys":
                    $descuento_medio = 0.07;
                    break;
                case "Sucursal":
                    $descuento_medio = 0.03;
                    break;
            }
        }

        // Aplicar descuento por cantidad de hamburguesas
        $descuento_cantidad = 0;
        if(isset($_POST['cantidad'])){
            $cantidad = intval($_POST['cantidad']);
            if($cantidad == 2){
                $descuento_cantidad = 0.05;
            } elseif($cantidad == 3){
                $descuento_cantidad = 0.07;
            } elseif($cantidad > 3){
                $descuento_cantidad = 0.9;
            }
        }

        // Aplicar descuento según la clasificación del cliente
        $descuento_clasificacion = 0;
        if(isset($_POST['clasificacion'])){
            switch($_POST['clasificacion']){
                case "Frecuente":
                    $descuento_clasificacion = 0.05;
                    break;
                case "Fiel":
                    $descuento_clasificacion = 0.07;
                    break;
                case "Empresarial":
                    $descuento_clasificacion = 0.09;
                    break;
            }
        }

        // Calcular el precio total
        $precio_total = $precio_base + $precio_complementos;
        $descuento_total = $precio_total * ($descuento_medio + $descuento_cantidad + $descuento_clasificacion);
        $precio_final = $precio_total - $descuento_total;

        // Mostrar el precio total
        echo "<br><h3>Precio Total: $" . number_format($precio_final, 2) . "</h3>";
    }
    ?>
    
</body>
</html>