<?php
use App\Mail\Test\UserRegistered;
use App\Jobs\Test\Somejob;
use App\Jobs\Prognosis\ProsesPrognosisJob;
use App\Models\Pengaturan\Pengguna;
use App\Events\Test\UserSignedUp;

//TEST
Route::prefix('test')->group(function () {
	Route::get('event', function(){
		event(new UserSignedUp('John Doe'));

		// $data = [
		// 	'event' => 'event1',
		// 	'data' => [
		// 		'username' => 'John Doe'
		// 	]
		// ];
		// Redis::publish('test-channel', json_encode($data));
		return view('test.redis');
	});

	Route::get('email-queue', function(){
		Mail::to('test@example.com')->queue(new UserRegistered);
		return "berhasil";
	});

	Route::get('jobs/prognosis', function(){
		dispatch(new ProsesPrognosisJob());
		return "prognosis sukses";
	});

	Route::get('jobs/{jobs}', function($jobs){
		$pengguna = Pengguna::find('keuangan03');
		for($i=0; $i<$jobs; $i++){
			Somejob::dispatch($pengguna);
		}
		return "sukses";
	});
});