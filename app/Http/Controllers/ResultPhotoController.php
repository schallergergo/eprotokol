<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\ResultPhoto;
use App\Models\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResultPhotoRequest;
use App\Http\Requests\UpdateResultPhotoRequest;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StartController;




class ResultPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Result $result)
    {
        return view("resultphoto.create",["result"=>$result]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResultPhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storePhoto(Result $result)
    {
        $this->authorize("update",$result);
        $data =  request();

        $data=$data->validate([

            'image' => ['required', 'file'],
            ]);




// Load the image
$image = Image::make($data['image']->getRealPath());

// Fix orientation
$image->orientate();

// Resize while preserving aspect ratio
$image->resize(1033, 1033, function ($constraint) {
    $constraint->aspectRatio();
    $constraint->upsize();
});

// Generate the storage path
$storagePath = 'results/' . $result->start->event->id . '/' . $result->id;

// Create a temporary file
$tempPath = tempnam(sys_get_temp_dir(), 'img_') . '.jpg';
$image->save($tempPath, 90); // Save as JPG with 90% quality

// Store the processed image in public disk (Laravel will generate the filename)
$path = Storage::disk('public')->putFile($storagePath, new \Illuminate\Http\File($tempPath));

// Delete the temporary file
unlink($tempPath);


        ResultPhoto::create([
            "url" => $path,
            "result_id"=>$result->id,
        ]);
        return redirect()->back();
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResultPhoto  $resultPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(ResultPhoto $resultPhoto)
    {
        return view("resultphoto.show",["resultPhoto"=>$resultPhoto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResultPhoto  $resultPhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
       $this->authorize("update",$result);
       $photos = $result->resultphoto->sortBy("created_at");
        return view("resultphoto.edit",[
            "result"=>$result,
            "photos"=>$photos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResultPhotoRequest  $request
     * @param  \App\Models\ResultPhoto  $resultPhoto
     * @return \Illuminate\Http\Response
     */
    public function updateResult(Result $result)
    {
        $this->authorize("update",$result);
        if ($result->filled)  abort(403);
        $data = request();
        $data=$data->validate([

            'mark' => ['required', 'numeric'],
            'percent' => ['required', 'numeric'],
            'collective' => ['required', 'numeric'],

            ]);

        $data = array_merge($data,
            [
                "completed"=>$result->completed+1,
            ]);


        $resultController = new ResultController();
        $resultController->ResultLog($result->id,$data["mark"],$result->assessment);
        $result->update($data);

        $startController = new StartController();
        $startController->calculateAllJudges($result->start);

        return redirect()->back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResultPhoto  $resultPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResultPhoto $resultPhoto)
    {
        $this->authorize("update",$result);
        $resultPhoto->deleted = true;
        $resultPhoto->save();
    }
}
