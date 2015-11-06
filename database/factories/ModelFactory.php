<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


//https://mattstauffer.co/blog/better-integration-testing-in-laravel-5.1-model-factories
// http://fixabc.xyz/question/31711467/laravel-5-1-testing-with-model-relationships-and-factories
//$user = factory(App\User::class)->create();
//$post = factory(App\Post::class)->create();
//$post->user()->associate($user);
//$post->save();


$numberInteration = 10;



// factory('App\Role', 4 )->create()
$factory->define(App\Role::class, function( Faker\Generator $faker ){
	
	$randomIndex 		= $faker->numberBetween(0,3);
	$rolesArrayName 	= ['user', 'teacher', 'manager', 'administrator'];
	$rolesArrayLabel 	= ['usuario', 'Profesor', 'Moderador', 'Super Admin'];

	return [
		'name' 	=> $rolesArrayName[$randomIndex],
		'label' => $rolesArrayLabel[$randomIndex],
	];	
});


// generate 4 Permission
$factory->define(App\Permission::class, function( Faker\Generator $faker ){
	$randomIndex 		= $faker->numberBetween(0,3);
	$permisArrayName 	= ['can_view', 'can_edit', 'can_manage', 'can_admin'];
	$permisArrayLabel 	= ['View Content', 'Teachers', 'Site Manager', 'Site Administrator'];

	return [
		'name' 	=> $permisArrayName[$randomIndex],
		'label' => $permisArrayLabel[$randomIndex],
	];	
});



$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'first_name' 		=> $faker->firstName,
        'last_name' 		=> $faker->lastName,
        'email' 			=> $faker->email,
        'password' 			=> bcrypt('loreias'),
        'remember_token' 	=> str_random(10),
    ];
});



$factory->define(App\Level::class, function( Faker\Generator $faker ) use( $numberInteration ){

	return [
		'level_index'		=> $faker->numberBetween(0,$numberInteration),
		'title' 			=> $faker->sentence,
		'description' 		=> $faker->sentence(5),
		'user_id' 			=> factory('App\User')->make()->id,
		// 'updated_by_id'		=> factory('App\User')->make()->id,
		'status_id'			=> $faker->numberBetween(1,3), //App\ContentStatus::all()->random()->id, create the Content Status Model and Migration
		// 'published_at'		=> $faker->dateTime(),
	];	
});


$factory->define(App\Lesson::class, function( Faker\Generator $faker) use( $numberInteration ){
	return [
		'title' 			=> $faker->sentence,
		'description' 		=> $faker->sentence(5),
		'lesson_index'		=> $faker->numberBetween(1,$numberInteration),
		'video_id'			=> str_random(10),
		'level_id' 			=> $faker->numberBetween(0,$numberInteration),
		'user_id' 			=> $faker->numberBetween(1,$numberInteration),
		'status_id'			=> $faker->numberBetween(1,3), //App\ContentStatus::all()->random()->id, create the Content Status Model and Migration
		// 'published_at'		=> $faker->dateTime(),
	];	
});
