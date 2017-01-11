<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests;
use App\Http\Controllers\Emchat\Easemob;

class EmchatController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    	// $this->middleware('jwt');
    	$this->emchat = new Easemob;
    }

    public function getToken()
    {
        
    	return 'Token';
    }
}
