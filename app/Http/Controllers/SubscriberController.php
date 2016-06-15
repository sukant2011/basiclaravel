<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Subscriber;
use App\Http\Requests\SubscriberFormRequest;
use League\Flysystem\Exception;
use Illuminate\Database\QueryException;

class SubscriberController extends Controller
{
    private $subscriber;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SubscriberFormRequest $request)
    {
        
            $email = $request->email;
            $newSubscriber = Subscriber::findOrNew($email);
            
			if($newSubscriber->email=='') {
				$newSubscriber->email = $email;
				if ($newSubscriber->save()) {
                if ($request->ajax() || $request->wantsJson()) {
                    return json_encode(array('success' => true, 'data' => 'Stay tuned for more updates!'));
                } 
				}else{
					return json_encode(array('success' => false, 'data' => 'This email is already a subscriber!'));
				} 
			}else {
				return json_encode(array('error' => false, 'data' => 'You have already subscribed with us!'));
			}
            
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
