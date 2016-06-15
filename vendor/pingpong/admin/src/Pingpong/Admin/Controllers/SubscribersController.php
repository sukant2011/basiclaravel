<?php namespace Pingpong\Admin\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Pingpong\Admin\Repositories\SubscriberRepository;



class SubscribersController extends BaseController
{

    protected $subscribers;

   

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
        
         $repository = 'Pingpong\Admin\Repositories\Subscribers\SubscriberRepository';
     
		
        return app($repository);
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return $this->redirect(isOnPages() ? 'subscribers.index' : 'subscribers.index')
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
		
        $subscribers = $this->repository->allOrSearch(Input::get('search'));
		//echo '<pre>';print_r($articles);die;
        $no = $subscribers->firstItem();
		
        return $this->view('subscribers.index', compact('subscribers', 'no'));
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

            return $this->redirect(isOnPages() ? 'subscribers.index' : 'subscribers.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
    
}
