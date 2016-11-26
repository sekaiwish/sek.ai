<?php include('C:/xampp/htdocs/webassets/default.php');?>
<title>WishDrive > Board</title>
<p class="neonoire" style="color:white;font-size:150%">WishDrive > Board</p>
<p>[<a href="/">Return</a>]
<form action="submit.php" method="post" enctype="multipart/form-data" style="color:grey">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <input type="submit" value="Upload File" name="submit">
</form>
<p>
<a href="/board/files">
<button type="button">View Submissions</button>
</a>
</p>

</body>
</html>
