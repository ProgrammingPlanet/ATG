<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use App\Models\Atg;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use App\Mail\Notification;

trait AtgTrait
{

    public function sendmail($to)
    {
        $msg = "Hi User, Your information Stored in our Database successfully.";

        \Mail::raw($msg, function ($mail) use ($to) 
            {
                $mail->to($to);
            }
        );

        if ( count(\Mail::failures()) > 0) {
            return "mail Send Failed";
        }else
            return 'mail sended success';
        //Mail::to('maansari525@gmail.com')->send(new Notification);
    }

    public function log($logs)
    {
        //first parameter passed to Monolog\Logger sets the logging channel name
        $orderLog = new Logger('email');
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/email.log')), Logger::INFO);
        $orderLog->info('EmailLog', $logs);
        //result stores in /storage/logs/email.log 
    }

	public function store($request)
    {

        $validator = Validator::make($request->all(), [
            'name'   =>  'required|alpha_spaces',
            'email' =>  'required|email|unique:persons|regex:/[a-zA-Z0-9_.]+@[a-zA-Z0-9]{2,}\.[a-zA-Z0-9]{2,3}[.a-zA-Z]*$/i',
            'pin'   =>  'required|digits:6',
        ]);

        if ($validator->fails()) {
            return ["status"=>0,"msg"=>$validator->messages()->first()];
        }

    	$person = new Atg();

    	$person->name = $request->input('name');
    	$person->email = $request->input('email');
    	$person->pin = $request->input('pin');

    	$person->save();

        $this->sendmail($person->email);

        $this->log(["EMAIL SENT TO ".$person->email]);

        return ["status"=>1,"msg"=>"Data Insert Successfully. An Email Has been Sent to ".$person->email];

    }
}