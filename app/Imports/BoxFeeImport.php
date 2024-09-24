<?php 

namespace App\Imports;


use App\Models\Competition;

use App\Models\BoxFee;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class BoxFeeImport implements ToModel, WithValidation, WithHeadingRow, SkipsOnError
{
    use Importable, SkipsErrors;
	private Competition $competition;

	public function __construct(Competition $competition) 
    {
        $this->competition=$competition;
    }
    public function model(array $data)
    {	

        $competition_id=$this->competition->id;


        $rider_name=  $data["rider_name"];
        $rider_id = $data["rider_id"];

        $horse_name= $data["horse_name"];
        $horse_id = $data["horse_id"];

    	$savedAlready=BoxFee::where("rider_id",str_replace(" ","",$rider_id))->
                            where("horse_id",str_replace(" ","",$horse_id))->
                            where("competition_id",$competition_id)->get();

        if (count($savedAlready)!==0) return null;


        $newBoxFee= new BoxFee([
 			'competition_id' => $this->competition->id,
 			'rider_id'=> str_replace(" ", "",$rider_id),
 			'rider_name'=> $rider_name,
 			'horse_id'=> str_replace(" ", "",$horse_id),
 			'horse_name'=> $horse_name,
 			'club' => str_replace("õ", "ő",$data['club']),
 			'amount' => str_replace(" ", "",$data['amount']),
        ]);

        return $newBoxFee;
    }

    public function rules(): array
    {
        return [
            
            
        ];
    }

   

   
}