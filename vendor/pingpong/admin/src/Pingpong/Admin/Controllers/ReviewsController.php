<?php namespace Pingpong\Admin\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Pingpong\Admin\Repositories\ReviewRepository;



class ReviewsController extends BaseController
{

    protected $reviews;

   

    /**
     * @param ImageUploader $uploader
     */
    public function __construct()
    {
        
        $this->repository = $this->getRepository();
    }

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository()
    {
        
         $repository = 'Pingpong\Admin\Repositories\Reviews\ReviewRepository';
     
		
        return app($repository);
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return $this->redirect(isOnPages() ? 'reviews.index' : 'reviews.index')
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
		
        $reviews = $this->repository->allOrSearch(Input::get('search'));
		//echo '<pre>';print_r($articles);die;
        $no = $reviews->firstItem();
		
        return $this->view('reviews.index', compact('reviews', 'no'));
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

            return $this->redirect(isOnPages() ? 'reviews.index' : 'reviews.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
    
}
