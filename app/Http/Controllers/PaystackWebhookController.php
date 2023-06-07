<?php

namespace App\Http\Controllers;
use Marvel\Database\Models\Order;
use Illuminate\Http\Request;
use App\Models\Transaction; // Replace with your transaction model
use Illuminate\Support\Facades\Log;

class PaystackWebhookController extends Controller
{
    public function handleSuccess(Request $request)
    {
        // Retrieve the Paystack webhook data
        $payload = $request->all();
        $request->input('email');
        Log::info($payload, $email);
        // Verify the webhook data if necessary
        // ...

        // Store the transaction data in your database
        // $transaction = Transaction::create([
        //     'reference' => $payload['data']['reference'],
        //     'amount' => $payload['data']['amount'],
        //     // Add other fields as needed
        // ]);

        // Perform any additional logic or send notifications
        // ...

        // Return a response to acknowledge the webhook

// $update_order = Order::
// if (Order::where('id', $id)->exists()) {
//     $department = Department::find($id);
//     $department->department_name = is_null($request->department_name) ? $department->department_name : $request->department_name;
//     $department->remarks = is_null($request->remarks) ? $department->remarks : $request->remarks;
//     // $department->department_id = is_null($request->department) ? $unit->department_id : $request->department_id;
//     $department->save();
//     return redirect('/departments')->with('success', "ECF has successfuly been updated.");
// }

        return response()->json(['message' => 'Webhook received and processed successfully']);
    }
}
