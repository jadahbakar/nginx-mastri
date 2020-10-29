<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
<script type="text/javascript">
	var socket = io('http://192.168.10.10:3000');
	socket.on("test-channel:App\\Events\\Test\\UserSignedUp", function(message){
        // increase the power everytime we load test route
       	console.log(message);
    });
</script>
</body>
</html>