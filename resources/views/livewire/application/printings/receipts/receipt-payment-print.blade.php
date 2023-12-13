<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Impression recu</title>
    <style>
        .center {
            text-align: center;
        }
        table, td, th {
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
<body style=" margin: 0 auto;
                color: #001028;
                background: #FFFFFF;
                font-family: Consolas, monaco, monospace;
                font-size: 23px;">
<div>
    <div style="font-weight: bold"><Span>COMPLEXE SCOLAIRE AQUILA</Span></div>
    <div><span style="font-weight: bold">Golf Plateau </span></div>
    <div><span style="font-weight: bold">Q.MUKUNTO C/ANNEXE</span></div>
    <br>
    <div>----------------------------------------</div>
    <div><span style="font-weight: bold">N°: {{$payment->number_paiement}}</span></div>
    <div><span style="font-weight: bold">Nom: {{ $payment->student->name}}</span></div>
    <div><span style="font-weight: bold">Classe: {{ $payment->classe->name.'/'.$payment->classe->classeOption->name}}</span></div>
    <div><span style="font-weight: bold">Motif:Paiement frais {{$payment->cost->name}}</span></div>
    <div><span style="font-weight: bold">Mois: {{app_get_month_name($payment->month_name)}}</span></div>
    <div><span style="font-weight: bold">Date: Le {{$payment->created_at->format('d-m-Y')}}</span></div>
    <div>----------------------------------------</div>
    <table class="table table-light">
        <thead class="thead-light">
        <tr>
            <th style="margin-left: 0px">DESIGNATION</th>

            <th style="margin-left: 25px;text-align: right">MONTANT {$currency}</th>
        </tr>
        </thead>
        <tbody>
        <td style="margin-left: 12px;font-weight: bold">
            -{{ $payment->cost->name }}
        </td>

        <td style="margin-left: 12px;font-weight: bold;text-align: right">
            {{ number_format($payment->cost->amount,1,',',' ') }}
        </td>
        </tbody>
    </table>
    <div><span>****************************************</span></div>
    <div >
        <strong style="margin-left: 180px;font-weight: bold;text-align: right"> <span>Net à payer: {{ number_format($payment->cost->amount,1,',',' ')}} {{$currency}}</span></strong>
    </div>
    <br>
    <div ><span style=";font-weight: bold">*********** Education ! **********</span></div><br><br><br><br><br><br>
</div>
</body>
</html>
