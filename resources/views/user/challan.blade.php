<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Challan</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
    <style>
        th, td{
            padding-left: 5px;
        }
    </style>
</head>
<body>
    @php 
        $user = Auth::user();
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-4 pt-4">
                <table border="1" style="width: 100%;">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center bg-dark p-2">
                                <img src="https://lh3.googleusercontent.com/proxy/CS9rAS79UNYjTigNOsyJNOKkrdj3j8GqKakHKmfX8CRKdqEa9U14jSSZ1OsMANZcvsApGSICHA2IHdKYrOg8XA" alt="">
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2">
                                <h4>
                                BTrack Vehicle Fee Challan
                                </h4>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Date</th>
                            <td>{{ now() }} </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>
                                {{ $user->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>Route</th>
                            <td>
                                {{ $user->UserVehicle ? $user->UserVehicle->Vehicle->route : 'TBA' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Vehicle</th>
                            <td>
                                {{ $user->UserVehicle ? $user->UserVehicle->Vehicle->registration_no : 'TBA' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>