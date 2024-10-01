<?php 



namespace App\Imports;


use Carbon\Carbon;
use App\Models\Result;

use App\Models\Start;

use App\Models\Event;

use App\Http\Controllers\StartController;

use Illuminate\Validation\Rule;

use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\Importable;

use Maatwebsite\Excel\Concerns\WithValidation;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Maatwebsite\Excel\Concerns\SkipsOnError;

use Maatwebsite\Excel\Concerns\SkipsErrors;



class ResultImport implements ToModel, WithValidation, WithHeadingRow, SkipsOnError

{

    use Importable, SkipsErrors;

	private Event $event;



	public function __construct(Event $event) 

    {

        $this->event=$event;

    }

    public function model(array $data)

    {	$event_id=$this->event->id;



    	$savedAlready=Start::where("rider_id",str_replace(" ","",$data['rider_licence']))->

                            where("horse_id",str_replace(" ","",$data['horse_licence']))->

                            where("event_id",$event_id)->get();

        if (count($savedAlready)!==0) return null;





        $newStart=new Start([

            'id' => $this->generateID(),

            'rank'=>$this->getLastRank($this->event),

 			'event_id' => $this->event->id,

            'start_time' =>$this->convertTime($data["time"]),
            

 			'rider_id'=> str_replace(" ", "",$data['rider_licence']),

 			'rider_name'=> $data['rider_name'],

 			'horse_id'=> str_replace(" ", "",$data['horse_licence']),

 			'horse_name'=> $data['horse_name'],

 			'club' => str_replace("õ", "ő",$data['club']),

 			'category' => str_replace("õ", "ő",$data['category']),

            'original_category' => str_replace("õ", "ő",$data['category']),

            'twoids'=>str_replace(" ", "",$data['rider_licence'])."".str_replace(" ", "",$data['horse_licence']),

        ]);

        $startController= new StartController();

        if ($this->event->program->has_result)$startController->addResultEntries($newStart);

        $startController->addToExtraTables($newStart);

        return $newStart;

    }


    private function convertTime($excelTime){

        if ($this->isTimeString($excelTime))  return Carbon::parse($excelTime)->format('H:i:s');

        // If it's a floating-point number, convert it to a real time
        if (is_numeric($excelTime)) {
            return $this->excelTimeToRealTime($excelTime);
        }


    }

     private function isTimeString($value)
    {
        // Check if the value matches a time format (HH:MM, HH:MM:SS)
        return preg_match("/^\d{1,2}:\d{2}(:\d{2})?$/", $value);
    }

    private function excelTimeToRealTime($excelTime)
    {
        // Excel time starts from 1900-01-01
        $baseDate = Carbon::createFromDate(1900, 1, 1)->startOfDay();

        // Excel uses 1 for 1900-01-01, but in PHP it starts at 0, so subtract 1 from days
        $days = floor($excelTime) - 1;
        $seconds = ($excelTime - floor($excelTime)) * 86400;

        // Add days and seconds to the base date
        $realTime = $baseDate->addDays($days)->addSeconds($seconds);

        return $realTime->format('H:i:s');
    }

    public function rules(): array

    {

        return [

            '0' => function($attribute, $value, $onFailure) {

                  if (str_len($value) !== 5) {

                       $onFailure('Rider licence number not correct!');

                  }

              },

              '2' => function($attribute, $value, $onFailure) {

                  if (str_len($value) !== 5) {

                       $onFailure('Horse licence number not correct!');

                  }

              }

            

        ];

    }



    private function generateID(){



        //lower limit of the id

        $limit = 100000000000000000;



        //generating a random id

        $id = rand($limit,$limit*10);



        //checking if a record already exisits with the given id

        $result = Result::find($id);



        // iterating the last two steps until id is found

        while ($result!==null){

            $id = rand($limit,$limit*10);

            $result = Result::find($id);

        }



        return $id;

    }

    private function getLastRank(Event $event){

    $lastRank= Start::where('event_id',$event->id)->max("rank");

    if ($lastRank==null) return 1;

    return $lastRank+1;

   }



   

}