<?php
   namespace App\Controller;
   use App\Controller\AppController;
   use Cake\Mailer\Email;

   class EmailsController extends AppController{
      public function index(){
         $email = new Email('default');
         $loguser = $this->request->getSession()->read('Auth.User');
         $email->to($loguser['email'])->subject('About')->send('My message');
      }
   }
?>