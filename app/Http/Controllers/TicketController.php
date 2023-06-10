<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Department as Department;
use App\Models\Ticket as Ticket;
use App\Models\Status as Status;
use App\Models\Priority as Priority;
use App\Models\Issue as Issue;
use App\Models\Classification as Classification;
use App\Models\User as User;
use App\Models\UserLogs as UserLogs;
use App\Mail\Email as Email;
use App\Notifications\Ticket as Notifticket;

class TicketController extends Controller
{
    public $department;
    public $ticket;
    public $priority;
    public $status;
    public $user;
    public $issue;
    public $class;
    public $userlog;

    public function __construct()
    {
        $this->department = new Department;
        $this->ticket = new Ticket;
        $this->priority = new Priority;
        $this->status = new Status;
        $this->user = new User;
        $this->issue = new Issue;
        $this->class = new Classification;
        $this->userlog = new UserLogs;
    }
    public function inboxpage()
    {
        if (session()->has("user")) {
            $this->ticket->department_id = session()->get("user")->Department_id;
            if (session()->get("user")->SERVICE_DESK == 1) {
                return view('Ticket/Inbox')->with('department', $this->department)->with('ticket', $this->ticket)->with('status', $this->status)->with('priority', $this->priority)->with('user', $this->user)->with('issue', $this->issue)->with('class', $this->class);
            } else {
                return redirect("/create");
            }
        }
        return redirect("/");

    }
    public function mytickets()
    {
        if (session()->has("user")) {
            $this->ticket->user_id = session()->get("user")->id;
            return view('Ticket/MyTickets')->with('department', $this->department)->with('ticket', $this->ticket)->with('status', $this->status)->with('priority', $this->priority)->with('user', $this->user)->with('issue', $this->issue)->with('class', $this->class);
        }
        return redirect("/");

    }
    public function createpage()
    {
        if (session()->has("user")) {
            return view('Ticket/Create')->with('department', $this->department);
        }
        return redirect("/");
    }
    public function AddTicket(Request $request)
    {
        try {
            $this->ticket->request = $request;

            return $this->ticket->AddTicket();
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }
    public function TicketInstruction(Request $request)
    {
        try {


            $this->ticket->request = $request;
            $this->userlog->request = $request;
            $this->ticket->SetInstruction();
            $this->userlog->AddUserLogs();
            return "successful";
        }catch (\Exception $e){
            return $e->getMessage();

        }


    }
    public function TaskPage()
    {
        if (session()->has("user")) {
            return view('Ticket/Task')->with('ticket', $this->ticket)->with('user', $this->user)->with('status', $this->status);
        }
        return redirect("/");
    }
    public function Transmital(Request $request)
    {
        $this->ticket->request = $request;
        $this->ticket->TransferTask();
        return view('Ticket/Task')->with('ticket', $this->ticket)->with('user', $this->user)->with('status', $this->status);
    }
    public function UpdateStatus(Request $request)
    {
        $this->userlog->request = $request;
        $this->ticket->request = $request;
        //Function
        $this->ticket->UpdateStatus();
        $this->userlog->AddUserLogs();

        return view('Ticket/Task')->with('ticket', $this->ticket)->with('user', $this->user)->with('status', $this->status);
    }
    public function GetTickets($depid)
    {
        $this->ticket->department_id=$depid;
        return   $this->ticket->getTickets();
    }
    public function GetMyticket($uid)
    {
        $this->ticket->user_id=$uid;
        return   $this->ticket->getTickets();
    }

    public function TaskGetter($uid,$did,)
    {
        $this->ticket->user_id=$uid;
        $this->ticket->department_id=$did;
//        if (session()->get("user")->Permission_id==1);
        return   $this->ticket->getTasks();

    }
//    public function sendOfferNotification() {
//        $userSchema = User::first();
//
//        $offerData = [
//            'name' => 'BOGO',
//            'body' => 'You received an offer.',
//            'thanks' => 'Thank you',
//            'offerText' => 'Check out the offer',
//            'offerUrl' => url('/'),
//            'offer_id' => 007
//        ];
//
//        Notification::send($userSchema, new OffersNotification($offerData));
//
//        dd('Task completed!');
//    }

}
