<?php
error_reporting(0);
# Echo the templated page content
include("{$_SERVER["DOCUMENT_ROOT"]}/assets/defaultHeader.php");
echo("  	<link href=\"/css/chan.css\" rel=\"stylesheet\">\n</head>");
include("{$_SERVER["DOCUMENT_ROOT"]}/assets/defaultNavbar.php");
# Include necessary SQL login information
include("{$_SERVER["DOCUMENT_ROOT"]}/access/sql.php");
# Set a primary variable to a session variable
$x = $_SESSION[postsshown];
# Set a default value for a variable
$offset = 0;
# Get the page number based on the user's URI
$page = $_GET["page"];
# If the retrieved value for the page number is a real number
if(is_numeric($page)) {
	# If the number is a float
	if(is_float($page)) {
		# Remove the floating point of the number
		$page = floor($page);
		# Send the user to the new page
		header("Location: /chan?$page");
		# Prevent user from continuing to load scripts on this page
		exit();
	}
	# If the page is under the minimum value
	if($page < 1) {
		# Send the user to the minimum value page number
		header("Location: /chan?page=1");
		exit();
	}
	# Else, if page is above the maximum value
	elseif($page > 10) {
		# Send the user to the maximum value page number
		header("Location: /chan?page=10");
		exit();
	}
	# Set the next page to the current page add one
	$pageNext = $page + 1;
	# Set the previous page to the current page less one
	$pagePrev = $page - 1;
	# If the page is not one
	if($page != 1) {
		# Set SQL query offset to the number of threads the user wants, times the page number, less the initial value.
		$offset = $x * $page - $x;
	}
# Else, default the user to the first page.
} else {
	$page = 1;
	$pageNext = 2;
	$pagePrev = 0;
}
# All threads to load are distinct entries from posts, ordered by post ID, descending, limited to users setting and offset by the page number.
$threads = mysqli_query($link,"SELECT DISTINCT thread FROM posts ORDER BY id DESC LIMIT $x OFFSET $offset");
# Initialise while loop variable
$y = 1;
# While there are threads in the SQL array result
while($thread = mysqli_fetch_array($threads,MYSQLI_ASSOC)) {
	# Set an array to contain all the thread data
	$displayThreads[$y] = $thread;
	# Increment loop variable
	$y++;
}
?>
	<form class="commentBox" enctype="multipart/form-data" id="upload" action="submit.php" method="post">
		<select class="form-control form-control-sm col-sm-12" form="upload" name="threadUpload" id="threadUpload">
			<option value="new">New thread</option>
<?php
	for($x=1;$x<=count($displayThreads);$x++) {
		echo("			<option value=\"{$displayThreads[$x]["thread"]}\">Thread #{$displayThreads[$x]["thread"]}</option>\n");
	}
?>
		</select>
		<textarea class="form-control col-sm-12" placeholder="Comment" form="upload" name="textUpload" id="textUpload"></textarea>
		<label class="custom-file col-sm-12">
			<input class="custom-file-input" type="file" name="fileUpload" id="fileUpload">
			<span class="custom-file-control form-control-file"></span>
		</label>
		<br>
		<button class="btn btn-sm g-recaptcha form-control col-sm-12" data-sitekey="6LcykxoUAAAAAMEKIJkUZ7do2Q2DohJ2L7TKbgK6" data-callback="onSubmit">
			Submit Post
		</button>
	</form>
