<?php 
require_once 'inc/filestore.php';

	define('TXTFILE', '../data/todo.txt'); // .. instructs path to look for todo.txt in the data file which is one level above the public folder.
	$todo = new Filestore(TXTFILE);
	//$todo_list = [];
	$items = $todo->read_lines();
	// function openFileMenu($fileToOpen){
	// 	$contents_array = [];
	// 	if (filesize($fileToOpen) > 0) {
	// 	    $handle = fopen($fileToOpen, "r");
	// 	    $contents = trim(fread($handle, filesize($fileToOpen)));
	// 	    $contents_array = explode("\n", $contents); 
	// 	    fclose($handle);
	// 	}
	// 	return $contents_array;		    
	// }

	// function saveTOFile($items, $filename = TXTFILE){
	// 	$handle = fopen($filename, 'w');
	// 		foreach ($items as $item) {
	// 			fwrite($handle, $item . PHP_EOL);
	// 		}
	// 	fclose($handle);
	// }

	//$items = openFileMenu(TXTFILE);

    if (isset($_POST['itemtoadd'])) {
		array_push($items, $_POST['itemtoadd']);
	    $todo->write_lines($items);
	}
	
	if(isset($_POST['remove_item'])){//uses buttons to delete rows of data
		$removeKey = $_POST['remove_item'];
		unset($items[$removeKey]);
		$items = array_values($items);
		$todo->write_lines($items);
	}


//uses href to delete rows of data
	if (isset($_GET['remove'])){ // ?remove in the echo statement below sets $key to be the item removed...the ? is the query request
		$removeKey = $_GET['remove'];
		unset($items[$removeKey]);
		$todo->write_lines($items);
	}

	if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0 && $_FILES['file1']['type'] == 'text/plain') {
        // Set the destination directory for uploads
        $upload_dir = '/vagrant/sites/planner.dev/public/uploads/';
        // Grab the filename from the uploaded file by using basename
        $filename = basename($_FILES['file1']['name']);
        // Create the saved filename using the file's original name and our upload directory
        $saved_filename = $upload_dir . $filename;
        // Move the file from the temp location to our uploads directory
        move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
        //$newitems = openFileMenu($saved_filename);
        //addUploadfiles($items,$saved_filename);
        $todo->write_lines($items);
    }
    else{
    	$errorMessage = "there was a problem";
    }
    if (isset($saved_filename)) {
	        // If we did, show a link to the uploaded file
	        echo "<p>You can download your file <a href='/uploads/{$filename}'>here</a>.</p>";

	        $newitems = new Filestore($saved_filename);
	        $newList = $newitems->read_lines();

			$items = array_merge($items, $newList);
			$todo->write_lines($items);
	    	echo "<h3> we have updated the todo list from the textfile you uploaded </h3>";
	    	}

?>
<!DOCTYPE html>

<html>
<head>
	<!-- <link rel="stylesheet" href="css_todo_list.css"> -->
	<title>"TODOLIST"</title>
</head>
	<body>
		<h5>$_GET</h5>
		<?php var_dump($_GET); ?>

		<h5>$_POST</h5>
		<?php var_dump($_POST); ?>

		<h1>"to do list"</h1>
		
		<h1> this is the text file todo list  + adding items from POST line</h1>


		<ol>
			<?foreach($items as $key => $chores): ?>
				<li><button class="remove-button" data-item-id="<?= $key; ?>">Remove</button><?= ": " . $chores ?></li>
			<? endforeach; ?>
		
				
		<?php

			// foreach ($items as $key => $chores) {
			// 	//echo "<button id="remove item">Remove Item</button>" . PHP_EOL;
			// 	echo "<li><a href=" . "?remove=$key" . ">mark complete </a> --index #  " . $key . ": " . $chores . "</li>";
			// }


			

			
			// if (isset($errorMessage)) {
			// 	echo "<h1>errorMESSAGE</h1>" . PHP_EOL;
			// 	echo "<h2>please make sure you upload a text file</h2>" . PHP_EOL;
			// }
		?>
		</ol>

		<!-- <form action="todo_list.php" method="post" id="remove-form">
    		<input type="hidden" name="remove_item" id="remove-item">
		</form> -->
		
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

	    <h1>Upload File</h1>

	    <form method="POST" enctype="multipart/form-data"> <!-- this submits a multi-dimensional array vs normal key=>value array -->
	        <p>
	            <label for="file1">File to upload: </label>
	            <input type="file" id="file1" name="file1">
	        </p>
	        <p>
	            <input type="submit" value="Upload">
	        </p>
	    </form>

		<hr>
		<br>
		<form method="POST" action="todo_list.php">
			<input type="text" name="itemtoadd" placeholder="enter item here">
			<input type="submit" value="submit!!">
		</form> 

		<form action="todo_list.php" method="post" id="remove-form">
			<input type="hidden" name="remove_item" id="remove-item" />
		</form>
		
	</body>

</html>
