<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>



    <div class="box">
        <h1 align="center">
            <span class="blue"></span>&ltImport JSON&gt<span class="blue"></span> <span class="yellow">data into database
                </pan>
        </h1>


        <?php

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: script.google.com",
                //"x-rapidapi-key: YOUR-RAPID-API-KEY"
            ],
        ]);
        $response = curl_exec($curl);
        // $err = curl_error($curl);
        // curl_close($curl);
        // if ($err) {
        //     echo "cURL Error #:" . $err;
        // } else {
        //     echo $response;
        // }

        // Server Name => localhost
        // UserName => root
        // Password => empty
        // Database Name => test
        // Passing these 4 parameters
        $connect = mysqli_connect("localhost", "kunal", "kunal", "test");

        $query0 = '';
        $query1 = '';
        $table_data = '';

        // json file Name
        //$fileName = "college_Mobiles.json";

        // Read the JSON file in PHP
        $data = ($response);
        //print_r($data);
        // Convert the JSON String into PHP Array
        $array = json_decode($data, true);
        //print_r($array);
        // Extracting row by row
        foreach ($array as $row) {

            // Database query to insert data 
            // into database Make Multiple 
            // Insert Query 
            $query0 .=
                "INSERT INTO student VALUES 
                ('" . $row["Name"] . "', '" . $row["Age"] . "', '" . $row["Mobile"] . "',
               '" . $row["Blood"] . "');";

            $table_data .= '
                <tr>
                    <td>' . $row["Name"] . '</td>
                    <td>' . $row["Age"] . '</td>
                    <td>' . $row["Mobile"] . '</td>
                    <td>' . $row["Blood"] . '</td>
                </tr>
               '; // Data for display on Web page
        }

        $query1 .=
            "TRUNCATE TABLE student";

        mysqli_multi_query($connect, $query1);

        if (mysqli_multi_query($connect, $query0)) {
            echo '<h2>Inserted JSON Data</h2>';
            echo '
                <table class="container table table-bordered" >
                <thead>
                <tr>
                    <th width="45%"><h1>Name</h1></th>
                    <th width="10%"><h1>Age</h1></th>
                    <th width="45%"><h1>Mobile</h1></th>
                    <th width="45%"><h1>Blood</h1></th>
                </tr></thead>
               ';

            echo $table_data;
            echo '</table>';
        }

        ?>

        <a type="button" role="alert" class="btn btn-primary btn-sm" onclick="window.location.reload();"
            id="liveToastBtn">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Reload</a>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->

</body>

</html>