<?php
// Run the batch file
shell_exec("run-java.bat");

// Read the output file
$output = file_exists("java-output.txt") ? file_get_contents("java-output.txt") : "Java output not found.";

echo "<pre>$output</pre>";
?>