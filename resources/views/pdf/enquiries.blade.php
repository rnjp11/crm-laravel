<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
    <style>
        table tr td,
        table tr th {
            padding: 5px 7px;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <h1 align="center">Enquiries</h1>
    <table border="1" cellspacing="0" cellpadding="0">
        <thead class="table-light">
            <tr align="left">
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Service</th>
                <th>Reference</th>
                <th>City</th>
                <th>Type</th>
                <th>Follow-up date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($enquiries as $enquiry)
                <tr align="left">
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $enquiry->name }}</td>
                    <td>{{ $enquiry->email }}</td>
                    <td>{{ $enquiry->mobile }}</td>
                    <td>{{ $enquiry->service_name }}</td>
                    <td>{{ $enquiry->reference_name }}</td>
                    <td>{{ $enquiry->city_name }}</td>
                    <td>{{ $enquiry->type }}</td>
                    <td>{{ $enquiry->date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No Data Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
