<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\Location;
use App\Models\Sound;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // create roles and assign created permissions



        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'moderator']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'contributor']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo(Permission::all());

        $user1 = new User;
        $user1->first_name = 'Admin';
        $user1->last_name = 'Admin';
        $user1->date_of_birth ='2021-12-12';
        $user1->profession = 'Musician';
        $user1->agree_on_terms =true;
        $user1->email = 'admin@gmail.com';
        $user1->password = Hash::make('admin');
        $user1->save();
        $user1->assignRole('admin');


        $user3 = new User;
        $user3->first_name = 'Contributor';
        $user3->last_name = 'Contributor';
        $user3->date_of_birth ='2021-12-12';
        $user3->profession = 'Musician';
        $user3->agree_on_terms =true;
        $user3->email = 'contributor@gmail.com';
        $user3->password= Hash::make('contributor');
        $user3->save();
        $user3->assignRole('contributor');

        $user4 = new User;
        $user4->first_name = 'Moderator';
        $user4->last_name = 'Moderator';
        $user4->date_of_birth ='2021-12-12';
        $user4->profession = 'Musician';
        $user4->agree_on_terms =true;
        $user4->email = 'moderator@gmail.com';
        $user4->password = Hash::make('moderator');
        $user4->save();
        $user4->assignRole('moderator');

        $user5 = new User;
        $user5->first_name = 'User';
        $user5->last_name = 'User';
        $user5->date_of_birth ='2021-12-12';
        $user5->profession = 'Musician';
        $user5->agree_on_terms =true;
        $user5->email = 'user@gmail.com';
        $user5->password= Hash::make('user');
        $user5->save();
        $user5->assignRole('user');



        $cat = new Category();
        $cat->name = 'Wild Life';
        $cat->image = '2_dogss.png';
        $cat->featured_one= false;
        $cat->featured_two=true;
        $cat->save();

        $cat1 = new Category();
        $cat1->name = 'Transportation';
        $cat1->image = '131_isolated bus.png';
        $cat1->featured_one= false;
        $cat1->featured_two=true;
        $cat1->save();

        $cat2 = new Category();
        $cat2->name = 'Call to Prayer';
        $cat2->image = '37_moque.png';
        $cat2->featured_one= false;
        $cat2->featured_two=true;
        $cat2->save();

        $cat3 = new Category();
        $cat3->name = 'Musical Instruments';
        $cat3->image = '146_music.png';
        $cat3->featured_one= false;
        $cat3->featured_two=true;
        $cat3->save();

        $cat4 = new Category();
        $cat4->name = 'Markets';
        $cat4->image = '837_mkbb.png';
        $cat4->featured_one= true;
        $cat4->featured_two=false;
        $cat4->save();

        $cat4 = new Category();
        $cat4->name = 'Street Vendors';
        $cat4->image = '427_issolated.png';
        $cat4->featured_one= true;
        $cat4->featured_two=false;
        $cat4->save();


        $sub = new SubCategory();
        $sub->name = 'Test subcat 1';
        $sub->category_id= 1;
        $sub->image = '779_abdeen-01.png';
        $sub->save();

        $sub1 = new SubCategory();
        $sub1->name = 'Test subcat 2';
        $sub1->category_id= 2;
        $sub1->image = '779_abdeen-01.png';
        $sub1->save();


        $sub2 = new SubCategory();
        $sub2->name = 'Test subcat 3';
        $sub2->category_id= 3;
        $sub2->image = '779_abdeen-01.png';
        $sub2->save();

        $sub = new SubCategory();
        $sub->name = 'Test subcat';
        $sub->category_id= 1;
        $sub->image = '779_abdeen-01.png';
        $sub->save();


        $tag = new Tag();
        $tag->name = 'Test Tag 1';
        $tag->save();

        $tag1 = new Tag();
        $tag1->name = 'Test Tag 2';
        $tag1->save();

        $tag2 = new Tag();
        $tag2->name = 'Test Tag 3';
        $tag2->save();

        $tag3 = new Tag();
        $tag3->name = 'Test Tag 4';
        $tag3->save();

        $tag4 = new Tag();
        $tag4->name = 'Test Tag 5';
        $tag4->save();

        $tag5 = new Tag();
        $tag5->name = 'Test Tag 6';
        $tag5->save();


        $location = new Location();
        $location->country_id =166;
        $location->state_id= 2728;
        $location->city_id=31496;
        $location->area = 'Rehmanabad';
        $location->save();

        $location1 = new Location();
        $location1->country_id =166;
        $location1->state_id= 2728;
        $location1->city_id=31496;
        $location1->area = '6th Road';
        $location1->save();

        $location2 = new Location();
        $location2->country_id =166;
        $location2->state_id= 2728;
        $location2->city_id=31496;
        $location2->area = 'Double Road';
        $location2->save();

        $location3 = new Location();
        $location3->country_id =166;
        $location3->state_id= 2728;
        $location3->city_id=31496;
        $location3->area = 'Raja Bazar';
        $location3->save();

        $location4 = new Location();
        $location4->country_id =166;
        $location4->state_id= 2728;
        $location4->city_id=31496;
        $location4->area = 'Saddar Bazar';
        $location4->save();

        $location5 = new Location();
        $location5->country_id =166;
        $location5->state_id= 2728;
        $location5->city_id=31496;
        $location5->area = 'Khana Pul';
        $location5->save();



        $song = new Sound();
        $song->name ='Test Song 1';
        $song->song = 'song1.mp3';
        $song->category_id = 1;
        $song->uploaded_date= Date('Y-m-d');
        $song->sub_category_id= 1;
        $song->tag_id = 1;
        $song->user_id=1; 
        $song->location_id= 1;
        $song->information= 'this is test informatio for this song. this is test song' ;
        $song->description= 'this is test informatio for this song. this is test song' ;
        $song->duration= '2.32' ;
        $song->save();


        $song5 = new Sound();
        $song5->name ='Test Song 5';
        $song5->song = 'song5.mp3';
        $song5->category_id = 1;
        $song5->uploaded_date= Date('Y-m-d');
        $song5->sub_category_id= 1;
        $song5->tag_id = 1;
        $song5->user_id=4; 
        $song5->location_id= 1;
        $song5->information= 'this is test informatio for this song. this is test song' ;
        $song5->description= 'this is test informatio for this song. this is test song' ;
        $song5->duration= '2.32' ;
        $song5->save();


        $song1 = new Sound();
        $song1->name ='Test Song 2';
        $song1->song = 'song2.m4a';
        $song1->category_id = 2;
        $song1->sub_category_id= 2;
        $song1->uploaded_date= Date('Y-m-d');
        $song1->tag_id = 2;
        $song1->user_id=4; 
        $song1->location_id= 4;
        $song1->information= 'this is test informatio for this song. this is test song' ;
        $song1->description= 'this is test informatio for this song. this is test song' ;
        $song1->duration= '2.32' ;
        $song1->save();

        $song2 = new Sound();
        $song2->name ='Test Song 3';
        $song2->song = 'song3.mp3';
        $song2->category_id = 1;
        $song2->uploaded_date= Date('Y-m-d');
        $song2->sub_category_id= 1;
        $song2->tag_id = 1;
        $song2->user_id=4; 
        $song2->location_id= 1;
        $song2->information= 'this is test informatio for this song. this is test song' ;
        $song2->description= 'this is test informatio for this song. this is test song' ;
        $song2->duration= '2.32' ;
        $song2->save();

        $song3 = new Sound();
        $song3->name ='Test Song 4';
        $song3->song = 'song4.mp3';
        $song3->category_id = 2;
        $song3->sub_category_id= 2;
        $song3->uploaded_date= Date('Y-m-d');
        $song3->tag_id = 2;
        $song3->user_id=1; 
        $song3->location_id= 2;
        $song3->information= 'this is test informatio for this song. this is test song' ;
        $song3->description= 'this is test informatio for this song. this is test song' ;
        $song3->duration= '2.32' ;
        $song3->save();







    }
}
