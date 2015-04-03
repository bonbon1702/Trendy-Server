<?php

// Composer: "fzaninotto/faker": "v1.3.0"

class TagContentTableSeeder extends Seeder {

	public function run()
	{
        TagContent::create(array(
            'content' => 'Spring'
        ));
        TagContent::create(array(
            'content' => 'Winter'
        ));
        TagContent::create(array(
            'content' => 'Summer'
        ));
	}

}