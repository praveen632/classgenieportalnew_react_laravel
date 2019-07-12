<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1 ; $i<= '100000' ; $i++)
       {
           $teacher = '20000000'+$i;
           $parent =  '30000000'+$i;
           $student = '40000000'+$i;
       
         DB::table('ed_teacherseed')->insert([
              'id' => '',
              'member_no' => $teacher,
              'created_at'=>date('Y-m-d H:i:s')
         ]);

         DB::table('ed_studentseed')->insert([
               'id' => '',
              'member_no' => $student,
              'created_at'=>date('Y-m-d H:i:s')
         ]);

          DB::table('ed_parentseed')->insert([
              'id' => '',
              'member_no' => $parent,
              'created_at'=>date('Y-m-d H:i:s')
         ]);
        

        }

    }    
}
