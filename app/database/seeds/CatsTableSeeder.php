<?php
class CatsTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('cats')->insert(
			array(
				array('id'=> 1, 'name' => 'Domestic','date_of_birth'=>'2014-01-01','breed_id'=>2),
				array('id'=> 2, 'name' => 'Siamese','date_of_birth'=>'2015-01-01','breed_id'=>3)
			)
		);
	}
}