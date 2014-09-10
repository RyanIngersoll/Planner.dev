<?php
define('CSVFILE', 'addressbook.csv');

$addressbook = [];



function writeToFile($addressbook, $filename = CSVFILE){
        $handle = fopen($filename, 'w');
            foreach ($addressbook as $fields) {
                fputcsv($handle, $fields);
            }
        fclose($handle);
    }

function saveToFile ($addressbook, $filename = CSVFILE){
    $newaddressbook = [];
    $handle = fopen(CSVFILE, 'r');

    while (!feof($handle)) {
        $row = fgetcsv($handle);
    
        if (!empty($row)){
            $newaddressbook[] = $row;
        }
    }
    fclose($handle);
}

    
    //writeToFile($addressbook);


    // if (!empty($_POST['name']) && !empty($_POST['street address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) {

        $addressbook[] = $_POST;
        writeToFile($addressbook);
        saveToFile($addressbook);

        if(isset($_GET['remove'])){
        $removeKey = $_GET['remove'];
        unset($addressbook[$removeKey]);
        $addressbook = array_values($addressbook);
        saveTOFile($addressbook);
    }

    


?>

<html>
    <head>
    <!-- <link rel="stylesheet" href="css_todo_list.css"> -->
        <title>"CSV ADDRESS BOOK"</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    </head>


        <body>
            <h5>$_POST</h5>
            <?php var_dump($_POST); ?>

            <h1>"CSV ADDRESS BOOK"</h1>

            <div class="table-responsive">
              <table class="table">
               <tr>
                <th>Delete</th>
                <th>Name</th>
                <th>Street Address</th> 
                <th>City</th>
                <th>State</th> 
                <th>Zip Code</th>

              </tr>

                <?foreach($addressbook as $entry =>$row): ?>
                    <tr><td><a href="?remove=<?=$entry ?>">DELETE </a></td> 
                    
                        <? foreach($row as $column): ?>
                            
                            <td><?= $column ?></td>
                             
                            <? endforeach; ?>
                    </tr>
                    <? endforeach; ?>
              </table>
            </div>

            <h3>"ADD NEW ADDRESS FORM"</h3>


            <form method="POST" action="addressbook.php">
                <label for="name">Name: </label><input type="text" name="name" id="name"placeholder="name"> <br>
                <label for="street address">Street Address: </label><input type="text" name="street address" id="street address"placeholder="street address"> <br>
                <label for="city">City: </label><input type="text" name="city" id="city"placeholder="city"> <br>
                <label for="state">State: </label><input type="text" name="state" id="state"placeholder="state"> <br>
                <label for="zip">Zip Code: </label><input type="text" name="zip" id="zip"placeholder="zip"> <br>

                <input type="submit" value="submit!!">
            </form> 

            

            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        </body>

</html>


