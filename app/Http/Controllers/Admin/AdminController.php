<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use  App\Models\Contacts;

class AdminController extends Controller
{
    private $contacts;
    public function __construct()
    {
        // $this-> $users= new Users();
        $this->contacts = new Contacts();
    }
    public function getContacts(Request $request)
    {
        $title = "Contacts List";
        $contactsList = $this->contacts->getAllContacts();
        return view('admin.dashboard.dashboard', compact('title', 'contactsList'));
    }
}