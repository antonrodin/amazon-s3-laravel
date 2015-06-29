<?php

class PhotoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $this->_data['photos'] = Photo::all();
            return View::make('photo.index', $this->_data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return View::make('photo.create', $this->_data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            
            $input = Input::all();
            $fileName = time() . "." . strtolower($input['foto']->getClientOriginalExtension());
            $image = Image::make($input['foto']->getRealPath());
            $image->save($this->path . $fileName)
                    ->resize(400, 300)
                    ->save($this->path . 'low-' . $fileName);
            
            $mime = $input['foto']->getMimeType();;
            
            //Upload to Amazon
            $s3 = AWS::get('s3');
            $s3->putObject(array(
                'Bucket'     => 'images.jacksonlive.es',
                'Key'        => "test/high/$fileName",
                'Body'       => "$image",
                'ACL'        => 'public-read',
                'ContentType' => $mime,
            ));
            
            Photo::create([
                'title' => Input::get('title'),
                'file' => $fileName,
            ]);
            return Redirect::route('photo.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            $photo = Photo::find($id);
            $photo->delete();
            return Redirect::route('photo.index');
	}


        private $_data = array();
        private $path = "img/upload/";
}
