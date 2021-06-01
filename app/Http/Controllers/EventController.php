<?php

namespace App\Http\Controllers;

use App\Models\event;
use Illuminate\Http\Request;
use DB;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = event::paginate(5);
        return view('eventhome',compact('events'));
            
    }

    /**
     * Show the form for creating a new resource.   
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eventCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

         $validatedData = $request->validate([
                'title' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif',
                'descp' => 'required',
                'start' => 'required',
                'end' => 'required|max:20',
                'location' => 'required'

                 ]);
        $createEvent = new event;
        $createEvent->event_title = $request->title;

        $name = $request->file('image');
        $imageName = 'IMG'.time().'.'.$name->getClientOriginalExtension();
        $request->image->move('uploads', $imageName);
        

        $target = 'uploads/'.$imageName;

        $watermark_path = 'watermark/electron.png';
        
        switch ($name->getClientOriginalExtension()) {
          case "jpg":
            $dstsrc_img = imagecreatefromjpeg($target);
            break;
          case "jpeg":
            $dstsrc_img = imagecreatefromjpeg($target);
            break;
          case "png":
            $dstsrc_img = imagecreatefrompng($target);
            break;
          case "gif":
            $dstsrc_img = imagecreatefromgif($target);
            break;
          case "jfif":
            $dstsrc_img = imagecreatefromjpeg($target);
            break;
          default:
            echo "error";
            break;
        }

        $src_stamp = imagecreatefrompng($watermark_path);

        $marge_right = 250; // image marigin point for right
        $marge_bottom = 250; // image marigin point for bottom 

        $sx = imagesx($src_stamp); // source img width 
        //echo $sx."<br>";
        $sy = imagesy($src_stamp);  // source img height
        //echo $sy."<br>";

        $dx = imagesx($dstsrc_img); // destination img width 
        //echo $dx."<br>";
        $dy = imagesy($dstsrc_img);  // destination img height
        //echo $dy."<br>";

        $x_position = $dx - $sx - $marge_right; // destination x axis point for source(water mark) image
        // echo $x_position."<br>";
        $y_position = $dy - $sy - $marge_bottom;

        imagecopy($dstsrc_img, $src_stamp, $x_position, $y_position, 0, 0, $sx, $sy); //merging source and destination images.

        // $imgname = time().".png";
        // echo $imgname;
        //header('Content-type: image/png');
        imagepng($dstsrc_img,$target);
        //imagepng($dst_img);
        //imagedestroy($dst_img);


        $thumbWidth=100;

        //echo $imagefile_type;

        $orgWidth = imagesx($dstsrc_img);
        $orgHeight = imagesy($dstsrc_img);
        $thumbHeight = floor($orgHeight * ($thumbWidth / $orgWidth));
        $destImage = imagecreatetruecolor($thumbWidth, $thumbHeight);
        imagecopyresampled($destImage, $dstsrc_img, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $orgWidth, $orgHeight);

        // $imgname1 = time().".".$imagefile_type;
        imagejpeg($destImage, "thumbimg/".$imageName);
        imagedestroy($dstsrc_img);
        imagedestroy($destImage);

        $createEvent->event_image = $imageName;
        $createEvent->event_description = $request->descp;
        $createEvent->event_start = $request->start;
        $createEvent->event_end = $request->end;
        $createEvent->event_location = $request->location;
        $createEvent->save();

        

        return redirect('home')->with('message','Event created sucessfully');
        // return redirect()->route('event.index')->with('message','Event created sucessfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
         $getdatas = event::where('id', $id)->first();
          //dd($getdatas);
         return view('eventEdit', compact('getdatas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
                'title' => 'required',
                'descp' => 'required',
                'start' => 'required',
                'end' => 'required|max:20',
                'location' => 'required'

                 ]);

        $data = [
           'event_title' =>$request->title,
           'event_start' =>$request->start,
           'event_end' =>$request->end,
           'event_location' =>$request->location,
           'event_description' =>$request->descp
        ];

         if($request->hasFile('image'))
        {
             $name = $request->file('image');
            $imageName = 'IMG'.time().'.'.$name->getClientOriginalExtension();

             $data['event_image']=$imageName;

             $target = 'uploads/'.$imageName;
       
        }

        $update= event::where('id', $id)->update($data);

        if($update && $request->hasFile('image'))
        {
                $name->move('uploads', $imageName);

                $watermark_path = 'watermark/electron.png';
        
            switch ($name->getClientOriginalExtension()) {
              case "jpg":
                $dstsrc_img = imagecreatefromjpeg($target);
                break;
              case "jpeg":
                $dstsrc_img = imagecreatefromjpeg($target);
                break;
              case "png":
                $dstsrc_img = imagecreatefrompng($target);
                break;
              case "gif":
                $dstsrc_img = imagecreatefromgif($target);
                break;
              case "jfif":
                $dstsrc_img = imagecreatefromjpeg($target);
                break;
              default:
                echo "error";
                break;
            }

            $src_stamp = imagecreatefrompng($watermark_path);

            $marge_right = 250; // image marigin point for right
            $marge_bottom = 250; // image marigin point for bottom 

            $sx = imagesx($src_stamp); // source img width 
            //echo $sx."<br>";
            $sy = imagesy($src_stamp);  // source img height
            //echo $sy."<br>";

            $dx = imagesx($dstsrc_img); // destination img width 
            //echo $dx."<br>";
            $dy = imagesy($dstsrc_img);  // destination img height
            //echo $dy."<br>";

            $x_position = $dx - $sx - $marge_right; // destination x axis point for source(water mark) image
            // echo $x_position."<br>";
            $y_position = $dy - $sy - $marge_bottom;

            imagecopy($dstsrc_img, $src_stamp, $x_position, $y_position, 0, 0, $sx, $sy); //merging source and destination images.

            // $imgname = time().".png";
            // echo $imgname;
            //header('Content-type: image/png');
            imagepng($dstsrc_img,$target);
            //imagepng($dst_img);
            //imagedestroy($dst_img);


            $thumbWidth=100;

            //echo $imagefile_type;

            $orgWidth = imagesx($dstsrc_img);
            $orgHeight = imagesy($dstsrc_img);
            $thumbHeight = floor($orgHeight * ($thumbWidth / $orgWidth));
            $destImage = imagecreatetruecolor($thumbWidth, $thumbHeight);
            imagecopyresampled($destImage, $dstsrc_img, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $orgWidth, $orgHeight);

            // $imgname1 = time().".".$imagefile_type;
            imagejpeg($destImage, "thumbimg/".$imageName);
            imagedestroy($dstsrc_img);
            imagedestroy($destImage);

            
        }

        return redirect('home')->with('message','Event Updated sucessfully');

    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        event::where('id', $id)->delete();
        return redirect('home')->with('message','Event Deleted sucessfully');
    }
}
