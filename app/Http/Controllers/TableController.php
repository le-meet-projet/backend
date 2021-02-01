<?php 


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Table;

class TableController extends Controller 
{

    public function index()
    {
        $tables = Table::all();
        return view('tables/index.blde.php');
    }

    public function create()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

}