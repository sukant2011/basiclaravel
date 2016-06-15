<?php namespace Pingpong\Admin\Validation\University;

use Pingpong\Admin\Validation\Validator;
use Illuminate\Support\Facades\Request;

class Update extends Validator
{

    public function rules()
    {
        return [
            'tab'=>'required',
			'universityName' => 'required_if:tab,1',
            'country' => 'required_if:tab,1',
          /*   'Overview' =>'required_if:tab,1',

			
            'Transportation' => 'required_if:tab,2',
            'BankingServices' => 'required_if:tab,2',
            'postoffice' => 'required_if:tab,2',
            'medicalservices' => 'required_if:tab,2',
            'Telecommunications' => 'required_if:tab,2',
            'SurvivalGuide' => 'required_if:tab,2',
			
            'Consolidated' => 'required_if:tab,3',
			
            'Airlines' => 'required_if:tab,4',
            'Accommodation' => 'required_if:tab,5',
            'visa' => 'required_if:tab,6',
            'TravelInsurance' => 'required_if:tab,7',
            'Packing' => 'required_if:tab,8', */

			
			
        ];
    }
}
