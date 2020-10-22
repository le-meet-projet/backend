<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Favourite , Order};
use Auth;

class ApiController extends Controller
{
    /**
     * SET CURRENT USER 
     */
    public function __construct()
    {
        return;
    }

    /**
     * GET ALL THE FAVORITES OF THE CURRENT USER
     */
    public function favorites()
    {
        $user = Auth::user();
        return $user->favorites()->paginate(10)->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * GET ALL THE ORDERS OF THE CURRENT USER
     */
    public function orders()
    {
        $user = Auth::user();
        return $user->favorites()->paginate(10)->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * USE_FILTER
     * return all the workshops by filter
     */
    public function workshops()
    {
        return null;
    }

    /**
     * USE FILTER 
     * RETURN ALL THE WORKSHOPS BY FILTER
     */
    public function Search()
    {
        return null;
    }

    public function addToFavorite()
    {
        return null;
    }

    public function removeFromFavorite()
    {
        return null;
    }

    public function findClose()
    {
        return null;
    }

    /**
     * VALIDATE THE REQUEST
     * SAVE THE ORDER 
     * SEND EMAIL TO USER
     */
    public function request()
    {
        return null;
    }

    /**
     * PAGINATE THE WORKSHOP
     */
    public function index()
    {
        return null;
    }

    /**
     * LOAD CATEGORIES (ID, NAME) TO ARRAY 
     * SHOW THE CREATE PAGE WITH CATEGORIES
     * VALIDATE THE REQUEST
     * STORE IN DATABASE
     * REDIRECT WITH SUCCESS
     */
    public function create()
    {
        return null;
    }

    /**
     * GET THE WORKSHOP
     * LOAD CATEGORIS (ID, NAME) TO ARRAY 
     * SHOW THE CREATE PAGE WITH WORKSHOP & CATEGORIS
     */
    public function edit()
    {
        return null;
    }

    /**
     * VALIDATE THE REQUEST
     * GET THE WORKSHOP
     * UPDATE
     * REDIRECT WITH SUCCESS
     */
    public function update()
    {
        return null;
    }

    /**
     * GET THE WORKSHOP
     * DELETE
     * REDIRECT WITH SUCCESS
     */
    public function delete()
    {
        return null;
    }

    /**
     * RETURN VALIDATION RULES ARRAY
     */
    public function rules()
    {
        return null;
    }
}