<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all()->toArray();
        return view('admin.country.country',  compact('countries'));
    }

    public function create()
    {

        return view('admin.country.add');
    }

    //Lưu country mới vào database
    public function store(CountryRequest $request)
    {
        $data = $request->all();
        if (Country::create($data)) {
            return redirect('/country')->with('success', 'Add a country successfully');
        } else {
            return back()
                ->with('error', 'Có lỗi!');
        }
    }

    // Hiển thị form edit
    public function edit($id)
    {
        $country = Country::where('id_country', $id)->get()->toArray();
        return view('admin.country.edit', compact('country'));
    }

    public function update(CountryRequest $request, $id)
    {
        $country = Country::findOrFail($id);
        $country->name = $request->name;
        $country->save();
        return redirect('/country')->with('success', 'Updated successfully!');
    }

    public function destroy($id)
    {
        $country = Country::where('id_country', $id)->delete();
        return redirect('country')->with('success', 'Country has been deleted successfully!');
    }
}
