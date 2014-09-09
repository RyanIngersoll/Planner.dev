<?php 
	define('TXTFILE', '../data/todo.txt'); // .. instructs path to look for todo.txt in the data file which is one level above the public folder.

	function openFileMenu($fileToOpen){
	    $handle = fopen($fileToOpen, "r");
	    $contents = trim(fread($handle, filesize($fileToOpen)));
	    $contents_array = explode("\n", $contents); 
	    fclose($handle);
		return $contents_array;		    
	}

	function saveTOFile($items, $filename = TXTFILE){
		$handle = fopen($filename, 'w');
			foreach ($items as $item) {
				fwrite($handle, $item . PHP_EOL);
			}
		fclose($handle);
	}

	$items = openFileMenu(TXTFILE);

    if (!empty($_POST)) {
		array_push($items, $_POST['itemtoadd']);
	    saveTOFile($items);
	}
	

	if (!empty($_GET['remove'])){ // ?remove in the echo statement below sets $key to be the item removed...the ? is the query request
		$removeKey = $_GET['remove'];
		unset($items[$removeKey]);
		saveTOFile($items);
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
    }
    else{
    	$errorMessage = "there was a problem";
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
	
		<button id="remove item">Remove Item</button>

		<h1>"to do list"</h1>
		<ol>
		<?php

			echo "<h1> this is the text file todo list  + adding items from POST line</h1>";

			foreach ($items as $key => $chores) {
				echo "<li><a href=" . "?remove=$key" . ">mark complete </a> --index #  " . $key . ": " . $chores . "</li>";
			}


			if (isset($saved_filename)) {
	        // If we did, show a link to the uploaded file
	        echo "<p>You can download your file <a href='/uploads/{$filename}'>here</a>.</p>";

	        $newitems = openFileMenu($saved_filename);
			$items = array_merge($items, $newitems);
			saveTOFile($items);
	    	echo "<h3> we have updated the todo list from the textfile you uploaded </h3>";
	    	}

			
			if (isset($errorMessage)) {
				echo "<h1>errorMESSAGE</h1>" . PHP_EOL;
				echo "<h2>please make sure you upload a text file</h2>" . PHP_EOL;
			}
		?>
		</ol>

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
			<input type="hidden" name="remove_item" ide="remove-item" />
		</form>
		
	</body>

</html>
