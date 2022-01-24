<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Rinvex\Attributes\Support\ValueCollection;
use Rinvex\Attributes\Models\Attribute;
use Validator;
use DB;

class CustomerController extends Controller
{
	//Insert
    public function insertCustomer(Request $request){
    	$rules = array(
			'first_name' => 'required',
			'last_name' => 'required',
			'age' => 'required',
			'gender' => 'required',
			'address' => 'required',
			'birthdate' => 'required',
		);

		$messages = array(
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'age' => 'age',
			'gender' => 'gender',
			'address' => 'address',
			'birthdate' => 'Date Of Birth',
		);
		$validator = Validator::make(request()->all(), $rules, $messages);
		if ($validator->fails()) {
			return response()->json(
				[
					'status_message' => $validator->messages()->first(),
					'status_code' => '0',
				]
			);
		} 

		$attributes = DB::table('attribute_entity')->orderBy('attribute_id', 'asc')->get();
		$customers = array();
		foreach ($attributes as $attribute) {
			$attributeEntity = DB::table('attribute_varchar_values')->where('entity_id', $attribute->attribute_id)->first();
			if(!$attributeEntity){
				$customer = Customer::find($attribute->attribute_id);
				$customer->first_name = $request->first_name;
				$customer->last_name = $request->last_name;
				$customer->age = $request->age;
				$customer->gender = $request->gender;
				$customer->address = $request->address;
				$customer->birthdate = $request->birthdate;
				if($customer->save()){
					$customers = $this->getCustomer();
				}
				return response()->json(['status_code'=> '1', 'status_message'=> 'Success', 'data'=> $customers]);
				break;
			}
		}

		$customers = $this->getCustomer();
		return response()->json(['status_code'=> '1', 'status_message'=> 'Success', 'data'=> $customers]);
    	
    }


    public function showCustomer(Request $request){

    	$customers = $this->getCustomer();

    	return response()->json(['status_code' => '1','status_message' => 'Success', 'data' => $customers]);
    }
    //Delete
    public function deleteCustomer(Request $request){
    	DB::table('attribute_boolean_values')->where('entity_id', $request->entity_id)->delete();
    	DB::table('attribute_datetime_values')->where('entity_id', $request->entity_id)->delete();
    	DB::table('attribute_integer_values')->where('entity_id', $request->entity_id)->delete();
    	DB::table('attribute_text_values')->where('entity_id', $request->entity_id)->delete();
    	DB::table('attribute_varchar_values')->where('entity_id', $request->entity_id)->delete();

    	$customers = $this->getCustomer();

    	return response()->json(['status_code' => '1','status_message' => 'Success Delete', 'data' => $customers]);
    }


    public function getCustomerDetails(Request $request){
    	$customerData = Customer::find($request->entity_id);
    	$customer = array(
    			'id' => $customerData->id,
    			'first_name' => $customerData->first_name[0],
    			'last_name' => $customerData->last_name[0],
    			'age' => $customerData->age[0],
    			'gender' => $customerData->gender[0] == true ? "Male" : "Female",
    			'address' => $customerData->address[0],
    			'bod' => $customerData->birthdate[0]->format('Y-m-d'),
    		);

    	return response()->json(['status_code'=> '1', 'status_message'=> 'Success', 'data' => $customer]);

    }
    public function getCustomer(){
    	$customers = Customer::all();
    	$customerArray = [];
    	foreach ($customers as $customer) {
    		if(isset($customer->first_name[0])){
    			$customer = array(
	    			'id' => $customer->id,
	    			'first_name' => $customer->first_name[0],
	    			'last_name' => $customer->last_name[0],
	    			'age' => $customer->age[0],
	    			'gender' => $customer->gender[0] ? "Male" : "Female",
	    			'address' => $customer->address[0],
	    			'bod' => $customer->birthdate[0]->format('Y-m-d'),
	    		);
	    		array_push($customerArray, $customer);
    		}
    	}
    	return $customerArray;
    }

