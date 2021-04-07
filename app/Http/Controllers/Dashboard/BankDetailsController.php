<?php


namespace App\Http\Controllers\Dashboard;

use App\AdminBankDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

            $categories = AdminBankDetails::when($request->search, function ($q) use ($request) {

                return $q->where('bank_name', 'like', '%' . $request->search . '%')
                    ->orWhere('iban', 'like', '%' . $request->search . '%');
            })->latest()->paginate(8);


            return view('dashboard.bankdetails.index', compact('categories'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.bankdetails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'bank_name' => 'required',
            'iban' => 'required',
        ];

        $request->validate($rules);

        $request_data = $request->all();
        AdminBankDetails::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.banks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = AdminBankDetails::where('id',$id)->first();
        return view('dashboard.bankdetails.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {


        $rules = [
            'bank_name' => 'required',
            'iban' => 'required',
        ];

        $request->validate($rules);
        $request_data['bank_name']= $request->bank_name;
        $request_data['iban']= $request->iban;
        AdminBankDetails::where('id',$id)->update( $request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.banks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AdminBankDetails::where('id',$id)->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.banks.index');
    }
}
