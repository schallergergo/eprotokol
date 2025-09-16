<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Imports\CompetitionResultImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CompetitionImportController extends Controller
{
    public function import(Competition $competition)
    {

        return view("competition.import",["competition"=>$competition]);

    }

    public function saveImport(Competition $competition)
    {
        $this->authorize('update', $competition);

         $data = request();

        $data=$data->validate([

            'upload' => ['required','file','mimes:xlsx' ],

            ]);



        $out=[];



        

        try{

          $import = new CompetitionResultImport($competition);



        $import->import($data["upload"]->path(), null, \Maatwebsite\Excel\Excel::XLSX);



        $error=$import->errors();
        //$this->fillNullTime($event);


        if (count($error)==0)return redirect("/competition/show/".$competition->id)->with("status","Successfully imported! ");



        else return redirect("/competition/show/".$competition->id)->with("status","One of more rows skipped!");

    }

    catch (Exception $e) {

     return redirect("/competition/show/".$competition->id)->with("status","Import failed!");

        }
        ;

    }
}
