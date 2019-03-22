<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Shipping;

class ShippingController extends Controller {

    /**
     * Show the form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('shipping.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = NULL) {
        $message = NULL;
        $data = NULL;
        $status = 'success';

        if (empty($id)) {
            $data = Shipping::orderBy('ship_name')->get();
        } else {
            $data = Shipping::findOrFail($id);
        }

        return response()->json(array(
                    'status' => $status,
                    'data' => $data,
                    'message' => $message
        ));
    }

    /**
     * Save the resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, $id = NULL) {
        $message = NULL;
        $data = NULL;
        $status = 'failed';

        if ($request->hasFile('ship_image')) {
            $validatedData = Validator::make($request->all(), [
                        'ship_name' => 'required|max:200',
                        'ship_description' => 'required|max:200',
                        'ship_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
        } else {
            $validatedData = Validator::make($request->all(), [
                        'ship_name' => 'required|max:200',
                        'ship_description' => 'required|max:200',
                        'ship_image' => 'nullable'
            ]);
        }

        if ($validatedData->passes()) {
            $req = $request->except(['_token']);

            if ($request->hasFile('ship_image')) {
                $req['ship_image'] = $request->file('ship_image')->store('public/files');
            }

            if (empty($id)) {
                Shipping::create($req);
                $status = 'success';
                $message = 'Shipping has been successfully saved';
            } else {
                Shipping::where('ship_id', $id)->update($req);
                $status = 'success';
                $message = 'Shipping has been successfully updated';
            }
        } else {
            $message = implode('<br>', $validatedData->errors()->all());
        }

        return response()->json(array(
                    'status' => $status,
                    'data' => $data,
                    'message' => $message
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function drop($id = NULL) {
        $message = NULL;
        $data = NULL;
        $status = 'failed';

        if (empty($id)) {
            $message = 'ID is required';
        } else {
            Shipping::findOrFail($id)->delete();

            $status = 'success';
            $message = 'Shipping has been successfully deleted';
        }

        return response()->json(array(
                    'status' => $status,
                    'data' => $data,
                    'message' => $message
        ));
    }

}
