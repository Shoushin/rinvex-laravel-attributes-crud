<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Rinvex\Attributes\Models\Attribute;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Attribute::typeMap([
            'varchar' => \Rinvex\Attributes\Models\Type\Varchar::class,
            'boolean' => \Rinvex\Attributes\Models\Type\Boolean::class,
            'integer' => \Rinvex\Attributes\Models\Type\Integer::class,
            'text' => \Rinvex\Attributes\Models\Type\Text::class,
            'datetime' => \Rinvex\Attributes\Models\Type\Datetime::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app('rinvex.attributes.entities')->push(App\Models\Customer::class);

        $attributes = DB::table('attributes')->count();
        // dd($attributes);
        if($attributes == 0){
             app('rinvex.attributes.attribute')->create([
                'slug' => 'first_name',
                'type' => 'varchar',
                'name' => 'First Name',
                'group' => '1',
                'is_collection' =>'1',
                'entities' => ['App\Models\Customer'],
            ]);
            app('rinvex.attributes.attribute')->create([
                'slug' => 'last_name',
                'type' => 'varchar',
                'name' => 'last_name',
                'group' => '1',
                'is_collection' =>'1',
                'entities' => ['App\Models\Customer'],
            ]);
            app('rinvex.attributes.attribute')->create([
                'slug' => 'age',
                'type' => 'integer',
                'name' => 'age',
                'group' => '1',
                'is_collection' =>'1',
                'entities' => ['App\Models\Customer'],
            ]);
            app('rinvex.attributes.attribute')->create([
                'slug' => 'gender',
                'type' => 'boolean',
                'name' => 'gender',
                'group' => '1',
                'is_collection' =>'1',
                'entities' => ['App\Models\Customer'],
            ]);
            app('rinvex.attributes.attribute')->create([
                'slug' => 'address',
                'type' => 'text',
                'name' => 'address',
                'group' => '1',
                'is_collection' =>'1',
                'entities' => ['App\Models\Customer'],
            ]);
            app('rinvex.attributes.attribute')->create([
                'slug' => 'birthdate',
                'type' => 'datetime',
                'name' => 'birthdate',
                'group' => '1',
                'is_collection' =>'1',
                'entities' => ['App\Models\Customer'],
            ]);
        }
        
        
        // app('rinvex.attributes.attribute')->create([
        //     'slug' => 'last_name',
        //     'type' => 'varchar',
        //     'name' => 'last_name',
        //     'entities' => ['App\Models\Customer'],
        // ]);
    }
}