<?php
# For each thread in the main thread array
for($x=1;$x<=count($displayThreads);$x++) {
	# Echo the start of the thread div
	echo("<div class=\"thread\">");
	# Get all displayed data of the OP on the selected thread
  $postData[$x] = mysqli_query($link,"SELECT id, thread, name, time, body, filename, filetype, filesize, resolution FROM posts WHERE op = 1 AND thread = {$displayThreads[$x]["thread"]}");
	# Set that data into a readable array
	$postData[$x] = mysqli_fetch_array($postData[$x],MYSQLI_ASSOC);
	# Get the number of posts in the thread that aren't the OP
	$postData[$x]["replyCount"] = mysqli_query($link,"SELECT COUNT(id) FROM posts WHERE op = 0 AND thread = {$postData[$x]["id"]}");
	# Set that data into a readable variable
	$postData[$x]["replyCount"] = mysqli_fetch_array($postData[$x]["replyCount"],MYSQLI_ASSOC);
	# If the number of replies is one
	if($postData[$x]["replyCount"]["COUNT(id)"] == 1) {
		# Set the reply count to one
		$postData[$x]["replyCount"] = 1;
		# Set the correct grammar for a singular reply
		$postData[$x]["replyFormat"] = 0;
	# If the number of replies isn't one
	} else {
		# Set the reply count to the number of replies
		$postData[$x]["replyCount"] = $postData[$x]["replyCount"]["COUNT(id)"];
		# Set the correct grammar for multiple or zero replies
		$postData[$x]["replyFormat"] = 1;
	}
	# Echo the start of the OP
  echo("<div class=\"post\"><a href=\"/chan/files/{$postData[$x]["id"]}.{$postData[$x]["filetype"]}\" class=\"notHighlight\" target=\"_blank\"><img src=\"/chan/thumbs/{$postData[$x]["id"]}.jpg\"></a><div class=\"postinfo\"><p><b>{$postData[$x]["name"]}</b> {$postData[$x]["time"]} <a href=\"?thread={$postData[$x]["id"]}\" class=\"notHighlight\">No.</a><a id=\"{$postData[$x]["id"]}\" onclick=\"insertReply(event);insertThread(this.id)\" class=\"notHighlight\">{$postData[$x]["id"]}</a> [<a href=\"?thread={$postData[$x]["id"]}\">Reply</a>] {$postData[$x]["replyCount"]} ");
	# If the grammar setting is singular
	if($postData[$x]["replyFormat"] == 0) {
		# Echo the singular reply
		echo("reply");
	# If the grammar setting is multiple or zero
	} else {
		# Echo the multiple or zero replies
		echo("replies");
	}
	# If there are more than three replies
	if($postData[$x]["replyCount"] > 3) {
		# Count the number of omitted posts by the total less three
		$omissions = $postData[$x]["replyCount"] - 3;
		# Echo the omitted posts
		echo(" ($omissions omitted)");
	}
	# If number of characters in file's name exceeds 37
	if(strlen($postData[$x]["filename"]) > 37) {
		# Sets a variable with a string equal to 37
		$postData[$x]["shortname"] = substr($postData[$x]["filename"], 0, 27) . "..." . substr($postData[$x]["filename"], -7);
	}
	# Echo some file data of the OP
	echo("<br><a href=\"/chan/files/{$postData[$x]["id"]}.{$postData[$x]["filetype"]}\" class=\"notHighlight\" target=\"_blank\">");
	# If a shortened filename is set
	if(isset($postData[$x]["shortname"])) {
		# Echo the shortened name with the full name as hover text
		echo("<span title=\"{$postData[$x]["filename"]}\">{$postData[$x]["shortname"]}</span>");
	# If a shortened filename isn't set
	} else {
		# Echo the file name
		echo($postData[$x]["filename"]);
	}
	# Echo the rest of the file data of the OP
	echo("</a> {$postData[$x]["filesize"]}B ({$postData[$x]["resolution"]})</p></div><div class=\"comment\">{$postData[$x]["body"]}</div></div>");
	# For three iterations
	for($y=2,$z=1;$y>=0;$y--,$z++) {
		# Get the data for the y+1'th most recent reply
		$postData[$x]["replies"][$z] = mysqli_query($link,"SELECT id, name, time, body, filename, filetype, filesize, resolution FROM posts WHERE thread = '{$displayThreads[$x]["thread"]}' AND op = 0 ORDER by id DESC LIMIT 1 OFFSET $y");
		# Set that data into a readable array
		$postData[$x]["replies"][$z] = mysqli_fetch_array($postData[$x]["replies"][$z],MYSQLI_ASSOC);
		# If the reply exists
		if($postData[$x]["replies"][$z]["id"] != "") {
			# Echo the start of the reply
			echo("<div class=\"reply\">");
			# If the reply includes a file
			if($postData[$x]["replies"][$z]["filename"] != "") {
				# Echo the start of the file data
				echo("<a href=\"/chan/files/{$postData[$x]["replies"][$z]["id"]}.{$postData[$x]["replies"][$z]["filetype"]}\" class=\"notHighlight\" target=\"_blank\"><img class=\"chan\" src=\"/chan/thumbs/{$postData[$x]["replies"][$z]["id"]}.jpg\"></a>");
			}
			# Echo the start of the reply data
			echo("<div class=\"postinfo\"><p><b>{$postData[$x]["replies"][$z]["name"]}</b> {$postData[$x]["replies"][$z]["time"]} <a href=\"?post={$postData[$x]["replies"][$z]["id"]}\" class=\"notHighlight\">No.</a><a id=\"{$postData[$x]["id"]}\" onclick=\"insertReply(event);insertThread(this.id)\" class=\"notHighlight\">{$postData[$x]["replies"][$z]["id"]}</a> <a href=\"?thread={$postData[$x]["id"]}\" class=\"notHighlight\"><span class=\"replyThread\">&gt;&gt;{$postData[$x]["id"]}</span></a>");
			# If the reply includes a file
			if($postData[$x]["replies"][$z]["filename"] != "") {
				# Echo the rest of the file data
				echo("<br><a href=\"/chan/files/{$postData[$x]["replies"][$z]["id"]}.{$postData[$x]["replies"][$z]["filetype"]}\" class=\"notHighlight\" target=\"_blank\">{$postData[$x]["replies"][$z]["filename"]}</a> {$postData[$x]["replies"][$z]["filesize"]}B ({$postData[$x]["replies"][$z]["resolution"]})");
			}
			# Echo the rest of the reply data
			echo("</p></div><div class=\"comment\">{$postData[$x]["replies"][$z]["body"]}</div></div>");
		}
	}
	# Echo the end of the thread div
	echo("</div>");
}
# Close the MySQL connection
mysqli_close($link);
# Echo the start of the page bar footer
echo("<div class=\"chanFooter\">
	<div>
		<a class=\"btn btn-outline-info\" href=\"?$pagePrev\"><i class=\"fa fa-arrow-circle-left\"></i> Previous</a>
			<div class=\"btn-group\" role=\"group\">\n");
		# For ten iterations
		for($x=1;$x<=10;$x++) {
			# If the page number is equal to the page number button
			if($x == $page) {
				# Echo a different style
				echo("				<a class=\"btn btn-primary\"><strong>$x</strong></a>\n");
			# If the page number is not equal to the page number button
			} else {
				# Echo the normal style
				echo("				<a class=\"btn btn-secondary\" href=\"?page=$x\">$x</a>\n");
			}
		}
		# Echo rest of the page bar footer
		echo("			</div>
		<a class=\"btn btn-outline-info\" href=\"?$pageNext\">Next <i class=\"fa fa-arrow-circle-right\"></i></a>
	</div>
</div>\n");
?>
