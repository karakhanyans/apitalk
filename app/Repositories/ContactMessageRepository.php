<?php
/**
 * Created by PhpStorm.
 * User: Garik
 * Date: 24.12.2018
 * Time: 17:37
 */

namespace App\Repositories;


use App\Models\ContactMessage;

class ContactMessageRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(new ContactMessage());
    }
}
