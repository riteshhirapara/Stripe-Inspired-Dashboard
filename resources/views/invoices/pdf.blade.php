<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice['number'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Invoice #{{ $invoice['number'] }}</h1>
        <p>Status: {{ $invoice['status'] }}</p>
    </div>
    <div class="content">
        <table>
            <tr>
                <th>Amount</th>
                <td>{{ $invoice['amount'] }}</td>
            </tr>
            <tr>
                <th>Currency</th>
                <td>{{ $invoice['currency'] }}</td>
            </tr>
            <tr>
                <th>Customer Email</th>
                <td>{{ $invoice['email'] }}</td>
            </tr>
            <tr>
                <th>Created Date</th>
                <td>{{ $invoice['date'] }}</td>
            </tr>
        </table>
    </div>
</body>

</html>