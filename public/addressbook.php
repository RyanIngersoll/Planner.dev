<?php
define('CSVFILE', 'ADDRESSBOOK.csv');
var_dump($_FILES);
 
require_once('inc/address_data_store.php');

$ads = new AddressDataStore(CSVFILE); 

$addressbook = $ads->read_address_book();

 if (
    !empty($_POST['name']) &&
    !empty($_POST['street_address']) &&
    !empty($_POST['city']) &&
    !empty($_POST['state']) &&
    !empty($_POST['zip'])
) {
    $addressbook[] = $_POST;
    $ads->write_csv($addressbook);
}

if(isset($_POST['remove_item'])){
    $removeKey = $_POST['remove_item'];
    unset($addressbook[$removeKey]);
    $addressbook = array_values($addressbook);//resets keys
    $ads->write_csv($addressbook);
}

    if (count($_FILES) > 0 && $_FILES['file1']['error'] == UPLOAD_ERR_OK && $_FILES['file1']['type']== 'text/csv') {
        // Set the destination directory for uploads
        $upload_dir = '/vagrant/sites/planner.dev/public/uploads/';
        // Grab the filename from the uploaded file by using basename
        $filename = basename($_FILES['file1']['name']);
        // Create the saved filename using the file's original name and our upload directory
        $saved_filename = $upload_dir . $filename;
        // Move the file from the temp location to our uploads directory
        move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
    
        $newCsv = new AddressDataStore(CSVFILE);
        $newCsv->filename = $saved_filename;
        $newitems = $newCsv->read_address_book();
        $addressbook = array_merge($addressbook, $newitems);
        $ads->write_csv($addressbook);
     
    }
    
    unset($newCsv);


?>
<html>
    <head>

        <title>"CSV ADDRESS BOOK"</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    </head>


        <body>
            <h5>$_POST</h5>
            <?php var_dump($_POST); ?>

            <h5>$_GET</h5>
            <?php var_dump($_GET); ?>

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

              <?var_dump($addressbook)?>
              
                <?foreach($addressbook as $entry =>$row): ?>
                    <tr><td><button class="remove-button" data-item-id="<?= $entry; ?>">Remove</button>
                            </td> 
                    
                        <? foreach($row as $column): ?>
                            
                            <td><?= $column ?></td>
                             
                            <? endforeach; ?>
                    </tr>
                    <? endforeach; ?>
                
              </table>
            </div>

            <h3>"ADD NEW ADDRESS FORM"</h3>

         <div class="col-xs-6 col-md-4">
            <form method="POST" action="addressbook.php" class= "form-horizontal">
                <label for="name">Name: </label><input type="text" name="name" id="name"placeholder="name" class= "form-control"> <br>
                <label for="street_address">Street Address: </label><input type="text" name="street_address" id="street_address"placeholder="street address" class= "form-control"><br>
                <label for="city">City: </label><input type="text" name="city" id="city"placeholder="city" class= "form-control"> <br>
                <label for="state">State: </label><input type="text" name="state" id="state"placeholder="state" class= "form-control"> <br>
                <label for="zip">Zip Code: </label><input type="text" name="zip" id="zip"placeholder="zip" class= "form-control"> <br>

                <input type="submit" value="submit!!">
            </form> 
        </div>
            <script>
            // Get all the remove buttons
            var removeButtons = document.getElementsByClassName("remove-button");

            // Loop over all the buttons
            for (var i=0; i < removeButtons.length; i++) {
                // Attach a click event listener to each button
                removeButtons[i].addEventListener("click", function() {
                    // Get the ID of the item we clicked remove for
                    var itemId = this.attributes['data-item-id'].value;

                    // Put that ID into our hidden form field
                    document.getElementById("remove-item").value = itemId;
                    
                    // Submit the form
                    document.getElementById("remove-form").submit();
                });
            }
        </script>
        <div class="col-xs-6 col-md-4">
            <h1>Upload CSV File</h1>
            <?php 
            ?>

        <form action="/addressbook.php" method="POST" enctype="multipart/form-data"> <!-- this submits a multi-dimensional array vs normal key=>value array -->
            <p>
                <label for="file1">File to upload: </label>
                <input type="file" id="file1" name="file1">
            </p>
            <p>
                <input type="submit" value="Upload">
            </p>

        </form>
    </div>
        <hr>
        <br>

        <form action="addressbook.php" method="post" id="remove-form">
            <input type="hidden" name="remove_item" id="remove-item" />
        </form>
        
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        </body>

</html>


