<html>
<body>
<h1>Photo Album</h1>
<form>
    <table>
        <tr>
            <td>Name:</td>
            <td><input type="text" name="titleField"></td>
        </tr>
        <tr>
            <td>Keywords:</td>
            <td><input type="text" name="keywordsField"></td>
        </tr>
        <tr>
            <td>Date Range Start:</td>
            <td><input type="text" name="dateRangeStartField"></td>
        </tr>
        <tr>
            <td>Date Range End:</td>
            <td><input type="text" name="dateRangeEndField"></td>
        </tr>
        <tr>
            <td><input type="submit" name="searchField" value="Search"/></td>
        </tr>
    </table>
</form>


<?php
if (isset($_GET['searchField'])) {
    $DBConnect = @mysqli_connect("photo-album-db.ca7hauvcuiwt.ap-southeast-2.rds.amazonaws.com", "****", "*****", "photo_album")
    Or die ("<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error()) . "</p>";

    $searchKeyWords = "'" . implode("','", explode(' ', $_GET['keywordsField'])) . "'";

    $SQLstring = "SELECT * FROM photos p, keywords k where p.keyword_id = k.id and (p.title ='" . $_GET['titleField'] . "' OR (p.date_of_photo BETWEEN '" . $_GET['dateRangeStartField'] . "' and '" . $_GET['dateRangeEndField'] . "') OR k.photo_type IN (" . $searchKeyWords . ") OR k.image_file_format IN (" . $searchKeyWords . ") OR k.image_orientation IN (" . $searchKeyWords . ") OR k.color IN (" . $searchKeyWords . "))";

    $queryResult = @mysqli_query($DBConnect, $SQLstring)
    Or die ("<p>Unable to query the photos table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect)) . "</p>";

    $rowcount = mysqli_num_rows($queryResult);
    echo "<hr />";
    echo "<h3>Search Results</h3>";

    if ($rowcount > 0) {
        echo "<table width='100%' border='1'>";
        echo "<th>Title</th><th>Description</th><th>Date Of Photo</th><th>Reference</th>";
        $row = mysqli_fetch_row($queryResult);
        while ($row) {
            echo "<tr><td>{$row[1]}</td>";
            echo "<td>{$row[2]}</td>";
            echo "<td>{$row[3]}</td>";
            echo "<td><img src='{$row[4]}' width='100' height='100' /></td></tr>";
            $row = mysqli_fetch_row($queryResult);
        }
        echo "</table>";
    } else {
        echo "No Result Found.";
    }
    mysqli_close($DBConnect);
}
?>
</body>
</html>
