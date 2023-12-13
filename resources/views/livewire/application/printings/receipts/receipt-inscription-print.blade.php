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
    <div><span style="font-weight: bold">N°: {{$inscription->number_paiment}}</span></div>
    <div><span style="font-weight: bold">Nom: {{ $inscription->student->name}}</span></div>
    <div><span style="font-weight: bold">Classe: {{ $inscription->classe->name.'/'.$inscription->classe->classeOption->name}}</span></div>
    <div><span style="font-weight: bold">Motif:Paiement frais {{$inscription->cost->name}}</span></div>
    <div><span style="font-weight: bold">Date: Le {{$inscription->created_at->format('d-m-Y')}}</span></div>
    <div>----------------------------------------</div>
    <table style="">
        <thead style="">
        <tr>
            <th style="text-align: left">DESIGNATION</th>
            <th style="text-align: right">MONTANT {{$currency}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                -{{ $inscription->cost->name }}
            </td>
            <td style="text-align: right">
                {{ number_format($inscription->cost->amount,1,',',' ') }}
            </td>
        </tr>
        </tbody>
    </table>
    <div style="text-align: right;margin-top: 12px ;width: 65%">
        <strong style="margin-left: 180px;font-weight: bold"> <span>Net à payer: {{ number_format($inscription->cost->amount,1,',',' ')}} {{$currency}}</span></strong>
    </div>
    <br>
    <div style="text-align: center;width: 65%"><span style=";font-weight: bold">**** Education ! ****</span></div><br><br><br><br><br><br>
    <br>
    <br>
</div>
</body>
</html>
