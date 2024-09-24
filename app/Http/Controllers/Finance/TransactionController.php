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
use Illuminate\Support\Facades\DB;


class TransactionController extends Controller{    
	public function index(Competition $competition)
	{        $this->authorize("update",$competition);
	        $transactions = $competition->transaction->sortByDesc("created_at");
	        $box_fee = $transactions->where("type","boxfee")->sum("amount");
	        $start_fee = $transactions->where("type","startfee")->sum("amount");
	        return view("transaction.index",[            
	        	"competition"=>$competition,            
	        	"transactions"=>$transactions,            
	        	"start_fee"=>$start_fee,            
	        	"box_fee"=>$box_fee,        ]);
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

		

	                   

	             try {
	             	DB::transaction(function () use ($competition,$data){

					    $this->transactionCreateHelper($competition,$data);
					    
					    });

					   return redirect()->back();
					} catch (\Exception $e) {
						return redirect()->back()->with('error', $e->getMessage()); 
					}
	             
	                
	         }    

	private function transactionCreateHelper(Competition $competition,$data){
	         	$type = $data["fee_type"];
	             $transaction = Transaction::create(            
	            ["competition_id"=>$competition->id,
	            "amount"=>0,
	            "type"=>$type,
	            "comment"=>$data["comment"],
	        ]);        
	             if ($type=="startfee") $this->setTransactionData(new StartFee(), $data["startfee"], $transaction);
	             if ($type=="boxfee") $this->setTransactionData(new BoxFee(), $data["startfee"], $transaction);        
	         }
	private function setTransactionData($fee,array $startfee,Transaction $transaction)   
	          {        $sum = 0;
	                  foreach($startfee as $item){
	                             $feeTemp = $fee::find($item);

	                             if ($feeTemp->paid) throw new \Exception("Already paid somewhere else", 1);
	                             

	                             $feeTemp->paid = true;
	                             $feeTemp->transaction_id = $transaction->id;
	                             $feeTemp->save();
	                             $sum += $feeTemp->amount;
	                         }        
	                         $transaction->amount = $sum;        $transaction->save();        return $sum;    
	                    }   


	                }