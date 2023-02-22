<?php

namespace App\Http\Controllers;

use App\Http\Requests\category\StoreCategoryRequest;
use App\Http\Requests\Category\IndexCategoriesRequest;
use App\Http\Resources\category\CategoryCollection;
use App\Http\Resources\category\CategoryResource;
use App\UseCases\Category\ListCategories;
use App\UseCases\Category\StoreCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( IndexCategoriesRequest $request, ListCategories $listCategories)
    {
        $categories = $listCategories->execute($request);

        return  request()->get('all') ?  $this->success($categories): $this->withPagination($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request , StoreCategory $storeCategory)
    {
        $result = $storeCategory->execute($request->all());

        return $this->success(new CategoryResource($result) , null , 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
