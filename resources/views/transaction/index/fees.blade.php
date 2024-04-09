<div class="card">


                
                <div class="card-header">
                    <span>{{$competition->name}} {{__("transactions")}} </span>
                     <span id="startFeeTotal" class="ml-2 font-weight-bold text-success">
                            {{__("Start fee")}} : {{$start_fee}}
                    </span>
                     <span id="boxFeeTotal" class="ml-2 font-weight-bold text-success">
                            {{__("Box fee")}} : {{$box_fee}}
                     </span>

                    
                    <span class="float-right">
                        <a href="/finance/show/{{$competition->id}}">
                        {{__("Back")}}
                        </a>
                    </span>
                </div>

                <div class="card-body">

                    
                   
                   
                    <div class="row mb-2 border">
                        <div class="col-md-4 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Comment")}}</span>
                        </div>
                        
                        <div class="col-md-2 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Type")}}</span>
                        </div>


                        <div class="col-md-2 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Amount")}}</span>
                        </div>

                        <div class="col-md-2 p-1 border d-none d-md-block ">
                            <span class="align-middle font-weight-bold">{{__("Created")}}</span>
                        </div>

                        <div class="col-md-2 p-1 border d-none d-md-block">
                             <span class="align-middle font-weight-bold">

                                {{__("Options")}}
                             	

                             </span>

                        </div>

                    </div><!-- end of the row-->
                    

                    @foreach ($transactions as $transaction)
                    
                    

                    <div class="row mb-2 border">
                        <div class="col-md-4 p-1 border">
                            <span class="align-middle">{{$transaction->comment}}</span>
                        </div>
                        
                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$transaction->type}}</span>
                        </div>
                        

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$transaction->amount}}</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$transaction->created_at}}</span>
                        </div>


                        <div class="col-md-2 p-1 border">
                            <a href="{{route('transaction.show',$transaction)}}">{{__("Show")}}</a>
                        </div>
                    </div><!-- end of the row-->

                    @endforeach
                    
                

                    </div><!-- end of the card-->
               


     </div>
    </div>