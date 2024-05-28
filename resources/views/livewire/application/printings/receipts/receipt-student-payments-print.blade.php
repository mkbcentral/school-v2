<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Impression recu</title>
    <style>
        .center {
            text-align: center;
        }

        table,
        td,
        th {
            border: 1px solid black;
            font-size: 22px;
            font-weight: bold
        }

        table {
            width: 65%;
            border-collapse: collapse;
        }
    </style>
</head>

<body
    style=" margin: 0 auto;
                color: #001028;
                background: #FFFFFF;
                font-family: Consolas, monaco, monospace;
                font-size: 23px;">
    <div>
        <div style="font-weight: bold"><Span>COMPLEXE SCOLAIRE AQUILA</Span></div>
        <div><span style="font-weight: bold">Golf Plateau </span></div>
        <div><span style="font-weight: bold">Q.MUKUNTO C/ANNEXE</span></div>
        <div>---------------------------------</div>
        <div><span style="font-weight: bold">Nom: </span>{{ $inscription->student->name }}</div>
        <div>
            <span style="font-weight: bold">Classe:</span>
            {{ $inscription->classe->name . '/' . $inscription->classe->classeOption->name }}
        </div>
        <div>---------------------------------</div>
        <div>----------INFOS PAYMENTS---------</div>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th style="margin-left: 0px">Date</th>

                    <th style="margin-left: 25px;text-align: right">Frais</th>
                    <th style="margin-left: 25px;text-align: right">Mois</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inscription->payments as $index => $payment)
                    <tr>
                        <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                        <td>{{ $payment->cost->name }}</td>
                        <td>{{ app_get_month_name($payment->month_name) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
