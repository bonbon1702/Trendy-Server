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
            'content' => 'Summber'
        ));
        TagContent::create(array(
            'content' => 'Autumn'
        ));
        TagContent::create(array(
            'content' => 'Clothes'
        ));
        TagContent::create(array(
            'content' => 'Man'
        ));
        TagContent::create(array(
            'content' => 'Woman'
        ));
        TagContent::create(array(
            'content' => 'Kids'
        ));
        TagContent::create(array(
            'content' => 'Shoes & Bags'
        ));
        TagContent::create(array(
            'content' => 'Shirts'
        ));
        TagContent::create(array(
            'content' => 'Pants'
        ));
        TagContent::create(array(
            'content' => 'Jeans'
        ));
	}

}