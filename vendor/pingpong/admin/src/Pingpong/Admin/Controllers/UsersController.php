<?php namespace Pingpong\Admin\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Pingpong\Admin\Repositories\Users\UserRepository;
use Pingpong\Admin\Validation\User\Create;
use Pingpong\Admin\Validation\User\Update;
use Illuminate\Http\Request;

use DB;

use Datetime;
class UsersController extends BaseController
{

    /**
     * @var \User
     */
    protected $users;

    /**
     * @param \User $users
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return $this->redirect('users.index');
    }

    /**
     * Display a listing of users
     *
     * @return Response
     */
    public function index(Request $request)
    {
		$data = $request->all();
		$conditionsArr = array();
	
		if(@count($data)>0 && isset($data['search'])){

			$search = $data['search'];	
			
			$query = "SELECT users.id  FROM users INNER JOIN role_user ON role_user.user_id = users.id    ";

			$joinQuery ='';
			$filter = ' where role_user.role_id= 2  ';

		
			if($search){
				$search = "%$search%";
				$filter .= " and (users.fname like '".$search."'  or users.lname like '".$search."' or users.email like '".$search."') ";
			}

			$query = $query.$joinQuery.$filter;

			$usersListdata = DB::select($query);
		
			$usersList =array();		
			foreach ($usersListdata as $value) {
	    		$usersList[] = $value->id;
			}
				
		
		  	$users = DB::table('role_user')
					->select(array('users.*'))
					->join('users', 'role_user.user_id', '=', 'users.id')	
					->where('role_id','2')
					->whereIn('role_user.user_id',$usersList)
					->orderBy('users.last_logged_in', 'DESC')
					->orderBy('users.fname','ASC')
					->paginate(config('admin.user.perpage'));
			
		}else{
				$users = DB::table('role_user')
						->select(array('users.*'))
						->join('users', 'role_user.user_id', '=', 'users.id')	
						->where('role_id','2')
						->paginate(config('admin.user.perpage'));
		}
		
		$no = $users->firstItem();
        return $this->view('users.index', compact('users', 'no'));
    }



    /**
     * Show the form for creating a new user
     *
     * @return Response
     */
    public function create()
    {
    
        return $this->view('users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @return Response
     */
    public function store(Create $request)
    {
        $data = $request->all();
		
        $user = $this->repository->create($data);

        $user->addRole($request->get('role'));

        return $this->redirect('users.index');
    }

    /**
     * Display the specified user.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $user = $this->repository->findById($id);
            return $this->view('users.show', compact('user'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }



  
	

    /**
     * Show the form for editing the specified user.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        try {

            $user = $this->repository->findById($id);
			
			
            $role = $user->roles->lists('id');
			
            return $this->view('users.edit', compact('user', 'role'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified user in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Update $request, $id)
    {

        try {
				
			
            $data = ! $request->has('password') ? $request->except('password') : $this->inputAll();
            
            $user = $this->repository->findById($id);
         
            $user->update($data);

            $user->roles()->sync((array) \Input::get('role'));
			
			if($id =='1'){
				return $this->redirect('home');
			}		
            return $this->redirect('users.index');

        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
			
            $this->repository->delete($id);

            return $this->redirect('users.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
		public function changeOrderForUniversityOthersOption($listOfUni, $isTop)
    {
        $others = array_search('Others', $listOfUni);
        // remove others from the array
        unset($listOfUni[$others]);
        if ($isTop) {
            // put others option at the top of the array
            $first = array();
            $first[$others] = "Others";
            $listOfUni = $first + $listOfUni;
        } else {
            // put others at the end of the array
            $listOfUni[$others] = "Others";
        }
        return $listOfUni;
    }


	
}
