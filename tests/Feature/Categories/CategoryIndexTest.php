<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_returns_a_collection_of_categories()
    {
        $categories=factory(Category::class,2)->create();
        $response= $this->json('GET','api/categories') ;
//            ->assertJsonFragment([
//                'slug'=>$category->slug
//            ]);
        $categories->each(function ($category) use($response){
            $response->assertJsonFragment([
                'slug'=>$category->slug
            ]);
        });
    }
    public function test_it_returns_only_patent_categories()
    {
        $category=factory(Category::class)->create();
        //dd($category->children()->save(factory(Category::class)->create()));
        $category->children()->save(
            factory(Category::class)->create()
        )  ;


        $this->json('GET','api/categories')
        ->assertJsonCount(1,'data');
    }
    public function test_it_returns_categories_ordered_by_thier_given_order()
    {
        $category=factory(Category::class)->create([
            'order' =>2
        ]);
        $category2=factory(Category::class)->create([
            'order' =>1
        ]);
        //dd($category->children()->save(factory(Category::class)->create()));
        $category->children()->save(
            factory(Category::class)->create()
        )  ;

        dd($category2->slug);
        $this->json('GET','api/categories')
            //assertSeeInOrder to look for the data in json file in their order or not

            ->assertSeeInOrder([$category2->slug,$category->slug]);
    }
}
