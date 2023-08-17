<?php

namespace App\Http\Controllers\ChampionshipType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PKClubHelperController extends Controller
{
    private array $riderArray;
    private array $maxPointArray=array();
    private int $arrayLen;
    private float $maxPoint=0;
    private array $arrayOut = array();

    public function __construct(array $riderArray)
    {
        $this->riderArray = $riderArray;
        $this->arrayLen = count($this->riderArray);
        $this->maxPointArray =[-1,-1,-1,-1];
        $this->arrayOut = array();
    }


    
    public function getMaxPoint(){
        return $this->maxPoint;
    }
    public function getPointArray(){
        return $this->arrayOut;
    }

    public function calculateScore(int $col, float $point){

            if ($col==4)
            {

                if( $this->allDiferent() && $point > $this->maxPoint){
                    $this->maxPoint = $point;
                    $this->arrayOut = $this->maxPointArray;

                }
                return;
            }
            for ($i=0;$i<$this->arrayLen;$i++){

                $start=$this->riderArray[$i]["data"][$col];

                if ($start!=null){
                    $this->maxPointArray[$col]=$i;
                    $this->calculateScore($col+1,$point+$start->percent);
                }
            }
    }


    private function allDiferent(){

        $checkArray=[0,0,0,0];

        foreach($this->maxPointArray as $arr) {

            if ($arr==-1) return false;
            $checkArray[$arr]=1;

        }

        return array_sum($checkArray)==4;
    }



}
