<?php 

namespace App\Imports;

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
 			'rider_id'=> str_replace(" ", "",$data['rider_licence']),
 			'rider_name'=> $data['rider_name'],
 			'horse_id'=> str_replace(" ", "",$data['horse_licence']),
 			'horse_name'=> $data['horse_name'],
 			'club' => $data['club'],
 			'category' => str_replace("õ", "ő",$data['category']),
            'original_category' => str_replace("õ", "ő",$data['category']),
        ]);
        $startController= new StartController();
        $startController->addResultEntries($newStart);
        return $newStart;
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