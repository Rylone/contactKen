<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class ContactModel extends Model{
    protected $table = 'contact';
    protected $allowedFields = ['id','first_Name','last_Name','company','job','email','phone','note','favory','createDate','image'];
}