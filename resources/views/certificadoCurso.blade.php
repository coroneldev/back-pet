<!DOCTYPE html>
<html>
<head>
    <title>Certificado</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        .centreado {
            text-align: center;
        }

        .derecha {
            text-align: right;
        }

        .negrilla {
            font-weight: bold;
        }

        .font-14 {
            font-size: 14px;
        }

        .font-18 {
            font-size: 18px;
        }

        .font-24 {
            font-size: 24px;
        }

        .font-32 {
            font-size: 32px;
        }

        .font-44 {
            font-size: 44px;
        }

        .table-border {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .mt-0 {
            margin-top: 0px;
        }

        .mb-0 {
            margin-bottom: 0px;
        }

    </style>
</head>
<body>

    <div style="width: 960px; border: 2px solid #042880; margin: auto;"></div>
    <div style="width: 960px; border: 1px solid #1547c1; margin: auto; margin-top:3px;"></div>

    <p class="centreado negrilla font-24 mb-0" style="color: #042880;">ARTE & TECNOLOGÍAS</p>
    <p class="centreado"><img src="{{public_path('logo-artec.jpg')}}" alt="Image" width="100" height="100"/></p>

    <p class="centreado negrilla font-44 mb-0">CERTIFICADO</p>
    <p class="centreado font-18">Otorgado a:</p>

    <p class="centreado font-24 mb-0">{{ $estudiante->nombres }} {{ $estudiante->apellido_paterno }} {{ $estudiante->apellido_materno }}</p>
    <div style="width: 600px; border: 1px solid #e18d44; margin: auto;"></div>

    <p class="centreado font-18">Por haber finalizado y aprobado satisfactoriamente el curso:</p>
    <p class="centreado negrilla font-24">"{{ $curso->nombre }}"</p>
    <p class="centreado font-18">Desarrollado en fechas desde {{ $curso->fecha_inicio }} hasta {{ $curso->fecha_fin }}.</p>

    <table style="margin-left: auto; margin-right: auto;">
        <tbody>
            <tr>
                <td class="centreado" style="width: 150px">
                    <p class="centreado"><img src="{{public_path('qr-artec.jpg')}}" alt="Image" width="100" height="100"/></p>
                </td>
                <td class="centreado" style="width: 150px">
                    <p class="centreado"><img src="{{public_path('firma-artec.jpg')}}" alt="Image" width="120" height="80"/></p>
                    <p class="centreado mt-0 mb-0">-------------------------------------------</p> 
                    <p class="centreado font-14 mt-0">CEO de ARTEC</p>
                </td>
            </tr>
        </tbody>
    </table>

    <div style="width: 960px; border: 1px solid #1547c1; margin: auto; margin-top:35px; margin-bottom:3px;"></div>
    <div style="width: 960px; border: 2px solid #042880; margin: auto;"></div>

</body>
</html>
