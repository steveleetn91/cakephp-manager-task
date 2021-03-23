<?php 
namespace App\Mailer;
use Cake\Mailer\Mailer;
class AssignMail {
    private $mailer;
    function __construct($to){
        $this->mailer = new Mailer('default');
        $this->mailer->
            ->setTo($to)
            ->setSubject('About')
            ->deliver('My message');
    }
}