<?php

namespace App\Http\Controllers\Finance;
use App\Models\Competition;
use App\Models\StartFee;
use App\Models\BoxFee;
use App\Models\EntryFee;
use App\Models\Start;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index(Competition $competition){
        $this->authorize("update",$competition);
        $transactions = $competition->transaction->sortByDesc("created_at");
        $box_fee = $transactions->where("type","boxfee")->sum("amount");
        $start_fee = $transactions->where("type","startfee")->sum("amount");
        return view("transaction.index",[
            "competition"=>$competition,
            "transactions"=>$transactions,
            "start_fee"=>$start_fee,
            "box_fee"=>$box_fee,
        ]);
        
    }

    public function show(Transaction $transaction){
        $this->authorize("update",$transaction->competition);

        return view("transaction.show",["transaction"=>$transaction]);
        
    }

     public function transactionCreate(Competition $competition){
                    $data = request()->validate(
                    ["startfee"=>["required","array"],
                    "comment"=>["nullable","string","max:256"],
                    "fee_type"=>["required","string"],
                                    ]);
        $type = $data["fee_type"];
        $transaction = Transaction::create(
            [
                "competition_id"=>$competition->id,
                "amount"=>0,
                "type"=>$type,
                "comment"=>$data["comment"],
            ]);
        if ($type=="startfee") $this->setTransactionData(new StartFee(), $data["startfee"], $transaction);
        if ($type=="boxfee") $this->setTransactionData(new BoxFee(), $data["startfee"], $transaction);
        return redirect()->back();
    }

    private function setTransactionData($fee,array $startfee,Transaction $transaction)
    {
        $sum = 0;

        foreach($startfee as $item){
            $fee = $fee::find($item);
            $fee->paid = true;
            $fee->transaction_id = $transaction->id;
            $fee->save();
            $sum += $fee->amount;            

        }
        $transaction->amount = $sum;
        $transaction->save();
        return $sum;
    }

   
}