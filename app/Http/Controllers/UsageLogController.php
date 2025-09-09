<?php

namespace App\Http\Controllers;

use App\Models\UsageLog;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\JumpingRound;
use App\Models\Style;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsageLogRequest;
use App\Http\Requests\UpdateUsageLogRequest;

class UsageLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()?->role != 'admin') abort(403);
        $query = UsageLog::with('user');

        // Optional filter by model type
        if ($request->has('model')) {
            $query->where('model', 'like', "%{$request->model}%");
        }

        $logs = $query->latest()->paginate(20);

        // Get distinct model types for buttons
        $models = UsageLog::selectRaw('DISTINCT(model) as model')
            ->pluck('model');

        return view('usage_log.index', compact('logs', 'models'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Model $model, string $action, string $comment = null)
    {


        if ($model instanceof Result) return $this->saveHelper($model,"Result",$action,$comment);
        if ($model instanceof JumpingRound) return $this->saveHelper($model,"JumpingRound",$action,$comment);
        if ($model instanceof Style) return $this->saveHelper($model,"Style",$action,$comment);
    }

    private function saveHelper(Model $model, string $model_type, string $action,$comment=null)
    {

        UsageLog::create(
            ["model_id"=>$model->id,
            "model"=>$model_type,
            "action"=>$action,
            "user_id"=> $user = auth()->user()?->id,
            "comment"=>$comment
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUsageLogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsageLogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsageLog  $usageLog
     * @return \Illuminate\Http\Response
     */
    public function show(UsageLog $usageLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsageLog  $usageLog
     * @return \Illuminate\Http\Response
     */
    public function edit(UsageLog $usageLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUsageLogRequest  $request
     * @param  \App\Models\UsageLog  $usageLog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsageLogRequest $request, UsageLog $usageLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsageLog  $usageLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsageLog $usageLog)
    {
        //
    }
}
