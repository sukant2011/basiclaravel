<?php namespace Pingpong\Admin\Controllers;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Pingpong\Admin\Repositories\UniversityRepository;
use App\University;
use Pingpong\Admin\Entities\UniversityContent;
use App\City;
use App\Country;
use Pingpong\Admin\Validation\University\Create;
use Pingpong\Admin\Validation\University\Update;
use Pingpong\Admin\Uploader\ImageUploader;
use Illuminate\Http\Request;
class UniversitiesController extends BaseController
{

    protected $universities;

   

    /**
     * @param ImageUploader $uploader
     */
    public function __construct(ImageUploader $uploader)
    {
        $this->uploader = $uploader;
        $this->repository = $this->getRepository();
    }

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository()
    {
        
         $repository = 'Pingpong\Admin\Repositories\Universities\UniversityRepository';
     
		
        return app($repository);
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return $this->redirect(isOnPages() ? 'universities.index' : 'universities.index')
            ->withFlashMessage('Post not found!')
            ->withFlashType('danger');
    }

    /**
     * Display a listing of articles
     *
     * @return Response
     */
    public function index()
    {
		
        $universities = $this->repository->allOrSearch(Input::get('search'));
		//echo '<pre>';print_r($universities);die;
        $no = $universities->firstItem();
		
        return $this->view('universities.index', compact('universities', 'no'));
    }
	
	/**
     * Show the form for creating a new article
     *
     * @return Response
     */
    public function create()
    {
		$countryList = Country::orderBy('countryName')->lists('countryName', 'countryID');
		//print_r($countryList);exit;
        return $this->view('universities.create',compact('countryList'));
    }

    /**
     * Store a newly created article in storage.
     *
     * @return Response
     */
    public function store(Create $request)
    {
		$data = $request->all();
        
        unset($data['image']);

        if (\Input::hasFile('image')) {
            // upload image
            $this->uploader->upload('image')->save('images/universities');

            $data['image'] = $this->uploader->getFilename();
        }

        $data['user_id'] = \Auth::id();
        $data['slug'] = Str::slug($data['title']);

        $this->repository->create($data);
		
        return $this->redirect(isOnPages() ? 'universities.index' : 'universities.index');
    }

    /**
     * Display the specified article.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $university = $this->repository->findById($id);

            return $this->view('universities.show', compact('university'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
		$countryList = Country::orderBy('countryName')->lists('countryName', 'countryID');
	
        try {
            $university = $this->repository->findById($id);
			$cityData = City::where('id','=',$university->cityID)->first();
			//echo '<pre>';print_r($cityData);die;
            return $this->view('universities.edit', compact('university','countryList','cityData'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified article in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Update $request, $id)
    {
        
		try {
            
			$university = $this->repository->findById($id);
				
            $data = $request->all();
		
			if($data['tab']==1){
						unset($data['image']);
						unset($data['banner_image']);
						unset($data['type']);
					
						if (\Input::hasFile('image')) {
						   //$university->deleteImage();

							$this->uploader->upload('image')->save('images/universities/',true);
							
								
							$UniVData['image'] = $this->uploader->getFilename();
							
						}
						if (\Input::hasFile('banner_image')) {
						   //$university->deleteImage();

							$this->uploader->upload('banner_image')->save('images/banner/',false);
								
							$UniVData['banner_image'] = $this->uploader->getFilename();
							
						}
						
						$isCityExist = City::where('cityName', 'like', '%' . $data['cityName'] . '%')->where('countryID', '=', $data['country'] )->first();
						
						$cityIdToUpdate='';
						
						//echo '<pre>';print_r($isCityExist);die;
						if (empty($isCityExist)) {
							$newCity = ['cityName' => $data['cityName'], 'countryID' => $data['country']];
							$citycreated=City::create($newCity);
							$cityIdToUpdate=$citycreated->id;
						}else{
							$cityIdToUpdate=$isCityExist->id;
						}
						//echo $cityIdToUpdate;exit;
						$cityData = City::where('id','=',$cityIdToUpdate)->first();
						//echo '<pre>';print_r($cityData);die;
						
						$updateData['countryID'] = $data['country'];
						$UniVData['cityID'] = $cityIdToUpdate;
						
						$UniVData['Overview'] = $data['Overview'];
						$UniVData['Academics'] = $data['Academics'];
						$UniVData['MyCampus'] = $data['MyCampus'];
						$UniVData['Studentlife'] = $data['Studentlife'];
						$UniVData['Surrounding'] = $data['Surrounding'];
						$UniVData['Accessibility'] = $data['Accessibility'];
						$UniVData['universityName'] = $data['universityName'];
					
					
						$cityData->update($updateData);
						$university->update($UniVData);
				
				
			}elseif($data['tab']==2){
				
				$universityDetail = UniversityContent::where('universityId',$id)->first();
				
				$content['universityId']=$id;
				$content['Transportation'] = $data['Transportation'];
				$content['BankingServices'] = $data['BankingServices'];
				$content['postoffice'] = $data['postoffice'];
				$content['medicalservices'] = $data['medicalservices'];
				$content['Telecommunications'] = $data['Telecommunications'];
				$content['SurvivalGuide'] = $data['SurvivalGuide'];
				
				if(@$universityDetail->id){
					$universityDetail->update($content);
				}else{
					UniversityContent::create($content);
				}
				
				
				
				
				
			}elseif($data['tab']==3){
				
				$UniVData['Consolidated'] = $data['Consolidated'];
				
				$university->update($UniVData);
				
			}elseif($data['tab']==4){
				$UniVData['Airlines'] = $data['Airlines'];
				
				$university->update($UniVData);
			}elseif($data['tab']==5){
				$UniVData['Accommodation'] = $data['Accommodation'];
				
				$university->update($UniVData);
			}elseif($data['tab']==6){
				$UniVData['visa'] = $data['visa'];
				
				$university->update($UniVData);
			}elseif($data['tab']==7){
				$UniVData['TravelInsurance'] = $data['TravelInsurance'];
				$university->update($UniVData);
			}elseif($data['tab']==8){
				if (Input::hasFile('Packing'))
				{	
					$file = Input::file('Packing');
					
					$destinationPath = 'public/download'; // upload path
					$name = $file->getClientOriginalName(); // getting original name
					$extension = $file->getClientOriginalExtension(); // getting fileextension
					$fileName = time().rand(11111, 99999) . '.' . $extension; // renaming image
					$file->move($destinationPath,$fileName); // uploading file to given path
					//$this->uploader->upload('banner_image')->save('images/banner/',false);
					$UniVData['Packing'] = $fileName;
				
					
				}
				$UniVData['pck_cntn'] = $data['pck_cntn'];
				$university->update($UniVData);
			}
            return $this->redirect(isOnPages() ? 'universities.index' : 'universities.index');
			
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return $this->redirect(isOnPages() ? 'universities.index' : 'universities.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
	/*public function addUniversity(Request $request){
		print_r($request->all());
	}*/
    
}
