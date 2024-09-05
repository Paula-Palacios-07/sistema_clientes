<?php include('partials/header.php'); ?>
<?php include('partials/navbar.php'); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Alerta de error -->
            <?php if (isset($error_message)): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?php echo $error_message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <h2 class="mb-4 text-center">Lista de Clientes</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Dirección</th>
                        <th>Latitud</th>
                        <th>Longitud</th>
                        <th>Distancia (km)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($clientes)) {
                        foreach ($clientes as $cliente) {
                            echo "<tr>";
                            echo "<td>{$cliente['cedula']}</td>";
                            echo "<td>{$cliente['nombres']}</td>";
                            echo "<td>{$cliente['apellidos']}</td>";
                            echo "<td>{$cliente['direccion']}</td>";
                            echo "<td>{$cliente['latitud']}</td>";
                            echo "<td>{$cliente['longitud']}</td>";
                            if (isset($cliente['distance'])) {
                                echo "<td>{$cliente['distance']}</td>";
                            } else {
                                echo "<td>-</td>";
                            }
                            echo "<td>";
                            echo "<a href='index.php?action=edit&id={$cliente['id']}' class='btn btn-warning btn-sm'><i class='fas fa-pencil-alt'></i></a> ";
                            echo "<a href='index.php?action=delete&id={$cliente['id']}' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
            <br><br><h3 class="mb-4 text-center">Ordenar Clientes por Distancia</h3>
            <h4 class="mb-4 text-center">Menor a Mayor Distancia</h4>
            <!-- Mapa -->
            <div id="map" style="height: 400px; width: 100%;" class="mb-4"></div>
            <!-- Formulario -->
            <form action="index.php?action=list_by_distance" method="POST" class="text-center">
                <input type="hidden" id="latitud" name="latitud">
                <input type="hidden" id="longitud" name="longitud">
                <button type="submit" class="btn btn-primary">Consultar por Distancia</button>
            </form>
        </div>
    </div>
</div>


<?php include('partials/footer.php'); ?>


<!-- Incluir la biblioteca de Leaflet para el mapa -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    var map = L.map('map').setView([4.596922368201758, -74.07242337470963], 13); //Ubicación inicial

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    var marker = L.marker([4.596922368201758, -74.07242337470963], {draggable: true}).addTo(map);

    marker.on('dragend', function(e) {
        var latlng = marker.getLatLng();
        document.getElementById('latitud').value = latlng.lat;
        document.getElementById('longitud').value = latlng.lng;
    });

    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        document.getElementById('latitud').value = e.latlng.lat;
        document.getElementById('longitud').value = e.latlng.lng;
    });
</script>
