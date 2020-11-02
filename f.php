<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("button").click(function(){ 
      $.post("test.php", { 
          name: "Donald Duck" , 
          city: "Duckburg" 
        }, function(data,status){ 
            $("#div1").html(data); 
            alert("Data: " + data + " \nStatus: " + status);
    });
  });
});
</script>
</head>
<body>
<div id="div1">
       ......
        
        </div> 
        <button > Send an HTTP POST request to a page and get the result back </button>

            </body> 
</html>