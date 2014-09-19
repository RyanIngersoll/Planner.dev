<?php
define('CSVFILE', 'fakeAdBook.csv');
//var_dump($_FILES);
 
require('StoreFakeAds.php');
require('AdNavBar.html');
// require('bootstrap-lightbox.css');
// require('bootstrap-lightbox.js');

$ads = new AddressDataStore(CSVFILE); 

$adBook = $ads->readCsvFile();


 if (
    !empty($_POST['image']) &&
    !empty($_POST['image file']) &&
    !empty($_POST['title']) &&
    !empty($_POST['item']) &&
    !empty($_POST['price']) &&
    !empty($_POST['city']) &&
    !empty($_POST['email'])
) {
    $adBook[] = $_POST;
    $ads->writeToFile($adBook);
}

if(isset($_POST['remove_item'])){
    $removeKey = $_POST['remove_item'];
    unset($adBook[$removeKey]);
    $adBook = array_values($adBook);//resets keys
    $ads->writeToFile($adBook);
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
        $newitems = $newCsv->readCsvFile();
        $adBook = array_merge($adBook, $newitems);
        $ads->writeToFile($adBook);
     
    }
    
    unset($newCsv);
?>
<html>
    <head>

        <title>"Fake Craigslist"</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    </head>
        <body>
        <h3>Most Recent Ads Posted</h3>

            <div class="table-responsive">
              <table class="table">
               <tr>
                <th>Delete</th>
                <th>Image</th>
                <th>Image File</th>
                <th>Title</th>
                <th>Item</th> 
                <th>Price</th>
                <th>City</th> 
                <th>Email</th>

              </tr>
              
                <?foreach($adBook as $entry =>$row): ?>
                    <tr>
                        <td><button class="remove-button" data-item-id="<?= $entry; ?>">Remove</button>

                        <td><button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                              Product Image
                            </button>

                                
                                </td> 
                            </td> 
                    
                        <? foreach($row as $column): ?>
                            
                            <td><?= $column ?></td>
                             
                            <? endforeach; ?>
                    </tr>
                    <? endforeach; ?>
                    <!-- modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Product Image</h4>
                          </div>
                          <div class="modal-body">
                            <iframe width="560" height="315" src="<?= $row[0] ?>" frameborder="0" allowfullscreen></iframe>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                
              </table>
            </div>
<div class="jumbotron">
<h3>Local Time</h3>
    <form name="Tick">
<input type="text" size="20" color = "black" name="Clock">
</form>
<script>
<!--
/*By George Chiang (JK's JavaScript tutorial)
http://javascriptkit.com
Credit must stay intact for use*/
function show(){
var Digital=new Date()
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
var dn="AM" 
if (hours>12){
dn="PM"
hours=hours-12
}
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
document.Tick.Clock.value=hours+":"+minutes+":"
+seconds+" "+dn
setTimeout("show()",1000)
}
show()

//-->
</script>

            <h2>New Fake Craigslist Ad Form</h2>

         <div class="col-xs-6 col-md-4">
            <form method="POST" action="FakeCraigsListMainPage.php" class= "form-horizontal">
                <label for="image">Image: </label><input type="file" name="image" id="image"placeholder="add image here" class= "form-control"> <br> 
                <label for="title">Title: </label><input type="text" name="title" id="title"placeholder="Give your add a cool title." class= "form-control"> <br>
                <label for="item">Item for Sale: </label><input type="text" name="item" id="item"placeholder="What are you selling?" class= "form-control"><br>
                <label for="price">$ Price: </label><input type="text" name="price" id="price"placeholder="What is the price in U.S. Dollars? ex. $999.99" class= "form-control"> <br>
                <label for="city">City: </label><input type="text" name="city" id="city"placeholder="In what city is the item located?" class= "form-control"> <br>
                <label for="email">Contact Email: </label><input type="text" name="email" id="email"placeholder="What is your contact email address?" class= "form-control"> <br>

                <input type="submit" value="Submit Ad and You are Golden!!">
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
            <h3>Upload Your Image File Here</h3>
            <?php 
            ?>

        <form action="/FakeCraigsListMainPage.php" method="POST" enctype="multipart/form-data"> <!-- this submits a multi-dimensional array vs normal key=>value array -->
            <p>
                <label for="file1">File to upload: </label>
                <input type="file" id="file1" name="file1">
            </p>
            <p>
                <input type="submit" value="Upload">
            </p>

        </form>
    </div>
    </div>
        <hr>
        <br>

        <form action="FakeCraigsListMainPage.php" method="post" id="remove-form">
            <input type="hidden" name="remove_item" id="remove-item" />
        </form>
        
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        </body>

</html>


