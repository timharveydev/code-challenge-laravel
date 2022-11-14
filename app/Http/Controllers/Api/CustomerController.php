<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\Policy;
use App\Models\Insurer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Return a listing of all Customers if no search term provided.
     * If search term is provided, return filtered collection of customers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->searchTerm) {
            // Return all Customers via the CustomerResource
            return CustomerResource::collection(Customer::all());
        } else {
            // Return only Customers matching search term
            return CustomerResource::collection(

                Customer::where('name', 'LIKE', '%' . $request->searchTerm . '%')
                    ->orWhereHas('policy', function ($query) use ($request) {
                        $query->where('name', 'LIKE', '%' . $request->searchTerm . '%');
                    })
                    ->orWhereHas('insurer', function ($query) use ($request) {
                        $query->where('name', 'LIKE', '%' . $request->searchTerm . '%');
                    })
                    ->get()

            );
        }
    }


    /**
     * Return an individual Customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Return Customer via the CustomerResource
        return new CustomerResource(Customer::findOrFail($id));
    }


    /**
     * Store a newly created Customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        // Store new Customer after successful validation of request
        $newCustomer = Customer::create($request->validated());

        // Store new Policy with associated customer_id foreign key
        Policy::create([
            'name' => $request->validated()['policy'],
            'customer_id' => $newCustomer->id
        ]);
        
        // Store new Insurer with associated customer_id foreign key
        Insurer::create([
            'name' => $request->validated()['insurer'],
            'customer_id' => $newCustomer->id
        ]);

        // Return success message
        return response()->json('Customer created');
    }


    /**
     * Update an existing Customer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCustomerRequest $request, $id)
    {
        // Get the relevant Customer, Policy and Insurer to be updated
        $customer = Customer::findOrFail($id);
        $policy = Policy::where('customer_id', $id);
        $insurer = Insurer::where('customer_id', $id);
        
        // Update the Customer using the validated request
        $customer->update($request->validated());

        // Update the associated Policy
        $policy->update([
            'name' => $request->validated()['policy'],
            'customer_id' => $id
        ]);

        // Update the associated Insurer
        $insurer->update([
            'name' => $request->validated()['insurer'],
            'customer_id' => $id
        ]);

        // Return success message
        return response()->json('Customer updated');
    }
}
