<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Carnet de Vacunación</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 0; padding: 0; }
        .carnet { width: 350px; border: 2px solid #4CAF50; border-radius: 10px; padding: 15px; margin: auto; background-color: #f9f9f9; }
        .header { text-align: center; margin-bottom: 15px; font-weight: bold; font-size: 16px; color: #333; }
        table.datos-mascota { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        table.datos-mascota td { vertical-align: top; padding-right: 10px; }
        .foto { width: 120px; height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid #ccc; }
        table.vacunas { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 11px; }
        th, td { border: 1px solid #ddd; padding: 5px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        tbody tr:nth-child(even) { background-color: #f2f2f2; }
        .footer { text-align: center; margin-top: 10px; font-size: 10px; color: #555; }
    </style>
</head>
<body>

<div class="carnet">
    <div class="header">Carnet de Vacunación</div>

    <!-- Datos y foto de la mascota -->
    <table class="datos-mascota">
        <tr>
            <!-- Columna izquierda: Datos -->
            <td>
                <p><strong>Nombre:</strong> {{ $mascota->nombre }}</p>
                <p><strong>Código:</strong> {{ $mascota->codigo }}</p>
                <p><strong>Especie:</strong> {{ $mascota->especie }}</p>
                <p><strong>Raza:</strong> {{ $mascota->raza ?? '---' }}</p>
                <p><strong>Edad:</strong> {{ $mascota->edad ?? '---' }}</p>
                <p><strong>Peso:</strong> {{ $mascota->peso ?? '---' }}</p>
                <p><strong>Sexo:</strong> {{ $mascota->sexo ?? '---' }}</p>
                <p><strong>Detalles:</strong> {{ $mascota->detalles ?? '---' }}</p>
            </td>

            <!-- Columna derecha: Foto -->
            <td style="width: 130px;">
                @if($mascota->foto)
                    <img src="{{ public_path('storage/' . $mascota->foto) }}" alt="Foto Mascota" class="foto">
                @else
                    <div style="width: 120px; height: 120px; display:flex; align-items:center; justify-content:center; background-color:#ddd; border-radius: 8px;">No Foto</div>
                @endif
            </td>
        </tr>
    </table>

    <!-- Vacunas -->
    <h3 style="text-align:center; margin-bottom:5px;">Vacunas</h3>
    <table class="vacunas">
        <thead>
            <tr>
                <th>Vacuna</th>
                <th>Fecha</th>
                <th>Próx. Aplicación</th>
                <th>Responsable</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vacunas as $control)
            <tr>
                <td>{{ $control->vacuna->nombre ?? '---' }}</td>
                <td>{{ $control->fecha_aplicacion }}</td>
                <td>{{ $control->proxima_aplicacion ?? '---' }}</td>
                <td>{{ $control->usuario->nombres ?? '---' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generado por comvet - {{ now()->format('d/m/Y') }}
    </div>
</div>

</body>
</html>
