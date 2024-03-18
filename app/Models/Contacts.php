<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\ContactsController;

class Contacts extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    public function getAllContacts()
    {
        $contacts = DB::select('SELECT contacts.*, users.Name, users.Phone, users.Email
        FROM contacts
        INNER JOIN users ON contacts.user_id = users.user_id;');
        // dd($contacts);
        return $contacts;
    }
}
