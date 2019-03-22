<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Payments;

class PaymentsController extends Controller {

    /**
     * Show the form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('payments.index');
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
            $data = Payments::orderBy('pay_name')->get();
        } else {
            $data = Payments::findOrFail($id);
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

        $validatedData = Validator::make($request->all(), [
                    'pay_name' => 'required|max:200',
                    'pay_description' => 'required|max:200'
        ]);

        if ($validatedData->passes()) {
            $req = $request->except(['_token']);

            if (empty($id)) {
                Payments::create($req);
                $status = 'success';
                $message = 'Payment has been successfully saved';
            } else {
                Payments::where('pay_id', $id)->update($req);
                $status = 'success';
                $message = 'Payment has been successfully updated';
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
            Payments::findOrFail($id)->delete();

            $status = 'success';
            $message = 'Payment has been successfully deleted';
        }

        return response()->json(array(
                    'status' => $status,
                    'data' => $data,
                    'message' => $message
        ));
    }

}
