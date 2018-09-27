<head> 
    <title>Photo Uploader</title> 
	<style>
		.bold {
			font-weight: bold;
		}
	</style>
  </head> 
  <body>
  <H1>Photo Uploader</H1>
      <p class="bold">Student ID: 101918586</p>
      <p class="bold">Name: Upal Roy</p>
  <form action="upload.php" method="post" enctype="multipart/form-data">
      <fieldset>
        <label class="bold">Photo Title:</label> <input type="text"><br><br>
        <label class="bold">Select a photo:</label> <input type="file" name="photoUpload" id="photoUpload"><br><br>
        <label class="bold">Description:</label> <input type="text"><br><br>
        <label class="bold">Date:</label> <input type="text"><br><br>
		<label class="bold">Keywords (separated by a semicolon, e.g. keyword1; keyword2; etc.):<label><br> <input type="text"><br><br>
        <input type="submit" value="Upload" name="submit">
	</fieldset>
  </form>
  
  <a href="./getphotos.php">Photo Album</a>

  </body>