    //update
    public function updateCustomer(Request $request){
    	$rules = array(
			'first_name' => 'required',
			'last_name' => 'required',
			'age' => 'required',
			'gender' => 'required',
			'address' => 'required',
			'birthdate' => 'required',
		);

		$messages = array(
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'age' => 'age',
			'gender' => 'gender',
			'address' => 'address',
			'birthdate' => 'Date Of Birth',
		);
		$validator = Validator::make(request()->all(), $rules, $messages);
		if ($validator->fails()) {
			return response()->json(
				[
					'status_message' => $validator->messages()->first(),
					'status_code' => '0',
				]
			);
		} 
		DB::table('attribute_boolean_values')->where('entity_id', $request->entity_id)->delete();
    	DB::table('attribute_datetime_values')->where('entity_id', $request->entity_id)->delete();
    	DB::table('attribute_integer_values')->where('entity_id', $request->entity_id)->delete();
    	DB::table('attribute_text_values')->where('entity_id', $request->entity_id)->delete();
    	DB::table('attribute_varchar_values')->where('entity_id', $request->entity_id)->delete();

		$customer = Customer::find($request->entity_id);
		$customer->first_name = $request->first_name;
		$customer->last_name = $request->last_name;
		$customer->age = $request->age;
		$customer->gender = $request->gender;
		$customer->address = $request->address;
		$customer->birthdate = $request->birthdate;
		$customer->save();

		$customers = $this->getCustomer();
		return response()->json(['status_code'=> '1', 'status_message'=> 'Update Success', 'data' => $customers]);
    }


    public function test(Request $request){
  //   	app('rinvex.attributes.attribute')->create([
		//     'slug' => 'first_name',
		//     'type' => 'varchar',
		//     'name' => 'First Name',
		//     'entities' => ['App\Models\Customer'],
		// ]);
		// app('rinvex.attributes.attribute')->create([
		//     'slug' => 'last_name',
		//     'type' => 'varchar',
		//     'name' => 'Last Name',
		//     'entities' => ['App\Models\Customer'],
		// ]);
		// app('rinvex.attributes.attribute')->create([
		//     'slug' => 'Age',
		//     'type' => 'varchar',
		//     'name' => 'Age',
		//     'entities' => ['App\Models\Customer'],
		// ]);
		// $attributes = Customer::find(1);
		// $attributes->first_name = 'Alvin';
		// $attributes->last_name = 'Ebacuado';
		// $attributes->age = '15';
		// $attributes->save();
		// $attributes->fill([
		//     'entities' => ['App\Models\Customer'],
		// ])->save();
		// foreach ($attributes as $attribute) {
		// 	// dd($attribute);
		// 	dd($attribute->id);
		// 	// $attributes = Customer::find();
		// 	// $attribute->first_name = ''
		// }



		$attributes = Customer::find(16);
		$attributes->first_name = 'Alvineee';
		$attributes->last_name = 'Ebacuadoerere';
		$attributes->age = 24;
		$attributes->gender = 1;
		$attributes->address = 'Valenzuela City';
		$attributes->save();


		// $attribute->fill(['first_name' => '12345','last_name' => 'testing123','age' => '1231', ])->save();
  //   	$attribute = Customer::find(3);
  //   	$attribute->delete();


  //   	// $attribute = new Customer;
  //   	$attribute->first_name = "ebacuado2";
  //   	$attribute->save();

  //   	$customer = Customer::find(16);
  //   	$customer->last_name = 'ererererere22222123';
		// $customer->save();



		// $customer2 = Customer::whereHas('first_name', function (\Illuminate\Database\Eloquent\Builder $builder) {
		//     $builder->where('content', 'ebacuado2');
		// })->get();

  //   	$customer =  new Customer;
  //   	$customer->first_name = 'Alvin';
		// $customer->save();

    	// Customer::fill(['first_name' => 'test2'])->save();
    	// $values = $attribute->values('varchar')->get();
    	// $collection = $attribute->entities;

    	// $entities = $attribute->entities();

    	// $attribute->entities()->createMany([]);


     //    Attribute::typeMap([
     //        'varchar' => \Rinvex\Attributes\Models\Type\Varchar::class,
     //        'boolean' => \Rinvex\Attributes\Models\Type\Boolean::class,
     //        'integer' => \Rinvex\Attributes\Models\Type\Integer::class,
     //        'text' => \Rinvex\Attributes\Models\Type\Text::class,
     //    ]);
    	// 	$values = $attribute->values('varchar')->get();


    	// $product = \App\Models\Customer::find(1);
		return response()->json([$attributes]);
    }
}
