<?php

class PhotoController extends \BaseController {

        protected   $photo;
        public function __construct(Photo $photo) {
            $this->photo = $photo;
        }
    
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
            if ($this->photo->isValid($input)) {
                $mime = $input['file']->getMimeType();
                $fileName = time() . "." . strtolower($input['file']->getClientOriginalExtension());

                $image = Image::make($input['file']->getRealPath());
                $this->upload_s3($image, $fileName, $mime, "high");
                $image->resize(400, 300);
                $this->upload_s3($image, $fileName, $mime, "low");

                Photo::create([
                    'title' => Input::get('title'),
                    'file' => $fileName,
                ]);
                Session::flash('exito', 'La foto se ha subido con éxito');
                return Redirect::route('photo.index');
            } else {
                Session::flash('error', 'Se ha producido un error al subir la imagen');
                return Redirect::back()->withInput()->withErrors($this->photo->messages);
            }
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
            $this->_data['photo'] = Photo::find($id);
            return View::make('photo.edit', $this->_data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
            //Get Input
            $input = Input::all();
            if ($this->photo->isValid($input)) {
                $mime = $input['file']->getMimeType();
                $fileName = time() . "." . strtolower($input['file']->getClientOriginalExtension());

                $photo = Photo::find($id);
                $photo->title = Input::get('title');

                //Delete Old from Bucket
                $s3 = AWS::get('s3');
                $s3->deleteObject(array('Bucket' => 'images.jacksonlive.es','Key' => "test/high/{$photo->file}"));
                $s3->deleteObject(array('Bucket' => 'images.jacksonlive.es','Key' => "test/low/{$photo->file}"));

                //Upload new files
                $image = Image::make($input['file']->getRealPath());
                $this->upload_s3($image, $fileName, $mime, "high");
                $image->resize(400, 300);
                $this->upload_s3($image, $fileName, $mime, "low");

                $photo->file = $fileName;
                $photo->save();

                return Redirect::route('photo.index');
            } else {
                Session::flash('error', 'Se ha producido un error al editar la imagen');
                return Redirect::back()->withInput()->withErrors($this->photo->messages);
            }
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
            
            //Delete object from S3 Bucket
            $s3 = AWS::get('s3');
            $s3->deleteObject(array('Bucket' => 'images.jacksonlive.es','Key' => "test/high/{$photo->file}"));
            $s3->deleteObject(array('Bucket' => 'images.jacksonlive.es','Key' => "test/low/{$photo->file}"));
                
            $photo->delete();
            return Redirect::route('photo.index');
	}
        
        private function upload_s3($image, $fileName, $mime, $folder) {
            $s3 = AWS::get('s3');
            $s3->putObject(array(
                'Bucket'     => 'images.jacksonlive.es',
                'Key'        => "test/{$folder}/{$fileName}",
                'Body'       => "$image",
                'ACL'        => 'public-read',
                'ContentType' => $mime,
            ));
        }


        private $_data = array();
        private $path = "img/upload/";
}
