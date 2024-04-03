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
        $contacts = DB::table($this->table)
            ->join('users', 'contacts.user_id', '=', 'users.user_id')
            ->select('contacts.*', 'users.Name', 'users.Phone', 'users.Email')
            ->get();
        return $contacts;
    }
    public function isContactConstrained($userId)
    {
        return $this->where('user_id', $userId)->exists();
    }

    public function getContactStatusByUserId($userId)
    {
        return $this->where('user_id', $userId)->value('status');
    }
}