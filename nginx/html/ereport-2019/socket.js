var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis();

redis.psubscribe('*', function(err, count) {});
// redis.subscribe('channel-name-disdik03');
redis.on('pmessage', function(subscribed, channel, message){
// redis.on('message', function(channel, message){
	console.log(subscribed);
	console.log(channel, message);

	message = JSON.parse(message);
	io.emit(channel+':'+message.event, message.data);
});

redis.on("error", function (err) {
    console.log(err);
});

server.listen(3000, function(){
    console.log('Listening on Port 3000');
});